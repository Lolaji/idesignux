<template>
    <div class="axil-testimonial testimonial axil-control active move-up wow" :class="xClass">
        <div class="inner">
            <div class="clint-info-wrapper">
                <div class="thumb">
                    <slot name="image" />
                </div>
                <div class="client-info">
                    <slot name="name" />
                    <slot name="designation" />
                </div>
            </div>
            <div class="description">
                <slot/>
            </div>
        </div>
    </div>
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