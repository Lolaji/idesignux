<template>

    <div class="axil-breadcrumb-area breadcrumb-style-2 pt--170 pt_sm--100 pb--70 theme-gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 order-2 order-lg-1 mt_md--30 mt_sm--20">
                    <div class="inner">
                        <slot name="breadcrumb" />
                        <div class="content">
                            <h1 
                                class="page-title wow slideFadeInUp mb--20"
                                data-wow-duration="1s" 
                                data-wow-delay="500ms" >
                                <slot name="title"></slot>
                            </h1>

                            <slot name="after-title" />

                            <p 
                                class="subtitle-2 wow slideFadeInUp"
                                data-wow-duration="1s" 
                                data-wow-delay="900ms" >
                                <slot name="subtitle" />
                            </p>
                            <slot name="link" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 order-1 order-lg-2">
                    <div class="breadcrumb-thumbnail-group text-left text-lg-right">
                        <div class="thumbnail">
                            <slot name="thumbnail" />
                        </div>
                        <slot name="shapeGroup" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
