
@extends("clientPanel.clientPanelMaster")
@section('title', 'E T P')
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
            $inc_etp_data = DB::table('inc_etp')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

            $etp_id = "";
            $user_id = "";
            $payers_abn = "";
            $payers_name = "";
            $date_of_payment = "";
            $taxable_component = "";
            $tax_withheld = "";
            $type_of_payment = "";
            if (count($inc_etp_data) > 0) {
                foreach ($inc_etp_data as $inc_etp) {
                    $etp_id = $inc_etp->etp_id;
                    $user_id = $inc_etp->user_id;
                    $payers_abn = $inc_etp->payers_abn;
                    $payers_name = $inc_etp->payers_name;
                    $date_of_payment = $inc_etp->date_of_payment;
                    $taxable_component = $inc_etp->taxable_component;
                    $tax_withheld = $inc_etp->tax_withheld;
                    $type_of_payment = $inc_etp->type_of_payment;
                }
            }
            ?>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Employment Termination Payment Summary</h3>
                    <h5>Under the changes to superannuation, an employment termination payment, as it was called since 1 July 2007, is a lump sum payment made in consequence of the termination of employment.
                    </h5>
                    <h5>It can include: amounts for unused rostered days off, amounts in lieu of notice, a gratuity or ‘golden handshake’, an employee’s invalidity payment (for permanent disability, other than compensation for personal injury), and certain payments after the death of an employee.</h5>

                </div>
                <div class="col-sm-12 "> 
                    <form id="etp_form_element">
                        <input type="hidden" name="mainmenu" id="mainmenu" value="<?php echo $mainmenu_id ?>" /> 
                        <input type="hidden" name="submenu" id="submenu" value="<?php echo $submenu_id ?>" />
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="etp_id" name="etp_id" value="' . $etp_id . '">';
                        }
                        ?>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="payers_abn">Payer's ABN</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                    <input type="text" class="form-control" id="payers_abn" name="payers_abn" value="<?php echo $payers_abn; ?>" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="payers_name">Payer's Name</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                    <input type="text" class="form-control" id="payers_name" name="payers_name" value="<?php echo $payers_name; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="date_of_payment">Date of Payment (DD-MM-YYYY)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                                    <input type="text" class="form-control datepicker" id="date_of_payment" name="date_of_payment" value="{{ \Carbon\Carbon::parse($date_of_payment)->format('d/m/Y')}}">          
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="taxable_component">Taxable Component </label><div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span>
                                    <input type="text" class="form-control" id="taxable_component" name="taxable_component" value="<?php echo $taxable_component; ?>" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tax_withheld">Tax Withheld</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-table color_blue"></i></span>
                                    <input type="text" class="form-control" id="tax_withheld" name="tax_withheld" value="<?php echo $tax_withheld ?>" onkeypress="return isNumber(event)">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="type_of_payment">Type of Payment:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                    <select id="type_of_payment" class="form-control" name="type_of_payment">
                                        <option value="0">Select</option>
                                        <?php
                                        $paymenttype_namess = DB::table('tbl_paymenttype')->select('paymenttype_id', 'paymenttype_name')->get();
                                        foreach ($paymenttype_namess as $paymenttype_name) {
                                            if ($type_of_payment == $paymenttype_name->paymenttype_id) {
                                                echo '<option value="' . $paymenttype_name->paymenttype_id . '" selected >' . $paymenttype_name->paymenttype_name . '</option>';
                                            } else {
                                                echo '<option value="' . $paymenttype_name->paymenttype_id . '">' . $paymenttype_name->paymenttype_name . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div><br/><br/>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="etpFormDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

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
    function etpFormDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('EtpFormDataSave')}}',
            data: $("#etp_form_element").serialize(),
            success: function (data) {
                window.location.href = data;
            },
            error: function () {
            }
        });
    }
</script>
@stop