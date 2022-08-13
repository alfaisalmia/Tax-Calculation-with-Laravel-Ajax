<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalaryAndWagesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.salaryAndWages');
    }

    public function paygPaymentSummary() {
        return view('clientPanel.IncomeLayouts.paygPaymentSummary');
    }

    public function PayPaymentSummaryAdd(Request $request) {
        Session::forget('salary_occupation');
        Session::put('mainmenu', $request->mainmenu);
        Session::put('submenu', $request->submenu);
        Session::put('salary_occupation', $request->salary_occupation);
        return response()->json($request->salary_occupation);
    }

    public function PaygPaymentSummarySave(Request $request) {

        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;


        $mode = $request->mode;
        $salary_wages_id = $request->salary_wages_id;

        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "salary_occupation" => $request->salary_occupation,
            "total_tax_withheld" => $request->total_tax_withheld,
            "gross_payment" => $request->gross_payment,
            "cdep_payments" => $request->cdep_payments,
            "foreign_employment_income" => $request->cdep_payments,
            "reportable_fringe_benefits_amt" => $request->reportable_fringe_benefits_amt,
            "report_emp_superannuation_contr" => $request->report_emp_superannuation_contr,
            "lumpsum_payment_a" => $request->lumpsum_payment_a,
            "lumpsum_payment_b" => $request->lumpsum_payment_b,
            "lumpsum_payment_d" => $request->lumpsum_payment_d,
            "lumpsum_payment_e" => $request->lumpsum_payment_e,
            "allowance_desc_1" => $request->allowance_desc_1,
            "allowance_amt_1" => $request->allowance_amt_1,
            "allowance_desc_2" => $request->allowance_desc_2,
            "allowance_amt_2" => $request->allowance_amt_2,
            "allowance_desc_3" => $request->allowance_desc_3,
            "allowance_amt_3" => $request->allowance_amt_3,
            "allowance_desc_4" => $request->allowance_amt_3,
            "allowance_amt_4" => $request->allowance_amt_4,
            "union_assos_fee_des_1" => $request->allowance_amt_4,
            "union_assos_fee_amt_1" => $request->union_assos_fee_amt_1,
            "union_assos_fee_des_2" => $request->union_assos_fee_des_2,
            "union_assos_fee_amt_2" => $request->union_assos_fee_amt_2,
            "workplace_desc" => $request->workplace_desc,
            "workplace_amt" => $request->workplace_amt,
            "payer_name" => $request->payer_name,
            "payer_abn" => $request->payer_abn,
            "check_if_wpn" => $request->check_if_wpn,
        );
        
  if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_salary_wages")->where("salary_wages_id", $salary_wages_id)->update($data); 
            if ($update) {
                $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
          
            }
             $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
        } else {
            $insert = DB::table("inc_salary_wages")->insert($data);
            if ($insert) {
                $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
            }
        }
    }

    public function SalaryAndWagesSave(Request $request) {
        $submenu_id = $request->submenu_id;
        $mainmenu_id = $request->mainmenu_id;
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
