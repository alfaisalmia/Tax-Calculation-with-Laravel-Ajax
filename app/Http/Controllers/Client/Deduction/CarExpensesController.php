<?php

namespace App\Http\Controllers\Client\Deduction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CarExpensesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function carExpenses() {
        return view('clientPanel.DeductionLayouts.carExpenses');
    }

    public function vehicleExpenses() {
        return view('clientPanel.DeductionLayouts.vehicleExpenses');
    }

    public function CarExpenFormDataSave(Request $request) {
        $mainmenu_id = $request->mainmenu;
        $submenu_id = $request->submenu;
        $mode = $request->mode;
        $car_expense_id = $request->car_expense_id;

        $data = array(
            "user_id" => Auth::User()->id,
            "tax_year_id" => Session::get('tax_year_id'),
            "car_model_year" => $request->car_model_year,
            "vehicle_explain" => $request->vehicle_explain,
            "killometer_traveled" => $request->killometer_traveled,
            "engintype_capacity_id" => $request->engintype_capacity_id,
            "cost_price" => $request->cost_price,
            "date_purchased" => date('Y-m-d', strtotime($request->date_purchased)),
            "maintain_log_book_yes_no" => $request->maintain_log_book_yes_no,
            "sell_yes_no" => $request->sell_yes_no,
        );
        if (isset($mode) && $mode == '1') {
            $update = DB::table("deduc_car_expenses")->where("car_expense_id", $car_expense_id)->update($data);
        } else {
            $insert = DB::table("deduc_car_expenses")->insert($data);
        }
          $lastURL = GetTheNextURL($mainmenu_id, $submenu_id, url('/'));
                return response()->json($lastURL);
    }

}
