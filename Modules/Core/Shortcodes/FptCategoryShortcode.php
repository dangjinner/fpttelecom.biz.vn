<?php

namespace Modules\Core\Shortcodes;

use Modules\FptService\Entities\FptCategory;

class FptCategoryShortcode
{
    public function register($shortcode, $content, $compiler, $name, $viewData)
    {
        $fptCategory = FptCategory::find($shortcode->id);
        return view('public.shortcodes.fpt_category', compact('fptCategory'));
    }
}