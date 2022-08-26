<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
            'name' => 'required | string | min:3',
            'phone_number' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
            'content' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên Không được trống',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'phone_number.string' => 'Số điện thoại vừa nhập sai định dạng',
            'content' => 'Hãy nhập nội dung'

        ];
    }
}