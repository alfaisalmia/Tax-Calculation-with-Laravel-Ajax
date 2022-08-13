
@extends("client-layouts.clientMaster")
@section("content")
<section class="ulockd-about2" style="padding: 40px 0;
         background-image:url('{{asset('public/assets/images/home/h2.jpg')}}');">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-md-offset-3">
                <div class="booking_form_style1 ">
                    <!-- Booking Form Sart-->
                    <form id="booking_form" class="booking_form " name="booking_form" action="#" method="post" novalidate="novalidate">
                        <div class="messages"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Sign up with Tax Solution </h3>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="text-align: right">Tax Year</label>
                                    <select id="form_option" class="form-control form_control required" name="form_option" required="required" data-error="Option is required.">
                                        <?php
                                        $tax_years = DB::table('tbl_tax_year')->select('tax_year_id', 'tax_years')->orderBy("tax_year_id", "desc")->get();
                                        foreach ($tax_years as $ty) {
                                            ?>
                                            <option value="{{$ty->tax_year_id}}">{{$ty->tax_years}}</option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="text-align: right">Email</label>
                                    <input id="form_email" name="form_email" class="form-control required email" placeholder="Enter email address" required="required" data-error="Email is required." type="email">
                                    <div class="help-block with-errors mail_error"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="text-align: right">Customer User Name</label>
                                    <input id="form_username" name="form_username" class="form-control required email" placeholder="Enter customer name" required="required" data-error="Username is required." type="text">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="text-align: right">Password</label>
                                    <input id="form_password" name="form_password" class="form-control required email" placeholder="Enter Password" required="required" data-error="Email is required" type="password">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="ulockd-select-style">

                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">

                                    <button type="button" class="btn ulockd-btn-thm2 btn-block " onclick="signUp()">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-center booking_form"
                         <p>Need Help? Call <i style="color: blue">+8801700000000</i> or <a href="#" style="color: blue">Contact Us</a><p>

                        <p>Already signed up?</p>
                        <div class="col-sm-12">
                            <a href="{{URL('/signin')}}" class="btn ulockd-btn-thm2 btn-block">Sign In</a>

                        </div>
                        <p>Did you forget your <a href="#" style="color: blue"> User Name or Password</a></p>
                        <p>By using this service you are agreeing to our Privacy Policy and Terms & Conditions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function signUp() {
        var form_option = $('#form_option').val();
        var form_email = $('#form_email').val();
        var form_username = $('#form_username').val();
        var form_password = $('#form_password').val();
        var str = $("#booking_form").serialize();
        if (form_option != "" && form_email != "" && form_username != "" && form_password != "") {
            $.ajax({
                type: 'get',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{ URL::to('signUpData')}}',
                data: $("#booking_form").serialize(),
                success: function (data) {
                    window.location.href = "{{URL::to('/signupConfirmation')}}";
                },
                error: function () {
                }
            });
        } else {
            alert("Please insert all field");
        }
    }
</script>
@stop