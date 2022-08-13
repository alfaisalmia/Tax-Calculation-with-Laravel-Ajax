
@extends("clientPanel.clientPanelMaster")
@section('title', 'Basic Info')
@section("content")
<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">
        <div class="col-md-10 col-lg-10">
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <div class="alert alert-info">
                        <strong>Personal Information</strong> 
                    </div>
                    <h5>Please click the Save & Go button at the bottom of this page to save your information.</h5>
                </div>
                <?php
                $allbasicinfos = DB::table('tbl_basic_info')->select('*')->where('user_id', Auth::User()->id)->get();
             ;
                $basicinfo_id = "";
                $user_id = "";
                $tax_file_number = "";
                $title_id = "";
                $first_name = "";
                $last_name = "";
                $suffix = "";
                $date_of_birth = "";
                $contact_number = "";
                $contact_email = "";
                $email_tax_tips = "";
                $non_reside_au = "";
                $postal_country = "";
                $postal_Address = "";
                $home_postal_addres_same = "";
                $home_country = "";
                $home_address = "";
                $higher_education_loan = "";
                $financialSupplement_scheme = "";
                $tax_related_debts = "";

                foreach ($allbasicinfos as $abi) {
                    $basicinfo_id = $abi->basicinfo_id;
                    $user_id = $abi->user_id;
                    $tax_file_number = $abi->tax_file_number;
                    $title_id = $abi->title_id;
                    $first_name = $abi->first_name;
                    $last_name = $abi->last_name;
                    $suffix = $abi->suffix;
                    $date_of_birth = $abi->date_of_birth;
                    $contact_number = $abi->contact_number;
                    $contact_email = $abi->contact_email;
                    $email_tax_tips = $abi->email_tax_tips;
                    $non_reside_au = $abi->non_reside_au;
                    $postal_country =  $abi->postal_country;
                    $postal_Address =  $abi->postal_Address;
                    $home_postal_addres_same =  $abi->home_postal_addres_same;
                    $home_country =  $abi->home_country;
                    $home_address =  $abi->home_address;
                    $higher_education_loan =  $abi->higher_education_loan;
                    $financialSupplement_scheme =  $abi->financialSupplement_scheme;
                    $tax_related_debts =  $abi->tax_related_debts;
                }
                ?>
                <form method="post" action="" id="basic_info">
                    {{csrf_field()}}

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tax File Number &nbsp; <i data-toggle="modal" data-target="#exampleModal" class="fa fa-question-circle" style="font-size: 20px; color: blue"></i></label>  
                                <input type="text" class="form-control" id="tax_file_number" name="tax_file_number" value="{{$tax_file_number}}">
                                <?php
                                if ($user_id = Auth::User()->id) {
                                    echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                                    echo '<input type="hidden" class="form-control" id="basicinfo_id" name="basicinfo_id" value="' . $basicinfo_id . '">';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Title</label>
                        <select id="title" class="form-control" name="title">
                            <option selected value="0" >Choose</option>
                            <?php
                            $titless = DB::table('tbl_title')->select('title_id', 'title_name')->orderBy("title_id", "asc")->get();
                            foreach ($titless as $title) {
                                if ($title_id == $title->title_id) {
                                    echo '<option value="' . $title->title_id . '"selected >' . $title->title_name . '</option>"';
                                } else {
                                    echo '<option value="' . $title->title_id . '">' . $title->title_name . '</option>"';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name">First Name (Given Name)</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$first_name}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name (Surname)</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$last_name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="suffix">Suffix</label>
                            <input type="text" class="form-control" id="suffix" name="suffix" value="{{$suffix}}">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="dob">Date of Birth* ( enter as dd/mm/yyyy e.g. 01/01/1990)</label>
                        <input type="text" class="form-control datepicker" id="dob" name="dob" value="{{$date_of_birth}}">
                    </div>
                    <div class="col-md-10">
                        <p>Is this the last Australian tax return that you will ever lodge?</p>
                    </div>
                    <div class="col-md-2">
                        <select id="non_reside_au" class="form-control" name="non_reside_au">
                            <option selected value="0">Choose</option>
                            <?php
                            $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                            foreach ($yesnos as $yn) {
                                if ($non_reside_au == $yn->yes_no_id) {
                                    echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                } else {
                                    echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6 col-sm-offset-6">
                            <p class="pull-right"><b>Please note: </b>Do not choose “yes” unless you have permanently left Australia OR you are retired with a minimal income. <span class="color_blue">(learn more...)</span></p>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>Contact Information</strong> 
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Contact Phone Number</label>
                        <input type="text" class="form-control col-md-4" id="phone" name="phone" value="{{$contact_number}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control col-md-4" id="email" name="email" value="{{$contact_email}}">
                    </div>
                    <div class="form-group col-sm-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="" name="" value="1" <?php
                            if ($email_tax_tips == 1) {
                                echo "checked";
                            }
                            ?> >
                            <input class="form-check-input" type="hidden" id="email_tax_tips" name="email_tax_tips" value="1">
                            <label class="form-check-label" for=""><b>Yes, please email me tax tips and information to help make tax time as simple as possible.</b>
                            </label>
                            <p>We value your privacy and will never spam you. Consult our <a href="#" style="color:blue">Privacy Policy</a> for more details on how we safeguard your information</p>
                        </div>
                    </div>
                    <section id="postal_address">
                        <div class="col-sm-12">
                            <div class="alert alert-info">
                                <strong>Current Postal Address</strong> 
                            </div>
                            <p>If you have changed your address since lodging your last tax return, please contact the ATO immediately to update this information otherwise your tax return will be delayed. </p>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">Country</label>
                                    <select class="form-control" id="postal_country" name="postal_country" onchange="">
                                        <option selected value="0">Choose</option>
                                        <?php
                                        $Countries = DB::table('tbl_countries')->select('country_id', 'country_name')->orderBy("country_id", "asc")->get();
                                        foreach ($Countries as $count) {
                                            if ($postal_country == $count->country_id) {
                                                echo '<option value="' . $count->country_id . '"selected >' . $count->country_name . '</option>"';
                                            } else {
                                                echo '<option value="' . $count->country_id . '">' . $count->country_name . '</option>"';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">

                                    <label for="">Address</label>
                                    <input type="text" class="form-control col-md-4" id="postal_Address" name="postal_Address" value="{{$postal_Address}}">
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <strong>Home Address</strong> 
                            </div>


                            <!--########################################################-->
                            <div class="col-md-10">
                                <p>Same as current postal address?</p>
                            </div>
                            <div class="col-md-2">
                                <select id="home_postal_addres_same" name="home_postal_addres_same" class="form-control" onchange="currentPostalAddressChange()">
                                    <option selected value="0">Choose</option>
                                    <?php
                                    $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                                    foreach ($yesnos as $yn) {
                                        if ($home_postal_addres_same == $yn->yes_no_id) {
                                            echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                        } else {
                                            echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--##################################################-->
                            <div id="NotSameAddress">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Country</label>
                                        <select class="form-control" id="home_country" name="home_country" onchange="">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $Countries = DB::table('tbl_countries')->select('country_id', 'country_name')->orderBy("country_id", "asc")->get();
                                            foreach ($Countries as $count) {
                                                if ($home_country == $count->country_id) {
                                                    echo '<option value="' . $count->country_id . '"selected >' . $count->country_name . '</option>"';
                                                } else {
                                                    echo '<option value="' . $count->country_id . '">' . $count->country_name . '</option>"';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">

                                        <label for="">Address</label>
                                        <input type="text" class="form-control col-md-4" id="home_address" name="home_address" value="{{$home_address}}">
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert alert-info">
                                        <strong>Education And Other Debts</strong> 
                                    </div>
                                    <div class="col-md-10">
                                        <p>Do you have any Higher Education Loan Programme (HELP) -or- Trade Support Loan (TSL) debt??</p>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="higher_education_loan" name="higher_education_loan" class="form-control" onchange="">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                                            foreach ($yesnos as $yn) {
                                                if ($higher_education_loan == $yn->yes_no_id) {
                                                    echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                                } else {
                                                    echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--######################################################-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-md-10">
                                        <p>Do you have any Student Financial Supplement Scheme (SFSS) debt?</p>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="financial_Supplement_scheme" name="financial_Supplement_scheme" class="form-control" onchange="">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                                            foreach ($yesnos as $yn) {
                                                if ($financialSupplement_scheme == $yn->yes_no_id) {
                                                    echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                                } else {
                                                    echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--######################################################-->
                            <!--######################################################-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-md-10">
                                        <p>Do you have any other tax-related debts (such as Child Support Debts or Family Tax Assistance Debts)?</p>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="tax_related_debts" name="tax_related_debts" class="form-control" onchange="">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->orderBy("yes_no_id", "asc")->get();
                                            foreach ($yesnos as $yn) {
                                                if ($tax_related_debts == $yn->yes_no_id) {
                                                    echo '<option value="' . $yn->yes_no_id . '"selected >' . $yn->yes_no_name . '</option>"';
                                                } else {
                                                    echo '<option value="' . $yn->yes_no_id . '">' . $yn->yes_no_name . '</option>"';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--######################################################-->


                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <button type="button" class="btn btn-success btn-sm" onclick="BasicInfoInsert()"><i class="fa fa-forward"></i> Save and Go</button>

                                    </div>
                                </div>
                            </div>
                            </form>
                            <br/><br/><br/><br/>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <script>
                            $("#NotSameAddress").hide();
                            function countryChange() {
                            $("#preloader").show();
                            var country_id = $('#country').val();
                            var op = "";
                            $.ajax({
                            type: 'get',
                                    url: '{{ URL::to('findState')}}',
                                    data: {country_id: country_id},
                                    success: function (data) {
                                    $("#state").empty();
                                    op += '<option value="0" selected disable> Select </option>';
                                    for (var i = 0; i < data.length; i++) {
                                    op += '<option value="' + data[i].state_id + '">' + data[i].state_name + '</option>';
                                    }
                                    $('#state').append(op);
                                    $("#preloader").hide();
                                    },
                                    error: function () {
                                    alert("Internal Error.");
                                    $("#preloader").hide();
                                    }
                            });
                            }
                            //    State 
                            function stateChange() {
                            $("#preloader").show();
                            var state_id = $('#state').val();
                            var ope = "";
                            $.ajax({
                            type: 'get',
                                    url: '{{ URL::to('findCities')}}',
                                    data: {state_id: state_id},
                                    success: function (data) {
                                    $("#city").empty();
                                    ope += '<option value="0" selected disable> Select </option>';
                                    for (var i = 0; i < data.length; i++) {
                                    ope += '<option value="' + data[i].city_id + '">' + data[i].city_name + '</option>';
                                    }
                                    $('#city').append(ope);
                                    $("#preloader").hide();
                                    },
                                    error: function () {
                                    alert("Internal Error.");
                                    $("#preloader").hide();
                                    }
                            });
                            }
                            function BasicInfoInsert() {
                            console.log($("#basic_info").serialize());
                            $.ajax({
                            type: 'get',
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    url: '{{ URL::to('BasicInfoInsert')}}',
                                    data: $("#basic_info").serialize(),
                                    success: function (data) {
                                    window.location.href = "{{URL::to('/personalinfo/otherInformation')}}";
                                    },
                                    error: function () {
                                    }
                            });
                            }
                            function currentPostalAddressChange(){
                            var home_postal_addres_same = $("#home_postal_addres_same").val();
                            if (home_postal_addres_same == 2){
                            $("#NotSameAddress").show();
                            }
                            else if (home_postal_addres_same == 1){
                            $("#NotSameAddress").hide();
                            }
                            }

                        </script>
                        @stop