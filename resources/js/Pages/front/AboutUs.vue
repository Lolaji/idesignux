<template>
    <idx-front-layout>
        <idx-inner-banner
            slot="banner">

            <idx-bread-crumb
                slot="breadcrumb"
                :items="breadcrumb"></idx-bread-crumb>

            <h3 slot="title">We Create The Best Solution</h3>
            <p slot="subtitle">
                We do all the hard work to convert our clients vision/idea into an astonishing product that has a great 
                IMPACT on their business/organisation.</p>
            
            <a 
                slot="link"
                class="axil-button btn-large btn-transparent bg-transparent wow slideFadeInUp mt--10" 
                data-wow-duration="1s" 
                data-wow-delay="1300ms" 
                href="/contact-us">
                    <span
                        class="button-text">Let's Get It Started</span>
                        <span class="button-icon"></span>
            </a>

            <div slot="thumbnail">
                <img class="paralax-image" src="/images/others/keystoke-image-1.png" alt="Keystoke Images">
            </div>

        </idx-inner-banner>

        <idx-main-content>
            
            <idx-section x-class="axil-team-area shape-position bg-color-white">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <div class="thumbnail">
                            <div class="image">
                                <img src="/images/team/team-group.png" alt="Team Images">
                            </div>
                            <div class="total-team-button">
                                <a href="team.html"><span>20+</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-5 offset-xl-1 mt_md--40 mt_sm--40">
                        <div class="content">
                            <div class="inner">
                                <idx-section-title x-class="text-left">
                                    <span slot="subtitle" class="sub-title extra08-color wow" data-splitting>GIVING THE BEST</span>
                                    <h3 slot="title" class="title wow" data-splitting>We deliver high quality web and mobile applications, and revenue-generating SEO solutions.</h3>

                                    <p class="subtitle-2 pr--0 wow" data-splitting>IDesignUX has a tight-knit group of creative thinkers, who understand the importance of Technology, Design, Strategy, and Marketing for business success.</p>

                                    <div class="axil-button-group mt--40 wow slideFadeInUp" 
                                        data-wow-duration="1s" 
                                        data-wow-delay="1300ms">
                                            <a class="axil-button btn-large btn-transparent" href="/portfolio"><span
                                                    class="button-text">Our Portfolios</span><span
                                                    class="button-icon"></span></a>

                                            <a class="axil-button axil-link-button" href="/contact-us">Request For a Quote</a>
                                    </div>
                                </idx-section-title>
                                <div class="section-title text-left">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </idx-section>

            <!-- Our Core Value -->
            <idx-section x-class="bg-color-lighter">
                <div class="row">
                    <div class="col-lg-12">
                        <idx-section-title x-class="text-center">
                            <span slot="subtitle" class="sub-title extra08-color wow" data-splitting>VALUE</span>
                            <h2 class="title wow" data-splitting>Our Core Value</h2>
                            <p class="subtitle-2 wow" data-splitting>We live by our core value that inspires us to achieve more.</p>
                        </idx-section-title>

                        <idx-company-value></idx-company-value>
                    </div>
                </div>
            </idx-section>

            <!-- Clients Review -->
            <client-review :reviews="reviews" />

            <!-- Call To Action -->
            <call-to-action />

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

// Shape
import idxShapeGroup from '@/components/front/shape/ShapeGroup';
import idxShape from '@/components/front/shape/Shape';

import ClientReview from './components/ClientReview';
import CallToAction from './components/CallToAction';

export default {
    props: {
        page_title: String, 
        breadcrumb: Array,
        reviews: Array
    },
    head(){
        return {
            title: this.page_title,
        }
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

        idxShapeGroup,
        idxShape,

        ClientReview,
        CallToAction
    },
    
}
</script>