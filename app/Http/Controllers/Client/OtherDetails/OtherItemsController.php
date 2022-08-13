<?php

namespace App\Http\Controllers\Client\OtherDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OtherItemsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.OtherDetailsLayouts.otherItems');
    }

    public function OtherItemsSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $other_details_id = $request->other_details_id;
        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "hecs_balance" => $request->hecs_balance,
            "sfss_balance" => $request->sfss_balance,
            "tsl_balance" => $request->tsl_balance,
            "ssl_balance" => $request->ssl_balance,
            "MedicareLevyExemption_yes_no_id" => $request->MedicareLevyExemption_yes_no_id,
            "exemption_id" => $request->exemption_id,
            "days_for_exemption" => $request->days_for_exemption,
            "exemption_category_id" => $request->exemption_category_id,
        );

        if (isset($mode) && $mode == '1') {
           $update = DB::table("od_other_details")->where("other_details_id", $other_details_id)->update($data);
        } else {
            $insert = DB::table("od_other_details")->insert($data);
        }
         $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
