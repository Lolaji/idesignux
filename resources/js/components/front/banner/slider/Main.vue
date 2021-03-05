<template>
    <!-- Start Slider Area -->
    <div class="axil-slider-area axil-slide-activation" :class="xClass">
        <slot />
    </div>
    <!-- End Slider Area -->
</template>

<script>

export default {
    props: {
        xClass: {
            type: [String, Array, Object]
        }
    }
}
</script>