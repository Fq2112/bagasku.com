@extends('layouts.mst')
@section('title', 'Beranda | '.env('APP_TITLE'))
@section('content')
    <section class="home-slider">
        <div id="slider">
            <!-- revolution slider begin -->
            <div class="fullwidthbanner-container">
                <div id="revolution-slider">

                    <ul>
                        <li class="slider-bg2" data-transition="fade" data-slotamount="7" data-masterspeed="500">
                            <!--  BACKGROUND IMAGE -->
                            <img src="images/slider/education-bg.jpg" alt="">

                            <div class="tp-caption sfr stt custom-size-6 white tp-resizeme zindex"
                                 data-x="center"
                                 data-hoffset="-15"
                                 data-y="150"
                                 data-speed="300"
                                 data-start="1000"
                                 data-easing="easeInOut">
                                Find Courses Online
                            </div>

                            <div class="tp-caption sfr stb text-center custom-size-8 white tp-resizeme zindex"
                                 data-x="center"
                                 data-hoffset="-15"
                                 data-y="230"
                                 data-speed="300"
                                 data-start="1800"
                                 data-easing="easeInOut">
                                <p>With over 10 years of experience helping businesses to find<br>
                                    comprehensive solutions.</p>
                            </div>

                        </li>

                        <li class="slider-bg2" data-transition="fade" data-slotamount="7" data-masterspeed="500">
                            <!--  BACKGROUND IMAGE -->
                            <img src="images/slider/education-bg-2.jpg" alt="">

                            <div class="tp-caption sfr stt custom-size-6 white tp-resizeme zindex"
                                 data-x="center"
                                 data-hoffset="-15"
                                 data-y="150"
                                 data-speed="300"
                                 data-start="1000"
                                 data-easing="easeInOut">
                                Find Courses Online
                            </div>

                            <div class="tp-caption sfr stb text-center custom-size-8 white tp-resizeme zindex"
                                 data-x="center"
                                 data-hoffset="-15"
                                 data-y="230"
                                 data-speed="300"
                                 data-start="1800"
                                 data-easing="easeInOut">
                                <p>With over 10 years of experience helping businesses to find<br>
                                    comprehensive solutions.</p>
                            </div>

                        </li>

                    </ul>
                </div>
            </div>
            <!-- revolution slider close -->
        </div>
    </section>

    <!-- Start: Course search -->
    <div class="course-search">
        <div class="search-center">
            <div class="search-category">
                <div class="input-group">
                    <input type="hidden" name="search_param" value="all" id="search_param">
                    <input type="text" class="form-control-2 padd-size size-2" name="x" placeholder="Keyword search">
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn-course dropdown-toggle left-space" data-toggle="dropdown">
                            <span id="search_concept">Category Course</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-Menu" role="menu">
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Android</a></li>
                            <li><a href="#">Bags</a></li>
                            <li><a href="#">Basketball</a></li>
                        </ul>
                    </div>
                    <div class="input-group-btn search-panel">
                        <button type="button" class="btn-course dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept">Your Region</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-Menu" role="menu">
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Android</a></li>
                            <li><a href="#">Bags</a></li>
                            <li><a href="#">Basketball</a></li>
                        </ul>
                    </div>
                    <span class="input-group-btn">
                                <button class="btn-course border-radius-2" type="button">Search</button>
                            </span>
                </div>
            </div>
        </div>
    </div>

    <!-- features-5 -->
    <section class="section-course">
        <div class="container">
            <div class="boxes-center">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box-content">
                            <h2><i class="fa fa-book"></i> Best Course Online</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor aliqua.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-content">
                            <h2><i class="fa fa-graduation-cap"></i> Best Industry Leader</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor aliqua.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-content">
                            <h2><i class="fa fa-youtube-play"></i> Best Book LiBrary</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Progress area -->
    <section class="padd-40">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="apps-video">
                        <img src="images/slider/slider-bg3.jpg" alt="">
                        <div class="apps-videolink color-1">
                            <a class="wmBox" href="#" data-popup="videos/deskwork.mp4">
                                <i class="fa fa-play-circle-o"></i>
                            </a>
                            <h2>Watch Video</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="education-txt-info">
                        <h2>Make Your Dream Education Site with Our LearnPro Template</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore atque officiis maxime
                            suscipit expedita obcaecati nulla in ducimus iure quos quam recusandae dolor quas et
                            perspiciatis voluptatum accusantium delectus nisi reprehenderit,</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore atque officiis maxime
                            suscipit expedita obcaecati nulla in ducimus iure quos quam recusandae dolor quas et
                            perspiciatis voluptatum accusantium delectus nisi reprehenderit,</p>
                        <div class="signature">
                            <img src="images/signature.png" alt="">
                        </div>
                        <a href="#" class="btn education-btn-2">Purchase Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our amazing works -->
    <section class="text-center our-works2 border-2 light padd-40">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-center">Our Courses</h2>
                </div>
            </div>
        </div>
        <div class="our-projects color-2">

            <ul id="filter" class="filter-projects none-style">
                <li><a href="#" class="current" data-filter="*" title="">All Courses</a></li>
                <li><a href="#" data-filter=".science" title="">Science</a></li>
                <li><a href="#" data-filter=".photograph" title="">Photograph</a></li>
                <li><a href="#" data-filter=".graphics" title="">Graphics Design</a></li>
                <li><a href="#" data-filter=".business" title="">Business</a></li>
                <li><a href="#" data-filter=".lawyer" title="">Lawyer</a></li>
            </ul>

            <div id="gallery" class="all-projects projects-4">

                <div class="item science">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="images/blog/education/1.jpg">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="images/faces/thumbs50x50/1.jpg">
                                <span>Mr.John Doe</span>
                                <p>Masters</p>
                            </div>
                            <div class="pull-right price">
                                <p>$150</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Financial Accounting</a></h3>
                            <p>Duis aute irure dolor in cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar"></i> 01 Oct, 2017</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-graduation-cap"></i> 07/14 Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item photograph">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="images/blog/education/2.jpg">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="images/faces/thumbs50x50/2.jpg">
                                <span>Mr.Joe Doe</span>
                                <p>Masters</p>
                            </div>
                            <div class="pull-right price">
                                <p>$350</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Graphic Designer</a></h3>
                            <p>Duis aute irure dolor in cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar"></i> 20 Sep, 2017</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-graduation-cap"></i> 17/30 Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item graphics">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="images/blog/education/3.jpg">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="images/faces/thumbs50x50/3.jpg">
                                <span>Mr.Jason john</span>
                                <p>Masters</p>
                            </div>
                            <div class="pull-right price">
                                <p>$250</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Design and Technology</a></h3>
                            <p>Duis aute irure dolor in cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar"></i> 12 Aug, 2017</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-graduation-cap"></i> 18/21 Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item business">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="images/blog/education/4.jpg">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="images/faces/thumbs50x50/4.jpg">
                                <span>Ms.Sarah Jonatan</span>
                                <p>Masters</p>
                            </div>
                            <div class="pull-right price">
                                <p>$500</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Business Teacher</a></h3>
                            <p>Duis aute irure dolor in cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar"></i> 14 Dec, 2017</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-graduation-cap"></i> 25/30 Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item lawyer">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="images/blog/education/5.jpg">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="images/faces/thumbs50x50/5.jpg">
                                <span>Mr.Tom Redder</span>
                                <p>Masters</p>
                            </div>
                            <div class="pull-right price">
                                <p>$180</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Lawyer Administration</a></h3>
                            <p>Duis aute irure dolor in cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar"></i> 10 Nov, 2017</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-graduation-cap"></i> 08/10 Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item business">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="images/blog/education/6.jpg">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="images/faces/thumbs50x50/6.jpg">
                                <span>Mr.John Wick</span>
                                <p>Masters</p>
                            </div>
                            <div class="pull-right price">
                                <p>$330</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Business Administration</a></h3>
                            <p>Duis aute irure dolor in cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar"></i> 30 Jul, 2017</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-graduation-cap"></i> 11/21 Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item photograph">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="images/blog/education/7.jpg">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="images/faces/thumbs50x50/1.jpg">
                                <span>Mr.Ka James</span>
                                <p>Masters</p>
                            </div>
                            <div class="pull-right price">
                                <p>$480</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Photo Designer</a></h3>
                            <p>Duis aute irure dolor in cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar"></i> 08 Jun, 2017</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-graduation-cap"></i> 11/14 Student</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item science">
                    <div class="our-courses">
                        <div class="img-wrapper">
                            <img src="images/blog/education/8.jpg">
                        </div>
                        <div class="course-info">
                            <div class="pull-left course-img">
                                <img src="images/faces/thumbs50x50/2.jpg">
                                <span>Mr.Doe Ivanna</span>
                                <p>Masters</p>
                            </div>
                            <div class="pull-right price">
                                <p>$750</p>
                            </div>
                        </div>
                        <div class="text-center middle-info">
                            <h3><a href="#">Chemical Engineering</a></h3>
                            <p>Duis aute irure dolor in cillum dolore eu fugiat nulla pariatur. </p>
                        </div>
                        <div class="date-info">
                            <div class="pull-left">
                                <p><i class="fa fa-calendar"></i> 30 Jan, 2017</p>
                            </div>
                            <div class="pull-right">
                                <p><i class="fa fa-graduation-cap"></i> 11/21 Student</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Education why choose us -->
    <section class="education-choose">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="images/blog/education/student-1.png" alt="">
                </div>
                <div class="col-md-7">
                    <div class="why-choose">
                        <div class="choose-info">
                            <h3>Why <strong class="strong-green">Choose</strong> Us?</h3>
                            <div class="col-md-6">
                                <div class="box-media">
                                    <div class="icon-img">
                                        <i class="fa fa-list-alt"></i>
                                    </div>
                                    <div class="txt-body">
                                        <h2>Popular Courses</h2>
                                        <p>Lorem ipsum dolor sit ametcon sectet uradipis icing elitCum sectet uradipis
                                            icing consec tetur</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-media">
                                    <div class="icon-img">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <div class="txt-body">
                                        <h2>Modern Book Library</h2>
                                        <p>Lorem ipsum dolor sit ametcon sectet uradipis icing elitCum consec uradipis
                                            icing consec tetur</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-media">
                                    <div class="icon-img">
                                        <i class="fa fa-diamond"></i>
                                    </div>
                                    <div class="txt-body">
                                        <h2>Qualified Teachers</h2>
                                        <p>Lorem ipsum dolor sit ametcon sectet uradipis icing elitCum consecn uradipis
                                            icing consec tetur</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-media">
                                    <div class="icon-img">
                                        <i class="fa fa-bell"></i>
                                    </div>
                                    <div class="txt-body">
                                        <h2>Update Notification</h2>
                                        <p>Lorem ipsum dolor sit ametcon sectet uradipis icing elitCum consec uradipis
                                            icing consec tetur</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-media">
                                    <div class="icon-img">
                                        <i class="fa fa-microphone"></i>
                                    </div>
                                    <div class="txt-body">
                                        <h2>Entertainment Facilities</h2>
                                        <p>Lorem ipsum dolor sit ametcon sectet uradipis icing elitCum consec uradipis
                                            icing consec tetur</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-media">
                                    <div class="icon-img">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <div class="txt-body">
                                        <h2>24/7 Online Support</h2>
                                        <p>Lorem ipsum dolor sit ametcon sectet uradipis icing elitCum consec uradipis
                                            icing consec tetur</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start: Wrapper video -->
    <section class="wrapper-education-video">
        <div class="container">
            <div class="row">
                <div class="video-info">
                    <h2>Let's Have a <strong>Campus</strong> Tour</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        dolore magna aliqua.</p>
                    <a href="#" class="wmBox" href="#" data-popup="videos/deskwork.mp4"><i class="fa fa-play"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section id="our-team" class="our-team border-2 color-1 color-2">
        <h2>Qualified <strong class="strong-green">Teachers</strong></h2>
        <div class="container">
            <div class="col-md-3 our-team-item">
                <img src="images/team/man-1.png" alt="">
                <div class="our-content">
                    <h3>john doe</h3>
                    <h5>CEO</h5>
                </div>
            </div>
            <div class="col-md-3 our-team-item">
                <img src="images/team/man-2.png" alt="">
                <div class="our-content">
                    <h3>jessica doe</h3>
                    <h5>Marketing</h5>
                </div>
            </div>
            <div class="col-md-3 our-team-item">
                <img src="images/team/man-3.png" alt="">
                <div class="our-content">
                    <h3>rick edvard doe</h3>
                    <h5>Developer</h5>
                </div>
            </div>
            <div class="col-md-3 our-team-item">
                <img src="images/team/man-4.png" alt="">
                <div class="our-content">
                    <h3>nilseon doe</h3>
                    <h5>Design</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- /Our Team -->

    <section class="clients-testimonials padding">
        <div class="container bot-40">
            <h2 class="text-heading border-3 text-center">What <strong class="strong-green">people</strong> say</h2>
            <h3 class="text-heading">Student and parents opinion</h3>
        </div>
        <div class="container">
            <div id="testimonials" class="testi-slider testi-dark">
                <div class="education-testimonials">
                    <div class="col-md-6 item">
                        <div class="education-content">
                            <div class="img-info">
                                <img src="images/faces/500/1.jpg">
                            </div>
                            <div class="txt-info">
                                <p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur, consectetur
                                    adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p>
                                <h3>Catherine Grace</h3>
                                <span>CEO apple</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 item">
                        <div class="education-content">
                            <div class="img-info">
                                <img src="images/faces/500/2.jpg">
                            </div>
                            <div class="txt-info">
                                <p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur, consectetur
                                    adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p>
                                <h3>Catherine Grace</h3>
                                <span>CEO apple</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="education-testimonials">
                    <div class="col-md-6 item">
                        <div class="education-content">
                            <div class="img-info">
                                <img src="images/faces/500/3.jpg">
                            </div>
                            <div class="txt-info">
                                <p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur, consectetur
                                    adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p>
                                <h3>Catherine Grace</h3>
                                <span>CEO apple</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 item">
                        <div class="education-content">
                            <div class="img-info">
                                <img src="images/faces/500/4.jpg">
                            </div>
                            <div class="txt-info">
                                <p>Denim you probably haven't heard of. Lorem ipsum dolor met consectetur, consectetur
                                    adipisicing elit, of them jean shorts sed magna aliqua. Lorem ipsum dolor met.</p>
                                <h3>Catherine Grace</h3>
                                <span>CEO apple</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Blog -->
    <section class="block-section-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-heading border-3 text-center">Latest <strong class="strong-green">News</strong></h2>
                    <p class="text-heading text-center bot-40">Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                        sed diam nonummy nibh euismod tincidunt consectetuer adipiscing elit, sed diam nonummy nibh
                        euismod tincidunt.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog education-blog">
                        <div class="image">
                            <img class="img-responsive" src="images/blog/education/5.jpg" alt="">
                        </div>
                        <div class="blog-content">
                            <div class="post-meta">
                                <span><i class="fa fa-user"></i> John Doe</span>
                                <span><i class="fa fa-calendar-o"></i> 28 November 2017</span>
                            </div>
                            <div class="post-text">
                                <h2><a href="">We Help Your Time Work For Your Company</a></h2>
                                <p>Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae
                                    quam</p>
                            </div>
                            <div class="text-left">
                                <a href="" class="btn education-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="blog education-blog">
                        <div class="image">
                            <img class="img-responsive" src="images/blog/education/6.jpg" alt="">
                        </div>
                        <div class="blog-content">
                            <div class="post-meta">
                                <span><i class="fa fa-user"></i> John Doe</span>
                                <span><i class="fa fa-calendar-o"></i> 28 November 2017</span>
                            </div>
                            <div class="post-text">
                                <h2><a href="">We Help Your Time Work For Your Company</a></h2>
                                <p>Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae
                                    quam</p>
                            </div>
                            <div class="text-left">
                                <a href="" class="btn education-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="blog education-blog">
                        <div class="image">
                            <img class="img-responsive" src="images/blog/education/7.jpg" alt="">
                        </div>
                        <div class="blog-content">
                            <div class="post-meta">
                                <span><i class="fa fa-user"></i> John Doe</span>
                                <span><i class="fa fa-calendar-o"></i> 28 November 2017</span>
                            </div>
                            <div class="post-text">
                                <h2><a href="">We Help Your Time Work For Your Company</a></h2>
                                <p>Curabitur libero. Donec facilisis velit eu est. Phasellus cons quat. Aenean vitae
                                    quam</p>
                            </div>
                            <div class="text-left">
                                <a href="" class="btn education-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog -->
    <!-- sub scribe start -->
    <section class="subscribe bg-green">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="subscribe-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="title-form">
                                    <h3 class="white">SUBSCRIBE TO NEWSLETTERS</h3>
                                    <p>And stay informed about our news and events</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="newsletter">
                                    <form action="#" class=" comment-form">
                                        <div class="input-form">
                                            <input type="text" class="form-control" id="name2"
                                                   placeholder="Your name...">
                                        </div>
                                        <div class="input-form">
                                            <input type="email" class="form-control" id="email2"
                                                   placeholder="Your email...">
                                        </div>
                                        <input type="submit" class="btn education-btn-2 color-1" value="Subscribe">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sub scribe end -->
@endsection
