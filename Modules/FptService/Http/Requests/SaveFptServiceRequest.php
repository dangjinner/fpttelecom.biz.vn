<?php

namespace Modules\FptService\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveFptServiceRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'fpt::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'required|string',
            'is_active' => 'required|boolean',
            'billing_cycle' => 'required|string',
            'promotion_details' => 'nullable|string',
            'price' => 'required|numeric',
        ];
    }
}
