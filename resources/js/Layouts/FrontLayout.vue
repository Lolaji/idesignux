<template>
    <div class="main-content">
        
        <idx-navigation v-if="!hideNavigation"></idx-navigation>

        <slot name="banner" />

        <!-- Main Content -->
        <slot />
        
        <idx-footer v-if="!hideFooter" />
    </div>
</template>

<script>
import store from '@/store';

import idxNavigation from '@/components/front/Navigation';
import idxFooter from '@/components/front/Footer';
import themeMain from '@/plugin/theme/main';

export default {
    store,
    props: {
        hideNavigation: {
            type: Boolean,
            default: () => false
        },
        hideFooter: {
            type: Boolean,
            default: () => false
        }
    },
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