
@extends("clientPanel.clientPanelMaster")
@section('title', 'Other Information')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Other Information </h3>
                    <h5>Please click the Save & Go button at the bottom of this page to save your information.</h5>
                    <?php
                    $allotherInfos = DB::table('tbl_other_info')->select('*')->where('user_id', Auth::User()->id)->get();
                    $other_info_id = "";
                    $user_id = "";
                    $resident_of_australia = "";
                    $australian_citizenship = "";
                    $dependants_in_finance = "";
                    $spouse_in_finance = "";
                    $higher_edu_loan = "";
                    $veteran_or_widower = "";
                    $unable_to_disability = "";
                    $full_time_edu_first_time = "";


                    foreach ($allotherInfos as $abi) {
                        $other_info_id = $abi->other_info_id;
                        $user_id = $abi->user_id;
                        $resident_of_australia = $abi->resident_of_australia;
                        $australian_citizenship = $abi->australian_citizenship;
                        $dependants_in_finance = $abi->dependants_in_finance;
                        $spouse_in_finance = $abi->spouse_in_finance;
                        $higher_edu_loan = $abi->higher_edu_loan;
                        $veteran_or_widower = $abi->veteran_or_widower;
                        $unable_to_disability = $abi->unable_to_disability;
                        $full_time_edu_first_time = $abi->full_time_edu_first_time;
                    }
                
                    ?>
                    
                    <div class="alert alert-info">
                        <strong>Residency Status</strong> 
                    </div>
                </div>

                <form method="post" action="" id="basic_info">
                    {{csrf_field()}}
                    <?php
                    if ($user_id = Auth::User()->id) {
                        echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                        echo '<input type="hidden" class="form-control" id="other_info_id" name="other_info_id" value="' . $other_info_id . '">';
                    }
                    //  Session::get('taxfile_id');
                    ?>

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <p>Where you a Part-Year or Non-Resident of Australia ?</p>
                        </div>
                        <div class="input-group col-md-6">
                            <div class="col-sm-12"> 
                                <div class="input-group">
                                    <?php
                                    $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get();
                                  
                                    ?>
                                    @foreach($yesnos as $yn)
                                    <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                        <input type="radio" name="nonResident" value="{{$yn->yes_no_id}}" <?php
                                        if ($resident_of_australia == $yn->yes_no_id) {
                                            echo "checked";
                                        }
                                        ?>>
                                        <span class="checkmark_radio"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><br/>

                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <p>Do you have Australian citizenship ?</p>
                        </div>
                        <div class="input-group col-md-6">
                            <div class="col-sm-12"> 
                                <div class="input-group">
                                    <?php
                                    $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get();
                                    ?>
                                    @foreach($yesnos as $yn)
                                    <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                        <input type="radio" name="citizenship" value="{{$yn->yes_no_id}}" <?php
                                        if ($australian_citizenship == $yn->yes_no_id) {
                                            echo "checked";
                                        }
                                        ?>>
                                        <span class="checkmark_radio"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><br/>

                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>Residency Status</strong> 
                        </div>
                    </div>

                    <div class="col-md-10">
                        <p>Did you have any dependants during the financial year ?</p>
                    </div>
                    <div class="col-md-2">
                        <select id="dependants" name="dependants" class="form-control" name="title">
                            <option selected value="0">Choose</option>
                            <?php
                            $yes_and_nos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get();
                            foreach ($yes_and_nos as $yn) {
                                if ($dependants_in_finance == $yn->yes_no_id) {
                                    echo '<option selected value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                } else {
                                    echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                }
                            }
                            ?>

                        </select>
                    </div>
                    <div class="col-md-10">
                        <p>Did you have a spouse during the financial year ?</p>
                    </div>
                    <div class="col-md-2">
                        <select id="title" class="form-control" name="spouseInFinancial">
                            <option selected value="0">Choose</option>
                            <?php
                            foreach ($yes_and_nos as $yn) {
                                if ($spouse_in_finance == $yn->yes_no_id) {
                                    echo '<option selected value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                } else {
                                    echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <br/>
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>Government Loans</strong> 
                        </div>
                    </div>
                    <div class="col-md-10">
                        <p>Do you have a Higher Education Loan Program (HELP), Student Start-up Loan (SSL), ABSTUDY Student Start-up Loan (ABSTUDY SSL), Trade Support Loan (TSL) or Student Financial Supplement Scheme (SFSS) debt?   </p>
                    </div>
                    <div class="col-md-2">
                        <select id="title" class="form-control" name="higherEducationLoan">
                            <option selected value="0">Choose</option>
                            <?php
                            foreach ($yes_and_nos as $yn) {
                                if ($higher_edu_loan == $yn->yes_no_id) {
                                    echo '<option selected value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                } else {
                                    echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>  <br/> 
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>Special Circumstances: Tick all that apply</strong> 
                        </div>
                    </div>

                    <div class="form-check col-sm-12">
                        <label class="containerss" style=""> I am a veteran or war widow(er).
                            <input type="checkbox" value="1" name="veteran" id="status" <?php
                            if ($veteran_or_widower == 1) {
                                echo "checked";
                            } else {
                                
                            }
                            ?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="form-check col-sm-12">
                        <label class="containerss" style=""> I was unable to work this financial year due to a disability
                            <input type="checkbox" value="1" name="financialyeardisability" id="status" <?php
                            if ($unable_to_disability == 1) {
                                echo "checked";
                            } else {
                                
                            }
                            ?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="form-check col-sm-12">
                        <label class="containerss" style="">  I stopped Full Time Education for the first time.
                            <input type="checkbox" value="1" name="FullTimeEducation" id="status" <?php
                            if ($full_time_edu_first_time == 1) {
                                echo "checked";
                            } else {
                                
                            }
                            ?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>

                    <div class="col-sm-12">
                        <br>
                        <br>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="button" class="btn btn-success btn-sm" onclick="otherInformationSave()"><i class="fa fa-forward"></i> Save and Go</button>

                            </div>
                        </div>
                    </div>
                    <br/><br/><br/><br/>
                </form>
            </div>





        </div>

    </div>

</div>
</div>
</div>
<script>
    function otherInformationSave() {
        $.ajax({
            type: 'get',
//            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ URL::to('OtherInformationSave')}}',
            data: $("#basic_info").serialize(),
            success: function (data) {
                window.location.href = "{{URL::to('/personalinfo/summary')}}";
            },
            error: function () {
            }
        });
    }
</script>
@stop