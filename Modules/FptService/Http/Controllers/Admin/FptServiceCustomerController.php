<?php

namespace Modules\FptService\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasCrudActions;
use Modules\FptService\Entities\FptServiceCustomer;
use Modules\FptService\Http\Requests\SaveFptServiceCustomerRequest;

class FptServiceCustomerController extends Controller
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = FptServiceCustomer::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'fptservice::fpt_service_customers.fpt_service_customer';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'fptservice::admin.fpt_service_customers';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveFptServiceCustomerRequest::class;
}
