<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonalServicesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.personalServices');
    }

    public function psi() {
        return view('clientPanel.IncomeLayouts.psi');
    }

    public function PersonalServiceIncomeFormDataSave(Request $request) {

        $mode = $request->mode;
        $personal_service_inc_id = $request->personal_service_inc_id;
        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "description_of_psi" => $request->description_of_psi,
            "income" => $request->income,
            "tax_withheld" => $request->tax_withheld,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_personal_serv_inc")->where("personal_service_inc_id", $personal_service_inc_id)->update($data);
            if ($update) {
                return response()->json($data);
            }
        } else {
            $insert = DB::table("inc_personal_serv_inc")->insert($data);
            if ($insert) {
                return response()->json($data);
            }
        }
    }

}
