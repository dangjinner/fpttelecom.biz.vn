<?php

namespace Themes\Fpt\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFptServiceRequest extends FormRequest
{
    protected function prepareForValidation()
    {
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'phone_number' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'province_id' => 'required|int|exists:provinces,id',
            'district_id' => 'required|int|exists:districts,id',
            'ward_id' => 'required|int|exists:wards,id',
            'note' => 'nullable|string',
            'property_type' => 'required|int|in:1,2',
            'home_address' => 'required_if:property_type,1',
            'apartment_name' => 'required_if:property_type,2',
            'building_name' => 'nullable|string',
            'floor_number' => 'nullable|int',
            'room_number' => 'nullable|int',
            'service_slug' => 'nullable|string|exists:fpt_services,slug',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi ký tự hợp lệ.',

            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.string' => 'Số điện thoại phải là một chuỗi ký tự hợp lệ.',
            'phone_number.regex' => 'Số điện thoại không đúng định dạng.',
            'phone_number.min' => 'Số điện thoại phải có ít nhất 10 ký tự.',

            'province_id.required' => 'Tỉnh/thành phố là bắt buộc.',
            'province_id.int' => 'Tỉnh/thành phố phải là một số nguyên hợp lệ.',
            'province_id.exists' => 'Tỉnh/thành phố không tồn tại trong cơ sở dữ liệu.',

            'district_id.required' => 'Quận/huyện là bắt buộc.',
            'district_id.int' => 'Quận/huyện phải là một số nguyên hợp lệ.',
            'district_id.exists' => 'Quận/huyện không tồn tại trong cơ sở dữ liệu.',

            'ward_id.required' => 'Phường/xã là bắt buộc.',
            'ward_id.int' => 'Phường/xã phải là một số nguyên hợp lệ.',
            'ward_id.exists' => 'Phường/xã không tồn tại trong cơ sở dữ liệu.',

            'note.string' => 'Ghi chú phải là một chuỗi ký tự hợp lệ.',

            'property_type.required' => 'Loại nhà là bắt buộc.',
            'property_type.int' => 'Loại nhà phải là một số nguyên hợp lệ.',
            'property_type.in' => 'Loại nhà không hợp lệ.',

            'home_address.required_if' => 'Địa chỉ nhà riêng là bắt buộc',
            'home_address.string' => 'Địa chỉ nhà riêng phải là một chuỗi ký tự hợp lệ.',

            'apartment_name.required_if' => 'Tên chung cư là bắt buộc',
            'apartment_name.string' => 'Tên chung cư phải là một chuỗi ký tự hợp lệ.',

            'building_name.string' => 'Tên tòa nhà phải là một chuỗi ký tự hợp lệ.',

            'floor_number.int' => 'Số tầng phải là một số nguyên hợp lệ.',

            'room_number.int' => 'Số phòng phải là một số nguyên hợp lệ.',
        ];
    }

}
