
@extends("clientPanel.clientPanelMaster")
@section('title', 'Tax Offsets & Other Details')
@section("content")


<div class="ulockd-service-details">
    <div class="container"> 
          <div class="col-md-10 col-lg-10">
      
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Tax Offsets & Other Details</h3>
                    <h5><b>Select from the list below the type of offsets or rebates you would like to claim. Did you have out-of-pocket medical expenses?</b>If yes, select that item below then click it in the left column to begin entering your information.</h5>
                </div>
                <hr>
                <div class="col-sm-12 ">

                    <hr>
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

                        $checklistss = DB::table('tbl_checklist_menu')
                                ->select('tbl_checklist_menu.*', 'tbl_submenu_permi.submenu_id as subid', 'tbl_submenu_permi.status','tbl_submenu_permi.user_id')
                                ->leftjoin('tbl_submenu_permi', 'tbl_submenu_permi.submenu_id', '=', 'tbl_checklist_menu.submenu_id') 
                                ->where("tbl_checklist_menu.mainmenu_id",$original_id)
                                //->where("tbl_checklist_menu.user_id",Auth::User()->id)
                                ->orderBy('checklistmenu_id', "asc")
                                ->get();
//                        echo "<pre>";
//                        print_r($checklistss);
//                        echo "</pre>";
                        foreach ($checklistss as $check) {
                            ?>
                            <div class="form-check col-sm-12">
                                <label class="containerss" >{{$check->checklistmenu_name}}
                                        <input type="checkbox" <?php
                                    if ($check->subid == $check->submenu_id && $check->status == 1 && $check->user_id == Auth::User()->id ) {
                                        echo "checked";
                                    }
                                    ?> value="{{$check->checklistmenu_id}}" onclick="checklistSelect({{$check->submenu_id}},{{$original_id}},{{$check->status}})">
                                    <span class="checkmark"></span>
                                </label><p>{{$check->checklistmenu_desc}}</p>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                      <br/>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
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
 
    function checklistSelect(submenu_id, mainmenu_id, status) {
    var submenu_id = submenu_id;
    var mainmenu_id = mainmenu_id;
    var status = status;
    $.ajax({
    type: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to('checklistSelect')}}',
            data:{
            submenu_id: submenu_id,
                    mainmenu_id: mainmenu_id,
                    status: status
            },
            success: function (data) {
            if (data) {
            location.reload();
             
            //window.location.href = "{{URL::to('/allottee')}}";
            }
            },
            error: function () {
            alert("Ajax Error");
            }
    })

    }
</script>

@stop