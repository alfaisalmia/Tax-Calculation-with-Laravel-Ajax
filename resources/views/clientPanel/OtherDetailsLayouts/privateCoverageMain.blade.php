
@extends("clientPanel.clientPanelMaster")
@section('title', 'Private Insurance Coverage')
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
            ?>
            <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
            <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
       
          <div class="col-md-10 col-lg-10">
     
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Private Insurance Coverage</h3>
                    <h5>Click on "Add New Record" to report your private health insurance details. If you and all your dependents (including your spouse) were covered by appropriate hospital insurance for the full financial year, you may be exempted from the Medicare Levy Surcharge. Note: you should fill out the details exactly as shown on your Private Health Insurance Statement. If you are claiming your spouse's rebate, the system will automatically duplicate your entries for his/her insurance statement.</h5>

                </div>

                <br/>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/otherdetails/privateCoverage/PrivateHealthInsurance')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                    </div>
                </div> <br/>
                
                <br/>
<br/>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="SaveAndGo()"><i class="fa fa-forward"></i> Save and Go</button>

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