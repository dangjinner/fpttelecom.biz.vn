<?php

namespace Modules\FptService\Entities;

use Illuminate\Support\Facades\Cache;
use Modules\Media\Eloquent\HasMedia;
use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;
use TypiCMS\NestableTrait;

class FptCategory extends Model
{
    use Translatable, Sluggable, NestableTrait, HasMedia;

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
    protected $fillable = ['parent_id', 'slug', 'position', 'is_searchable', 'is_active'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_searchable' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name', 'description'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';

    protected $appends = [
        'banner'
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addActiveGlobalScope();
    }

    public function isRoot()
    {
        return $this->exists && is_null($this->parent_id);
    }

    public function parent()
    {
        return $this->belongsTo(FptCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(FptCategory::class, 'parent_id', 'id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public static function treeList()
    {
        return Cache::tags('fpt_categories')->rememberForever(md5('fpt_categories.tree_list:' . locale()), function () {
            return static::orderByRaw('-position DESC')
                ->get()
                ->nest()
                ->setIndent('¦–– ')
                ->listsFlattened('name');
        });
    }

    public static function treeListGroupsRecursive($listId)
    {
        return static::whereIn('id', $listId)->orderByRaw('-position DESC')
            ->get()
            ->nest()
            ->setIndent('¦–– ')
            ->listsFlattened('name');
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
}
