<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EnableTfaViaSmsController extends Controller
{
    public function enableTfaViaSmsPage()
    {
        return view('enable-tfa-via-sms');
    }
}
