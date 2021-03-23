<template>
    <!-- Start Footer Area -->
        <footer class="axil-footer footer-default theme-gradient-2">
            <div class="bg_image--2">
                <!-- Start Social Icon -->
                <div class="ft-social-icon-wrapper ax-section-gapTop">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="ft-social-share d-flex justify-content-center liststyle flex-wrap">
                                    <li><a href="https://facebook.com/idesignux" target="__blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/idesignux" target="__blank"><i class="fab fa-linkedin-in"></i></a></li>
                                    <!-- <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fab fa-behance"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Social Icon -->
                <!-- Start Footer Top Area -->
                <div class="footer-top ax-section-gap">
                    <div class="container">
                        <div class="row">
                            <!-- Start Single Widget -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 border-right">
                                <div class="footer-widget-item">
                                    <h2>iDesignUX</h2>
                                    <p>iDesignUX has a tight-knit group of creative thinkers who understand 
                                        the importance of technology in business and how it can make 
                                        life easier for your customers/users and you.</p>
                                    <p>Our core value is having a significant <strong>IMPACT</strong> on your business and/or your tech vision/idea.</p>
                                </div>
                            </div>
                            <!-- End Single Widget -->

                            <!-- Start Single Widget -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 mt_mobile--30">
                                <div class="footer-widget-item">
                                    <h6 class="title">Services</h6>
                                    <div class="footer-menu-container">
                                        <ul class="ft-menu liststyle link-hover">
                                            <li
                                                v-for="(service, index) in _service_footer_link"
                                                :key="index"><a :href="`/srevices/${service.slug}`">{{service.title}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Widget -->

                            <!-- Start Single Widget -->
                            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 col-12 mt_lg--30 mt_md--30 mt_sm--30">
                                <div class="footer-widget-item">
                                    <h6 class="title">Resourses</h6>
                                    <div class="footer-menu-container">
                                        <ul class="ft-menu liststyle link-hover">
                                            <li><a href="/blog">Blog</a></li>
                                            <li><a href="/about-us">About Us</a></li>
                                            <li><a href="/portfolio">Portfolio</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Widget -->

                            <!-- Start Single Widget -->
                            <div class="col-xl-1 col-lg-6 col-md-6 col-sm-6 col-12 mt_lg--30 mt_md--30 mt_sm--30">
                                <div class="footer-widget-item widget-support">
                                    <h6 class="title">Support</h6>
                                    <div class="footer-menu-container">
                                        <ul class="ft-menu liststyle link-hover">
                                            <li><a href="/contact-us">Contact Us</a></li>
                                            <!-- <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                            <li><a href="#">Sitemap</a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                    </div>
                </div>
                <!-- End Footer Top Area -->
                <!-- Start Copyright -->
                <div class="copyright copyright-default">
                    <div class="container">
                        <div class="row justify-content-center row--0 ptb--20 axil-basic-thine-line">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="inner text-center">
                                    <p>© 2021 iDesignUX. All rights reserved.</p>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="quick-contact">
                                    <ul class="link-hover d-flex justify-content-center justify-content-md-end liststyle">
                                        <li><a data-hover="Privacy Policy" href="privacy-policy.html">Privacy Policy</a></li>
                                        <li><a href="#">Terms of Use</a></li>
                                    </ul>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- End Copyright -->
            </div>
        </footer>
        <!-- End Footer Area -->
</template>

<script>
import errorLog from '@/Mixins/errorLog';
export default {
    mixin: [errorLog],
    computed: {
        _service_footer_link(){
            return this.$store.getters['service/navigation'];
        }
    },
    data(){
        return {
            service_footer_link: []
        }
    },
    created(){
        // this.$store.dispatch('service/get', ).then(res => {
        //     console.log(res);
        // }).catch(err => {
        //     this.axiosErrorLog(err);
        // });
    }
}
</script>
