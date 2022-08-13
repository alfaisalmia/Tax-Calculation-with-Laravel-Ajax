
@extends("clientPanel.clientPanelMaster")
@section('title', 'Depreciation Deduction')
@section("content")
<?php
$DepDeductions = DB::table('deduc_depreciation_deduction_self')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

            $depreciation_deduc_id = "";
            $user_id = "";
            $brief_description = "";
            $original_cost = "";
            $property_type_id = "";
            $description_method_id = "";
            $first_use_date = "";
            $business_use = "";
            $life_in_year = "";
            $part_of_year_id = "";
            $depreciation_rate = "";
            $sell_or_dispose_yes_no_id = "";
            if (count($DepDeductions) > 0) {
                foreach ($DepDeductions as $inc_etp) {
                    $depreciation_deduc_id = $inc_etp->depreciation_deduc_id;
                    $user_id = $inc_etp->user_id;
                    $brief_description = $inc_etp->brief_description;
                    $original_cost = $inc_etp->original_cost;
                    $property_type_id = $inc_etp->property_type_id;
                    $description_method_id = $inc_etp->description_method_id;
                    $first_use_date = $inc_etp->first_use_date;
                    $business_use = $inc_etp->business_use;
                    $life_in_year = $inc_etp->life_in_year;
                    $part_of_year_id = $inc_etp->part_of_year_id;
                    $depreciation_rate = $inc_etp->depreciation_rate;
                    $sell_or_dispose_yes_no_id = $inc_etp->sell_or_dispose_yes_no_id;
                }
            }
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
            <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Depreciation Deduction---</h3>
                    <h5>Please list the depreciation of your work related items. Any items that you used for work purposes (e.g. computer) that has a value of greater than $300 should be reported as a depreciating asset.</h5>

                </div>
                <form id="DepDeduForm">
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="depreciation_deduc_id" name="depreciation_deduc_id" value="' . $depreciation_deduc_id . '">';
                        }
                        ?>
                <div class="col-sm-12 "> 
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="brief_description">Brief Description of Property</label>
                           <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                            <input type="text" class="form-control" id="brief_description" name="brief_description" value="{{$brief_description}}">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="original_cost">Original Value or Cost</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="original_cost" name="original_cost" value="{{$original_cost}}" onkeypress="return isNumber(event)">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Property Type </label>
<div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                            <select id="property_type_id" class="form-control" name="property_type_id">
                                <option selected="selected" value="0">Select</option>
                                <?php
                                $propertytypes = DB::table('tbl_property_type')->select('property_type_id', 'property_type_name')->get();
                                foreach ($propertytypes as $ptype) {
                                    if($property_type_id == $ptype->property_type_id){
                                    ?>
                            <option value="{{$ptype->property_type_id}}" selected="">{{$ptype->property_type_name}}</option>
                                    <?php
                                }else{
                                ?> 
                                     <option value="{{$ptype->property_type_id}}">{{$ptype->property_type_name}}</option> 
                                <?php } }?> 
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Depreciation Method</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                            <select id="description_method_id" class="form-control" name="description_method_id">
                                <option selected="selected" value="0">Select</option>
                                <?php
                                $Daddes = DB::table('tbl_depreciation_method')->select('depreciation_method_id', 'depreciation_method_name')->get();
                                foreach ($Daddes as $dd) {
                                    if($description_method_id == $dd->depreciation_method_id){
                                    ?>
                            <option value="{{$dd->depreciation_method_id}}" selected="">{{$dd->depreciation_method_name}}</option>
                                    <?php
                                }else{
                                ?> 
                                     <option value="{{$dd->depreciation_method_id}}">{{$dd->depreciation_method_name}}</option> 
                                <?php } }?> 

                            </select>
                        </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Date First Placed in Use (dd/mm/yyyy)</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                            <input type="text" class="datepicker form-control datepicker" id="first_use_date" name="first_use_date" value="{{ \Carbon\Carbon::parse($first_use_date)->format('d/m/Y')}}">
                        </div>

                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="business_use">Business Use %</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-percent color_blue"></i></span>
                                    <input type="text" class="form-control" id="business_use" name="business_use" value="{{$business_use}}" onkeypress="return isNumber(event)"> 
                            </select>
                        </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="life_in_year">Effective Life in Year(s)</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                            <select id="life_in_year" class="form-control" name="life_in_year">
                                <option selected="selected" value="0">Select</option>
                                <?php
                                for ($i = 1; $i < 100; $i++) {
                                    if($life_in_year == $i){
                                    ?>
                                <option value="{{$i}}" selected="">{{$i}}</option>
                                    <?php
                                }else{
                                ?> 
                                     <option value="{{$i}}">{{$i}}</option>
                                <?php }} ?>
                            </select>
                        </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="part_of_year">Part of Year</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                            <select id="part_of_year_id" class="form-control" name="part_of_year_id">
                                <option selected="selected" value="0">Select</option>
                               <?php
                                $PoTYs = DB::table('tbl_parts_of_year')->select('part_of_year_id', 'part_of_year_name')->get();
                                foreach ($PoTYs as $pty) {
                                    if($part_of_year_id == $pty->part_of_year_name){
                                    ?>
                            <option value="{{$pty->part_of_year_id}}" selected="">{{$pty->part_of_year_name}}</option>
                                    <?php
                                }else{
                                ?> 
                                     <option value="{{$pty->part_of_year_id}}">{{$pty->part_of_year_name}}</option> 
                                <?php } }?> 

                            </select>
                        </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="depreciation_rate">Depreciation Rate (%)</label>
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-percent color_blue"></i></span>
                                    <input type="text" class="form-control" id="depreciation_rate" name="depreciation_rate" value="{{$depreciation_rate}}" onkeypress="return isNumber(event)">
                        </div>
                        </div>

                          <div class="row col-md-12">
                        <div class="col-md-6">
                            <p>Did you sell or dispose the item?</p>
                        </div>
                        <div class="input-group col-md-6">
                            <div class="col-sm-12"> 
                                <div class="input-group">
                                    <?php $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get(); ?>
                                    @foreach($yesnos as $yn)
                                    <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                        <input type="radio" id="sell_or_dispose_yes_no_id" name="sell_or_dispose_yes_no_id" value="{{$yn->yes_no_id}}" <?php
                                        if ($sell_or_dispose_yes_no_id == $yn->yes_no_id) {
                                            echo "checked";
                                       }
                                        ?> onclick="postalAddressChang()">
                                        <span class="checkmark_radio"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><br/>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div class="col-md-8 col-md-offset-2">
                            <button class="btn btn-default  block btn-sm"><i class="fa fa-calculator"></i>&nbsp;CLICK HERE TO CALCULATE DEDUCTION</button>
                        </div>
                    </div>
                </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="DeprecativeDeducDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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

function DeprecativeDeducDataSave(){
          $.ajax({
            type: 'get',
            url: '{{ URL::to('DeprecativeDeducDataSaveSelf')}}',
            data: $("#DepDeduForm").serialize(),
            success: function (data) {
                 window.location.href = "{{URL::to('deduction/selfEducation')}}";
             },
            error: function () {
            }
        });
}
</script>
@stop