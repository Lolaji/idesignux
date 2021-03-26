<template>
    <idx-panel x-class="small-post-wrapper mt--80 mt_sm--30 mt_md--30 mt_lg--40">
        <h4 slot="title" class="title mb--30">Related Posts</h4>

        <!-- Start Related Post  -->
        <idx-list-view 
            v-for="(post, index) in posts"
            :key="index" 
            :url="`/blog/${post.slug}`"
            :img-src="post.image.url"
            :img-alt="post.title"
            :title="post.title"
            :meta="[
                formatDate (post.created_at), 
                '9 min to read'
            ]" />
        <!-- End Related Post  -->
    </idx-panel>
</template>

<script>
import filters from '@/plugin/util/filters';

import idxPanel from '@/components/front/widget/Panel';
import idxListView from '@/components/front/widget/ListView';

export default {
    props: {
        posts: {
            type: Array,
            default: () => []
        }
    },
    filters: filters,
    components:{
        idxPanel,
        idxListView
    },
    methods: {
        formatDate(value) {
            return moment(value).format('MMMM D, YYYY - h:mm a');
        }
    }
}
</script>