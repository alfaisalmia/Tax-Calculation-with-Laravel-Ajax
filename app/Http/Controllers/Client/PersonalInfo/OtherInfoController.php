<?php

namespace App\Http\Controllers\Client\PersonalInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OtherInfoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.PersonalinfoLayouts.otherInformation');
    }

    public function OtherInformationSave(Request $request) {

        
        
        
        $mode = $request->mode;
        $other_info_id = $request->other_info_id;
        $data = array(
            "other_info_id" => $request->other_info_id,
            "user_id" => Auth::User()->id,
            "resident_of_australia" => $request->nonResident,
            "australian_citizenship" => $request->citizenship,
            "dependants_in_finance" => $request->dependants,
            "spouse_in_finance" => $request->spouseInFinancial,
            "higher_edu_loan" => $request->higherEducationLoan,
            "veteran_or_widower" => $request->veteran,
            "unable_to_disability" => $request->financialyeardisability,
            "full_time_edu_first_time" => $request->FullTimeEducation
        );
        if ($mode == '1') {
            $update = DB::table("tbl_other_info")->where("other_info_id", $other_info_id)->update($data);
            if ($update) {
                return response()->json($data);
            }
        } else {
            $insert = DB::table("tbl_other_info")->insert($data);
            if ($insert) {
                return response()->json($data);
            }
        }
    }

}
