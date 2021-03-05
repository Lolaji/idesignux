<template>
    <idx-front-layout>
        <idx-inner-banner
            slot="banner">

            <idx-bread-crumb
                slot="breadcrumb"
                :items="breadcrumb"></idx-bread-crumb>

            <h3 slot="title">{{ banner.title }}</h3>
            <p slot="subtitle"> {{banner.description}} </p>
            
            <a 
                slot="link"
                class="axil-button btn-large btn-transparent bg-transparent wow slideFadeInUp mt--10" 
                data-wow-duration="1s" 
                data-wow-delay="1300ms" 
                href="/contact-us">
                    <span
                        class="button-text">Request for a quote</span>
                        <span class="button-icon"></span>
            </a>

            <div slot="thumbnail">
                <img class="paralax-image" src="/images/others/keystoke-image-1.png" alt="Keystoke Images">
            </div>

            <!-- <idx-shape-Group slot="shapeGroup">
                <idx-shape x-class="shape-1">
                    <i class="icon icon-shape-01"></i>
                </idx-shape>
                <idx-shape x-class="shape-2 customOne">
                    <i class="icon icon-shape-02"></i>
                </idx-shape>
                <idx-shape x-class="shape-3">
                    <i class="icon icon-shape-03"></i>
                </idx-shape>
            </idx-shape-Group> -->

        </idx-inner-banner>

        <idx-main-content>
            
            <idx-section x-class="axil-case-study-area bg-color-white">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title text-left">
                                <span class="sub-title extra10-color wow" data-splitting>our projects</span>
                                <h2 class="title wow"><span>Some of our finest work.</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="row row--45">
                        <!-- Start Single Case Study  -->
                        <div class="col-lg-12 col-12">
                            <div class="axil-case-study with-mokup-images theme-gradient-5 move-up wow">
                                <div class="content">
                                    <div class="inner">
                                        <span class="category wow" data-splitting>branding, design</span>
                                        <h4 class="wow title" data-splitting><a href="">Godaddy-
                                                Online platform and website design</a></h4>
                                    </div>
                                </div>
                                <div class="mockup">
                                    <img class="paralax-image w-100" src="/images/team/team-group.png" alt="Mokup Imags">
                                </div>
                            </div>
                        </div>
                        <!-- End Single Case Study  -->

                        <!-- Start Single Case Study  -->
                        <div 
                            v-for="portfolio in _portfolios"
                            :key="portfolio.id"
                            class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="axil-case-study move-up wow">
                                <div class="thumbnail">
                                    <a :href="`/portfolio/${portfolio.slug}`">
                                        <img class="w-100 paralax-image" :src="portfolio.images.length>0? portfolio.images[0].url : '/images/team/team-group.png'" alt="Axil Case Study Images">
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="inner">
                                        <span class="category wow" data-splitting>ios, design</span>
                                        <h4 class="wow title" data-splitting>
                                            <a :href="`/portfolio/${portfolio.slug}`">{{portfolio.title}}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Case Study  -->
                    </div>
            </idx-section>

        </idx-main-content>

    </idx-front-layout>
</template>

<script>

import StringFilters from '@/plugin/util/filters';

import idxFrontLayout from '@/Layouts/FrontLayout';
import idxMainContent from '@/components/front/MainContent';
import idxInnerBanner from '@/components/front/banner/InnerBanner';
import idxBreadCrumb from '@/components/front/BreadCrumb';
import idxSection from '@/components/front/section/Section';
import idxSectionTitle from '@/components/front/section/SectionTitle';

import idxCompanyValue from '@/components/front/CompanyValue';

import idxReview from '@/components/front/box/ReviewBox';

// Shape
import idxShapeGroup from '@/components/front/shape/ShapeGroup';
import idxShape from '@/components/front/shape/Shape';

import idxCallToAction from '@/components/front/CallToAction';

export default {
    props: {
        page_title: String, 
        breadcrumb: Array,
        portfolios: Array,
    },
    filters: StringFilters,
    components: {
        idxFrontLayout,
        idxMainContent,
        idxInnerBanner,
        idxBreadCrumb,
        idxSection,
        idxSectionTitle,
        idxCompanyValue,

        idxReview,

        idxShapeGroup,
        idxShape,

        idxCallToAction
    },
    computed: {
        _portfolios(){
            return this.portfolios;
        }
    },
    data() {
        return {
            banner: {
                title: "iDesignUX Portfolio",
                description: "When you partner with iDesignUX, we take care of the heavy lifting, so you can enjoy more website traffic, leads, and revenue."
            }
        }
    }
    
}
</script>