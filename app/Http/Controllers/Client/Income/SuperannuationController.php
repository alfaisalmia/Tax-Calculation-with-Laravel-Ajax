<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuperannuationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.superannuation');
    }

    public function incomeStream() {
        return view('clientPanel.IncomeLayouts.superannuationIncomeStream');
    }

    public function lumsumPayments() {
        return view('clientPanel.IncomeLayouts.superannuationLumsumPayments');
    }

    public function SuperannuationFormDataSave(Request $request) {

        $mode = $request->mode;
        $superannuation_inc_id = $request->superannuation_inc_id;

        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "payer_abn" => $request->payer_abn,
            "payer_name" => $request->payer_name,
            "tax_withheld" => $request->tax_withheld,
            "taxed_element" => $request->taxed_element,
            "untax_element" => $request->untax_element,
            "amt_benifit_inc" => $request->amt_benifit_inc,
            "amt_of_uup" => $request->amt_of_uup,
            "tax_offset_amt_yn" => $request->tax_offset_amt_yn,
            "tax_offset_amt" => $request->tax_offset_amt,
            "tax_element" => $request->tax_element,
            "untaxed_element" => $request->untaxed_element,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_superannuation_inc")->where("superannuation_inc_id", $superannuation_inc_id)->update($data);
            if ($update) {
                return response()->json($data);
            }
        } else {
            $insert = DB::table("inc_superannuation_inc")->insert($data);
            if ($insert) {
                return response()->json($data);
            }
        }
    }

    public function DataSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $lum_sum_pay_id = $request->lum_sum_pay_id;
        $data = array(
            "user_id" => Auth::User()->id,
             "tax_year_id" => Session::get('tax_year_id'),
            "payer_abn" => $request->payer_abn,
            "payer_name" => $request->payer_name,
            "date_of_payment" =>date('Y-m-d', strtotime(str_replace('/', '-', $request->date_of_payment))),
            "taxed_element" => $request->taxed_element,
            "tax_withheld" => $request->tax_withheld,
            "untax_element" => $request->untax_element,
            "detath_benefits_yes_no_id" => $request->detath_benefits_yes_no_id,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_superannuation_lump_sum_pay")->where("lum_sum_pay_id", $lum_sum_pay_id)->where("user_id", Auth::User()->id)->update($data);
        } else {
            $insert = DB::table("inc_superannuation_lump_sum_pay")->insert($data);
        }
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
