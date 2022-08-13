<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\SubmenuPermission;
use App\States;
use App\Cities;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller {

    public function signUpData(Request $request) {
        $dataa = array(
            "user_email" => $request->form_email,
            "user_name" => $request->form_username,
            "user_password" => $request->form_password,
            "tax_year" => $request->form_option,
        );
        $last_id = DB::table('tbl_users')->insertGetId($dataa);
        for ($i = 14; $i < 17; $i++) {
            $data1 = array(
                "user_id" => $last_id,
                "submenu_id" => $i,
                "mainmenu_id" => '1',
                "status" => '1',
            );
            $insert = DB::table("tbl_submenu_permi")->insert($data1);
        }
        return view("client-layouts.confirmation");
    }

    public function checklistSelect(Request $request) {

        $tbl_submenu_perss = DB::table("tbl_submenu_permi")->select('*')
                ->where("user_id", Auth::User()->id)
                ->where("submenu_id", $request->submenu_id)
                ->where("mainmenu_id", $request->mainmenu_id)
                ->where("checklist_menu_id", $request->checklistmenu_id)
                ->where("tax_year_id", Session::get('tax_year_id'))
                ->get();
        $status = '';
        foreach ($tbl_submenu_perss as $subper) {
            $status = $subper->status;
        }

        if (count($tbl_submenu_perss) > 0 && $status == 0) {
            $data = array(
                "status" => '1',
            );
            $update = DB::table("tbl_submenu_permi")
                    ->where("user_id", Auth::User()->id)
                    ->where("submenu_id", $request->submenu_id)
                    ->where("mainmenu_id", $request->mainmenu_id)
                    ->where("checklist_menu_id", $request->checklistmenu_id)
                    ->where("status", $status)
                    ->where("tax_year_id", Session::get('tax_year_id'))
                    ->update($data);
            if ($update) {
                return response()->json($request->submenu_id);
            }
        } else if (count($tbl_submenu_perss) > 0 && $status == 1) {
            $data = array(
                "status" => '0',
            );
            $update = DB::table("tbl_submenu_permi")
                    ->where("user_id", Auth::User()->id)
                    ->where("submenu_id", $request->submenu_id)
                    ->where("mainmenu_id", $request->mainmenu_id)
                    ->where("checklist_menu_id", $request->checklistmenu_id)
                    ->where("status", $status)
                    ->where("tax_year_id", Session::get('tax_year_id'))
                    ->update($data);
            if ($update) {
                return response()->json($request->submenu_id);
            }
        } else if (count($tbl_submenu_perss) == 0) {
            $data1 = array(
                "user_id" => Auth::User()->id,
                "submenu_id" => $request->submenu_id,
                "mainmenu_id" => $request->mainmenu_id,
                "checklist_menu_id" => $request->checklistmenu_id,
                "status" => '1',
                "tax_year_id" => Session::get('tax_year_id'),
            );
            $insert = DB::table("tbl_submenu_permi")->insert($data1);
            if ($insert) {
                return response()->json($request->submenu_id);
            }
        }
    }

    public function findState(Request $request) {
        $data = States::select('state_id', 'state_name')->where('country_id', $request->country_id)->get();
        return response()->json($data);
    }

    public function findCities(Request $request) {
        $data = Cities::select('city_id', 'city_name')->where('state_id', $request->state_id)->get();
        return response()->json($data);
    }

    public function GetPreciousPostalAddresss(Request $request) {

        $data = DB::table('tbl_basic_info')->select('prev_postal_line1', 'prev_postal_line2', 'prev_postal_postcode', 'prev_postal_suburb', 'prev_postal_state', 'prev_postal_country')
                ->where('user_id', Auth::User()->id)
                ->whereNotNull('prev_postal_line1')
                ->whereNotNull('prev_postal_line2')
                ->where('prev_postal_postcode', '!=', 0)
                ->where('prev_postal_state', '!=', 0)
                ->where('prev_postal_country', '!=', 0)
                ->get();
        return response()->json($data);
    }

    public function GetHomePostalAddress(Request $request) {

        $data = DB::table('tbl_basic_info')->select('home_address_line1', 'home_address_line2', 'home_address_post_code', 'home_address_suburb', 'home_address_state', 'home_address_country')
                ->where('user_id', Auth::User()->id)
                ->whereNotNull('home_address_line1')
                ->whereNotNull('home_address_line2')
                ->where('home_address_post_code', '!=', 0)
                ->where('home_address_suburb', '!=', 0)
                ->where('home_address_state', '!=', 0)
                ->where('home_address_country', '!=', 0)
                ->get();
        return response()->json($data);
    }

    public function GetPreviousName(Request $request) {
        $data = DB::table('tbl_basic_info')->select('pevious_title', 'previous_first_name', 'previous_middle_name', 'previous_last_name')
                ->where('user_id', Auth::User()->id)
                ->whereNotNull('previous_first_name')
                ->whereNotNull('previous_middle_name')
                ->whereNotNull('previous_last_name')
                ->where('pevious_title', '!=', 0)
                ->get();
        return response()->json($data);
    }

    public function SuburbAjaxPro(Request $request) {
        $data = DB::table('tbl_suburb')->select('suburb_id as id', 'suburb_name as text')->where('suburb_name', 'like', '%' . $request->q . '%')->take(20)->get();
        return response()->json($data);
    }

}
