<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
