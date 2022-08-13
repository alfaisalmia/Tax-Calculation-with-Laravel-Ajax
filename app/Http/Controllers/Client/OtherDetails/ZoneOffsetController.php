<?php

namespace App\Http\Controllers\Client\OtherDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ZoneOffsetController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.OtherDetailsLayouts.zoneOffset');
    }

    public function ZoneOffsetSaveData(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $zone_offset_id = $request->zone_offset_id;

        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "zoneA_days_resided" => $request->zoneA_days_resided,
            "zoneA_allowances_received" => $request->zoneA_allowances_received,
            "zoneB_days_resided" => $request->zoneB_days_resided,
            "zoneB_allowances_received" => $request->zoneB_allowances_received,
            "specialArea_days_resided" => $request->specialArea_days_resided,
            "specialArea_allowances_received" => $request->specialArea_allowances_received,
            "OverseasForces_days_resided" => $request->OverseasForces_days_resided,
            "OverseasForces_allowances_received" => $request->OverseasForces_allowances_received,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("od_zone_offset")->where("zone_offset_id", $zone_offset_id)->update($data);   
        } else {
            $insert = DB::table("od_zone_offset")->insert($data);
        }
         $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
