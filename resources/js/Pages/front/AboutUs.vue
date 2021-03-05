<template>
    <idx-front-layout>
        <idx-inner-banner
            slot="banner">

            <idx-bread-crumb
                slot="breadcrumb"
                :items="breadcrumb"></idx-bread-crumb>

            <h3 slot="title">{{ banner.title | titleCase}}</h3>
            <p slot="subtitle"> {{banner.description}} </p>
            
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

            <div slot="thumbnail">
                <img class="paralax-image" src="/images/others/keystoke-image-1.png" alt="Keystoke Images">
            </div>

            <idx-shape-Group slot="shapeGroup">
                <idx-shape x-class="shape-1">
                    <i class="icon icon-shape-01"></i>
                </idx-shape>
                <idx-shape x-class="shape-2 customOne">
                    <i class="icon icon-shape-02"></i>
                </idx-shape>
                <idx-shape x-class="shape-3">
                    <i class="icon icon-shape-03"></i>
                </idx-shape>
            </idx-shape-Group>

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
                                            <a class="axil-button btn-large btn-transparent" href="team.html"><span
                                                    class="button-text">Our Portfolios</span><span
                                                    class="button-icon"></span></a>

                                            <a class="axil-button axil-link-button" href="#">Request For a Quote</a>
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
            <idx-section x-class="axil-testimonial-area bg-color-lightest">
                
                <div class="row">
                    <div class="col-lg-12">
                        <idx-section-title>
                            <span slot="subtitle" class="sub-title extra08-color wow" data-splitting>TESTIMONIALS</span>
                            <h2 class="title wow" data-splitting>What Our Clients say</h2>
                            <p class="subtitle-2 wow" data-splitting>You can also get the same result and satisfaction.</p>
                        </idx-section-title>
                        
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
                                <img slot="image" :src="r.image" alt="Client Name">
                                <h4 slot="name" class="title">{{r.name}}</h4>
                                <span slot="designation">{{r.designation}}</span>

                                <p class="subtitle-3">{{r.review}}</p>
                                <a class="axil-link-button" :href="r.project_link">Read Project Case Study</a>
                            </idx-review>

                        </div>
                        <!-- End Single Testimonial -->

                    </div>
                </div>
                
            </idx-section>

            <!-- Call To Action -->
            <idx-section x-class="axil-call-to-action-area shape-position theme-gradient">
                <div class="row">
                    <div class="col-lg-12">
                        <idx-call-to-action x-class="text-center">
                            <span slot="subtitle" class="sub-title extra04-color wow" data-splitting>Let's work together</span>
                            <h2 class="title wow" data-splitting>Want to take your business to the next level or bring your idea/vision to life.</h2>
                            <a slot="button" class="axil-button btn-large btn-transparent" href="#">
                                <span class="button-text">Let's Get it Started</span>
                                <span class="button-icon"></span>
                            </a>
                            <div slot="buttomText" class="callto-action">
                                <span class="text wow" data-splitting>Or call us now</span>
                                <span class="wow" data-splitting><i class="fal fa-phone-alt"></i> <a href="#">(234) 806 048 5046</a></span>
                            </div>
                        </idx-call-to-action>
                    </div>
                </div>

                <idx-shape-group slot="shapeGroup">
                    <idx-shape x-class="shape-01">
                        <i class="icon icon-shape-14"></i>
                    </idx-shape>
                    <idx-shape x-class="shape-02">
                        <i class="icon icon-shape-09"></i>
                    </idx-shape>
                    <idx-shape x-class="shape-03">
                        <i class="icon icon-shape-10"></i>
                    </idx-shape>
                    <idx-shape x-class="shape-04">
                        <i class="icon icon-shape-11"></i>
                    </idx-shape>
                </idx-shape-group>
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

import idxServiceBox from '@/components/front/ServiceBox';
import idxServiceBoxIcon from '@/components/front/ServiceBoxIcon';
import idxServiceBoxContent from '@/components/front/ServiceBoxContent';

import idxPortfolioBox from '@/components/front/box/PortfolioBox';

import idxReview from '@/components/front/box/ReviewBox';

// Shape
import idxShapeGroup from '@/components/front/shape/ShapeGroup';
import idxShape from '@/components/front/shape/Shape';

import idxCallToAction from '@/components/front/CallToAction';

export default {
    props: ['page_title', 'breadcrumb'],
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

    data() {
        return {
            banner: {
                title: "Bring your tech-idea to life",
                description: "We do all the hard work to convert our clients vision/idea into astonishing software that has a great impact on their business/organisation."
            },
            reviews: [
                {
                    name: 'Martha Maldonado',
                    designation: 'Executive Chairman @ Google',
                    image: '/images/testimonial/client-01.jpg',
                    review: 'Donec metus lorem, vulputate at sapien sit amet, auctor iaculis lorem. In vel hendrerit nisi. Vestibulum eget risus velit.',
                    project_link: '/project/project_title'
                },
                {
                    name: 'Ajibola Salami',
                    designation: 'CEO @ IDESIGNUX',
                    image: '/images/testimonial/client-01.jpg',
                    review: 'Donec metus lorem, vulputate at sapien sit amet, auctor iaculis lorem. In vel hendrerit nisi. Vestibulum eget risus velit.',
                    project_link: '/project/project_title'
                },
                {
                    name: 'Elon Musk',
                    designation: 'CEO @ SpaceX',
                    image: '/images/testimonial/client-01.jpg',
                    review: 'Donec metus lorem, vulputate at sapien sit amet, auctor iaculis lorem. In vel hendrerit nisi. Vestibulum eget risus velit.',
                    project_link: '/project/project_title'
                },
            ],
        }
    }
    
}
</script>