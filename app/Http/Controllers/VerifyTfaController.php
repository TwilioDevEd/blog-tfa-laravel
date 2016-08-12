<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Otp\Otp;
use App\Http\Requests;
use Auth;
use DB;

class VerifyTfaController extends Controller
{
    public function verifyTfaPage(Request $request, Client $client)
    {
        $otp = new Otp();
        $user = $request->session()->get('tmp_user');
        $key = $otp->totp($user->totpSecret);

        $client->messages->create($user->phoneNumber,
          [
              "from" => env('TWILIO_PHONE_NUMBER'),
              "body" => 'Use this code to log in: ' . $key
          ]);

        return view('verify-tfa', ['user' => $user]);
    }

    public function verifyTfa(Request $request)
    {
        $user = $request->session()->get('tmp_user');
        $otp = new Otp();

        if ($user == null) {
            return view('verify-tfa', ['errorMessage' => 'Error - no credentials']);
        } else if ($request->session()->get('stage') != 'password-validated') {
            return view('verify-tfa', ['errorMessage' => 'Password is not validated']);
        } else {
            $token = $request->input('token');
            if ($otp->checkTotp($user->totpSecret, $token)) {
                Auth::login($user);
                $request->session()->put('stage', 'logged-in');
                return redirect()->intended('/user/');
            } else {
                $errorMessage = 'There was an error verifying your token. Please try again.';
                return view('verify-tfa', ['errorMessage' => $errorMessage]);
            }
        }
    }
}
