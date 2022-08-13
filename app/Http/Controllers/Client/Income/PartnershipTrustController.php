<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PartnershipTrustController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.partnershipTrust');
    }

    public function PartnerShipFormDataSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $partnership_trust_id = $request->partnership_trust_id;

        $data = array(
            "user_id" => Auth::User()->id,
             "tax_year_id" => Session::get('tax_year_id'),
            "name_of_entity" => $request->name_of_entity,
            "type_of_entity" => $request->type_of_entity,
            "type_of_entity2" => $request->type_of_entity2,
            "distribution_amount" => $request->distribution_amount,
            "land_water_deduction" => $request->land_water_deduction,
            "other_deduction" => $request->other_deduction ,
            "prior_year_non_com" => $request->prior_year_non_com,
            "partnership_share_of_small" => $request->partnership_share_of_small,
            "share_of_credit" => $request->share_of_credit,
            "share_credit_amt" => $request->share_credit_amt,
            "share_national_rental" => $request->share_national_rental,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_partnership_trust")->where("partnership_trust_id", $partnership_trust_id)->update($data);
            if ($update) {
                $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
            }
            $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
            return response()->json($lastURL);
        } else {
            $insert = DB::table("inc_partnership_trust")->insert($data);
            if ($insert) {
                $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
            }
        }
    }

}
