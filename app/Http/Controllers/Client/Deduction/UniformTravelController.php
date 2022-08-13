<?php

namespace App\Http\Controllers\Client\Deduction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UniformTravelController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.DeductionLayouts.uniformTravel');
    }

    public function DataSave(Request $request) {
        $mode = $request->mode;
        $mode2 = $request->mode2;
        $description = $request->description;
        $uniformfype_id = $request->uniformfype_id;
        $specifi_expense_id = $request->specifi_expense_id;
        $expense_amt = $request->expense_amt;
 $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;

        $descriptionTwo = $request->descriptionTwo;
        $amountTwo = $request->amountTwo;

        if (isset($mode) && $mode == '1') {
            $delete = DB::table('deduc_uniform_travel_first')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();

            foreach ($expense_amt as $index => $dep) {
                $data = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "description" => $description[$index],
                    "uniformfype_id" => $uniformfype_id[$index],
                    "specifi_expense_id" => $specifi_expense_id[$index],
                    "expense_amount" => $expense_amt[$index],
                );
                $insert = DB::table("deduc_uniform_travel_first")->insert($data);
            }
        } else {

            foreach ($expense_amt as $index => $dep) {
                $data1 = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "description" => $description[$index],
                    "uniformfype_id" => $uniformfype_id[$index],
                    "specifi_expense_id" => $specifi_expense_id[$index],
                    "expense_amount" => $expense_amt[$index],
                );
                $insert = DB::table("deduc_uniform_travel_first")->insert($data1);
            }
        }
        if (isset($mode2) && $mode2 == '1') {
            $delete = DB::table('deduc_uniform_travel_second')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();

            foreach ($amountTwo as $index => $dep) {
                $data = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "descriptionTwo" => $descriptionTwo[$index],
                    "amountTwo" => $amountTwo[$index],
                );
                $insert = DB::table("deduc_uniform_travel_second")->insert($data);
            }
        } else {
            foreach ($amountTwo as $index => $dep) {
                $data = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "descriptionTwo" => $descriptionTwo[$index],
                    "amountTwo" => $amountTwo[$index],
                );
                $insert = DB::table("deduc_uniform_travel_second")->insert($data);
            }
        }
         $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
