<template>
    <front-layout>

        <idx-main-content>
            <idx-slider-main>
                <idx-slide></idx-slide>
            </idx-slider-main>

            <!-- Start Service Area -->
            <idx-section x-class="axil-service-area bg-color-white">
                <div class="row">
                    <div class="col-lg-12">
                        <idx-section-header x-class="text-center">
                            <span slot="subtitle" class="sub-title extra05-color wow" data-splitting>SERVICES</span>
                            <h2 class="title wow" data-splitting>
                                <span>Our Result Driven Services</span>
                            </h2>
                            <p slot="description" class="subtitle-2 wow" data-splitting>Get the best result from our services.</p>
                        </idx-section-header>
                    </div>
                </div>

                <div class="row justify-content-center">
                    
                    <idx-service-box 
                        v-for="(service, index) in services"
                        :key="index">
                        
                            <idx-service-box-icon
                                slot="icon"
                                :src="service.images | getImageUrl('icon')"
                                :alt="service.title">
                            </idx-service-box-icon>

                            <idx-service-box-content
                                slot="content"
                                :title="service.title"
                                :url="`/services/${service.slug}`">
                                    {{ service.description }}
                            </idx-service-box-content>

                    </idx-service-box>
                    
                </div>

            </idx-section>
            <!-- End Service Area -->

            <!-- Feature Projects -->
            <idx-feature v-if="_featured_portfolios.length > 0">
                <idx-feature-item 
                    v-for="(item, index) in _featured_portfolios"
                    :key="index">
                    
                    <img 
                        slot="image" 
                        class="image w-100" 
                        :src="item.featurable.images | getImageUrl('overview', '/images/featured/featured-image-01.jpg')" 
                        :alt="item.featurable.title">

                    <span slot="subTitle" class="sub-title extra04-color wow">CASE STUDY</span>
                    
                    <h2 slot="title" class="title wow">
                        <a :href="`/portfolio/${item.featurable.slug}`">
                            {{item.featurable.title}}
                        </a>
                    </h2>

                    
                    <p slot="description" class="subtitle-2 wow">{{ item.featurable.description }}</p>

                    <a slot="readMore" class="axil-button btn-large btn-transparent" :href="`/portfolio/${item.featurable.slug}`">
                        <span
                            class="button-text">Read Case Study</span>
                        <span class="button-icon"></span>
                    </a>

                    
                    <div
                        slot="counterUpItem"
                        v-for="(counter, c_index) in item.featurable.result.overview" 
                        :key="c_index"
                        class="single-counterup counterup-style-1">
                        <h3 class="count">{{counter.percentage}}</h3>
                        <p>{{counter.description}}</p>
                    </div>
                    
                </idx-feature-item>
            </idx-feature>

            <!-- Brief About -->
            <idx-section x-class="axil-about-us-area bg-color-white axil-shape-position">
                
                <div class="row">

                    <div class="col-lg-6 col-xl-5 col-md-12 col-12">
                        <div class="axil-about-inner">
                            <idx-section-header x-class="text-left">
                                <span slot="subtitle" class="sub-title extra08-color move-up wow">ABOUT US</span>
                                <h2 class="title move-up wow">Who we are</h2>
                                
                                <p class="subtitle-2 mb--50 mb_lg--20 mb_md--20 mb_sm--15 move-up wow">
                                We are a tight-knit group of creative thinkers who understand the importance of 
                                technology in business and how it can make life easier for your customers/users and you.</p>
                                <p class="subtitle-2 move-up wow">We bring your idea/vision to life.</p>

                            </idx-section-header>
                        </div>
                    </div>

                    <div class="col-lg-6 col-xl-6 offset-xl-1 col-md-12 col-12 mt_md--30 mt_sm--30">
                        <!-- <idx-contact-form /> -->
                            <div class="thumbnail">
                                <img src="/images/content/strategy-illustrator.jpg" class="img-fluid move-up wow" alt="idesignux tight-knit group">
                            </div>
                    </div>
                </div>

            </idx-section>

            <!-- Case Studies -->
            <idx-section x-class="axil-portfolio-area bg-color-lightest">

                <div class="container axil-masonary-wrapper">
                    <div class="row align-items-end">
                        <div class="col-lg-5 col-md-12">
                            <idx-section-header>
                                <span slot="subtitle" class="sub-title extra07-color wow" data-splitting>OUR PROJECTS</span>
                                <h3 class="title wow mb--0" data-splitting>Explore our recent projects</h3>
                            </idx-section-header>
                        </div>

                        <!-- <div class="col-lg-7 col-md-12 mt_md--20 mt_sm--20">
                            <div class="messonry-button text-left text-lg-right overflow-x-auto">
                                <button data-filter="*" class="is-checked"><span class="filter-text">All</span></button>
                                <button data-filter=".cat--1"><span class="filter-text">Design</span></button>
                                <button data-filter=".cat--2"><span class="filter-text">Development</span></button>
                                <button data-filter=".cat--3"><span class="filter-text">API</span></button>
                            </div>
                        </div> -->

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mesonry-list grid-metro3 mt--20">

                                <idx-portfolio-box 
                                    v-for="(p, index) in portfolios"
                                    :key="index"
                                    :url="`/portfolio/${p.slug}`">
                                        <img slot="image" :src="p.images | getImageUrl('overview')" />
                                        {{p.title}}
                                        <!-- <span slot="category">{{p.categories}}</span> -->
                                </idx-portfolio-box>

                            </div>
                            <div class="view-all-portfolio-button mt--60 text-center">
                                <a class="axil-button btn-large btn-transparent btn-xxl" href="/portfolio"><span
                                        class="button-text">Discover More</span><span
                                        class="button-icon"></span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </idx-section>

            <!-- Why Work With Us -->
            <idx-section x-class="pv-feature-area theme-gradient-4 position-relative" content-class="wrap">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <div class="pv-section-title">
                            <h2>Why Work With Us?</h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt_sm--20">
                        <div class="pv-subtitle-title">
                            <p>We do everything to meet your end goals.</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <idx-explain-box 
                        v-for="(w, index) in whyChooseUs"
                        :key="index">
                        <template #icon>
                            <img :src="w.image" 
                            :alt="w.title">
                        </template>
                        <template #title>{{w.title}}</template>
                        <p>{{w.description}}</p>
                    </idx-explain-box>
                </div>

                <idx-shape-group>
                    <idx-shape x-class="shape-1">
                        <img src="/images/preview/shape/shape-09.svg" alt="Shape Images">
                    </idx-shape>
                    <idx-shape x-class="shape-2">
                        <img src="/images/preview/shape/shape-10.svg" alt="Shape Images">
                    </idx-shape>
                </idx-shape-group>
            </idx-section>

            <!-- Clients Review -->
            <idx-section x-class="axil-testimonial-area bg-color-lightest">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <idx-section-header>
                                <span slot="subtitle" class="sub-title extra08-color wow" data-splitting>TESTIMONIALS</span>
                                <h2 class="title wow" data-splitting>What Our Clients say</h2>
                                <p class="subtitle-2 wow" data-splitting>You can also get the same result and satisfaction.</p>
                            </idx-section-header>
                            
                        </div>
                    </div>

                    <div class="testimonial-activation">
                        <div class="row axil-testimonial-single">

                            <!-- Start Single Testimonial -->
                            <div 
                                v-for="(r, index) in reviews"
                                :key="index"
                                class="col-lg-6 mt--60 mt_sm--30 mt_md--30">

                                <idx-review>
                                    <img slot="image" src="/images/testimonial/client-01.jpg" :alt="r.firstname+' '+r.lastname">
                                    <h4 slot="name" class="title">{{r.firstname+" "+r.lastname}}</h4>
                                    <span slot="designation">{{r.designation}}</span>

                                    <p class="subtitle-3">{{r.body}}</p>
                                    <!-- <a class="axil-link-button" :href="r.project_link">Read Project Case Study</a> -->
                                </idx-review>

                            </div>
                            <!-- End Single Testimonial -->

                        </div>
                    </div>
                
            </idx-section>

            <call-to-action />

        </idx-main-content>
                

    </front-layout>
</template>

<script>
import filters from '@/plugin/util/filters';

import FrontLayout from '@/Layouts/FrontLayout';
import idxMainContent from '@/components/front/MainContent';
import idxSliderMain from '@/components/front/banner/slider/Main';
import idxSlide from '@/components/front/banner/slider/Slide';
import idxSection from '@/components/front/section/Section';
import idxSectionHeader from '@/components/front/section/SectionTitle';

import idxServiceBox from '@/components/front/ServiceBox';
import idxServiceBoxIcon from '@/components/front/ServiceBoxIcon';
import idxServiceBoxContent from '@/components/front/ServiceBoxContent';

import idxPortfolioBox from '@/components/front/box/PortfolioBox';

import idxReview from '@/components/front/box/ReviewBox';

import idxFeature from '@/components/front/section/Feature';
import idxFeatureItem from '@/components/front/section/FeatureItem';

import idxContactForm from '@/components/front/ContactForm';

import idxExplainBox from '@/components/front/ExplainBox';

import CallToAction from './components/CallToAction';

import idxShapeGroup from '@/components/front/shape/ShapeGroup';
import idxShape from '@/components/front/shape/Shape';

export default {
    props: {
        page_title: String,
        services: Array,
        featured_portfolios: Array,
        portfolios: Array,
        reviews: Array,
        metadatas: {
            type: Array,
            default:() => []
        }
    },
    head(){
        return {
            title: this.page_title,
            meta: this.metadatas
        }
    },
    filters: filters,
    components:{
        FrontLayout,
        idxMainContent,
        idxSliderMain,
        idxSlide,
        idxSection,
        idxSectionHeader,

        idxServiceBox,
        idxServiceBoxIcon,
        idxServiceBoxContent,
        idxPortfolioBox,
        idxReview,

        idxExplainBox,
        idxFeature,
        idxFeatureItem,
        idxContactForm,

        CallToAction,

        idxShapeGroup,
        idxShape
    },
    computed: {
        _featured_portfolios(){
            return _.filter(this.featured_portfolios, ($elem) => {
                return !_.isNull($elem.featurable.settings) && $elem.featurable.settings.is_published;
            });
        },
    },
    data() {
        return {
            whyChooseUs: [
                {
                    title: 'Expectation',
                    image: '/images/preview/feature-icon-01.png',
                    description: 'We work hard to meet your expectations'
                },
                {
                    title: 'Trust',
                    image: '/images/preview/feature-icon-02.png',
                    description: 'We work hard to meet your expectations'
                },
                {
                    title: '100% Satisfaction Guaranteed',
                    image: '/images/preview/feature-icon-03.png',
                    description: 'We work hard to meet your expectations'
                },
                {
                    title: 'High Quality ',
                    image: '/images/preview/feature-icon-04.png',
                    description: 'We deliver highest quality product.'
                },
                {
                    title: 'Customer Safty',
                    image: '/images/preview/feature-icon-05.png',
                    description: 'We develop product that make your customs/users safe.'
                },

            ]
        }
    },
    // watch: {
    //     page_title: {
    //         handler(data, old) {
    //             document.title = data;
    //         },
    //         immediate: true
    //     }
    // },
    created(){
        this.$store.commit('service/SET', this.services);
    }

}
</script>