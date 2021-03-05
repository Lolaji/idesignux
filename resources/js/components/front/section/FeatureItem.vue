<template>
    <!-- Start Single Feature  -->
    <div class="row d-flex flex-wrap axil-featured row--0">
        <div class="col-lg-6 col-xl-6 col-md-12 col-12">
            <div class="thumbnail">
                <slot name="image"></slot>
            </div>
        </div>
        <div class="col-lg-6 col-xl-5 col-md-12 col-12 offset-xl-1 mt_md--40 mt_sm--40">
            <div class="inner">
                <div class="section-title text-left">
                    <slot name="subTitle" />
                    <slot name="title" />
                    <slot name="description" />
                    <slot name="readMore" />
                </div>

                <div class="axil-counterup-area d-flex flex-wrap separator-line-vertical">
                    <slot name="counterUpItem"></slot>
                </div>

            </div>
        </div>
    </div>
    <!-- End Single Feature  -->
</template>

<script>
export default {
    
}
</script>