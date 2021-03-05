<template>
    <idx-front-layout>
        <idx-inner-banner>

            <idx-bread-crumb
                slot="breadcrumb"
                :items="breadcrumb"></idx-bread-crumb>

            <h2 slot="title">{{ page_title | titleCase}}</h2>
            <p slot="subtitle">{{service.description}}</p>
            
            <a 
                slot="link"
                class="axil-button btn-large btn-transparent bg-transparent wow slideFadeInUp mt--10" 
                data-wow-duration="1s" 
                data-wow-delay="1300ms" 
                href="#">
                    <span
                        class="button-text">Request for a quote</span>
                        <span class="button-icon"></span>
            </a>

            <div slot="thumbnail" v-if="!!_header_image">
                <img class="paralax-image" :src="_header_image.url" alt="Keystoke Images">
            </div>

        </idx-inner-banner>

        <idx-section x-class="axil-service-area bg-color-lightest">
            <div class="row">
                <div class="col-lg-12">
                    <idx-section-header>
                        <span slot="subtitle" class="sub-title extra08-color wow" data-splitting>SUB SERVICES</span>
                        <h2 class="title wow" data-splitting>Our {{page_title}} Services</h2>
                    </idx-section-header>
                </div>
            </div>

            <div class="row justify-content-center">
                    
                <idx-service-box 
                    v-for="(subservice, index) in subservices"
                    :key="index">
                    
                        <idx-service-box-icon
                            slot="icon"
                            bg-class=""
                            :src="subservice.images | getImageUrl('icon')"
                            :alt="service.title">
                        </idx-service-box-icon>

                        <idx-service-box-content
                            slot="content"
                            :title="subservice.title"
                            :url="`/services/${service.slug}/${subservice.slug}`">
                                {{ subservice.description }}
                        </idx-service-box-content>

                </idx-service-box>
                    
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
                                <span class="text-primary">Design</span> Projects
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
                                :x-class="p.class" :url="`/portfoio/${p.title}`">
                                <img slot="image" :src="p.images | getImageUrl('overview', '/images/portfolio/portfolio-03.jpg')" />
                                {{p.title}}
                                <span slot="category">{{p.categories}}</span>
                            </idx-portfolio-box>

                        </div>
                        <div class="view-all-portfolio-button mt--60 text-center">
                            <a class="axil-button btn-large btn-transparent btn-xxl" href="/portfolio"><span
                                    class="button-text">View More</span><span
                                    class="button-icon"></span></a>
                        </div>
                    </div>
                </div>
            </div>

        </idx-section>

        <!-- call-to-action section -->
        <call-to-action />

    </idx-front-layout>
</template>

<script>

import StringFilters from '@/plugin/util/filters';

import idxFrontLayout from '@/Layouts/FrontLayout';
import idxInnerBanner from '@/components/front/banner/InnerBanner';
import idxBreadCrumb from '@/components/front/BreadCrumb';
import idxSection from '@/components/front/section/Section';
import idxSectionHeader from '@/components/front/section/SectionTitle';

import idxServiceBox from '@/components/front/ServiceBox';
import idxServiceBoxIcon from '@/components/front/ServiceBoxIcon';
import idxServiceBoxContent from '@/components/front/ServiceBoxContent';

import idxPortfolioBox from '@/components/front/box/PortfolioBox';

// Shape
import idxShapeGroup from '@/components/front/shape/ShapeGroup';
import idxShape from '@/components/front/shape/Shape';

import CallToAction from '../components/CallToAction';

export default {
    props: {
        page_title: String,
        breadcrumb: Array,
        service: Object,
        subservices: Array,
        portfolios: Array
    },
    filters: StringFilters,
    components: {
        idxFrontLayout,
        idxInnerBanner,
        idxBreadCrumb,
        idxSection,
        idxSectionHeader,

        idxServiceBox,
        idxServiceBoxIcon,
        idxServiceBoxContent,
        idxPortfolioBox,

        idxShapeGroup,
        idxShape,

        CallToAction
    },
    computed: {
        _header_image(){
            return _.find(this.service.images, (elem) => elem.data.name === 'header')
        },
        _portfolios(){
            return this.portfolios;
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