
@extends("clientPanel.clientPanelMaster")
@section('title', 'Govt Payment')
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

//
$govt_payment_id = "";
$user_id = "";
$govt_pension = "";
$descr_govt_payment = "";

$GovtPayments = DB::table('inc_govt_payment')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
if (count($GovtPayments) > 0) {
    foreach ($GovtPayments as $cgm) {
        $govt_payment_id = $cgm->govt_payment_id;
        $user_id = $cgm->user_id;
        $govt_pension = $cgm->govt_pension;
        $descr_govt_payment = $cgm->descr_govt_payment;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Government Payment</h3>
                    <h5><b>Do not include any Parental Leave Payment and Dad and Partner Payment in this section. </b>Please contact the Centrelink to get a copy of the payment summary and enter these payments in the <a href="#" style="color:blue;">Salaries and Wages section.</a></h5>

                </div>

                <div class="">
                    <div class="col-md-12">
                        <p>Please do not enter Family Tax Benefit (Part A&B) and Child Care Benefit/Rebate as they are tax free.</p>
                    </div>
                </div>
                <form id="formData">
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                            <?php
                            if ($user_id == Auth::User()->id) {
                                echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                                echo '<input type="hidden" class="form-control" id="mode" name="govt_payment_id" value="'.$govt_payment_id.'">';
                            }
                            ?>
                    <div class="col-sm-12" id="targetDIV">  
                        <?php 
                         $ForestryIncome = DB::table('inc_govt_payment_sub')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                         if ($user_id == Auth::User()->id && count($ForestryIncome) > 0) {
                                  
                                    if (count($ForestryIncome) > 0) {
                                        ?>
                        
                        <div class="row"> 
                    <div class="col-md-2" style="margin-top: 25px;">
                                <button id="addMoreRcpt" type="button" class="btn btn-success "><i class="fa fa-plus-circle" aria-hidden="true"> Add</i></button>
                    </div>
                            </div>
                          <?php
                                        $i = 1;
                                        foreach ($ForestryIncome as $cgm) {
                                            ?>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="description">Description</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="description1" class="form-control" name="description[{{$i}}]">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $tbl_govtpayment_descss = DB::table('tbl_govtpayment_desc')->select('govtpayment_id', 'govtpayment_name')->get();
                                        foreach ($tbl_govtpayment_descss as $tbl_govtpayme) {
                                            if($cgm->govt_payment_desc_id == $tbl_govtpayme->govtpayment_id){
                                            ?>
                                        <option value="{{$tbl_govtpayme->govtpayment_id}}" selected="">{{$tbl_govtpayme->govtpayment_name}}</option>
                                            <?php
                                        }else{
                                        ?>
                                            <option value="{{$tbl_govtpayme->govtpayment_id}}">{{$tbl_govtpayme->govtpayment_name}}</option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="income">Income</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="income1" name="income[{{$i}}]" value="{{$cgm->income}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="tax_withheld">Tax withheld</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="tax_withheld1" name="tax_withheld[{{$i}}]" value="{{$cgm->tax_withheld}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="days_receive">Days Receive</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dashcube color_blue"></i></span>
                                    <input type="text" class="form-control" id="days_receive1" name="days_receive[{{$i}}]" value="{{$cgm->days_receive}}" onkeypress="return isNumber(event)" title="Days Receive between (1-365 )" maxlength="3">
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-top: 25px;">
                               <button type="button" class="deleteRow btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true"> Remove </i></button>
                            </div>
                        </div>
                         <?php $i++;}}}else{?>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="description">Description</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="description1" class="form-control" name="description[1]">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $tbl_govtpayment_descss = DB::table('tbl_govtpayment_desc')->select('govtpayment_id', 'govtpayment_name')->get();
                                        foreach ($tbl_govtpayment_descss as $tbl_govtpayme) {
                                            ?>
                                            <option value="{{$tbl_govtpayme->govtpayment_id}}">{{$tbl_govtpayme->govtpayment_name}}</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="income">Income</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="income1" name="income[1]" value="" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="tax_withheld">Tax withheld</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="tax_withheld1" name="tax_withheld[1]" value="" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="days_receive">Days Receive</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dashcube color_blue"></i></span>
                                    <input type="text" class="form-control" id="days_receive1" name="days_receive[1]" value="" onkeypress="return isNumber(event)" title="Days Receive between (1-365 )" maxlength="3">
                                </div>
                            </div>
                            <div class="col-md-2" style="margin-top: 25px;">
                                <button id="addMoreRcpt" type="button" class="btn btn-success "><i class="fa fa-plus-circle" aria-hidden="true"> Add</i></button>
                            </div>
                        </div>
                         <?php } ?>
                    </div>
                    <div class="col-sm-12"> 
                        <h4 style="color:blue">Tax Exempt Government Payments</h4>
                        <div class="row">
                            <div class="col-md-8">
                                <p>Enter your tax exempt government pensions or benefits (if any):</p>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="govt_pension" name="govt_pension" value="{{$govt_pension}}" onkeypress="return isNumber(event)">
                                </div> 
                            </div> 
                        </div>

                        <p>View the tax-free pension/benefit list </p>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Describe the type(s) of tax exempt government payments received: </p>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span>
                                    <textarea cols="61" name="descr_govt_payment" >{{$descr_govt_payment}}</textarea>
                                </div> 
                            </div> 
                        </div>
                        <br/><br/><br/> 
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="GovtPaymentDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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
<script>
    var counter = 20;
    $("#addMoreRcpt").click(function () {
        $('<div class="row">\n\
    <div class="form-group col-md-4">\n\
                            <label for="description">Description</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>\n\
                                <select id="description' + counter + '" class="form-control" name="description[' + counter + ']">\n\
                                    <option selected="selected" value="0">Select</option>\n\
<?php
$tbl_govtpayment_descss = DB::table('tbl_govtpayment_desc')->select('govtpayment_id', 'govtpayment_name')->get();
foreach ($tbl_govtpayment_descss as $tbl_govtpayme) {
    ?> <option value="{{$tbl_govtpayme->govtpayment_id}}">{{$tbl_govtpayme->govtpayment_name}}</option> <?php } ?>\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
 <div class="form-group col-md-2">\n\
                            <label for="income">Income</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="income' + counter + '" name="income[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                            </div>\n\
                        </div>\n\
      <div class="form-group col-md-2">\n\
                            <label for="tax_withheld">Tax withheld</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="tax_withheld' + counter + '" name="tax_withheld[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                            </div>\n\
                        </div>\n\
                        <div class="form-group col-md-2">\n\
                            <label for="days_receive">Days Receive</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-dashcube color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="days_receive[' + counter + ']" name="days_receive[' + counter + ']" value="" onkeypress="return isNumber(event)" title="Days Receive between (1-365 )" maxlength="3">\n\
                            </div>\n\
                        </div>\n\
<div class="col-md-2" style="margin-top: 25px;">\n\
                            <button type="button" class="deleteRow btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true"> Remove </i></button>\n\
                        </div>').appendTo("#targetDIV");
        counter++;
    });
    $("#targetDIV").on("click", "button.deleteRow", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    });
    function GovtPaymentDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('GovtPaymentDataSave')}}',
            data: $("#formData").serialize(),
            success: function (data) {
                 $("#preloader").show();
               window.location.href = data;
            },
            error: function () {
                $("#preloader").hide();
                alert("Failed !, Please, try again later.");
            }
        });
    }
</script>
@stop