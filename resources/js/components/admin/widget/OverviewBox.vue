<template>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col">
                        <p class="mb-1">
                            <slot name="title">Product Sold</slot>
                        </p>
                        <h3 class="mb-0 number-font">
                            <slot name="number">57,865</slot>
                        </h3>
                    </div>
                    <div class="col-auto mb-0">
                        <slot name="icon">
                            <div class="dash-icon text-orange">
                                <i class="bx bxs-shopping-bags"></i>
                            </div>
                        </slot>
                    </div>
                </div>
                <span class="fs-12 text-muted"> 
                    <slot>
                        <strong>2.6%</strong><i class="mdi mdi-arrow-up"></i> <span class="text-muted fs-12 ml-0 mt-1">than last week</span>
                    </slot>
                </span>
            </div>
        </div>
    </div>
</template>