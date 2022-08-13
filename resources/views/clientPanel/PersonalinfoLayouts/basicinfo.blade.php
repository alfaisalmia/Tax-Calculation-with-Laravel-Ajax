
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
                $allbasicinfos = DB::table('tbl_basic_info')->select('*')->where('user_id', Auth::User()->id)->where('tax_year_id', Session::get('tax_year_id'))->get();

                $basicinfo_id = "";
                $user_id = "";
                $tax_file_number = "";
                $title_id = "";
                $first_name = "";
                $last_name = "";
                $middle_name = "";
                $name_title_changed = "";
                $date_of_birth = "";
                $contact_phone = "";
                $contact_email = "";
                $email_tax_tips = "";
                $postal_address_changed = "";
                $home_postal_address_same = "";
                $inter_postal_address = "";
                $line1 = "";
                $line2 = "";
                $postcode = "";
                $suburb = "";
                $state = "";
                $country = "";
                $pevious_title = "";
                $previous_first_name = "";
                $previous_middle_name = "";
                $previous_last_name = "";
                $prev_postal_line1 = "";
                $prev_postal_line2 = "";
                $prev_postal_postcode = "";
                $prev_postal_suburb = "";
                $prev_postal_state = "";
                $prev_postal_country = "";
                $home_address_line1 = "";
                $home_address_line2 = "";
                $home_address_post_code = "";
                $home_address_suburb = "";
                $home_address_state = "";
                $home_address_country = "";

                if (count($allbasicinfos) > 0) {
                    foreach ($allbasicinfos as $abi) {
                        $basicinfo_id = $abi->basicinfo_id;
                        $user_id = $abi->user_id;
                        $tax_file_number = $abi->tax_file_number;
                        $title_id = $abi->title_id;
                        $first_name = $abi->first_name;
                        $last_name = $abi->last_name;
                        $middle_name = $abi->middle_name;
                        $name_title_changed = $abi->name_title_changed;
                        $date_of_birth = $abi->date_of_birth;
                        $contact_phone = $abi->contact_phone;
                        $contact_email = $abi->contact_email;
                        $email_tax_tips = $abi->email_tax_tips;
                        $postal_address_changed = $abi->postal_address_changed;
                        $home_postal_address_same = $abi->home_postal_address_same;
                        $inter_postal_address = $abi->inter_postal_address;
                        $line1 = $abi->line1;
                        $line2 = $abi->line2;
                        $postcode = $abi->postcode;
                        $suburb = $abi->suburb;
                        $state = $abi->state;
                        $country = $abi->country;
                        $pevious_title = $abi->pevious_title;
                        $previous_first_name = $abi->previous_first_name;
                        $previous_middle_name = $abi->previous_middle_name;
                        $previous_last_name = $abi->previous_last_name;
                        $prev_postal_line1 = $abi->prev_postal_line1;
                        $prev_postal_line2 = $abi->prev_postal_line2;
                        $prev_postal_postcode = $abi->prev_postal_postcode;
                        $prev_postal_suburb = $abi->prev_postal_suburb;
                        $prev_postal_state = $abi->prev_postal_state;
                        $prev_postal_country = $abi->prev_postal_country;
                        $home_address_line1 = $abi->home_address_line1;
                        $home_address_line2 = $abi->home_address_line2;
                        $home_address_post_code = $abi->home_address_post_code;
                        $home_address_suburb = $abi->home_address_suburb;
                        $home_address_state = $abi->home_address_state;
                        $home_address_country = $abi->home_address_country;
                    }
                }
                ?>
                <form method="post" action="" id="basic_info">
                    {{csrf_field()}}
                    <div class="row col-sm-12">
                        <div class="col-md-6">
                            <label for="tax_file_number">Tax File Number</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                <input type="text" class="form-control" id="tax_file_number" name="tax_file_number" value="<?php echo $tax_file_number ?>" > 
<!--                                <input type="hidden" class="form-control" id="tax_file_number" name="tax_file_number" value=""> -->

                                <?php
                                if ($user_id == Auth::User()->id) {

                                    echo '<input type="hidden" class="form-control" id="mode" name="mode" value="1">';
                                    echo '<input type="hidden" class="form-control" id="basicinfo_id" name="basicinfo_id" value="' . $basicinfo_id . '">';
                                }
//  Session::get('taxfile_id');
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <div class="col-md-6">
                            <label for="title">Title</label>                                
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                <select id="title" class="form-control" name="title">
                                    <option value="0" selected>Choose</option>
                                    <?php
                                    $Titles = DB::table('tbl_title')->select('title_id', 'title_name')->get();
                                    foreach ($Titles as $title) {
                                        if ($title_id == $title->title_id) {
                                            echo '<option selected value="' . $title->title_id . '">' . $title->title_name . '</option>';
                                        } else {
                                            ?>
                                            <option value="{{$title->title_id}}">{{$title->title_name}}</option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select></div>
                        </div>
                    </div>

                    <div class="row col-sm-12">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name (Given Name)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $first_name ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <div class="form-group col-md-6">
                            <label for="suffix">Middle Name</label><div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                <input type="text" class="form-control" id="suffix" name="suffix" value="<?php echo $middle_name ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row col-sm-12">
                        <div class="form-group col-md-6">
                            <label for="last_name">Last Name (Surname)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width color_blue"></i></span>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name ?>">
                            </div>
                        </div>
                    </div>



                    <div class="form-check col-sm-12">
                        <label class="containerss" style=""> My name and/or title has been changed since my last tax return.
                            <input type="checkbox" value="1" name="name_title_changed" id="name_title_changed" <?php
                            if ($name_title_changed == 1) {
                                echo "checked";
                            } else {
                                
                            }
                            ?> onclick="PreviousNameTitle()">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div id="AddPreviousSection">
                        <div class="col-sm-12 " id="PreviousNameTitle"> 
                            <p>Please contact the ATO immediately to update your personal details otherwise we are unable to lodge your tax return.</p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="pevious_title">Previous Title</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home color_blue"></i></span>
                                        <select id="pevious_title" class="form-control" name="pevious_title">
                                            <option value="0" selected>Choose</option>
                                            <?php
                                            $Titles = DB::table('tbl_title')->select('title_id', 'title_name')->get();
                                            foreach ($Titles as $title) {
                                                if ($pevious_title == $title->title_id) {
                                                    echo '<option selected value="' . $title->title_id . '">' . $title->title_name . '</option>';
                                                } else {
                                                    ?>
                                                    <option value="{{$title->title_id}}">{{$title->title_name}}</option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="previous_first_name">Previous First Name</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home color_blue"></i></span>
                                        <input type="text" class="form-control" id="previous_first_name" name="previous_first_name" value="{{$previous_first_name}}">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="previous_middle_name">Previous Middle Name</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-adjust color_blue"></i></span>
                                        <input type="text" class="form-control" id="previous_middle_name" name="previous_middle_name" value="{{$previous_middle_name}}">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="previous_last_name">Previous Last Name</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-adjust color_blue"></i></span>
                                        <input type="text" class="form-control" id="previous_last_name" name="previous_last_name" value="{{$previous_last_name}}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_of_birth">Date of Birth* ( enter as dd/mm/yyyy e.g. 31/12/1991)</label><div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar color_blue"></i></span>
                            <input type="text" class="form-control datepicker" id="date_of_birth" name="date_of_birth" value="{{ \Carbon\Carbon::parse($date_of_birth)->format('d/m/Y')}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>Contact Information</strong> 
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Contact Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-mobile color_blue"></i></span>
                            <input type="text" class="form-control col-md-4" id="phone" name="phone" value="<?php echo $contact_phone ?>">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-at color_blue"></i></span>
                            <input type="email" class="form-control col-md-4" id="email" name="email" value="<?php echo $contact_email ?>">
                        </div>
                    </div>
                    <div class="form-check col-sm-12">
                        <label class="containerss" style=""> Yes, please email me tax tips and information to help make tax time as simple as possible. 
                            <input type="checkbox" value="1" name="email_tax_tips" id="email_tax_tips" <?php
                            if ($email_tax_tips == 1) {
                                echo "checked";
                            } else {
                                
                            }
                            ?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group col-sm-12">
                        <p>We value your privacy and will never spam you. Consult our <a href="#" style="color:blue">Privacy Policy</a> for more details on how we safeguard your information</p>
                    </div>
                    <div class="col-sm-12">
                        <div class="alert alert-info">
                            <strong>Postal Address</strong> 
                        </div>
                        <p>If you have changed your address since lodging your last tax return, please contact the ATO immediately to update this information otherwise your tax return will be delayed. </p>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <p>Has your postal address changed since your last tax return? </p>
                        </div>
                        <div class="input-group col-md-6">
                            <div class="col-sm-12"> 
                                <div class="input-group">
                                    <?php $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get(); ?>
                                    @foreach($yesnos as $yn)
                                    <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                        <input type="radio" id="postal_address_changed" name="postal_address_changed" value="{{$yn->yes_no_id}}" <?php
                                        if ($postal_address_changed == $yn->yes_no_id) {
                                            echo "checked";
                                        }
                                        ?> onclick="postalAddressChang()">
                                        <span class="checkmark_radio"></span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div><br/>
                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <p>Is your home address the same as your postal address?
                                ?</p>
                        </div>
                        <div class="input-group col-md-6">
                            <div class="col-sm-12"> 
                                <div class="input-group">
                                    <?php
                                    $yesnos = DB::table('tbl_yes_no')->select('yes_no_id', 'yes_no_name')->get();
                                    ?>
                                    @foreach($yesnos as $yn)
                                    <label class="container_radio radio-inline">{{$yn->yes_no_name}}
                                        <input type="radio" name="home_postal_address_same" value="{{$yn->yes_no_id}}" <?php
                                        if ($home_postal_address_same == $yn->yes_no_id) {
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
                    <section id="interaddress">
                        <!--                        <div class="form-check col-sm-12">
                                                    <label class="containerss" style=""> Tick Here if International Postal Address
                                                        <input type="checkbox" value="1" name="inter_postal_address" id="inter_postal_address" onclick="ifInternationPostalAddress()" <?php
                        // if ($inter_postal_address == 1) {
                        //     echo "checked";
                        //  } else {
                        //  }
                        ?>>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>-->
                        <div class="col-sm-12 " id="international_addresss"> 
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="line1">Line1</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home color_blue"></i></span>
                                        <input type="text" class="form-control" id="line1" name="line1" value="<?php echo $line1; ?>">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="line2">Line2</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home color_blue"></i></span>
                                        <input type="text" class="form-control" id="line2" name="line2" value="<?php echo $line2 ?>">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="post_code">Post Code</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-adjust color_blue"></i></span>
                                        <input type="text" class="form-control" id="post_code" name="post_code" value="<?php echo $postcode ?>" onkeypress="return isNumber(event)">
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="suburb">Suburb</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="suburb" class="select2 form-control " name="suburb" style="width: 100%;">
<!--                                            <option selected value="0">Choose</option>-->
                                            <?php
//                                            $suburbs = DB::table('tbl_suburb')->select('suburb_id', 'suburb_name')->take(20)->get();
//                                            foreach ($suburbs as $suburbd) {
//                                                if ($suburb == $suburbd->suburb_id) {
//                                                    echo '<option selected value="' . $suburbd->suburb_id . '">' . $suburbd->suburb_name . '</option>';
//                                                } else {
//                                                    echo '<option value="' . $suburbd->suburb_id . '">' . $suburbd->suburb_name . '</option>';
//                                                }
//                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="state">State</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="title" class="form-control" name="state">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $allstates = DB::table('tbl_state')->select('state_id', 'state_name')->get();
                                            foreach ($allstates as $states) {
                                                if ($state == $states->state_id) {
                                                    echo '<option selected value="' . $states->state_id . '">' . $states->state_name . '</option>';
                                                } else {
                                                    echo '<option value="' . $states->state_id . '">' . $states->state_name . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="country">Country</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="title" class="form-control" name="country">
                                            <option selected value="<?php echo $country ?>">Choose</option>
                                            <?php
                                            $allcountries = DB::table('tbl_countries')->select('country_id', 'country_name')->get();
                                            foreach ($allcountries as $single_c) {
                                                if ($country == $single_c->country_id) {
                                                    echo '<option selected value="' . $single_c->country_id . '">' . $single_c->country_name . '</option>';
                                                } else {
                                                    echo '<option value="' . $single_c->country_id . '">' . $single_c->country_name . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--                        // Previous Postal Address-->
                        <div class="col-sm-12 " id="PreviousPostalAddress"> 
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Previous Postal Address</h4>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prev_postal_line1">Line1</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home color_blue"></i></span>
                                        <input type="text" class="form-control" id="prev_postal_line1" name="prev_postal_line1" value="{{$prev_postal_line1}}">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="prev_postal_line2">Line2</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home color_blue"></i></span>
                                        <input type="text" class="form-control" id="prev_postal_line2" name="prev_postal_line2" value="{{$prev_postal_line2}}">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="prev_postal_postcode">Post Code</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-adjust color_blue"></i></span>
                                        <input type="text" class="form-control" id="prev_postal_postcode" name="prev_postal_postcode" value="{{$prev_postal_postcode}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="prev_postal_suburb">Suburb</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="prev_postal_suburb" class="form-control select2" name="prev_postal_suburb" style="width: 100%;">
                                            <option selected value="0">Choose</option>
                                            <?php
//                                            $suburbs = DB::table('tbl_suburb')->select('suburb_id', 'suburb_name')->get();
//                                            foreach ($suburbs as $suburbd) {
//                                                if ($prev_postal_suburb == $suburbd->suburb_id) {
//                                                    echo '<option selected value="' . $suburbd->suburb_id . '">' . $suburbd->suburb_name . '</option>';
//                                                } else {
//                                                    echo '<option value="' . $suburbd->suburb_id . '">' . $suburbd->suburb_name . '</option>';
//                                                }
//                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="prev_postal_state">State</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="prev_postal_state" class="form-control" name="prev_postal_state">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $allstates = DB::table('tbl_state')->select('state_id', 'state_name')->get();
                                            foreach ($allstates as $states) {
                                                if ($prev_postal_state == $states->state_id) {
                                                    echo '<option selected value="' . $states->state_id . '">' . $states->state_name . '</option>';
                                                } else {
                                                    echo '<option value="' . $states->state_id . '">' . $states->state_name . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prev_postal_country">Country</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="prev_postal_country" class="form-control" name="prev_postal_country">
                                            <option selected value="<?php echo $country ?>">Choose</option>
                                            <?php
                                            $allcountries = DB::table('tbl_countries')->select('country_id', 'country_name')->get();
                                            foreach ($allcountries as $single_c) {
                                                if ($prev_postal_country == $single_c->country_id) {
                                                    echo '<option selected value="' . $single_c->country_id . '">' . $single_c->country_name . '</option>';
                                                } else {
                                                    echo '<option value="' . $single_c->country_id . '">' . $single_c->country_name . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            </fieldset>
                        </div>

                        <!--Start Home Address-->
                        <div class="col-sm-12 " id="HomeAddress"> 
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Home Address</h4>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="homeAddressLine1">Line1</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home color_blue"></i></span>
                                        <input type="text" class="form-control" id="homeAddressLine1" name="homeAddressLine1" value="{{$home_address_line1}}">
                                    </div>
                                </div>
<div class="row">
<div class="col-sm-12">    
                                <div class="form-group col-md-6">
                                    <label for="homeAddressLine2">Line2</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home color_blue"></i></span>
                                        <input type="text" class="form-control" id="homeAddressLine2" name="homeAddressLine2" value="{{$home_address_line2}}">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="homeAddressPostCode">Post Code</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-adjust color_blue"></i></span>
                                        <input type="text" class="form-control" id="homeAddressPostCode" name="homeAddressPostCode" value="{{$home_address_post_code}}" onkeypress="return isNumber(event)">
                                    </div>
                                </div>

                                
                                <div class="form-group col-md-6">
                                    <label for="homeAddressSuburb">Suburb</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="homeAddressSuburb" class="form-control select2" name="homeAddressSuburb" style="width: 100%;">
                                           
                                            <?php
//                                            $suburbs = DB::table('tbl_suburb')->select('suburb_id', 'suburb_name')->get();
//                                            foreach ($suburbs as $suburbd) {
//                                                if ($home_address_suburb == $suburbd->suburb_id) {
//                                                    echo '<option selected value="' . $suburbd->suburb_id . '">' . $suburbd->suburb_name . '</option>';
//                                                } else {
//                                                    echo '<option value="' . $suburbd->suburb_id . '">' . $suburbd->suburb_name . '</option>';
//                                                }
//                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
</div>
 </div>   
                                <div class="form-group col-md-6">
                                    <label for="homeAddressState">State</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="homeAddressState" class="form-control" name="homeAddressState">
                                            <option selected value="0">Choose</option>
                                            <?php
                                            $allstates = DB::table('tbl_state')->select('state_id', 'state_name')->get();
                                            foreach ($allstates as $states) {
                                                if ($home_address_state == $states->state_id) {
                                                    echo '<option selected value="' . $states->state_id . '">' . $states->state_name . '</option>';
                                                } else {
                                                    echo '<option value="' . $states->state_id . '">' . $states->state_name . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="homeAddressCountry">Country</label><div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-check color_blue"></i></span>
                                        <select id="homeAddressCountry" class="form-control" name="homeAddressCountry" s>
                                            <option selected value="<?php echo $country ?>">Choose</option>
                                            <?php
                                            $allcountries = DB::table('tbl_countries')->select('country_id', 'country_name')->get();
                                            foreach ($allcountries as $single_c) {
                                                if ($home_address_country == $single_c->country_id) {
                                                    echo '<option selected value="' . $single_c->country_id . '">' . $single_c->country_name . '</option>';
                                                } else {
                                                    echo '<option value="' . $single_c->country_id . '">' . $single_c->country_name . '</option>';
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            </fieldset>
                        </div>
                        <!--End Home Address -->
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <button type="button" class="btn btn-success btn-sm" onclick="BasicInfoInsert()"><i class="fa fa-forward"></i> Save and Go</button>

                                </div>
                            </div>
                        </div>
                    </section>
                    <br/><br/><br/><br/>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
//    var value = "<?php // echo $inter_postal_address;           ?>";
//    if (value == "1") {
//        $("#international_addresss").show();
//    } else {
//        $("#international_addresss").hide();
//    }
//    function ifInternationPostalAddress() {
//        if ($("#inter_postal_address").prop("checked") == true) {
//            $("#international_addresss").show();
//        } else if ($("#inter_postal_address").prop("checked") == false) {
//            $("#international_addresss").hide();
//        }
//
//    }
//
//
//    var value = "<?php // echo $inter_postal_address;           ?>";
//    if (value == "1") {
//        $("#international_addresss").show();
//    } else {
//        $("#international_addresss").hide();
//    }
//    function ifInternationPostalAddress() {
//        if ($("#inter_postal_address").prop("checked") == true) {
//            $("#international_addresss").show();
//        } else if ($("#inter_postal_address").prop("checked") == false) {
//            $("#international_addresss").hide();
//        }
//
//    }


    function PreviousNameTitle() {
    $("#preloader").show();
    if ($("#name_title_changed").prop("checked") == true) {
    $.ajax({
    type: 'get',
            url: '{{ URL::to('GetPreviousName')}}',
            data: '',
            success: function (data) {
            $("#pevious_title").val(data[0].pevious_title);
            $("#previous_first_name").val(data[0].previous_first_name);
            $("#previous_middle_name").val(data[0].previous_middle_name);
            $("#previous_last_name").val(data[0].previous_last_name);
            $("#preloader").hide();
            },
            error: function () {
            $("#preloader").hide();
            }
    });
    $("#PreviousNameTitle").show();
    } else if ($("#name_title_changed").prop("checked") == false) {
    $("#preloader").show();
    $("#pevious_title").val("");
    $("#previous_first_name").val("");
    $("#previous_middle_name").val("");
    $("#previous_last_name").val("");
    $("#PreviousNameTitle").hide();
    $("#preloader").hide();
    }

    }
    var value = "<?php echo $name_title_changed; ?>";
    if (value == "1") {
    $("#PreviousNameTitle").show();
    } else {
    $("#PreviousNameTitle").hide();
    }



    function BasicInfoInsert() {
    $.ajax({
    type: 'get',
            url: '{{ URL::to('BasicInfoInsert')}}',
            data: $("#basic_info").serialize(),
            success: function (data) {
            window.location.href = "{{URL::to('/personalinfo/otherInformation')}}";
            },
            error: function () {
            alert('Failed ! Please try again later');
            }
    });
    }

//    function postalAddressChang(){
//       var valee = $(this).val();
//       alert(valee)
//    }
    var PostVal = "<?php echo $postal_address_changed; ?>";
    if (PostVal == "1") {
    $("#PreviousPostalAddress").show();
    } else {
    $("#prev_postal_line1").val("");
    $("#prev_postal_line2").val("");
    $("#prev_postal_postcode").val("");
    $("#prev_postal_postcode").val("");
    $("#prev_postal_suburb").val("");
    $("#prev_postal_state").val("");
    $("#prev_postal_country").val("");
    $("#PreviousPostalAddress").hide();
    }
    $('input[name="postal_address_changed"]').on("click", function () {
    if ($("input[name='postal_address_changed']:checked").val() == '1') {

    $.ajax({
    type: 'get',
            url: '{{ URL::to('GetPreciousPostalAddresss')}}',
            data: '',
            success: function (data) {

            $("#prev_postal_line1").val(data[0].prev_postal_line1);
            $("#prev_postal_line2").val(data[0].prev_postal_line2);
            $("#prev_postal_postcode").val(data[0].prev_postal_postcode);
            $("#prev_postal_postcode").val(data[0].prev_postal_postcode);
            $("#prev_postal_suburb").val(data[0].prev_postal_suburb);
            $("#prev_postal_state").val(data[0].prev_postal_state);
            $("#prev_postal_country").val(data[0].prev_postal_country);
            },
            error: function () {
            }
    });
    $("#PreviousPostalAddress").show(750);
    } else {
    $("#prev_postal_line1").val("");
    $("#prev_postal_line2").val("");
    $("#prev_postal_postcode").val("");
    $("#prev_postal_postcode").val("");
    $("#prev_postal_suburb").val("");
    $("#prev_postal_state").val("");
    $("#prev_postal_country").val("");
    $("#PreviousPostalAddress").hide(750);
    }
    });
//   Start HOME Address Related Function

    var homeVal = "<?php echo $home_postal_address_same; ?>";
    if (homeVal == "1") {
    $("#homeAddressLine1").val("");
    $("#homeAddressLine2").val("");
    $("#homeAddressPostCode").val("");
    $("#homeAddressSuburb").val("");
    $("#homeAddressState").val("");
    $("#homeAddressCountry").val("");
    $("#HomeAddress").hide();
    } else {
    $("#HomeAddress").show();
    }
    $('input[name="home_postal_address_same"]').on("click", function () {
    if ($("input[name='home_postal_address_same']:checked").val() == '1') {
    $("#homeAddressLine1").val("");
    $("#homeAddressLine2").val("");
    $("#homeAddressPostCode").val("");
    $("#homeAddressSuburb").val("");
    $("#homeAddressState").val("");
    $("#homeAddressCountry").val("");
    $("#HomeAddress").hide(750);
    } else {
    $.ajax({
    type: 'get',
            url: '{{ URL::to('GetHomePostalAddress')}}',
            data: '',
            success: function (data) {
            $("#homeAddressLine1").val(data[0].home_address_line1);
            $("#homeAddressLine2").val(data[0].home_address_line2);
            $("#homeAddressPostCode").val(data[0].home_address_post_code);
            $("#homeAddressSuburb").val(data[0].home_address_suburb);
            $("#homeAddressState").val(data[0].home_address_state);
            $("#homeAddressCountry").val(data[0].home_address_country);
            },
            error: function () {
            }
    });
    $("#HomeAddress").show(750);
    }
    });</script>
<script>
      
      $( document ).ready(function() {
            //$('.select2').select2();            
           $('.select2').select2({		  
            placeholder: 'Choose',		
            ajax: {
              url: '{{ URL::to('SuburbAjaxPro')}}',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                 // console.log(data);
                return {
                  results: data
                };
              },
              cache: true
            }
          });            
        });

</script>

</script>
@stop