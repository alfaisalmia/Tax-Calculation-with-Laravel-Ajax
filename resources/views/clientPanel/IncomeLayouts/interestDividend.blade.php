
@extends("clientPanel.clientPanelMaster")
@section('title', 'Interest Dividends')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">
            <?php
            $all_int_inc_datas = DB::table('inc_interest_income')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
            $interest_inc_id = "";
            $user_id = "";
            $bank_name = "";
            $gross_interest = "";
            $tfn_amt_deduc = "";

            if (count($all_int_inc_datas) > 0) {
                foreach ($all_int_inc_datas as $all_int) {
                    $interest_inc_id = $all_int->interest_inc_id;
                    $user_id = $all_int->user_id;
                    $bank_name = $all_int->bank_name;
                    $gross_interest = $all_int->gross_interest;
                    $tfn_amt_deduc = $all_int->tfn_amt_deduc;
                }
            }
            ?>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Interest Income</h3>
                    <h5>If this is a joint bank account, only enter your share of the gross interest, for example 50% each for two account holders</h5>
                </div>
                <div class="col-sm-12 "> 
                    <form id="interest_income_form_element"> 
                        <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="interest_inc_id" name="interest_inc_id" value="' . $interest_inc_id . '">';
                        }
                        ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="bank_name">Enter the name of the bank</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bank color_blue"></i></span>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $bank_name; ?>">          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="gross_interest">Gross Interest</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="gross_interest" name="gross_interest" value="<?php echo $gross_interest ?>" onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="tfn_amt_deduc">TFN Amount Deducted</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                    <input type="text" class="form-control" id="tfn_amt_deduc" name="tfn_amt_deduc" value="<?php echo $tfn_amt_deduc; ?> " onkeypress="return isNumber(event)">          
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/income/interestDividends')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="interestIncomeFormDataSave()"><i class="fa fa-forward"></i> <?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    function interestIncomeFormDataSave() {
    $.ajax({
    type: 'get',
            url: '{{ URL::to('InterestIncomeFormDataSave')}}',
            data: $("#interest_income_form_element").serialize(),
            success: function (data) {
            window.location.href = "{{URL::to('income/interestDividends')}}"
            },
            error: function () {
            }
    });
    }


</script>
@stop