<template>
    <div class="section-title" :class="xClass">
        <slot name="subtitle"></slot>
        <slot name="title" />
        <slot />
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