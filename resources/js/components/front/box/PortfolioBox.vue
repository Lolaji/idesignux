<template>
    <div 
        class="portfolio portfolio_style--1 axil-control active portfolio-33-33" 
        :class="xClass"
        :url="url">
        <div class="inner move-up wow">
            <div class="thumb wow paralax-image">
                <a :href="url">
                    <slot name="image" />
                </a>
            </div>
            <div class="port-overlay-info">
                <div class="hover-action">
                    <h4 class="title">
                        <a :href="url"><slot /></a>
                    </h4>
                    <span class="category"><slot name="category" /></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        xClass: {
            type: [String, Array, Object]
        }, 
        url: {
            type: String,
            required: true
        }
    }
}
</script>