<template>
    <idx-admin-layout>

        <idx-page-header>
            <span slot="title">{{page_title}}</span>

            <ol slot="breadcrumb" class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Taxonomies</li>
            </ol>
        </idx-page-header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class=""><a href="#category" class="active show" data-toggle="tab">Category</a></li>
                                    <li><a href="#tag" data-toggle="tab" class="">Tag</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active show" id="category">
                        <category-panel :categories="categories" />
                    </div>

                    <div class="tab-pane" id="tag">
                        <tag-panel :tags="tags" />
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
import CategoryPanel from './Category';
import TagPanel from './Tag';

import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-responsive-bs4';

export default {
    props: {
        page_title: String,
        categories: [Array, Object],
        tags: [Array, Object]
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        CategoryPanel,
        TagPanel
    }
}
</script>