<?php

namespace App\Http\Controllers\Client\Deduction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OtherExpensesController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.DeductionLayouts.otherExpenses');
    }
    public function deprecativeDeduction() {
        return view('clientPanel.DeductionLayouts.deprecativeDeduction');
    }
    public function OtherDeductibleExpenses() {
        return view('clientPanel.DeductionLayouts.OtherDeductibleExpenses');
    }
    public function DeprecativeDeducDataSave(Request $request) {
        $mode = $request->mode;
        $depreciation_deduc_id = $request->depreciation_deduc_id;
        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "brief_description" => $request->brief_description,
            "original_cost" => $request->original_cost,
            "property_type_id" => $request->property_type_id,
            "description_method_id" => $request->description_method_id,
            "first_use_date" =>date('Y-m-d', strtotime(str_replace('/', '-', $request->first_use_date))),
            "business_use" => $request->business_use,
            "life_in_year" => $request->life_in_year,
            "part_of_year_id" => $request->part_of_year_id,
            "depreciation_rate" => $request->depreciation_rate,
            "sell_or_dispose_yes_no_id" => $request->sell_or_dispose_yes_no_id,
        );
       
         if (isset($mode) && $mode == '1') {
            $update = DB::table("deduc_depreciation_deduction")->where("depreciation_deduc_id", $depreciation_deduc_id)->where("user_id", Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->update($data);
        } else {
           $insert = DB::table("deduc_depreciation_deduction")->insert($data);
        }
    }
    
    
    public function OtherDeducFormDataSave(Request $request) {
        $mode = $request->mode;
        $other_expense_id = $request->other_expense_id;
        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "description" => $request->description,
            "other_deduc_expen_id" => $request->other_deduc_expen_id,
            "amount" => $request->amount,
            
        );
       
         if (isset($mode) && $mode == '1') {
            $update = DB::table("deduc_other_expenses")->where("other_expense_id", $other_expense_id)->where("user_id", Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->update($data);
        } else {
           $insert = DB::table("deduc_other_expenses")->insert($data);
        }
    }
    public function OtherExpensesSa(Request $request) {
        $mode = $request->mode;
        $description = $request->description;
        $amount = $request->amount;
         $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        
        if (isset($mode) && $mode == '1') {
            $delete = DB::table('deduc_other_expenses_main')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();
            
       foreach ($amount as $index => $dep) {
                $data = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "description" => $description[$index],
                    "amount" => $amount[$index],
                );
                $insert = DB::table("deduc_other_expenses_main")->insert($data);
            }
        }else{
              foreach ($amount as $index => $dep) {
                $data = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "description" => $description[$index],
                    "amount" => $amount[$index],
                );
                $insert = DB::table("deduc_other_expenses_main")->insert($data);
            }
         
        }
           $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }
}
