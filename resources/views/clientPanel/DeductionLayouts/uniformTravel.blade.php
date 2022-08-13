
@extends("clientPanel.clientPanelMaster")
@section('title', 'Uniform Travel')
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
$AllUniformDatas = DB::table('deduc_uniform_travel_first')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

$uniform_travel_id = "";
$user_id = "";
$tax_year_id = "";
$description = "";
$uniformfype_id = "";
$specifi_expense_id = "";
$expense_amount = "";

if (count($AllUniformDatas) > 0) {
    foreach ($AllUniformDatas as $inc_etp) {
       // $uniform_travel_id = $inc_etp->uniform_travel_id;
        $user_id = $inc_etp->user_id;
        $tax_year_id = $inc_etp->tax_year_id;
        $description = $inc_etp->description;
        $uniformfype_id = $inc_etp->uniformfype_id;
        $specifi_expense_id = $inc_etp->specifi_expense_id;
        $expense_amount = $inc_etp->expense_amount;
    }
}
//
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Uniform Travel</h3>
                    <h5>Enter the expenses you had for uniforms & protective clothing required by your occupation. </h5>

                </div>
                <div class="col-sm-12 "> 
                    <form    class="form-horizontal" name="report" id="UnitravelForm" method="POST">
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                        }
                        ?>
                        <div id="AddNewRow">
                            <?php
                            if ($user_id == Auth::User()->id) {
                                ?>
                                <div class="row col-sm-12">
                                    <button type="button" id="AddUniformTravel" class="btn btn-warning btn-sm" onclick=""><i class="fa fa-plus"></i>Add</button>
                                </div>

                                <?php
                                $i = 1;
                                foreach ($AllUniformDatas as $aud) {
                                    ?>

                                    <div class="row col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control" id="description" name="description[{{$i}}]" value="{{$aud->description}}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="uniformfype_id">Type of Uniform</label>
                                                <select id="uniformfype_id" class="form-control" name="uniformfype_id[{{$i}}]">
                                                    <option selected="selected" value="0">Select</option>
                                                    <?php
                                                    $uniforms = DB::table('tbl_uniformtype')->select('uniformtype_id', 'uniformtype_name')->get();
                                                    foreach ($uniforms as $uniform) {
                                                        if ($aud->uniformfype_id == $uniform->uniformtype_id) {
                                                            ?>
                                                            <option value="{{$uniform->uniformtype_id}}" selected="">{{$uniform->uniformtype_name}}</option>
                                                            <?php
                                                        } else {
                                                            ?> 
                                                            <option value="{{$uniform->uniformtype_id}}">{{$uniform->uniformtype_name}}</option>    
                                                        <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="specifi_expense_id">Specific Expense</label>
                                                <select id="specifi_expense_id" class="form-control" name="specifi_expense_id[{{$i}}]">
                                                    <option selected="selected" value="0">Select</option>
                                                    <?php
                                                    $specific_expenses = DB::table('tbl_specific_expense')->select('specificexpense_id', 'specificexpense_name')->get();
                                                    foreach ($specific_expenses as $sexpense) {
                                                        if ($aud->specifi_expense_id == $sexpense->specificexpense_id) {
                                                            ?>
                                                            <option value="{{$sexpense->specificexpense_id}}" selected="">{{$sexpense->specificexpense_name}}</option>
                                                            <?php
                                                        } else {
                                                            ?> 
                                                            <option value="{{$sexpense->specificexpense_id}}">{{$sexpense->specificexpense_name}}</option>
                                                        <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="expense_amt">Amount of Expense</label>
                                            <input type="text" class="form-control" id="expense_amt" name="expense_amt[{{$i}}]" value="{{$aud->expense_amount}}" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="col-md-1" style="margin-top: 25px;">
                                            <button type="button" id=" " class="deleteRow btn btn-danger btn-sm" onclick=""><i class="fa fa-remove"></i> Remove</button>
                                        </div>
                                    </div>
        <?php $i++;
    }
} else {
    ?>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" id="description" name="description[1]" value="" >
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="uniformfype_id">Type of Uniform</label>
                                            <select id="uniformfype_id" class="form-control" name="uniformfype_id[1]">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $uniforms = DB::table('tbl_uniformtype')->select('uniformtype_id', 'uniformtype_name')->get();
                                                foreach ($uniforms as $uniform) {
                                                    ?>
                                                    <option value="{{$uniform->uniformtype_id}}">{{$uniform->uniformtype_name}}</option>
        <?php
    }
    ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="specifi_expense_id">Specific Expense</label>
                                            <select id="specifi_expense_id" class="form-control" name="specifi_expense_id[1]">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $specific_expenses = DB::table('tbl_specific_expense')->select('specificexpense_id', 'specificexpense_name')->get();
                                                foreach ($specific_expenses as $sexpense) {
                                                    ?>
                                                    <option value="{{$sexpense->specificexpense_id}}">{{$sexpense->specificexpense_name}}</option>
        <?php
    }
    ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="expense_amt">Amount of Expense</label>
                                        <input type="text" class="form-control" id="expense_amt" name="expense_amt[1]" value="" onkeypress="return isNumber(event)">
                                    </div>
                                    <div class="col-md-1" style="margin-top: 25px;">
                                        <button type="button" id="AddUniformTravel" class="btn btn-warning btn-sm" onclick=""><i class="fa fa-plus"></i>Add</button>
                                    </div>
                                </div>
<?php } ?>

                        </div>
                        <h4 style="color:blue">Travel</h4>
                        <p>Report your unreimbursed work related travel expenses here. Click the info button for a full list of claimable expenses. </p>
                        <p><b>Do NOT claim any expenses related to your own car here (for example, fuels, registration, service cost, etc.). The use of your car for work purposes must be reported in the Car Expenses section. </b></p>
                        <p><i>Please note that travel to and from work is usually considered a private travel expense and is not claimable. </i></p>
                        <div id="targetDIV">
                            <?php
                            $userID ='';
                            $i = 1;
                            $AllUniformS = DB::table('deduc_uniform_travel_second')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                            foreach ($AllUniformS as $aus) {
                                $userID = $aus->user_id;
                            }
                            if ($userID == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode2" name="mode2" value="1">';
                        
                                ?>
                                <div class="row col-md-12">
                                    <button type="button" id="AndSecond" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Add</button>
                                </div>
    <?php foreach ($AllUniformS as $aus) {
        ?>
                                    <div class="row col-sm-12">
                                        <div class="form-group col-md-5">
                                            <label for="description2">Description</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-commenting color_blue"></i></span>
                                                <input type="text" class="form-control" id="description2" name="descriptionTwo[{{$i}}]" value="{{$aus->descriptionTwo}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="amount2">Amount</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="amount2" name="amountTwo[{{$i}}]" value="{{$aus->amountTwo}}" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="margin-top: 25px;">
                                            <button type="button" id="" class="deleteRoww btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</button>
                                        </div>
                                    </div>
        <?php
        $i++;
    }
} else {
    ?>
                                <div class="row col-sm-12">
                                    <div class="form-group col-md-5">
                                        <label for="description2">Description</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-commenting color_blue"></i></span>
                                            <input type="text" class="form-control" id="description2" name="descriptionTwo[1]" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="amount2">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="amount2" name="amountTwo[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button type="button" id="AndSecond" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Add</button>
                                    </div>
                                </div>
<?php } ?>


                        </div> 
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="UniformTravelDataSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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
    var counter = 20;
    $("#AddUniformTravel").click(function () {
        $('<div class="row col-sm-12">\n\
                            <div class="col-sm-4">\n\
                                <div class="form-group">\n\
                                    <label for="description">Description</label>\n\
                                    <input type="text" class="form-control" id="description" name="description[' + counter + ']" value="" >\n\
                                </div>\n\
                            </div>\n\
                            <div class="col-sm-3">\n\
                                <div class="form-group">\n\
                                    <label for="uniformfype_id">Type of Uniform</label>\n\
                                    <select id="uniformfype_id" class="form-control" name="uniformfype_id[' + counter + ']">\n\
                                        <option selected="selected" value="0">Select</option>\n\
<?php
$uniforms = DB::table('tbl_uniformtype')->select('uniformtype_id', 'uniformtype_name')->get();
foreach ($uniforms as $uniform) {
    ?><option value="{{$uniform->uniformtype_id}}">{{$uniform->uniformtype_name}}</option><?php } ?>\n\
                                    </select>\n\
                                </div>\n\
                            </div>\n\
                            <div class="col-sm-2">\n\
                                <div class="form-group">\n\
                                    <label for="specifi_expense_id">Specific Expense</label>\n\
                                    <select id="specifi_expense_id" class="form-control" name="specifi_expense_id[' + counter + ']">\n\
                                        <option selected="selected" value="0">Select</option>\n\
<?php
$specific_expenses = DB::table('tbl_specific_expense')->select('specificexpense_id', 'specificexpense_name')->get();
foreach ($specific_expenses as $sexpense) {
    ?><option value="{{$sexpense->specificexpense_id}}">{{$sexpense->specificexpense_name}}</option><?php } ?>\n\
                                    </select>\n\
                                </div>\n\
                            </div>\n\
                            <div class="form-group col-md-2">\n\
                                <label for="expense_amt">Amount of Expense</label>\n\
                                <input type="text" class="form-control" id="expense_amt" name="expense_amt[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                            </div>\n\
                            <div class="col-md-1" style="margin-top: 25px;">\n\
                                <button type="button" id=" " class="deleteRow btn btn-danger btn-sm" onclick=""><i class="fa fa-remove"></i> Remove</button>\n\
                            </div>\n\
                    </div>').appendTo("#AddNewRow");
        counter++;
    });
    $("#AddNewRow").on("click", "button.deleteRow", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    });

    var counter = 20;
    $("#AndSecond").click(function () {
        $(' <div class="row col-sm-12">\n\
                        <div class="form-group col-md-5">\n\
                            <label for="description2">Description</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-commenting color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="description2" name="descriptionTwo[' + counter + ']" value="">\n\
                            </div>\n\
                        </div>\n\
                        <div class="form-group col-md-5">\n\
                            <label for="amount2">Amount</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="amount2" name="amountTwo[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                            </div>\n\
                        </div>\n\
                        <div class="col-md-2" style="margin-top: 25px;">\n\
                            <button type="button" id="" class="deleteRoww btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</button>\n\
                        </div>\n\
                    </div>').appendTo("#targetDIV");
        counter++;
    });
    $("#targetDIV").on("click", "button.deleteRoww", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    })

    function UniformTravelDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('UniformTravelDataSave')}}',
            data: $("#UnitravelForm").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
            }
        });
    }
</script>
@stop