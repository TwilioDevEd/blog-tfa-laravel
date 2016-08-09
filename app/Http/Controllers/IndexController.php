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
        $email = $request->input('email');
        $password = $request->input('password');
        $isAuthenticated = Auth::attempt(['email' => $email, 'password' => $password]);

        if (!$isAuthenticated) {
            return view('index', ['errorMessage' => 'Incorrect Email or Password']);
        } else {
            return redirect()->intended('/user/');
        }
    }
}
