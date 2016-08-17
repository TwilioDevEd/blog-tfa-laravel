<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Auth;

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
            $users = User::where('email', $email)->get();
            if (sizeof($users) > 0) {
                return view('signup', ['errorMessage' => 'That email is already in use']);
            } else {
                $user = new User;
                $user->email = $email;
                $user->password = bcrypt($password1);
                $user->name = $email;
                $user->save();
                if (Auth::loginUsingId($user->id)) {
                   return redirect()->intended('/user/');
                }
            }
        }
    }
}
