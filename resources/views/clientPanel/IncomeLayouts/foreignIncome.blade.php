
@extends("clientPanel.clientPanelMaster")
@section('title', 'Foreign Income ')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
    <?php

            $segment_1 = Request::segment(1);
            $segment_2 = Request::segment(2);
            $make_submenu_url = $segment_1 . "/" . $segment_2;

            $getting_sub_and_mainmenu_id = DB::table('tbl_submenu')->select("submenu_id", "mainmenu_id")->where('submenu_url', $make_submenu_url)->get();
            foreach ($getting_sub_and_mainmenu_id as $fs) {
                $mainmenu_id = $fs->mainmenu_id;
                $submenu_id = $fs->submenu_id;
            }
          
            $radio= DB::table('inc_foreign_income')->select('interest_in_assest')->where('user_id', Auth::User()->id)->get();
            $interest_in_assest = "";
            foreach ($radio as $r) {
                $interest_in_assest = $r->interest_in_assest;
            }
            ?>
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Foreign Income</h3>
                    <p>Click on "Add New Record" to report income&nbsp;derived from overseas entities.</p> <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
            <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                </div>
                <form id="formElement">
                    <div class="row col-md-12">
                        <div class="col-md-10">
                            <p>During the year did you own or have an interest in assets located outside of Australia which had a total value of $50,000 or more? </p>
                        </div>

                        <div class="input-group col-md-2">
                            <div class="col-sm-12"> 
                                <div class="input-group">
                                    <?php $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get(); ?>
                                    @foreach($yesnos as $yn)
                                    <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                        <input type="radio" id="interest_in_assest" name="interest_in_assest" value="{{$yn->yes_no_id}}" <?php 
                                        if($interest_in_assest == $yn->yes_no_id){
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
                    <br/>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <button type="button" class="btn btn-warning block btn-sm" onclick="ForeignIncomeRadioSave()"><i class="fa fa-plus">  </i> &nbsp; Add New Record</button><br/>
                        </div>
                    </div> <br/>
                </form>
                <br/><br/><br/><br/>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="SaveAndGo()"><i class="fa fa-forward"></i> Save and Go</button>

                        </div>
                    </div>
                </div>

            </div>



            </form>

        </div>
    </div>
</div>
</div>
<script>
    function ForeignIncomeRadioSave() {
        //alert($("#formElement").serialize());
        
        $.ajax({
            type: 'get',
            url: '{{ URL::to('ForeignIncomeRadioSave')}}',
            data: $("#formElement").serialize(),
            success: function (data) {
                window.location.href = "{{URL::to('/income/foreignIncome/income')}}";
            },
            error: function () {
            }
        });
    }
   function SaveAndGo() {
    var mainmenu = $("#mainmenu").val();
    var submenu = $("#submenu").val();
    $.ajax({
    type: 'get',
            url: '{{ URL::to('InterestDividendSaveGo')}}',
            data: {
            mainmenu: mainmenu,
                    submenu: submenu,
            },
            success: function (data) {
            window.location.href = data;
            },
            error: function () {
            }
    });
    }
</script>

@stop