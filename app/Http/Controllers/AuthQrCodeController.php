<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Otp\GoogleAuthenticator;
use App\Http\Requests;
use Auth;
use Base32\Base32;

class AuthQrCodeController extends Controller
{
    public function qrcode()
    {
        $user = Auth::user();
        $label = $user->password;
        $secret = $user->totpSecret;
        $otpauthUrl = 'otpauth://totp/' . $label .'?secret=' . Base32::encode($secret);

        return view('auth-qr-code', ['otpauthUrl' => $otpauthUrl]);
    }
    
}
