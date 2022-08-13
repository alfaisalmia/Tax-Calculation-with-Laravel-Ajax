
@extends("clientPanel.clientPanelMaster")
@section('title', 'Vehicle Expenses')
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
$carExpess = DB::table('deduc_car_expenses')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();


$car_expense_id = "";
$user_id = "";
$tax_year_id = "";
$car_model_year = "";
$vehicle_explain = "";
$killometer_traveled = "";
$engintype_capacity_id = "";
$cost_price = "";
$date_purchased = "";
$maintain_log_book_yes_no = "";
$sell_yes_no = "";

if (count($carExpess) > 0) {
    foreach ($carExpess as $car) {
        $car_expense_id = $car->car_expense_id;
        $user_id = $car->user_id;
        $tax_year_id = $car->tax_year_id;
        $car_model_year = $car->car_model_year;
        $vehicle_explain = $car->vehicle_explain;
        $killometer_traveled = $car->killometer_traveled;
        $engintype_capacity_id = $car->engintype_capacity_id;
        $cost_price = $car->cost_price;
        $date_purchased = $car->date_purchased;
        $maintain_log_book_yes_no = $car->maintain_log_book_yes_no;
        $sell_yes_no = $car->sell_yes_no;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Vehicle Expenses</h3>
                    <h5>Please list your work related vehicle expenses. <span style="color:red">For a vehicle claim using the Log Book Method, you must have maintained a log book for at least 12 weeks.</span></h5>
                </div>
                <form id="carExpenFormData">
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="car_expense_id" name="car_expense_id" value="' . $car_expense_id . '">';
                        }
                        ?>
                    <div class="">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="car_model_year">Car Description - Model and Year</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-car color_blue"></i></span>
                                    <input type="text" class="form-control" id="car_model_year" name="car_model_year" value="{{$car_model_year}}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="vehicle_explain">Briefly explain how you used your vehicle for work purposes</label><div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-car color_blue"></i></span>
                                    <textarea class="form-control" rows="5" id="vehicle_explain" name="vehicle_explain">{{$vehicle_explain}}</textarea>
                                </div>

                                </div>
                            </div>
                            </div>

                            <div class="">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="killometer_traveled">Business kilometres travelled in vehicle during the year</label><div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tachometer color_blue"></i></span>
                                            <input type="text" class="form-control" id="killometer_traveled" name="killometer_traveled" value="{{$killometer_traveled}}" onkeypress="return isNumber(event)">
                                        </div>                                                                                        
                                    </div>

                                </div>
                            </div>

                            <div class="">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="engintype_capacity_id">Engine type and capacity</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                            <select id="engintype_capacity_id" class="form-control" name="engintype_capacity_id">
                                                <option selected="selected" value="Select">Select</option>
                                                <?php
                                                $engine_types = DB::table('tbl_enginetype_capacity')->select('enginetype_capacity_id', 'enginetype_capacity_name')->get();
                                                foreach ($engine_types as $engine_type) {
                                                    if ($engintype_capacity_id == $engine_type->enginetype_capacity_id) {
                                                        ?>
                                                        <option value="{{$engine_type->enginetype_capacity_id}}" selected="">{{$engine_type->enginetype_capacity_name}}</option>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <option value="{{$engine_type->enginetype_capacity_id}}">{{$engine_type->enginetype_capacity_name}}</option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="cost_price">Cost price of vehicle</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="cost_price" name="cost_price" value="{{$cost_price}}" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-6">
                                        <label for="date_purchased">Date Purchased or Acquired  
                                            (dd/mm/yyyy)</label><div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                            <input type="text" class="form-control datepicker" id="date_purchased" name="date_purchased" value="{{ \Carbon\Carbon::parse($date_purchased)->format('d-m-Y')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Tax Offset Amount Start -->
                            <div class=" col-md-12">
                                <div class="col-md-6">
                                    <p>Did you maintain a log book for at least 12 weeks?</p>
                                </div>
                                <div class="input-group col-md-6">
                                    <div class="col-sm-12"> 
                                        <div class="input-group">
                                            <?php $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get(); ?>
                                            @foreach($yesnos as $yn)
                                            <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                                <input type="radio" name="maintain_log_book_yes_no" value="{{$yn->yes_no_id}}" <?php
                                                 if ($maintain_log_book_yes_no == $yn->yes_no_id) {
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
                            <div class=" col-md-12">
                                <div class="col-md-6">
                                    <p>Did you sell or dispose the car this tax year? (01/07/2017 - 30/06/2018)?

                                    </p>
                                </div>
                                <div class="input-group col-md-6">
                                    <div class="col-sm-12"> 
                                        <div class="input-group">
                                            <?php $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get(); ?>
                                            @foreach($yesnos as $yn)
                                            <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                                <input type="radio" name="sell_yes_no" value="{{$yn->yes_no_id}}" <?php
                                                 if ($sell_yes_no == $yn->yes_no_id) {
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
                            <!-- Tax Offset Amount End -->

                            <!-- Lum Sum in Arrears Start -->
                            <div class="">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-calculator"></i> &nbsp;CLICK HERE TO CALCULATE YOUR DEDUCTION</button>
                                    </div>

                                </div>
                            </div>
                            <!-- Lum Sum in Arrears End -->
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                        <button type="button" class="btn btn-success btn-sm" onclick="carExpenFormDataSave()"><i class="fa fa-forward"></i> Save and Go</button>

                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>



                </form>

            </div>
        </div>
    </div>
</div>
<script>
    function carExpenFormDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('CarExpenFormDataSave')}}',
            data: $("#carExpenFormData").serialize(),
            success: function (data) {
                 var url = $(location).attr('href');
                var subUrl = url.substring(0, url.lastIndexOf("/"))
                var sdas = subUrl.substring(0, subUrl.lastIndexOf("/"))
                var mainurl = sdas + "/" + data;
                window.location.href = mainurl;
            },
            error: function () {
            }
        })
    }
</script>
@stop