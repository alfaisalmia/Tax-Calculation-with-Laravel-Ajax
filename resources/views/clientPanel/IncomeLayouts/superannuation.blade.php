
@extends("clientPanel.clientPanelMaster")
@section('title', 'Superannuation ')
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
            ?>
         <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
            <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
         <div class="col-md-10 col-lg-10">
    
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Superannuation Income Stream, Annuity or Pension</h3>
                    <h5>Click on "Add New Record" to report your income reported on a PayG Summary - Superannuation Income Stream, Australia annuity, superannuation, pension fund or other HSA provider. If you are receiving government pensions or annuities, enter that as CentreLink income.</h5>

                </div>

                <div class="">
                    <div class="col-md-12">
                        <p>Please do not enter the Departing Australia Superannuation Payments (DASP).</p>
                    </div>
                </div><br/>

                <br/>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/income/superannuation/incomeStream')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                    </div>
                </div> <br/>
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Superannuation Lump Sum Payments</h3>
                    <h5>Click on "Add New Record" to input your lump sum payments from superannuation funds, approved deposit funds, retirement savings account providers, and life insurance companies.</h5>

                </div>

                <div class="">
                    <div class="col-md-12">
                        <p>Please do not enter the Departing Australia Superannuation Payments (DASP).</p>
                    </div>
                </div><br/><br/><br/>

                <br/>
                 <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/income/superannuation/lumsumPayments')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                    </div>
                </div> <br/><br/><br/><br/>

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