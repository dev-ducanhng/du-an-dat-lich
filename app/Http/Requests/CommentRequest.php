<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'content' => 'required | min:3'
        ];
    }
    public function messages(): array
    {
        return [
            'content.required' => 'Vui lòng nhập nội dung',
            'content.min' => 'Vui lòng nhập ít nhất 3 ký tự'
        ];
    }
}
