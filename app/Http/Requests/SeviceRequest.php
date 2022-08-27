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
        
        $requestRule =  [
            'name' => [
                'required',
                Rule::unique('services')->ignore($this->id)
            ],
            'price' => 'required|integer|min:1',
            'image' => 'image',
            'status' => 'required|integer',
            'discount' => 'nullable|integer|min:0|max:100'
        ];
        
        if($this->id == null){
            $requestRule['image'] = "required|" . $requestRule['image'];
        }

        return $requestRule;

       
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên Không được trống',
            'price.required' => 'Gía không được trống',
            'price.integer' => "Gía phải là số",
            'price.min' => 'Gía không được nhỏ hơn hoặc bằng 0',
            'image.image' => 'Ảnh chưa đúng định dạng',
            'image.required' => 'Ảnh chưa được chọn',
            'status.required' => 'Trạng thái chưa được chọn',
            // 'discount.required'=>'Giảm giá trống',
            'discount.integer' => 'Giảm giá không đúng định dạng',
            'discount.min' => 'Giảm giá nhỏ nhất là 0%',
            'discount.max' => 'Giảm giá lớn nhất là 100%'


        ];
    }
}