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

    <main>

        <!-- search-popup -->
        <div class="modal fade bs-example-modal-lg search-bg popup1" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content search-popup">
                    <div class="text-center">
                        <a href="{{ url('') }}/front_assets/#" class="close2" data-dismiss="modal" aria-label="Close">×
                            close</a>
                    </div>
                    <div class="row search-outer">
                        <div class="col-md-11"><input type="text" placeholder="Search for products..." /></div>
                        <div class="col-md-1 text-right"><a href="{{ url('') }}/front_assets/#"><i class="fa fa-search"
                                    aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /search-popup -->
        <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(img/bg/bdrc-bg.jpg);">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title">
                                <h2>Blog</h2>
                                <div class="breadcrumb-wrap">

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a
                                                    href="{{ url('') }}/front_assets/index.html">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
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
        <!-- inner-blog -->
        <section class="inner-blog pt-120 pb-105">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="bsingle__post mb-50">
                            <div class="bsingle__post-thumb">
                                <img src="{{ url('') }}/front_assets/img/blog/inner_b1.jpg" alt="">
                            </div>
                            <div class="bsingle__content">
                                <div class="date-home">
                                    24th March 2022
                                </div>
                                <div class="b-meta">
                                    <div class="meta-info">
                                        <ul>
                                            <li><span>By</span> Miranda H. </li>
                                        </ul>
                                    </div>
                                </div>
                                <h2><a href="{{ url('') }}/front_assets/blog-details.html">Lorem ipsum dolor sit amet,
                                        consectetur
                                        cing elit, sed do eiusmod tempor.</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse.</p>
                                <div class="blog__btn">
                                    <a href="{{ url('') }}/front_assets/#">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="bsingle__post mb-50">
                            <div class="bsingle__post-thumb video-p">
                                <img src="{{ url('') }}/front_assets/img/blog/inner_b2.jpg" alt="">
                                <a href="{{ url('') }}/front_assets/https://www.youtube.com/watch?v=gyGsPlt06bo"
                                    class="video-i popup-video"><i class="fas fa-play"></i></a>
                            </div>
                            <div class="bsingle__content">
                                <div class="date-home">
                                    24th March 2022
                                </div>
                                <div class="b-meta">
                                    <div class="meta-info">
                                        <ul>
                                            <li><span>By</span> Miranda H. </li>
                                        </ul>
                                    </div>
                                </div>
                                <h2><a href="{{ url('') }}/front_assets/blog-details.html">There are many variations
                                        passages of like consectetur lorem ipsum available.</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse.</p>
                                <div class="blog__btn">
                                    <a href="{{ url('') }}/front_assets/#">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="bsingle__post mb-50">
                            <div class="bsingle__post-thumb blog-active">
                                <div class="slide-post">
                                    <img src="{{ url('') }}/front_assets/img/blog/inner_b3.jpg" alt="">
                                </div>
                                <div class="slide-post">
                                    <img src="{{ url('') }}/front_assets/img/blog/inner_b2.jpg" alt="">
                                </div>
                                <div class="slide-post">
                                    <img src="{{ url('') }}/front_assets/img/blog/inner_b1.jpg" alt="">
                                </div>
                            </div>
                            <div class="bsingle__content">
                                <div class="date-home">
                                    24th March 2022
                                </div>
                                <div class="b-meta">
                                    <div class="meta-info">
                                        <ul>
                                            <li><span>By</span> Miranda H. </li>
                                        </ul>
                                    </div>
                                </div>
                                <h2><a href="{{ url('') }}/front_assets/blog-details.html">I must explain to you how
                                        all this mistaken idea of denouncing pleasure.</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure
                                    dolor in reprehenderit in voluptate velit esse.</p>
                                <div class="blog__btn">
                                    <a href="{{ url('') }}/front_assets/#">Read More</a>
                                </div>
                            </div>
                        </div>

                        <div class="pagination-wrap">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item"><a href="{{ url('') }}/front_assets/#"><i
                                                class="fas fa-angle-double-left"></i></a></li>
                                    <li class="page-item active"><a href="{{ url('') }}/front_assets/#">1</a></li>
                                    <li class="page-item"><a href="{{ url('') }}/front_assets/#">2</a></li>
                                    <li class="page-item"><a href="{{ url('') }}/front_assets/#">3</a></li>
                                    <li class="page-item"><a href="{{ url('') }}/front_assets/#">...</a></li>
                                    <li class="page-item"><a href="{{ url('') }}/front_assets/#">10</a></li>
                                    <li class="page-item"><a href="{{ url('') }}/front_assets/#"><i
                                                class="fas fa-angle-double-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <aside class="sidebar-widget">
                            <section id="search-3" class="widget widget_search">
                                <h2 class="widget-title">Search</h2>
                                <form role="search" method="get" class="search-form"
                                    action="http://wordpress.zcube.in/finco/">
                                    <label>
                                        <span class="screen-reader-text">Search for:</span>
                                        <input type="search" class="search-field" placeholder="Search &hellip;"
                                            value="" name="s" />
                                    </label>
                                    <input type="submit" class="search-submit" value="Search" />
                                </form>
                            </section>
                            <section id="custom_html-5" class="widget_text widget widget_custom_html">
                                <h2 class="widget-title">Follow Us</h2>
                                <div class="textwidget custom-html-widget">
                                    <div class="widget-social">
                                        <a href="{{ url('') }}/front_assets/#"><i class="fab fa-twitter"></i></a>
                                        <a href="{{ url('') }}/front_assets/#"><i class="fab fa-pinterest-p"></i></a>
                                        <a href="{{ url('') }}/front_assets/#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="{{ url('') }}/front_assets/#"><i class="fab fa-instagram"></i></a>
                                        <a href="{{ url('') }}/front_assets/#"><i class="fab fa-wordpress"></i></a>
                                    </div>
                                </div>
                            </section>
                            <section id="categories-1" class="widget widget_categories">
                                <h2 class="widget-title">Categories</h2>
                                <ul>
                                    <li class="cat-item cat-item-16"><a
                                            href="{{ url('') }}/front_assets/#">Branding</a> (4)</li>
                                    <li class="cat-item cat-item-23"><a
                                            href="{{ url('') }}/front_assets/#">Corporat</a> (3)</li>
                                    <li class="cat-item cat-item-18"><a
                                            href="{{ url('') }}/front_assets/#">Design</a> (3)</li>
                                    <li class="cat-item cat-item-22"><a
                                            href="{{ url('') }}/front_assets/#">Gallery</a> (3)</li>
                                </ul>
                            </section>
                            <section id="recent-posts-4" class="widget widget_recent_entries">
                                <h2 class="widget-title">Recent Posts</h2>
                                <ul>
                                    <li>
                                        <a href="{{ url('') }}/front_assets/#">User Experience Psychology And
                                            Performance Smshing</a>
                                        <span class="post-date">August 19, 2020</span>
                                    </li>
                                    <li>
                                        <a href="{{ url('') }}/front_assets/#">Monthly Web Development Up Cost Of
                                            JavaScript</a>
                                        <span class="post-date">August 19, 2020</span>
                                    </li>
                                    <li>
                                        <a href="{{ url('') }}/front_assets/#">There are many variation passages of
                                            like available.</a>
                                        <span class="post-date">August 19, 2020</span>
                                    </li>
                                </ul>
                            </section>
                            <section id="tag_cloud-1" class="widget widget_tag_cloud">
                                <h2 class="widget-title">Tag</h2>
                                <div class="tagcloud">
                                    <a href="{{ url('') }}/front_assets/#"
                                        class="tag-cloud-link tag-link-28 tag-link-position-1" style="font-size: 8pt;"
                                        aria-label="app (1 item)">app</a>
                                    <a href="{{ url('') }}/front_assets/#"
                                        class="tag-cloud-link tag-link-17 tag-link-position-2" style="font-size: 8pt;"
                                        aria-label="Branding (1 item)">Branding</a>
                                    <a href="{{ url('') }}/front_assets/#"
                                        class="tag-cloud-link tag-link-20 tag-link-position-3" style="font-size: 8pt;"
                                        aria-label="corporat (1 item)">corporat</a>
                                    <a href="{{ url('') }}/front_assets/#"
                                        class="tag-cloud-link tag-link-24 tag-link-position-4"
                                        style="font-size: 16.4pt;" aria-label="Design (2 items)">Design</a>
                                    <a href="{{ url('') }}/front_assets/#"
                                        class="tag-cloud-link tag-link-25 tag-link-position-5"
                                        style="font-size: 22pt;" aria-label="gallery (3 items)">gallery</a>
                                    <a href="{{ url('') }}/front_assets/#"
                                        class="tag-cloud-link tag-link-26 tag-link-position-6" style="font-size: 8pt;"
                                        aria-label="video (1 item)">video</a>
                                    <a href="{{ url('') }}/front_assets/#"
                                        class="tag-cloud-link tag-link-29 tag-link-position-7"
                                        style="font-size: 16.4pt;" aria-label="web design (2 items)">web design</a>
                                </div>
                            </section>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- inner-blog-end -->
        <!-- instagram-area -->
        <section class="instagram-area p-relative fix pb-120">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-sm-6">
                        <div class="instagram-box">
                            <img src="{{ url('') }}/front_assets/img/bg/ins-img-01.png" alt="img">
                            <div class="hover"><a href="{{ url('') }}/front_assets/#"><img
                                        src="{{ url('') }}/front_assets/img/icon/instagram-icon.png"
                                        alt="img"></a></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="instagram-box">
                            <img src="{{ url('') }}/front_assets/img/bg/ins-img-02.png" alt="img">
                            <div class="hover"><a href="{{ url('') }}/front_assets/#"><img
                                        src="{{ url('') }}/front_assets/img/icon/instagram-icon.png"
                                        alt="img"></a></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="instagram-box">
                            <img src="{{ url('') }}/front_assets/img/bg/ins-img-03.png" alt="img">
                            <div class="hover"><a href="{{ url('') }}/front_assets/#"><img
                                        src="{{ url('') }}/front_assets/img/icon/instagram-icon.png"
                                        alt="img"></a></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="instagram-box">
                            <img src="{{ url('') }}/front_assets/img/bg/ins-img-04.png" alt="img">
                            <div class="hover"><a href="{{ url('') }}/front_assets/#"><img
                                        src="{{ url('') }}/front_assets/img/icon/instagram-icon.png"
                                        alt="img"></a></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="instagram-box">
                            <img src="{{ url('') }}/front_assets/img/bg/ins-img-05.png" alt="img">
                            <div class="hover"><a href="{{ url('') }}/front_assets/#"><img
                                        src="{{ url('') }}/front_assets/img/icon/instagram-icon.png"
                                        alt="img"></a></div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="instagram-box">
                            <img src="{{ url('') }}/front_assets/img/bg/ins-img-06.png" alt="img">
                            <div class="hover"><a href="{{ url('') }}/front_assets/#"><img
                                        src="{{ url('') }}/front_assets/img/icon/instagram-icon.png"
                                        alt="img"></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- instagram-area-end -->
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
                        <form name="ajax-form" id="contact-form4" action="#" method="post"
                            class="contact-form newslater">
                            <div class="form-group">
                                <input class="form-control" id="email2" name="email" type="email"
                                    placeholder="Email Address..." value="" required="">
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
