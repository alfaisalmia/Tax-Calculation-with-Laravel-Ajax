
@extends("clientPanel.clientPanelMaster")
@section('title', 'Superannuation ')
@section("content")
<?php
$segment_1 = Request::segment(1);
$segment_2 = Request::segment(2);
$make_submenu_url = $segment_1 . "/" . $segment_2;

$getting_sub_and_mainmenu_id = DB::table('tbl_submenu')->select("submenu_id", "mainmenu_id")->where('submenu_url', $make_submenu_url)->get();
foreach ($getting_sub_and_mainmenu_id as $fs) {
    $submenu_id = $fs->submenu_id;
    $mainmenu_id = $fs->mainmenu_id;
}

$allDatas = DB::table('inc_superannuation_lump_sum_pay')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
$lum_sum_pay_id = "";
$user_id = "";
$payer_abn = "";
$payer_name = "";
$date_of_payment = "";
$taxed_element = "";
$tax_withheld = "";
$untax_element = "";
$detath_benefits_yes_no_id = "";

if (count($allDatas) > 0) {
    foreach ($allDatas as $inc_etp) {
        $lum_sum_pay_id = $inc_etp->lum_sum_pay_id;
        $user_id = $inc_etp->user_id;
        $payer_abn = $inc_etp->payer_abn;
        $payer_name = $inc_etp->payer_name;
        $date_of_payment = $inc_etp->date_of_payment;
        $taxed_element = $inc_etp->taxed_element;
        $tax_withheld = $inc_etp->tax_withheld;
        $untax_element = $inc_etp->untax_element;
        $detath_benefits_yes_no_id = $inc_etp->detath_benefits_yes_no_id;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">

        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <form id="LumpSumpFormElement">
                    <?php
                    if ($user_id == Auth::User()->id) {
                        echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                        echo '<input type="hidden" class="form-control" id="lum_sum_pay_id" name="lum_sum_pay_id" value="' . $lum_sum_pay_id . '">';
                    }
                    ?>
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" />  <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                    <div class="col-md-12 ulockd-mrgn1210">
                        <h3>Superannuation Lump Sum Payments</h3>
                        <h5>Enter here lump sum payments from superannuation funds, approved deposit funds,
                            retirement savings account providers, and life insurance companies.</h5>
                    </div>

                    <div class="">
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">

                                <label for="payer_abn">Payer's ABN</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-gg-circle color_blue"></i></span>
                                    <input type="text" class="form-control" id="payer_abn" name="payer_abn" value="{{$payer_abn}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="payer_name">Payer's Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                    <input type="text" class="form-control" id="payer_name" name="payer_name" value="{{$payer_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="date_of_payment">Date of Payment</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                    <input id="datepicker" name="date_of_payment" class="datepicker form-control required " placeholder="" required="required" data-error="Subject is required." type="text" value="{{ \Carbon\Carbon::parse($date_of_payment)->format('d/m/Y')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="taxed_element">Taxed Element</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="taxed_element" name="taxed_element" value="{{$taxed_element}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="tax_withheld">Tax Withheld</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="tax_withheld" name="tax_withheld" value="{{$tax_withheld}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="untax_element">Untax Elemnet</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="untax_element" name="untax_element" value="{{$untax_element}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="col-md-2">
                                <p>Death Benefits ? </p>
                            </div>
                            <div class="input-group col-md-2">
                                <div class="col-sm-12"> 
                                    <div class="input-group">
                                        <?php $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get(); ?>
                                        @foreach($yesnos as $yn)
                                        <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                            <input type="radio" name="detath_benefits_yes_no_id" value="{{$yn->yes_no_id}}" <?php
                                            if ($detath_benefits_yes_no_id == $yn->yes_no_id) {
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

                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="SLumSumPaymentsSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function SLumSumPaymentsSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('SLumSumPaymentsSave')}}',
            data: $("#LumpSumpFormElement").serialize(),
            success: function (data) {
                var url = $(location).attr('href');
                var subUrl = url.substring(0, url.lastIndexOf("/"))
                var sdas = subUrl.substring(0, subUrl.lastIndexOf("/"))
                var mainurl = sdas + "/" + data;
                window.location.href = mainurl;
            },
            error: function () {
                alert("Failed ! Please Try again later.");
            }
        });
    }
</script>
@stop