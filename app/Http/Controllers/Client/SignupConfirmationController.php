<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignupConfirmationController extends Controller
{
    public function signupConfirmation(Request $request){
        return view('client-layouts.confirmation');
    }
}
