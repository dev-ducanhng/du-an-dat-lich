<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SeviceRequest extends FormRequest
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
            'name' => [
                'required', 'string',
                Rule::unique('services')->ignore($this->id)
            ],
            'price' => 'required|integer|min:1',
            'image' => 'nullable|image',
            'status' => 'required|integer',
            'discount'=>'required|integer|min:1|max:99'
        ];
        
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên Không được trống',
            'price.required'=>'Gía không được trống',
            'price.integer'=>"Gía phải là số",
            'price.min'=>'Gía không được nhỏ hơn hoặc bằng 0',
            'image.image'=>'Ảnh chưa đúng định dạng',
            'status.required'=>'Trạng thái chưa được chọn',
            'discount.required'=>'Giảm giá trống',
            'discount.integer'=>'Giảm giá không đúng định dạng',
            'discount.min'=>'Giảm giá nhỏ nhất là 1%',
            'discount.max'=>'Giảm giá lớn nhất là 99%'

        
        ];
    }
}
