<?php

namespace App\Modules;

use App\Models\Booking;

class PaymentModule
{
    /**
     * Create payment module
     *
     * @param $bookingDetail
     * @param $bookingId
     * @return void
     */
    public function payment($bookingDetail, $bookingId, $discount)
    {
        $vnp_Url = config('services.payment.url');
        $vnp_Returnurl = route('success', $bookingId);
        $vnp_TmnCode = config('services.payment.key');
        $vnp_HashSecret = config('services.payment.secret');
        $vnp_TxnRef = $bookingId;
        $vnp_OrderInfo = 'Thanh toán đặt lịch cho đơn hàng ' . $bookingId;
        $vnp_OrderType = 'billpayment';
        $totalAmount = 0;
        foreach ($bookingDetail->bookingService as $detail) {
            $totalAmount += $detail->service->price - $detail->service->price * $detail->service->discount / 100;
        }
        if ($discount) {
            $vnp_Amount = $totalAmount * 100 - ($totalAmount * 100 * $discount / 100);
        } else {
            $vnp_Amount = $totalAmount * 100;
        }
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $vnp_IpAddr,
            "vnp_Locale"     => $vnp_Locale,
            "vnp_OrderInfo"  => $vnp_OrderInfo,
            "vnp_OrderType"  => $vnp_OrderType,
            "vnp_ReturnUrl"  => $vnp_Returnurl,
            "vnp_TxnRef"     => $vnp_TxnRef,
        ];

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = ['code' => '00'
            , 'message'       => 'success'
            , 'data'          => $vnp_Url];
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }

    }
}
