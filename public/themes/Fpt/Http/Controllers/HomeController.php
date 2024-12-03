<?php

namespace Themes\Fpt\Http\Controllers;

class HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.home.' . setting('home_switcher'));
    }
}

