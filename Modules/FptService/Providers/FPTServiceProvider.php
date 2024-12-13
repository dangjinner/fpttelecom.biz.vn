<?php

namespace Modules\FptService\Providers;

use Modules\Admin\Ui\Facades\TabManager;
use Modules\FptService\Admin\FptServiceCustomerTabs;
use Modules\FptService\Admin\FptServiceTabs;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;

class FPTServiceProvider extends ServiceProvider
{
    use AddsAsset;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('fpt_services', FptServiceTabs::class);
        TabManager::register('fpt_service_customers', FptServiceCustomerTabs::class);

        $this->addAdminAssets('admin.fpt_categories.index', [
            'admin.fpt_category.css', 'admin.jstree.js', 'admin.fpt_category.js',
            'admin.media.css', 'admin.media.js',
        ]);

        $this->addAdminAssets('admin.fpt_services.(create|edit)', [
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
