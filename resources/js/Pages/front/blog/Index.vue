<template>
    <idx-front-layout>

        <idx-inner-banner 
            slot="banner" 
            :title="page_title">
                <idx-bread-crumb 
                    slot="breadcrumb"
                    :items="breadcrumb" />
        </idx-inner-banner>

        <idx-main-content>
            <idx-section x-class="axil-blog-area bg-color-white">
                <div class="row row--40">
                    <div class="col-lg-8 col-md-12 col-12">
                        <idx-blog-list 
                            v-for="(post, x) in posts"
                            :key="post.id"
                            :x-class="x > 0? 'wow move-up mt--80 mt_md--30 mt_sm--30 mt_lg--50': 'wow move-up'">
                                <div slot="top">
                                    <h4 class="title"><a :href="`/blog/${post.slug}`">{{post.title}}</a></h4>
                                    <div class="author">
                                        <div class="author-thumb">
                                            <img src="/images/blog/author-01.jpg" alt="Blog Author">
                                        </div>
                                        <div class="info">
                                            <h6>{{post.user.name}}</h6>
                                            <ul class="blog-meta">
                                                <li>Aug 27, 2019</li>
                                                <li>9 min to read</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <a slot="thumbnail" :href="`/blog/${post.slug}`">
                                    <img class="w-100" :src="(!!post.image)? post.image.url : '/images/blog/blog-list-01.jpg'" alt="Blog Images">
                                </a>

                                <template>
                                    <p>{{post.description | limit(40)}}</p>
                                        
                                    <a 
                                        class="axil-button btn-large btn-transparent" 
                                        :href="`/blog/${post.slug}`"><span
                                            class="button-text">Read More</span><span class="button-icon"></span></a>
                                </template>
                        </idx-blog-list>
                    </div>

                    <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                            <!-- Start Blog Sidebar  -->
                            <div class="axil-blog-sidebar">

                                <!-- Start Single Widget  -->
                                <div class="axil-single-widget search">
                                    <h4 class="title mb--30">Search</h4>
                                    <div class="inner">
                                        <form action="#" class="blog-search">
                                            <input type="text" placeholder="Search…">
                                            <button class="search-button"><i class="fal fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Single Widget  -->

                                <!-- Blog Categories  -->
                                <idx-blog-category :categories="_categories" />
                                <!--/ Blog Categories  -->

                                <!-- Start Single Widget  -->
                                <div class="axil-single-widget share mt--80 mt_sm--30 mt_md--30 mt_lg--40">
                                    <div class="inner">
                                        <div class="blog-share d-flex flex-wrap">
                                            <span>Follow:</span>
                                            <ul class="social-list d-flex">
                                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Widget  -->


                                <!-- Start Single Widget  -->
                                <!-- <idx-blog-recent></idx-blog-recent> -->
                                <!-- End Single Widget  -->

                                <!-- Start Single Widget  -->
                                <idx-tags />
                                <!-- End Single Widget  -->

                            </div>
                            <!-- End Blog Sidebar  -->
                        </div>
                </div>
            </idx-section>
        </idx-main-content>

    </idx-front-layout>
</template>

<script>

import filters from '@/plugin/util/filters';

import idxFrontLayout from '@/Layouts/FrontLayout';
import idxMainContent from '@/components/front/MainContent';
import idxInnerBanner from '@/components/front/banner/InnerBannerSmall';
import idxBreadCrumb from '@/components/front/BreadCrumb';
import idxSection from '@/components/front/section/Section';

import idxBlogList from '@/components/front/blog/List';
import idxBlogCategory from '@/components/front/blog/Category';
import idxTags from '@/components/front/blog/Tags';
import idxBlogRecent from '@/components/front/blog/Recent';

export default {
    props: {
        page_title: String, 
        breadcrumb: Array,
        posts: Array,
        categories: Array,
        metadatas: {
            type: Array,
            default: () => []
        }
    },
    head(){
        return {
            title: this.page_title,
            meta: this.metadatas
        }
    },
    filters: filters,
    components: {
        idxFrontLayout,
        idxMainContent,
        idxInnerBanner,
        idxBreadCrumb,
        idxSection,
        idxBlogList,
        idxBlogCategory,
        idxTags,
        idxBlogRecent
    },
    computed: {
        _categories(){
            let categories = [];
            Object.entries(this.categories).forEach(([index, value]) => {
                categories.push({
                    title: value.title,
                    url: `/blog/${_.toLower(value.title.replace(/ /g, '-'))}`
                });
            });
            return categories;
        }
    }
}
</script>