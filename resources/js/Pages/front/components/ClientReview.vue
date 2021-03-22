<template>
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
</template>

<script>
import idxSection from '@/components/front/section/Section';
import idxSectionHeader from '@/components/front/section/SectionTitle';
import idxReview from '@/components/front/box/ReviewBox';
export default {
    props: {
        reviews: {
            type: Array,
            required: true
        }
    },
    components: {
        idxSection,
        idxSectionHeader,
        idxReview
    }
}
</script>