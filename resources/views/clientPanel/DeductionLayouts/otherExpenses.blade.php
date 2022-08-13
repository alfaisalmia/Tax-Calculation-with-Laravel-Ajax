
@extends("clientPanel.clientPanelMaster")
@section('title', 'Other Expenses & Depreciation of Work-related Assets')
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
            
            $allDatas = DB::table('deduc_other_expenses_main')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

            
            $user_id = "";
           
            if (count($allDatas) > 0) {
                foreach ($allDatas as $inc_etp) {
                    $user_id = $inc_etp->user_id;
                }
            }
            ?>

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Other Expenses & Depreciation of Work-related Assets</h3>
                    <div class="">
                        <div class="alert alert-info">
                            <strong>Other Work-Related Expenses</strong> 
                        </div>
                        <p>Report here any other work-related expenses that you had as an employee. These expenses include but are not limited to union dues and membership fees for trade & business associations, professional conferences and seminars, reference material and technical journals, etc. Click the information button for a full list of the items you may deduct.<i data-toggle="modal" data-target="#myModal" class="fa fa-question-circle" style="font-size: 18px"></i></p> 

                        <p>You may be able to claim for use of your home phone or mobile phone if it is necessary for employment or business use. Keep a record of calls made which are necessarily incurred in earning your income. Keep a record of incoming calls if your job involves you being “on call”. Details should be recorded for 30 consecutive days. <a href="" class="color_blue our_link">Click here to download a Telephone Record Record Card Template.</a> </p>
                        <p>You may be able to claim for use of your home computer if it is necessary for employment or business use. Keep a record of the usage of your computer which is necessarily incurred in earning your income. Keep a record of any incidental expenses you incur for computer supplies e.g. disks and printer consumables. <a href="" class="color_blue our_link">Click here to download a Computer Record Card Template.</a> </p> 
                    </div>
                    <form id="otherExpen">
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <div id="AddNewRow">
                            <?php
                            
                            if ($user_id == Auth::User()->id) {
                                echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            $i = 1;?>
                            <div class="row">
                            <div class="col-md-4" style="margin-top: 25px;">
                                        <button type="button" id="AddUniformTravel" class="btn btn-warning btn-sm" onclick=""><i class="fa fa-plus"></i>Add</button>
                                    </div>
                                    </div>
                            <?php
                                 foreach ($allDatas as $xyz) {
                                ?>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Description</label>
                                        <input type="text" class="form-control" id="Description1" name="description[{{ $i}}]" value="{{$xyz->description}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount[{{$i}}]" value="{{$xyz->amount}}" onkeypress="return isNumber(event)">
                                    </div>
                                    <div class="col-md-4" style="margin-top: 25px;">
                                        <button type="button" id="" class="deleteRow btn btn-danger btn-sm" onclick=""><i class="fa fa-remove"></i>Remove</button>
                                    </div>
                                </div>
                                 <?php 
                                 $i++;
                                 }} else { ?>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">Description</label>
                                        <input type="text" class="form-control" id="Description1" name="description[1]" value="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount[1]" value="" onkeypress="return isNumber(event)">
                                    </div>
                                    <div class="col-md-4" style="margin-top: 25px;">
                                        <button type="button" id="AddUniformTravel" class="btn btn-warning btn-sm" onclick=""><i class="fa fa-plus"></i>Add</button>
                                    </div>
                                </div>

<?php } ?>
                        </div>
                        <div class="">
                            <div class="alert alert-info">
                                <strong>Depreciation of Work-related Items</strong> 
                            </div>
                            <p>Any items that you used for work purposes, such as a computer, an electric tool, or an item of furniture, with a value greater than $300 should be reported as a depreciating asset.</p>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <a href="{{URL('/deduction/otherExpenses/deprecativeDeduction')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                        </div>
                    </div> <br/>
                    <h5>What is OWDV and CWDV ?</h5>

                    <div class="">
                        <div class="alert alert-info">
                            <strong>Other Deductible Expenses</strong> 
                        </div>
                        <p>Report here those expenses that are not work-related, whether they were incurred as an employee or a sole trader. These include but are not limited to debt deductions, election expenses, foreign exchange losses, any foreign UPP amount, the Australian Film Incentive, the low value pool deduction, and any personal superannuation contributions you made. Click the Add New Record button to begin.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <a href="{{URL('/deduction/otherExpenses/OtherDeductibleExpenses')}}" class="btn btn-warning block btn-sm"><i class="fa fa-plus">  </i> &nbsp; Add New Record</a><br/>
                        </div>
                    </div> <br/>
                </div>




                <div class="col-sm-12 "> 

                    <br/><br/><br/> 
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="OtherExpensesSa()"><i class="fa fa-forward"></i> Save and Go</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div></div>
<!--############################### MODAL ########################-->

<script>
    function OtherExpensesSa() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('OtherExpensesSa')}}',
            data: $("#otherExpen").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
            }
        });
    }
</script>
<script>
    var counter = 20;
    $("#AddUniformTravel").click(function () {
        $('<div class="row">\n\
                        <div class="form-group col-md-4">\n\
                            <label for="">Description</label>\n\
           <input type="text" class="form-control" id="Description1" name="description[' + counter + ']" value="">\n\
                        </div>\n\
                        <div class="form-group col-md-4">\n\
                            <label for="amount">Amount</label>\n\
                            <input type="text" class="form-control" id="amount" name="amount[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                        </div>\n\
                        <div class="col-md-4" style="margin-top: 25px;">\n\
                            <button type="button" id="" class="deleteRow btn btn-danger btn-sm" onclick=""><i class="fa fa-remove"></i>Remove</button>\n\
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
</script>
@stop