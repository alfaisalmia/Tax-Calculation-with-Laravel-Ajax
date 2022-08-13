<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CapitalGainsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.capitalGains');
    }

    public function saleOfShare() {
        return view('clientPanel.IncomeLayouts.saleOfShare');
    }

    public function import() {
        return view('clientPanel.IncomeLayouts.capitalGainsimport');
    }

    public function CapitalGainsDataSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $capital_gains_main_id = $request->capital_gains_main_id;
        // $mode = "1";
        //$capital_gains_main_id = "1";
// For Edit
        if (isset($mode) && $mode == '1') {
            $data = array(
                "user_id" => Auth::User()->id,
                "tax_year_id" => Session::get('tax_year_id'),
                "prior_year_capital_loss" => $request->prior_year_capital_loss,
                "any_credits_for_amt" => $request->any_credits_for_amt,
            );
            $update = DB::table("inc_capital_gains_main")->where("capital_gains_main_id", $capital_gains_main_id)->where("user_id", Auth::User()->id)->update($data);
            // Update of First Table Start from here
            $trust_fund_code = $request->trust_fund_code;
            $trust_fund_name = $request->trust_fund_name;
            $trust_fund_amt = $request->trust_fund_amt;
            $delete = DB::table('inc_capital_gain_sub1')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();
            
            foreach ($trust_fund_code as $index => $dep) {
                $data1 = array(
                    "capital_gain_main_id" => $capital_gains_main_id,
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "trust_fund_code" => $trust_fund_code[$index],
                    "trust_fund_name" => $trust_fund_name[$index],
                    "trust_fund_amt" => $trust_fund_amt[$index],
                );
                $insert = DB::table("inc_capital_gain_sub1")->insert($data1);
            }
            // Update First Table End !
            // Start Second Table Insert
            $manage_fund = $request->manage_fund;
            $manage_fund_non_disc = $request->manage_fund_non_disc;
            $discount_Gain = $request->discount_Gain;
            $capital_loss = $request->capital_loss;
            
            $delete = DB::table('inc_capital_gain_sub2')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();
            
            foreach ($manage_fund as $index => $dep) {
                $data2 = array(
                    "capital_gain_main_id" => $capital_gains_main_id,
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "manage_fund_name" => $manage_fund[$index],
                    "manage_fund_non_disc" => $manage_fund_non_disc[$index],
                    "discount_Gain" => $discount_Gain[$index],
                    "capital_loss" => $capital_loss[$index],
                );
                $insert = DB::table("inc_capital_gain_sub2")->insert($data2);
            }
        } else {
            $data = array(
                "user_id" => Auth::User()->id,
                "tax_year_id" => Session::get('tax_year_id'),
                "prior_year_capital_loss" => $request->prior_year_capital_loss,
                "any_credits_for_amt" => $request->any_credits_for_amt,
            );
            $insert_id = DB::table('inc_capital_gains_main')->insertGetId($data);
            // First Table
            $trust_fund_code = $request->trust_fund_code;
            $trust_fund_name = $request->trust_fund_name;
            $trust_fund_amt = $request->trust_fund_amt;

            foreach ($trust_fund_code as $index => $dep) {
                $data1 = array(
                    "capital_gain_main_id" => $insert_id,
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "trust_fund_code" => $trust_fund_code[$index],
                    "trust_fund_name" => $trust_fund_name[$index],
                    "trust_fund_amt" => $trust_fund_amt[$index],
                );
                $insert = DB::table("inc_capital_gain_sub1")->insert($data1);
            }

            // Second Table
            $manage_fund = $request->manage_fund;
            $manage_fund_non_disc = $request->manage_fund_non_disc;
            $discount_Gain = $request->discount_Gain;
            $capital_loss = $request->capital_loss;
            foreach ($manage_fund as $index => $dep) {
                $data2 = array(
                    "capital_gain_main_id" => $insert_id,
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "manage_fund_name" => $manage_fund[$index],
                    "manage_fund_non_disc" => $manage_fund_non_disc[$index],
                    "discount_Gain" => $discount_Gain[$index],
                    "capital_loss" => $capital_loss[$index],
                );
                $insert = DB::table("inc_capital_gain_sub2")->insert($data2);
            }
        }
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

    public function SaleOfShareFormDataSave(Request $request) {
        $mode = $request->mode;
        $sale_of_share = $request->sale_of_share;
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;

        if (isset($mode) && $mode == '1') { // Update data of Sale of Sales
            $data = array(
                "user_id" => Auth::User()->id,
                "tax_year_id" => Session::get('tax_year_id'),
                "tax_year_id" => Session::get('tax_year_id'),
                "own_interest" => $request->ownership_interest,
                "description" => $request->description,
                "assest_category" => $request->assets_category,
                "assest_type" => $request->asset_type,
                "date_purchased" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date_purchased))),
                "date_sold" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date_sold))),
                "purchase_price" => $request->purchase_price,
                "sale_price" => $request->sale_price,
            );
            $update = DB::table("inc_sale_of_shares")->where("sale_of_share", $sale_of_share)->where("user_id", Auth::User()->id)->update($data);

            // Update Code of Sale of Shares - Table Name (inc_sale_of_share_sub)
            $expense_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->expense_date)));
            $expense_description = $request->expense_description;
            $expense_amt = $request->expense_amt;
             $delete = DB::table('inc_sale_of_share_sub')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();
            foreach ($expense_date as $index => $dep) {
                $data2 = array(
                    "sale_of_share_id" => $sale_of_share,
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "expense_date" => $expense_date[$index],
                    "expense_descr" => $expense_description[$index],
                    "expense_amt" => $expense_amt[$index],
                );
                $insert = DB::table("inc_sale_of_share_sub")->insert($data2);
            }
        } else {       //Insert data 
            $data = array(
                "user_id" => Auth::User()->id,
                "tax_year_id" => Session::get('tax_year_id'),
                "tax_year_id" => Session::get('tax_year_id'),
                "own_interest" => $request->ownership_interest,
                "description" => $request->description,
                "assest_category" => $request->assets_category,
                "assest_type" => $request->asset_type,
                "date_purchased" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date_purchased))),
                "date_sold" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date_sold))),
                "purchase_price" => $request->purchase_price,
                "sale_price" => $request->sale_price,
            );
            $insert_id = DB::table('inc_sale_of_shares')->insertGetId($data);

            // Insert for Sub Table

            $expense_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->expense_date)));
            $expense_description = $request->expense_description;
            $expense_amt = $request->expense_amt;
            foreach ($expense_date as $index => $dep) {
                $data2 = array(
                    "sale_of_share_id" => $insert_id,
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "expense_date" => $expense_date[$index],
                    "expense_descr" => $expense_description[$index],
                    "expense_amt" => $expense_amt[$index],
                );
                $insert = DB::table("inc_sale_of_share_sub")->insert($data2);
            }
        }
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
