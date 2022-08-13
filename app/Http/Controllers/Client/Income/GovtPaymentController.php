<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GovtPaymentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.govtPayment');
    }

    public function DataSave(Request $request) {
  $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;

        $mode = $request->mode;
        $govt_payment_id = $request->govt_payment_id;

        $govt_pension = $request->govt_pension;
        $descr_govt_payment = $request->descr_govt_payment;

        $data = array(
            "user_id" => Auth::User()->id,
             "tax_year_id" => Session::get('tax_year_id'),
            "govt_pension" => $request->govt_pension,
            "descr_govt_payment" => $request->descr_govt_payment,
        );
        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_govt_payment")->where("govt_payment_id", $govt_payment_id)->where("user_id", Auth::User()->id)->update($data);
        } else {
            $insert_id = DB::table('inc_govt_payment')->insertGetId($data);
        }


        $description = $request->description;
        $income = $request->income;
        $tax_withheld = $request->tax_withheld;
        $days_receive = $request->days_receive;

        if (isset($mode) && $mode == '1') {
            $delete = DB::table('inc_govt_payment_sub')->where('user_id', Auth::User()->id)->delete();
            foreach ($income as $index => $dep) {
                $data1 = array(
                    "govt_payment_id" => $govt_payment_id,
                    "user_id" => Auth::User()->id,
                     "tax_year_id" => Session::get('tax_year_id'),
                    "govt_payment_desc_id" => $description[$index],
                    "income" => $income[$index],
                    "tax_withheld" => $tax_withheld[$index],
                    "days_receive" => $days_receive[$index],
                );
                $insert = DB::table("inc_govt_payment_sub")->insert($data1);
            }
        } else {

            foreach ($income as $index => $dep) {
                $data1 = array(
                    "govt_payment_id" => $insert_id,
                    "user_id" => Auth::User()->id,
                     "tax_year_id" => Session::get('tax_year_id'),
                    "govt_payment_desc_id" => $description[$index],
                    "income" => $income[$index],
                    "tax_withheld" => $tax_withheld[$index],
                    "days_receive" => $days_receive[$index],
                );
                $insert = DB::table("inc_govt_payment_sub")->insert($data1);
            }
        }


         $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
