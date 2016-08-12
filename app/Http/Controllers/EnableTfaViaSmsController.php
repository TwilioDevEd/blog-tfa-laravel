<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use Twilio\Rest\Client;
use Otp\Otp;

class EnableTfaViaSmsController extends Controller
{
    public function enableTfaViaSmsPage()
    {
        return view('enable-tfa-via-sms');
    }

    public function enableTfaViaSms(Request $request, Client $client, Otp $otp)
    {
        $phoneNumber = $request->input('phoneNumber');
        $token = $request->input('token');
        $user = Auth::user();
        
        if ($phoneNumber != null) {
            $user->phoneNumber = $phoneNumber;
            $user->save();

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
        } else if ($token != null && $otp->checkTotp($user->totpSecret, $token)) {
            $user->enableTfaViaSms = true;
            $user->save();

            $successMessage = 'You are set up for Two-Factor Authentication via Twilio SMS!';
            return view('enable-tfa-via-sms', ['successMessage' => $successMessage]);
        } else {
            $errorMessage = 'There was an error verifying your token. Please try again.';
            return view('enable-tfa-via-sms', ['errorMessage' => $errorMessage]);
        }
    }
}
