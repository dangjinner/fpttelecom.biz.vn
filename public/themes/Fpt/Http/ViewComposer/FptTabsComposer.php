<?php

namespace Themes\Fpt\Http\ViewComposer;

use Modules\Category\Entities\Category;

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
        ]);
    }

    private function getCategories()
    {
        return ['' => trans('admin::admin.form.please_select')] + Category::treeList();
    }
}
