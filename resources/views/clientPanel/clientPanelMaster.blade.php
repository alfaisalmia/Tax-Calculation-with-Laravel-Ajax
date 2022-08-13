<?php
session_start();
$SUserID = Auth::User()->id;
if (!isset($SUserID)) {
    exit;
    die;
}
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="_token" content="{{ csrf_token() }}" />
        <!-- css file -->

        <link rel="stylesheet" href="{{asset('public/assets/css/jquery-ui.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
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
        <!--<link rel="stylesheet" href="{{asset('public/assets/css/timecounter.css')}}">-->
        <link rel="stylesheet" href="{{asset('public/assets/css/3d-buttons.css')}}">
        <link rel="stylesheet" href="{{asset('public/assets/css/colors/default.css')}}">

        <link rel="stylesheet" href="{{asset('public/assets/css/responsive.css')}}">
        <script type="text/javascript" src="{{asset('public/assets/js/jquery-1.12.4.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('public/assets/select2/js/select2.min.js')}}"></script>

        <!-- Title -->
        <title>@yield('title')</title>
        <!-- Favicon -->
        <link href="{{asset('public/assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
        <link href="{{asset('public/assets/images/favicon.ico')}}" sizes="128x128" rel="shortcut icon" />
        <style>
            .ulockd-all-service a {
                border-radius: 0;
                font-size: 13px;
                margin-bottom: 0px;
                padding: 3px 16px;
                text-transform: capitalize;
            }
            .form-control {
                border-radius: 0px;
            }
            body{
                font-size: 13px;
            }
            .btn{
                border-radius: 0px;
            }
            .mainmenu_active{
                border-bottom: 2px solid black;
                background-color: #E6E6E6;

            }
            p{
                font-size: 14px;
            }
            .color_blue{
                color: blue;
            }
            body.modal-open { 
                padding-right: 0 !important;
                overflow-y: scroll;
            } 
            .our_link{
                text-decoration: underline;
                font-weight: bold;

            }
            /* Customize the label (the container) */
            .containerss {
                display: block;
                position: relative;
                padding-left: 25px;
                margin-bottom: 8px;
                cursor: pointer;
                font-size: 14px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default checkbox */
            .containerss input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            /* Create a custom checkbox */
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 20px;
                width: 20px;
                background-color: #eee;
                border: 1px solid #2196F3;

            }

            /* On mouse-over, add a grey background color */
            .containerss:hover input ~ .checkmark {
                background-color: #ccc;
            }

            /* When the checkbox is checked, add a blue background */
            .containerss input:checked ~ .checkmark {
                background-color: #2196F3;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the checkmark when checked */
            .containerss input:checked ~ .checkmark:after {
                display: block;
            }

            /* Style the checkmark/indicator */
            .containerss .checkmark:after {
                left: 6px;
                top: 1px;
                width: 7px;
                height: 14px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            nav.navbar.bootsnav.menu-style1 ul.nav li a {
                padding: 14px 15px;
            }
            p, h1, h2, h3, h4, h5, h6, span {
                color:black;
            }
            .letters {
                background: #007ee5;
                padding: 5px;
                padding-left: 11px;
                padding-right: 11px;
                color: #fff;
                font-weight: 700;
                float: left;
                margin-right: 10px;
                margin-top: 2px;
            }
            .container_radio {
                /* display: block; */
                position: relative;
                padding-left: 28px;
                margin-bottom: -1px;
                cursor: pointer;
                font-size: 14px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default radio button */
            .container_radio input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            /* Create a custom radio button */
            .checkmark_radio {
                position: absolute;
                top: 0;
                left: 0;
                height: 19px;
                width: 19px;
                background-color: #eee;
                border-radius: 50%;
            }

            /* On mouse-over, add a grey background color */
            .container_radio:hover input ~ .checkmark_radio {
                background-color: #ccc;
            }

            /* When the radio button is checked, add a blue background */
            .container_radio input:checked ~ .checkmark_radio {
                background-color: #2196F3;
            }

            /* Create the indicator (the dot/circle - hidden when not checked) */
            .checkmark_radio:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the indicator (dot/circle) when checked */
            .container_radio input:checked ~ .checkmark_radio:after {
                display: block;
            }

            /* Style the indicator (dot/circle) */
            .container_radio .checkmark_radio:after {
                top: 6px;
                left: 6px;
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: white;
            }
        </style>
    </head>
    <body class="ulockd_bgp1">
        <div id="preloader" class="preloader">
            <div id="pre" class="preloader_container"></div>
        </div>
        <?php
        $user_name = Auth::user()->user_name;
        $tax_year = Auth::user()->tax_year;
        $tax_year_id = Session::get('tax_year_id');
        $last_name = "";
        $allbasicinfos = DB::table('tbl_basic_info')->select('*')->where('user_id', Auth::User()->id)->get();
        foreach ($allbasicinfos as $abi) {

            $last_name = $abi->last_name;
        }
        // print_r($users);
        ?>
        <div class="header-top style2 ulockd-bgthm">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="welcm-ht">
                            <ul class="list-inline ulockd-mrgn60">
                                <li class="ulockd-welcntxt color-white"> <strong class=""></strong> ETAX LOGO</li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="welcm-ht">
                            <ul class="list-inline footer-font-icon ulockd-mrgn125 ulockd-mrgn60">
                                <li style="color:white">Package Type: <p class="btn btn-xs btn-warning">Express</p></li>
                                <li style="color:white">Estimated 2018 Refund: <p class="btn btn-xs btn-warning">$1400</p></li>


                            </ul>
                        </div>
                    </div>
                    <?php
                    $DetailsTaX = DB::table('tbl_tax_year')->select('tax_years')->where('tax_year_id', $tax_year_id)->get();
                    foreach ($DetailsTaX as $i) {
                        $taxYears = $i->tax_years;
                    }
                    ?>
                    <div class="col-md-3 ulockd-pad30">
                        <div class="welcm-ht text-right">
                            <ul class="list-inline ulockd-mrgn60">
                                <span class="btn btn-xs" style="color:white"><b>Welcome ! {{$user_name}} </b></span><br/>
                                <span class="btn btn-xs" style="color:white"><b>User ID: </b> {{$last_name}}</span>
                                <span class="btn btn-xs" style="color:white"><b>TAX YEAR: </b> {{$taxYears }}</span>

                                <a href="{{ route('logout') }}" class="btn btn-xs btn-info"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" ><i class="fa fa-sign-out"></i> Save Refund & Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
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

                            </div>
                            <!-- End Header Navigation -->

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="navbar-menu">
                                <ul class="nav navbar-nav navbar-center" data-in="fadeIn">
                                    <?php
                                    $segment_f = Request::segment(1);
                                    $mainmenus = DB::table('tbl_mainmenu')->select("*")->get();
                                    foreach ($mainmenus as $mmenu) {
                                        $pieces = explode("/", $mmenu->mainmenu_url);
                                        ?>
                                        <li class="active"><a href="{{URL('/'.$mmenu->mainmenu_url)}}" class="dropdown-toggle <?php if ($segment_f == $pieces[0]) echo "mainmenu_active" ?>" data-toggle="dropdown"><i class="{{$mmenu->mainmenu_icon}}"></i>&nbsp;{{$mmenu->mainmenu_name}} </a></li>
                                        <?php
                                    }
                                    ?>



                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div>

                        <!-- Start Side Menu -->
                        <div class="side ulockd-bgthm">
                            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                            <div class="widget">
                                <h4 class="title">Custom Pages</h4>
                                <ul class="link">
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Services</a></li>
                                    <li><a href="#">Blog</a></li>
                                    <li><a href="#">Portfolio</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                            <div class="widget">
                                <h4 class="title">Additional Links</h4>
                                <ul class="link">
                                    <li><a href="#">Retina Homepage</a></li>
                                    <li><a href="#">New Page Examples</a></li>
                                    <li><a href="#">Parallax Sections</a></li>
                                    <li><a href="#">Shortcode Central</a></li>
                                    <li><a href="#">Ultimate Font Collection</a></li>
                                    <li><img title="Facebook Feed With Client File" class="img-responsive ulockd-mrgn1210" src={{URL('/')}}/public/assets{{URL('/')}}/public/assets/images/resource/image3.png" alt="image3.png"></li>
                                </ul>
                                <ul class="list-inline footer-font-icon ulockd-mrgn1220">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-feed"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Side Menu -->
                    </nav>
                </div>
            </div>

        </header>
        <!-- Inner Pages Main Section -->
        <div class="ulockd-service-details">
            <div class="container">
                <div class="col-md-2 col-lg-2 ulockd-pdng0">
                    <div class="widget-sidebar">
                        <div class="ulockd-all-service">
                            <div class="list-group">
                                <?php
                                $segment1 = Request::segment(1);
                                $segment2 = Request::segment(2);
                                $menu_part = ucwords($segment1);
//echo $menu_part;die();
                                $mainmenu_id_arr = DB::table('tbl_mainmenu')->select("mainmenu_id")->where('mainmenu_name', $menu_part)->get()->toArray();

                                foreach ($mainmenu_id_arr as $d) {
                                    $original_id = $d->mainmenu_id;
                                }


//                        To get the url
                                $geturl = $segment1 . '/' . $segment2;
//              To get the submenu from database
                                $submenus = DB::table('tbl_submenu_permi')
                                        ->select('tbl_submenu.*')
                                        ->leftjoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_submenu_permi.submenu_id')
                                        ->where('tbl_submenu.mainmenu_id', $original_id)
                                        ->where('tbl_submenu_permi.user_id', Auth::User()->id)
                                        ->where('status', '1')
                                        ->get();
                                if (count($submenus) > 0) {
                                    echo '<span class="list-group-item active">' . $menu_part . ' Items</span>';
                                }
                                foreach ($submenus as $submenu) {
                                    ?>
                                    <a href="{{URL('/'.$submenu->submenu_url)}}" class="list-group-item <?php
                                    if ($submenu->submenu_url == $geturl) {
                                        echo "active";
                                    }
                                    ?>"><i class="{{$submenu->submenu_icon}}"></i>  &nbsp; {{$submenu->submenu_name}}
                                           <?php
                                           if ($submenu->submenu_url == $geturl) {
                                               ?>
                                            <span class = "glyphicon glyphicon-edit pull-right"></span>
                                            <?php
                                        } else {
                                            ?>
                                            <span class = "glyphicon glyphicon-unchecked pull-right"></span>
                                            <?php
                                        }
                                        ?>

                                    </a>
                                    <?php
                                }
                                ?>


                            </div>
                        </div>
                        <?php
                  
            $segment_1 = Request::segment(1);
            if($segment_1 != 'finish'){
                        ?>
                        <div class="" style="background-color: azure">
                            <div class="ulockd-all-service">
                                <div class="list-group">
                                    <span class="list-group-item active text-center">Tax Advice Hotline</span>
                                    <p class="text-center"><b>$30 for a 15 minute phone chat</b></p>
                                    <p class="text-center" >Do you have questions about your tax return?</p>
                                    <p class="text-center" >Get quick expert advice over the phone.</p>
                                    <button class="btn btn-success block btn-sm"><i class="fa fa-save">  </i>  Book Now</button><br/>


                                </div>
                            </div>
                        </div>
            <?php } ?>
                    </div>
                </div>

                @yield("content")

                <!-- Our Footer -->
                <section class="ulockd-footer ulockd-pdng0">

                    <div class="ulockd-copy-right">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-4" style="border: 1px solid white">
                                        <p class="color-white">Phone Support:</p>
                                        <span style="color:white">09666-910441</span>
                                    </div>
                                    <div class="row" style="color:white">
                                        <span style="color:white">Monday - Friday</span><br>
                                        <span style="color:white">9:00 AM - 5:00 PM AEST</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="color-white pull-right"> © Copyright 2007-2019</p><br/>
                                    <p class="color-white"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <a class="scrollToHome ulockd-bgthm" href="#"><i class="fa fa-home"></i></a>
            </div>
            <!-- Wrapper End -->
            <script type="text/javascript" src="{{asset('public/assets/js/jquery-ui.js')}}"></script>
            <script type="text/javascript" src="{{asset('public/assets/js/jquery.validate.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('public/assets/select2/js/select2.min.js')}}"></script>
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
            <script>
jQuery('.datepicker').datetimepicker({
    timepicker: false,
    format: 'd/m/Y',
    formatDate: 'd/m/Y',
});
            </script>
            <script>
                function isNumber(evt) {
                    evt = (evt) ? evt : window.event;
                    var charCode = (evt.which) ? evt.which : evt.keyCode;
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    }
                    return true;
                }
            </script>
    </body>
</html>