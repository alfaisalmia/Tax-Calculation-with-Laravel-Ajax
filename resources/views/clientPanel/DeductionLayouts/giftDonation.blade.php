
@extends("clientPanel.clientPanelMaster")
@section('title', 'Gifts to Charity')
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
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Gifts to Charity</h3>
                    <h5>Report your donations of money or goods to a qualifying gift recipient. Bucket donations of $2 or more to natural disaster relief organisations may also be deducted. If you do not have a receipt, you may still claim up to $10.</h5>

                </div>
                 
                <div class="col-sm-12 "> 
                    <form id="giftDonation">
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                    <div id="targetDIV">
                       <?php 
                       $user_id ='';
                       $AllDataGifts = DB::table('deduc_gifts_charity')->select('*')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                       foreach ($AllDataGifts as $sdf){
                           $user_id = $sdf->user_id;
                       }
                       if($user_id == Auth::User()->id){
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                           $i = 1;?>
                        <div class="row">
                              <div class="col-md-2" style="margin-top: 25px;">
                            <button  type="button" id="addMoreCapitalGains" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Add</button>
                        </div>
                        </div>
                        <?php
                           foreach ($AllDataGifts as $value) {
                           ?>
                         <div class="row">
                        <div class="form-group col-md-7">
                            <label for="charity_name">Name of Charity - If more than one, click the Add button to enter your details.</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                <input type="text" class="form-control" id="charity_name" name="charity_name[{{$i}}]" value="{{$value->charity_name}}">

                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="donation_Value">Value of Donation  </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="donation_Value" name="donation_Value[{{$i}}]" value="{{$value->donation_value}}" onkeypress="return isNumber(event)">

                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 25px;">
                            <button  type="button" id="" class="deleteCapital btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</button>
                        </div>
                    </div>
                           <?php $i++;} }else{ ?>
                         <div class="row">
                        <div class="form-group col-md-7">
                            <label for="charity_name">Name of Charity - If more than one, click the Add button to enter your details.</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                <input type="text" class="form-control" id="charity_name" name="charity_name[1]" value="">

                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="donation_Value">Value of Donation  </label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="donation_Value" name="donation_Value[1]" value="" onkeypress="return isNumber(event)">

                            </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 25px;">
                            <button  type="button" id="addMoreCapitalGains" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Add</button>
                        </div>
                    </div>
                       <?php } ?>
                   
                    </div>
                 </form>


                    <br/><br/><br/> 
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="GiftDonationDataSave()"><i class="fa fa-forward"></i>
<?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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
 var counter = 20;
    $("#addMoreCapitalGains").click(function () {
        $('<div class="row">\n\
                        <div class="form-group col-md-7">\n\
                            <label for="charity_name">Name of Charity - If more than one, click the Add button to enter your details.</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="charity_name" name="charity_name['+counter+']" value="">\n\
                            </div>\n\
                        </div>\n\
                        <div class="form-group col-md-3">\n\
                            <label for="donation_Value">Value of Donation  </label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="donation_Value" name="donation_Value['+counter+']" value="" onkeypress="return isNumber(event)">\n\
                            </div>\n\
                        </div>\n\
                        <div class="col-md-2" style="margin-top: 25px;">\n\
                            <button id="" class="deleteCapital btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</button>\n\
                        </div>\n\
                    </div>').appendTo("#targetDIV");
        counter++;
    });
    $("#targetDIV").on("click", "button.deleteCapital", function () {
            var checkstr = confirm('Are you sure you want to delete this item?');
    if (checkstr == true){
    $(this).closest('.row').remove();
    } else{
    return false;
    }
    });
    
    function GiftDonationDataSave(){
            $.ajax({
            type: 'get',
            url: '{{ URL::to('GiftDonationDataSave')}}',
            data: $("#giftDonation").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
            }
        });
    }
</script>
@stop