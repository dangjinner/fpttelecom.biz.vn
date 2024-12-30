<?php

namespace Themes\Fpt\Http\Requests;

use Modules\Core\Http\Requests\Request;
use Themes\Anan\Http\Rules\MinWordsRule;

class CheckoutRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'payment_method' => ['required'],
            'address' => ['required'],
            'province_id' => 'required|int|exists:provinces,id',
            'district_id' => 'required|int|exists:districts,id',
            'ward_id' => 'required|int|exists:wards,id',
            'note' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên của bạn.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'email.required' => 'Vui lòng nhập email của bạn.',
            'email.email' => 'Email không hợp lệ, vui lòng nhập lại.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại của bạn.',
            'phone_number.regex' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            'address.required' => 'Vui lòng nhập địa chỉ của bạn.',
            'province_id.required' => 'Vui lòng chọn tỉnh/thành phố.',
            'province_id.int' => 'ID tỉnh/thành phố phải là một số.',
            'province_id.exists' => 'Tỉnh/thành phố bạn chọn không tồn tại.',
            'district_id.required' => 'Vui lòng chọn quận/huyện.',
            'district_id.int' => 'ID quận/huyện phải là một số.',
            'district_id.exists' => 'Quận/huyện bạn chọn không tồn tại.',
            'ward_id.required' => 'Vui lòng chọn phường/xã.',
            'ward_id.int' => 'ID phường/xã phải là một số.',
            'ward_id.exists' => 'Phường/xã bạn chọn không tồn tại.',
            'note.string' => 'Ghi chú phải là một chuỗi ký tự nếu có.',
        ];
    }
}
