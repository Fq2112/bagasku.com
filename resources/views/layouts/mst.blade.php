<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}"/>
    <meta name="keywords" content="HTML5 Template , Responsive , html5 , css3"/>
    <meta name="description" content="{{env('APP_TITLE')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap-3.3.7 fremwork css -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/glyphicons.css')}}"/>
    <!-- Core Style css -->
    <link rel="stylesheet" href="{{asset('css/colorbox.css')}}"/>
    <!-- Slider carousel css  -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
    <!-- Slider revolution css  -->
    <link rel="stylesheet" href="{{asset('vendor/rs-plugin/css/settings.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/rev-settings.css')}}"/>
    <!-- Fontawesome 5.10.1 -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/fontawesome/css/all.css')}}">
    <!-- Main style css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>

    <!-- ajax-loader -->
    <link rel="stylesheet" href="{{asset('css/ajax-loader.css')}}">
    <!-- select2 -->
    <link href="{{asset('vendor/select2/dist/css/select2.css')}}" rel="stylesheet"/>
    <!-- Loading.io -->
    <link href="{{asset('css/loading.css')}}" rel="stylesheet">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{asset('vendor/sweetalert/sweetalert2.css')}}">
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">
    <!-- Media queries -->
    <link rel="stylesheet" href="{{asset('css/media-query.css')}}">

    <style>
        .required {
            color: #122752;
        }

        .has-feedback .form-control-feedback {
            position: absolute;
            display: block;
            width: 34px;
            height: 34px;
            line-height: 34px;
            text-align: center;
        }

        .btn-primary {
            background-color: #122752;
            border-color: #112141;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary.focus,
        .btn-primary:active,
        .btn-primary.active,
        .open > .dropdown-toggle.btn-primary {
            background-color: #112141;
            border-color: #0d1223;
        }

        .btn-primary.disabled,
        .btn-primary[disabled],
        fieldset[disabled] .btn-primary,
        .btn-primary.disabled:hover,
        .btn-primary[disabled]:hover,
        fieldset[disabled] .btn-primary:hover,
        .btn-primary.disabled:focus,
        .btn-primary[disabled]:focus,
        fieldset[disabled] .btn-primary:focus,
        .btn-primary.disabled.focus,
        .btn-primary[disabled].focus,
        fieldset[disabled] .btn-primary.focus,
        .btn-primary.disabled:active,
        .btn-primary[disabled]:active,
        fieldset[disabled] .btn-primary:active,
        .btn-primary.disabled.active,
        .btn-primary[disabled].active,
        fieldset[disabled] .btn-primary.active {
            background-color: #122752;
            border-color: #112141;
        }

        .btn-primary .badge {
            color: #122752;
            background-color: #fff;
        }

        .swal-button--confirm, .swal-button--edit {
            background-color: #122752;
            border: 1px solid #122752;
            box-shadow: 0 2px 6px #1b3a87;
        }

        .swal-button--confirm:active, .swal-button--edit:active {
            background-color: #122752;
        }

        .load {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
        }

        .load hr {
            border: 0;
            margin: 0;
            width: 40%;
            height: 40%;
            position: absolute;
            border-radius: 50%;
            animation: spin 4s ease infinite;
        }

        .load :first-child {
            background: #3776ff;
            animation-delay: -3s;
        }

        .load :nth-child(2) {
            background: #2251b6;
            animation-delay: -2s;
        }

        .load :nth-child(3) {
            background: #1a3784;
            animation-delay: -1s;
        }

        .load :last-child {
            background: #122752;
        }

        @keyframes spin {
            0%,
            100% {
                transform: translate(0);
            }
            25% {
                transform: translate(160%);
            }
            50% {
                transform: translate(160%, 160%);
            }
            75% {
                transform: translate(0, 160%);
            }
        }
    </style>
    @stack('styles')
</head>
<body class="use-nicescroll">
<div class="images-preloader">
    <div class="load">
        <hr>
        <hr>
        <hr>
        <hr>
    </div>
</div>

<div class="wrapper">
    <div class="main-content scroll-none home-page">
        <header class="site-header header-education dropdown-green">
            <div class="sub-bar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="contacts">
                                <p><a href="tel:+6281252658218"><i class="fa fa-phone"></i><b>Telepon:</b> +62
                                        812-5265-8218</a></p>
                                <p><a href="mailto:{{env('MAIL_USERNAME')}}"><i
                                            class="fa fa-envelope"></i><b>Email:</b> {{env('MAIL_USERNAME')}}</a></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="social-media">
                                <a href="https://fb.com/ramadhanwahyu.gonzales" target="_blank">
                                    <i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/ramadhanwahyuu5" target="_blank">
                                    <i class="fab fa-twitter"></i></a>
                                <a href="https://github.com/Ramadhan1101" target="_blank">
                                    <i class="fab fa-github"></i></a>
                                <a href="https://instagram.com/Ramadhan_Wahyu_11" target="_blank">
                                    <i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-bar" id="main-bar">
                <div class="container">
                    <div class="logo">
                        <a href="{{route('beranda')}}">
                            <img width="200" src="{{asset('images/logo/logotype.png')}}" alt="Logo">
                        </a>
                    </div>
                    <button class="btn-toggle"><i class="fa fa-bars"></i></button>
                    <nav class="nav">
                        @include('layouts.partials._headerMenu')
                    </nav>
                </div>
            </div>
        </header>

        @yield('content')
    </div>

    <footer class="footer-color7">
        <div class="content-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget widget">
                            <h4>Tinggalkan Pesan</h4>
                            <form method="post" class="footer-form" action="{{route('kirim.kontak')}}">
                                @csrf
                                <input id="name" name="name" type="text" placeholder="Nama lengkap"
                                       value="{{Auth::check() ? Auth::user()->name : ''}}" required>
                                <input id="email" name="email" type="email" placeholder="Alamat email"
                                       value="{{Auth::check() ? Auth::user()->email : ''}}" required>
                                <input id="subject" name="subject" type="text" placeholder="Subyek" required>
                                <textarea id="message" name="message" placeholder="Tulis pesan Anda disini&hellip;"
                                          required></textarea>
                                <button type="submit" class="btn btn-construct">Kirim</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget widget">
                            <h4>Tautan Lain</h4>
                            <ul class="contact">
                                <li><a href="#"><i class="fa fa-caret-right"></i> Tentang BAGASKU</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i> Cara Kerja</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i> Ketentuan Layanan</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i> Kebijakan Privasi</a></li>
                                <li><a href="{{route('kontak')}}"><i class="fa fa-caret-right"></i> Kontak</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="footer-widget widget">
                            <h4>Tetap Terhubung</h4>
                            <ul class="contact">
                                <li>
                                    <i class="fa fa-map-marked-alt" style="color: #fff"></i>
                                    Mojokerto, Jawa Timur, Indonesia
                                </li>
                                <li>
                                    <a href="tel:+6281252658218"><i class="fa fa-phone"></i> +62 812-5265-8218</a>
                                </li>
                                <li>
                                    <a href="mailto:{{env('MAIL_USERNAME')}}"><i
                                            class="fa fa-envelope"></i> {{env('MAIL_USERNAME')}}</a>
                                </li>
                            </ul>
                            <div class="social-media">
                                <a href="https://fb.com/ramadhanwahyu.gonzales" target="_blank">
                                    <i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/ramadhanwahyuu5" target="_blank">
                                    <i class="fab fa-twitter"></i></a>
                                <a href="https://github.com/Ramadhan1101" target="_blank">
                                    <i class="fab fa-github"></i></a>
                                <a href="https://instagram.com/Ramadhan_Wahyu_11" target="_blank">
                                    <i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>© {{now()->format('Y').' '.env('APP_NAME')}}. All rights reserved | Designed & Developed by
                            <a href="http://rabbit-media.net" target="_blank">Rabbit Media</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<a href="#" onclick="scrollToTop()" class="to-top" title="Go to top">Top</a>
<div class="myProgress">
    <div class="bar"></div>
</div>

<!-- Jquery -->
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
<script type="text/javascript" src="{{asset('js/classie.js')}}"></script>
<!-- Core Style -->
<script type="text/javascript" src="{{asset('js/jquery.colorbox.js')}}"></script>
<!-- Carousel Slider  -->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<!-- Jquery Waypoints -->
<script type="text/javascript" src="{{asset('js/waypoints.min.js')}}"></script>
<!-- Jquery Counter -->
<script type="text/javascript" src="{{asset('js/visible.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/waypoints.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.easing.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.counterup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.isotope.min.js')}}"></script>
<!-- Jquery progress bar js-->
<script type="text/javascript" src="{{asset('js/pro-bars.js')}}"></script>
<!-- SLIDER REVOLUTION SCRIPTS  -->
<script type="text/javascript" src="{{asset('vendor/rs-plugin/js/jquery.themepunch.plugins.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
<!-- Template core js -->
<script type="text/javascript" src="{{asset('js/custom-index.js')}}"></script>
<script type="text/javascript" src="{{asset('js/wmbox.js')}}"></script>
<script type="text/javascript" src="{{asset('js/header-fixed.js')}}"></script>

<!-- select2 -->
<script src="{{asset('vendor/select2/dist/js/select2.full.min.js')}}"></script>
<!-- check-mobile -->
<script src="{{asset('vendor/checkMobileDevice.js')}}"></script>
<!-- Nicescroll -->
<script src="{{asset('vendor/nicescroll/jquery.nicescroll.js')}}"></script>
<!-- Sweetalert2 -->
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
@stack('scripts')
<script type="text/javascript">
    $(function () {
        window.mobilecheck() ? $("body").removeClass('use-nicescroll') : $("body").css("overflow", "hidden");

        AOS.init({
            duration: 800,
            easing: 'slide',
            once: false,
        });

        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    });

    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if ($(this).scrollTop() > 100) {
            $('.to-top').addClass('show-to-top');
        } else {
            $('.to-top').removeClass('show-to-top');
        }
    }

    function scrollToTop(callback) {
        if ($('html').scrollTop()) {
            $('html').animate({scrollTop: 0}, callback);
            return;
        }
        if ($('body').scrollTop()) {
            $('body').animate({scrollTop: 0}, callback);
            return;
        }
        callback();
    }

    function numberOnly(e, decimal) {
        var key;
        var keychar;
        if (window.event) {
            key = window.event.keyCode;
        } else if (e) {
            key = e.which;
        } else return true;
        keychar = String.fromCharCode(key);
        if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27) || (key == 188)) {
            return true;
        } else if ((("0123456789").indexOf(keychar) > -1)) {
            return true;
        } else if (decimal && (keychar == ".")) {
            return true;
        } else return false;
    }

    var title = document.getElementsByTagName("title")[0].innerHTML;
    (function titleScroller(text) {
        document.title = text;
        setTimeout(function () {
            titleScroller(text.substr(1) + text.substr(0, 1));
        }, 500);
    }(title + " ~ "));

    <!--Scroll Progress Bar-->
    function progress() {
        var windowScrollTop = $(window).scrollTop();
        var docHeight = $(document).height();
        var windowHeight = $(window).height();
        var progress = (windowScrollTop / (docHeight - windowHeight)) * 100;
        var $bgColor = progress > 99 ? '#122752' : '#122141';
        var $textColor = progress > 99 ? '#fff' : '#333';

        $('.myProgress .bar').width(progress + '%').css({backgroundColor: $bgColor});
        // $('h1').text(Math.round(progress) + '%').css({color: $textColor});
        $('.fill').height(progress + '%').css({backgroundColor: $bgColor});
    }

    progress();

    $(document).on('scroll', progress);

    window.onload = function () {
        $('.images-preloader').fadeOut();

        $(".use-nicescroll").niceScroll({
            cursorcolor: "rgb(18,39,82)",
            cursorwidth: "8px",
            background: "rgba(222, 222, 222, .75)",
            cursorborder: 'none',
            horizrailenabled: false,
            autohidemode: 'leave',
            zindex: 9999999,
        });

        var options = {
            whatsapp: "+628118981975",
            email: "{{env('MAIL_USERNAME')}}",
            call_to_action: "Hubungi Kami",
            button_color: "#122752",
            position: "left",
            order: "email,whatsapp",
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    };

    $(document).on('mouseover', '.use-nicescroll', function () {
        $(this).getNiceScroll().resize();
    });
</script>
@include('layouts.partials._alert')
@include('layouts.partials._confirm')
</body>
</html>
