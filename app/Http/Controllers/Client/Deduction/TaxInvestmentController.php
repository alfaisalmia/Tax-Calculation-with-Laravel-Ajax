<?php

namespace App\Http\Controllers\Client\Deduction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaxInvestmentController extends Controller
{
      public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.DeductionLayouts.taxInvestment');
    }
     public function TaxInvestmentSave(Request $request) {

        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $description = $request->description;
        $tax_lodgement_expenses_id = $request->tax_lodgement_expenses_id;
        $amount = $request->amount;
        $mode = $request->mode;

        if (isset($mode) && $mode == '1') {
            $delete = DB::table('deduc_tax_investment')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();
            foreach ($amount as $index => $dep) {
                $data1 = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "description" => $description[$index],
                    "tax_lodgement_expenses_id" => $tax_lodgement_expenses_id[$index],
                    "amount" => $amount[$index],
                );
                $insert = DB::table("deduc_tax_investment")->insert($data1);
            }
        } else {
               foreach ($amount as $index => $dep) {
                $data1 = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "description" => $description[$index],
                    "tax_lodgement_expenses_id" => $tax_lodgement_expenses_id[$index],
                    "amount" => $amount[$index],
                );
                $insert = DB::table("deduc_tax_investment")->insert($data1);
            }
        }
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
       return response()->json($lastURL);
    }
}
