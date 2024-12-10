<?php

namespace Modules\FptService\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasCrudActions;
use Modules\FptService\Entities\FptCategory;
use Modules\FptService\Http\Requests\SaveFptCategoryRequest;

class FptCategoryController extends Controller
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = FptCategory::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'fptservice::fpt_categories.fpt_category';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'fptservice::admin.fpt_categories';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveFptCategoryRequest::class;

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return FptCategory::withoutGlobalScope('active')->find($id);
    }

    /**
     * Destroy resources by given ids.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FptCategory::withoutGlobalScope('active')
            ->findOrFail($id)
            ->delete();

        return back()->withSuccess(trans('admin::messages.resource_deleted', ['resource' => $this->getLabel()]));
    }
}
