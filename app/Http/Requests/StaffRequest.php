<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
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
            'first_name' => 'required|string|min:1',
            'last_name' => 'required|string|min:1',
            'email' => [
                'required', 'string',
                Rule::unique('users')->ignore($this->id)
            ],
            'phone' => [
                'required', 'string',
                Rule::unique('users')->ignore($this->id)
            ],
        ];
    }
}
