
@extends("clientPanel.clientPanelMaster")
@section('title', 'Investor/Venture Capital and Exploration Credits')
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
$allInvests = DB::table('od_investor_venture')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

$investor_venture_id = "";
$user_id = "";
$capital_partnership_yes_no_id = "";
$invest_early_state_yes_no_id = "";
$cxploration_credits_yes_no_id = "";

if (count($allInvests) > 0) {
    foreach ($allInvests as $inc_etp) {
        $investor_venture_id = $inc_etp->investor_venture_id;
        $user_id = $inc_etp->user_id;
        $capital_partnership_yes_no_id = $inc_etp->capital_partnership_yes_no_id;
        $invest_early_state_yes_no_id = $inc_etp->invest_early_state_yes_no_id;
        $cxploration_credits_yes_no_id = $inc_etp->cxploration_credits_yes_no_id;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Investor/Venture Capital and Exploration Credits</h3>
                    <h5>Early stage venture capital limited partnership 2018</h5>
                </div>
                <div class="col-sm-12 "> 
                    <form id="investVent">
                        <div class="row">
                            <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                            <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                            <?php
                            if ($user_id == Auth::User()->id) {
                                echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                                echo '<input type="hidden" class="form-control" id="etp_id" name="investor_venture_id" value="' . $investor_venture_id . '">';
                            }
                            ?>
                            <div class="col-md-10">
                                <p>Did you contribute to an early stage venture capital limited partnership (ESVCLP) which became unconditionally registered on or after 7 December 2015?</p>
                            </div>
                            <div class="col-md-2">
                                <select id="dependants" name="capital_partnership_yes_no_id" class="form-control" name="capital_partnership_yes_no_id">
                                    <option selected value="0">Choose</option>
                                    <?php
                                    $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get();
                                    foreach ($yesnos as $yn) {
                                        if ($capital_partnership_yes_no_id == $yn->yes_no_id) {
                                            echo '<option selected value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                        } else {
                                            echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-md-10">
                                <p>Did you invest in an early stage innovation company?</p>
                            </div>
                            <div class="col-md-2">
                                <select id="invest_early_state_yes_no_id" name="invest_early_state_yes_no_id" class="form-control" name="title">
                                    <option selected value="0">Choose</option>
                                    <?php
                                    $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get();
                                    foreach ($yesnos as $yn) {
                                        if ($invest_early_state_yes_no_id == $yn->yes_no_id) {
                                            echo '<option value="' . $yn->yes_no_id . '" selected >' . $yn->yes_no_name . '</option>';
                                        } else {
                                            echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="row">

                            <div class="col-md-10">
                                <p>Did you receive exploration credits?</p>
                            </div>
                            <div class="col-md-2">
                                <select id="cxploration_credits" name="cxploration_credits_yes_no_id" class="form-control" >
                                    <option selected value="0">Choose</option>
                                    <?php
                                    $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get();
                                    foreach ($yesnos as $yn) {
                                        if ($cxploration_credits_yes_no_id == $yn->yes_no_id) {
                                            echo '<option value="' . $yn->yes_no_id . '" selected >' . $yn->yes_no_name . '</option>';
                                        } else {
                                            echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                    </form>
                </div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="InvestVentureSave()"><i class="fa fa-forward"></i> Save and Go</button>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
<script>
    function InvestVentureSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('InvestVentureSave')}}',
            data: $("#investVent").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
                alert("Failed ! Please try again later.");
            }
        })
    }
</script>
@stop