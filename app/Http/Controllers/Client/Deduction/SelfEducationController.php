<?php

namespace App\Http\Controllers\Client\Deduction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SelfEducationController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.DeductionLayouts.selfEducation');
    }

    public function form() {
        return view('clientPanel.DeductionLayouts.selfEduForm');
    }

    public function depriciationDeduction() {
        return view('clientPanel.DeductionLayouts.depriciationDeduction');
    }

    public function SelfEduFormSave(Request $request) {
//        $mainmenu_id = $request->mainmenu;
//        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $self_education_main_id = $request->self_education_main_id;

        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "course_desc" => $request->course_desc,
            "current_job_descr" => $request->current_job_descr,
            "institution_name" => $request->institution_name,
            "majority_selfeducation_exp_id" => $request->majority_selfeducation_exp_id,
        );
           if (isset($mode) && $mode == '1') {
            $update = DB::table("deduc_self_education_main")->where("self_education_main_id", $self_education_main_id)->update($data);
        } else {
             $insert_id = DB::table('deduc_self_education_main')->insertGetId($data);
        }
        
         $description = $request->description;
        $amount = $request->amount;
       
          if (isset($mode) && $mode == '1') {
          $delete = DB::table('deduc_self_education_sub')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->delete();
            foreach ($amount as $index => $dep) {
                $data1 = array(
                    "self_education_main_id" => $self_education_main_id,
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "course_related_expenses_id" => $description[$index],
                    "Amount" => $amount[$index],
                );
                $insert = DB::table("deduc_self_education_sub")->insert($data1);
            }
          }else{
               foreach ($amount as $index => $dep) {
                $data1 = array(
                    "self_education_main_id" => '1',
                    "user_id" => Auth::User()->id,
                    "tax_year_id" => Session::get('tax_year_id'),
                    "course_related_expenses_id" => $description[$index],
                    "amount" => $amount[$index],
                );
                $insert = DB::table("deduc_self_education_sub")->insert($data1);
            }
          }
        
    }
    public function DeprecativeDeducDataSaveSelf(Request $request) {
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
            $update = DB::table("deduc_depreciation_deduction_self")->where("depreciation_deduc_id", $depreciation_deduc_id)->where("user_id", Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->update($data);
        } else {
           $insert = DB::table("deduc_depreciation_deduction_self")->insert($data);
        }
    }
}

