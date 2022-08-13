
@extends("clientPanel.clientPanelMaster")
@section('title', 'Interest & Dividend ')
@section("content")

<!-- Inner Pages Main Section -->
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
            ?>
            <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
            <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Interest & Dividend</h3>
                    <h5>Simply click on Add new Record to input your interest and divided disbursements </h5>
                </div>
                <div class="">
                    <div class="col-md-12">
                        <h4 style="color:blue">Interest</h4>
                    </div>
                </div><br/>

                <br/>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/income/interestDividends/interestIncome')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                    </div>
                </div> <br/><hr/>
                <div class="">
                    <div class="col-md-12">
                        <h4 style="color:blue">Dividend</h4>
                    </div>
                </div><br/>

                <br/>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/income/interestDividends/dividendIncome')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                    </div>
                </div> <br/>




                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="InterestDividendSaveGo()"><i class="fa fa-forward"></i> Save and Go</button>

                        </div>
                    </div>
                </div>
                <br/>
            </div>



            </form>

        </div>
    </div>
</div>
</div>
<script>
    function InterestDividendSaveGo() {
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