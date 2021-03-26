<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="icon" type="image/x-icon" href="/images/short-icon-blue.ico">
        <link rel="icon" type="image/png" sizes="32x32" href="/logo/short-icon-blue.png">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">

    </head>
    <body class="antialiased">

        <div class="main-content">
            
            <!-- Start Header -->
            <header class="ax-header haeder-default light-logo-version header-transparent axil-header-sticky">
                <div class="header-wrapper">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-8 header-left">
                                <div class="logo">
                                    <a href="/">
                                        <img 
                                            src="/images/logo/idesignux-logo-blue.png" 
                                            height="50" 
                                            width="150" 
                                            alt="IdesignUX logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-6 col-sm-6 col-4 header-right">
                                <div class="mainmenu-wrapepr">
                                    <!-- Start Mainmanu Nav -->
                                    <nav class="mainmenu-nav d-none d-lg-block">
                                        <ul class="mainmenu">
                                            <li><a href="/">Home</a></li>
                                            <li class="has-dropdown">
                                                <a :href="/services">Services</a>
                                                {{-- <ul class="axil-submenu">
                                                    <li 
                                                        v-for="(nav, index) in _service_navigation"
                                                        :key="index">
                                                            <a :href="`/services/${nav.slug}`">{{nav.title}}</a>
                                                        </li>
                                                </ul> --}}
                                            </li>
                                            <li><a href="/portfolio">Portfolio</a></li>
                                            <li><a href="/blog">Blog</a></li>
                                            <li><a href="/about-us">About Us</a></li>
                                            <li><a href="/contact-us">Contact</a></li>

                                        </ul>
                                    </nav>
                                    <!-- End Mainmanu Nav -->
                                    <div class="axil-header-extra d-flex align-items-center">

                                        <a class="axil-button btn-small btn-solid bg-transparent btn-primary-color d-none d-md-block ml--40 ml_sm--10" href="/contact-us">Request a Quote</a>

                                        <!-- Start Search Area -->
                                        <!-- <div class="ax-search-area ml--40 ml_sm--10">
                                            <a class="search-trigger" href="#"><i class="fas fa-search"></i></a>
                                        </div> -->
                                        <!-- End Search Area -->

                                        <!-- Panel Open Hamburger -->
                                        <!-- <div class="ax-hamburger ml--40 ml_sm--10 d-none d-lg-block">
                                            <a 
                                                class="axil-menuToggle ax-hamburger-trigger" 
                                                id="navPanelBtn" 
                                                data-toggle-pane="navPane"
                                                href="#">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </a>
                                        </div> -->
                                        <!--/ Panel Open Hamburger -->

                                        <!-- Start Menu Bar  -->
                                        <div class="ax-menubar popup-navigation-activation d-block d-lg-none ml_sm--20 ml_md--20">
                                            <div>
                                                <i></i>
                                            </div>
                                        </div>
                                        <!-- End Menu Bar  -->

                                        <!-- Start Search Area  -->
                                        {{-- <div class="axil-search-area">
                                            <form action="#" class="axil-searchbar w-100">
                                                <div class="search-field">
                                                    <input type="text" placeholder="Search Here...">
                                                    <button class="navbar-search-btn" type="button"><i
                                                class="fal fa-search"></i></button>
                                                </div>
                                                <a href="#" class="navbar-search-close"><i class="fal fa-times"></i></a>
                                            </form>
                                        </div> --}}
                                        <!-- End Search Area  -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Start Header -->

            <!-- Start Popup Mobile Menu -->
            <div class="popup-mobile-manu">
                <div class="inner">
                    <div class="mobileheader">
                        <div class="logo">
                            <a href="/">
                                <idx-logo></idx-logo>
                            </a>
                        </div>
                        <a class="close-menu" href="#"></a>
                    </div>
                    <div class="menu-item">
                        <ul class="mainmenu-item">
                            <li><a href="/">Home</a></li>
                            <li class="has-children">
                                <a :href="/services">Services</a>
                                {{-- <ul class="submenu">
                                    <li 
                                        v-for="(nav, index) in _service_navigation"
                                        :key="index"
                                        :title="nav.title">
                                            <a :href="`/services/${nav.slug}`">{{nav.title}}</a>
                                        </li>
                                </ul> --}}
                            </li>
                            <li><a href="/portfolio">Portfolio</a></li>
                            <li><a href="/blog">Blog</a></li>
                            <li><a href="/about-us">About Us</a></li>
                            <li><a href="/contact-us">Contact</a></li>
                        </ul>
                    </div>
                    
                    <!-- <a class="axil-button btn-small btn-solid btn-primary-color d-none d-md-block" href="/contact-us">Request a Quote</a> -->
                </div>
            </div>
            <!-- End Popup Mobile Menu -->

            <!-- Start Sidebar Area  -->

            <!-- Start Page Wrapper -->
            <main class="page-wrapper page-error">
                <!-- Start Page Error Area  -->
                <div class="axil-error-not-found fullscreen d-flex align-items-center theme-gradient-7 list-active">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="axil-error text-center">
                                    <div class="inner">

                                        @yield('message')

                                        <a class="axil-button btn-large btn-transparent" href="/"><span
                                            class="button-text">Go Back</span><span class="button-icon"></span></a>
                                        <img class="text-image" src="/images/others/@yield('code').svg" alt="@yield('code') Images">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shape-group">
                        <div class="shape shape-01">
                            <img src="/images/shape/404-01.svg" alt="Shape Images">
                        </div>
                        <div class="shape shape-02">
                            <img src="/images/shape/404-01.svg" alt="Shape Images">
                        </div>
                        <div class="shape shape-03">
                            <img src="/images/shape/404-02.svg" alt="Shape Images">
                        </div>
                        <div class="shape shape-04">
                            <img src="/images/shape/404-03.svg" alt="Shape Images">
                        </div>
                    </div>
                </div>
                <!-- End Page Error Area  -->
            </main>
        </div>

        <!-- Modernizer JS -->
        <script src="/static/modernizr.min.js"></script>
        <!-- jQuery JS -->
        <script src="/static/jquery.js"></script>
        <!-- Bootstrap JS -->
        <script src="/static/bootstrap.min.js"></script>

        <script type="text/javascript">
            (function (window, document, $, undefined) {
                'use strict';
                
                $('.mainmenu-item > li.has-children > a').on('click', function (e) {
                    e.preventDefault();
                    console.log('Clicked nav menu');
                    $(this).siblings('.submenu').slideToggle('400');
                    $(this).toggleClass('active').siblings('.submenu').toggleClass('is-visiable')
                })
            })(window, document, jQuery);
        </script>
    </body>
</html>
