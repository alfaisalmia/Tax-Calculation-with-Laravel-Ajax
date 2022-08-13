
@extends("clientPanel.clientPanelMaster")
@section('title', 'Interest Dividends')
@section("content")
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">
            <?php
            $dividend_incomes = DB::table('inc_dividend_income')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
            $dividend_inc_id = "";
            $user_id = "";
            $company_name = "";
            $unfranked_amt = "";
            $franked_amt = "";
            $franking_credit = "";
            $tfn_amt_deduct = "";
 if (count($dividend_incomes) > 0) {
            foreach ($dividend_incomes as $abc) {
                $dividend_inc_id = $abc->dividend_inc_id;
                $user_id = $abc->user_id;
                $company_name = $abc->company_name;
                $unfranked_amt = $abc->unfranked_amt;
                $franked_amt = $abc->franked_amt;
                $franking_credit = $abc->franking_credit;
                $tfn_amt_deduct = $abc->tfn_amt_deduct;
            }
            }
            ?>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Dividend Income</h3>
                    <h5>If this is a joint bank account, only enter your share of the gross interest, for example 50% each for two account holders</h5>
                </div>
                <div class="col-sm-12 ">
                    <form id="divident_inc_form_element">
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="dividend_inc_id" name="dividend_inc_id" value="' . $dividend_inc_id . '">';
                        }
                        ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="company_name">Company Name</label><div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user color_blue"></i></span>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $company_name;?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="unfranked_amt"> Unfranked Amount</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="unfranked_amt" name="unfranked_amt" value="<?php echo $unfranked_amt; ?>" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="franked_amt">Franked Amount</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="franked_amt" name="franked_amt" value="<?php echo $franked_amt ?>" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="franking_credit">Franking Credit</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="franking_credit" name="franking_credit" value="<?php echo $franking_credit ?>" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="tfn_amt_deduct">TFN Amount Deducted</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="tfn_amt_deduct" name="tfn_amt_deduct" value="<?php echo $tfn_amt_deduct ?>" onkeypress="return isNumber(event)">
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="dividendIncomeFormDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function dividendIncomeFormDataSave() {
        $.ajax({
            type: 'get',
            url: '{{ URL::to('DividendIncomeFormDataSave')}}',
            data: $("#divident_inc_form_element").serialize(),
            success: function (data) {
               window.location.href = "{{URL::to('income/interestDividends')}}"
            },
            error: function () {
            }
        });
    }

</script>
@stop