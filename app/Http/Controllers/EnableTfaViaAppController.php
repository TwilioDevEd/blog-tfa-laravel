<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Otp\Otp;
use App\Http\Requests;

class EnableTfaViaAppController extends Controller
{
    public function enableTfaViaAppPage()
    {
        return view('enable-tfa-via-app');
    }

    public function enableTfaViaApp(Request $request, Otp $otp)
    {
        $token = $request->input('token');
        $user = Auth::user();
        if ($token != null && $otp->checkTotp($user->totpSecret, $token)) {
            $user->enableTfaViaApp = true;
            $user->save();
            return view('enable-tfa-via-app');
        } else {
            $errorMessage = 'There was an error verifying your token. Please try again.';
            return view('enable-tfa-via-app', ['errorMessage' => $errorMessage]);
        }
        return view('enable-tfa-via-app'); 
    }
}
