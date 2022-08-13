
@extends("clientPanel.clientPanelMaster")
@section('title', 'Capital Gain')
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
$capital_gains_main_id = "";
$user_id = "";
$prior_year_capital_loss = "";
$any_credits_for_amt = "";

$capital_gains_main = DB::table('inc_capital_gains_main')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
if (count($capital_gains_main) > 0) {
    foreach ($capital_gains_main as $cgm) {
        $capital_gains_main_id = $cgm->capital_gains_main_id;
        $user_id = $cgm->user_id;
        $prior_year_capital_loss = $cgm->prior_year_capital_loss;
        $any_credits_for_amt = $cgm->any_credits_for_amt;
    }
}
?>

<div class="ulockd-service-details">
    <div class="container"> 
        <div class="col-md-10 col-lg-10">
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Capital Gain</h3>
                    <h5>Click on "Add New Record" to report the sale of stocks or units in a trust. We will determine the best method (discounted, indexed, or other) to give you the greatest tax advantage.</h5>
                </div>

                <div class="col-sm-12 ">
                    <form id="CapitalGainFormElement">
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="capital_gains_main_id" name="capital_gains_main_id" value="' . $capital_gains_main_id . '">';
                        }
                        ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="prior_year_capital_loss">Enter below any prior year capital losses carried forward. Please enter the loss as a positive number.</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                    <input type="text" class="form-control" id="prior_year_capital_loss" name="prior_year_capital_loss" value="{{$prior_year_capital_loss}}" onkeypress="return isNumber(event)" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="any_credits_for_amt">Enter below any credits for amounts withheld from foreign resident capital gains withholding.</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bars color_blue"></i></span>
                                    <input type="text" class="form-control" id="any_credits_for_amt" name="any_credits_for_amt" value="{{$any_credits_for_amt}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <h5 class="color_blue">Sale of Shares, Units in a Trust, Property, Collectable, Personal Use Asset, Primary Home,&nbsp;or Other Asset</h5>

                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <a href="{{URL('/income/capitalGains/saleOfShare')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <a href="{{URL('/income/capitalGains/import')}}" class="btn btn-warning block btn-sm"><i class="fa fa-upload">  </i> &nbsp; Import Multiple Records by Excel</a><br/>
                            </div>
                        </div> 
                        <hr>
                        <!--#######################################################-->

                        <h5 class="color_blue">Trust Distribution Statements for Managed Funds</h5>
                        <h5>Enter the details from your Managed Trust Fund Statement. If your fund contained capital gains, you may enter that in the additional section below (Capital Gains from Managed Funds).</h5> 
                        <div class="col-sm-12" id="targetDIV"> 
                            <?php if ($user_id != Auth::User()->id) { ?>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <label for="trust_fund_code">Code</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                            <select id="trust_fund_code" class="form-control" name="trust_fund_code[1]">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $codenames = DB::table('tbl_code')->select('code_id', 'code_name')->get();
                                                foreach ($codenames as $cname) {
                                                    ?>
                                                    <option value="{{$cname->code_id}}">{{$cname->code_name}}</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="trust_fund_name">Name of Fund</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-angellist color_blue"></i></span>
                                            <input type="text" class="form-control" id="trust_fund_name" name="trust_fund_name[1]" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="trust_fund_amt">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="trust_fund_amt" name="trust_fund_amt[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button id="addMoreRcpt" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"> Add</i></button>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php
                            if ($user_id == Auth::User()->id) {
                                $capitalSubTables1 = DB::table('inc_capital_gain_sub1')->select("trust_fund_code", "trust_fund_name", "trust_fund_amt")->where('user_id', Auth::User()->id)->where('capital_gain_main_id', $capital_gains_main_id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                                ?>
                                <div class="col-md-2 col-md-offset-10" style="padding-left: 41px;">
                                    <button id="addMoreRcpt" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"> Add</i></button>
                                </div> 
                                <?php
                                $i = 1;
                                foreach ($capitalSubTables1 as $index => $singlecap) {
                                    ?>

                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="trust_fund_code">Code</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                                <select id="trust_fund_code" class="form-control" name="trust_fund_code[{{$i}}]">
                                                    <option selected="selected" value="0">Select</option>
                                                    <?php
                                                    $codenames = DB::table('tbl_code')->select('code_id', 'code_name')->get();
                                                    foreach ($codenames as $cname) {
                                                        if ($singlecap->trust_fund_code == $cname->code_id) {
                                                            echo '<option value="' . $cname->code_id . '" selected >' . $cname->code_name . '</option>';
                                                        } else {
                                                            echo '<option value="' . $cname->code_id . '">' . $cname->code_name . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="trust_fund_name">Name of Fund </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-angellist color_blue"></i></span>
                                                <input type="text" class="form-control" id="trust_fund_name" name="trust_fund_name[{{$i}}]" value="{{$singlecap->trust_fund_name}} ">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="trust_fund_amt">Amount</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="trust_fund_amt" name="trust_fund_amt[{{$i}}]" value="{{$singlecap->trust_fund_amt}}" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>

                                        <div class="col-md-2" style="margin-top: 25px;">
                                            <button id="addMoreRcpt" type="button" class="deleteRow btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>












                        <!--#######################################################-->
                        <hr>
                        <h5 class="color_blue">Capital Gains from Managed Funds</h5>
                        <div id="capital_gains_row">
                            <?php if ($user_id != Auth::User()->id) { ?>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="manage_fund">Name of Fund</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                            <input type="text" class="form-control" id="manage_fund" name="manage_fund[1]" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="manage_fund_non_disc">Non-discount Gain</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="manage_fund_non_disc" name="manage_fund_non_disc[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="mangage_fund_dis_gain">Discount Gain</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="discount_Gain" name="discount_Gain[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="capital_loss">Capital Loss</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="capital_loss" name="capital_loss[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button id="addMoreCapitalGains" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"> Add</i></button>
                                    </div>
                                </div>

                                <?php
                            }
                            if ($user_id == Auth::User()->id) {
                                $capitalSubTables2 = DB::table('inc_capital_gain_sub2')->select("*")->where('user_id', Auth::User()->id)->where('capital_gain_main_id', $capital_gains_main_id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                                ?>
                                <div class="col-md-2 col-md-offset-10" style="padding-left: 41px;">
                                    <button id="addMoreCapitalGains" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"> Add</i></button>
                                </div>
                                <?php
                                $i = 1;
                                foreach ($capitalSubTables2 as $singlec) {
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="manage_fund">Name of Fund</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                                <input type="text" class="form-control" id="manage_fund" name="manage_fund[{{$i}}]" value="{{$singlec->manage_fund_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="manage_fund_non_disc">Non-discount Gain</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="manage_fund_non_disc" name="manage_fund_non_disc[{{$i}}]" value="{{$singlec->manage_fund_non_disc}}" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="mangage_fund_dis_gain">Discount Gain</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="discount_Gain" name="discount_Gain[{{$i}}]" value="{{$singlec->discount_Gain}}" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="capital_loss">Capital Loss</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="capital_loss" name="capital_loss[{{$i}}]" value="{{$singlec->capital_loss}}" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="margin-top: 25px;">
                                            <button id="" type="button" class="deleteCapital btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true">Remove</i></button>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                        <br/>
                        <br/>

                        <div class="row">
                            <div class="col-md-9">
                                <button class="btn btn-warning btn-sm"><i class="fa fa-calculator">  </i> &nbsp; Click Here To Calculate your Capital Gain / Loss</button><br/>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="income" name="income" value="" disabled="" onkeypress="return isNumber(event)">

                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group">
                                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="CapitalGainsDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>
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

    var counter = 20;
    $("#addMoreRcpt").click(function () {
        $('<div class="row">\n\
                        <div class="form-group col-md-5">\n\
                            <div class="input-group">\n\
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>\n\
                            <select id="trust_fund_code' + counter + '" class="form-control" name="trust_fund_code[' + counter + ']">\n\
                                <option selected="selected" value="0">Select</option>\n\
<?php
$codenames = DB::table('tbl_code')->select('code_id', 'code_name')->get();
foreach ($codenames as $cname) {
    ?><option value="{{$cname->code_id}}">{{$cname->code_name}}</option> <?php } ?>\n\
                            </select>\n\
                        </div>\n\
                        </div>\n\
                        <div class="form-group col-md-3">\n\
                            <div class="input-group">\n\
                                    <span class="input-group-addon"><i class="fa fa-angellist color_blue"></i></span>\n\
                            <input type="text" class="form-control" id="trust_fund_name' + counter + '" name="trust_fund_name[' + counter + ']" value="">\n\
                        </div>\n\
                        </div>\n\
                        <div class="form-group col-md-2">\n\
                            <div class="input-group">\n\
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                            <input type="text" class="form-control" id="trust_fund_amt' + counter + '" name="trust_fund_amt[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                        </div>\n\
                        </div>\n\
                       <div class="col-md-2" style="margin-top:;">\n\
                            <button id="addMoreRcpt" type="button" class="deleteRow btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>\n\
                        </div>\n\
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

    var counter = 20;
    $("#addMoreCapitalGains").click(function () {
        $('<div class="row">\n\
                                <div class="form-group col-md-3">\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="manage_fund" name="manage_fund[' + counter + ']" value="">\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-group col-md-3">\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="manage_fund_non_disc" name="manage_fund_non_disc[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-group col-md-2">\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="discount_Gain" name="discount_Gain[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-group col-md-2">\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="capital_loss" name="capital_loss[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                                    </div>\n\
                                </div>\n\
                        <div class="col-md-2" style="">\n\
                            <button id="" type="button" class="deleteCapital btn btn-danger btn-sm"><i class="fa fa-remove" aria-hidden="true">Remove</i></button>\n\
                        </div>\n\
                    </div>').appendTo("#capital_gains_row");
        counter++;
    });
    $("#capital_gains_row").on("click", "button.deleteCapital", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    });

    function CapitalGainsDataSave() {
        $("#preloader").show();

        $.ajax({
            type: 'get',
            url: '{{ URL::to('CapitalGainsDataSave')}}',
            data: $("#CapitalGainFormElement").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
                $("#preloader").hide();
                alert("Failed !, Please, try again later.")
            }
        });
    }
</script>

@stop