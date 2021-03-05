<template>
    <!-- Start Featured Area -->
    <div 
        class="axil-featured-area ax-section-gap bg-color-lightest">
        <div class="container axil-featured-activation axil-carousel" data-slick-options='{
                "spaceBetween": 0, 
                "slidesToShow": 1, 
                "slidesToScroll": 1, 
                "arrows": false, 
                "infinite": true,
                "centerMode":true,
                "dots": true
            }' data-slick-responsive='[
                {"breakpoint":769, "settings": {"slidesToShow": 1}},
                {"breakpoint":756, "settings": {"slidesToShow": 1}},
                {"breakpoint":481, "settings": {"slidesToShow": 1}}
            ]'>
            
            <slot></slot>

        </div>
    </div>
    <!-- End Featured Area -->
</template>

<script>
export default {
    // props: {
    //     items: {
    //         type: [Array, Object],
    //         required: true
    //     }
    // }
}
</script>