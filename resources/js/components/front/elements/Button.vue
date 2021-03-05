<template>
    <button 
        v-on="$attrs" 
        class="axil-button"
        :class="xClass">
            <slot/>
    </button>
</template>
<script>
export default {
    props: {
        xClass: {
            type: [String, Array, Object]
        }
    },
    data() {
        return {
            local_class: {}
        }
    },
    created() {
        
    }
}
</script>