<?php

namespace App\Http\Requests;

use App\Rules\BookingRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class BookingRequest extends FormRequest
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
        $regex = ' /(([03+[2-9]|05+[6|8|9]|07+[0|6|7|8|9]|08+[1-9]|09+[1-4|6-9]]){3})+[0-9]{7}\b/';
        return [
            'customer_name'         => 'required|min:3|string',
            'phone_number'          => ['required', 'regex:' . $regex],
            'booking_date'          => ['required', 'before_or_equal:' . now()->addDays(7)->toDateString(), 'after_or_equal:' . now()->toDateString(), 'date'],
            'service'               => 'required',
            'stylist'               => 'required',
            'booking_time'          => 'required',
            'amount_number_booking' => 'required_if:multiple_booking,==,on',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'customer_name'         => 'Tên của bạn',
            'phone_number'          => 'Số điện thọai',
            'booking_date'          => 'Ngày tháng',
            'service'               => 'Dịch vụ',
            'stylist'               => 'Stylist',
            'booking_time'          => 'Thời gian',
            'amount_number_booking' => 'Số lượng',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'amount_number_booking.required_if' => 'Bạn phải nhập số lượng khi chọn đặt cho nhiều người.',
            'booking_date.date'                 => 'Ngày tháng không đúng định dạng.',
            'booking_date.after_or_equal'       => 'Ngày tháng ít nhất phải từ ngày hôm nay.',
            'booking_date.before_or_equal'      => 'Ngày tháng không được quá 7 ngày kể từ ngày hôm nay.',
        ];
    }
}
