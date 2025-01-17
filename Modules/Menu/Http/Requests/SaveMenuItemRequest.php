<?php

namespace Modules\Menu\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;

class SaveMenuItemRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'menu::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'type' => ['required', Rule::in('category', 'page', 'url', 'group', 'fpt_category')],
            'category_id' => 'required_if:type,category',
            'fpt_category_id' => 'required_if:type,fpt_category|exists:fpt_categories,id',
            'page_id' => 'required_if:type,page',
            'url' => 'required_if:type,url',
            'group_id' => 'required_if:type,group',
            'target' => ['required', Rule::in('_self', '_blank')],
            'is_fluid' => 'required|boolean',
            'is_active' => 'required|boolean',
            'expand_desc' => 'nullable|string',
        ];
    }
}
