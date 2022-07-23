<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email:rfc,dns',
            'name' => 'min:5|required|string',
            'date-of-birth' => 'required|after:date',
            'image' => 'mimes:jpeg,png,jpg',
            'phone' => ['required', 'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/'],
        ];
    }
    public function attributes(): array
    {
        return [
            'email' => 'Email',
            'name' => 'Tên',
            'date-of-birth' => 'Ngày tháng năm sinh',
            'image' => 'Hình ảnh',
            'phone' => 'Số điện thoại'
        ];
    }
}
