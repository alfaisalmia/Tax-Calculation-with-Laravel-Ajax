<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="_token" content="{{ csrf_token() }}" />
        <!-- css file -->
        <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/jquery-ui.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/font-awesome-animation.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/elegantIcons.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/pe-icon-7-stroke.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/pe-icon-7-stroke.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/icon-moon.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/bootsnav.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/fullcalendar.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/slider.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/hover.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/imagehover.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/fancyBox.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/owl.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/isotop.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/flipclock.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/timecounter.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/3d-buttons.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/colors/default.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/css/responsive.css')}}">
        <!-- Title -->
        <title>TAX Solution</title>
        <!-- Favicon -->
        <link href="{{asset('public/assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
        <link href="{{asset('public/assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" />
        <style>
            .ulockd-btn-white:hover{
                border: 1px solid #ffffff !important;
                color:#ffffff;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <!--            <div id="preloader" class="preloader">
                            <div id="pre" class="preloader_container"><div class="preloader_disabler btn btn-default">Disable Preloader</div></div>
                        </div>-->
            <div class="header-top style2 ulockd-bgthm">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="welcm-ht">
                                <ul class="list-inline ulockd-mrgn60">
                                    <li class="ulockd-welcntxt color-white"> <strong class="fa fa-phone"></strong> +88-017-000-000</li>
                                    <li class="ulockd-welcntxt color-white"> <strong class="fa fa-envelope"></strong> Free enquiry</li>
                                    <li class="ulockd-welcntxt color-white"> <strong class="fa fa-clock-o"></strong> 08:00AM -05:00PM</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="welcm-ht">
                                <ul class="list-inline footer-font-icon ulockd-mrgn125 ulockd-mrgn60">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 ulockd-pad30">
                            <div class="welcm-ht text-right">
                                <ul class="list-inline ulockd-mrgn60">

                                    <li><a href="{{URL('/signin')}}" class="btn btn-xs ulockd-btn-white"><i class=" color-white"></i>Online Tax Login</a></li>
                                    <li><a href="{{URL('/clientRegister')}}" class="btn btn-xs ulockd-btn-white"><i class=" color-white"></i>Register Now</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Styles -->
            <header class="header-nav">
                <div class="main-header-nav navbar-scrolltofixed">
                    <div class="container">
                        <nav class="navbar navbar-default bootsnav menu-style1">
                            <!-- Start Top Search -->
                            <div class="top-search">
                                <div class="container">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Top Search -->
                            <div class="container ulockd-pdng0">
                                <!-- Start Atribute Navigation -->

                                <!-- End Atribute Navigation -->

                                <!-- Start Header Navigation -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <a class="navbar-brand ulockd-main-logo2" href="{{URL('/')}}">
                                        <img src="{{URL('/')}}/public/assets/images/header-logo2.png" class="logo logo-scrolled" alt="header-logo2.png">
                                    </a>
                                </div>
                                <!-- End Header Navigation -->

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="navbar-menu">
                                    <ul class="nav navbar-nav navbar-center" data-in="fadeIn">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown">Individual Tax</a>
                                            <ul class="dropdown-menu">
                                                <li class="">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inoffice tax return</a>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Online DIY</a>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Online Tax Pro</a>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Under 21 and student tax returns</a>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Second look assessment</a>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">US Citizens Tax</a>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Late or prior returns</a>
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Property investor tax returns</a>

                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Small Business</a>
                                            <ul class="dropdown-menu">
                                                <li class="">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sole Trader & Partnerships</a>  
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Company & Trust</a>  
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bookkeeping</a>  


                                                </li>

                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">SMSF  & Financial Advice</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Self managed super fund solutions</a></li>
                                                <li><a href="#">Financial Advice</a></li>

                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tax Training School</a>
                                            <ul class="dropdown-menu">
                                                <li class="#">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Income Tax Courses</a>
                                                </li>

                                            </ul>
                                        </li>


                                    </ul>
                                </div><!-- /.navbar-collapse -->
                            </div>

                            <!-- Start Side Menu -->

                            <!-- End Side Menu -->
                        </nav>
                    </div>
                </div>
            </header>




            @yield("content")



            <!-- Our Footer -->
            <section class="ulockd-footer ulockd-pdng0">
                <div class="container footer-padding">
                    <div class="row">
                        <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4">
                            <div class="widget-about">
                                <div class="logo-widget tac-xxsd ulockd-mrgn615">
                                    <img src="{{URL('/')}}/public/assets/images/footer-logo.png" alt="footer-logo.png">
                                </div>
                                <p>Regardless of whether you need to stay in your own house, are searching for help with a more established relative, looking for exhortation on paying for development, we can help you.</p>

                            </div>

                        </div>

                        <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4">
                            <div class="news-widget">
                                <h3>Latest News</h3>
                                <div class="ulockd-media-box">
                                    <div class="media">
                                        <div class="media-left pull-left">
                                            <a href="#">
                                                <img class="media-object" src="{{URL('/')}}/public/assets/images/blog/s1.jpg" alt="s1.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Let's Move With Blog </h4>
                                            <a href="#" class="post-date">21 January, 2018</a>
                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-left pull-left">
                                            <a href="#">
                                                <img class="media-object" src="{{URL('/')}}/public/assets/images/blog/s2.jpg" alt="s2.jpg">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Let's Move With Blog </h4>
                                            <a href="#" class="post-date">21 January, 2018</a>
                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4">
                            <div class="link-widget">						
                                <h3>Important Link</h3>
                                <ul class="list-style-square">
                                    <li><a href="#"> About Licences</a></li>
                                    <li><a href="#"> Carrers</a></li>
                                    <li><a href="#"> Community & Forum</a></li>
                                    <li><a href="#"> Help & Conditions</a></li>
                                    <li><a href="#"> Privacy Policy</a></li>
                                    <li><a href="#"> Terms & Conditions</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="ulockd-copy-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="color-white">TaxAcc Copyright© 2018. All right reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <a class="scrollToHome ulockd-bgthm" href="#"><i class="fa fa-home"></i></a>
        </div>
        <!-- Wrapper End -->
        <script type="text/javascript" src="{{asset('public/assets/js/jquery-1.12.4.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/bootsnav.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/parallax.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/scrollto.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/jquery-scrolltofixed-min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/jquery.counterup.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/gallery.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/wow.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/slider.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/video-player.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/jquery.barfiller.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/jflickrfeed.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('public/assets/js/timepicker.js')}}"></script>
<!--        <script type="text/javascript" src="{{asset('public/assets/js/tweetie.js')}}"></script>-->
        <!-- Custom script for all pages --> 
       <!-- <script type="text/javascript" src="{{asset('public/assets/js/color-switcher.js')}}"></script>-->
        <script type="text/javascript" src="{{asset('public/assets/js/script.js')}}"></script>
    </body>
</html>