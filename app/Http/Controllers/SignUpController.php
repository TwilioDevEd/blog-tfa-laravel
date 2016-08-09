<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SignUpController extends Controller
{
    public function signUpPage()
    {
        return view('signup');
    }
}
