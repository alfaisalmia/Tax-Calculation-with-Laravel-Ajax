
@extends("clientPanel.clientPanelMaster")
@section('title', 'Capital Gains -Sale of Shares')
@section("content")
<?php
$rental_income_id = "";
$user_id = "";
$brief_description = "";
$address = "";
$post_code = "";
$suburb = "";
$state = "";
$percentage = "";
$purchase_price = "";
$purchase_date = "";
$first_rental_date = "";
$number_weeks = "";
$gross_rental_income = "";
$other_rental_income = "";
$rental_losses = "";
$advertising = "";
$body_corporate_fee = "";
$borrowing_expenses = "";
$cleaning = "";
$council_rates = "";
$gardening = "";
$insurance = "";
$land_tax = "";
$legal_fees = "";
$interest_on_loans = "";
$pest_control = "";
$property_agent_fee = "";
$repair_maintenance = "";
$statinary_telephone_postage = "";
$sundry_rental_expenses = "";
$water_charge = "";
$division_40_plant = "";
$division_43_capital = "";
$capital_allowance = "";
$capital_works_deduction = "";
$total_expenses = "";

$rentalIncome = DB::table('inc_rental_income')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
if (count($rentalIncome) > 0) {
    foreach ($rentalIncome as $ri) {
        $rental_income_id = $ri->rental_income_id;
        $user_id = $ri->user_id;
        $brief_description = $ri->brief_description;
        $address = $ri->address;
        $post_code = $ri->post_code;
        $suburb = $ri->suburb;
        $state = $ri->state;
        $percentage = $ri->percentage;
        $purchase_price = $ri->purchase_price;
        $purchase_date = $ri->purchase_date;
        $first_rental_date = $ri->first_rental_date;
        $number_weeks = $ri->number_weeks;
        $gross_rental_income = $ri->gross_rental_income;
        $other_rental_income = $ri->other_rental_income;
        $rental_losses = $ri->rental_losses;
        $advertising = $ri->advertising;
        $body_corporate_fee = $ri->body_corporate_fee;
        $borrowing_expenses = $ri->borrowing_expenses;
        $cleaning = $ri->cleaning;
        $council_rates = $ri->council_rates;
        $gardening = $ri->gardening;
        $insurance = $ri->insurance;
        $land_tax = $ri->land_tax;
        $legal_fees = $ri->legal_fees;
        $interest_on_loans = $ri->interest_on_loans;
        $pest_control = $ri->pest_control;
        $property_agent_fee = $ri->property_agent_fee;
        $repair_maintenance = $ri->repair_maintenance;
        $statinary_telephone_postage = $ri->statinary_telephone_postage;
        $sundry_rental_expenses = $ri->sundry_rental_expenses;
        $water_charge = $ri->water_charge;
        $division_40_plant = $ri->division_40_plant;
        $division_43_capital = $ri->division_43_capital;
        $capital_allowance = $ri->capital_allowance;
        $capital_works_deduction = $ri->capital_works_deduction;
        $total_expenses = $ri->total_expenses;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-9 col-lg-9">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Rental Income</h3>
                    <h5>Report the income and expenses of your rental property. All expenses you enter on this page will be apportioned according to the ownership percent. If you rented a portion of your home, and you paid expenses that apply to both your home and rental unit, you will need to calculate the relevant expenses based on the floor area of your rental unit divided by the total floor area of your home. If you are an ABN holder, you must NOT include that income here. That income should be reported as a Business Schedule.
                    </h5>
                    <h5 class="color_blue">Property Information:
                    </h5>
                </div>

                <div class="col-sm-12 "> 
                    <form id="RentalIncomeFormElement">
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                  echo '<input type="hidden" class="form-control" id="rental_income_id" name="rental_income_id" value="' . $rental_income_id . '">';
                        }
                        ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="brief_description">Brief Description:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                    <input type="text" class="form-control" id="brief_description" name="brief_description" value="{{$brief_description}}" onkeypress="return isNumber(event)" onfocus="$('.msg').text('Requird');" onblur="$('.msg').empty();">
                                </div><span class="msg"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address"> Address </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>

                                    <input type="text" class="form-control" id="address" name="address" value="{{$address}}">          
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="post_code"> Post Code</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>

                                    <input type="text" class="form-control" id="post_code" name="post_code" value="{{$post_code}}">          
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="suburb">Suburb</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>

                                    <input type="text" class="form-control" id="suburb" name="suburb" value="{{$suburb}}">          
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state"> State </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="assets_category" class="form-control" name="state">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $states = DB::table('tbl_state')->select('state_id', 'state_name')->get();
                                        foreach ($states as $s) {
                                            if ($state == $s->state_id) {
                                                echo '<option value="' . $s->state_id . '" selected >' . $s->state_name . '</option>';
                                            } else {
                                                echo '<option value="' . $s->state_id . '">' . $s->state_name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="percentage_of_ownership"> Percentage of ownership:
                                    (All income and expenses will be calculated according to this percentage amount) </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-percent color_blue"></i></span>

                                    <input type="text" class="form-control" id="percentage_of_ownership" name="percentage_of_ownership" value="{{$percentage}}" onkeypress="return isNumber(event)" maxlength="3">          
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="purchase_price"> Purchase Price of the Property</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>

                                    <input type="text" class="form-control" id="purchase_price" name="purchase_price" value="{{$purchase_price}}" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="date_purchased">Date of Purchase</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calculator color_blue"></i></span>
                                    <input type="text" class="form-control datepicker" id="date_purchased" name="date_purchased" value="{{ \Carbon\Carbon::parse($purchase_date)->format('d/m/Y')}}" >          
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="date_rental_inc">Date of first rental income </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                    <input type="text" class="form-control datepicker" id="date_rental_inc" name="date_rental_inc" value="{{ \Carbon\Carbon::parse($first_rental_date)->format('d/m/Y')}}">          
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="purchase_price">Number of weeks the property was rented or available to rent</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="number_weeks" name="number_weeks" value="{{$number_weeks}}" onkeypress="return isNumber(event)" maxlength="2">          
                                </div><span class="color_blue"><i>Week must be between 1-52</i></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="gross_rental_income">Gross Rental Income</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="gross_rental_income" name="gross_rental_income" value="{{$gross_rental_income}}" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="otherRentalIncome">Other Rental Related Income</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="otherRentalIncome" name="otherRentalIncome" value="{{$other_rental_income}}" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="RentalLosses">Rental Losses Carried Forward from a Prior Year</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="rental_losses" name="rental_losses" value="{{$rental_losses}}" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>
                        <hr>


                        <h5 class="color_blue">Expenses</h5>
                        <div id="addExpesehere">

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="advertising">Advertising</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="advertising" name="advertising" value="{{$advertising}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="body_corporate_fee">Body Corporate Fees</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="body_corporate_fee" name="body_corporate_fee" value="{{$body_corporate_fee}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="borrowing_expenses">Borrowing Expenses </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="borrowing_expenses" name="borrowing_expenses" value="{{$borrowing_expenses}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cleaning">Cleaning</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="cleaning" name="cleaning" value="{{$cleaning}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="council_rates">Council Rates</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="council_rates" name="council_rates" value="{{$council_rates}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="gardening">Gardening</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="gardening" name="gardening" value="{{$gardening}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>

                            </div>   <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="insurance">Insurance</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="insurance" name="insurance" value="{{$insurance}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="land_tax">Land Tax</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="land_tax" name="land_tax" value="{{$land_tax}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="legal_fees">Legal Fees </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="legal_fees" name="legal_fees" value="{{$legal_fees}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>

                            </div>   <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="interest_on_loans">Interest on Loans </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="interest_on_loans" name="interest_on_loans" value="{{$interest_on_loans}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pest_control">Pest Control</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="pest_control" name="pest_control" value="{{$pest_control}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="property_agent_fee">Property Agent Fees</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="property_agent_fee" name="property_agent_fee" value="{{$property_agent_fee}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>

                            </div>   <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="repair_maintenance">Repairs/Maintenance </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="repair_maintenance" name="repair_maintenance" value="{{$repair_maintenance}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="statinary_telephone_postage">Stationary, Telephone Postage</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="statinary_telephone_postage" name="statinary_telephone_postage" value="{{$statinary_telephone_postage}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sundry_rental_expenses">Sundry Rental Expenses </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="sundry_rental_expenses" name="sundry_rental_expenses" value="{{$sundry_rental_expenses}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="water_charge">Water Charges </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="water_charge" name="water_charge" value="{{$water_charge}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>

                            </div>




                        </div>
                        <h5 class="color_blue">Depreciation of Assets (Capital Allowances and Works)</h5>  <div class="row">

                            <div class="col-md-5 col-md-offset-4">
                                <a href="{{URL('/income/businessRental/RentalIncome')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add a Depreciation Record</a><br/>
                            </div>
                        </div> <br/>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="division_40_plant"> Deprecation Deduction from Divison 40 Plant and Equipment from a Quantity Surveyor</label>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="division_40_plant" name="division_40_plant" value="{{$division_40_plant}}" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="division_43_capital"> Depreciation Deduction from Divison 43 Capital Works from a Quantity Surveyor</label>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="division_43_capital" name="division_43_capital" value="{{$division_43_capital}}" onkeypress="return isNubmer(event)">          
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="capital_allowance"> Capital Allowances from the Above Grid:</label>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="capital_allowance" name="capital_allowance" value="{{$capital_allowance}}">          
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="capital_works_deduction"> Capital Works Deduction from the Above Grid:</label>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="capital_works_deduction" name="capital_works_deduction" value="{{$capital_works_deduction}}">          
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="total_expenses"> Total Expenses:</label>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="total_expenses" name="total_expenses" value="{{$total_expenses}}">          
                                </div>
                            </div>
                        </div>  
                    </form>

                </div>

                <div class="form-group col-sm-12">
                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                    <button type="button" class="btn btn-success btn-sm" onclick="RentalIncomeFormDataSave()"><i class="fa fa-forward"></i> <?php
                        if (isset($user_id) && $user_id > 0) {
                            echo "Update and Go";
                        } else {
                            echo "Save and Go";
                        }
                        ?></button>

                </div>
                </form>

            </div>
        </div>
    </div>

</div>
</div>
<script>
    function RentalIncomeFormDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('RentalIncomeFormDataSave')}}',
            data: $("#RentalIncomeFormElement").serialize(),
            success: function (data) {
              window.location.href = "{{URL::to('income/businessRental')}}";
            },
            error: function () {
                alert("Failed ! Please try again later.");
            }
        });
    }
</script>
<
@stop