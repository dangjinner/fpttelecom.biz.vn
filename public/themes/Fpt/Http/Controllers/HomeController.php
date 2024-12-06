<?php

namespace Themes\Fpt\Http\Controllers;

use Modules\Post\Entities\Post;

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
}

