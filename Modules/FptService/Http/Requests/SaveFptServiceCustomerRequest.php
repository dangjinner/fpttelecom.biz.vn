<?php

namespace Modules\FptService\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveFptServiceCustomerRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'fptservice::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
