<!doctype html>
<html class="no-js" lang="zxx">
   <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Dahotel - Luxury Hotel HTML Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="{{ url('') }}/front_assets/img/favicon.ico">
        <!-- Place favicon.ico in the root directory -->

		<!-- CSS here -->
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/animate.min.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/magnific-popup.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/fontawesome-pro/css/all.min.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/dripicons.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/slick.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/meanmenu.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/default.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/style.css">
        <link rel="stylesheet" href="{{ url('') }}/front_assets/css/responsive.css">
    </head>
    <body>
        <!-- header -->
        @include ("frontend.layouts.header")
        <!-- header-end -->
        <!-- main-area -->
        <main>
            
            <!-- breadcrumb-area -->
            <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(img/bg/bdrc-bg.jpg)">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-lg-12">
                            <div class="breadcrumb-wrap text-center">
                                <div class="breadcrumb-title">
                                    <h2>Contact Us</h2>    
                                    <div class="breadcrumb-wrap">
                              
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ url('') }}/front_assets/index.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">About</li>
                                    </ol>
                                </nav>
                            </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->	
            <!-- contact-area -->
            <section id="contact" class="contact-area after-none contact-bg pt-120 pb-120 p-relative fix">
                <div class="container">
             
					<div class="row justify-content-center align-items-center">
						
                         <div class="col-lg-4 order-1">
                             
                            <div class="contact-info">
                                  <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                                        <div class="f-cta-icon">
                                            <i class="far fa-map"></i>
                                        </div>
                                        <h5>Office Address</h5>
                                        <p>380 St Kilda Road, Melbourne <br>
                                            VIC 3004, Australia</p>
                                    </div>
                                     <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                                        <div class="f-cta-icon">
                                            <i class="far fa-clock"></i>
                                        </div>
                                        <h5>Working Hours</h5>
                                        <p>Monday to Friday 09:00 to 18:30 <br> 
                                            Saturday 15:30</p>
                                    </div>
                                     <div class="single-cta wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                                        <div class="f-cta-icon">
                                            <i class="far fa-envelope-open"></i>
                                        </div>
                                        <h5>Message Us</h5>
                                        <p> <a href="{{ url('') }}/front_assets/#">support@example.com</a><br><a href="{{ url('') }}/front_assets/#">info@example.com</a></p>
                                    </div>
                                </div>							
                        </div>
                        <div class="col-lg-8 order-2">
                            <div class="contact-bg02">
                                <div class="section-title center-align mb-40 text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                                <h2>
                                  Get In Touch
                                </h2>
                                </div>                               
                                <form action="mail.php" method="post" class="contact-form mt-30">
                                    <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact-field p-relative c-name mb-20">                                    
                                            <input type="text" id="firstn" name="firstn" placeholder="First Name" required>
                                        </div>                               
                                    </div>

                                    <div class="col-lg-6 col-md-6">                               
                                        <div class="contact-field p-relative c-subject mb-20">                                   
                                            <input type="text" id="email" name="email" placeholder="Eamil" required>
                                        </div>
                                    </div>		
                                    <div class="col-lg-6 col-md-6">                               
                                        <div class="contact-field p-relative c-subject mb-20">                                   
                                            <input type="text" id="phone" name="phone" placeholder="Phone No." required>
                                        </div>
                                    </div>	
                                    <div class="col-lg-6 col-md-6">                               
                                        <div class="contact-field p-relative c-subject mb-20">                                   
                                            <input type="text" id="subject" name="subject" placeholder="Subject">
                                        </div>
                                    </div>	
                                    <div class="col-lg-12">
                                        <div class="contact-field p-relative c-message mb-30">                                  
                                            <textarea name="message" id="message" cols="30" rows="10" placeholder="Write comments"></textarea>
                                        </div>
                                        <div class="slider-btn">                                          
                                                    <button class="btn ss-btn" data-animation="fadeInRight" data-delay=".8s"><span>Submit Now</span></button>				
                                                </div>                             
                                    </div>
                                    </div>
                            </form>                            
                            </div>    
                        
						</div>
					</div>
                    
                </div>
               
            </section>
            <!-- contact-area-end -->
             <!-- newslater-area -->
            <section class="newslater-area">
                <div class="container p-relative">
                     <div class="newslater-text">Newsletter</div>
                   <div class="row align-items-center">                            
                       <div class="col-xl-7 col-lg-7 col-md-12">
                           <div class="section-title">
                                <h2>Subscribe here <span>for update</span></h2>
                               <p>Subscribe us to receive market updates.</p>
                            </div>
                        </div>
                       <div class="col-xl-5 col-lg-5 col-md-12">
                            <form name="ajax-form" id="contact-form4" action="#" method="post" class="contact-form newslater">
                               <div class="form-group">
                                  <input class="form-control" id="email2" name="email" type="email" placeholder="Email Address..." value="" required=""> 
                                  <button type="submit" class="btn btn-custom" id="send2">Subscribe</button>
                               </div>
                              
                            </form>
                        </div>
                        
                    </div>
                </div>
            </section>
            <!-- newslater-aread-end -->
        </main>
        <!-- main-area-end -->
    <!-- footer -->
        @include ("frontend.layouts.footer")
        <!-- footer-end -->
		<!-- JS here -->
        <script src="{{ url('') }}/front_assets/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/vendor/jquery.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/popper.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/bootstrap.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/slick.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/ajax-form.js"></script>
        <script src="{{ url('') }}/front_assets/js/paroller.js"></script>
        <script src="{{ url('') }}/front_assets/js/wow.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/js_isotope.pkgd.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/imagesloaded.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/parallax.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/jquery.waypoints.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/jquery.counterup.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/jquery.scrollUp.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/jquery.meanmenu.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/parallax-scroll.js"></script>
        <script src="{{ url('') }}/front_assets/js/jquery.magnific-popup.min.js"></script>
        <script src="{{ url('') }}/front_assets/js/element-in-view.js"></script>
        <script src="{{ url('') }}/front_assets/js/main.js"></script>
    </body>
</html>