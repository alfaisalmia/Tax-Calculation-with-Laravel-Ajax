
@extends("clientPanel.clientPanelMaster")
@section('title', 'Business Income')
@section("content")
<?php
$segment_1 = Request::segment(1);
$segment_2 = Request::segment(2);
$make_submenu_url = $segment_1 . "/" . $segment_2;

$getting_sub_and_mainmenu_id = DB::table('tbl_submenu')->select("submenu_id", "mainmenu_id")->where('submenu_url', $make_submenu_url)->get();
foreach ($getting_sub_and_mainmenu_id as $fs) {
    $mainmenu_id = $fs->mainmenu_id;
    $submenu_id = $fs->submenu_id;
}
$allBusinessIncome = DB::table('inc_business_income')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

$business_income_id = "";
$user_id = "";
$main_busi_activity = "";
$business_name = "";
$busi_address = "";
$post_code = "";
$suburb = "";
$state = "";
$primary_non_primary = "";
$internet_uses = "";
$business_abn = "";
$status_of_business = "";
$total_income_above = "";
$total_other_business_inc = "";
$govt_indus_payment = "";
$total_income = "";
$value_of_opening_stock = "";
$purchase_of_stock = "";
$value_of_closing_stock = "";
$cost_of_sales_type = "";
$total_cost_sales = "";
$contractor_commission = "";
$internet_expense = "";
$lease = "";
$rent = "";
$repairs_maintenance = "";
$salary_wages = "";
$superannuation = "";
$low_cost_assets = "";
$general_post_assets = "";
$total_expenses = "";
$total_depreciation = "";
$total_vehicle_expense = "";
$total_business_income = "";
$partnarship_or_sole = "";
$deferred_loss = "";


if (count($allBusinessIncome) > 0) {
    foreach ($allBusinessIncome as $inc_etp) {
        $business_income_id = $inc_etp->business_income_id;
        $user_id = $inc_etp->user_id;
        $main_busi_activity = $inc_etp->main_busi_activity;
        $business_name = $inc_etp->business_name;
        $busi_address = $inc_etp->busi_address;
        $post_code = $inc_etp->post_code;
        $suburb = $inc_etp->suburb;
        $state = $inc_etp->state;
        $primary_non_primary = $inc_etp->primary_non_primary;
        $internet_uses = $inc_etp->internet_uses;
        $business_abn = $inc_etp->business_abn;
        $status_of_business = $inc_etp->status_of_business;
        $total_income_above = $inc_etp->total_income_above;
        $total_other_business_inc = $inc_etp->total_other_business_inc;
        $govt_indus_payment = $inc_etp->govt_indus_payment;
        $total_income = $inc_etp->total_income;
        $value_of_opening_stock = $inc_etp->value_of_opening_stock;
        $purchase_of_stock = $inc_etp->purchase_of_stock;
        $value_of_closing_stock = $inc_etp->value_of_closing_stock;
        $cost_of_sales_type = $inc_etp->cost_of_sales_type;
        $total_cost_sales = $inc_etp->total_cost_sales;
        $contractor_commission = $inc_etp->contractor_commission;
        $internet_expense = $inc_etp->internet_expense;
        $lease = $inc_etp->lease;
        $rent = $inc_etp->rent;
        $repairs_maintenance = $inc_etp->repairs_maintenance;
        $salary_wages = $inc_etp->salary_wages;
        $superannuation = $inc_etp->superannuation;
        $low_cost_assets = $inc_etp->low_cost_assets;
        $general_post_assets = $inc_etp->general_post_assets;
        $total_expenses = $inc_etp->total_expenses;
        $total_depreciation = $inc_etp->total_depreciation;
        $total_vehicle_expense = $inc_etp->total_vehicle_expense;
        $total_business_income = $inc_etp->total_business_income;
        $partnarship_or_sole = $inc_etp->partnarship_or_sole;
        $deferred_loss = $inc_etp->deferred_loss;
    }
}
?>

<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Business Income</h3>
                    <h5>If you are registered for Goods and Services Tax (GST), all income reported here MUST NOT INCLUDE GST. Also, this form is only to be used for those who are entering or continuing the simplified tax system (STS). Our website does not support non STS businesses. If you are an ABN holder, you must include that income in the Business Schedule below.</h5>
                </div>
                <hr>
                <div class="col-sm-12 ">
                    <form id="business_income_form_element">
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />

                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="etp_id" name="business_income_id" value="' . $business_income_id . '">';
                        }
                        ?>
                        <h5 class="color_blue">Business Information:</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="main_busi_activity">Description of Main Business Activity</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="main_busi_activity" class="form-control" name="main_busi_activity">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $business_activities = DB::table('tbl_business_activity')->select('business_activity_id', 'business_activity_name')->get();
                                        foreach ($business_activities as $business_activitie) {
                                            if ($main_busi_activity == $business_activitie->business_activity_id) {
                                                ?>
                                                <option value="{{$business_activitie->business_activity_id}}" selected="">{{$business_activitie->business_activity_name}}</option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="{{$business_activitie->business_activity_id}}">{{$business_activitie->business_activity_name}}</option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="business_name">Name of Business</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                    <input type="text" class="form-control" id="business_name" name="business_name" value="{{$business_name}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="busi_address">Address </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-address-card color_blue"></i></span>
                                    <input type="text" class="form-control" id="busi_address" name="busi_address" value="{{$busi_address}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="post_code">Post Code</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-code color_blue"></i></span>
                                    <input type="text" class="form-control" id="post_code" name="post_code" value="{{$post_code}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="suburb">Suburb  </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-yen color_blue"></i></span>
                                    <input type="text" class="form-control" id="suburb" name="suburb" value="{{$suburb}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="state">State</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="state" class="form-control" name="state">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $states = DB::table('tbl_state')->select('state_id', 'state_name')->get();
                                        foreach ($states as $st) {
                                            if ($state == $st->state_id) {
                                                ?>
                                                <option value="{{$st->state_id}}" selected="">{{$st->state_name}}</option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="{{$st->state_id}}">{{$st->state_name}}</option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <p>Is your business a primary or non-primary production activity?</p>
                                </div>
                                <div class="input-group col-md-6">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <?php $yesnos = DB::table('tbl_production_type')->select('*')->get(); ?>
                                            @foreach($yesnos as $yn)
                                            <label class="container_radio radio-inline">{{$yn->production_type_name}}
                                                <input type="radio" name="primary_non_primary" value="{{$yn->production_type_id}}" <?php
                                                if ($primary_non_primary == $yn->production_type_id) {
                                                    echo "checked";
                                                }
                                                ?> >
                                                <span class="checkmark_radio"></span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div><br/>

                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <p>Did you sell goods or services using the internet??</p>
                                </div>
                                <div class="input-group col-md-6">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <?php $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get(); ?>
                                            @foreach($yesnos as $yn)
                                            <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                                <input type="radio" name="internet_uses" value="{{$yn->yes_no_id}}" <?php
                                                if ($internet_uses == $yn->yes_no_id) {
                                                    echo "checked";
                                                }
                                                ?> >
                                                <span class="checkmark_radio"></span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div><br/>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="business_abn">Your Business ABN</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                            <input type="text" class="form-control" id="business_abn" name="business_abn" value="{{$business_abn}}" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status_of_business">Status of Business</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                            <select id="status_of_business" class="form-control" name="status_of_business">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $statuss = DB::table('tbl_status_business')->select('status_business_id', 'status_business_name')->get();
                                                foreach ($statuss as $status) {
                                                    if ($status_of_business = $status->status_business_id) {
                                                        ?>

                                                        <option value="{{$status->status_business_id}}" selected="">{{$status->status_business_name}}</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="{{$status->status_business_id}}" >{{$status->status_business_name}}</option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--#######################################################-->
                        <div class="col-sm-12 ">
                            <div class="row">
                                <h5 class="color_blue">Income:</h5>
                                <h6 class="">Income from Labour Hires, Voluntary Agreements, Foreign Resident Withholdings, or Payments where the ABN was not Quoted.</h6>
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <a href="{{URL('/')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; CLICK HERE TO ADD A NEW INCOME RECORD</a><br/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="total_income_above">Total income from the above grid</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="total_income_above" name="total_income_above" value="{{$total_income_above}}" onkeypress="return isNumber(event)"  >
                                    </div>
                                </div>

                            </div>
                            <!--#######################################################-->
                            <hr>
                            <div class="row">
                                <div class="col-sm-8"><h5 class="color_blue">Other Business Income</h5></div></div>
                            <div id="OtherBusinessIncome">
                                <?php if ($user_id != Auth::User()->id) { ?>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Description </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-file-text-o color_blue"></i></span>
                                                <input type="text" class="form-control" id="income" name="other_inc_description[1]" value="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Amount </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="income" name="other_inc_amt[1]" value="" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <button id="AddOtherBusinessIncome" type="button" class="btn btn-warning btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"> Add</i></button>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    $otherBusinessIncomes = DB::table('inc_business_income_sub_other_inc')->select("*")->where('user_id', Auth::User()->id)->where('business_income_id', $business_income_id)->get();
                                    ?>
                                    <div class="col-md-4 col-md-offset-8"><button id="AddOtherBusinessIncome" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"> Add</i></button></div>
                                    <?php
                                    $i = 1;
                                    foreach ($otherBusinessIncomes as $singlec) {
                                        ?>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">Description </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-file-text-o color_blue"></i></span>
                                                    <input type="text" class="form-control" id="income" name="other_inc_description[{{$i}}]" value="{{$singlec->other_inc_description}}">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Amount </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                    <input type="text" class="form-control" id="income" name="other_inc_amt[{{$i}}]" value="{{$singlec->other_inc_amt}}" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>

                                            <div class="col-md-4" style="margin-top: 25px;">
                                                <button id="AddOtherBusinessIncome" type="button" class="DeleteOtherBusinessIncome btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true"> Remove </i></button>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="total_other_business_inc">Total other business income</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                        <input type="text" class="form-control" id="total_other_business_inc" name="total_other_business_inc" value="{{$total_other_business_inc}}" onkeypress="return isNumber(event)" >
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="govt_indus_payment">Assessable government industry payments</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-word-o color_blue"></i></span>
                                        <input type="text" class="form-control" id="govt_indus_payment" name="govt_indus_payment" value="{{$govt_indus_payment}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="total_income">Total Income</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="total_income" name="total_income" value="{{$total_income}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <h5 class="color_blue">Cost of Sales:</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="value_of_opening_stock">Value of Opening Stock</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-word-o color_blue"></i></span>
                                        <input type="text" class="form-control" id="value_of_opening_stock" name="value_of_opening_stock" value="{{$value_of_opening_stock}}">
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="purchase_of_stock">Purchases of Stock</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-word-o color_blue"></i></span>
                                        <input type="text" class="form-control" id="purchase_of_stock" name="purchase_of_stock" value="{{$purchase_of_stock}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="value_of_closing_stock">Value of Closing Stock</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file-word-o color_blue"></i></span>
                                        <input type="text" class="form-control" id="value_of_closing_stock" name="value_of_closing_stock" value="{{$value_of_closing_stock}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">

                                <div class="input-group col-md-6">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <?php $costTypes = DB::table('tbl_cost_sales_type')->select('*')->get(); ?>
                                            @foreach($costTypes as $ct)

                                            <label class="container_radio radio-inline">{{$ct->cost_sales_type_name}}
                                                <input type="radio" name="cost_of_sales_type" value="{{$ct->cost_sales_type_id}}" <?php
                                                if ($cost_of_sales_type == $ct->cost_sales_type_id) {
                                                    echo "checked";
                                                }
                                                ?> ><span class="checkmark_radio"></span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div><br/>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Total Cost of Sales</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="total_cost_sales" name="total_cost_sales" value="{{$total_cost_sales}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <h5 class="color_blue">Expenses:</h5>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="contractor_commission">Contractor Commission</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                        <input type="text" class="form-control" id="contractor_commission" name="contractor_commission" value="{{$contractor_commission}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="internet_expense">Interest Expenses</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                        <input type="text" class="form-control" id="internet_expense" name="internet_expense" value="{{$internet_expense}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lease">Lease </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                        <input type="text" class="form-control" id="lease" name="lease" value="{{$lease}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="rent">Rent  </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                        <input type="text" class="form-control" id="rent" name="rent" value="{{$rent}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="repairs_maintenance">Repairs/Maintenance</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                        <input type="text" class="form-control" id="repairs_maintenance" name="repairs_maintenance" value="{{$repairs_maintenance}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="salary_wages">Salary & Wage</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                        <input type="text" class="form-control" id="salary_wages" name="salary_wages" value="{{$salary_wages}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Superannuation </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                        <input type="text" class="form-control" id="superannuation" name="superannuation" value="{{$superannuation}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="color_blue">Other Expenses</h5>
                            <div id="OtherExpenses">
                                <?php if ($user_id != Auth::User()->id) { ?>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Description </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                                <input type="text" class="form-control" id="income" name="other_exp_description[1]" value="" >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Amount </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="income" name="other_exp_amt[1]" value="" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="margin-top: 25px;">
                                            <button type="button" id="AddOtherExpenses" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>&nbsp;Add</button>
                                        </div>
                                    </div>
                                    <?php
                                } else {

                                    $otherExpenses = DB::table('inc_business_income_sub_other_exp')->select("*")->where('user_id', Auth::User()->id)->where('business_income_id', $business_income_id)->get()
                                    ?>
                                    <div class="col-md-4 col-md-offset-8">
                                        <button id="AddOtherExpenses" type="button" class="btn btn-success btn-sm" style="margin-left: 6px;"><i class="fa fa-plus" aria-hidden="true">&nbsp;&nbsp; Add</i></button></div>
                                    <?php
                                    $i = 1;
                                    foreach ($otherExpenses as $sing) {
                                        ?>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="">Description </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>
                                                    <input type="text" class="form-control" id="income" name="other_exp_description[{{$i}}]" value="{{$sing->other_exp_description}}" >
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Amount </label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                    <input type="text" class="form-control" id="income" name="other_exp_amt[{{$i}}]" value="{{$sing->other_exp_amt}}" onkeypress="return isNumber(event)">
                                                </div>
                                            </div>

                                            <div class="col-md-4" style="margin-top: 25px;">
                                                <button type="button" class="DeleteOtherExpenses btn btn-danger btn-sm btn btn-danger btn-sm"><i class="DeleteOtherExpenses fa fa-remove"></i>&nbsp;Remove</button>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                }
                                ?>    

                            </div>
                            <hr>
                            <h5 class="color_blue">Depreciation Deduction of Pooled Assets</h5>
                            <p>You may qualify for an immediate deduction for current year assets costing less than $20,000. <b>If depreciating a vehicle, keep in mind that vehicles that are leased, using the Cents per Kilometre method, or using the 12% of Cost method cannot be depreciated.</b></p>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="{{URL('/income/superannuation/incomeStream')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; CLICK HERE TO ADD NEW RECORD</a><br/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="low_cost_assets">Low cost assets</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="low_cost_assets" name="low_cost_assets" value="{{$low_cost_assets}}" onkeypress="return isNumber(event)" >
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="general_post_assets">General pool assets</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="general_post_assets" name="general_post_assets" value="{{$general_post_assets}}"  onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="total_expenses">Total Expenses:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="total_expenses" name="total_expenses" value="{{$total_expenses}}"  onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="color_blue">Depreciation of Non-Pooled Assets</h5>
                            <p><b>If depreciating a vehicle, keep in mind that vehicles that are leased, using the Cents per Kilometre method, or using the 12% of Cost method cannot be depreciated.</b></p>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="{{URL('/')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; ADD NEW RECORD</a><br/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col                                    -md-6">
                                    <label for="total_depreciation">Total Depreciation from the Abo                                    ve Grid</label>
                                    <div class                                        ="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="total_depreciation" name="total_depreciation" value="{{$total_depreciation}}" onkeypress="return isNumber(event)" >
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="color_blue">Vehicle Expenses</h5>
                            <p>You may be able to claim for use of your private car if it is necessary for employment or business use. Keep a diary record of trips you make which are necessarily incurred in earning your income, for self education or directly from one job to a second job. This method of substantiation is only available if your business travel is less than 5000km per year. If you travel more that 5000km you should complete a Motor Vehicle log book to maximise your claim. <a href="" class="our_link color_blue">Click here to download a Motor Vehicle Record Card Template. </a></p>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="{{URL('/')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; ADD NEW RECORD</a><br/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="total_vehicle_expense">Total Vehicle Expenses from the Above Grid</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="total_vehicle_expense" name="total_vehicle_expense" value="{{$total_vehicle_expense}}" onkeypress="return isNumber(event)" >
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5 class="color_blue">Total Business Income minus Deductions</h5>
                            <div class="row">
                                <div class="form-group col-md-6">

                                    <input type="text" class="form-control" id="total_business_income" name="total_business_income" value="{{$total_business_income}}" onkeypress="return isNumber(event)" >
                                </div>
                                <hr>

                            </div>
                            <hr>
                            <h5 class="color_blue">Business Loss Details</h5>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <p>Is your business a Partnership or Sole-Trader?? </p>
                                </div>
                                <div class="input-group col-md-6">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                                                                                                         <?php $businessCat = DB::table('tbl_business_cat')->select('*')->get(); ?>
                                            @foreach($businessCat as $bc)
                                            <label class="container_radio radio-inline">{{$bc->business_cat_name}}<input type="radio" name="partnarship_or_sole" value="{{$bc->business_cat_id}}"
<?php echo ($partnarship_or_sole == $bc->business_cat_id ? 'checked' : '') ?>                                                                                        ><span class="checkmark_radio"></span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div><br/>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="deferred_loss">Deferred loss carried forward from a prior year</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="deferred_loss" name="deferred_loss" value="{{$deferred_loss}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group">
                                        <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                        <button type="button" class="btn btn-success btn-sm" onclick="BusinessIncomeDataSave()"><i class="fa fa-forward"></i> 
<?php echo (isset($user_id) && $user_id > 0 ? "Update and Go" : "Save and Go") ?>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function BusinessIncomeDataSave() {
     //   alert($("#business_income_form_element").serialize());
        $.ajax({
            type: 'get',
            url: '{{ URL::to('BusinessIncomeDataSave')}}',
            data: $("#business_income_form_element").serialize(),
            success: function (data) {
                  window.location.href = "{{URL::to('income/businessRental')}}";
            },
            error: function () {
            }
        });
    }
</script>
<script>
    var counter = 102;
    $("#AddOtherBusinessIncome").click(function () {
        $('<div class="row">\n\
                                <div class="form-group col-md-4">\n\
                                    <label for="">Description </label>\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-file-text-o color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="income" name="other_inc_description[' + counter + ']" value="">\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-group col-md-4">\n\
                                    <label for="">Amount </label>\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="income" name="other_inc_amt[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                                    </div>\n\
                                </div>\n\
\n\
                                <div class="col-md-4" style="margin-top: 25px;">\n\
                                    <button id="" type="button" class="DeleteOtherBusinessIncome btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true"> Remove </i></button>\n\
                                </div>\n\
                            </div>').appendTo("#OtherBusinessIncome");
        counter++;
    });

    $("#OtherBusinessIncome").on("click", "button.DeleteOtherBusinessIncome", function () {
        $(this).closest('.row').remove();
    });
</script>
<script>
    //Other Expenses

    var counterOtherEx = 102;
    $("#AddOtherExpenses").click(function () {
        $('<div class="row">\n\
                                <div class="form-group col-md-4">\n\
                                    <label for="">Description </label>\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="income" name="other_exp_description[' + counterOtherEx + ']" value="" >\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-group col-md-4">\n\
                                    <label for="">Amount </label>\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="income" name="other_exp_amt[' + counterOtherEx + ']" value="" onkeypress="return isNumber(event)">\n\
                                    </div>\n\
                                </div>\n\
                                <div class="col-md-4" style="margin-top: 25px;">\n\
                                    <button class="DeleteOtherExpenses btn btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;Remove</button>\n\
                                </div>\n\
                            </div>').appendTo("#OtherExpenses");
        counterOtherEx++;
    });
    $("#OtherExpenses").on("click", "button.DeleteOtherExpenses", function () {
        $(this).closest('.row').remove();
    });
</script>
@stop