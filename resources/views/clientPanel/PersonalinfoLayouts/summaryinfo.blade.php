
@extends("clientPanel.clientPanelMaster")
@section('title', 'Other Information')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">

          <div class="col-md-10 col-lg-10">
    <?php
                $allbasicinfos = DB::table('tbl_basic_info')->select('tbl_basic_info.tax_file_number','tbl_basic_info.first_name','tbl_basic_info.last_name','tbl_basic_info.middle_name','tbl_basic_info.date_of_birth','tbl_basic_info.contact_phone','tbl_basic_info.contact_email','tbl_basic_info.line1','tbl_basic_info.line2','tbl_basic_info.postcode','tbl_title.title_name','tbl_suburb.suburb_name','tbl_state.state_name','tbl_countries.country_name')
                        ->leftjoin('tbl_title', 'tbl_title.title_id', '=', 'tbl_basic_info.title_id')
                       ->leftjoin('tbl_suburb', 'tbl_suburb.suburb_id', '=', 'tbl_basic_info.suburb')
                        ->leftjoin('tbl_state', 'tbl_state.state_id', '=', 'tbl_basic_info.state')
                        ->leftjoin('tbl_countries', 'tbl_countries.country_id', '=', 'tbl_basic_info.country')
                        ->where('user_id', Auth::User()->id)->get();

                $tax_file_number = "";
                $first_name = "";
                $last_name = "";
                $middle_name = "";
                $date_of_birth = "";
                $contact_phone = "";
                $contact_email = "";
                $line1 = "";
                $line2 = "";
                $postcode = "";
                $title_name = "";
                $suburb_name = "";
                $state_name = "";
                $country_name = "";
//
                foreach ($allbasicinfos as $abi) {
                    $tax_file_number = $abi->tax_file_number;
                    $first_name = $abi->first_name;
                    $last_name = $abi->last_name;
                    $middle_name = $abi->middle_name;
                    $date_of_birth = $abi->date_of_birth;
                    $contact_phone = $abi->contact_phone;
                    $contact_email = $abi->contact_email;
                    $line1 = $abi->line1;
                    $line2 = $abi->line2;
                    $postcode = $abi->postcode;
                    $title_name = $abi->title_name;
                    $suburb_name = $abi->suburb_name;
                    $state_name = $abi->state_name;
                    $country_name = $abi->country_name;
                }
                ?>
            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Personal Information Summary</h3>
                    <h5>Please review your entries in the personal information section and verify that everything is correct.</h5>
                    <div class="alert alert-info">
                        <strong>Personal Information</strong> <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-pencil"></i>  &nbsp;Edit</a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tax File Number</th>
                            <td><?php echo $tax_file_number;?></td>
                        </tr>

                        <tr>
                            <th scope="row">Title</th>
                            <td><?php echo $title_name ; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">First Name ( Given Name )</th>
                            <td><?php echo $first_name ?></td>
                        </tr>
                         <tr>
                            <th scope="row">Middle Name</th>
                            <td><?php echo $middle_name ;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Last Name( Surname )</th>
                            <td><?php echo $last_name; ?></td>
                        </tr>
                       
                        <tr>
                            <th scope="row">Date of Birth</th>
                            <td><?php echo $date_of_birth ;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Daytime Phone</th>
                            <td><?php echo $contact_phone ;?></td>
                        </tr>

                        <tr>
                            <th scope="row">Email Address</th>
                            <td><?php echo $contact_email;?></td>
                        </tr>

                    </table>
                </div>
                <div class="col-sm-12">
                 <div class="alert alert-info">
                     <strong>Postal Address</strong> <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-pencil"></i>  &nbsp;Edit</a>
                    </div>
                </div>
                 <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Line 1</th>
                            <td><?php echo $line1 ?></td>
                        </tr>

                        <tr>
                            <th scope="row">Line 2</th>
                            <td><?php echo $line2; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Post Code</th>
                            <td><?php echo $postcode ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Subrub</th>
                            <td><?php echo $suburb_name ?></td>
                        </tr>
                        <tr>
                            <th scope="row">State</th>
                            <td><?php echo $state_name ;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Country</th>
                            <td><?php echo $country_name; ?></td>
                        </tr>
                    </table>
                </div>
                <form>
                    

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <a href="{{URL('/income/mainPage')}}" class="btn btn-success btn-sm"><i class="fa fa-forward"></i> Save and Go</a>
                                

                            </div>
                        </div>
                    </div>
                    <br/><br/><br/><br/>
            </div>



            </form>

        </div>

    </div>

</div>
</div>
</div>

@stop