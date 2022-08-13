<?php

namespace App\Http\Controllers\Client\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BusinessRentalController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('clientPanel.IncomeLayouts.businessRental');
    }

    public function businessIncome() {
        return view('clientPanel.IncomeLayouts.businessIncome');
    }

    public function RentalIncome() {
        return view('clientPanel.IncomeLayouts.rentalIncome');
    }

    public function nonPSI() {
        return view('clientPanel.IncomeLayouts.nonPSI');
    }

    public function BusinessIncomeDataSave(Request $request) {
        // Insert Business Incom Form Data 
        $mode = $request->mode;
        $business_income_id = $request->business_income_id;

        $data = array(
            "user_id" => Auth::User()->id,
             "tax_year_id" => Session::get('tax_year_id'),
            "main_busi_activity" => $request->main_busi_activity,
            "business_name" => $request->business_name,
            "busi_address" => $request->busi_address,
            "post_code" => $request->post_code,
            "suburb" => $request->suburb,
            "state" => $request->state,
            "primary_non_primary" => $request->primary_non_primary,
            "internet_uses" => $request->internet_uses,
            "business_abn" => $request->business_abn,
            "status_of_business" => $request->status_of_business,
            "total_income_above" => $request->total_income_above,
            "total_other_business_inc" => $request->total_other_business_inc,
            "govt_indus_payment" => $request->govt_indus_payment,
            "total_income" => $request->total_income,
            "value_of_opening_stock" => $request->value_of_opening_stock,
            "purchase_of_stock" => $request->purchase_of_stock,
            "value_of_closing_stock" => $request->value_of_closing_stock,
            "cost_of_sales_type" => $request->cost_of_sales_type,
            "total_cost_sales" => $request->total_cost_sales,
            "contractor_commission" => $request->contractor_commission,
            "internet_expense" => $request->internet_expense,
            "lease" => $request->lease,
            "rent" => $request->rent,
            "repairs_maintenance" => $request->repairs_maintenance,
            "salary_wages" => $request->salary_wages,
            "superannuation" => $request->superannuation,
            "low_cost_assets" => $request->low_cost_assets,
            "general_post_assets" => $request->general_post_assets,
            "total_expenses" => $request->total_expenses,
            "total_depreciation" => $request->total_depreciation,
            "total_vehicle_expense" => $request->total_vehicle_expense,
            "total_business_income" => $request->total_business_income,
            "partnarship_or_sole" => $request->partnarship_or_sole,
            "deferred_loss" => $request->deferred_loss,
        );

        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_business_income")->where("business_income_id", $business_income_id)->where("user_id", Auth::User()->id)->update($data);
        } else {
            $insert_id = DB::table('inc_business_income')->insertGetId($data);
        }

        // Other Business Income Insert Start
        if (isset($mode) && $mode == '1') {
            $other_inc_description = $request->other_inc_description;
            $other_inc_amt = $request->other_inc_amt;

            foreach ($other_inc_amt as $index => $dep) {
                $data1 = array(
                    "business_income_id" => $business_income_id,
                    "user_id" => Auth::User()->id,
                     "tax_year_id" => Session::get('tax_year_id'),
                    "other_inc_description" => $other_inc_description[$index],
                    "other_inc_amt" => $other_inc_amt[$index],
                );
                $update = DB::table("inc_business_income_sub_other_inc")->where("business_income_id", $business_income_id)->where("user_id", Auth::User()->id)->update($data1);
            }
        } else {
            $other_inc_description = $request->other_inc_description;
            $other_inc_amt = $request->other_inc_amt;

            foreach ($other_inc_amt as $index => $dep) {
                $data1 = array(
                    "business_income_id" => $insert_id,
                    "user_id" => Auth::User()->id,
                     "tax_year_id" => Session::get('tax_year_id'),
                    "other_inc_description" => $other_inc_description[$index],
                    "other_inc_amt" => $other_inc_amt[$index],
                );
                $insert = DB::table("inc_business_income_sub_other_inc")->insert($data1);
            }
        }

        // Other Expense Insert Start
        if (isset($mode) && $mode == '1') {
            $other_exp_description = $request->other_exp_description;
            $other_exp_amt = $request->other_exp_amt;

            foreach ($other_exp_amt as $index => $dep) {
                $data2 = array(
                    "business_income_id" => $business_income_id,
                    "user_id" => Auth::User()->id,
                     "tax_year_id" => Session::get('tax_year_id'),
                    "other_exp_description" => $other_exp_description[$index],
                    "other_exp_amt" => $other_exp_amt[$index],
                );
                $update = DB::table("inc_business_income_sub_other_exp")->where("business_income_id", $business_income_id)->where("user_id", Auth::User()->id)->update($data2);
            }
        } else {

            $other_exp_description = $request->other_exp_description;
            $other_exp_amt = $request->other_exp_amt;

            foreach ($other_exp_amt as $index => $dep) {
                $data2 = array(
                    "business_income_id" => $insert_id,
                    "user_id" => Auth::User()->id,
                     "tax_year_id" => Session::get('tax_year_id'),
                    "other_exp_description" => $other_exp_description[$index],
                    "other_exp_amt" => $other_exp_amt[$index],
                );
                $insert = DB::table("inc_business_income_sub_other_exp")->insert($data2);
            }
        }
    }

    public function RentalIncomeFormDataSave(Request $request) {
        $mode = $request->mode;
        $rental_income_id = $request->rental_income_id;

        $data = array(
            "user_id" => Auth::User()->id,
             "tax_year_id" => Session::get('tax_year_id'),
            "brief_description" => $request->brief_description,
            "address" => $request->address,
            "post_code" => $request->post_code,
            "suburb" => $request->suburb,
            "state" => $request->state,
            "percentage" => $request->percentage_of_ownership,
            "purchase_price" => $request->purchase_price,
            "purchase_date" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date_purchased))),
            "first_rental_date" => date('Y-m-d', strtotime(str_replace('/', '-', $request->date_rental_inc))),
            "number_weeks" => $request->number_weeks,
            "gross_rental_income" => $request->gross_rental_income,
            "other_rental_income" => $request->otherRentalIncome,
            "rental_losses" => $request->rental_losses,
            "advertising" => $request->advertising,
            "body_corporate_fee" => $request->body_corporate_fee,
            "borrowing_expenses" => $request->borrowing_expenses,
            "cleaning" => $request->cleaning,
            "council_rates" => $request->council_rates,
            "gardening" => $request->gardening,
            "insurance" => $request->insurance,
            "land_tax" => $request->land_tax,
            "legal_fees" => $request->legal_fees,
            "interest_on_loans" => $request->interest_on_loans,
            "pest_control" => $request->pest_control,
            "property_agent_fee" => $request->property_agent_fee,
            "repair_maintenance" => $request->repair_maintenance,
            "statinary_telephone_postage" => $request->statinary_telephone_postage,
            "sundry_rental_expenses" => $request->sundry_rental_expenses,
            "water_charge" => $request->water_charge,
            "division_40_plant" => $request->division_40_plant,
            "division_43_capital" => $request->division_43_capital,
            "capital_allowance" => $request->capital_allowance,
            "capital_works_deduction" => $request->capital_works_deduction,
            "total_expenses" => $request->total_expenses,
        );
        if (isset($mode) && $mode == '1') {
            $update = DB::table("inc_rental_income")->where("rental_income_id", $rental_income_id)->where("user_id", Auth::User()->id)->update($data);
        } else {
            $insert = DB::table("inc_rental_income")->insert($data);
        }
      
            return response()->json($data);
      
    }

}
