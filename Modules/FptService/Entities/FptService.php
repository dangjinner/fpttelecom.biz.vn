<?php

namespace Modules\FptService\Entities;

use Modules\FptService\Admin\FptServiceTable;
use Modules\Media\Eloquent\HasMedia;
use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;
use Modules\Support\Money;

class FptService extends Model
{
    use Translatable, Sluggable, HasMedia;

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
        'price',
        'is_active',
        'fpt_category_id',
    ];

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
    public $translatedAttributes = ['name', 'description', 'features', 'billing_cycle', 'promotion_details'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';

    protected static function booted()
    {
        static::addActiveGlobalScope();

        static::saved(function (FptService $fptService) {
            if (!empty(request()->all())) {
                $fptService->saveRelations(request()->all());
            }
        });
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new FptServiceTable($this->newQuery()
            ->latest()
            ->withoutGlobalScope('active'));
    }

    /**
     * Get the fpt service's logo.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getLogoAttribute()
    {
        return $this->files->where('pivot.zone', 'logo')->first() ?: new File;
    }

    /**
     * Get the fpt service's banner.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBannerAttribute()
    {
        return $this->files->where('pivot.zone', 'banner')->first() ?: new File;
    }

    public function getPriceAttribute($price)
    {
        return Money::inDefaultCurrency($price);
    }

    public function fptCategories()
    {
        return $this->belongsToMany(
            FptCategory::class,
            FptServiceCategory::class,
            'fpt_service_id',
            'fpt_category_id'
        );
    }

    /**
     * Save associated relations for the fpt service.
     *
     * @param array $attributes
     * @return void
     */
    public function saveRelations($attributes = [])
    {
        $this->fptCategories()->sync(array_get($attributes, 'fpt_categories', []));
    }
}
