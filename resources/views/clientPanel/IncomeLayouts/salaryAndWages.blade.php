
@extends("clientPanel.clientPanelMaster")
@section('title', 'Salary and Wages')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">

        <div class="col-md-10 col-lg-10">
            <?php
            $inc_salary_wages= DB::table('inc_salary_wages')->select('salary_occupation')->where('user_id', Auth::User()->id)->get();
            $salary_occupation = "";
            foreach ($inc_salary_wages as $inco) {
                $salary_occupation = $inco->salary_occupation;
            }
            ?>
            <?php
            $segment_1 = Request::segment(1);
            $segment_2 = Request::segment(2);
            $make_submenu_url = $segment_1 . "/" . $segment_2;

            $getting_sub_and_mainmenu_id = DB::table('tbl_submenu')->select("submenu_id", "mainmenu_id")->where('submenu_url', $make_submenu_url)->get();
            foreach ($getting_sub_and_mainmenu_id as $fs) {
                $submenu_id = $fs->submenu_id;
                $mainmenu_id = $fs->mainmenu_id;
            }

            ?>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Salary and Wages</h3>
                    <h5>Click on "Add New Record" to input your salary and wage information. You may add as many PAYG Payment Summaries as needed. Please note that more than three entries in this section will increase your tax preparation fees.  </h5>

                </div>

                <div class="">
                </div>
                <form>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <label>Select your main wage & salary occupation. Then click Add New Record to input your information.
                            </label>
                            <select id="salary_occupation" name="salary_occupation " class="form-control">
                                <option selected="selected" value="0">Select your occupation</option>
                                <?php
                                $salary_occupations = DB::table('tbl_salary_occupation')->select('salary_occupation_id', 'salary_occupation_name')->get();
                                foreach ($salary_occupations as $socc) {
                                    if ($salary_occupation == $socc->salary_occupation_id) {
                                        echo '<option value="' . $socc->salary_occupation_id . '" selected >' . $socc->salary_occupation_name . '</option>';
                                    } else {
                                        echo '<option value="' . $socc->salary_occupation_id . '" >' . $socc->salary_occupation_name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" />  <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                </form>
                <br/>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <button class="btn btn-warning block btn-sm" onclick="payPaymentSummaryAdd()"><i class="fa fa-plus" >  </i> &nbsp; Add New Record</button>
                    </div>
                </div> <br/><br/><br/>
                <form id="mainsub_id">
                    
                </form>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="salaryAndWagesSave()"><i class="fa fa-forward"></i> Save and Go</button>

                        </div>
                    </div>
                </div>
                <br/><br/><br/>
            </div>



            </form>

        </div>

    </div>
</div>
</div>
<script>
    function payPaymentSummaryAdd() {
    var salary_occupation = $("#salary_occupation").val();
    var mainmenu = $("#mainmenu").val();
    var submenu = $("#submenu").val();
    $.ajax({
    type: 'get',
            url: '{{ URL::to('PayPaymentSummaryAdd')}}',
            data: {
            salary_occupation: salary_occupation,
            mainmenu: mainmenu,
            submenu: submenu,
            },
            success: function (data) {
            window.location.href = "{{URL::to('/income/paygPaymentSummary')}}";
            },
            error: function () {
            }
    });
    }
    function salaryAndWagesSave() {
    var mainmenu_id = $("#mainmenu").val();
    var submenu_id = $("#submenu").val();
    $.ajax({
    type: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to('SalaryAndWagesSave')}}',
            data: {
            mainmenu_id:mainmenu_id,
                    submenu_id:submenu_id,
            },
            success: function (data) {
            window.location.href = data;
            },
            error: function () {
            $("#preloader").hide();
            }
    });
    }
</script>
@stop