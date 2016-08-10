<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use Twilio\Rest\Client;
use Otp\Otp;
use Base32\Base32;

class EnableTfaViaSmsController extends Controller
{
    public function enableTfaViaSmsPage()
    {
        return view('enable-tfa-via-sms');
    }

    public function enableTfaViaSms(Request $request, Client $client)
    {
        $phoneNumber = $request->input('phoneNumber');
        $token = $request->input('token');
        $user = Auth::user();

        if ($phoneNumber != null) {
            $user->phoneNumber = $phoneNumber;
            $user->save();

            $otp = new Otp();
            $key = $otp->totp($user->totpSecret);

            $client->messages->create($user->phoneNumber,
              [
                  "from" => env('TWILIO_PHONE_NUMBER'),
                  "body" => 'Use this code to log in: ' . $key
              ]);

            $successMessage = 'An SMS has been sent to the '
                . 'phone number you entered. When you get the SMS, enter the code in the SMS where '
                . 'it says "Enter your verification code" below.';

            return view('enable-tfa-via-sms', ['successMessage' => $successMessage]);
        }
        return view('enable-tfa-via-sms');
    }
}
