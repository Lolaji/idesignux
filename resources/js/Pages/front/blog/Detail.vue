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

                        <div class="axil-blog-details-area">
                            <div class="wrapper">
                                <div class="blog-top">
                                    <div class="author">
                                        <div class="author-thumb">
                                            <img src="/images/blog/author-01.jpg" alt="Blog Author">
                                        </div>
                                        <div class="info">
                                            <h6>{{author.name}}</h6>
                                            <ul class="blog-meta">
                                                <li>{{post.created_at | dateFormat('MMMM D, YYYY - h:mm a')}}</li>
                                                <li>9 min to read</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="thumbnail mb--60 mb_sm--20 mb_md--20">
                                    <img 
                                        class="w-100" 
                                        :src="(!!post.image)? post.image.url  : `/images/blog/blog-list-01.jpg`" alt="Blog Images">
                                </div>

                                <div class="content mb--40 mb_sm--20 mb_md--20" v-html="post.content"></div>

                                <!-- Share -->
                                <div class="blog-share d-flex flex-wrap align-items-center mb--80 mb_sm--30 mb">
                                    <span class="text">Share on:</span>
                                    <ul class="social-share d-flex">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i>Facebook</a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i>twitter</a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i>Linkedin</a></li>
                                    </ul>
                                </div>

                                <!-- Start Blog Author  -->
                                <idx-blog-author :author="author"/>
                                <!-- End Blog Author  -->
                            </div>
                            
                            <!-- Blog Comments -->
                            <idx-blog-comment 
                                :post-id="post.id"
                                :comments="comments"/>
                            <!--/ Blog Comments -->

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-12 mt_md--40 mt_sm--40">
                        <!-- Start Blog Sidebar  -->
                        <div class="axil-blog-sidebar">

                            <!-- Search  -->
                            <idx-panel x-class="search">
                                <h4 slot="title" class="title mb--30">Search</h4>
                                <form action="#" class="blog-search">
                                    <input type="text" placeholder="Search…">
                                    <button class="search-button"><i class="fal fa-search"></i></button>
                                </form>
                            </idx-panel>
                            <!--/ Search  -->

                            <!-- Blog Categories  -->
                            <idx-blog-category :categories="_categories" />
                            <!--/ Blog Categories  -->

                            <!--Social Media  -->
                            <idx-panel x-class="share mt--80 mt_sm--30 mt_md--30 mt_lg--40">
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
                            </idx-panel>
                            <!--/ Social Media  -->


                            <!-- Recent Post  -->
                            <idx-blog-recent :posts="related_posts" />
                            <!--/ Recent Post  -->

                            <!-- Tags  -->
                            <idx-tags :tags="_tags" />
                            <!-- Tags  -->

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
import idxPanel from '@/components/front/widget/Panel';


import idxBlogComment from '@/components/front/blog/Comment';
import idxBlogCategory from '@/components/front/blog/Category';
import idxTags from '@/components/front/blog/Tags';
import idxBlogRecent from '@/components/front/blog/Recent';
import idxBlogAuthor from '@/components/front/blog/Author';


export default {
    filters: filters,
    props: {
        page_title: String, 
        breadcrumb: Array,
        post: Object,
        author: Object,
        comments: Array,
        categories: Array,
        related_posts: Array,
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
    components: {
        idxFrontLayout,
        idxMainContent,
        idxInnerBanner,
        idxBreadCrumb,
        idxSection,
        idxPanel,

        idxBlogComment,
        idxBlogCategory,
        idxTags,
        idxBlogRecent,
        idxBlogAuthor
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
        },
        _tags(){
            let tags = [];
            Object.entries(this.post.tags).forEach(([index, value]) => {
                tags.push({
                    title: value.title,
                    url: `/blog/${_.toLower(value.title.replace(/ /g, '-'))}`
                });
            });
            return tags;
        }
    }
}
</script>