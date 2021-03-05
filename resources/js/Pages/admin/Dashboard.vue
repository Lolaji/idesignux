<template>
    <idx-admin-layout>

        <idx-page-header>
            <span slot="title">{{page_title}}</span>

            <ol slot="breadcrumb" class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales Dashboard</li>
            </ol>

            <div class="btn-list">
                <inertia-link
                    href="/backoffice/services/create"
                    class="btn btn-info btn-icon text-white" 
                    data-toggle="tooltip" 
                    title="Add New Services" 
                    data-placement="top">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span>
                </inertia-link>

                <a href="#" >
                    
                </a>
            </div>
        </idx-page-header>


        <div class="row">
            <idx-overview-box 
                v-for="i in 4"
                :key="i"></idx-overview-box>
        </div>
        
    </idx-admin-layout>
</template>

<script>
import idxAdminLayout from '@/Layouts/AdminLayout';
import idxPageHeader from '@/components/admin/parts/PageHeader';
import idxOverviewBox from '@/components/admin/widget/OverviewBox';
export default {
    props: {
        page_title: String,
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        idxOverviewBox
    }
}
</script>