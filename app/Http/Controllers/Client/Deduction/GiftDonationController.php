<?php

namespace App\Http\Controllers\Client\Deduction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GiftDonationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.DeductionLayouts.giftDonation');
    }

    public function GiftDonationDataSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $charity_name = $request->charity_name;
        $donation_value = $request->donation_Value;
        $mode = $request->mode;

        if (isset($mode) && $mode == '1') {
            $delete = DB::table('deduc_gifts_charity')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();
            foreach ($donation_value as $index => $dep) {
                $data1 = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "charity_name" => $charity_name[$index],
                    "donation_value" => $donation_value[$index],
                );
                $insert = DB::table("deduc_gifts_charity")->insert($data1);
            }
        } else {
            foreach ($donation_value as $index => $dep) {
                $data1 = array(
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "charity_name" => $charity_name[$index],
                    "donation_value" => $donation_value[$index],
                );
                $insert = DB::table("deduc_gifts_charity")->insert($data1);
            }
        }
        $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
        return response()->json($lastURL);
    }

}
