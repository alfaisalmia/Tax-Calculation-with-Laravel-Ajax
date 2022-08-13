
@extends("clientPanel.clientPanelMaster")
@section('title', 'Other Information')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Other Information </h3>
                    <h5>Please click the Save & Go button at the bottom of this page to save your information.</h5>
                    <div class="alert alert-info">
                        <strong>Residency Status</strong> 
                    </div>
                </div>
                <?php
                $allotherinfos = DB::table('tbl_other_info')->select('*')->where('user_id', Auth::User()->id)->get();
               $other_info_id ='';
                $user_id = Auth::User()->id;
                $au_citizen = "";
                $excluding_holidays = "";
                $leave_australia_permanently = "";
                $primary_purpose_trip = "";
                $departure_from_au = "";
                $arrival_in_au = "";
                $visa_type_you_have = "";
                $other_type_visa = "";
                $departure_from_au2 = "";
                $arrival_in_au3 = "";
                $primary_purpose_trip_from_au = "";
                $BSBnumber = "";
                $account_number = "";
                $account_holder_name = "";


                foreach ($allotherinfos as $aoi) {
                    $other_info_id  = $aoi->other_info_id;
                    $au_citizen = $aoi->au_citizen;
                    $au_citizen = $aoi->au_citizen;
                    $excluding_holidays = $aoi->excluding_holidays;
                    $leave_australia_permanently = $aoi->leave_australia_permanently;
                    $primary_purpose_trip = $aoi->primary_purpose_trip;
                    $departure_from_au = $aoi->departure_from_au;
                    $arrival_in_au = $aoi->arrival_in_au;
                    $visa_type_you_have = $aoi->visa_type_you_have;
                    $other_type_visa = $aoi->other_type_visa;
                    $departure_from_au2 = $aoi->departure_from_au2;
                    $arrival_in_au3 = $aoi->arrival_in_au3;
                    $primary_purpose_trip_from_au = $aoi->primary_purpose_trip_from_au;
                    $BSBnumber = $aoi->BSBnumber;
                    $account_number = $aoi->account_number;
                    $account_holder_name = $aoi->account_holder_name;
                }
                ?>
                <form id="otehr_info">
                    <div class="col-sm-12">
                        <form method="post" action="" id="other_info">
                            {{csrf_field()}}
                            <?php
                            if ($user_id = Auth::User()->id) {
                                echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                                echo '<input type="hidden" class="form-control" id="other_info_id" name="other_info_id" value="' . $other_info_id . '">';
                            }
                            ?>

                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="">Do you have Australian citizenship ?</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <select id="au_citizen" class="form-control" name="au_citizen" onchange="auCitizen()">
                                        <option selected value="0">Choose</option>
                                        <?php
                                        $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                                        foreach ($yesnos as $yn) {
                                            if ($au_citizen == $yn->yes_no_id) {
                                                echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                            } else {
                                                echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> 
                            <!--#############################################-->
                            <div id="ifExcludingHolidayNo">
                                <div class="row" id="">
                                    <div class="form-group col-md-8">
                                        <label for="">Excluding holidays did you live in Australia for the full tax year, 1 July 2017 – 30 June 2018?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select id="ExcludingHolidays" class="form-control" name="ExcludingHolidays" onchange="excludingHolidays()">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                                            foreach ($yesnos as $yn) {
                                                if ($excluding_holidays == $yn->yes_no_id) {
                                                    echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                                } else {
                                                    echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!--#############################################-->
                                <div id="">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="">Did you leave Australia Permanently?</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select id="LeaveAustraliaPermanently" class="form-control" name="LeaveAustraliaPermanently">
                                                <option selected value="0">Choose</option>
                                                <?php
                                                $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                                                foreach ($yesnos as $yn) {
                                                    if ($leave_australia_permanently == $yn->yes_no_id) {
                                                        echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                                    } else {
                                                        echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--#############################################-->
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="">What was the primary purpose of your trip away from Australia?</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <select id="primary_purpose_trip" class="form-control" name="primary_purpose_trip">
                                                <option selected value="0">Choose</option>
                                                <?php
                                                $primary_purposes = DB::table('tbl_primary_purpose_for_trip')->select('primary_purpose_id', 'primary_purpose_name')->orderBy("primary_purpose_id", "asc")->get();
                                                foreach ($primary_purposes as $pp) {
                                                    if ($primary_purpose_trip == $pp->primary_purpose_id) {
                                                        echo '<option value="' . $pp->primary_purpose_id . '"selected >' . $pp->primary_purpose_name . '</option>"';
                                                    } else {
                                                        echo '<option value="' . $pp->primary_purpose_id . '">' . $pp->primary_purpose_name . '</option>"';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--#############################################-->
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="">Date of departure from Australia?</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control datepicker" id="departureFromAu" name="departureFromAu" value="{{$departure_from_au}}">
                                        </div>
                                    </div>
                                    <!--#############################################-->
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="">Date of arrival in Australia (if applicable)?</label>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control datepicker" id="ArrivalInAu" name="ArrivalInAu" value="{{$arrival_in_au}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--#############################################-->
                            <div id="visa_type" class="row">
                                <div class="form-group col-md-8">
                                    <label for="">What type of visa do you have (eg. 417, 457, NZ citizen)?</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <select id="visaTypeYouHave" class="form-control" name="visaTypeYouHave" onchange="visaTypeChange()">
                                        <option selected value="0">Choose</option>
                                        <?php
                                        $visatypes = DB::table('tbl_visa_type')->select('visa_type_id', 'visa_type_name')->orderBy("visa_type_name", "asc")->get();
                                        foreach ($visatypes as $vt) {
                                            if ($visa_type_you_have == $vt->visa_type_id) {
                                                echo '<option value="' . $vt->visa_type_id . '"selected >' . $vt->visa_type_name . '</option>"';
                                            } else {
                                                echo '<option value="' . $vt->visa_type_id . '">' . $vt->visa_type_name . '</option>"';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!--#############################################-->

                            <div id="VisaTypeOtherSpecific">
                                <div id="" class="row">
                                    <div class="form-group col-md-8">
                                        <label for="">You selected “Other” as your visa type, please type the name of your visa into this field</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="OtherTypeVisa" name="OtherTypeVisa" value="{{$other_type_visa}}">
                                    </div>
                                </div>
                                <!--#############################################-->
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="">Date of departure from Australia?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control datepicker" id="departureFromAu2" name="departureFromAu2" value="{{$departure_from_au2}}">
                                    </div>
                                </div>
                                <!--#############################################-->
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="">Date of arrival in Australia (if applicable)?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control datepicker" id="ArrivalInAu3" name="ArrivalInAu3" value="{{$arrival_in_au3}}">
                                    </div>
                                </div>
                                <!--#############################################-->
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="">What was the primary purpose of your trip away from Australia?</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <select id="primary_purpose_trip_from_au" class="form-control" name="primary_purpose_trip_from_au">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $primary_purposes = DB::table('tbl_primary_purpose_for_trip')->select('primary_purpose_id', 'primary_purpose_name')->orderBy("primary_purpose_id", "asc")->get();
                                            foreach ($primary_purposes as $pp) {
                                                if ($primary_purpose_trip_from_au == $pp->primary_purpose_id) {
                                                    echo '<option value="' . $pp->primary_purpose_id . '"selected >' . $pp->primary_purpose_name . '</option>"';
                                                } else {
                                                    echo '<option value="' . $pp->primary_purpose_id . '">' . $pp->primary_purpose_name . '</option>"';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                    </div><br/>
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>Bank Account to Receive Your Tax Refund</strong> <i data-toggle="modal" data-target="#myModal" class="fa fa-question-circle" style="font-size: 20px; color: blue"></i>
                        </div><p>Bank account details are required by the ATO on every tax return.</p>


                        <!--#############################################-->

                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label-sm ">BSB number</label>
                            <div class="col-sm-5  col-sm-offset-2">
                                <input type="text" class="form-control" id="BSBnumber" placeholder="" name="BSBnumber" value="{{$BSBnumber}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label-sm ">Account number</label>
                            <div class="col-sm-5  col-sm-offset-2">
                                <input type="text" class="form-control" id="Accountnumber" placeholder="" name="Accountnumber" value="{{$account_number}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label-sm ">Name of Account Holder</label>
                            <div class="col-sm-5  col-sm-offset-2">
                                <input type="text" class="form-control" id="NameofAccountHolder" placeholder="" name="NameofAccountHolder" value="{{$account_holder_name}}">
                            </div>
                        </div>



                        <!--#############################################-->

                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="OtherInfoSavee()"><i class="fa fa-forward"></i> Save and Go</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <br/><br/><br/><br/>

                </form>
            </div>




        </div>

    </div>

</div>
</div>
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Help: Personal Bank Details</h4>
            </div>
            <div class="modal-body">
                <h4><strong>Why do I have to provide my Bank Account details?</strong></h4> 
                <p>&nbsp;In 2013, the ATO made it a requirement that all electronically lodged tax returns must include a taxpayers’ bank account details. This not only helps improve security, it also ensures your refund can reach you quickly. It’s very important you enter your correct bank account details to ensure your refund is sent to the right account.</p> 
                <p>To complete this section, enter your bank details like below:</p> 
                <ul> <li>BSB Number: <strong>(E.g. 123456)</strong></li> 
                    <li>Account Number <strong>(E.g. 87654321)</strong></li> 
                    <li>Name of Account Holder: <strong>(E.g. Tommy Taxpayer)</strong></li>
                </ul> 
                <p><strong>Please double check that the bank account details you enter in this section are correct as this is where your refund will be sent.</strong></p>
                <p>If your refund is sent to an incorrect account it is not possible for us to re-transfer your refund a second time.<br /> &nbsp;</p>
                <h4><strong>Can I transfer my refund to another person’s account?</strong></h4> 
                <p>&nbsp;<br /> Yes. If you enter another person’s bank details in this section, that is where your refund will be sent. Our team may also ask for written permission from you before transferring your refund to somebody else’s account. It will then be your responsibility to retrieve your refund from them if required.<br /> &nbsp;</p> 
                <h4><strong>Can someone take money out of my bank account using these details?</strong></h4> <p>&nbsp;<br /> No. Providing a BSB and Account Number only allows us to deposit your refund into that account. It does not authorise us or anyone else to make a withdrawal from your account.<br /> &nbsp;</p> 
                <h4><strong>Are my bank details safe?</strong></h4> <p>&nbsp;<br /> Yes! Etax.com.au uses the same high-level online SSL encryption technology used by banks and other financial institutions.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
    $("#ifExcludingHolidayNo").hide();
    $("#visa_type").hide();
    $("#VisaTypeOtherSpecific").hide();
    var conceptName = $('#visaTypeYouHave').find(":selected").val();

    function OtherInfoSavee() {

        console.log($("#otehr_info").serialize());
        $.ajax({
            type: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to('OtherInfoSave')}}',
            data: $("#otehr_info").serialize(),
            success: function (data) {
                alert(data);
                // window.location.href = "{{URL::to('/personalinfo/summary')}}";
            },
            error: function () {
            }
        });
    }
    //$("#visa_type").hide();

    function auCitizen() {
        var au_citizen = $("#au_citizen").val();
        if (au_citizen == 2) {
            $("#visa_type").show();
            $("#ifExcludingHolidayNo").hide();

        } else if (au_citizen == 1) {
            $("#visa_type").hide();
            $("#ifExcludingHolidayNo").show();
            $("#VisaTypeOtherSpecific").hide();
        }
    }
    function excludingHolidays() {
        var ExcludingHolidays = $("#ExcludingHolidays").val();
        if (ExcludingHolidays == 2) {
            $("#ifExcludingHolidayNo").show();
        } else {
            $("#ifExcludingHolidayNo").hide();
        }
    }
    function visaTypeChange() {
        var visaTypeYouHave = $("#visaTypeYouHave").val();
        if (visaTypeYouHave == '6' || conceptName == 6) {
            $("#VisaTypeOtherSpecific").show();
        } else {
            $("#VisaTypeOtherSpecific").hide();
        }
    }
    });
</script>
@stop