<?php

namespace App\Http\Controllers\Client\OtherDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherDetailsController extends Controller
{
       public function __construct() {
         $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.OtherDetailsLayouts.OtherDetailMain');
    }
}
