<?php

namespace Modules\FptService\Http\Controllers\Admin;


use Modules\FptService\Entities\FptCategory;
use Modules\FptService\Http\Responses\FptCategoryTreeResponse;
use Modules\FptService\Services\FptCategoryTreeUpdater;

class FptCategoryTreeController
{
    /**
     * Display Group tree in json.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = FptCategory::withoutGlobalScope('active')
            ->orderByRaw('-position DESC')
            ->get();

        return new FptCategoryTreeResponse($groups);
    }

    /**
     * Update group tree in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        FptCategoryTreeUpdater::update(request('group_tree'));

        return trans('group::messages.group_order_saved');
    }
}
