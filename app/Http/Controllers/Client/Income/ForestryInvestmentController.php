<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ForestryInvestmentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.forestyInvestment');
    }

    public function DataSave(Request $request) {
         $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        
        
        $description = $request->description;
        $amount = $request->amount;
        $mode = $request->mode;

        if (isset($mode) && $mode == '1') {
            $delete = DB::table('inc_forestry_invest_income')->where('user_id', Auth::User()->id)->delete();
            foreach ($amount as $index => $dep) {
                $data1 = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "description" => $description[$index],
                    "Amount" => $amount[$index],
                );
                $insert = DB::table("inc_forestry_invest_income")->insert($data1);
            }
        } else {
            foreach ($amount as $index => $dep) {
                $data1 = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "description" => $description[$index],
                    "Amount" => $amount[$index],
                );
                $insert = DB::table("inc_forestry_invest_income")->insert($data1);
            }
        }



        $code = $request->code;
        $year = $request->year;
        $number = $request->number;
        $deduction_amt = $request->deduction_amt;
        if (isset($mode) && $mode == '1') {
        $delete = DB::table('inc_forestry_invest_deduction')->where('user_id', Auth::User()->id)->delete();
          foreach ($deduction_amt as $index => $dep) {
            $data2 = array(
                "user_id" => Auth::User()->id,
                "tax_year_id" => Session::get('tax_year_id'),
                "foresty_investment_code_id" => $code[$index],
                "year" => $year[$index],
                "number" => $number[$index],
                "deduction_amt" => $deduction_amt[$index],
            );
            $insert = DB::table("inc_forestry_invest_deduction")->insert($data2);
        }
        }else{
             foreach ($deduction_amt as $index => $dep) {
            $data2 = array(
                "user_id" => Auth::User()->id,
                "tax_year_id" => Session::get('tax_year_id'),
                "foresty_investment_code_id" => $code[$index],
                "year" => $year[$index],
                "number" => $number[$index],
                "deduction_amt" => $deduction_amt[$index],
            );
            $insert = DB::table("inc_forestry_invest_deduction")->insert($data2);
        }
       
        }
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
