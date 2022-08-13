
@extends("clientPanel.clientPanelMaster")
@section('title', 'Distribution from a Partnership or Trust')
@section("content")


<div class="ulockd-service-details">
    <div class="container"> 
        <div class="col-md-10 col-lg-10">
            <?php
            $segment_1 = Request::segment(1);
            $segment_2 = Request::segment(2);
            $make_submenu_url = $segment_1 . "/" . $segment_2;

            $getting_sub_and_mainmenu_id = DB::table('tbl_submenu')->select("submenu_id", "mainmenu_id")->where('submenu_url', $make_submenu_url)->get();
            foreach ($getting_sub_and_mainmenu_id as $fs) {
                $mainmenu_id = $fs->mainmenu_id;
                $submenu_id = $fs->submenu_id;
            }

            $allpartnerships = DB::table('inc_partnership_trust')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

            $partnership_trust_id = "";
            $user_id = "";
            $name_of_entity = "";
            $type_of_entity = "";
            $type_of_entity2 = "";
            $distribution_amount = "";
            $land_water_deduction = "";
            $other_deduction = "";
            $prior_year_non_com = "";
            $partnership_share_of_small = "";
            $share_of_credit = "";
            $share_credit_amt = "";
            $share_national_rental = "";

            if (count($allpartnerships) > 0) {
                foreach ($allpartnerships as $abcd) {
                    $partnership_trust_id = $abcd->partnership_trust_id;
                    $user_id = $abcd->user_id;
                    $name_of_entity = $abcd->name_of_entity;
                    $type_of_entity = $abcd->type_of_entity;
                    $type_of_entity2 = $abcd->type_of_entity2;
                    $distribution_amount = $abcd->distribution_amount;
                    $land_water_deduction = $abcd->land_water_deduction;
                    $other_deduction = $abcd->other_deduction;
                    $prior_year_non_com = $abcd->prior_year_non_com;
                    $partnership_share_of_small = $abcd->partnership_share_of_small;
                    $share_of_credit = $abcd->share_of_credit;
                    $share_credit_amt = $abcd->share_credit_amt;
                    $share_national_rental = $abcd->share_national_rental;
                }
            }
            ?>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Distribution from a Partnership or Trust</h3>
                    <h5>Please tell us about your distribution from your partnership or trust. If you are reporting capital gains, that must be entered in the <a href="" class="our_link color_blue">Capital Gains Section.</a></h5>
                </div>
                <form id="partnership_form_element">
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                    <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                    <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="partnership_trust_id" name="partnership_trust_id" value="' . $partnership_trust_id . '">';
                        }
                        ?>
                    <div class="col-sm-12 ">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name_of_entity">Name of Entity</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height color_blue"></i></span>
                                    <input type="text" class="form-control" id="name_of_entity" name="name_of_entity" value="{{$name_of_entity}}">   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="type_of_entity">Type of Entity  </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="type_of_entity" class="form-control" name="type_of_entity">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $type_entity1s = DB::table('tbl_type_entity1')->select('type_entity_id', 'type_entity_name')->get();
                                        foreach ($type_entity1s as $type) {
                                            if($type_of_entity == $type->type_entity_id){
                                        echo '<option value="'.$type->type_entity_id.'" selected >'.$type->type_entity_name.'</option>';          
                                            }else{
                                               echo '<option value="'.$type->type_entity_id.'">'.$type->type_entity_name.'</option>'; 
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type_of_entity2"></label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="type_of_entity2" class="form-control" name="type_of_entity2">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $type_entity2s = DB::table('tbl_type_entity2')->select('type_entity_id', 'type_entity_name')->get();
                                        foreach ($type_entity2s as $types) {
                                            if($type_of_entity2 == $types->type_entity_id){
                                        echo '<option value="'.$type->type_entity_id.'" selected >'.$type->type_entity_name.'</option>';          
                                            }else{
                                               echo '<option value="'.$type->type_entity_id.'">'.$type->type_entity_name.'</option>'; 
                                            }
                                        }
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!--#######################################################-->
                        <hr>
                        <h5 class="color_blue">Distributions:</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="distribution_amount">Distribution Amount  </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="distribution_amount" name="distribution_amount" value="{{$distribution_amount}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <h5 class="color_blue">Deductions:</h5>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="land_water_deduction">Landcare operations and water care facility deduction</label>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="land_water_deduction" name="land_water_deduction" value="{{$land_water_deduction}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="other_deduction">Other Deductions</label>
                            </div>
                            <div class="form-group col-md-4"> <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="other_deduction" name="other_deduction" value="{{$other_deduction}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">

                                <label for="prior_year_non_com">Prior year deferred non-commercial losses</label>
                            </div>
                            <div class="form-group col-md-4"> <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="prior_year_non_com" name="prior_year_non_com" value="{{$prior_year_non_com}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">

                                <label for="partnership_share_of_small">Partnership share of net small business income less deductions attributable to that share</label>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="partnership_share_of_small" name="partnership_share_of_small" value="{{$partnership_share_of_small}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5 class="color_blue">Credits & TFN Amounts:</h5>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="share_credit_tax">Share of credit for tax withheld where ABN not quoted</label>
                            </div>
                            <div class="form-group col-md-4"> <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="share_of_credit" name="share_of_credit" value="{{$share_of_credit}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="share_credit_amt">Share of credit from amounts withheld from foreign resident withholding</label>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="share_credit_amt" name="share_credit_amt" value="{{$share_credit_amt}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">

                                <label for="share_national_rental">Share of national rental affordability scheme tax offset</label>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="share_national_rental" name="share_national_rental" value="{{$share_national_rental}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12">

                        <div class="form-group">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="PartnerShipFormDataSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function PartnerShipFormDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('PartnerShipFormDataSave')}}',
            data: $("#partnership_form_element").serialize(),
            success: function (data) {

                window.location.href = data;
            },
            error: function () {
            }
        });
    }
</script>

@stop