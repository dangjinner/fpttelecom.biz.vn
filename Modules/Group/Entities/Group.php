<?php

namespace Modules\Group\Entities;

use TypiCMS\NestableTrait;
use Modules\Support\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;
use Modules\Post\Entities\Post;

class Group extends Model {

    use Translatable, Sluggable, NestableTrait;

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
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['translations'];

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
    protected $translatedAttributes = ['name'];

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
    }


    public function isRoot()
    {
        return $this->exists && is_null($this->parent_id);
    }

    public function parent()
    {
        return $this->belongsTo(Group::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Group::class, 'parent_id', 'id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function url()
    {
        if( \Route::has('post.category') )
        {
            return route('post.category', ['slug' => $this->slug]);
        }
        return '';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_groups');
    }

    public static function treeList()
    {
        return Cache::tags('groups')->rememberForever(md5('groups.tree_list:' . locale()), function () {
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

    // public static function searchable()
    // {
    //     return Cache::tags('groups')
    //         ->rememberForever(md5('groups.searchable:' . locale()), function () {
    //             return static::where('is_searchable', true)
    //                 ->get()
    //                 ->map(function ($group) {
    //                     return [
    //                         'slug' => $group->slug,
    //                         'name' => $group->name,
    //                     ];
    //                 });
    //         });
    // }

    // public function groups()
    // {
    //     return $this->belongsToMany(Post::class, 'post_groups');
    // }


}