<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Define which assets will be available through the asset manager
    |--------------------------------------------------------------------------
    | These assets are registered on the asset manager
    */
    'all_assets' => [
        'admin.fptservice.css' => ['module' => 'fptservice:admin/css/fptservice.css'],
        'admin.fptservice.js' => ['module' => 'fptservice:admin/js/fptservice.js'],
        'admin.fpt_category.css' => ['module' => 'fptservice:admin/css/fptcategory.css'],
        'admin.fpt_category.js' => ['module' => 'fptservice:admin/js/fptcategory.js'],
        'admin.jstree.js' => ['module' => 'fptservice:admin/js/jstree.js'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Define which default assets will always be included in your pages
    | through the asset pipeline
    |--------------------------------------------------------------------------
    */
    'required_assets' => [],
];
