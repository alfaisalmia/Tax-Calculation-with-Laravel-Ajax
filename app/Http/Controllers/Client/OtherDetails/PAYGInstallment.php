<?php

namespace App\Http\Controllers\Client\OtherDetails;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PAYGInstallment extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.OtherDetailsLayouts.paygInstallment');
    }

    public function paygInstallmentsave(Request $request) {

        $mode = $request->mode;
        $month_id = $request->month_id;
        $amount = $request->amount;
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;

        if (isset($mode) && $mode == '1') {
            $delete = DB::table('od_payg_installment')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();

            foreach ($amount as $index => $dep) {
                $data = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "month_id" => $month_id[$index],
                    "amount" => $amount[$index],
                );
                $insert = DB::table("od_payg_installment")->insert($data);
            }
        } else {
            foreach ($amount as $index => $dep) {
                $data = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "month_id" => $month_id[$index],
                    "amount" => $amount[$index],
                );
                $insert = DB::table("od_payg_installment")->insert($data);
            }
        }
       $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
       return response()->json($lastURL);
    }

}
