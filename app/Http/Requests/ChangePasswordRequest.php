<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => ' required | string | min:6 ',
            'password' => ' required | confirmed | min:6 ',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'old_password.string' => 'Mật khẩu không được phép chứa ký tự đặc biệt',
            'old_password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
        ];
    }
}
