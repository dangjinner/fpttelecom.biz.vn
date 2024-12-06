<?php

namespace Themes\Fpt\Http\ViewComposer;

use Modules\Category\Entities\Category;
use Modules\Slider\Entities\Slider;

class FptTabsComposer
{
     /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'categories' => $this->getCategories(),
            'sliders' => $this->getSliders(),
        ]);
    }

    private function getCategories()
    {
        return ['' => trans('admin::admin.form.please_select')] + Category::treeList();
    }

    private function getSliders()
    {
        return Slider::all()->sortBy('name')->pluck('name', 'id')
            ->prepend(trans('fpt::fpt.form.please_select'), '');
    }
}
