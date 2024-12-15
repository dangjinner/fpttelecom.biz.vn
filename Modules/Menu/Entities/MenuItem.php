<?php

namespace Modules\Menu\Entities;

use Modules\FptService\Entities\FptCategory;
use TypiCMS\NestableTrait;
use Modules\Page\Entities\Page;
use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;
use Modules\Media\Eloquent\HasMedia;
use Modules\Category\Entities\Category;
use Modules\Support\Eloquent\Translatable;
use Modules\Group\Entities\Group;
use Modules\Support\Eloquent\Sluggable;

class MenuItem extends Model
{
    use Translatable, NestableTrait, HasMedia, Sluggable;

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
        'menu_id',
        'category_id',
        'page_id',
        'parent_id',
        'type',
        'url',
        'icon',
        'target',
        'expand_desc',
        'position',
        'is_root',
        'is_fluid',
        'is_active',
        'fpt_category_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_root' => 'boolean',
        'is_fluid' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['background_image', 'background_image_2'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name', 'description'];

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
        static::addGlobalScope('not_root', function ($query) {
            $query->where('is_root', false);
        });

        static::addActiveGlobalScope();
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    //  public function group()
    // {
    //     return $this->belongsTo(Group::class);
    // }

    /**
     * Set the menu item's page id.
     *
     * @param int $pageId
     * @return void
     */
    public function setPageIdAttribute($pageId)
    {
        $this->attributes['page_id'] = $pageId;
    }

    /**
     * Set the menu item's parent id.
     *
     * @param int $parentId
     * @return void
     */
    public function setParentIdAttribute($parentId)
    {
        $this->attributes['parent_id'] = $parentId;
    }

    /**
     * Get the menu item's background image.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBackgroundImageAttribute()
    {
        return $this->files->where('pivot.zone', 'background_image')->first() ?: new File;
    }

    /**
     * Get the menu item's background image.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBackgroundImage2Attribute()
    {
        return $this->files->where('pivot.zone', 'background_image_2')->first() ?: new File;
    }

    /**
     * Determine if the menu item has any children.
     *
     * @return bool
     */
    public function hasChildren()
    {
        return $this->items->isNotEmpty();
    }

    /**
     * Determine if the menu item type is category.
     *
     * @return bool
     */
    public function isCategoryType()
    {
        return $this->type === 'category';
    }

    /**
     * Determine if the menu item type is fpt category.
     *
     * @return bool
     */
    public function isFptCategoryType()
    {
        return $this->type === 'fpt_category';
    }

    public function fptCategory()
    {
        return $this->belongsTo(FptCategory::class, 'fpt_category_id');
    }

    public function fptCategoryUrl()
    {
        $fptCategory = $this->fptCategory()->first();
        if ($fptCategory) {
            return $fptCategory->url();
        }

        return '';
    }

    /**
     * Determine if the menu item type is category.
     *
     * @return bool
     */
    // public function isGroupType()
    // {
    //     return $this->type === 'group';
    // }

    /**
     * Determine if the menu item type is page.
     *
     * @return bool
     */
    public function isPageType()
    {
        return $this->type === 'page';
    }

    /**
     * Determine if the menu item type is url.
     *
     * @return bool
     */
    public function isUrlType()
    {
        return $this->type === 'url';
    }

    /**
     * Returns the public url for the menu item.
     *
     * @return string
     */
    public function url()
    {
        if ($this->isCategoryType()) {
            return optional($this->category)->url();
        }

        if ($this->isFptCategoryType()) {
            return $this->fptCategoryUrl();
        }

        // if ($this->isGroupType()) {
        //     return optional($this->group)->url();
        // }

        if ($this->isPageType()) {
            return optional($this->page)->url();
        }

        if ($this->getAttributeFromArray('url') === '#') {
            return '#';
        }
      
        if (str_contains($this->getAttributeFromArray('url') ?? '', 'tel:')) {
            return $this->getAttributeFromArray('url');
        }

        if (filter_var($this->getAttributeFromArray('url'), FILTER_VALIDATE_URL)) {
            return $this->getAttributeFromArray('url');
        }

        return localized_url(locale(), $this->getAttributeFromArray('url'));
    }
    /**
     * Get the root menu item for the given menu id.
     *
     * @param int $menuId
     * @return $this
     */
    public static function root($menuId)
    {
        return static::withoutGlobalScope('not_root')
            ->where('menu_id', $menuId)
            ->firstOrFail();
    }

    /**
     * Get the parents of the given menuId.
     *
     * @param int $menuId
     * @param int $menuItemId
     * @return array
     */
    public static function parents($menuId, $menuItemId)
    {
        return static::withoutGlobalScope('active')
            ->where('id', '!=', $menuItemId)
            ->where('menu_id', $menuId)
            ->get()
            ->noCleaning()
            ->nest()
            ->setIndent('¦–– ')
            ->listsFlattened('name');
    }
}
