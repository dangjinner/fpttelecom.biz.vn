<?php

namespace Themes\Fpt\Http\Controllers;

use Illuminate\Http\Request;
use Modules\FptService\Entities\FptCategory;
use Modules\Group\Entities\Group;
use Modules\Post\Entities\Post;
use Modules\Slider\Entities\Slider;

class HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->limit(8)->get();
        return view('public.home.' . setting('home_switcher'), [
            'posts' => $posts,
        ]);
    }

    /**
     * @param Request $request
     * @param $slug
     * @return mixed
     */
    public function fptCategory(Request $request, $slug)
    {
        $fptCategory = FptCategory::where('slug', $slug)
            ->where('is_searchable', true)
            ->first();

        if (!$fptCategory) {
            return $this->fptNewsDetails($slug);
        }

        if (!$fptCategory->parent_id && count($fptCategory->children) > 0) {
            $fptCategory = $fptCategory->children[0];
            return redirect()->route('fpt.services.category', ['slug' => $fptCategory->slug]);
        }

        $fptCategories = $fptCategory->parent->children()
            ->where('is_searchable', true)
            ->get();

        return view('public.services.category', compact(
            'fptCategory',
            'fptCategories')
        );
    }

    public function fptNews(Request $request)
    {
        $posts = Post::latest()->paginate(10);
        $banner = Slider::findWithSlides(setting('home_page_banner'));
        $groups = Group::searchable()
            ->isParent()
            ->get();

        return view('public.news.index', compact('posts', 'banner', 'groups'));
    }

    public function fptNewsCategory($slug)
    {
        $currentGroup = Group::where('slug', $slug)->firstOrFail();
        $posts = $currentGroup->posts()->latest()->paginate(10);
        $banner = Slider::findWithSlides(setting('home_page_banner'));
        $groups = $currentGroup->children;

        return view('public.news.index', compact('posts', 'banner', 'currentGroup', 'groups'));
    }

    public function fptNewsDetails($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $banner = Slider::findWithSlides(setting('home_page_banner'));
        $group = $post->groups->first();

        return view('public.news.details', compact('post', 'banner', 'group'));
    }
}

