
@extends("clientPanel.clientPanelMaster")
@section('title', 'Business, Rental & Personal Service Income')
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
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
 <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
            <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
          <div class="col-md-10 col-lg-10">
            <div class="row">
                <div class="col-md-12 ulockd-mrgn1210">
                    <div class="ulockd-project-sm-thumb">
                        <img class="img-responsive img-whp" src="images/blog/blog-details.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Business, Rental & Personal Service Income</h3>
                    <h5>Simply click on "Add New Record" to input your Business, Rental, or Non-Attributed Personal Service Income Records.</h5>

                </div>


                <div class="">
                    <div class="col-md-12">
                        <p>If you have an individual ABN, enter the income earned in the Business Schedule below.</p> <div class="alert alert-info">
                            <strong>Business Account</strong> 
                        </div>
                    </div>
                </div><br/>

                <br/>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/income/businessRental/businessIncome')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                    </div>
                </div> <br/>

                <div class="">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <strong>Rental Income</strong> 
                        </div>
                        <p>A rental property card may be used for the recording of general expenses incurred as an owner of a rental property for the Financial Year. You will need to ensure you keep your receipts for all items recorded within.</p><a href="" class="our_link color_blue">Click here to download a Rental Property Record Card Template. </a></p> 
                    </div>
                </div>

                <br/>
               
                <div class="row">

                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/income/businessRental/RentalIncome')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                    </div>
                </div> <br/>
 <div class="">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <strong>Non-Attributed Personal Services Income</strong> 
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ulockd-mrgn1210">

                <br/>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <a href="{{URL('/income/businessRental/nonPSI')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
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