
@extends("clientPanel.clientPanelMaster")
@section('title', 'Superannuation ')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">
<?php

            $supp_inc = DB::table('inc_superannuation_inc')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();
            $superannuation_inc_id = "";
            $user_id = "";
            $payer_abn = "";
            $payer_name = "";
            $tax_withheld = "";
            $taxed_element = "";
            $untax_element = "";
            $amt_benifit_inc = "";
            $amt_of_uup = "";
            $tax_offset_amt_yn = "";
            $tax_offset_amt = "";
            $tax_element = "";
            $untaxed_element = "";
            if (count($supp_inc) > 0) {
                foreach ($supp_inc as $inc_etp) {
                    $superannuation_inc_id = $inc_etp->superannuation_inc_id;
                    $user_id = $inc_etp->user_id;
                    $payer_abn = $inc_etp->payer_abn;
                    $payer_name = $inc_etp->payer_name;
                    $tax_withheld = $inc_etp->tax_withheld;
                    $taxed_element = $inc_etp->taxed_element;
                    $untax_element = $inc_etp->untax_element;
                    $amt_benifit_inc = $inc_etp->amt_benifit_inc;
                    $amt_of_uup = $inc_etp->amt_of_uup;
                    $tax_offset_amt_yn = $inc_etp->tax_offset_amt_yn;
                    $tax_offset_amt = $inc_etp->tax_offset_amt;
                    $tax_element = $inc_etp->tax_element;
                    $untaxed_element = $inc_etp->untaxed_element;
                }
            }
?>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Superannuation Income Stream, Annuity or Pension Fund</h3>
                    <h5>Please provide the following information as it appears on one of the following statements: PayG Summary - Superannuation Income Stream, Australia annuity, superannuation, pension fund or other HSA provider.</h5>
                </div>

                <div class="">
                    <form id="superannuation_form_element">
                         <?php
                        if ($user_id == Auth::User()->id) {
                            echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                            echo '<input type="hidden" class="form-control" id="superannuation_inc_id" name="superannuation_inc_id" value="' . $superannuation_inc_id . '">';
                        }
                        ?>
                    <div class="col-md-12">
                         <h4>Payer's Details</h4>
                        <div class="form-group col-md-6">
                            <label for="payer_abn">Payer's ABN</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-gg-circle color_blue"></i></span>
                                <input type="text" class="form-control" id="payer_abn" name="payer_abn" value="{{$payer_abn}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="payer_name">Payer's Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-black-tie color_blue"></i></span>
                                <input type="text" class="form-control" id="payer_name" name="payer_name" value="{{$payer_name}}">
                            </div>
                        </div>
                    </div>
                

                <div class="">
                    <div class="col-md-12">
                        <h4>Tax Withheld</h4>
                        <div class="form-group col-md-6">
                            <label for="tax_withheld">Tax Withheld</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-object-ungroup color_blue"></i></span>
                                <input type="text" class="form-control" id="tax_withheld" name="tax_withheld" value="{{$tax_withheld}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="">
                    <div class="col-md-12">
                        <h4>Taxable Component</h4>
                        <div class="form-group col-md-6">
                            <label for="taxed_element">Taxed Element</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sticky-note color_blue"></i></span>
                                <input type="text" class="form-control" id="taxed_element" name="taxed_element" value="{{$taxed_element}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="untax_element">Untaxed Element</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sticky-note color_blue"></i></span>
                                <input type="text" class="form-control" id="untax_element" name="untax_element" value="{{$untax_element}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amt_benifit_inc">Assessable Amount from Capped Defined Benefit Income Stream</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="amt_benifit_inc" name="amt_benifit_inc" value="{{$amt_benifit_inc}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="amt_of_uup">Deductible Amount of UPP</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar color_blue"></i></span>
                                <input type="text" class="form-control" id="amt_of_uup" name="amt_of_uup" value="{{$amt_of_uup}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tax Offset Amount Start -->
 
                <div class="">
                    <div class="col-md-12">
                        <h4>Tax Offset Amount</h4>
                       <div class="row col-md-12">
                        <div class="col-md-6">
                            <p>Does your income statement show a tax offset amount?</p>
                        </div>
                        <div class="input-group col-md-6">
                            <div class="col-sm-12"> 
                                <div class="input-group">
                                    <?php $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get(); ?>
                                    @foreach($yesnos as $yn)
                                    <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                        <input type="radio" name="tax_offset_amt_yn" value="{{$yn->yes_no_id}}" <?php
                                        if ($tax_offset_amt_yn == $yn->yes_no_id) {
                                            echo "checked";
                                        }
                                        ?> >
                                        <span class="checkmark_radio"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><br/>
                        <div class="form-group col-md-6">
                            <label for="tax_offset_amt">If YES, what is the tax offset amount?</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-adjust color_blue"></i></span>
                                <input type="text" class="form-control" id="tax_offset_amt" name="tax_offset_amt" value="{{$tax_offset_amt}}">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Tax Offset Amount End -->

                <!-- Lum Sum in Arrears Start -->
                <div class="">
                    <div class="col-md-12">
                        <h4>Lump Sum in Arrears</h4>
                        <div class="form-group col-md-6">
                            <label for="tax_element">Taxed Element</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sticky-note-o color_blue"></i></span>
                                <input type="text" class="form-control" id="tax_element" name="tax_element" value="{{$tax_element}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="untaxed_element">Untaxed Element</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-sticky-note-o color_blue"></i></span>
                                <input type="text" class="form-control" id="untaxed_element" name="untaxed_element" value="{{$untaxed_element}}" onkeypress="return isNumber(event)">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Lum Sum in Arrears End -->
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <a href="{{URL('/income/superannuation')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <button type="button" class="btn btn-success btn-sm" onclick="SuperannuationFormDataSave()"><i class="fa fa-forward"></i><?php echo ($user_id == Auth::User()->id ? ' Update and Go' : " Save and Go") ?></button>

                        </div>
                    </div>
                </div>
                    </form>
            </div>



            </form>

        </div>
    </div>
</div>
</div>
</div>
<script>
function SuperannuationFormDataSave(){
     $.ajax({
            type: 'get',
            url: '{{ URL::to('SuperannuationFormDataSave')}}',
            data: $("#superannuation_form_element").serialize(),
            success: function (data) {
                window.location.href = "{{URL::to('/income/superannuation')}}";
            },
            error: function () {
            }
        });
}
</script>
@stop