<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class SignUpController extends Controller
{
    public function signUpPage()
    {
        return view('signup');
    }

    public function signUp(Request $request)
    {
        $email = strtolower($request->input('email'));
        $password1 = $request->input('password1');
        $password2 = $request->input('password2');
        if ($password1 != $password2) {
            return view('signup', ['errorMessage' => 'Passwords do not match.']);
        } else {
            $users = DB::table('users')->where('email', $email)->get();
            if (!empty($users)) {
                return view('signup', ['errorMessage' => 'That email is already in use']);
            } else {
                return view('signup');
            }
        }
    }
}
