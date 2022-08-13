<?php

namespace App\Http\Controllers\Client\OtherDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MedicalExpensesController extends Controller
{
       public function __construct() {
         $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.OtherDetailsLayouts.medicalExpenses');
    }
     public function MedicalExpeSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $medical_expense_id = $request->medical_expense_id;
        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "disability_aid_exp" => $request->disability_aid_exp,
            "attendant_care_exp" => $request->attendant_care_exp,
            "aged_care_exp" => $request->aged_care_exp,
            "total_exp" => $request->total_exp,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("od_medical_expense")->where("medical_expense_id", $medical_expense_id)->update($data);
        }else{
            $insert = DB::table("od_medical_expense")->insert($data);
        }
         $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
     }
}
