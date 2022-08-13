<?php

namespace App\Http\Controllers\Client\PersonalInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\BasicInfo;
use Illuminate\Support\Facades\Session;

class PersonalInfoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function basicInfo(Request $request) {
        return view('clientPanel.PersonalinfoLayouts.basicinfo');
    }

    public function BasicInfoInsert(Request $request) {
        /*
      _token=r5h6R1Dzs9e6TW835cQgj66MwrHTCaZODmPjUj5H&tax_file_number=1235684&mode=1&basicinfo_id=4&title=1&first_name=MIZAN&suffix=SR&last_name=HAU&pevious_title=0&previous_first_name=&previous_middle_name=&previous_last_name=&date_of_birth=26%2F12%2F2019&phone=01714522292&email=abcd%40gmail.com&email_tax_tips=1&postal_address_changed=1&home_postal_address_same=2&line1=fasd&line2=fasdf&post_code=sdfasd&suburb=1&state=4&country=13&prev_postal_line1=sdfa&prev_postal_line2=fasdf&prev_postal_postcode=sdfasd&prev_postal_suburb=1&prev_postal_state=4&prev_postal_country=17&homeAddressLine1=adsfa&homeAddressLine2=sadfas&homeAddressPostCode=asdf&homeAddressSuburb=2&homeAddressState=5&homeAddressCountry=13 */
        $mode = $request->mode;
        $basicinfo_id = $request->basicinfo_id;

        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "tax_file_number" => $request->tax_file_number,
            "title_id" => $request->title,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "middle_name" => $request->suffix,
            "name_title_changed" => $request->name_title_changed,
            "date_of_birth" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date_of_birth))),
            "contact_phone" => $request->phone,
            "contact_email" => $request->email,
            "email_tax_tips" => $request->email_tax_tips,
            "postal_address_changed" => $request->postal_address_changed,
            "home_postal_address_same" => $request->home_postal_address_same,
            "inter_postal_address" => $request->inter_postal_address,
            "line1" => $request->line1,
            "line2" => $request->line2,
            "postcode" => $request->post_code,
            "suburb" => $request->suburb,
            "state" => $request->state,
            "country" => $request->country,
            "pevious_title" => $request->pevious_title,
            "previous_first_name" => $request->previous_first_name,
            "previous_middle_name" => $request->previous_middle_name,
            "previous_last_name" => $request->previous_last_name,
            "prev_postal_line1" => $request->prev_postal_line1,
            "prev_postal_line2" => $request->prev_postal_line2,
            "prev_postal_postcode" => $request->prev_postal_postcode,
            "prev_postal_suburb" => $request->prev_postal_suburb,
            "prev_postal_state" => $request->prev_postal_state,
            "prev_postal_country" => $request->prev_postal_country,
            "home_address_line1" => $request->homeAddressLine1,
            "home_address_line2" => $request->homeAddressLine2,
            "home_address_post_code" => $request->homeAddressPostCode,
            "home_address_suburb" => $request->homeAddressSuburb,
            "home_address_state" => $request->homeAddressState,
            "home_address_country" => $request->homeAddressCountry,
        );

        if ($mode == '1') {
            $update = DB::table("tbl_basic_info")->where("basicinfo_id", $basicinfo_id)->update($data);
            if ($update) {
                return response()->json($data);
                die();
            }
        } else {
            $insert = DB::table("tbl_basic_info")->insert($data);
            if ($insert) {
                return response()->json($data);
            }
        }
        return response()->json($data);
    }

}
