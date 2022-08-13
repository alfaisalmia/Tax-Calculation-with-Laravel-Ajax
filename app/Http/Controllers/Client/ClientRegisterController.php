<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class clientRegisterController extends Controller {

    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        return view('client-layouts.signup');
    }

}
