<template>
    <div class="axil-breadcrumb-area breadcrumb-style-default pt--170 pb--70 theme-gradient">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner">
                        <slot name="breadcrumb" />
                        <slot>
                            <h1 class="axil-page-title">{{title}}</h1>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-images">
            <i class="shape shape-1 fa fa-diamond fa-7x"></i>
            <i class="shape shape-2 icon icon-bcm-02"></i>
            <i class="shape shape-3 icon icon-bcm-03"></i>
        </div>
    </div>
</template>

<script>
import StringFilters from '@/plugin/util/filters';

export default {
    props: {
        title: {
            type: String
        }
    },
    filters: StringFilters,
}
</script>