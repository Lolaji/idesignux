<template>
    <div class="icon" :class="bgClass">
        <div class="icon-inner">
            <img src="/images/icons/layer.svg" alt="iDesignUX Icon Shape background">
            <div class="image-2">
                <img v-bind="$attrs">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        // inheritAttr: false,
        props: {
            bgClass: {
                type: [String, Array, Object]
            }
        }
    }
</script>