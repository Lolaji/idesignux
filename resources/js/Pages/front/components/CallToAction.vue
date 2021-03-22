<template>
    <idx-section x-class="axil-call-to-action-area shape-position theme-gradient">
        <div class="row">
            <div class="col-lg-12">
                <idx-call-to-action x-class="text-center">
                    <span slot="subtitle" class="sub-title extra04-color wow" data-splitting>LET'S WORK TOGETHER</span>
                    <h2 class="title wow" data-splitting>{{text}}</h2>

                    <a slot="button" class="axil-button btn-large btn-transparent" href="/contact-us">
                        <span class="button-text">Let's Get it Started</span>
                        <span class="button-icon"></span>
                    </a>
                    <div slot="buttomText" class="callto-action">
                        <span class="text wow" data-splitting>Or whatsapp / call us now</span>
                        <span class="wow" data-splitting><i class="fal fa-phone-alt"></i> <a href="tel:+(234) 806 048 5046">+(234) 806 048 5046</a></span>
                    </div>
                </idx-call-to-action>
            </div>
        </div>

        <!-- <idx-shape-group slot="shapeGroup">
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
        </idx-shape-group> -->
    </idx-section>
</template>

<script>
import idxSection from '@/components/front/section/Section';
import idxCallToAction from '@/components/front/CallToAction';
export default {
    props: {
        text: {
            type: String,
            default: () => 'Want to take your business to the next level or bring your idea/vision to life.'
        }
    },
    components: {
        idxSection,
        idxCallToAction
    }
}
</script>