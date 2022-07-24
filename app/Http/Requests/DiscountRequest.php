<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiscountRequest extends FormRequest
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
            'name' => 'required | min:3',
            'code_discount' => [
                'required', 'string',
                Rule::unique('discounts')->ignore($this->discountId)
            ],
            'percent' => 'required | numeric | min: 0 | max: 100'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên mã giảm giá',
            'name.min' => 'Vui lòng nhập tên mã giảm giá có ít nhất 3 ký tự',
            'code_discount.required' => 'Vui lòng nhập mã giảm giá',
            'code_discount.string' => 'Mã giảm giá có chứa ký tự đặc biệt',
            'code_discount.unique' => 'Mã giảm giá đã bị trùng',
            'percent.required' => 'Vui lòng nhập phần trăm giảm giá',
            'percent.numeric' => 'Vui lòng nhập số',
            'percent.min' => 'Vui lòng nhập số từ 0 đến 100',
            'percent.max' => 'Vui lòng nhập số từ 0 đến 100',
        ];
    }
}
