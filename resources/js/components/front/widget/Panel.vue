<template>
    <div class="axil-single-widget" :class="xClass">
        <slot name="title" />
        <div class="inner">
            <slot />
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