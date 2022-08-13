
@extends("clientPanel.clientPanelMaster")
@section('title', 'Foreign Income')
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

$interest_in_assest = Session::get('interest_in_assest');
$allDatas = DB::table('inc_foreign_income')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

$foreign_income_id = "";
$user_id = "";
$interest_in_assest = "";
$description = "";
$type = "";
$tax_attemp_inc_rec = "";
$inc_recv_tax = "";
$dedc_expenses = "";
$foreign_tax_paid = "";
if (count($allDatas) > 0) {
    foreach ($allDatas as $data) {
        $foreign_income_id = $data->foreign_income_id;
        $user_id = $data->user_id;
        $interest_in_assest = $data->interest_in_assest;
        $description = $data->description;
        $type = $data->type;
        $tax_attemp_inc_rec = $data->tax_attemp_inc_rec;
        $inc_recv_tax = $data->inc_recv_tax;
        $dedc_expenses = $data->dedc_expenses;
        $foreign_tax_paid = $data->foreign_tax_paid;
    }
}
?>

<div class="ulockd-service-details">
    <div class="container"> 
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Foreign Income</h3>
                    <h5>Please describe income derived from foreign investments or activities</h5>
                </div>
                <form id="foreignIncomFormElement">
                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" />  <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                    <?php
                    if ($user_id == Auth::User()->id) {
                        echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                        echo '<input type="hidden" class="form-control" id="etp_id" name="foreign_income_id" value="' . $foreign_income_id . '">';
                    }
                    ?>
                    <div class="col-sm-12 ">
                        <input type="hidden" class="form-control" id="interest_in_assest" name="interest_in_assest" value="{{$interest_in_assest}}">
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="description">Description</label><div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-address-book color_blue"></i></span>
                                    <input type="text" class="form-control" id="description" name="description" value="{{$description}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="type">Type</label><div                                                 class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="type" class="form-control" name="type">
                                        <option selected="selected" value="0">Select</option>
                                        <?php
                                        $tbl_foreign_income_types = DB::table('tbl_foreign_income_type')->select('foreign_income_type_id', 'foreign_income_type_name')->get();
                                        foreach ($tbl_foreign_income_types as $income_types) {
                                            if ($type == $income_types->foreign_income_type_id) {
                                                ?>
                                                <option value="{{$income_types->foreign_income_type_id}}" selected="">{{$income_types->foreign_income_type_name}}</option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="{{$income_types->foreign_income_type_id}}" >{{$income_types->foreign_income_type_name}}</option>  
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!--#######################################################-->
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="tax_attemp_inc_rec">Tax Exempt Income Received </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="tax_attemp_inc_rec" name="tax_attemp_inc_rec" value="{{$tax_attemp_inc_rec}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="inc_recv_tax">Income Received including Taxes Paid </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="inc_recv_tax" name="inc_recv_tax" value="{{$inc_recv_tax}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="dedc_expenses">Deductible Expenses </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="dedc_expenses" name="dedc_expenses" value="{{$dedc_expenses}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-5">
                                <label for="foreign_tax_paid">Foreign Taxes Paid</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="foreign_tax_paid" name="foreign_tax_paid" value="{{$foreign_tax_paid}}" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="ForeignIncomeFormDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--#######################################################-->

                <div class="col-sm-12">

                </div>

                <br/><br/><br/> <br/><br/> <br/>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function ForeignIncomeFormDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('ForeignIncomeFormDataSave')}}',
            data: $("#foreignIncomFormElement").serialize(),
            success: function (data) {
               var url = $(location).attr('href');
                var subUrl = url.substring(0, url.lastIndexOf("/"))
                var sdas = subUrl.substring(0, subUrl.lastIndexOf("/"))
                var mainurl = sdas + "/" + data;
                window.location.href = mainurl;
            },
            error: function () {
                alert("Failed ! Please try again later.");
            }
        });

    }
</script>

@stop