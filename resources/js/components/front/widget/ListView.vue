<template>
    <div class="small-post">
        <div class="thumbnail">
            <slot name="thumbnail">
                <a href="#">
                    <img :src="imgSrc" :alt="imgAlt">
                </a>
            </slot>
        </div>
        <div class="content">
            <slot>
                <h6>
                    <a :href="url">
                        {{title}}
                    </a>
                </h6>
            </slot>
            <slot name="meta">
                <ul class="blog-meta">
                    <li 
                        v-for="(m, index) in meta"
                        :key="index">{{m}}</li>
                </ul>
            </slot>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        url: String,
        imgSrc: {
            type: String,
            default: () => '/images/blog/blog-sm-01.jpg'
        },
        imgAlt: {
            type: String,
            default: () => 'List view image'
        },
        title: {
            type: String,
            default: () => 'Default title (Title is not Set)'
        },
        meta: {
            type: Array,
            default: () => ['Aug 27, 2019', '9 min to read']
        }
    }
}
</script>