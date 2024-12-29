<?php

namespace Modules\Product\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Modules\Support\Money;
use Modules\Tag\Entities\Tag;
use Modules\Media\Entities\File;
use Modules\Brand\Entities\Brand;
use Modules\Tax\Entities\TaxClass;
use Modules\Option\Entities\Option;
use Modules\Review\Entities\Review;
use Modules\Comment\Entities\Comment;
use Modules\Support\Eloquent\Model;
use Modules\Media\Eloquent\HasMedia;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Support\Search\Searchable;
use Modules\Category\Entities\Category;
use Modules\Product\Admin\ProductTable;
use Modules\Support\Eloquent\Sluggable;
use Modules\FlashSale\Entities\FlashSale;
use Modules\Support\Eloquent\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Attribute\Entities\ProductAttribute;
use Illuminate\Support\Facades\Storage;

// use Modules\Order\Entities\OrderProduct;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Attribute\Entities\Attribute;
use Modules\Review\Entities\ReviewQuestion;

class Product extends Model
{
    use Translatable,
        Searchable,
        Sluggable,
        HasMedia,
        HasMetaData,
        SoftDeletes;

    const CONTACT_FOR_PRICE_ACTIVE = 1;
    const CONTACT_FOR_PRICE_DEACTIVE = 0;
    const IS_HIDDEN = 1;
    const NOT_HIDDEN = 0;

    protected $perPage = 15;
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'tax_class_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active',
        'new_from',
        'new_to',
        'review_questions_id',
        'contact_for_price',
        'vat_notice',
        'created_at',
        'is_hidden',
        'banner_link'
    ];
    /*
    * @var array
    */
    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
        'contact_for_price' => 'boolean',
        'is_hidden' => 'boolean'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'special_price_start',
        'special_price_end',
        'new_from',
        'new_to',
        'start_date',
        'end_date',
        'deleted_at',
        'created_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'base_image', 'additional_images', 'base_image_2', 'formatted_price', 'rating_percent', 'is_in_stock', 'is_out_of_stock',
        'is_new', 'has_percentage_special_price', 'special_price_percent', 'price_format', 'special_price_format', 'price_percent_convert',
        'url', 'has_special_price', 'banner_image', 'frame_image'
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name', 'short_name', 'description', 'short_description', 'specifications', 'gift_note', 'info_1', 'info_2'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */

    protected static function booted()
    {
        static::saved(function ($product) {
            if (!empty(request()->all())) {
                $product->saveRelations(request()->all());
            }
            $product->withoutEvents(function () use ($product) {
                $product->update([
                    'selling_price' => $product->getSellingPrice()->amount(),
                    'created_at' => $product->created_at ?? Carbon::now(),
                ]);
            });
        });

        static::addActiveGlobalScope();
        static::addGlobalScope('checkHidden', function (Builder $builder) {
            $builder->where('is_hidden', static::NOT_HIDDEN);
        });
    }

    public static function newArrivals($limit)
    {
        return static::forCard()
            ->latest()
            ->take($limit)
            ->get();
    }

    public static function list($ids = [])
    {
        return static::select('id')
            ->withName()
            ->whereIn('id', $ids)
            ->when(!empty($ids), function ($query) use ($ids) {
                $idsString = collect($ids)->filter()->implode(',');

                $query->orderByRaw("FIELD(id, {$idsString})");
            })
            ->get()
            ->mapWithKeys(function ($product) {
                return [$product->id => $product->name];
            });
    }

    public function scopeForCard($query)
    {
        $query->withName()
            ->withBaseImage()
            ->withPrice()
            ->withCount('options')
            ->with('reviews')
            ->addSelect([
                'products.id',
                'products.slug',
                'products.in_stock',
                'products.manage_stock',
                'products.qty',
                'products.new_from',
                'products.new_to'
            ]);
    }

    public function scopeWithPrice($query)
    {
        $query->addSelect([
            'products.price',
            'products.special_price',
            'products.special_price_type',
            'products.selling_price',
            'products.special_price_start',
            'products.special_price_end',
            'products.contact_for_price',
        ]);
    }

    public function scopeWithBrand($query, $brand)
    {
        if ($brand == "" || $brand == null) {
            return $query;
        }
        return $query->where('brand_id', $brand);
    }

    public function scopeFilterBrand($query, $brandSlug)
    {
        if (!$brandSlug) return $query;
        return $query->whereHas('brand', function ($query) use ($brandSlug) {
            $query->whereSlug($brandSlug);
        });
    }

    public function scopeFilterCategory($query, $categorySlug)
    {
        if (!$categorySlug) return $query;
        return $query->whereHas('categories', function ($query) use ($categorySlug) {
            return $query->whereSlug($categorySlug);
        });
    }

    public function scopeSortBy($query, $sortType)
    {
        if (!$sortType) return $sortType;

        switch ($sortType) {
            case 'price':
                return $query->orderBy('price');
            case 'price-desc':
                return $query->orderByDesc('price');
            case 'hot-sale':
                return $query->orderByDesc('viewed');
            case 'big-sale':
                return $query->orderByDesc(DB::raw('price - special_price'));
            case 'newest':
                return $query->orderByDesc('created_at');
            default:
                return $query;
        }
    }

    public function scopeSortPrice($query, $sortType)
    {
        if (!$sortType) return $query;
        switch ($sortType) {
            case 'pricehightolow':
                return $query->orderByDesc('special_price');
                break;
            case 'pricelowtohigh':
                return $query->orderBy('special_price');
                break;
            default:
                return $query;
                break;
        }
    }

    public function scopeFilterContactPrice($query, $contactPrice)
    {
        if (!$contactPrice) return $query;
        return $query->where('contact_for_price', $contactPrice);
    }

    public function scopePrice($query, $fromPrice, $toPrice)
    {
        if (!$fromPrice && !$toPrice) return $query;

        if ($fromPrice && !$toPrice) {
            return $query->where('selling_price', '>=', $fromPrice);
        } elseif (!$fromPrice && $toPrice) {
            return $query->where('selling_price', '<=', $toPrice);
        } else {
            return $query->where('selling_price', '>=', $fromPrice)
                ->where('selling_price', '<=', $toPrice);
        }
    }

    public function scopeWithName($query)
    {
        $query->with('translations:id,product_id,locale,name,description,short_description,specifications');
    }

    public function scopeWithBaseImage($query)
    {
        $query->with(['files' => function ($q) {
            $q->wherePivotIn('zone', ['base_image', 'base_image_2', 'additional_images']);
        }]);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function taxClass()
    {
        return $this->belongsTo(TaxClass::class)->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function orders()
    {
        return $this->hasMany(OrderProduct::class, 'order_products', 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->whereNull('parent_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_options')
            ->orderBy('position')
            ->withTrashed();
    }

    public function sameVersionProducts()
    {
        return $this->belongsToMany(static::class, 'same_version_products', 'product_id', 'same_version_product_id');
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(static::class, 'related_products', 'product_id', 'related_product_id');
    }

    public function upSellProducts()
    {
        return $this->belongsToMany(static::class, 'up_sell_products', 'product_id', 'up_sell_product_id');
    }

    public function crossSellProducts()
    {
        return $this->belongsToMany(static::class, 'cross_sell_products', 'product_id', 'cross_sell_product_id');
    }

    public function filter($filter)
    {
        return $filter->apply($this);
    }

    public function getPriceAttribute($price)
    {
        return Money::inDefaultCurrency($price);
    }

    public function getSpecialPriceAttribute($specialPrice)
    {
        if (!is_null($specialPrice)) {
            return Money::inDefaultCurrency($specialPrice);
        }
    }

    public function getSellingPriceAttribute($sellingPrice)
    {
        if (FlashSale::contains($this)) {
            $sellingPrice = FlashSale::pivot($this)->price->amount();
        }

        return Money::inDefaultCurrency($sellingPrice);
    }

    public function getTotalAttribute($total)
    {
        return Money::inDefaultCurrency($total);
    }

    /**
     * Get the product's base image.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBaseImageAttribute()
    {
        return $this->files->where('pivot.zone', 'base_image')->first() ?: new File;
    }

    /**
     * Get the product's banner image.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBannerImageAttribute()
    {
        return $this->files->where('pivot.zone', 'banner_image')->first() ?: new File;
    }

    /**
     * Get the product's frame image.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getFrameImageAttribute()
    {
        return $this->files->where('pivot.zone', 'frame_image')->first() ?: new File;
    }

    /**
     * Get the product's base image.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBaseImage2Attribute()
    {
        return $this->files->where('pivot.zone', 'base_image_2')->first() ?: new File;
    }

    /**
     * Get product's additional images.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAdditionalImagesAttribute()
    {
        return $this->files
            ->where('pivot.zone', 'additional_images')
            ->sortBy('pivot.id');
    }

    public function getFormattedPriceAttribute()
    {
        return product_price_formatted($this);
    }

    public function getRatingPercentAttribute()
    {
        if ($this->relationLoaded('reviews')) {
            return $this->ratingPercent();
        }
    }

    public function getIsInStockAttribute()
    {
        return $this->isInStock();
    }

    public function getIsOutOfStockAttribute()
    {
        return $this->isOutOfStock();
    }

    public function getIsNewAttribute()
    {
        return $this->isNew();
    }

    public function getHasPercentageSpecialPriceAttribute()
    {
        return $this->hasPercentageSpecialPrice();
    }

    public function getSpecialPricePercentAttribute()
    {
        return $this->getSpecialPricePercent();
    }

    public function getAttributeSetsAttribute()
    {
        return $this->getAttribute('attributes')->groupBy('attributeSet');
    }

    public function thumbnail()
    {
        if ($this->base_image) {
            return $this->base_image->path;
        }
        return;
    }

    public function getUrlAttribute()
    {
        return $this->url();
    }

    public function url()
    {
        if (\Route::has('fpt.products.show') && $this->slug) {
            return route('fpt.products.show', ['slug' => $this->slug]);
        }
        return '';
    }

    public function isInStock()
    {
        if (FlashSale::contains($this)) {
            return FlashSale::remainingQty($this) > 0;
        }

        if ($this->manage_stock && $this->qty === 0) {
            return false;
        }

        return $this->in_stock;
    }

    public function isOutOfStock()
    {
        return !$this->isInStock();
    }

    public function outOfStock()
    {
        $this->update(['in_stock' => false]);
    }

    public function hasAnyAttribute()
    {
        return $this->getAttribute('attributes')->isNotEmpty();
    }

    public function hasAnyOption()
    {
        return $this->options->isNotEmpty();
    }

    public function getSellingPrice()
    {
        if ($this->hasSpecialPrice()) {
            return $this->getSpecialPrice();
        }

        return $this->price;
    }

    public function getSpecialPrice()
    {
        // dd($this->attributes);
        $specialPrice = $this->attributes['special_price'] ?? $this->special_price;

        if ($this->special_price_type === 'percent') {
            $discountedPrice = ($specialPrice / 100) * $this->attributes['price'];

            $specialPrice = $this->attributes['price'] - $discountedPrice;
        }

        if ($specialPrice < 0) {
            $specialPrice = 0;
        }

        return Money::inDefaultCurrency($specialPrice);
    }

    public function hasPercentageSpecialPrice()
    {
        return $this->hasSpecialPrice() && $this->special_price_type === 'percent';
    }

    public function getSpecialPricePercent()
    {
        if ($this->hasPercentageSpecialPrice()) {
            return round($this->special_price->amount(), 2);
        }
    }

    public function getHasSpecialPriceAttribute()
    {
        return $this->hasSpecialPrice();
    }

    public function hasSpecialPrice()
    {
        if (is_null($this->special_price)) {
            return false;
        }

        if ($this->hasSpecialPriceStartDate() && $this->hasSpecialPriceEndDate()) {
            return $this->specialPriceStartDateIsValid() && $this->specialPriceEndDateIsValid();
        }

        if ($this->hasSpecialPriceStartDate()) {
            return $this->specialPriceStartDateIsValid();
        }

        if ($this->hasSpecialPriceEndDate()) {
            return $this->specialPriceEndDateIsValid();
        }

        return true;
    }

    private function hasSpecialPriceStartDate()
    {
        return !is_null($this->special_price_start);
    }

    private function hasSpecialPriceEndDate()
    {
        return !is_null($this->special_price_end);
    }

    private function specialPriceStartDateIsValid()
    {
        return today() >= $this->special_price_start;
    }

    private function specialPriceEndDateIsValid()
    {
        return today() <= $this->special_price_end;
    }

    public function ratingPercent()
    {
        return ($this->reviews->avg->rating / 5) * 100;
    }

    public function isNew()
    {
        if ($this->hasNewFromDate() && $this->hasNewToDate()) {
            return $this->newFromDateIsValid() && $this->newToDateIsValid();
        }

        if ($this->hasNewFromDate()) {
            return $this->newFromDateIsValid();
        }

        if ($this->hasNewToDate()) {
            return $this->newToDateIsValid();
        }

        return false;
    }

    private function hasNewFromDate()
    {
        return !is_null($this->new_from);
    }

    private function hasNewToDate()
    {
        return !is_null($this->new_to);
    }

    private function newFromDateIsValid()
    {
        return today() >= $this->new_from;
    }

    private function newToDateIsValid()
    {
        return today() <= $this->new_to;
    }

    public function sameVersionProductList()
    {
        return $this->sameVersionProducts()
            ->withoutGlobalScope('active')
            ->pluck('same_version_product_id');
    }

    public function relatedProductList()
    {
        return $this->relatedProducts()
            ->withoutGlobalScope('active')
            ->pluck('related_product_id');
    }

    public function upSellProductList()
    {
        return $this->upSellProducts()
            ->withoutGlobalScope('active')
            ->pluck('up_sell_product_id');
    }

    public function crossSellProductList()
    {
        return $this->crossSellProducts()
            ->withoutGlobalScope('active')
            ->pluck('cross_sell_product_id');
    }

    public static function findBySlug($slug)
    {
        return self::with([
            'categories', 'tags', 'attributes.attribute.attributeSet',
            'options', 'files', 'relatedProducts', 'upSellProducts', 'sameVersionProducts'
        ])
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public static function findHiddenBySlug($slug)
    {
        return self::with([
            'categories', 'tags', 'attributes.attribute.attributeSet',
            'options', 'files', 'relatedProducts', 'upSellProducts', 'sameVersionProducts'
        ])
            ->withoutGlobalScope('checkHidden')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function clean()
    {
        return array_except($this->toArray(), [
            'description',
            'short_description',
            'translations',
            'categories',
            'files',
            'is_active',
            'in_stock',
            'brand_id',
            'tax_class',
            'tax_class_id',
            'viewed',
            'created_at',
            'updated_at',
            'deleted_at',
        ]);
    }

    /**
     * Get table data for the resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function table($request)
    {
        // $cat = Category::all()->pluck('slug')->toArray();

        // $array = array_diff($cat, ['our-special-dinning', 'our-menu', 'breakfast', 'lunch', 'dinner']);
        // dd($array);
        $query = $this->newQuery()
            ->withoutGlobalScope('active')
            ->withoutGlobalScope('checkHidden')
            ->withName()
            ->withBaseImage()
            ->withPrice()
            // ->whereHas('categories', function($cat) use($array){
            //     $cat->whereIn('slug', $array)->orWhereNull('categories.id');
            // })
            ->addSelect(['id', 'is_active', 'created_at'])
            ->when($request->has('except'), function ($query) use ($request) {
                $query->whereNotIn('id', explode(',', $request->except));
            });

        return new ProductTable($query);
    }

    public function tableDinning($request)
    {
        $query = Category::where('slug', 'our-special-dinning')->first()->products()
            ->withoutGlobalScope('active')
            ->withoutGlobalScope('checkHidden')
            ->withName()
            ->withBaseImage()
            ->withPrice()
            ->addSelect(['id', 'is_active', 'created_at']);

        return new ProductTable($query);
    }

    public function tableMenu($request)
    {
        $query = Category::where('slug', 'our-menu')->first()->products()
            ->withoutGlobalScope('active')
            ->withoutGlobalScope('checkHidden')
            ->withName()
            ->withBaseImage()
            ->withPrice()
            ->addSelect(['id', 'is_active', 'created_at']);

        return new ProductTable($query);
    }

    /**
     * Save associated relations for the product.
     *
     * @param array $attributes
     * @return void
     */
    public function saveRelations($attributes = [])
    {
        $this->categories()->sync(array_get($attributes, 'categories', []));
        $this->tags()->sync(array_get($attributes, 'tags', []));
        $this->upSellProducts()->sync(array_get($attributes, 'up_sells', []));
        $this->crossSellProducts()->sync(array_get($attributes, 'cross_sells', []));
        $this->relatedProducts()->sync(array_get($attributes, 'related_products', []));
        $this->sameVersionProducts()->sync(array_get($attributes, 'same_version_products', []));
    }

    /**
     * Get the indexable data array for the product.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // MySQL Full-Text search handles indexing automatically.
        if (config('scout.driver') === 'mysql') {
            return [];
        }

        $translations = $this->translations()
            ->withoutGlobalScope('locale')
            ->get(['name', 'description', 'short_description']);

        return ['id' => $this->id, 'translations' => $translations];
    }

    public function searchTable()
    {
        return 'product_translations';
    }

    public function searchKey()
    {
        return 'product_id';
    }

    public function searchColumns()
    {
        return ['name'];
    }

    public function getPriceFormatAttribute()
    {
        return number_format($this->price->amount(), 0, ',', '.');
    }

    public function formatPrice()
    {
        $priceFormat = trim($this->price, '\0');
        return number_format($priceFormat, 0);
    }

    public function getSpecialPriceFormatAttribute()
    {
        if (!is_null($this->special_price)) {
            return number_format($this->special_price->amount(), 0, ',', '.');
        }
    }

    public function getPricePercentConvertAttribute()
    {
        $result = 0;

        if ($this->hasPercentageSpecialPrice()) {
            $result = $this->special_price->amount();
        }
        if ($this->hasSpecialPrice() && $this->special_price_type === 'fixed') {
            if ($this->price->amount() != 0) {
                $result = 100 - ($this->special_price->amount() / $this->price->amount() * 100);
            }
        }

        return round($result);
    }

    public function getReviewQuestions()
    {
        // dd(123);
        // dd(ReviewQuestion::whereIn('id', json_decode($this->review_questions_id, true))
        // ->get());
        return ReviewQuestion::whereIn('id', json_decode($this->review_questions_id, true) ?? [''])
            ->get();
    }

    public function getReviews()
    {
        return Review::where([
            ['product_id', $this->id],
            ['is_approved', 1],
        ]);
    }

    public function getAvgReviews()
    {
        return $this->getReviews()
            ->avg('rating') ?? 0;
    }

    public function getAllImageReviews()
    {
        return $this->getReviews()
            ->pluck('image')
            ->toArray();
    }

    public function getSumOneStar(int $number)
    {
        return $this->getReviews()
            ->where('rating', $number)
            ->count();
    }

    public function getPercentOneStar(int $number)
    {
        // dd(0 / 0);
        return $this->checkCalculateZero($number) ? 0 : ($this->getSumOneStar($number) / $this->getReviews()->count()) * 100;
    }

    public function checkCalculateZero(int $number)
    {
        if ($this->getSumOneStar($number) == 0 && $this->getReviews()->count() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getComments()
    {
        return Comment::where([
            ['product_id', $this->id],
            ['is_approved', 1],
        ]);
    }

    public function getRelatedProduct()
    {
        return $this->whereNotIn('id', [$this->id])
            ->orderBy('id', 'desc');
    }

    public function getRelatedProductCat($cats, $limit = 10)
    {
        if (!is_array($cats)) {
            return Category::findOrFail($cats)->products()
                ->where('id', '!=', $this->id)
                ->limit($limit)
                ->get();
        }

        return Product::with('categories')->whereHas('categories', function ($category) use ($cats) {
            return $category->whereIn('id', $cats);
        })->where('id', '!=', $this->id)->limit($limit)->get();
    }

}
