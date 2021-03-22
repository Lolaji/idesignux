<template>
    <idx-front-layout>
        
        <idx-inner-banner
            slot="banner"
            :title="page_title">

                <idx-bread-crumb
                    slot="breadcrumb"
                    :items="breadcrumb"></idx-bread-crumb>

            </idx-inner-banner>

        <idx-main-content x-class="main-wrapper">

            <idx-section x-class="axil-contact-area axil-shape-position bg-color-white">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-xl-5 col-12">
                        <idx-contact-form></idx-contact-form>
                    </div>
                    <div class="col-lg-6 col-md-12 col-xl-6 offset-xl-1 col-12 mt_md--40 mt_sm--40">
                        <div class="axil-address-wrapper">
                            <!-- Start Single Address  -->
                            <div class="axil-address wow move-up">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Phone</h4>
                                        <p>Our customer care is open from Mon-Fri, 9:00 am to 6:00 pm</p>
                                        <p><a class="axil-link" href="tel:+(234) 806 048 5046">+(234) 806 048 5046</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Address  -->
                            <!-- Start Single Address  -->
                            <div class="axil-address wow move-up mt--60 mt_sm--30 mt_md--30">
                                <div class="inner">
                                    <div class="icon">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Email</h4>
                                        <p>Our support team will get back to you within 48h during the standard business hours.
                                        </p>
                                        <p><a class="axil-link" href="mailto:contact@idesignux.net">contact@idesignux.net</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Address  -->
                        </div>
                    </div>
                </div>

                <idx-shape-group slot="shapeGroup">
                    <idx-shape x-class="shape-01">
                        <i class="icon icon-contact-01"></i>
                    </idx-shape>
                    <idx-shape x-class="shape-02">
                        <i class="icon icon-contact-02"></i>
                    </idx-shape>
                    <idx-shape x-class="shape-03">
                        <i class="icon icon-contact-03"></i>
                    </idx-shape>
                </idx-shape-group>
            </idx-section>

        </idx-main-content>

    </idx-front-layout>
</template>

<script>

import idxFrontLayout from '@/Layouts/FrontLayout';
import idxMainContent from '@/components/front/MainContent';
import idxInnerBanner from '@/components/front/banner/InnerBannerSmall';
import idxBreadCrumb from '@/components/front/BreadCrumb';
import idxSection from '@/components/front/section/Section';
import idxSectionHeader from '@/components/front/section/SectionTitle';

import idxContactForm from '@/components/front/ContactForm';

import idxWorkProcess from '@/components/front/WorkProcess';
import idxPortfolioBox from '@/components/front/box/PortfolioBox';

// Shape
import idxShapeGroup from '@/components/front/shape/ShapeGroup';
import idxShape from '@/components/front/shape/Shape';

import idxCallToAction from '@/components/front/CallToAction';

export default {
    props: {
        page_title: String, 
        breadcrumb: Array
    },
    head(){
        return {
            title: this.page_title,
        }
    },
    components: {
        idxFrontLayout,
        idxMainContent,
        idxInnerBanner,
        idxBreadCrumb,
        idxSection,
        idxSectionHeader,
        
        idxContactForm,

        idxShapeGroup,
        idxShape,

        idxCallToAction
    },
    data(){
        return {}
    }
}
</script>