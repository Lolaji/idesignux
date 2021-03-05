<template>
    <idx-admin-layout>

        <idx-page-header>
            <span slot="title">{{page_title}}</span>

            <ol slot="breadcrumb" class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales Dashboard</li>
            </ol>
        </idx-page-header>

        <portfolio-form />
        
    </idx-admin-layout>
</template>

<script>

import idxAdminLayout from '@/Layouts/AdminLayout';
import idxPageHeader from '@/components/admin/parts/PageHeader';
import PortfolioForm from './component/Form';

export default {
    props: {
        page_title: String
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        PortfolioForm
    },
}
</script>