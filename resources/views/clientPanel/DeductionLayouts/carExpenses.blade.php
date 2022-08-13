
@extends("clientPanel.clientPanelMaster")
@section('title', 'Car Expenses')
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

            ?>
       <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
            <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
       
           <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Car Expenses</h3>
                    <h5>Click on "Add New Record" to input your work related vehicle expense information. 
</h5>

                </div>

                <div class="">
                    <div class="col-md-12">
                        <p>You may be able to claim for use of your private car if it is necessary for employment or business use. Keep a diary record of trips you make which are necessarily incurred in earning your income, for self education or directly from one job to a second job. If you travel more than 5000 km you should complete a Motor Vehicle log book to maximise your claim. <a href="" class="color_blue our_link">Click here to download a Motor Vehicle Record Card Template.</a></p>
                        <p><i>Please note that travel to and from work is generally considered a private expense and cannot be claimed as a deduction.</i></p>
                    </div>
                </div><br/>

                <br/>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/deduction/carExpenses/vehicleExpenses')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                    </div>
                </div> <br/>
              <br/><br/><br/>
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