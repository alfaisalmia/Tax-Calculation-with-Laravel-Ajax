
@extends("client-layouts.clientMaster")
@section("content")
<style>
    .logerror{
        color: red;
    }
</style>
<section class="ulockd-about2" style="padding: 40px 0;
         background-image:url('{{asset('public/assets/images/home/h1.jpg')}}');">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-md-offset-3">
                <div class="booking_form_style1 ">
                    <!-- Booking Form Sart-->
                    @if(session()->has('message'))
                    <div class="alert alert-danger logerror" style="text-align: center">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form id="booking_form" class="booking_form " name="booking_form" action="{{route('login')}}" method="post" novalidate="">
                        {{csrf_field()}}
                        <div class="messages"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>Sign in to start your tax return
                                </h3>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="text-align: right">Tax Year</label>
                                    <select id="form_tax_year" class="form-control form_control required" name="form_tax_year" required="required" data-error="Option is required.">
                                                       <?php
                                $tax_years = DB::table('tbl_tax_year')->select('tax_year_id', 'tax_years')->orderBy("tax_year_id", "desc")->get();
                                foreach ($tax_years as $ty) {
                                    ?>
                                    <option value="{{$ty->tax_year_id}}">{{$ty->tax_years}}</option>
                                    <?php
                                }
                                ?>
                            </select>

                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="text-align: right">Email</label>
                                    <input id="form_email" name="form_email" class="form-control required email" placeholder="Enter email address" required="required" data-error="Email is required." type="email" value="">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label style="text-align: right">Password</label>
                                    <input id="form_password" name="form_password" class="form-control required email" placeholder="Enter Password" required="required" data-error="Email is required" type="password" value="">
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
                                    <input name="form-botcheck" class="form-control" type="hidden" value="">
                                    <button type="submit" class="btn ulockd-btn-thm2 btn-block" onclick="signIn()">Sign In</button>
                                </div>
                                   <table class="table table-bordered">
                            <tr>
                                <th colspan="4"  class="text-center">Login Details</th>
                            </tr>
                            <tr>
                                <th scope="col">Role</th>
                                <th scope="col">Tax Year</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                            </tr>
                            <tr>
                                <td>Tax User</td>
                                <td>2018-2019</td>
                                <td>tax@gmail.com</td>
                                <td>tax123</td>
                            </tr>
                        </table
                               
                            </div>
                        </div>
                    </form>
                    <div class="text-center booking_form">
                        <p>Did you forget your <a href="#" style="color: blue"> User Name or Password</a></p>
                        <hr>
                        <h2>New to DIY Online Tax Return?</h2>
                        <p>New Online Tax Return?</p>

                        <a href="{{URL('/clientRegister')}}" class="btn ulockd-btn-thm2 btn-block">CREATE ACCOUNT</a>
                        <p>Need Help? Call <i style="color: blue">+8801700000000</i> or <a href="#" style="color: blue">Contact Us</a><p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script>
    setTimeout(function () {
        $('.logerror').fadeOut('slow');
    }, 3000);
</script>
<script type="text/javascript">

//    //function signIn() {
//        var form_option = $('#form_option').val();
//        var form_email = $('#form_email').val();
//        var form_password = $('#form_password').val();
//
//        alert(form_option);
//
//    }

</script>
@stop