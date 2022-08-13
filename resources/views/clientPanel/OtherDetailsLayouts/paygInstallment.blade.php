
@extends("clientPanel.clientPanelMaster")
@section('title', 'PAYG Installments')
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
                    <h3>PAYG Installments</h3>
                    <h5>Enter the PAYG installments you paid to the ATO here, do NOT enter the Tax Withheld listed on your PAYG PaymentSummary.</h5>

                </div>
                <form id="paygInstallment">
                    <div class="col-sm-12 "> 
                        <div id="targetDIV">
                            <?php
                            $user_id = "";
                            $payInstall = DB::table('od_payg_installment')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
                            foreach ($payInstall as $value) {
                                $user_id = $value->user_id;
                            }


                            if ($user_id == Auth::User()->id) {
                                ?>
                            <div class="row">
                                <div class="col-md-2" style="margin-top: 25px;">
                                    <button type="button" class="btn btn-warning btn-sm" id="addRow"><i class="fa fa-plus"></i>Add</button>
                                </div>
                                </div>

                                <?php
                                foreach ($payInstall as $val) {
                                    ?>
                                    <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                                    <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                                    <?php
                                    if ($user_id == Auth::User()->id) {
                                        echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="form-group col-md-7">
                                            <label for="">Month</label>
                                            <select id="description" class="form-control" name="month_id[1]">
                                                <option selected="selected" value="0">Select</option>
                                                <?php
                                                $months = DB::table('tbl_months')->select('month_id', 'month_name')->get();
                                                foreach ($months as $month) {
                                                    if ($val->month_id == $month->month_id) {
                                                        echo '<option value="' . $month->month_id . '" selected >' . $month->month_name . '</option>';
                                                    } else {
                                                        echo '<option value="' . $month->month_id . '">' . $month->month_name . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount[1]" value="{{$val->amount}}" onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="col-md-2" style="margin-top: 25px;">
                                            <button type="button" class="deleteRow btn btn-danger btn-sm" id=""><i class="fa fa-remove"></i>Remove</button>
                                        </div>
                                    </div>
                                <?php }
                            } else {
                                ?>
                                <div class="row">
                                    <div class="form-group col-md-7">
                                        <label for="">Month</label>
                                        <select id="description" class="form-control" name="month_id[1]">
                                            <option selected="selected" value="0">Select</option>
                                            <?php
                                            $months = DB::table('tbl_months')->select('month_id', 'month_name')->get();
                                            foreach ($months as $month) {
                                                //  if ($type_of_payment == $month->month_id) {
                                                //      echo '<option value="' . $month->month_id . '" selected >' . $month->month_name . '</option>';
                                                //   } else {
                                                echo '<option value="' . $month->month_id . '">' . $month->month_name . '</option>';
                                                //   }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="amount">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount[1]" value="" onkeypress="return isNumber(event)">
                                    </div>
                                    <div class="col-md-2" style="margin-top: 25px;">
                                        <button type="button" class="btn btn-warning btn-sm" id="addRow"><i class="fa fa-plus"></i>Add</button>
                                    </div>
                                </div>
<?php } ?>

                        </div>


                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                    <button type="button" class="btn btn-success btn-sm" onclick="paygInstallmentsave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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
    $("#addRow").click(function () {
        $('<div class="row">\n\
                        <div class="form-group col-md-7">\n\
                            <label for="">Month</label>\n\
                            <select id="description" class="form-control" name="month_id[' + counter + ']">\n\
                                <option selected="selected" value="0">Select</option>\n\\n\
<?php
$months = DB::table('tbl_months')->select('month_id', 'month_name')->get();
foreach ($months as $month) {
    echo '<option value="' . $month->month_id . '">' . $month->month_name . '</option>';
}
?>\n\
                            </select>\n\
                        </div>\n\
                        <div class="form-group col-md-3">\n\
                            <label for="amount">Amount</label>\n\
                            <input type="text" class="form-control" id="amount" name="amount[' + counter + ']" value="" onkeypress="return isNumber(event)">\n\
                        </div>\n\
                        <div class="col-md-2" style="margin-top: 25px;">\n\
                            <button class="deleteRow btn btn-danger btn-sm" ><i class="fa fa-remove"></i>Remove</button>\n\
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

    function paygInstallmentsave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('paygInstallmentsave')}}',
            data: $("#paygInstallment").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
                alert("Failed ! Please try again later.");
            }
        })
    }
</script>
@stop