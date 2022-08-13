
@extends("clientPanel.clientPanelMaster")
@section('title', 'Income Received')
@section("content")


<div class="ulockd-service-details">
    <div class="container"> 
        <div class="col-md-10 col-lg-10">
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Income Received</h3>
                    <h5>Select the types of income you earned from the list below. Then click the income item in the left column to start inputing your information.</h5>
                    <h5><i>Report any payments you may have received from Centrelink, such as Newstart Allowance or Austudy, as these are considered taxable income.</i></h5>
                    <h5><i>Your income information will not be automatically pre-filled based on your TFN.
                        </i></h5>
                </div>
                <div class="col-sm-12 ">

                    <h5 class="color_blue">Check all that apply:</h5>
                    <div class="row">
                        <?php
                        $segment1 = Request::segment(1);
                        $segment2 = Request::segment(2);
                        $menu_part = ucwords($segment1);
                        //echo $menu_part;die();
                        $mainmenu_id_arr = DB::table('tbl_mainmenu')->select("mainmenu_id")->where('mainmenu_name', $menu_part)->get()->toArray();
                        foreach ($mainmenu_id_arr as $d) {
                            $original_id = $d->mainmenu_id;
                        }
//echo Auth::User()->id;
                        $checklistss = DB::table('tbl_checklist_menu')
                                ->select('tbl_checklist_menu.*')
                                // ->leftjoin('tbl_submenu_permi', 'tbl_submenu_permi.submenu_id', '=', 'tbl_checklist_menu.submenu_id')
                                ->where("tbl_checklist_menu.mainmenu_id", $original_id)
                                //->where("tbl_submenu_permi.user_id",Auth::User()->id)
                                ->orderBy('checklistmenu_id', "asc")
                                ->get();

                        $submenu_permissionsee = DB::table('tbl_submenu_permi')
                                ->select('*')
                                ->where("tbl_submenu_permi.user_id", Auth::User()->id)
                                ->get();
//                        echo "<pre>";
//                        print_r($submenu_permissions);
//                        echo "</pre>";
                        foreach ($checklistss as $check) {
                                  $submenu_permissions = DB::table('tbl_submenu_permi')
                                                   ->select('tbl_submenu_permi.*')
                                                   ->leftjoin('tbl_checklist_menu', 'tbl_checklist_menu.checklistmenu_id', '=', 'tbl_submenu_permi.checklist_menu_id')
                                                   ->where("tbl_submenu_permi.user_id", Auth::User()->id)
                                                   ->where("tbl_submenu_permi.mainmenu_id", $original_id)
                                                   ->get();

//                                           echo "<pre>";
//                                           print_r($submenu_permissions);
//                                           echo "</pre>";
//                                           die();
                            ?>
                            <div class="form-check col-sm-12">
                                <label class="containerss" style="color: black">{{$check->checklistmenu_name}}
                                    <input type="checkbox" 
                                           <?php         
                                           foreach ($submenu_permissions as $submenu_per) {
                                               if ($submenu_per->checklist_menu_id == $check->checklistmenu_id && $submenu_per->status == 1 && $submenu_per->user_id == Auth::User()->id) {
                                                   echo 'checked="checked"';
                                               }
                                           }
                                           ?> value="" onclick="checklistSelect({{$check->submenu_id}},{{$original_id}},{{$check->checklistmenu_id}})" name="status" id="status">
                                    <span class="checkmark"></span>
                                </label><p><i>{{$check->checklistmenu_desc}}</i></p>
                               
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <br/>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group">
                                <a href="{{URL('/personalinfo/summary')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-forward"></i> Save and Go</button>
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
       $("#preloader").show();
    function checklistSelect(submenu_id, mainmenu_id, checklistmenu_id) {
    $("#preloader").show();
    var submenu_id = submenu_id;
    var mainmenu_id = mainmenu_id;
    var checklistmenu_id = checklistmenu_id;
    $.ajax({
    type: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to('checklistSelect')}}',
            data:{
            submenu_id: submenu_id,
                    mainmenu_id: mainmenu_id,
                    checklistmenu_id: checklistmenu_id,
            },
            success: function (data) {
            if (data) {
            location.reload();
            }
            },
            error: function () {
            alert("Ajax Error");
            }
    })

    }


</script>
@stop 