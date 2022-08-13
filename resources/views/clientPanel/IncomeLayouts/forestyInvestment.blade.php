
@extends("clientPanel.clientPanelMaster")
@section('title', 'Forestry Investment')
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
$user_id = "";
$description = "";
$Amount = "";

$ForestryIncome = DB::table('inc_forestry_invest_income')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
if (count($ForestryIncome) > 0) {
    foreach ($ForestryIncome as $cgm) {
        $user_id = $cgm->user_id;
        $description = $cgm->description;
        $Amount = $cgm->Amount;
    }
}
?>
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Income from a Forestry Managed Investment Scheme</h3>
                    <h5>If you participated in a Forestry Managed Investment Scheme, list any income received from forestry interest that you hold.</h5>

                </div>

                <div class="">
                    <div class="col-sm-12 ">
                        <form id="ForestryManagedInvestmentSchemeForm">
                            <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                            <?php
                            if ($user_id == Auth::User()->id) {
                                echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            }
                            ?>
                            <div id="ForestryManagedInvestmentScheme">

                                <?php
                                if ($user_id == Auth::User()->id) {
                                    $ForestryIncome = DB::table('inc_forestry_invest_income')->select("*")->where('tax_year_id', Session::get('tax_year_id'))->where('user_id', Auth::User()->id)->get();
                                    if (count($ForestryIncome) > 0) {
                                        ?>
                                        <div class="row">
                                            <div class="col-md-2" style="margin-top: 25px;">
                                                <button id="addForestryManagedInvestmentScheme" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"> Add</i></button>
                                            </div>
                                        </div>
                                        <?php
                                        $i = 1;
                                        foreach ($ForestryIncome as $cgm) {
                                            ?>
                                            <div class="row">
                                                <div class="form-group col-md-7">
                                                    <label for="description">Description</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                                        <input type="text" class="form-control" id="description" name="description[{{$i}}]" value="{{$cgm->description}}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="amount">Amount</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                        <input type="text" class="form-control" id="amount" name="amount[{{$i}}]" value="{{$cgm->Amount}}" onkeypress="return isNumber(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="margin-top: 25px;">
                                                    <button id="addMoreRcpt" type="button" class="deleteRow btn btn-danger btn-sm" ><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>
                                                </div>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-md-7">
                                            <label for="description">Description</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                                <input type="text" class="form-control" id="description" name="description[1]" value="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="amount">Amount</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                                <input type="text" class="form-control" id="amount" name="amount[1]" value="" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="margin-top: 25px;">
                                            <button id="addForestryManagedInvestmentScheme" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"> Add</i></button>
                                        </div>
                                    </div>

                                <?php }
                                ?>

                            </div>
                            <hr>
                            <h4 style="color:blue">Deductions from a Forestry Managed Investment</h4>
                            <p>You may be able to claim a deduction for payments made to an FMIS if you hold a forestry interest and you paid an amount to a forestry manager under a formal agreement.</p>

                            <p>If your interest in an FMIS are covered by product rulings, enter the code, year of product ruling, product ruling number, and deduction amount.</p>

                            <p>Alternatively, if your interest in an FMIS are covered by private rulings, enter the code, year of product ruling, authorisation number, and deduction amount.</p>
                            <div id="RowDeductionForestry">
                                <?php 
                                  if ($user_id == Auth::User()->id) { 
                                       $ForestryExpense = DB::table('inc_forestry_invest_deduction')->select("*")->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                                    if (count($ForestryExpense) > 0) {
                                        ?>
                                 <div class="row">
                                            <div class="col-md-2" style="margin-top: 25px;">
                                                <button type="button" id="addDeductionForestyInvest" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Add</button>
                                            </div>
                                        </div>
                                            <?php
                                            $j = 1;
                                        foreach ($ForestryExpense as $key => $for) {
    
                                      ?>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="code">Code </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                            <select id="code" class="form-control" name="code[{{$j}}]">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $investment_codess = DB::table('tbl_foresty_investment_code')->select('foresty_investment_code_id', 'foresty_investment_code_name')->get();
                                                foreach ($investment_codess as $invset_code) {
                                                    if($for->foresty_investment_code_id == $invset_code->foresty_investment_code_id){
                                                    ?>
                                                <option value="{{$invset_code->foresty_investment_code_id}}" selected="">{{$invset_code->foresty_investment_code_name}}</option>
                                                    <?php
                                                }else{
                                                    
                                                ?>
                                                     <option value="{{$invset_code->foresty_investment_code_id}}">{{$invset_code->foresty_investment_code_name}}</option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="year">Year </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                            <input type="text" class="form-control" id="year" name="year[{{$j}}]" value="{{$for->year}}" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="number">Number  </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                            <input type="text" class="form-control" id="number" name="number[{{$j}}]" value="{{$for->number}}" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="deduction_amt">Deduction Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="deduction_amt" name="deduction_amt[{{$j}}]" value="{{$for->deduction_amt}}" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button id="addMoreRcpt" type="button" class="deleteRow btn btn-danger btn-sm" ><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>
                                    </div>
                                </div>
                                    <?php $j++;  }}}else{ ?>
                                      <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="code">Code </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                            <select id="code" class="form-control" name="code[1]">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $investment_codess = DB::table('tbl_foresty_investment_code')->select('foresty_investment_code_id', 'foresty_investment_code_name')->get();
                                                foreach ($investment_codess as $invset_code) {
                                                    ?>
                                                    <option value="{{$invset_code->foresty_investment_code_id}}">{{$invset_code->foresty_investment_code_name}}</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="year">Year </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                            <input type="text" class="form-control" id="year" name="year[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="number">Number  </label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                            <input type="text" class="form-control" id="number" name="number[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="deduction_amt">Deduction Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                            <input type="text" class="form-control" id="deduction_amt" name="deduction_amt[1]" value="" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button type="button" id="addDeductionForestyInvest" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i>Add</button>
                                    </div>
                                </div>
                                <?php 
                                }
                                ?>
                                
                            </div>
                            <br><br>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="ForestryInvesetmentFormDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <br/><br/><br/>  <br/><br/><br/><br/><br/><br/>  
                </div>
            </div>
        </div>

    </div>
</div> </div>
<script>
    var counter = 15;
    $("#addForestryManagedInvestmentScheme").click(function () {
        $('<div class="row">\n\
                        <div class="form-group col-md-7">\n\
                            <label for="description">Description</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>\n\
                            <input type="text" class="form-control" id="description" name="description[' + counter + ']" value="">\n\
                        </div>\n\
                        </div>\n\
                        <div class="form-group col-md-3">\n\
                            <label for="amount">Amount</label>\n\
                            <div class="input-group">\n\
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="amount" name="amount[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                        </div>\n\
                        </div>\n\
                        <div class="col-md-2" style="margin-top: 25px;">\n\
                            <button id="addMoreRcpt" type="button" class="deleteRow btn btn-danger btn-sm" ><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>\n\
                        </div>\n\
                    </div>').appendTo("#ForestryManagedInvestmentScheme");
        counter++;
    });</script>
<script>
    $("#ForestryManagedInvestmentScheme").on("click", "button.deleteRow", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    });

    function ForestryInvesetmentFormDataSave() {
        $("#preloader").show();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('ForestryInvesetmentFormDataSave')}}',
            data: $("#ForestryManagedInvestmentSchemeForm").serialize(),
            success: function (data) {
                $("#preloader").show();
                window.location.href = data;
            },
            error: function () {
                $("#preloader").hide();
                alert("Failed !, Please, try again later.");
            }
        });
    }

</script>
<script>
    $("#addDeductionForestyInvest").click(function () {
        $('<div class="row">\n\
                                <div class="form-group col-md-3">\n\
                                    <label for="code">Code </label>\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>\n\
                                        <select id="code" class="form-control" name="code[' + counter + ']">\n\
                                            <option selected="selected" value="0">Select</option>\n\
<?php
$investment_codess = DB::table('tbl_foresty_investment_code')->select('foresty_investment_code_id', 'foresty_investment_code_name')->get();
foreach ($investment_codess as $invset_code) {
    ?><option value="{{$invset_code->foresty_investment_code_id}}">{{$invset_code->foresty_investment_code_name}}</option><?php } ?>\n\
</select>\n\
                                    </div>\n\
                                </div>\n\
                                <div class="form-group col-md-3">\n\
                                    <label for="year">Year </label>\n\
                                    <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="year" name="year[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                                    </div>\n\
                                </div>\n\
                            <div class="form-group col-md-2">\n\
                                <label for="number">Number  </label>\n\
                             <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>\n\
                                <input type="text" class="form-control" id="number" name="number[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                            </div>\n\
                            </div>\n\
                            <div class="form-group col-md-2">\n\
                                <label for="deduction_amt">Deduction Amount</label>\n\
                                <div class="input-group">\n\
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>\n\
                                        <input type="text" class="form-control" id="deduction_amt" name="deduction_amt[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                            </div>\n\
                            </div>\n\
                            <div class="col-md-2" style="margin-top: 25px;">\n\
                                <button id="addMoreRcpt" type="button" class="deleteRow btn btn-danger btn-sm" ><i class="fa fa-remove" aria-hidden="true"> Remove</i></button>\n\
                            </div>\n\
                                  </div>').appendTo("#RowDeductionForestry");
        counter++;
    });

    $("#RowDeductionForestry").on("click", "button.deleteRow", function () {
        var checkstr = confirm('Are you sure you want to delete this item?');
        if (checkstr == true) {
            $(this).closest('.row').remove();
        } else {
            return false;
        }
    });
</script>
@stop