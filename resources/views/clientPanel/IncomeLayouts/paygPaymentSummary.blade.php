
@extends("clientPanel.clientPanelMaster")
@section('title', 'PAYG Payment Summary - Individual Non-Business')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">
            <?php
            $inc_salary_wages = DB::table('inc_salary_wages')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();        
            $user_id = "";
            $salary_wages_id = "";
            $salary_occupation = "";
            $total_tax_withheld = "";
            $gross_payment = "";
            $cdep_payments = "";
            $foreign_employment_income = "";
            $reportable_fringe_benefits_amt = "";
            $report_emp_superannuation_contr = "";
            $lumpsum_payment_a = "";
            $lumpsum_payment_b = "";
            $lumpsum_payment_d = "";
            $lumpsum_payment_e = "";
            $allowance_desc_1 = "";
            $allowance_amt_1 = "";
            $allowance_desc_2 = "";
            $allowance_amt_2 = "";
            $allowance_desc_3 = "";
            $allowance_amt_3 = "";
            $allowance_desc_4 = "";
            $allowance_amt_4 = "";
            $union_assos_fee_des_1 = "";
            $union_assos_fee_amt_1 = "";
            $union_assos_fee_des_2 = "";
            $union_assos_fee_amt_2 = "";
            $workplace_desc = "";
            $workplace_amt = "";
            $payer_name = "";
            $payer_abn = "";
            $check_if_wpn = "";
  if (count($inc_salary_wages) > 0) {
            foreach ($inc_salary_wages as $isw) {
               $user_id = $isw->user_id;
               $salary_wages_id = $isw->salary_wages_id;
                $salary_occupation = $isw->salary_occupation;
                $total_tax_withheld = $isw->total_tax_withheld;
                $gross_payment = $isw->gross_payment;
                $cdep_payments = $isw->cdep_payments;
                $foreign_employment_income = $isw->foreign_employment_income;
                $reportable_fringe_benefits_amt = $isw->reportable_fringe_benefits_amt;
                $report_emp_superannuation_contr = $isw->report_emp_superannuation_contr;
                $lumpsum_payment_a = $isw->lumpsum_payment_a;
                $lumpsum_payment_b = $isw->lumpsum_payment_b;
                $lumpsum_payment_d = $isw->lumpsum_payment_d;
                $lumpsum_payment_e = $isw->lumpsum_payment_e;
                $allowance_desc_1 = $isw->allowance_desc_1;
                $allowance_amt_1 = $isw->allowance_amt_1;
                $allowance_desc_2 = $isw->allowance_desc_2;
                $allowance_amt_2 = $isw->allowance_amt_2;
                $allowance_desc_3 =$isw->allowance_desc_3;
                $allowance_amt_3 = $isw->allowance_amt_3;
                $allowance_desc_4 = $isw->allowance_desc_4;
                $allowance_amt_4 = $isw->allowance_amt_4;
                $union_assos_fee_des_1 = $isw->union_assos_fee_des_1;
                $union_assos_fee_amt_1 = $isw->union_assos_fee_amt_1;
                $union_assos_fee_des_2 = $isw->union_assos_fee_des_2;
                $union_assos_fee_amt_2 = $isw->union_assos_fee_amt_2;
                $workplace_desc = $isw->workplace_desc;
                $workplace_amt = $isw->workplace_amt;
                $payer_name = $isw->payer_name;
                $payer_abn = $isw->payer_abn;
                $check_if_wpn = $isw->check_if_wpn;
  } }
            ?>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>PAYG Payment Summary - Individual Non-Business</h3>
                    <h5><b>Please provide the following information as it appears on your PAYG payment summary - individual non-business. You must have received your payment summary from your employer. Your pay slips cannot be used as substitute.
                        </b></h5>

                </div>

                <div class="">
                    <div class="col-md-12">
                        <p>Payment Summary for year ending 30 June 2018</p>
                    </div>
                </div>
                <form id="paygPaymentSummary">
                    <div class="col-sm-12 "> 
                        <div class="row">
                            <div class="col-md-12 ulockd-mrgn1210">
                                <div class="alert alert-info">
                                    <strong>Section A: Payee Details and Payments</strong> 
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo Session::get('mainmenu'); ?>" id="mainmenu" name="mainmenu">
                        <input type="hidden" value="<?php echo Session::get('submenu'); ?>" id="submenu" name="submenu">
                        <input type="hidden" value="<?php echo Session::get('salary_occupation'); ?>" id="salary_occupation" name="salary_occupation">
                        <?php
                            if ($user_id == Auth::User()->id) {
                                echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                                echo '<input type="hidden" class="form-control" id="salary_wages_id" name="salary_wages_id" value="'.$salary_wages_id.'">';
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-8">
                                <p>Total Tax Withheld:</p>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="total_tax_withheld" name="total_tax_withheld" value="<?php echo $total_tax_withheld; ?>" onkeypress="return isNumber(event)">
                                </div> 
                            </div> 
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-8">
                                <p>Gross Payments: (do not include amounts shown under 'Allowances', 'Lump Sum Payments', 'CDEP payments' and 'Exempt foreign income'):</p>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id=" gross_payment" name="gross_payment" value="<?php echo $gross_payment; ?>" onkeypress="return isNumber(event)">
                                </div> 
                            </div> 
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col-md-8">
                                <p>Community Development Employment Projects (CDEP) payments:</p>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="cdep_payments" name="cdep_payments" value="<?php echo $cdep_payments; ?>" onkeypress="return isNumber(event)">
                                </div> 
                            </div> 
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col-md-8">
                                <p>Exempt Foreign Employment Income: </p>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="foreign_employment_income" name="foreign_employment_income" value="<?php echo $foreign_employment_income; ?>" onkeypress="return isNumber(event)">
                                </div> 
                            </div> 
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col-md-8">
                                <p>Reportable Fringe Benefits Amount: FBT year 1 April to 31 March</p>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="reportable_fringe_benefits_amt" name="reportable_fringe_benefits_amt" value="<?php echo $reportable_fringe_benefits_amt; ?>" onkeypress="return isNumber(event)">
                                </div> 
                            </div>
                        </div>

                        <br/>

                        <div class="row">
                            <div class="col-md-8">
                                <p>Reportable Employer Superannuation Contributions:</p>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="report_emp_superannuation_contr" name="report_emp_superannuation_contr" value="<?php echo $report_emp_superannuation_contr;?>" onkeypress="return isNumber(event)">
                                </div> 
                            </div> 
                        </div>
                        <br/>
                        <hr>
                        <h5 class="color_blue">Lump Sum Payments:</h5>
                        <div class="row">
                            <div class="col-md-2">
                                <p>Lump Sum Payment:</p>
                            </div>

                            <div class="input-group col-md-5">
                                <div class="col-sm-1"><span class="letters">A</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="lumpsum_payment_a" name="lumpsum_payment_a" value="<?php echo $lumpsum_payment_a; ?>" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>

                            <!--                        <div class="col-md-4">
                                                        <div class="col-sm-2"><label for="description">Type</label></div>
                                                        <div class="col-sm-10">
                                                            <select id="description" class="form-control" name="description">
                                                                <option selected="selected" value="0">Select</option>
                            <?php
//                                    $lumsumpaymentss = DB::table('tbl_lumpsum_payment_type')->select('lumsumpayment_id', 'lumsumpayment_name')->get();
//                                    foreach ($lumsumpaymentss as $lumsumpayment) {
//                                                                            <option value="{{$lumsumpayment->lumsumpayment_id}}">{{$lumsumpayment->lumsumpayment_name}}</option>
                            ?>
                            
                            <?php
                            // }
                            ?>
                                                            </select>
                                                        </div>
                                                    </div> -->
                        </div>
                        <br>



                        <div class="row">
                            <div class="col-md-2">
                                <p>Lump Sum Payment :</p>
                            </div>

                            <div class="input-group col-md-5">
                                <div class="col-sm-1"><span class="letters">B</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="lumpsum_payment_b" name="lumpsum_payment_b" value="<?php echo $lumpsum_payment_b; ?>" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div><br/>

                        <div class="row">
                            <div class="col-md-2">
                                <p>Lump Sum Payment :</p>
                            </div>

                            <div class="input-group col-md-5">
                                <div class="col-sm-1"><span class="letters">D</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="lumpsum_payment_d" name="lumpsum_payment_d" value="<?php echo $lumpsum_payment_d; ?>" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div><br/>
                        <div class="row">
                            <div class="col-md-2">
                                <p>Lump Sum Payment :</p>
                            </div>

                            <div class="input-group col-md-5">
                                <div class="col-sm-1"><span class="letters">E</span></div>
                                <div class="col-sm-11"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                        <input type="text" class="form-control" id="lumpsum_payment_e" name="lumpsum_payment_e" value="<?php echo $lumpsum_payment_e; ?>" onkeypress="return isNumber(event)">  </div>
                                </div>
                            </div>
                        </div><br/>
                        <br>

                        <hr>
                        <h5 class="color_blue">Allowances</h5>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th></th>
                                        <td>Description</td>
                                        <td>Amount</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span><input type="text" class="form-control" id="allowance_desc_1" name="allowance_desc_1" value="<?php echo $allowance_desc_1; ?>"></div></td>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span><input type="text" class="form-control" id="allowance_amt_1" name="allowance_amt_1" value="<?php echo $allowance_amt_1; ?>" onkeypress="return isNumber(event)"></div></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span><input type="text" class="form-control" id="allowance_desc_2" name="allowance_desc_2" value="<?php echo $allowance_amt_1; ?>"></div></td>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span><input type="text" class="form-control" id="allowance_amt_2" name="allowance_amt_2" value="<?php echo $allowance_amt_1;?>" onkeypress="return isNumber(event)"></div></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span><input type="text" class="form-control" id="allowance_desc_3" name="allowance_desc_3" value="<?php echo $allowance_desc_3; ?>" ></div></td>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span><input type="text" class="form-control" id="allowance_amt_3" name="allowance_amt_3" value="<?php echo $allowance_amt_3 ?>" onkeypress="return isNumber(event)"></div></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td><div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span><input type="text" class="form-control" id="allowance_desc_4" name="allowance_desc_4" value="<?php echo $allowance_desc_4;?>"></div></td>
                                        <td><div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span> <input type="text" class="form-control" id="allowance_amt_4" name="allowance_amt_4" value="<?php echo $allowance_amt_4 ?>" onkeypress="return isNumber(event)"></div></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <hr>

                        <h5 class="color_blue">Union/Professional association fees:</h5>
                        <p>If you enter your Union Fee here, please don’t claim it again in the Other Work Related Expense Section.</p>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th></th>
                                        <td>Description</td>
                                        <td>Amount</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span><input type="text" class="form-control" id="union_assos_fee_des_1" name="union_assos_fee_des_1" value="<?php echo $union_assos_fee_des_1 ?>"></div></td>
                                        <td><div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span> <input type="text" class="form-control" id="union_assos_fee_amt_1" name="union_assos_fee_amt_1" value="<?php echo $union_assos_fee_amt_1 ?>" onkeypress="return isNumber(event)"></div></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td><div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span> <input type="text" class="form-control" id="union_assos_fee_des_2" name="union_assos_fee_des_2" value="<?php echo $union_assos_fee_des_2 ; ?>"></div></td>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span><input type="text" class="form-control" id="union_assos_fee_amt_2" name="union_assos_fee_amt_2" value="<?php echo $union_assos_fee_amt_2 ?>" onkeypress="return isNumber(event)"></div></td>
                                    </tr>


                                </table>
                            </div>
                        </div>
                        <hr>
                        <h5 class="color_blue">Workplace giving etc:</h5>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th></th>
                                        <td>Description</td>
                                        <td>Amount</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">1</th>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-comment color_blue"></i></span><input type="text" class="form-control" id="workplace_desc" name="workplace_desc" value="<?php echo $workplace_desc; ?>"></div></td>
                                        <td> <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span><input type="text" class="form-control" id="workplace_amt" name="workplace_amt" value="<?php echo $workplace_amt; ?>" onkeypress="return isNumber(event)"></div></td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 ulockd-mrgn1210">
                                <div class="alert alert-info">
                                    <strong>Section B: Payer Details</strong> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <p>Payer's Name:</p>
                            </div>
                            <div class="col-md-4"><div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                    <input type="text" class="form-control" id="payer_name" name="payer_name" value="<?php echo $payer_name; ?>">
                                </div> 
                            </div> 
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-8">
                                <p>Payer's Australian Business Number (ABN or WPN):</p>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-id-card color_blue"></i></span>
                                    <input type="text" class="form-control" id="payer_abn" name="payer_abn" value="<?php echo $payer_abn;?>" onkeypress="return isNumber(event)">
                                </div> 
                            </div> 
                        </div>
                        <br/>
                        <div class="row">

                            <div class="form-check col-sm-12">
                                <label class="containerss" style=""> Check if Withholding Payer Number (WPN)
                                    <input type="checkbox" value="1" name="check_if_wpn" id="check_if_wpn" <?php
                            if ($check_if_wpn == 1) {
                                echo "checked";
                            } else {
                                
                            }
                                    ?>>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <br/>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/income/salaryAndWages')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="paygPaymentSummarySave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                            </div>
                        </div>
                    </div>
                </form>
                <br/>
            </div>
        </div>
    </div>

</div>
</div>
<script>
    function paygPaymentSummarySave() {
        $.ajax({
            type: 'get',
//            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to('PaygPaymentSummarySave')}}',
            data: $("#paygPaymentSummary").serialize(),
            success: function (data) {
               window.location.href = data;
            },
            error: function () {
            }
        });
    }
</script>
@stop