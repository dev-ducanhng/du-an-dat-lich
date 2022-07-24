<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'required', 'string',
                Rule::unique('users')->ignore($this->id)
            ],
            'phone' => [
                'required', 'string',
                Rule::unique('users')->ignore($this->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Hãy nhập tên người dùng',
            'first_name.string' => 'Tên người dùng không thể chứa ký tự đặc biệt',
            'last_name.required' => 'Hãy nhập tên người dùng',
            'last_name.string' => 'Tên người dùng không thể chứa ký tự đặc biệt',
            'first_name.unique' => 'Tên sản phẩm đã tồn tại',
            'price.required' => 'Hãy nhập giá sản phẩm',
            'price.min' => 'Giá sản phẩm không được là số âm',
            'image.required' => 'Hãy chọn ảnh sản phẩm',
            'image.mimes' => 'Cần chọn đúng định dạng ảnh',
            'quantity.integer' => 'Cần nhập số nguyên',
            'quantity.min' => 'Số lượng không được là số âm'
        ];
    }
}
