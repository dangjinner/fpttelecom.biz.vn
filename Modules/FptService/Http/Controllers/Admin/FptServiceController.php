<?php

namespace Modules\FptService\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasCrudActions;
use Modules\FptService\Entities\FptService;
use Modules\FptService\Http\Requests\SaveFptServiceRequest;

class FptServiceController extends Controller
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = FptService::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'fptservice::fpt_services.fpt_service';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'fptservice::admin.fpt_services';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveFptServiceRequest::class;
}
