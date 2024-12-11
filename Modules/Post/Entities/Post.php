<?php

namespace Modules\Post\Entities;

use Modules\AutoLink\Helpers\RenderAutoLink;
use Modules\Brand\Admin\BrandTable;
use Modules\Group\Entities\Group;
use Modules\Support\Eloquent\Model;
use Modules\Media\Eloquent\HasMedia;
use Modules\Media\Entities\File;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Post\Admin\PostTable;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;
use Modules\User\Entities\User;
use Carbon\Carbon;
use Modules\Tagp\Entities\TagP;
use Modules\Comment\Entities\Comment;
use Illuminate\Support\Str;

class Post extends Model
{
    use Translatable, Sluggable, HasMedia, HasMetaData;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    // public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'user_id', 'is_active', 'wordpress_thumbnail', 'is_toc', 'is_thumbnail_display', 'sidebar_layout', 'created_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active'             => 'boolean',
        'is_thumbnail_display'  => 'boolean',
        'is_toc'                => 'boolean'
    ];

    private $recursiveGroups = [];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name','content'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';


    protected static function booted()
    {
        static::saved(function ($post) {
            if (! empty(request()->all())) {
                $post->saveRelations(request()->all());
            }
        });
        static::addActiveGlobalScope();
    }

    public function scopeExpectDate($query)
    {
        $query->where('created_at', '<=', Carbon::now('Asia/Ho_Chi_Minh'));
    }

    public function scopeDesc($query)
    {
        $query->orderBy('created_at', 'desc');
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('M d,Y');
    }

    public function getDateTimeAttribute()
    {
        return $this->created_at->format('d-m-Y H:i');
    }

    public function table()
    {
        return new PostTable($this->newQuery()->withoutGlobalScope('active')->withoutGlobalScope('created_at'));
    }

    public function getLogoAttribute()
    {
        return $this->files->where('pivot.zone', 'logo')->first() ?: new File;
    }

    public function thumbnail()
    {
          if ($this->wordpress_thumbnail) {
            return 'https://fptcamera.com.vn/wp-content/uploads/' . $this->wordpress_thumbnail;
        }
        if ($this->logo->path) {
            return $this->logo->path;
        }
        return;
    }

    public function excerpt($number = 200)
    {
        $content = $this->content;
        // $content = htmlentities($content);
        $content = html_entity_decode($content);
        $content = strip_tags($content);
        $content = Str::words($content, $number,'');
        return $content;
    }

    public function url()
    {
        if( \Route::has('fpt.services.category') )
        {
            return route('fpt.services.category', ['slug' => $this->slug]);
        }
        return '';
    }

    public function saveRelations($attributes = [])
    {
        $this->groups()->sync(array_get($attributes, 'groups', []));
        $this->tags()->sync(array_get($attributes, 'tags', []));
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'post_groups');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(TagP::class, 'post_tags', 'post_id', 'tag_p_id');
    }

    public function getAllPost()
    {
        return Group::where('slug', 'ban-tin')->first()->posts();
    }

    public function getAllPostBySlugCategory($slug)
    {
        $groups = Group::with('childrenRecursive')->where('slug', $slug)->get();
        if($groups->count() == 0)
        {
            return abort(404);
        }
        $groupIds = $this->recursiveGroups($groups);
        $posts = $this->whereHas('groups', function($query) use($groupIds) {
            return $query->whereIn('id', $groupIds);
        })
        ->when(request()->get('s'), function($query){
            $query->whereHas('translations', function($subQuery){
                $s = request()->get('s');
                return $subQuery->where('name', 'LIKE',"%$s%");
            });
        })
        ->paginate(12);

        return $posts;
    }

    private function recursiveGroups($children)
    {
        foreach ($children as $item) {
            $item['children'] = $this->recursiveGroups($item->childrenRecursive);
            array_push($this->recursiveGroups, $item->id);
        }
        return $this->recursiveGroups;
    }

    public function getDateFormatAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function recentPosts()
    {
        $recentPosts = $this::orderBy('id', 'desc')->limit(4)->get();
        return $recentPosts;
    }

    public function promotions()
    {
        return Group::where('slug', 'chuong-trinh-khuyen-mai')->first()->posts();
    }
}
