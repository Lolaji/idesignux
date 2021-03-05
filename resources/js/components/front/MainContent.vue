<template>
    <main :class="xClass">
        <slot />
    </main>
</template>

<script>
export default {
    props: {
        xClass: {
            type: [String, Array, Object],
            default: () => "page-wrapper"
        }
    }
}
</script>