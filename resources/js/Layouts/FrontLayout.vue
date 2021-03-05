<template>
    <div class="main-content">
        
        <idx-navigation></idx-navigation>

        <slot name="banner" />

        <!-- Main Content -->
        <slot />
        
        <idx-footer></idx-footer>
    </div>
</template>

<script>
import store from '@/store';

import idxNavigation from '@/components/front/Navigation';
import idxFooter from '@/components/front/Footer';
import themeMain from '@/plugin/theme/main';

export default {
    store,
    components:{
        idxNavigation,
        idxFooter
    },
    created(){
        this.$nextTick(() => {
            themeMain.init();
        });
    }
}
</script>