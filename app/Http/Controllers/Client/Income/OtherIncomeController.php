<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OtherIncomeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.otherIncome');
    }

    public function OtherIncomeFormDataSave(Request $request) {
        $mode = $request->mode;
        $other_incom_id = $request->other_incom_id;
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
//        $mode = 1;
//        $other_incom_id = 1;
//        $mainmenu_id = 2;
//        $submenu_id = 13;
        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "payer_abn" => $request->payer_abn,
            "allowance_other_income_id" => $request->description,
            "income" => $request->income,
            "tax_withheld" => $request->tax_withheld,
        );
        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_other_income")->where("other_incom_id", $other_incom_id)->where("user_id", Auth::User()->id)->update($data);
        } else {
            $insert = DB::table("inc_other_income")->insert($data);
        }

        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
