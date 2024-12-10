<?php

namespace Modules\FptService\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveFptCategoryRequest extends Request
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
            'name' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}
