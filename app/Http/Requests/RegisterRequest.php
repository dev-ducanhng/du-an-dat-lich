<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => 'required | min: 3',
            'email' => [
                'required', 'string',
                Rule::unique('users')->ignore($this->id)
            ],
            'phone' => [
                'required', 'string',
                Rule::unique('users')->ignore($this->id)
            ],
            'password' => ' required | confirmed | min:6 ',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng',
            'name.min' => 'Tên tôi thiểu phải có 3 ký tự',
            'email.required' => 'Vui lòng nhập Email',
            'email.string' => 'Email vừa nhập có chứa ký tự đặc biệt',
            'email.unique' => 'Email đã được đăng ký',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.string' => 'Số điện thoại vừa nhập sai định dạng',
            'phone.unique' => 'Số điện thoại đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ];
    }
}
