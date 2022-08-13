<?php

namespace App\Http\Controllers\Client\OtherDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PrivateCoverageController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.OtherDetailsLayouts.privateCoverageMain');
    }

    public function PrivateHealthInsurance() {
        return view('clientPanel.OtherDetailsLayouts.PrivateHealthInsurance');
    }

    public function PrivateHealthInsuSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $private_health_insurance = $request->private_health_insurance;

        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "health_insurance_id" => $request->health_insurance_id,
            "membership_number" => $request->membership_number,
            "health_insurance_coverage_type_id" => $request->health_insurance_coverage_type_id,
            "person_covered_number" => $request->person_covered_number,
            "number_of_days" => $request->number_of_days,
            "premium_eligible_aus" => $request->premium_eligible_aus,
            "amount_of_au_govt" => $request->amount_of_au_govt,
            "benefit_code" => $request->benefit_code,
            "premiums_eligible_australian" => $request->premiums_eligible_australian,
            "government_rebate_received" => $request->government_rebate_received,
            "benefit_code2" => $request->benefit_code2,
        );
        if (isset($mode) && $mode == '1') {
            $update = DB::table("od_private_health_insurance")->where("private_health_insurance", $private_health_insurance)->update($data);
        } else {
            $insert = DB::table("od_private_health_insurance")->insert($data);
        }
           $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
