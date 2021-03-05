<template>
    <div class="ax-section-gap" :class="xClass">
        <div class="container" :class="contentClass">
            <slot></slot>
        </div>
        
        <slot name="shapeGroup"></slot>
    </div>
</template>

<script>
export default {
    props: {
        xClass: {
            type: [String, Array, Object]
        },
        contentClass: {
            type: [String, Array, Object]
        }
    }
}
</script>