<template>
    <idx-front-layout>
        
        <idx-inner-banner>

            <idx-bread-crumb
                slot="breadcrumb"
                :items="breadcrumb"/>

            <h2 slot="title">{{ subservice.title}}</h2>
            <p slot="subtitle">{{subservice.description}}</p>
            
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

            <div slot="thumbnail" v-if="!!_header_image">
                <img class="paralax-image" :src="_header_image.url" :alt="subservice.title">
            </div>

        </idx-inner-banner>

        <idx-main-content>
            <idx-section x-class="axil-portfolio-details bg-color-white">
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-sm-12 col-12">
                        <div class="portfolio-wrapper">
                            <div class="section-title text-left pb--25" v-html="subservice.content">
                                <!-- <span class="sub-title extra04-color">Branding, Creative</span> -->
                                <!-- <h3 class="title"><span>{{page_title}} That Maximize Your Revenue</span></h3> -->
                                <!-- <p class="subtitle-2 mb--40">Donec metus lorem, vulputate at sapien sit amet, auctor iaculis lorem. In vel hendrerit nisi. Vestibulum eget risus velit. Aliquam tristique libero at dui sodales.
                                </p>
                                <p class="subtitle-2 mb--40">et placerat orci lobortis. Maecenas ipsum neque, elementum id dignissim et, imperdiet vitae mauris.
                                </p> -->
                                <!-- <p class="subtitle-2" v-html="subservice.content"></p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-6 col-sm-12 col-12 mt_md--40 mt_sm--40">
                        <div class="portfolio-inner-details">
                            <h3 class="title mb--20 md_md--10 md_sm--10">Our Deliverables</h3>
                            <p class="mb--35 md_md--10 md_sm--10 subtitle-2">Ut condimentum enim nec diam convallis mollis. Sed felis quam, semper dapibus purus sed, rhoncus ullamcorper lacus.
                            </p>
                            <!-- Start Accordion Area  -->
                            <div id="accordion" class="axil-accordion mt--15 mt_md--15 mt_sm--15">
                                <!-- Start Single Card  -->
                                <div
                                    v-for="(deliverable, index) in subservice.deliverables"
                                    :key="index" 
                                    class="card">
                                        <div class="card-header" :id="`headingOne${index}`">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" :data-target="`#collapseOne${index}`" aria-expanded="false" aria-controls="collapseOne"><i
                                                        class="fal fa-arrow-right"></i><span>{{deliverable.title}}</span>
                                                </button>
                                            </h5>
                                        </div>

                                        <div :id="`collapseOne${index}`" class="collapse" :aria-labelledby="`headingOne${index}`" data-parent="#accordion">
                                            <div class="card-body">{{deliverable.description}}
                                            </div>
                                        </div>
                                </div>
                                <!-- End Single Card  -->
                            </div>
                            <!-- End Accordion Area  -->
                        </div>
                    </div>
                </div>
            </idx-section>

            <idx-section x-class="axil-working-process-area theme-gradient-4" v-if="_processes.length > 0">
                <div class="row">
                    <div class="col-lg-12">
                        <idx-section-header x-class="text-center mb--100 mb_sm--40 mb_md--40">
                            <span slot="subtitle" class="sub-title extra08-color wow" data-splitting>PROCESS</span>
                            <h2 class="title wow" data-splitting>Our {{subservice.title}} Process</h2>
                            <p slot="description" class="subtitle-2 wow" data-splitting>Our comprehensive {{subservice.title.toLowerCase()}} strategy ensures
                                a perfectly crafted website for your business.</p>
                        </idx-section-header>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <idx-work-process 
                            v-for="(process, index) in _processes"
                            :key="index"
                            x-class="mb--100 mb_md--50 mb_sm--40">

                                <div v-if="((index+1)%2) !== 0" class="thumbnail">
                                    <div class="image paralax-image">
                                        <img src="/images/process/process-01.jpg" :alt="`${subservice.title} Process`">
                                    </div>
                                </div>

                                <div 
                                    class="content"
                                    :class="[((index+1)%2) === 0?'order-2 order-lg-1 text-left':'']">
                                    <div class="inner">
                                        <div class="section-title">
                                            <span class="process-step-number">{{index+1}}</span>
                                            <span class="sub-title extra04-color">our four step process</span>
                                            <h2 class="title">{{process.title}}</h2>
                                            <p class="subtitle-2">{{process.description}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="((index+1)%2) === 0" class="thumbnail order-1 order-lg-2">
                                    <div class="image paralax-image">
                                        <img src="/images/process/process-01.jpg" :alt="`${subservice.title} Process`">
                                    </div>
                                </div>

                        </idx-work-process>
                    </div>
                </div>
            </idx-section>

            <idx-section x-class="axil-portfolio-area bg-color-lightest" v-if="_portfolios.length > 0">

                <div class="container axil-masonary-wrapper">
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <idx-section-header x-class="text-center">
                                <span slot="subtitle" class="sub-title extra07-color wow" data-splitting>RELATED PROJECTS</span>
                                <h3 class="title wow mb--0" data-splitting>
                                    Our 
                                    <span class="text-primary">{{subservice.title}}</span> Projects
                                </h3>
                            </idx-section-header>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mesonry-list grid-metro3 mt--20">

                                <idx-portfolio-box 
                                    v-for="(p, index) in _portfolios"
                                    :key="index"
                                    :url="`/portfolio/${p.slug}`">
                                    <img slot="image" :src="p.images | getImageUrl('header', '/images/portfolio/portfolio-03.jpg')" />
                                    {{p.title}}
                                    <!-- <span slot="category">{{p.categories}}</span> -->
                                </idx-portfolio-box>

                            </div>
                            <div class="view-all-portfolio-button mt--60 text-center">
                                <a class="axil-button btn-large btn-transparent btn-xxl" href="#"><span
                                        class="button-text">Discover More Projects</span><span
                                        class="button-icon"></span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </idx-section>

            <!-- call-to-action section -->
            <call-to-action />


        </idx-main-content>

    </idx-front-layout>
</template>

<script>

import filters from '@/plugin/util/filters';

import idxFrontLayout from '@/Layouts/FrontLayout';
import idxMainContent from '@/components/front/MainContent';
import idxInnerBanner from '@/components/front/banner/InnerBanner';
import idxBreadCrumb from '@/components/front/BreadCrumb';
import idxSection from '@/components/front/section/Section';
import idxSectionHeader from '@/components/front/section/SectionTitle';

import idxWorkProcess from '@/components/front/WorkProcess';
import idxPortfolioBox from '@/components/front/box/PortfolioBox';

// Shape
import idxShapeGroup from '@/components/front/shape/ShapeGroup';
import idxShape from '@/components/front/shape/Shape';

import CallToAction from '../components/CallToAction';

export default {
    props: {
        page_title: String, 
        breadcrumb: Array,
        subservice: Object,
        portfolios: Array,
        processes: Array,
        metadatas: Array
    },
    head(){
        return {
            title: this.page_title,
            meta: this.metadatas
        }
    },
    filters: filters,
    components: {
        idxFrontLayout,
        idxMainContent,
        idxInnerBanner,
        idxBreadCrumb,
        idxSection,
        idxSectionHeader,

        idxWorkProcess,
        idxPortfolioBox,

        idxShapeGroup,
        idxShape,

        CallToAction
    },
    computed: {
        _portfolios(){
            return this.portfolios;
        },
        _processes(){
            return this.processes;
        },
        _header_image(){
            return _.find(this.subservice.images, (elem) => {
                if (!_.isNull(elem.data))
                    return elem.data.name === 'header'

                return null;
            });
        }
    },
    data(){
        return{
            // portfolios: [
            //     {
            //         title: 'Vunyx Studio',
            //         image: '/images/portfolio/portfolio-03.jpg',
            //         categories: 'ios, Design',
            //         class: 'cat--2 cat--3'
            //     },
            //     {
            //         title: 'Creative Agency',
            //         image: '/images/portfolio/portfolio-01.jpg',
            //         categories: 'ios, Design',
            //         class: 'cat--1 cat--2'
            //     },
            //     {
            //         title: 'Rent Bike',
            //         image: '/images/portfolio/portfolio-02.jpg',
            //         categories: 'Branding',
            //         class: 'cat--2'
            //     },
            //     {
            //         title: 'All Volees',
            //         image: '/images/portfolio/portfolio-03.jpg',
            //         categories: 'Web Application',
            //         class: 'cat--2 cat--3'
            //     },
            //     {
            //         title: 'Larq',
            //         image: '/images/portfolio/portfolio-04.jpg',
            //         categories: 'Branding, Design',
            //         class: 'cat--1 cat--2'
            //     },
            //     {
            //         title: 'Rent Bike',
            //         image: '/images/portfolio/portfolio-05.jpg',
            //         categories: 'Branding',
            //         class: 'cat--2'
            //     },
            //     {
            //         title: 'Lucruitive',
            //         image: '/images/portfolio/portfolio-05.jpg',
            //         categories: 'ios, Design',
            //         class: 'cat--3 cat--2'
            //     },
            // ],
        }
    }
}
</script>