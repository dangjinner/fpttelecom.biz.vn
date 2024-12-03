<?php

namespace Modules\AutoLink\Providers;

use Modules\Admin\Ui\Facades\TabManager;
use Modules\AutoLink\Admin\AutoLinkTabs;
use Modules\Brand\Admin\BrandTabs;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;

class AutoLinkServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('auto_links', AutoLinkTabs::class);

        $this->addAdminAssets('admin.auto_links.(create|edit)', [
            'admin.media.css', 'admin.media.js',
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
