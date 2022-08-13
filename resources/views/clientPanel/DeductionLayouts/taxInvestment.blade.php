
@extends("clientPanel.clientPanelMaster")
@section('title', 'Tax Lodgement Expenses')
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
        <div class="col-md-8 col-lg-9">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Tax Lodgement Expenses</h3>
                    <h5>List here all the expenses related to managing your tax affairs. These include fees you paid to receive advice from a tax agent, the cost of preparing & lodging your tax return, and any related travel expenses. When done, click the Add button to save your information.</h5>

                </div>
                <form id="taxInvestmentForm">
                    <div class="col-sm-12 "> 
                                                <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <div id="targetDIV">
                            <?php
                            $user_id = '';
                            $AllDatataxs = DB::table('deduc_tax_investment')->select('*')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                            foreach ($AllDatataxs as $sdf) {
                                $user_id = $sdf->user_id;
                            }
                            if ($user_id == Auth::User()->id) {
                                echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                                $i = 1;
                                ?>
                                <div class="row">
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button  type="button" id="addMore" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Add</button>
                                    </div>
                                </div>
                                <?php
                                $i = 1;
                                foreach ($AllDatataxs as $value) {
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="description">Description </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-gg color_blue"></i></span>
                                                <input type="text" class="form-control" id="description" name="description[{{$i}}]" value="{{$value->description}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="tax_lodgement_expenses_id">Type </label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                                <select id="tax_lodgement_expenses_id" class="form-control" name="tax_lodgement_expenses_id[{{$i}}]">
                                                    <option selected="selected" value="0">Select</option>
                                                    <?php
                                                    $lodgement_expensesss = DB::table('tbl_tax_lodgement_expenses')->select('lodgement_expenses_id', 'lodgement_expenses_name')->get();
                                                    foreach ($lodgement_expensesss as $lodgemet) {

                                                        if ($value->tax_lodgement_expenses_id == $lodgemet->lodgement_expenses_id) {
                                                            ?>
                                                            <option value="{{$lodgemet->lodgement_expenses_id}}" selected="">{{$lodgemet->lodgement_expenses_name}}</option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="{{$lodgemet->lodgement_expenses_id}}">{{$lodgemet->lodgement_expenses_name}}</option>
                                                        <?php }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="amount">Amount </label><div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="amount" name="amount[{{$i}}]" value="{{$value->amount}}" onkeypress="return isNumber(event)"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="margin-top: 25px;">
                                            <button type="button" id="" class="deleteRow btn btn-danger btn-sm"><i class="fa fa-remove"></i>Remove</button>
                                        </div>
                                    </div>
    <?php $i++; }
} else { ?>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="description">Description </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-gg color_blue"></i></span>
                                            <input type="text" class="form-control" id="description" name="description[1]" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tax_lodgement_expenses_id">Type </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                            <select id="tax_lodgement_expenses_id" class="form-control" name="tax_lodgement_expenses_id[1]">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $lodgement_expensesss = DB::table('tbl_tax_lodgement_expenses')->select('lodgement_expenses_id', 'lodgement_expenses_name')->get();
                                                foreach ($lodgement_expensesss as $lodgemet) {
                                                    ?>
                                                    <option value="{{$lodgemet->lodgement_expenses_id}}" >{{$lodgemet->lodgement_expenses_name}}</option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="amount">Amount </label><div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="amount" name="amount[1]" value="" onkeypress="return isNumber(event)"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button type="button" id="addMore" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Add</button>
                                    </div>
                                </div>
<?php } ?>

                        </div>


                        <br/><br/><br/> 
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="TaxInvestmentSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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
    var counter = 20;
    $("#addMore").click(function () {
        $('<div class="row">\n\
                            <div class="form-group col-md-4">\n\
                                <label for="description">Description </label>\n\
                                <div class="input-group">\n\
                                    <span class="input-group-addon"><i class="fa fa-gg color_blue"></i></span>\n\
                                    <input type="text" class="form-control" id="description" name="description[' + counter + ']" value="">\n\
                                </div>\n\
                            </div>\n\
                            <div class="form-group col-md-3">\n\
                                <label for="tax_lodgement_expenses_id">Type </label>\n\
                                <div class="input-group">\n\
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>\n\
                                    <select id="tax_lodgement_expenses_id" class="form-control" name="tax_lodgement_expenses_id[' + counter + ']">\n\
                                        <option selected="selected" value="0">Select</option>\n\
<?php $lodgement_expensesss = DB::table('tbl_tax_lodgement_expenses')->select('lodgement_expenses_id', 'lodgement_expenses_name')->get();
foreach ($lodgement_expensesss as $lodgemet) {
    ?><option value="{{$lodgemet->lodgement_expenses_id}}">{{$lodgemet->lodgement_expenses_name}}</option>\n\
<?php } ?>\n\
                                </select>\n\
                            </div>\n\
                        </div>\n\
                        <div class="form-group col-md-3">\n\
                            <label for="amount">Amount </label><div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="amount" name="amount[' + counter + ']" value="" onkeypress="return isNumber(event)"/>\n\
                            </div>\n\
                        </div>\n\
                        <div class="col-md-2" style="margin-top: 25px;">\n\
                            <button type="button" class="deleteRow btn btn-danger btn-sm"><i class="fa fa-remove"></i> Remove</button>\n\
                        </div>\n\
                    </div>').appendTo("#targetDIV");
        counter++;
    });
    $("#targetDIV").on("click", "button.deleteRow", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    });
    function TaxInvestmentSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('TaxInvestmentSave')}}',
            data: $("#taxInvestmentForm").serialize(),
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