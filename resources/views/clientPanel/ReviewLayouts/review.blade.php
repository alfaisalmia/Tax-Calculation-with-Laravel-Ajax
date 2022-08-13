
@extends("clientPanel.clientPanelMaster")
@section('title', 'Tax Return Summary')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">

        <div class="col-md-8 col-lg-9">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h2 class="text-center">Tax Return Summary</h2>
                    <!--<h5 class="color_blue">Your Estimate Tax balance is $0.</h5>-->
                    <div class="col-sm-6">
                        <?php
                        $tax_file_number = "";
                        $tax_years = "";
                        $title_name = "";
                        $first_name = "";
                        $middle_name = "";
                        $last_name = "";
                        $contact_phone = "";
                        $contact_email = "";


                        $allbasicinfos = DB::table('tbl_basic_info')->select('tax_file_number', 'title_name', 'first_name', 'middle_name', 'last_name', 'contact_phone', 'contact_email', 'tbl_tax_year.tax_years')
                                        ->leftjoin('tbl_title', 'tbl_title.title_id', '=', 'tbl_basic_info.title_id')
                                        ->leftjoin('tbl_tax_year', 'tbl_tax_year.tax_year_id', '=', 'tbl_basic_info.tax_year_id')
                                        ->where('user_id', Auth::User()->id)
                                        ->where('tbl_basic_info.tax_year_id', Session::get('tax_year_id'))->get();

                        foreach ($allbasicinfos as $abc) {
                            $tax_file_number = $abc->tax_file_number;
                            $tax_years = $abc->tax_years;
                            $title_name = $abc->title_name;
                            $first_name = $abc->first_name;
                            $middle_name = $abc->middle_name;
                            $last_name = $abc->last_name;
                            $contact_phone = $abc->contact_phone;
                            $contact_email = $abc->contact_email;
                        }
                        ?>
                        <span> <b>Tax File Number : </b> {{$tax_file_number}}</span><br/>
                        <span> <b>Tax Years : </b> {{$tax_years}}</span><br/>
                        <span> <b>Tax holder name: : </b> {{$title_name}} {{$first_name}} {{$middle_name}} {{$last_name}}</span><br/>
                        <span> <b>Contact : </b> Phone : {{$contact_phone}}, Email: {{$contact_email}}</span><br/>

                    </div>
                    <div class="col-md-12">
                        <p><i>After reviewing the summary of your information, Click the Save & Go button to proceed to checkout.</i></p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <table class="table table-bordered" style="background-color: aliceblue">
                            <tr>
                                <td colspan="3"><b>1. Income Portion</b></td>
                            </tr>
                            <?php
                            $SalaryWages = DB::table('inc_salary_wages')->select('*')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
//                            echo "<pre>";
//                            print_r($SalaryWages);
//                            echo "</pre>";
                            foreach ($SalaryWages as $xyz) {
                                ?>
                                <tr>
                                    <td rowspan="18">Salary and Wages</td>
                                    <td>Total Tax Withheld:</td>
                                    <td><span class="pull-right">{{$xyz->total_tax_withheld}}</span></td>
                                </tr>


                                <tr>
                                    <td scope="row">Gross Payments:</td>
                                    <td><span class="pull-right">{{$xyz->gross_payment}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Community Development Employment Projects (CDEP) payments:</td>
                                    <td><span class="pull-right">{{$xyz->cdep_payments}}</span></td>

                                </tr>
                                <tr>
                                    <td scope="row">Exempt Foreign Employment Income:</td>
                                    <td><span class="pull-right">{{$xyz->foreign_employment_income}}</span></td>

                                </tr>
                                <tr>
                                    <td scope="row">Reportable Fringe Benefits Amount: FBT year 1 April to 31 March</td>
                                    <td><span class="pull-right">{{$xyz->reportable_fringe_benefits_amt}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Reportable Employer Superannuation Contributions:</td>
                                    <td><span class="pull-right">{{$xyz->report_emp_superannuation_contr}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Lump Sum Payment: A</td>
                                    <td><span class="pull-right">{{$xyz->lumpsum_payment_a}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Lump Sum Payment: A</td>
                                    <td><span class="pull-right">{{$xyz->lumpsum_payment_a}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Lump Sum Payment: B</td>
                                    <td><span class="pull-right">{{$xyz->lumpsum_payment_b}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Lump Sum Payment: D</td>
                                    <td><span class="pull-right">{{$xyz->lumpsum_payment_d}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Lump Sum Payment: E</td>
                                    <td><span class="pull-right">{{$xyz->lumpsum_payment_e}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Allowances Description 1</td>
                                    <td><span class="pull-right">{{$xyz->allowance_amt_1}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Allowances Description 2</td>
                                    <td><span class="pull-right">{{$xyz->allowance_amt_2}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Allowances Description 3</td>
                                    <td><span class="pull-right">{{$xyz->allowance_amt_3}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Allowances Description 4</td>
                                    <td><span class="                                                                                                                    pull-right">{{$xyz->allowance_amt_4}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">1.Union/Professional association fees:Description</td>
                                    <td><span class="pull-right">{{$xyz->union_assos_fee_amt_1}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">2.Union/Professional association fees:Descri                                                                                        ption</td>
                                    <td><span class="pull-right">{{$xyz->union_assos_fee_amt_2}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Workplace giving etc: Description</td>
                                    <td><span class="pull-right">{{$xyz->workplace_amt}}</span></td>
                                </tr>
                            <?php } ?>
                            <?php
                            $ETP = DB::table('inc_etp')->select('*')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
//                            echo "<pre>";
//                            print_r($ETP);
//                            echo "</pre>";
                            foreach ($ETP as $e) {
                                ?>
                                <tr>
                                    <td rowspan="2">Employment Termination Payment</td>
                                    <td scope="row">Taxable Component</td>
                                    <td><span class="pull-right">{{$e->taxable_component}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Tax Withheld</td>
                                    <td><span class="pull-right">{{$e->tax_withheld}}</span></td>
                                </tr>
                            <?php } ?>
                            <?php
                            $InterestOncome = DB::table('inc_interest_income')->select('*')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
//                            echo "<pre>";
//                            print_r($InterestOncome);
//                            echo "</pre>";
                            foreach ($InterestOncome as $ii) {
                                ?>
                                <tr>
                                    <td rowspan="2">Interest Income</td>
                                    <td scope="row">Gross Interest</td>
                                    <td><span class="pull-right">{{$ii->gross_interest}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">TFN Amount Deducted</td>
                                    <td><span class="pull-right">{{$ii->tfn_amt_deduc}}</span></td>
                                </tr>
                            <?php } ?>
                            <?php
                            $DividendIncome = DB::table('inc_dividend_income')->select('*')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
//                            echo "<pre>";
//                            print_r($DividendIncome);
//                            echo "</pre>";
                            foreach ($DividendIncome as $di) {
                                ?>
                                <tr>
                                    <td rowspan="4">Dividend Income</td>
                                    <td scope="row">Unfranked Amount</td>
                                    <td><span class="pull-right">{{$di->unfranked_amt}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Franked Amount</td>
                                    <td><span class="pull-right">{{$di->franked_amt}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Franking Credit</td>
                                    <td><span class="pull-right">{{$di->franking_credit}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">TFN Amount Deducted</td>
                                    <td><span class="pull-right">{{$di->tfn_amt_deduct}}</span></td>
                                </tr>
                            <?php } ?>
                            <?php
                            $PersonalService = DB::table('inc_personal_serv_inc')->select('*')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
                            foreach ($PersonalService as $ps) {
                                ?>
                                <tr>
                                    <td rowspan="2">Attributed Personal Service Income (PSI)</td>
                                    <td scope="row">Income</td>
                                    <td><span class="pull-right">{{$ps->income}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Tax Withheld</td>
                                    <td><span class="pull-right">{{$ps->tax_withheld}}</span></td>
                                </tr>

                            <?php } ?>
                            <?php
                            $PartnershipTrust = DB::table('inc_partnership_trust')->select('*')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
                            foreach ($PartnershipTrust as $pt) {
                                ?>
                                <tr>
                                    <td rowspan="8">Distribution from a Partnership or Trust</td>
                                    <td scope="row">Distribution Amount</td>
                                    <td><span class="pull-right">{{$pt->distribution_amount}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Deductions-Landcare operations and water care facility deduction</td>
                                    <td><span class="pull-right">{{$pt->land_water_deduction}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Deductions-Other Deductions</td>
                                    <td><span class="pull-right">{{$pt->other_deduction}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Deductions-Prior year deferred non-commercial losses</td>
                                    <td><span class="pull-right">{{$pt->prior_year_non_com}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Partnership share of net small business income less deductions attributable to that share</td>
                                    <td><span class="pull-right">{{$pt->partnership_share_of_small}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Credits & TFN Amounts: Share of credit for tax withheld where ABN not quoted</td>
                                    <td><span class="pull-right">{{$pt->share_of_credit}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Credits & TFN Amounts: Share of credit from amounts withheld from foreign resident withholding</td>
                                    <td><span class="pull-right">{{$pt->share_credit_amt}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="row">Credits & TFN Amounts: Share of national rental affordability scheme tax offset</td>
                                    <td><span class="pull-right">{{$pt->share_national_rental}}</span></td>
                                </tr>

                            <?php } ?>
                            <?php
                            $GovtPaymentSub = DB::table('inc_govt_payment_sub')->select('inc_govt_payment_sub.*', 'govtpayment_name')
                                    ->leftjoin('tbl_govtpayment_desc', 'tbl_govtpayment_desc.govtpayment_id', '=', 'inc_govt_payment_sub.govt_payment_desc_id')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
                            ?>
                            <tr>
                                <td rowspan="<?php echo (count($GovtPaymentSub)*2); ?>">Government Payment</td>
                                <?php foreach ($GovtPaymentSub as $gp) { ?>
                                    <td >{{$gp->govtpayment_name}}- Income</td>
                                    <td><span class="pull-right">{{$gp->income}}</span></td>
                                </tr>
                                <tr>
                                    <td >{{$gp->govtpayment_name}}- Tax withheld</td>
                                    <td><span class="pull-right">{{$gp->tax_withheld}}</span></td>
                                </tr>
                            <?php } ?>
                            <?php
                            $SuperannuationInc = DB::table('inc_superannuation_inc')->select('*')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
                            foreach ($SuperannuationInc as $si) {
                                ?>
                                <tr>
                                    <td rowspan="8">Superannuation Income Stream, Annuity or Pension Fund
                                    </td>
                                    <td scope="row">Tax Withheld</td>
                                    <td><span class="pull-right">{{$si->tax_withheld}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2"><b>Taxable Component</b> Taxed Element</td>
                                    <td><span class="pull-right">{{$si->taxed_element}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2"><b>Taxable Component</b> Untaxed Element</td>
                                    <td><span class="pull-right">{{$si->untax_element}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2"><b>Taxable Component</b> Assessable Amount from Capped Defined Benefit Income Stream</td>
                                    <td><span class="pull-right">{{$si->amt_benifit_inc}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2"><b>Taxable Component</b> Deductible Amount of UPP</td>
                                    <td><span class="pull-right">{{$si->amt_of_uup}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2">Tax Offset Amount</td>
                                    <td><span class="pull-right">{{$si->tax_offset_amt}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2"><b>Lump Sum in Arrears</b> Taxed Element</td>
                                    <td><span class="pull-right">{{$si->tax_element}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2"><b>Lump Sum in Arrears</b> Untaxed Element</td>
                                    <td><span class="pull-right">{{$si->untaxed_element}}</span></td>
                                </tr>
                            <?php } ?>
                                <?php
                            $SuperAnnutionLumSump = DB::table('inc_superannuation_lump_sum_pay')->select('*')
                                    ->where('user_id', Auth::User()->id)
                                    ->where('tax_year_id', Session::get('tax_year_id'))
                                    ->get();
                            foreach ($SuperAnnutionLumSump as $sls) {
                                ?>
                                <tr>
                                    <td rowspan="3">Superannuation Lump Sum Payments</td>
                                    <td scope="row">Taxed Element</td>
                                    <td><span class="pull-right">{{$sls->taxed_element}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2">Tax Withheld</td>
                                    <td><span class="pull-right">{{$sls->tax_withheld}}</span></td>
                                </tr>
                                <tr>
                                    <td scope="2">Untaxed Element</td>
                                    <td><span class="pull-right">{{$sls->untax_element}}</span></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12">
                    <p>After you submit your tax return information, we will process it and provide you with a full copy of your return as a downlaod from your status page.We will also review and electronically  lodge your return to the Austr                                                                                        alian Taxati                                                on Office.</p> 

                </div>
                <div class="col-sm-12"                                                        >
                    <div class="row">
                         <div class="form-group col-sm-12">
                            <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                            <a href="{{URL('/finish')}}" class="btn btn-primary btn-sm"><i class="fa fa-forward"></i> Goto Checkout</a>

                        </div>
                    </div>
                </div>

                <hr>
               
            </div>



            </form>

        </div>
    </div>
</div>
</div>
@stop