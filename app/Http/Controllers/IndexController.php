<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    public function getIndex()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        if ($username == NULL || $password == NULL) {
            $errorMessage = 'Incorrect Username or Password';
        }
        return view('index', ['errorMessage' => $errorMessage]);
    }
}
