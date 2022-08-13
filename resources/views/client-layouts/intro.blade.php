
@extends("client-layouts.clientMaster")
@section("content")

            <!-- Home Design -->
            <div class="ulockd-home-slider">
                <div class="container-fluid">
                    <div class="row">
                        <div class="pogoSlider" id="js-main-slider">
                            <div class="pogoSlider-slide bgc-overlay-black7" data-transition="verticalSlide" data-duration="1500" style="background-image:url('{{asset('public/assets/images/home/h1.jpg')}}');">
                     
                                <div class="lbox-caption">
                                    <div class="lbox-details">
                                        <h1 class="fz60 ff-serif">Welcome <span class="text-thm2 bgc-white">TaxAcc</span></h1>
                                        <h2 class="ulockd-mrgn120">Your Business & Tax Solution</h2>
                                        <button class="btn btn-lg ulockd-btn-thm2">Learn More</button>
                                        <button class="btn btn-lg ulockd-btn-white">Get a Quote</button>
                                    </div>
                                </div>
                            </div>
                            <div class="pogoSlider-slide bgc-overlay-black7" data-transition="barRevealDown" data-duration="2000" style="background-image:url('{{asset('public/assets/images/home/h2.jpg')}}');">
                                <div class="lbox-caption">
                                    <div class="lbox-details">
                                        <h1 class="fz45 ff-serif">Start Your Business Today.</h1>
                                        <h2 class="ulockd-mrgn120">Our services since 1995</h2>
                                        <button class="btn btn-lg ulockd-btn-white">Get a Quote</button>
                                        <button class="btn btn-lg ulockd-btn-thm2">Explore Service</button>
                                    </div>
                                </div>
                            </div>
                            <div class="pogoSlider-slide bgc-overlay-black7" data-transition="shrinkReveal" data-duration="2000" style="background-image:url('{{asset('public/assets/images/home/h3.jpg')}}');">
                                <div class="lbox-caption">
                                    <div class="lbox-details">
                                        <h1 class="fz48 ff-serif">We Provide The Best</h1>
                                        <h2 class="ulockd-mrgn120">Business & Tax Solution.</h2>
                                        <button class="btn btn-lg ulockd-btn-thm2">Explore Service</button>
                                        <button class="btn btn-lg ulockd-btn-white">Get a Quote</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .pogoSlider -->
                    </div>
                </div>
            </div>

            <!-- Our About -->
            <section class="ulockd-about ulockd-pad12650">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="about-box">
                                <h2 class="ulockd-mrgn120 title-bottom"><span class="text-thm2">TaxAcc</span> Story</h2>
                                <p class="lead">Your Business Solution Since 1995.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec aliquet turpis. Integer luctus magna mi, vel tempus felis tempor ornare.Integer faucibus hendrerit ante sed euismod.</p>
                                <p>Suspendisse potenti Praesent commodo pellentesque mi.</p>
                                
                                <img class="img-responsive h100" src="{{URL('/')}}/public/assets/images/resource/signeture.png" alt="signeture.png">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row ulockd-mrgn12-150">
                                <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4 ulockd-pad395">
                                    <div class="about-box2 text-center">
                                        <div class="ab-thumb">
                                            <img class="img-responsive img-whp" src="{{URL('/')}}/public/assets/images/about/s1.jpg" alt="s1.jpg">
                                            <div class="about-icon text-center"><i class="flaticon-businessmen-having-a-group-conference text-thm2"></i></div>
                                        </div>
                                        <div class="ab-details">
                                            <h4 class="fwb">ONLINE TAX PRO</h4>
                                            <p>Nullam eleifend lectus a tortor interdum. Proin consequat, at commodo.</p>
                                            <button class="btn btn-md ulockd-btn-thm2">Learn More </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4 ulockd-pad395">
                                    <div class="about-box2 text-center">
                                        <div class="ab-thumb">
                                            <img class="img-responsive img-whp" src="{{URL('/')}}/public/assets/images/about/s2.jpg" alt="s2.jpg">
                                            <div class="about-icon text-center"><i class="flaticon-meeting-1 text-thm2"></i></div>
                                        </div>
                                        <div class="ab-details">
                                            <h4 class="fwb">Tax Planning</h4>
                                            <p>Nullam eleifend lectus a tortor interdum. Proin consequat, at commodo.</p>
                                            <button class="btn btn-md ulockd-btn-thm2">Learn More </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4 ulockd-pad395">
                                    <div class="about-box2 text-center">
                                        <div class="ab-thumb">
                                            <img class="img-responsive img-whp" src="{{URL('/')}}/public/assets/images/about/s4.jpg" alt="s4.jpg">
                                            <div class="about-icon text-center"><i class="flaticon-tax text-thm2"></i></div>
                                        </div>
                                        <div class="ab-details">
                                            <h4 class="fwb">Tax Solution</h4>
                                            <p>Nullam eleifend lectus a tortor interdum. Proin consequat, at commodo.</p>
                                            <button class="btn btn-md ulockd-btn-thm2">Learn More </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
                </div>
            </section>

            <!-- Our Service -->
            <section id="service" class="our-service ulockd_bgp5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <div class="ulockd-main-title">
                                <h2>Our Services</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem labore voluptates consequuntur velit maiores fugiat eaque.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-4">
                            <div class="service_box">
                                <div class="icon text-thm2"><span class="flaticon-save-money-in-moneybox"></span></div>
                                <h3 class="title">IN OFFICE TAX RETURN</h3>
                                <div class="details">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti eaque excepturi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-4">
                            <div class="service_box">
                                <div class="icon text-thm2"><span class="flaticon-coins"></span></div>
                                <h3 class="title">ONLINE DIY TAX RETURN</h3>
                                <div class="details">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti eaque excepturi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxs-12 col-xs-6 col-sm-4 col-md-4">
                            <div class="service_box">
                                <div class="icon text-thm2"><span class="flaticon-people"></span></div>
                                <h3 class="title">ONLINE TAX PRO SOLUTION</h3>
                                <div class="details">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti eaque excepturi.</p>
                                </div>
                            </div>
                        </div>
               
                    </div>
                </div>
            </section>

            <!-- Our Team -->
            <section class="ulockd-team-two">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <h3 class="title-bottom ulockd-mrgn120 ulockd-mrgn635">About Our Info</h3>
                            <div class="row">
                                <div class="col-xxs-12 col-xs-6 col-sm-6">
                                    <img class="img-responsive img-whp" src="{{URL('/')}}/public/assets/images/about/3.jpg" alt="3.jpg">
                                    <h3>Our Vision</h3>
                                    <p>Consectetur adipisicing elit. Aliquam totam cupiditate iste doloribus, unde minima vero quidem. Porro, laborum obcaecati architecto ex nostrum doloremque magni. Culpa sunt, ex nostrum doloremque incidunt eos atque officia harum impedit tempora.</p>
                                </div>
                                <div class="col-xxs-12 col-xs-6 col-sm-6">
                                    <img class="img-responsive img-whp" src="{{URL('/')}}/public/assets/images/about/2.jpg" alt="2.jpg">
                                    <h3>Our Mision</h3>
                                    <ul class="list-style-square">
                                        <li class="fz16">Safety</li>
                                        <li class="fz16">Community</li>
                                        <li class="fz16">Sustainability</li>
                                    </ul>
                                    <p>Vero laboriosam aperiam quasi nihil, Culpa sunt repellendus molestiae eos atque officia quaerat quia officiis neque.</p>
                                </div>						
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3 class="title-bottom ulockd-mrgn120 ulockd-mrgn635">Have Any Questions?</h3>
                            <div class="about-box">
                                <div class="booking_form_style_home text-center">
                                    <!-- Booking Form Sart-->
                                    <form id="booking_form" class="text-center" name="booking_form" action="#" method="post" novalidate="novalidate">
                                        <div class="messages"></div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="lead">Request A Quote</p>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input id="form_name" name="form_name" class="form-control form_control" placeholder="Full Name" required="required" data-error="Name is required." type="text">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input id="form_email" name="form_email" class="form-control form_control required email" placeholder="Email" required="required" data-error="Email is required." type="email">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input id="form_phone" name="form_phone" class="form-control form_control required" placeholder="Phone" required="required" data-error="Phone Number is required." type="text">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="ulockd-select-style">
                                                        <select id="form_option" class="form-control form_control required booking_form_control" required="required" data-error="Option is required." name="form_option">
                                                            <option value="">Select Service</option>
                                                            <option value="f_planning">Financial Planing</option>
                                                            <option value="invstmnt_planning">Investment Planing</option>
                                                            <option value="wlth_mngmnt">Welth Management</option>
                                                            <option value="tx_slution">Tax Solution</option>
                                                            <option value="edu_loan">Education Loan</option>
                                                            <option value="buiness_loan">Business Loan</option>
                                                            <option value="sving_solution">Saving Solution</option>
                                                            <option value="fxd_deposit">Fixed Deposit</option>
                                                            <option value="discuss">Other Discuss</option>
                                                        </select>
                                                    </div>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea id="form_message" name="form_message" class="form-control ulockd-form-tb required" rows="5" placeholder="Your massage" required="required" data-error="Message is required."></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="form-group">
                                                    <input name="form-botcheck" class="form-control" type="hidden" value="">
                                                    <button type="submit" class="btn btn-lg ulockd-btn-thm2 btn-block">Get Quote</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>		
                        </div>
                    </div>
                </div>
            </section>

            <!-- Our Gallery -->
      

            <!-- Our Freequently Ask -->


            <!-- Our Team -->
     

            <!-- Our Testimonials -->
      

            <!-- Our Blog -->
            <section class="ulockd-blog ulockd_bgp1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <div class="ulockd-main-title">
                                <h2>Our Blog</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem labore voluptates consequuntur velit maiores fugiat eaque.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4">
                            <article class="blog_post2">
                                <img class="img-responsive img-whp" src="{{URL('/')}}/public/assets/images/blog/1.jpg" alt="1.jpg">
                                <div class="post_review">
                                    <div class="post_date ulockd-bgthm">12 <small>feb</small></div>
                                    <h4 class="post_title"><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h4>
                                    <ul class="post_comment list-inline">
                                        <li>By<a href="#"> <i class="fa fa-user"></i></a></li>
                                        <li>35<a href="#"> comment</a></li>
                                    </ul>
                                </div>
                            </article>
                        </div>
                        <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4">
                            <article class="blog_post2">
                                <img class="img-responsive img-whp" src="{{URL('/')}}/public/assets/images/blog/2.jpg" alt="2.jpg">
                                <div class="post_review">
                                    <div class="post_date ulockd-bgthm">12 <small>feb</small></div>
                                    <h4 class="post_title"><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h4>
                                    <ul class="post_comment list-inline">
                                        <li>By<a href="#"> <i class="fa fa-user"></i></a></li>
                                        <li>35<a href="#"> comment</a></li>
                                    </ul>
                                </div>
                            </article>
                        </div>
                        <div class="col-xxs-12 col-xs-6 col-sm-6 col-md-4">
                            <article class="blog_post2">
                                <img class="img-responsive img-whp" src="{{URL('/')}}/public/assets/images/blog/3.jpg" alt="3.jpg">
                                <div class="post_review">
                                    <div class="post_date ulockd-bgthm">12 <small>feb</small></div>
                                    <h4 class="post_title"><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></h4>
                                    <ul class="post_comment list-inline">
                                        <li>By<a href="#"> <i class="fa fa-user"></i></a></li>
                                        <li>35<a href="#"> comment</a></li>
                                    </ul>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
@stop