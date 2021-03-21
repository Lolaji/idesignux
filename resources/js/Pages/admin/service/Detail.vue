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
                                    <li class="b border-right">
                                        <inertia-link :href="`/backoffice/services/${service_id || ''}`">
                                            <i class="fe fe-arrow-left"></i>
                                        </inertia-link>
                                    </li>
                                    <li class=""><a href="#detail" class="active show" data-toggle="tab">Details</a></li>
                                    <li><a href="#metadata" data-toggle="tab" class="">Metadata</a></li>
                                    <li><a href="#deliverable" data-toggle="tab" class="">Deliverable</a></li>
                                    <li><a href="#process" data-toggle="tab" class="">Process</a></li>
                                    <li v-if="!is_sub_service"><a href="#services" data-toggle="tab" class="">Sub-Service</a></li>
                                    <li><a href="#portfolio" data-toggle="tab" class="">Portfolio</a></li>
                                    <li><a href="#settings" data-toggle="tab" class="">Settings</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active show" id="detail">
                        <service-form
                            :service="service"
                            :service-id="service_id" />
                    </div>

                    <div class="tab-pane" id="metadata">
                       <meta-data
                            endpoint="services"
                            store-name="service"
                            :model-id="service.id"
                            :payload="service.metadatas" />
                    </div>

                    <div class="tab-pane" id="deliverable">
                        <service-relation 
                            name='deliverable'
                            :parent-id="service.id"
                            :table-data="service.deliverables"
                            card-title="Service Deliverables"
                            save-store-path="service/deliverable/save"
                            remove-store-path="service/deliverable/remove" />
                    </div>

                    <div class="tab-pane" id="process">
                        <service-relation 
                            name="process"
                            :table-data="service.processes"
                            :parent-id="service.id"
                            card-title="Service Processes"
                            save-store-path="service/process/save"
                            remove-store-path="service/process/remove" />
                    </div>

                    <div v-if="!is_sub_service" class="tab-pane" id="services">
                        <sub-service 
                            :service-id="service.id"
                            :services="sub_services" />
                    </div>

                    <div class="tab-pane" id="portfolio">
                        <portfolio
                            :service-id="service.id"
                            :portfolios="_portfolios"/>
                    </div>

                    <div class="tab-pane" id="settings">
                        <settings 
                            :model-id="service.id"
                            :payload="service.settings" />
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
import ServiceForm from './component/Form';
import SubService from './component/SubService';
import ServiceRelation from '../components/Datatable';
import MetaData from '../components/MetaData';
import portfolio from './component/Portfolio';
import Settings from './component/Settings';

export default {
    props: {
        page_title: String,
        service: [Array, Object],
        service_id: String,
        sub_services: Array,
        is_sub_service: Boolean
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        idxOverviewBox,
        ServiceForm,
        ServiceRelation,
        SubService,
        MetaData,
        portfolio,
        Settings
    },
    computed: {
        _portfolios(){
            return this.service.portfolios;
        }
    },
}
</script>