<template>
    <idx-admin-layout>

        <idx-page-header>
            <span slot="title">{{portfolio.title}}</span>

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
                                        <inertia-link :href="`/backoffice/portfolios`">
                                            <i class="fe fe-arrow-left"></i>
                                        </inertia-link>
                                    </li>
                                    <li class=""><a href="#detail" class="active show" data-toggle="tab">Detail</a></li>
                                    <li><a href="#metadata" data-toggle="tab" class="">Metadata</a></li>
                                    <li><a href="#settings" data-toggle="tab" class="">Settings</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active show" id="detail">
                        <portfolio-form
                            :portfolio="portfolio" />
                    </div>

                    <div class="tab-pane" id="metadata">
                        <meta-data
                            :model-id="portfolio.id"
                            :payload="portfolio.metadatas"
                            store-name="portfolio"
                            endpoint="portfolios" />
                    </div>

                    <div class="tab-pane" id="settings">
                        <setting 
                            model-name="portfolio"
                            :model-id="portfolio.id"
                            :payload="portfolio.settings" />
                    </div>

                </div>
            </div>
        </div>
        
    </idx-admin-layout>
</template>

<script>
// Plugin
import form from '@/plugin/util/Form';
import swal from '@/plugin/util/swal';

// Mixins
import errorLog from '@/Mixins/errorLog';

// Components
import idxAdminLayout from '@/Layouts/AdminLayout';
import idxPageHeader from '@/components/admin/parts/PageHeader';
import idxOverviewBox from '@/components/admin/widget/OverviewBox';
import PortfolioForm from './component/Form';
import Setting from './component/Setting';
import MetaData from '../components/MetaData';

export default {
    props: {
        page_title: String,
        portfolio: [Array, Object]
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        idxOverviewBox,
        PortfolioForm,
        Setting,
        MetaData
    },
}
</script>