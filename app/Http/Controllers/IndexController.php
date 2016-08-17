<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class IndexController extends Controller
{
    public function getIndex()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $email = strtolower($request->input('email'));
        $password = $request->input('password');
        $isAuthenticated = Auth::once(['email' => $email, 'password' => $password]);

        if (!$isAuthenticated) {
            return view('index', ['errorMessage' => 'Incorrect Email or Password']);
        } else {
            $user = Auth::user();

            if ($user->enableTfaViaSms || $user->enableTfaViaApp) {
                $request->session()->put('tmp_user', $user);
                $request->session()->put('stage', 'password-validated');

                return redirect()->intended('/verify-tfa/');
            } else {
                // Add to session
                Auth::attempt(['email' => $email, 'password' => $password]);
                return redirect()->intended('/user/');
            }
            
        }
    }
}
