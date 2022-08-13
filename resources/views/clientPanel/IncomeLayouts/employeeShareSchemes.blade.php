
@extends("clientPanel.clientPanelMaster")
@section('title', 'Employee Share Schemes')
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
$allSchemesDatas = DB::table('inc_employee_share_scheme')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

$employee_share_scheme_id = "";
$user_id = "";
$employer_name = "";
$employer_abn = "";
$discount_tax_eligible = "";
$discount_tax_not_eligible = "";
$discount_deferral_schemes = "";
$discount_on_ess = "";
$tfn_amounts = "";
$foreign_discounts = "";



if (count($allSchemesDatas) > 0) {
    foreach ($allSchemesDatas as $inc_etp) {
        $employee_share_scheme_id = $inc_etp->employee_share_scheme_id;
        $user_id = $inc_etp->user_id;
        $employer_name = $inc_etp->employer_name;
        $employer_abn = $inc_etp->employer_abn;
        $discount_tax_eligible = $inc_etp->discount_tax_eligible;
        $discount_tax_not_eligible = $inc_etp->discount_tax_not_eligible;
        $discount_deferral_schemes = $inc_etp->discount_deferral_schemes;
        $discount_on_ess = $inc_etp->discount_on_ess;
        $tfn_amounts = $inc_etp->tfn_amounts;
        $foreign_discounts = $inc_etp->foreign_discounts;
    }
}
?>
<div class="ulockd-service-details">
    <div class="container"> 
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <form id="EmployeeShareSchemes">
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                    <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                    <?php
                    if ($user_id == Auth::User()->id) {
                        echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                        echo '<input type="hidden" class="form-control" id="employee_share_scheme_id" name="employee_share_scheme_id" value="' . $employee_share_scheme_id . '">';
                    }
                    ?>
                    <div class="col-md-12 ulockd-mrgn1210">
                        <h3>Employee Share Schemes</h3>
                        <h5>Report here any discounts on employee share schemes that are detailed in the ESS statement received from your employer.</h5>
                    </div>
                    <hr>
                    <div class="col-sm-12 ">
                        <h5 class="color_blue">Employer's Information:</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="employer_name">Employer's name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                    <input type="text" class="form-control" id="employer_name" name="employer_name" value="{{$employer_name}}">   
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="employer_abn">Employer's ABN </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-height color_blue"></i></span>
                                    <input type="text" class="form-control" id="employer_abn" name="employer_abn" value="{{$employer_abn}}" onkeypress="return isNumber(event)">   
                                </div>
                            </div>

                        </div>

                        <!--#######################################################-->
                        <hr>
                        <h5 class="color_blue">Taxed up front scheme – eligible for reduction:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Discount from taxed up front schemes – eligible for reduction</p>
                            </div>

                            <div class="input-group col-md-6">
                                <div class="col-sm-1"><span class="letters">D</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="discount_tax_eligible" name="discount_tax_eligible" value="{{$discount_tax_eligible}}" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5 class="color_blue">Taxed up front scheme – not eligible for reduction:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Discount from taxed up front schemes – not eligible for reduction</p>
                            </div>

                            <div class="input-group col-md-6">
                                <div class="col-sm-1"><span class="letters">E</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="discount_tax_not_eligible" name="discount_tax_not_eligible" value="{{$discount_tax_not_eligible}}" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5 class="color_blue">Deferral Schemes:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Discount from deferral Schemes </p>
                            </div>

                            <div class="input-group col-md-6">
                                <div class="col-sm-1"><span class="letters">F</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="discount_deferral_schemes" name="discount_deferral_schemes" value="{{$discount_deferral_schemes}}" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Discount on ESS interests acquired pre 1 July 2009 and 'cessation time' occurred during the financial year
                                </p>
                            </div>

                            <div class="input-group col-md-6">
                                <div class="col-sm-1"><span class="letters">G</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="discount_on_ess" name="discount_on_ess" value="{{$discount_on_ess}}" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <p>TFN amounts withheld from discounts</p>
                            </div>

                            <div class="input-group col-md-6">
                                <div class="col-sm-1"><span class="letters">C</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="tfn_amounts" name="tfn_amounts" value="{{$tfn_amounts}}" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div>    <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Foreign Source Discounts</p>
                            </div>

                            <div class="input-group col-md-6">
                                <div class="col-sm-1"><span class="letters">A</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="foreign_discounts" name="foreign_discounts" value="{{$foreign_discounts}}" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div>
                        <br/>

                </form>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="employeeShareFormDataSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? 'Update and Go' : 'Save and Go') ?></button>
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

    function employeeShareFormDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('EmployeeShareFormDataSave')}}',
            data: $("#EmployeeShareSchemes").serialize(),
            success: function (data) {
                var url = $(location).attr('href');
                var subUrl = url.substring(0, url.lastIndexOf("/"))
                var sdas = subUrl.substring(0, subUrl.lastIndexOf("/"))
                var mainurl = sdas + "/" + data;
                window.location.href = mainurl;
            },
            error: function () {
            }
        });
    }
</script>

@stop