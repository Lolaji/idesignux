<template>
    <div>

        <!-- <idx-loader /> -->

        <div class="page">

            <div class="page-main">
                <idx-app-sidebar></idx-app-sidebar>

                <idx-app-header></idx-app-header>

                <div class="app-content">
                    <div class="side-app">
                        <slot />
                    </div>
                </div>

            </div>

            <slot name="rightSidebar">
                <idx-right-sidebar></idx-right-sidebar>
            </slot>

            <idx-footer></idx-footer>
        </div>

        <!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    </div>
</template>
<script>
import { Loader } from '@/plugin/admin/main';

import idxLoader from '@/components/admin/elements/Loader';
import idxAppHeader from '@/components/admin/parts/AppHeader';
import idxAppSidebar from '@/components/admin/parts/AppSidebar';
import idxRightSidebar from '@/components/admin/parts/RightSidebar';
import idxFooter from '@/components/admin/parts/Footer';
export default {
    components: {
        idxLoader,
        idxAppHeader,
        idxAppSidebar,
        idxRightSidebar,
        idxFooter
    },
    mounted(){
        Loader();
    }
}
</script>
<style lang="scss">
    
</style>