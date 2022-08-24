<?php

namespace App\Modules;

use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SendSMSModule
{
    /**
     * @throws TwilioException
     * @throws ConfigurationException
     */
    public function sendSMS($bookingDetail, $isMultiple)
    {
        $timeBooking = date('G:i', strtotime($bookingDetail->booking_time));
        $dataBooking = $bookingDetail->toArray();
        $bookingDetails = [
            'customer_name' => $dataBooking['customer_name'],
            'booking_date'  => $dataBooking['booking_date']['date'],
            'booking_code'  => $dataBooking['booking_code'],
        ];
        if ($isMultiple) {
            $messageSending = "Xin chào ${bookingDetails['customer_name']}, Bạn đã đặt lịch sử dụng dịch vụ thành công. Đây là thông tin đặt lịch của bạn:
            Ngày: ${bookingDetails['booking_date']}, Giờ: ${timeBooking}, Mã nhóm của bạn là: ${bookingDetails['booking_code']} Vui lòng sắp xếp thời gian đến đúng giờ. Xin cám ơn!";
        } else {
            $messageSending = "Xin chào ${bookingDetails['customer_name']}, Bạn đã đặt lịch sử dụng dịch vụ thành công. Đây là thông tin đặt lịch của bạn:
            Ngày: ${bookingDetails['booking_date']},
            Giờ: ${timeBooking}.
            Vui lòng sắp xếp thời gian đến đúng giờ. Xin cám ơn!";
        }
        $phoneNumber = '+84' . ltrim($bookingDetail->phone_number, '0');
        $account_sid = config("services.twilio.key");
        $auth_token = config("services.twilio.secret");
        $twilio_number = config("services.twilio.phone_number");

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($phoneNumber, [
            'from' => $twilio_number,
            'body' => $messageSending,
        ]);
    }

}
