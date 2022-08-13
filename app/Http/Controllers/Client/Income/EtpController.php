<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EtpController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.etp');
    }

    public function EtpFormDataSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $etp_id = $request->etp_id;

        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "payers_abn" => $request->payers_abn,
            "payers_name" => $request->payers_name,
            "date_of_payment" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date_of_payment))),
            "taxable_component" => $request->taxable_component,
            "tax_withheld" => $request->tax_withheld,
            "type_of_payment" => $request->type_of_payment,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_etp")->where("etp_id", $etp_id)->update($data);
            if ($update) {
                $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
            }
            $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
            return response()->json($lastURL);
        } else {
            $insert = DB::table("inc_etp")->insert($data);
            if ($insert) {
                $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
            }
        }
    }

}
