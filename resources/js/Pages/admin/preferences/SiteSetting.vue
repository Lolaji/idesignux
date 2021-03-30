<template>
    <idx-admin-layout>

        <idx-page-header>
            <span slot="title">{{page_title}}</span>

            <ol slot="breadcrumb" class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales Dashboard</li>
            </ol>
        </idx-page-header>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <!-- <li class="b border-right">
                                        <inertia-link :href="`/backoffice/services/${service_id || ''}`">
                                            <i class="fe fe-arrow-left"></i>
                                        </inertia-link>
                                    </li> -->
                                    <li class=""><a href="#maintenance" class="active show" data-toggle="tab">Maintenance</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active show" id="maintenance">
                        <maintenance-setting 
                            :model-id="preference.id"
                            :payload="preference.settings" />
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
import MaintenanceSetting from './component/Maintenance';


export default {
    props: {
        page_title: String,
        service: [Array, Object],
        preference: Object
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        MaintenanceSetting,
    },
}
</script>