
@extends("clientPanel.clientPanelMaster")
@section('title', 'Allowances & Other Income')
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

//
$other_incom_id = "";
$user_id = "";
$payer_abn = "";
$allowance_other_income_id = "";
$income = "";
$tax_withheld = "";

$AllOtehrIncDatas = DB::table('inc_other_income')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
if (count($AllOtehrIncDatas) > 0) {
    foreach ($AllOtehrIncDatas as $cgm) {
        $other_incom_id = $cgm->other_incom_id;
        $user_id = $cgm->user_id;
        $payer_abn = $cgm->payer_abn;
        $allowance_other_income_id = $cgm->allowance_other_income_id;
        $income = $cgm->income;
        $tax_withheld = $cgm->tax_withheld;
    }
}
?>
<div class="ulockd-service-details">
    <div class="container"> 
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Allowances & Other Income</h3>
                    <h5>Report your other income: Allowances from Government council or Dept of Human Services not entered elsewhere, tips, director fees, life insurance bonus, professional income, other salary/wage (e.g. cash payments for services or jury fees), other non-provisional income, etc. <b>Do not report here those allowances you have already entered in the Wages & Salary section.</b></h5>
                    <p style="color: red"><b>If you are an ABN holder, you must NOT include that income here.</b></p>
                    <p style="">Income from a business you operate should be entered as a <a href="#" class="our_link color_blue" >Business Schedule.</a></p>
                </div>
                <hr>
                <div class="col-sm-12 ">
                    <h5 class="color_blue">Employer's Information:</h5>
                    <form id="OtherIncomeFormElement">
                        {{csrf_field()}}
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
echo '<input type="hidden" class="form-control" id="other_incom_id" name="other_incom_id" value="' . $other_incom_id . '">';
                        }
                        ?>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="payer_abn">Payer's ABN (not required)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                <input type="text" class="form-control" id="payer_abn" name="payer_abn" value="{{$payer_abn}}" onkeypress="return isNumber(event)">   
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="description">Description</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                <select id="description" class="form-control" name="description">
                                    <option selected="selected" value="0">Select</option>
                                    <?php
                                    $allowance_incomes = DB::table('tbl_allowance_other_income')->select('allowance_other_income_id', 'allowance_other_income_name')->get();
                                    foreach ($allowance_incomes as $allowance_incom) {
                                        if($allowance_other_income_id == $allowance_incom->allowance_other_income_id){
                                        ?>
                                    <option value="{{$allowance_incom->allowance_other_income_id}}" selected="">{{$allowance_incom->allowance_other_income_name}}</option>
                                        <?php
                                        }else{
                                    ?>
                                        <option value="{{$allowance_incom->allowance_other_income_id}}">{{$allowance_incom->allowance_other_income_name}}</option>
                                    <?php }
                                    
                                        } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="income">Income</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="income" name="income" value="{{$income}}" onkeypress="return isNumber(event)">   
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="tax_withheld">Tax Withheld</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                <input type="text" class="form-control" id="tax_withheld" name="tax_withheld" value="{{$tax_withheld}}" onkeypress="return isNumber(event)">   
                            </div>
                        </div>
                    </div>

                    <!--#######################################################-->



                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="OtherIncomeFormDataSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
function OtherIncomeFormDataSave() {
 $.ajax({
            type: 'get',
            url: '{{ URL::to('OtherIncomeFormDataSave')}}',
            data: $("#OtherIncomeFormElement").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
                alert("Failed ! Please try again later.");
            }
        });   
}
</script>

@stop