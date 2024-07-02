<?php

namespace Modules\Page\Entities;

use Modules\Admin\Ui\AdminTable;
use Modules\Category\Entities\Category;
use Modules\Support\Eloquent\Model;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;
use Modules\Meta\Entities\MetaData;

class Page extends Model
{
    use Translatable, Sluggable, HasMetaData;

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
    protected $fillable = ['slug', 'is_active', 'is_display_category'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name', 'body'];

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
        static::addActiveGlobalScope();

        self::saved(function($category) {
            if(!empty(request()->all())) {
                $category->saveRelations(request()->all());
            }
        });
    }

    protected function saveRelations($attributes)
    {
        $this->categories()->sync(array_get($attributes, 'categories', []));
    }

    public static function urlForPage($id)
    {
        return static::select('slug')->firstOrNew(['id' => $id])->url();
    }

    public function url()
    {
        if (is_null($this->slug)) {
            return '#';
        }

        return localized_url(locale(), $this->slug);
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new AdminTable($this->newQuery()->withoutGlobalScope('active'));
    }

    public function getDateFormatAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function metaData()
    {
        return $this->hasOne(MetaData::class, 'entity_id', 'id')->where('entity_type', Page::class);
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            PageCategory::class,
            'page_id',
            'category_id'
        );
    }
}
