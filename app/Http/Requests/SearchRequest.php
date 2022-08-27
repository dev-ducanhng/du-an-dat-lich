<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'start_date.date' => 'Vui lòng nhập đúng định dạng ngày tháng',
            'end_date.date' => 'Vui lòng nhập đúng định dạng ngày tháng',
        ];
    }
}
