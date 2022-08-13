
@extends("clientPanel.clientPanelMaster")
@section('title', 'Other Information')
@section("content")

<!-- Inner Pages Main Section -->
<div class="ulockd-service-details">
    <div class="container">

        <div class="col-md-10 col-lg-10">

            <div class="row"style="background-color: white">
                <div class="col-md-12 ulockd-mrgn1210">
                    <h3>Personal Information Summary</h3>
                    <h5>Please review your entries in the personal information section and verify that everything is correct.</h5>
                    <div class="alert alert-info">
                        <strong>Personal Information</strong> <a href="{{URL('/personalinfo/basicInfo')}}" class="btn btn-success btn-xs pull-right"><i class="fa fa-pencil"></i>  &nbsp;Edit</a>
                    </div>
                </div>
                <?php
                $allbasicinfos = DB::table('tbl_basic_info')
                                ->select('tbl_basic_info.*', 'tbl_countries.country_name','tbl_title.title_name')
                                ->leftjoin('tbl_countries', 'tbl_countries.country_id', '=', 'tbl_basic_info.postal_country')
                             
                                ->leftjoin('tbl_title', 'tbl_title.title_id', '=', 'tbl_basic_info.title_id')
                                //->leftjoin('tbl_other_info', 'tbl_other_info.user_id', '=', 'tbl_basic_info.user_id')
                                ->where('user_id', Auth::User()->id)->get();
        
                
              $basicinfo_id = "";
              $user_id ="";
                $tax_file_number = "";
                $title_name = "";
                $first_name = "";
                $last_name = "";
                $suffix = "";
      
                $date_of_birth = "";
                $contact_number = "";
                $contact_email = "";
                $postal_Address = "";
                $country_name = "";
               

                foreach ($allbasicinfos as $abi) {
                    $basicinfo_id = $abi->basicinfo_id;
                    $user_id = $abi->user_id;
                    $tax_file_number = $abi->tax_file_number;
                    $title_name = $abi->title_name;
                    $first_name = $abi->first_name;
                    $last_name = $abi->last_name;
                    $suffix = $abi->suffix;
                    $date_of_birth = $abi->date_of_birth;
                    $contact_number = $abi->contact_number;
                    $contact_email = $abi->contact_email;
                    $postal_Address = $abi->postal_Address;
                    $country_name = $abi->country_name;
                  
                }
                ?>
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Tax File Number</th>
                            <td>{{$tax_file_number}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Title</th>
                            <td>{{$title_name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">First Name ( Given Name )</th>
                            <td>{{$first_name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Name( Surname )</th>
                            <td>{{$last_name}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Suffix</th>
                            <td>{{$suffix}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Date of Birth</th>
                            <td>{{$date_of_birth}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Daytime Phone</th>
                            <td>{{$contact_number}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Evening Phone</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Email Address</th>
                            <td>{{$contact_email}}</td>
                        </tr>

                    </table>
                </div>
                <div class="col-sm-12">
                    <div class="alert alert-info">
                        <strong>Postal Address</strong> <a href="{{URL('/personalinfo/basicInfo')}}#postal_address" class="btn btn-success btn-xs pull-right"><i class="fa fa-pencil"></i>  &nbsp;Edit</a>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Country Name</th>
                            <td>{{$country_name}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Postal Address</th>
                            <td>{{$postal_Address}}</td>
                        </tr>
                     
                    </table>
                </div>
                <form>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <a href="{{URL('/personalinfo/otherInformation')}}" class="btn btn-info btn-sm"><i class="fa fa-backward"></i> Go Back</a>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-forward"></i> Save and Go</button>

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