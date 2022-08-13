<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EmployeeShareController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.employeeShare');
    }

    public function schemes() {
        return view('clientPanel.IncomeLayouts.employeeShareSchemes');
    }

    public function EmployeeShareFormDataSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $employee_share_scheme_id = $request->employee_share_scheme_id;
        $data = array(
            "user_id" => Auth::User()->id,
             "tax_year_id" => Session::get('tax_year_id'),
            "employer_name" => $request->employer_name,
            "employer_abn" => $request->employer_abn,
            "discount_tax_eligible" => $request->discount_tax_eligible,
            "discount_tax_not_eligible" => $request->discount_tax_not_eligible,
            "discount_deferral_schemes" => $request->discount_deferral_schemes,
            "discount_on_ess" => $request->discount_on_ess,
            "tfn_amounts" => $request->tfn_amounts,
            "foreign_discounts" => $request->foreign_discounts,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_employee_share_scheme")->where("employee_share_scheme_id", $employee_share_scheme_id)->where("user_id", Auth::User()->id)->update($data);
        } else {
            $insert = DB::table("inc_employee_share_scheme")->insert($data);
        }
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
