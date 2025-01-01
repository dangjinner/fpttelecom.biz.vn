<?php

namespace Themes\Fpt\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Modules\FptService\Entities\FptService;

class FptServiceController
{
    public function service($slug)
    {
        $fptService = FptService::where('slug', $slug)->firstOrFail();
        $fptCategory = $fptService->fptCategories->first();

        SEOMeta::setTitle($fptService->name);
        return view('public.services.show', compact('fptService', 'fptCategory'));
    }
}