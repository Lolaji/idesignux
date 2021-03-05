<template>
    <idx-panel x-class="category mt--80 mt_sm--30 mt_md--30 mt_lg--40">
        <h4 slot="title" class="title mb--30">Categories</h4>

        <ul class="category-list">
            <li
                v-for="(category, index) in categories"
                :key="index"><a :href="category.url">{{category.title}}</a></li>
        </ul>
    </idx-panel>
</template>

<script>
import idxPanel from '@/components/front/widget/Panel';

export default {
    props: {
        categories: {
            type: [Array, Object],
            default: () => []
        }
    },
    components:{
        idxPanel
    }
}
</script>