<template>
    <idx-admin-layout>

        <idx-page-header>
            <span slot="title">{{page_title}}</span>

            <ol slot="breadcrumb" class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Title</li>
            </ol>
        </idx-page-header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class="b border-right">
                                        <inertia-link :href="`/backoffice/posts`">
                                            <i class="fe fe-arrow-left"></i>
                                        </inertia-link>
                                    </li>
                                    <li class=""><a href="#detail" class="active show" data-toggle="tab">Details</a></li>
                                    <li><a href="#metadata" data-toggle="tab" class="">Metadata</a></li>
                                    <li><a href="#comment" data-toggle="tab" class="">Comment</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active show" id="detail">
                        <post-form
                            :post="post"
                            :tags="tags"
                            :user-id="user_id"
                            :categories="categories" />
                    </div>

                    <div class="tab-pane" id="comment">
                        <post-comment :comments="post.comments"/>
                    </div>

                    <div class="tab-pane" id="metadata">
                        <meta-data
                            :model-id="post.id"
                            store-name="post"
                            endpoint="posts"
                            :payload="post.metadatas" />
                    </div>

                </div>
            </div>
        </div>
        
    </idx-admin-layout>
</template>

<script>

// Components
import idxAdminLayout from '@/Layouts/AdminLayout';
import idxPageHeader from '@/components/admin/parts/PageHeader';
import idxOverviewBox from '@/components/admin/widget/OverviewBox';
import PostForm from './component/Form';
import PostComment from './component/Comment';
import MetaData from '../components/MetaData';

import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-responsive-bs4';

export default {
    props: {
        page_title: String,
        post: [Array, Object],
        tags: Array,
        categories: Array,
        user_id: Number
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        idxOverviewBox,
        PostForm,
        PostComment,
        MetaData,
    },
}
</script>