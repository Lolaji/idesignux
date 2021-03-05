<template>
    <div class="axil-call-to-action">
        <div class="section-title" :class="xClass">
            <slot name="subtitle" />
            <slot />
            <slot name="button" />
            <slot name="buttomText"/>
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
