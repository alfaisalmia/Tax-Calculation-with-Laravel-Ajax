
@extends("clientPanel.clientPanelMaster")
@section('title', 'Medical Expenses')
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
            $addDatas = DB::table('od_medical_expense')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

            $medical_expense_id = "";
            $user_id = "";
            $disability_aid_exp = "";
            $attendant_care_exp = "";
            $aged_care_exp = "";
            $total_exp = "";
           
            if (count($addDatas) > 0) {
                foreach ($addDatas as $inc_etp) {
                    $medical_expense_id = $inc_etp->medical_expense_id;
                    $user_id = $inc_etp->user_id;
                    $disability_aid_exp = $inc_etp->disability_aid_exp;
                    $attendant_care_exp = $inc_etp->attendant_care_exp;
                    $aged_care_exp = $inc_etp->aged_care_exp;
                    $total_exp = $inc_etp->total_exp;
                }
            }
            ?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Medical Expenses</h3>
                    <h5><b>From July 2013, the Medical Expenses Tax Offset is phased out and is restricted to out of pocket expenses incurred for disability aids, attendant care, and aged care only. This tax offset will expire in June 2019.
                    </h5>

                </div>

                <div class="">
                    <div class="col-md-12">
                        <p>You can deduct out of pocket medical expenses paid for yourself, your spouse, and dependants.</p>
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <form id="medicalExpen">
                         <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="medical_expense_id" name="medical_expense_id" value="' . $medical_expense_id . '">';
                        }
                        ?>
                    <div class="row">
                        <div class="col-md-8">
                            <p>Expenses for disability aids</p>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="disability_aid_exp" name="disability_aid_exp" value="{{$disability_aid_exp}}" onkeypress="return isNumber(event)" onkeyup="AddAmount()">
                            </div> 
                        </div>
                    </div>
                    <br/>

                    <div class="row">
                        <div class="col-md-8">
                            <p>Attendant care expenses</p>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="attendant_care_exp" name="attendant_care_exp" value="{{$attendant_care_exp}}" onkeypress="return isNumber(event)" onkeyup="AddAmount()">
                            </div> 
                        </div> 
                    </div>
                    <br/>

                    <div class="row">
                        <div class="col-md-8">
                            <p>Aged care expenses</p>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="aged_care_exp" name="aged_care_exp" value="{{$aged_care_exp}} "onkeypress="return isNumber(event)" onkeyup="AddAmount()">
                            </div> 
                        </div>
                    </div>
                    <br/>

                    <div class="row">
                        <div class="col-md-8">
                            <p><b>Total Expenses</b>
                                Total Medical expenses of $2333 or greater qualify for a 20% tax offset.</p>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="total_exp" name="total_exp" value="{{$total_exp}}" readonly="" onkeypress="return isNumber(event)">
                            </div> 
                        </div> 
                    </div>
                    <br/>

                    </form>
                    <br/><br/><br/> 
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="MedicalExpeSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>
function MedicalExpeSave(){
       $.ajax({
            type: 'get',
            url: '{{ URL::to('MedicalExpeSave')}}',
            data: $("#medicalExpen").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
                alert("Failed ! Please try again later.");
            }
        })
}
function AddAmount(){
    var disability_aid_exp = $("#disability_aid_exp").val();
    var attendant_care_exp = $("#attendant_care_exp").val();
    var aged_care_exp = $("#aged_care_exp").val();
    var Total = parseInt(disability_aid_exp) + parseInt(attendant_care_exp) + parseInt(aged_care_exp);
        $("#total_exp").val(Total);
}
</script>
@stop