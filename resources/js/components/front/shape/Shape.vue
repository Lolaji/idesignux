<template>
    <div class="shape" :class="xClass">
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