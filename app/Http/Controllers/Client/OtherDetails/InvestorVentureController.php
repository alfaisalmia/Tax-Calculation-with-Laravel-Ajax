<?php

namespace App\Http\Controllers\Client\OtherDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvestorVentureController extends Controller
{
        public function __construct() {
         $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.OtherDetailsLayouts.investorVenture');
    }
    public function second() {
        return view('clientPanel.OtherDetailsLayouts.investorVenture2');
    }
    public function InvestVentureSave(Request $request) {
         $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $investor_venture_id = $request->investor_venture_id;
   
            $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "capital_partnership_yes_no_id" => $request->capital_partnership_yes_no_id,
            "invest_early_state_yes_no_id" => $request->invest_early_state_yes_no_id,
            "cxploration_credits_yes_no_id" => $request->cxploration_credits_yes_no_id,
        );

        if (isset($mode) && $mode == '1') {
           $update = DB::table("od_investor_venture")->where("investor_venture_id", $investor_venture_id)->update($data);
        } else {
            $insert = DB::table("od_investor_venture")->insert($data);
       }
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }
}
