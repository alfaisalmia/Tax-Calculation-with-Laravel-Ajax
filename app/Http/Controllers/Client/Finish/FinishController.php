<?php

namespace App\Http\Controllers\Client\Finish;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FinishController extends Controller
{
   public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.FinishLayouts.finish');
    }
}
