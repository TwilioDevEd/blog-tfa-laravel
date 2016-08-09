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
        $errorMessage = '';
        if ($email == NULL || $password == NULL) {
            $errorMessage = 'Incorrect Email or Password';
            return view('index', ['errorMessage' => $errorMessage]);
        } else {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return redirect()->intended('user');
            } else {
                $errorMessage = 'Incorrect Email or Password';
                return view('index', ['errorMessage' => $errorMessage]);
            }
        }
        
        
    }
}
