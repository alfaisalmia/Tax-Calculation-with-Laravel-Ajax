
@extends("clientPanel.clientPanelMaster")
@section('title', 'Remote Zone or Overseas Forces Tax Offset')
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
            $allZones = DB::table('od_zone_offset')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

            $zone_offset_id = "";
            $user_id = "";
            $zoneA_days_resided = "";
            $zoneA_allowances_received = "";
            $zoneB_days_resided = "";
            $zoneB_allowances_received = "";
            $specialArea_days_resided = "";
            $specialArea_allowances_received = "";
            $OverseasForces_days_resided = "";
            $OverseasForces_allowances_received = "";
            
            
            if (count($allZones) > 0) {
                foreach ($allZones as $inc_etp) {
                    $zone_offset_id = $inc_etp->zone_offset_id;
                    $user_id = $inc_etp->user_id;
                    $zoneA_days_resided = $inc_etp->zoneA_days_resided;
                    $zoneA_allowances_received = $inc_etp->zoneA_allowances_received;
                    $zoneB_days_resided = $inc_etp->zoneB_days_resided;
                    $zoneB_allowances_received = $inc_etp->zoneB_allowances_received;
                    $specialArea_days_resided = $inc_etp->specialArea_days_resided;
                    $specialArea_allowances_received = $inc_etp->specialArea_allowances_received;
                    $OverseasForces_days_resided = $inc_etp->OverseasForces_days_resided;
                    $OverseasForces_allowances_received = $inc_etp->OverseasForces_allowances_received;
                }
            }
            ?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">

          <div class="col-md-10 col-lg-10">
   
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Remote Zone or Overseas Forces Tax Offset</h3>
                    <h5>From 1 July 2015, to be eligible for the Zone tax offset your usual place of residence must be in a zone. The ATO advised that 'Fly-in-fly-out' and 'drive-in-drive-out' (FIFO) workers cannot claim the Zone tax offset as their normal residence is not within a 'zone'.</h5>

                </div>

                <div class="">
                    <div class="col-md-12">
                        <p><b>You must enter the correct zone. Click the information button to access the ATO list. If you are still not sure which zone to claim, you may ring the ATO's Personal Tax Infoline (13 28 61).
                            </b></p>
                    </div>
                </div>
                <form id="zoneOffsetForm">
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="zone_offset_id" name="zone_offset_id" value="' . $zone_offset_id . '">';
                        }
                        ?>
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <td>Days Resided</td>
                            <td>Allowances Received</td>
                        </tr>

                        <tr>
                            <th scope="row">Zone A</th>
                            <td> <input type="text" class="form-control" id="zoneA_days_resided" name="zoneA_days_resided" value="{{$zoneA_days_resided}}" onkeypress="return isNumber(event)"></td>
                            <td> <input type="text" class="form-control" id="zoneA_allowances_received" name="zoneA_allowances_received" value="{{$zoneA_allowances_received}}" onkeypress="return isNumber(event)"></td>
                        </tr>
                        <tr>
                            <th scope="row">Zone B</th>
                            <td> <input type="text" class="form-control" id="zoneB_days_resided" name="zoneB_days_resided" value="{{$zoneB_days_resided}}" onkeypress="return isNumber(event)"></td>
                            <td> <input type="text" class="form-control" id="zoneB_allowances_received" name="zoneB_allowances_received" value="{{$zoneB_allowances_received}}" onkeypress="return isNumber(event)"></td>
                        </tr>
                        <tr>
                            <th scope="row">Special Area</th>
                            <td> <input type="text" class="form-control" id="specialArea_days_resided" name="specialArea_days_resided" value="{{$specialArea_days_resided}}" onkeypress="return isNumber(event)"></td>
                            <td> <input type="text" class="form-control" id="specialArea_allowances_received" name="specialArea_allowances_received" value="{{$specialArea_allowances_received}}" onkeypress="return isNumber(event)"></td>
                        </tr>
                        <tr>
                            <th scope="row">Overseas Forces</th>
                            <td> <input type="text" class="form-control" id="OverseasForces_days_resided" name="OverseasForces_days_resided" value="{{$OverseasForces_days_resided}}" onkeypress="return isNumber(event)"></td>
                            <td> <input type="text" class="form-control" id="OverseasForces_allowances_received" name="OverseasForces_allowances_received" value="{{$OverseasForces_allowances_received}}" onkeypress="return isNumber(event)"></td>
                        </tr>

                    </table>
                </div>
                <div class="form-check col-sm-12">
                    <label class="containerss">Click here if in the 2017-2018 tax year you did not qualify for the Zone Offset because you resided in a zone or special area for less than 183 days. 
                        <input type="checkbox" value="1" name="">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="zoneOffsetSaveData()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                        </div>
                    </div>
                </div>
           </form> </div>



            

        </div>
    </div>
</div>
</div>
<script>
function zoneOffsetSaveData(){
            $.ajax({
            type: 'get',
            url: '{{ URL::to('ZoneOffsetSaveData')}}',
            data: $("#zoneOffsetForm").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
            }
        });
}
</script>
@stop