<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => ' required | string | min:3 ',
            'content' => ' required ',
            'category_post_id' => ' required ',
            'status' => ' required ',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'title.string' => 'Không được phép nhập ký tự đặc biệt',
            'title.min' => 'Phải có ít nhất 3 ký tự',
            'content.required' => 'Vui lòng nhập nội dung bài viết',
            'category_post_id.required' => 'Vui lòng chọn chủ đề bài viết',
            'status.required' => 'Vui lòng nhập tiêu đề bài viết',
        ];
    }
}
