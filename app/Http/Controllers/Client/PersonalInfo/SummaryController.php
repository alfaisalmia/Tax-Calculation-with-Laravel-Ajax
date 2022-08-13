<?php

namespace App\Http\Controllers\Client\PersonalInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SummaryController extends Controller
{
         public function __construct() {
         $this->middleware('auth');
    }

    public function index() {
       return view('clientPanel.PersonalinfoLayouts.summaryinfo');
    }
}
