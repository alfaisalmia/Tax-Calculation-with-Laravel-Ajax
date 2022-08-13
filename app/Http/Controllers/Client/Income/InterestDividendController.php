<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InterestDividendController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.interestDividendMain');
    }

    public function interestIncome() {
        return view('clientPanel.IncomeLayouts.interestDividend');
    }

    public function dividendIncome() {
        return view('clientPanel.IncomeLayouts.dividendIncome');
    }

    public function InterestIncomeFormDataSave(Request $request) {
        $mode = $request->mode;
        $interest_inc_id = $request->interest_inc_id;
        $data = array(
            "user_id" => Auth::User()->id,
             "tax_year_id" => Session::get('tax_year_id'),
            "bank_name" => $request->bank_name,
            
            "gross_interest" => $request->gross_interest,
            "tfn_amt_deduc" => $request->tfn_amt_deduc,
        );
       if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_interest_income")->where("interest_inc_id", $interest_inc_id)->update($data);
            if ($update) {
                return response()->json($data);
            }
        } else {
            $insert = DB::table("inc_interest_income")->insert($data);
            if ($insert) {
                return response()->json($data);
            }
        }
    }

    public function DividendIncomeFormDataSave(Request $request) {
        $mode = $request->mode;
        $dividend_inc_id = $request->dividend_inc_id;
        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "company_name" => $request->company_name,
            "unfranked_amt" => $request->unfranked_amt,
            "franked_amt" => $request->franked_amt,
            "franking_credit" => $request->franking_credit,
            "tfn_amt_deduct" => $request->tfn_amt_deduct,
        );

       if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_dividend_income")->where("dividend_inc_id", $dividend_inc_id)->update($data);
            if ($update) {
                return response()->json($data);
            }
        } else {
            $insert = DB::table("inc_dividend_income")->insert($data);
            if ($insert) {
                return response()->json($data);
            }
        }
    }
    public function InterestDividendSaveGo(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;

         $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
    }

}
