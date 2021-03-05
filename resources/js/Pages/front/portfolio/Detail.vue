<template>
    <idx-front-layout>
        <idx-inner-banner
            slot="banner">

            <idx-bread-crumb
                slot="breadcrumb"
                :items="breadcrumb"></idx-bread-crumb>

            <h3 slot="title">{{ portfolio.title }}</h3>

            <div slot="after-title" class="tech-stack my-2">
                <span 
                    class="badge font-weight-bolder text-uppercase wow slideInLeft letterspacing--2"
                    data-wow-duration="1s" 
                    data-wow-delay="500ms">Tech Stack: </span> <br>
                <span 
                    class="item badge badge-primary rounded-0 p-1 wow slideInLeft"
                    data-wow-duration="2s" 
                    data-wow-delay="600ms"> <i class="fab fa-html5"></i> HTML5</span>
                <span 
                    class="item badge badge-primary rounded-0 p-1 wow slideInLeft"
                    data-wow-duration="2s" 
                    data-wow-delay="600ms"> <i class="fab fa-css3"></i> CSS3</span>
                <span 
                    class="item badge badge-primary rounded-0 p-1 wow slideInLeft"
                    data-wow-duration="2s" 
                    data-wow-delay="600ms"> <i class="fab fa-php"></i> PHP</span>
            </div>

            <p slot="subtitle"> {{portfolio.description}} </p>

            <a 
                slot="link"
                class="axil-button btn-large btn-transparent bg-transparent wow slideFadeInUp mt--10" 
                data-wow-duration="1s" 
                data-wow-delay="1300ms" 
                href="#">
                    <span
                        class="button-text">Let's Get It Started</span>
                        <span class="button-icon"></span>
            </a>

            <div slot="thumbnail" v-if="!!_header_image">
                <img class="paralax-image" :src="_header_image.url" :alt="portfolio.title">
            </div>

        </idx-inner-banner>

        <idx-main-content>

            <idx-section x-class="axil-portfolio-details bg-color-white" v-if="!!portfolio.challenge.description && !!portfolio.challenge.highlight">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-sm-12 col-12">
                        <div class="portfolio-wrapper">
                            <div class="section-title text-left">
                                <h3 class="title"><span>Challenge</span></h3>
                                <div v-html="portfolio.challenge.description"></div>
                                <!-- <p class="subtitle-2 mb--30 move-up wow">Nulla et velit gravida, facilisis quam a,
                                        molestie ante.
                                        Mauris placerat suscipit dui, eget maximus tellus blandit a. Praesent non tellus
                                        sed
                                        ligula commodo blandit in et mauris. Quisque efficitur ipsum ut dolor molestie
                                        pellentesque.</p>
                                    <p class="subtitle-2 move-up wow">Nulla pharetra hendrerit mi quis dapibus. Quisque
                                        luctus, tortor a
                                        venenatis fermentum, est lacus feugiat nisl, id pharetra odio enim eget libero.
                                    </p> -->

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-6 col-sm-12 col-12 mt_md--40 mt_sm--40 py-4 bg-light">
                        <div class="portfolio-inner-details text-dark font--15 px-3" v-html="portfolio.challenge.highlight"></div>
                    </div>
                </div>
            </idx-section>

            <idx-section x-class="axil-project-solutions-area shape-group-position bg-dark" v-if="_gallery.length>0">
                <div class="row justify-content-center">
                        <div class="col-lg-10 text-center">
                            <div class="content">
                                <div class="col-md-12 mb--60" v-for="(image, index) in _gallery" :key="index">
                                    <h5 class="text-white">{{image.data.description}}</h5>
                                    <div class="thumbnail mt--60 move-up wow">
                                        <img class="w-100" :src="image.url" alt="Featured Images">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </idx-section>

            <idx-section x-class="axil-portfolio-details bg-color-white">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-sm-12 col-12">
                        <div class="portfolio-wrapper">
                            <div class="section-title text-left">
                                <!-- <span class="sub-title extra04-color">Branding, Creative</span> -->
                                <h3 class="title"><span>Solution</span></h3>
                                <div v-html="portfolio.solution.description"></div>
                                <!-- <p class="subtitle-2 mb--30 move-up wow">Nulla et velit gravida, facilisis quam a,
                                        molestie ante.
                                        Mauris placerat suscipit dui, eget maximus tellus blandit a. Praesent non tellus
                                        sed
                                        ligula commodo blandit in et mauris. Quisque efficitur ipsum ut dolor molestie
                                        pellentesque.</p>
                                    <p class="subtitle-2 move-up wow">Nulla pharetra hendrerit mi quis dapibus. Quisque
                                        luctus, tortor a
                                        venenatis fermentum, est lacus feugiat nisl, id pharetra odio enim eget libero.
                                    </p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-6 col-sm-12 col-12 mt_md--40 mt_sm--40 py-4 bg-dark">
                        <div class="section-highlight portfolio-inner-details text-white font--15 px-3" v-html="portfolio.solution.highlight"></div>
                    </div>
                </div>
            </idx-section>

            <!-- call-to-action section -->
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

import idxReview from '@/components/front/box/ReviewBox';

// Shape
import idxShapeGroup from '@/components/front/shape/ShapeGroup';
import idxShape from '@/components/front/shape/Shape';

import CallToAction from '../components/CallToAction';

export default {
    props: {
        page_title: String, 
        breadcrumb: Array,
        portfolio: Object,
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

        CallToAction
    },
    computed: {
        _header_image(){
            return _.find(this.portfolio.images, (elem) => elem.data.name === 'header');
        },
        _gallery(){
            return _.filter(this.portfolio.images, (elem) => elem.data.name === 'gallery');
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

<style lang="scss" scoped>
.tech-stack {
    .item {
        font-size: 12px;
    }
}
</style>