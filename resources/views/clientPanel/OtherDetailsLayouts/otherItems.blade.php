
@extends("clientPanel.clientPanelMaster")
@section('title', 'Other Items')
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
$allOthersItems = DB::table('od_other_details')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

$other_details_id = "";
$user_id = "";
$hecs_balance = "";
$sfss_balance = "";
$tsl_balance = "";
$ssl_balance = "";
$MedicareLevyExemption_yes_no_id = "";
$exemption_id = "";
$days_for_exemption = "";
$exemption_category_id = "";

if (count($allOthersItems) > 0) {
    foreach ($allOthersItems as $inc_etp) {
        $other_details_id = $inc_etp->other_details_id;
        $user_id = $inc_etp->user_id;
        $hecs_balance = $inc_etp->hecs_balance;
        $sfss_balance = $inc_etp->sfss_balance;
        $tsl_balance = $inc_etp->tsl_balance;
        $ssl_balance = $inc_etp->ssl_balance;
        $MedicareLevyExemption_yes_no_id = $inc_etp->MedicareLevyExemption_yes_no_id;
        $exemption_id = $inc_etp->exemption_id;
        $days_for_exemption = $inc_etp->days_for_exemption;
        $exemption_category_id = $inc_etp->exemption_category_id;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Other Items</h3>
                    <h5>Please describe any other items that apply to you.</h5>
                </div>
                <form id="otherItemsForm">
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                    <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                    <?php
                    if ($user_id == Auth::User()->id) {
                        echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                        echo '<input type="hidden" class="form-control" id="other_details_id" name="other_details_id" value="' . $other_details_id . '">';
                    }
                    ?>
                    <div class="">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="">What is your latest HECS (HELP) balance?:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="hecs_balance" name="hecs_balance" value="{{$hecs_balance}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="">What is your latest SFSS balance?</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="sfss_balance" name="sfss_balance" value="{{$sfss_balance}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="">What is your latest Trade Support Loan (TSL) balance?</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="tsl_balance" name="tsl_balance" value="{{$tsl_balance}}" onkeypress="return isNumber(event)">
                                </div>

                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="">What is your latest SSL balance?</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="ssl_balance" name="ssl_balance" value="{{$ssl_balance}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tax Offset Amount Start -->

                        <div class="col-md-12">
                            <div class="">
                                <h5 class="color_blue">Medicare Levy Exemption</h5>
                                <p>(Do not confuse this section with the Medicare Levy Surcharge. If you are exempt from the Medicare Levy Surcharge, we automatically calculate the exemption)</p>
                                <div class="row col-md-12">
                                    <div class="col-md-6">
                                        <p>Do you qualify for the Medicare Levy Exemption?</p>
                                    </div>
                                    <div class="input-group col-md-6">
                                        <div class="col-sm-12"> 
                                            <div class="input-group">
                                                <?php
                                                $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get();
                                                ?>
                                                @foreach($yesnos as $yn)
                                                <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                                    <input type="radio" name="MedicareLevyExemption_yes_no_id" value="{{$yn->yes_no_id}}" <?php
                                                    if ($MedicareLevyExemption_yes_no_id == $yn->yes_no_id) {
                                                        echo "checked";
                                                    }
                                                    ?>>
                                                    <span class="checkmark_radio"></span>
                                                </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div><br/>
                                <div id="Exemption">
                                    <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <p>Is it at FULL or HALF Exemption?</p>
                                        </div>
                                        <div class="input-group col-md-6">
                                            <div class="col-sm-12"> 
                                                <div class="input-group">
                                                    <?php
                                                    $exemptions = DB::table('tbl_exemption')->select('exemption_id', 'exemption_name')->get();
                                                    ?>
                                                    @foreach($exemptions as $ex)
                                                    <label class="container_radio radio-inline">{{$ex->exemption_name}}
                                                        <input type="radio" name="exemption_id" value="{{$ex->exemption_id}}" <?php
                                                        if ($exemption_id == $ex->exemption_id) {
                                                            echo "checked";
                                                        }
                                                        ?>>
                                                        <span class="checkmark_radio"></span>
                                                    </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div><br/>
                                    <div class="form-group col-md-6">
                                        <b>For how many days do you qualify for this exemption?</b></div> 
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dashcube color_blue"></i></span>
                                            <input type="text" class="form-control" id="days_for_exemption" name="days_for_exemption" value="{{$days_for_exemption}}" onkeypress="return isNumber(event)">
                                        </div>

                                    </div>
                                    <div class="row col-md-12">
                                        <div class="col-md-12">
                                            <p>Why are you exempt from the Medicare Levy? Select the exemption category below:?</p>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <div class="col-sm-12"> 
                                                <div class="input-group">
                                                    <?php
                                                    $exemptiCat = DB::table('tbl_exemption_category')->select('exemption_category_id', 'exemption_category_name')->get();
                                                    ?>
                                                    @foreach($exemptiCat as $exc)
                                                    <label class="container_radio radio-inline">{{$exc->exemption_category_name}}
                                                        <input type="radio" name="exemption_category_id" value="{{$exc->exemption_category_id}}" <?php
                                                        if ($exemption_category_id == $exc->exemption_category_id) {
                                                            echo "checked";
                                                        }
                                                        ?>>
                                                        <span class="checkmark_radio"></span>
                                                    </label><br/>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div><br/>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="otherItemsSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>
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
    $("#Exemption").hide();
    $('input[name="MedicareLevyExemption_yes_no_id"]').on("click", function () {
        if ($("input[name='MedicareLevyExemption_yes_no_id']:checked").val() == '1') {
            $("#Exemption").show();
        } else {
            $("input[name='exemption_category_id']").val("");
            $("input[name='exemption_id']").val("");
            $("input[name='days_for_exemption']").val("");
            $("input[name='exemption_category_id']").val("");
            $("#Exemption").hide();
        }
    });
    var PostVal = "<?php echo $MedicareLevyExemption_yes_no_id; ?>";
    if (PostVal == "1") {
        $("#Exemption").show();
    } else if (PostVal == "2") {
        $("#Exemption").hide();
    }
    function otherItemsSave() {
       
        $.ajax({
            type: 'get',
            url: '{{ URL::to('OtherItemsSave')}}',
            data: $("#otherItemsForm").serialize(),
            success: function (data) {
               window.location.href = data;
            },
            error: function () {
                alert('Failed ! Please, Try again Later.');
            }
        });
    }
</script>
@stop