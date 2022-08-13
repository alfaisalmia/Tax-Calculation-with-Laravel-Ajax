<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ForeignIncomeController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.foreignIncome');
    }

    public function income() {
        return view('clientPanel.IncomeLayouts.fincome');
    }

    public function ForeignIncomeRadioSave(Request $request) {
        Session::forget('interest_in_assest');
        Session::put('interest_in_assest', $request->interest_in_assest);
        return response()->json($request->interest_in_assest);
    }

    public function ForeignIncomeFormDataSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $foreign_income_id = $request->foreign_income_id;
        $data = array(
            "user_id" => Auth::User()->id,
             "tax_year_id" => Session::get('tax_year_id'),
            "interest_in_assest" => $request->interest_in_assest,
            "description" => $request->description,
            "type" => $request->type,
            "tax_attemp_inc_rec" => $request->tax_attemp_inc_rec,
            "inc_recv_tax" => $request->inc_recv_tax,
            "dedc_expenses" => $request->dedc_expenses,
            "foreign_tax_paid" => $request->foreign_tax_paid,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_foreign_income")->where("foreign_income_id", $foreign_income_id)->where("user_id", Auth::User()->id)->update($data);
        } else {
            $insert = DB::table("inc_foreign_income")->insert($data);
        }
            $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
            return response()->json($lastURL);
        }
        // return response()->json($data);
    }


