<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryPostRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'min:3',
                Rule::unique('category_post')->ignore($this->categoryPostId)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên danh mục bài viết',
            'name.string' => 'Không được phép nhập ký tự đặc biệt',
            'name.min' => 'Phải có ít nhất 3 ký tự',
            'name.unique' => 'Tên danh mục đã tồn tại',
        ];
    }
}
