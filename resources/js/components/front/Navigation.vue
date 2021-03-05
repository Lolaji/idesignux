<template>
    <div>
        <!-- Start Header -->
        <header class="ax-header haeder-default light-logo-version header-transparent axil-header-sticky">
            <div class="header-wrapper">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-8 header-left">
                            <div class="logo">
                                <a href="/">
                                    <idx-logo></idx-logo>
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
                                            <a :href="`/services/${_first_navigation_slug}`">Services</a>
                                            <ul class="axil-submenu">
                                                <li 
                                                    v-for="(nav, index) in _service_navigation"
                                                    :key="index">
                                                        <a :href="`/services/${nav.slug}`">{{nav.title}}</a>
                                                    </li>
                                            </ul>
                                        </li>
                                        <li><a href="/blog">Blog</a></li>
                                        <li><a href="/portfolio">Portfolio</a></li>
                                        <li><a href="/about-us">About Us</a></li>
                                        <li><a href="/contact-us">Contact</a></li>

                                    </ul>
                                </nav>
                                <!-- End Mainmanu Nav -->
                                <div class="axil-header-extra d-flex align-items-center">

                                    <!-- Start Search Area -->
                                    <div class="ax-search-area ml--40 ml_sm--10">
                                        <a class="search-trigger" href="#"><i class="fas fa-search"></i></a>
                                    </div>
                                    <!-- End Search Area -->

                                    <!-- Start Hamburger -->
                                    <div class="ax-hamburger ml--40 ml_sm--10 d-none d-lg-block">
                                        <a 
                                            class="axil-menuToggle ax-hamburger-trigger" 
                                            id="navPanelBtn" 
                                            data-toggle-pane="navPane"
                                            href="#">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </a>
                                    </div>
                                    <!-- End Hamburger -->

                                    <!-- Start Menu Bar  -->
                                    <div class="ax-menubar popup-navigation-activation d-block d-lg-none ml_sm--20 ml_md--20">
                                        <div>
                                            <i></i>
                                        </div>
                                    </div>
                                    <!-- End Menu Bar  -->

                                    <!-- Start Search Area  -->
                                    <div class="axil-search-area">
                                        <form action="#" class="axil-searchbar w-100">
                                            <div class="search-field">
                                                <input type="text" placeholder="Search Here...">
                                                <button class="navbar-search-btn" type="button"><i
                                            class="fal fa-search"></i></button>
                                            </div>
                                            <a href="#" class="navbar-search-close"><i class="fal fa-times"></i></a>
                                        </form>
                                    </div>
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
                            <a :href="`/services/${_first_navigation_slug}`">Services</a>
                            <ul class="submenu">
                                <li 
                                    v-for="(nav, index) in _service_navigation"
                                    :key="index"
                                    :title="nav.title">
                                        <a :href="`/services/${nav.slug}`">{{nav.title}}</a>
                                    </li>
                            </ul>
                        </li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/portfolio">Portfolio</a></li>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/contact-us">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Popup Mobile Menu -->

        <!-- Start Sidebar Area  -->
        

        <idx-pane id="navPane" toggle-btn-id="navPanelBtn">
            
            <form slot="header" action="#" class="side-nav-search-form">
                <div class="form-group search-field">
                    <input type="text" class="search-field" name="search-field" placeholder="Search...">
                    <button class="side-nav-search-btn"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <div class="row ">
                <!-- Start Left Bar  -->
                <div class="col-lg-5 col-xl-6 col-12">
                    <ul class="main-navigation">
                        <li><a href="home-01.html">Home One</a></li>
                        <li><a href="home-02.html">Home Two</a></li>
                        <li><a href="home-03.html">Home Three</a></li>
                        <li><a href="home-04.html">Home Four</a></li>
                        <li><a href="home-05.html">Home Five</a></li>
                    </ul>
                </div>
                <!-- End Left Bar  -->

                <!-- Start Right Bar  -->
                <div class="col-lg-7 col-xl-6 col-12">
                    <div class="axil-contact-info-inner">

                        <!-- Start Single Address  -->
                        <div class="axil-contact-info">
                            <address class="address">
                                <span class="title">Contact Information</span>
                                <p>Theodore Lowe, Ap #867-859 <br> Sit Rd, Azusa New York</p>
                            </address>
                            <address class="address">
                                <span class="title">We're Available 24/ 7. Call Now.</span>
                                <p><a class="tel" href="tel:8884562790"><i class="fas fa-phone"></i>(888)
                                        456-2790</a></p>
                                <p><a class="tel" href="tel:12125553333"><i class="fas fa-fax"></i>(121)
                                        255-53333</a></p>
                            </address>
                        </div>
                        <!-- End Single Address  -->

                        <!-- Start Single Address  -->
                        <div class="axil-contact-info">
                            <h5 class="title">Find us here</h5>
                            <div class="contact-social-share d-flex align-items-center">
                                <ul class="social-share style-rounded">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>

                        </div>
                        <!-- End Single Address  -->
                    </div>
                </div>
                <!-- End Right Bar  -->
            </div>
        </idx-pane>
        <!-- End Sidebar Area  -->
    </div>
</template>

<script>
import IdxLogo from './Logo';
import idxPane from '@/components/front/elements/Pane';
export default {
    components:{
        IdxLogo,
        idxPane
    },
    computed: {
        _service_navigation ()
        {
            return this.$store.getters['service/navigation'];
        },
        _first_navigation_slug() {
            return !_.isEmpty(this._service_navigation)? this._service_navigation[0].slug : '';
        }
    },
    data(){
        return {
            
        }
    },
    methods:{
        mobileMenu() {
            $('.mainmenu-item > li.has-children > a').on('click', function (e) {
                e.preventDefault();
                $(this).siblings('.submenu').slideToggle('400');
                $(this).toggleClass('active').siblings('.submenu').toggleClass('is-visiable')
            })
        },
        stickyHeader(){
            $(window).scroll(function() {
                if ($(this).scrollTop() > 250) {
                    $('.axil-header-sticky').addClass('sticky')
                }else{
                    $('.axil-header-sticky').removeClass('sticky')
                }
            });
        },
    },
    mounted(){
        // this.mobileMenu();
        // this.stickyHeader();
    }
}
</script>