<template>
    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img :src="imgUrl" class="loader-img" alt="iDesignUX Loader">
    </div>
    <!-- /GLOBAL-LOADER -->
</template>
<script>
export default {
    props: {
        imgUrl: {
            type: String,
            default: () => '/images/loader.svg'
        },
        loading: {
            type: Boolean,
            default: () => true
        }
    },
}
</script>