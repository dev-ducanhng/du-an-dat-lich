<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class VerifyPhoneNumberController extends Controller
{
    /**
     * Verify phone number
     *
     * @throws ConfigurationException|TwilioException
     */
    public function verifyPhone(Request $request): JsonResponse
    {
        $phoneNumber = '+84' . ltrim($request['phoneNumber'], '0');
        $account_sid = config("services.twilio.key");
        $auth_token = config("services.twilio.secret");
        $twilio_number = config("services.twilio.phone_number");
        $codeVerify = rand(100000, 900000);
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($phoneNumber, [
            'from' => $twilio_number,
            'body' => 'Vui lòng nhập mã code này để xác nhận là bạn: ' . $codeVerify,
        ]);

        return response()->json(['numberCode' => $codeVerify]);
    }
}
