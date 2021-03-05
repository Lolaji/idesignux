<template>
    <div class="axil-working-process" :class="xClass">
        <slot/>
    </div>
</template>

<script>
export default {
    props: {
        xClass: {
            type: [String, Array, Object]
        },
        stepNumber:{
            type: [String, Number]
        },
        title: {
            type: String
        },
        subtitle: {
            type: String
        },
        content: {
            type: String
        },
        imgSrc: {
            type: String
        },
        alt: {
            type: String
        }
    }
}
</script>