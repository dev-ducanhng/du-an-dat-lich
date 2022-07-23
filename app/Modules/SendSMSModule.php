<?php

namespace App\Modules;

use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SendSMSModule
{
    public function sendSMS($bookingDetail, $isMultiple) {
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
            Ngày: ${bookingDetails['booking_date']}, Giờ: ${timeBooking}. Vui lòng sắp xếp thời gian đến đúng giờ. Xin cám ơn!";
        }
        $nexmoBasic = new Basic(config('services.nexmo.key'), config('services.nexmo.secret'));
        $nexmoClient = new Client($nexmoBasic);
        $phoneNumber = '84' . substr($bookingDetail->phone_number, 1);
        $nexmoClient->sms()->send(
            new SMS($phoneNumber, 'ISalon', $messageSending)
        );
    }

}
