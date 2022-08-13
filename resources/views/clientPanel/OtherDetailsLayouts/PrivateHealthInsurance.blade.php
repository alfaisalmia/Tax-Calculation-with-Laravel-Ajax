
@extends("clientPanel.clientPanelMaster")
@section('title', 'Private Health Insurance')
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
$allPrivateHealtInsuDatas = DB::table('od_private_health_insurance')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

$private_health_insurance = "";
$user_id = "";
$health_insurance_id = "";
$membership_number = "";
$health_insurance_coverage_type_id = "";
$person_covered_number = "";
$number_of_days = "";
$premium_eligible_aus = "";
$amount_of_au_govt = "";
$benefit_code = "";
$premiums_eligible_australian = "";
$government_rebate_received = "";
$benefit_code2 = "";

if (count($allPrivateHealtInsuDatas) > 0) {
    foreach ($allPrivateHealtInsuDatas as $inc_etp) {
        $private_health_insurance = $inc_etp->private_health_insurance;
        $user_id = $inc_etp->user_id;
        $health_insurance_id = $inc_etp->health_insurance_id;
        $membership_number = $inc_etp->membership_number;
        $health_insurance_coverage_type_id = $inc_etp->health_insurance_coverage_type_id;
        $person_covered_number = $inc_etp->person_covered_number;
        $number_of_days = $inc_etp->number_of_days;
        $premium_eligible_aus = $inc_etp->premium_eligible_aus;
        $amount_of_au_govt = $inc_etp->amount_of_au_govt;
        $benefit_code = $inc_etp->benefit_code;
        $premiums_eligible_australian = $inc_etp->premiums_eligible_australian;
        $government_rebate_received = $inc_etp->government_rebate_received;
        $benefit_code2 = $inc_etp->benefit_code2;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Private Health Insurance</h3>
                    <h5>You will need the health insurance statement provided by your health insurance fund to complete this section.</h5>
                </div>
                <form id="privateHealthformEle">
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                    <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                    <?php
                    if ($user_id == Auth::User()->id) {
                        echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                        echo '<input type="hidden" class="form-control" id="private_health_insurance" name="private_health_insurance" value="' . $private_health_insurance . '">';
                    }
                    ?>
                    <div class="">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="PayerABN">Please select your Health Insurer ID & health fund name from the list below. The ID is indicated in Box B of your statement.</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="health_insurance_id" class="form-control" name="health_insurance_id">
                                        <option selected="0" value="0">Select</option>
                                        <?php
                                        $health_insurancess = DB::table('tbl_health_insurance')->select('health_insurance_id', 'health_insurance_code', 'health_insurance_name')->get();
                                        foreach ($health_insurancess as $hi) {
                                            if ($health_insurance_id == $hi->health_insurance_id) {
                                                ?>
                                                <option value="{{$hi->health_insurance_id}}" selected="">{{$hi->health_insurance_code}}-{{$hi->health_insurance_name}}</option>
                                            <?php } else { ?>
                                                <option value="{{$hi->health_insurance_id}}">{{$hi->health_insurance_code}}-{{$hi->health_insurance_name}}</option>
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
                                <label for="">Enter your Membership Number as reported in Box C of your statement:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                    <input type="text" class="form-control" id="membership_number" name="membership_number" value="{{$membership_number}}">
                                </div>

                            </div>
                        </div>                    
                    </div>                        
                    <div class="">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="">Type of coverage:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="health_insurance_coverage_type_id" class="form-control" name="health_insurance_coverage_type_id">
                                        <option selected="selected" value="0">Select</option>

                                        <?php
                                        $coveragetype_namess = DB::table('tbl_health_insurance_coverage_type')->select('coveragetype_id', 'coveragetype_name')->get();
                                        foreach ($coveragetype_namess as $ct) {
                                            if ($health_insurance_coverage_type_id == $ct->coveragetype_id) {
                                                ?>
                                                <option value="{{$ct->coveragetype_id}}" selected="" >{{$ct->coveragetype_name}}</option>                                                             
                                            <?php } else { ?>
                                                <option value="{{$ct->coveragetype_id}}">{{$ct->coveragetype_name}}</option>
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
                                <label for="">Number of persons covered:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="description" class="form-control" name="person_covered_number">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        for ($i = 1; $i <= 20; $i++) {
                                            if ($person_covered_number == $i) {
                                                ?>
                                                <option value="{{$i}}" selected="">{{$i}}</option>

                                            <?php } else { ?>
                                                <option value="{{$i}}">{{$i}}</option>
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
                                <label for="">Enter the number of days of appropriate cover provided by your policy. You may be subject to the Medicare Levy Surcharge if your cover was for less than a full year or 365 days. (Enter "365" for whole year)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <input type="text" class="form-control" id="number_of_days" name="number_of_days" value="{{$number_of_days}}" maxlength="3" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="">Enter your premiums eligible for Australian Government rebate as reported in Box J of your insurance statement: 
                                </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <input type="text" class="form-control" id="premium_eligible_aus" name="premium_eligible_aus" value="{{$premium_eligible_aus}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="TaxedElement">Enter the amount of the Australian government rebate you received as reported in Box K of your statement.</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <input type="text" class="form-control" id="amount_of_au_govt" name="amount_of_au_govt" value="{{$amount_of_au_govt}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="">Enter your benefit code as reported in Box L of your insurance statement:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="benefit_code" class="form-control" name="benefit_code">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $benifitCodes = DB::table('tbl_benifitcode')->select('benifit_code_id', 'benifit_code_name')->get();
                                        foreach ($benifitCodes as $ct) {
                                            if ($benefit_code == $ct->benifit_code_id) {
                                                ?>
                                                <option value="{{$ct->benifit_code_id}}" selected="" >{{$ct->benifit_code_name}}</option>                                                             
                                            <?php } else { ?>
                                                <option value="{{$ct->benifit_code_id}}">{{$ct->benifit_code_name}}</option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="">Your premiums eligible for Australian Government rebate for premiums paid on or after 1 April 2018: </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <input type="text" class="form-control" id="premiums_eligible_australian" name="premiums_eligible_australian" value="{{$premiums_eligible_australian}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label for="">Australian government rebate received for premiums paid on or after 1 April 2018, if any</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                <input type="text" class="form-control" id="UntaxedElement" name="government_rebate_received" value="{{$government_rebate_received}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                    </div>                                                                                                                                        
                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label for="">Enter your benefit code as reported in Box L of your insurance statement:</label> 
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>          
                                <select id="benefit_code2" class="form-control" name="benefit_code2">

                                    <option selected="selected" value="0">Select</option>
                                    <?php
                                    $benifitCodes = DB::table('tbl_benifitcode2')->select('benifit_code_id', 'benifit_code_name')->get();
                                    foreach ($benifitCodes as $ct) {
                                        if ($benefit_code2 == $ct->benifit_code_id) {
                                            ?>
                                            <option value="{{$ct->benifit_code_id}}" selected="" >{{$ct->benifit_code_name}}</option>                                                             
                                        <?php } else { ?>
                                            <option value="{{$ct->benifit_code_id}}">{{$ct->benifit_code_name}}</option>
                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="PrivateHealthInsuSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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
    function PrivateHealthInsuSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('PrivateHealthInsuSave')}}',
            data: $("#privateHealthformEle").serialize(),
            success: function (data) {
                 var url = $(location).attr('href');
                var subUrl = url.substring(0, url.lastIndexOf("/"))
                var sdas = subUrl.substring(0, subUrl.lastIndexOf("/"))
                var mainurl = sdas + "/" + data;
                window.location.href = mainurl;
            },
            error: function () {
                alert('Failed ! Please try again later.');
            }
        });
    }
</script>
@stop