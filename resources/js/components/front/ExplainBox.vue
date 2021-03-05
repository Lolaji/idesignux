<template>
    <div class="col-lg-4 col-md-6 col-12 mt--85 mt_md--30 mt_sm--30">
        <div class="pv-feature paralax-image">
            <div class="inner">
                <div class="icon rounded-15">
                    <slot name="icon" />
                </div>
                <div class="content">
                    <h5 class="title">
                        <slot name="title" />
                    </h5>

                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>