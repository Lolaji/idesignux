<template>
    <idx-front-layout :hide-navigation="true" :hide-footer="true">
        <main class="page-wrapper">
            <!-- Axil Comming Soon Area  -->
            <div class="axil-comming-soon-area axil-comming-soon theme-gradient">
                <div class="wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-10 col-12">
                                <div class="content">
                                    <div class="logo pt--30">
                                        <a href="home-01.html">
                                            <idx-logo />
                                        </a>
                                    </div>
                                    <div class="inner">
                                        <h1 class="title mb--20">Maintenance On-Going</h1>
                                        <p class="subtitle-2 mb--40 mb_sm--20 mb_md--20">Please send us a message on how we can help you.</p>
                                        <span><i class="fal fa-phone"></i> Call us: <a href="tel:+(234) 806 048 5046">+(234) 806 048 5046</a></span> <br>
                                        <span><i class="fal fa-envelope"></i> Email: <a href="mailto:contact@idesignux.com">contact@idesignux.com</a></span> <br><br>

                                        <div class="d-md-block">
                                            <ul class="axil-social-icons d-flex liststyle align-items-center">
                                                <li><a href="https://facebook.com/idesignux" target="__blank"><i class="fab fa-facebook-f"></i></a></li>
                                                <!-- <li><a href="https://facebook.com/idesignux" target="__blank"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="https://facebook.com/idesignux" target="__blank"><i class="fab fa-pinterest-p"></i></a></li> -->
                                                <li><a href="https://www.linkedin.com/company/idesignux" target="__blank"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="https://api.whatsapp.com/send?phone=2348060485046&text=" target="__blank"><i class="fab fa-whatsapp"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-10 col-12 pt-3">
                                <idx-contact-form 
                                    title="Send Us A Message"
                                    btn-text="Send Message"
                                    loading-text="Sending Message..." />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="shape-wrapper">
                    <div class="shape shape-01">
                        <img src="assets/images/shape/404-01.svg" alt="Shape Images">
                    </div>
                    <div class="shape shape-02">
                        <img src="assets/images/shape/404-01.svg" alt="Shape Images">
                    </div>
                    <div class="shape shape-03">
                        <img src="assets/images/shape/404-02.svg" alt="Shape Images">
                    </div>
                    <div class="shape shape-04">
                        <img src="assets/images/shape/comming-01.svg" alt="Shape Images">
                    </div>
                    <div class="shape shape-05">
                        <img src="assets/images/shape/comming-soon.svg" alt="Shape Images">
                    </div>
                </div> -->
            </div>
            <!-- End Axil Comming Soon Area  -->
        </main>
    </idx-front-layout>
</template>

<script>
import idxFrontLayout from '@/Layouts/FrontLayout';
import idxMainContent from '@/components/front/MainContent';
import idxLogo from '@/components/front/Logo';
import idxContactForm from '@/components/front/ContactForm';

export default {
    props: {
        page_title: String, 
    },
    components: {
        idxFrontLayout,
        idxMainContent,
        idxLogo,
        idxContactForm,
    },
    head(){
        return {
            title: this.page_title,
        }
    },
}
</script>