
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
                            <div class="col-sm-12 text-center">
                                <h4>Your Account Has been created Successfully . </h4><h4>Now You can sing in with your email and Password . Thanks</h4>
                                 <div class="col-sm-12">
                            <a href="{{URL('/signin')}}" class="btn ulockd-btn-thm2 btn-block">Sign In</a>

                        </div>
                            </div>
                        
                        </div>
                    </form>
                    <div class="text-center booking_form">
                         <p>Need Help? Call <i style="color: blue">+8801700000000</i> or <a href="#" style="color: blue">Contact Us</a><p>

                        <p>Need Account?</p>
                        <div class="col-sm-12">
                            <a href="{{URL('/clientRegister')}}" class="btn ulockd-btn-thm2 btn-block">CREATE ACCOUNT</a>

                        </div>
                        <p>Did you forget your <a href="#" style="color: blue"> User Name or Password</a></p>
                        <p>By using this service you are agreeing to our Privacy Policy and Terms & Conditions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop