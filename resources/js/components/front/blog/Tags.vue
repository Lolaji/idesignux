<template>
    <idx-panel x-class="tags mt--80 mt_sm--30 mt_md--30 mt_lg--40">
        <h4 slot="title" class="title mb--30">Tags</h4>

        <ul class="tags-list">

            <li 
                v-for="(tag, index) in tags"
                :key="index"><a :href="tag.url">{{tag.title}}</a></li>
        </ul>
    </idx-panel>
</template>

<script>
import idxPanel from '@/components/front/widget/Panel';

export default {
    props: {
        tags: {
            type: [Array, Object],
            default: () => []
        }
    },
    components:{
        idxPanel
    }
}
</script>