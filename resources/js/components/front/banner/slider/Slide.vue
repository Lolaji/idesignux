<template>
    <!-- Start Single Slide -->
    <div class="axil-slide slide-style-default theme-gradient slider-fixed-height d-flex align-items-center paralax-area" :class="xClass">
        <div class="container">
            <div class="row align-items-center pt_md--60">
                <div class="col-lg-7 col-12 order-2 order-lg-1">
                    <div class="content pt_md--30 pt_sm--30">
                        <!-- <h4 class="axil-display-1 wow slideFadeInUp" data-wow-duration="1s" data-wow-delay="300ms">Web Design and Development Agency</h4> -->
                        <h2 class="axil-display-1 wow slideFadeInUp" data-wow-duration="1s" data-wow-delay="500ms">We innovate new technology for your business or niche.</h2>
                        <p class="subtitle-3 wow slideFadeInUp" data-wow-duration="1s" data-wow-delay="800ms">Power your business to a new height with our best <br> services and technology.</p>

                        <a class="axil-button btn-large btn-solid wow slideFadeInUp mr--5" data-wow-duration="1s" data-wow-delay="1300ms" href="/contact-us">
                            Get Started
                        </a>

                        <a class="axil-button btn-large btn-transparent bg-transparent wow slideFadeInUp" data-wow-duration="1s" data-wow-delay="1300ms" href="/portfolio">
                            Our Portfolio
                        </a>
                    </div>

                </div>
                <div class="col-lg-5 col-12 sm-display-none order-1 order-lg-2">
                    <div class="topskew-thumbnail-group text-left text-lg-right">
                        <div class="thumbnail paralax-image wow slideFadeInUp" data-wow-duration="1s" data-wow-delay="400ms">
                            <img 
                                src="/images/content/web-tech-illustration.jpg" 
                                height="500" 
                                width="500" 
                                alt="Keystoke Images"
                                class="wow slideFadeInUp"
                                data-wow-duration="1s" data-wow-delay="400ms">
                        </div>
                        <div class="image-group wow slideFadeInUp" data-wow-duration="1s" data-wow-delay="500ms">
                            <img 
                                class="paralax-image" 
                                src="/images/others/keystoke-image-4.svg" 
                                alt="Keystoke Images">
                        </div>

                        <slot name="shapeGroup" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Single Slide -->
</template>

<script>

export default {
    props:{
        xClass: {
            type: [String, Array, Object],
        }
    }
}
</script>