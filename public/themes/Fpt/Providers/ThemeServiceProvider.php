<?php

namespace Themes\Fpt\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;
use Modules\Support\Traits\AddsAsset;
use Themes\Fpt\Admin\FptTabs;
use Themes\Fpt\Http\ViewComposer\FptTabsComposer;
use Themes\Fpt\Http\ViewComposer\FptViewComposer;
use Themes\Fpt\Http\ViewComposer\HomePageViewComposer;

class ThemeServiceProvider extends ServiceProvider
{
    use AddsAsset;

    public function boot()
    {
        TabManager::register('fpt', FptTabs::class);

        View::composer('public.*', FptViewComposer::class);
        View::composer('admin.*', FptTabsComposer::class);
        View::composer('public.home.*', HomePageViewComposer::class);

        $this->addAdminAssets('admin.fpt.settings.edit', [
            'admin.media.css', 'admin.media.js'
        ]);
    }

}
