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
                    href="/backoffice/portfolios/create"
                    class="btn btn-info btn-icon text-white" 
                    data-toggle="tooltip" 
                    title="Add New Services" 
                    data-placement="top">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> Add New Portfolio
                </inertia-link>

                <a href="#" >
                    
                </a>
            </div>
        </idx-page-header>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li class=""><a href="#portfolio" class="active show" data-toggle="tab">Portfolios</a></li>
                                    <li><a href="#feature" data-toggle="tab" class="">Features</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="portfolio">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Portfolios</h3>
                            </div>
                            <div class="card-body">
                                <!-- <div class="table-responsive"> -->
                                    <portfolio-table
                                        ref="pfTbl"
                                        class-name="table table-striped table-bordered text-nowrap w-100"
                                        containerClassName="table-responsive"
                                        :opts="options"
                                        :fields="fields"
                                        @view="view"
                                        @edit="edit"
                                        @feature="feature"
                                        @delete="remove"
                                        @table-created="tableCreated">

                                    </portfolio-table>

                                    
                                <!-- </div> -->
                            </div>
                            <!-- TABLE WRAPPER -->
                        </div>
                    </div>

                    <div class="tab-pane" id="feature">
                        <featured-portfolio
                            :features="_features"
                            @removed="featureRemoved"></featured-portfolio>
                    </div>
                </div>
                <!-- SECTION WRAPPER -->
            </div>
        </div>
        
    </idx-admin-layout>
</template>

<script>
import form from '@/plugin/util/Form';
import swal from '@/plugin/util/swal';

// Mixins
import errorLog from '@/Mixins/errorLog';
import formMixin from '@/Mixins/form';

import idxAdminLayout from '@/Layouts/AdminLayout';
import idxPageHeader from '@/components/admin/parts/PageHeader';
import featuredPortfolio from './component/Featured';

import PortfolioTable from 'vue-datatables-net';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-responsive-bs4';
export default {
    mixins: [errorLog, formMixin],
    props: {
        page_title: String,
        portfolios: [Array, Object],
        features: Array
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        PortfolioTable,
        featuredPortfolio
    },
    computed: {
        _features(){
            return this.features;
        }
    },
    data(){
        return {
            rowSelected: [],
            sInstance: {},
            loading: {
                feature: false,
                delete: false
            },
            options: {
                data: this.portfolios,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>tr<'col-sm-12'><'row vdtnet-footer'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                // dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>",
                processing: true,
                searching: true,
                ordering: true,
                serverSide: false,
                saveState: true
            },
            fields: {
                id: {
                    isLocal: true,
                    label: `<label class="custom-control custom-checkbox">
                                <input type="checkbox" name="checkAll" id="checkAll" class="custom-control-input checkAll">
                                <span class="custom-control-label"></span>
                            </label>`,
                    render: (id) => {
                        return `<label for="service${id}" class="custom-control custom-checkbox">
                                    <input type="checkbox" name="service" id="service${id}" class="custom-control-input service" value="${id}">
                                    <span class="custom-control-label"></span>
                                </label>`
                    }
                },
                title: {label: "Title", sortable:true, seachable:true},
                description: {
                    label: "Description", 
                    sortable:true, 
                    seachable:true,
                    render(data) {
                        return _.truncate(data, {
                            length: 40,
                            separator: / /,
                            omission: '...'
                        });
                    }
                },
                // status: {
                //     label: "Status", 
                //     sortable:true, 
                //     seachable:true,
                //     render: (data) => {
                //         let color = 'success';
                //         if (data == 'suspended'){
                //             color = 'warning';
                //         } else if (data == 'closed') {
                //             color = 'danger';
                //         }
                        

                //         return `<span class="badge badge-${color}">${data}</span>`
                //     }
                // },
                feature: {
                    label: "Feature", 
                    isLocal: true,
                    sortable:true, 
                    seachable:true,
                    data: {id: "id", feature: "feature"},
                    render: ({id, feature}) => {
                        let color = 'danger',
                            text = 'not featured';
                        if (!_.isNull(feature)){
                            color = 'success';
                            text = 'featured';
                        }

                        return `<span class="badge badge-${color} badge-feature-${id}">${text}</span>`
                    }
                },
                created_at: {label: "Date Created", sortable:true, searchable: true},
                actions: {
                    isLocal: true,
                    label: 'Actions',
                    data: "feature",
                    // data: 'status',
                    render: (feature) => {
                        let f_action = 'add',
                            btn_feature = `<button 
                                    type="button"
                                    class="btn btn-dark btn-sm btn-feature" 
                                    data-feature-action="${f_action}"
                                    data-action="feature">
                                        <i class="fe fe-feather text-white" data-action="feature"></i>
                                </button>`;
                        if (!_.isNull(feature)) {
                            f_action = 'remove';
                            btn_feature = '';
                        }

                        return `${btn_feature}

                                <button 
                                    type="button"
                                    class="btn btn-info btn-sm text-white" 
                                    data-action="view">
                                        <i class="fe fe-eye text-white" data-action="view"></i>
                                </button>

                                <button 
                                    type="button"
                                    class="btn btn-info btn-sm" 
                                    data-action="edit">
                                        <i class="fa fa-pencil text-white" data-action="edit"></i>
                                </button>
                        
                                <button 
                                    type="button"
                                    class="btn btn-danger btn-sm btn-delete" 
                                    data-toggle="tooltip" 
                                    data-action="delete"
                                    title="Delete Service" 
                                    data-placement="top">
                                        <i class="fa fa-trash text-white" data-action="delete"></i>
                                </button>`
                    }
                }
            }
        }
    },
    watch: {
        page_title: {
            immediate: true,
            handler(pt) {
                document.title = `${pt} | iDesignUX`;
            }
        }
    },
    methods: {
        view(data){
            window.open(`/portfolio/${data.slug}`, '__blank');
        },
        edit(data){
            this.$inertia.visit(`/backoffice/portfolios/${data.id}`)
        },
        feature(data, row, tr, target) {
            let badge = tr.parent().find(`.badge-feature-${data.id}`),
                action = 'remove',
                add_badge_class = 'badge-success',
                remove_badge_class = 'badge-danger',
                text = 'featured';

                // if (target.data('feature-action') == "remove") {
                //     add_badge_class = 'badge-danger';
                //     remove_badge_class = 'badge-success';
                //     text = 'not featured';
                //     action = 'add';
                // }

            this._btnLoading(target);

            this.$store.dispatch('portfolio/feature', data.id).then(res => {
                console.log(res);
                if (res.success) {
                    this._features.push(res.hook);
                    if (target.has('button')) {
                        target.parent('button').remove();
                    } else {
                        target.remove();
                    }
                    target.remove();
                    badge.removeClass(remove_badge_class).addClass(add_badge_class).html(text);
                    this._btnLoading(target, false);
                    swal.setTitle(res.message).toast();
                } else {
                    swal.setTitle(res.message).setIcon('error').toast();
                }
            }).catch(err => {
                this.axiosErrorLog(err);
            });
        },
        remove(data, row, tr, target){
            let id = data.id;
            swal.setTitle('Are you sure?')
                .setText("You won't be able to revert this.")
                .setIcon('warning')
                .confirm(() => {
                    this._btnLoading(target);
                    this.$store.dispatch('portfolio/remove', id).then(res => {
                        console.log(res);
                        if (res) {
                            this.sInstance.row(row).remove().draw();
                            swal.setTitle('Service deleted successfully').setIcon('success').toast();
                        } else {
                            swal.setTitle('Unable to delete service due to system error. Please try again').setIcon('error').toast();
                        }
                    }).catch(err => {
                        this.axiosErrorLog(err);
                    });
                });
        },
        featureRemoved(data) {
            console.log(data);
            this.sInstance.row(data).data(data).draw();
        },
        tableCreated(t){
            this.sInstance = t.dataTable;
        }
    },
    mounted(){
        form.checkAll('#checkAll', '.service', (arr) => {
            this.rowSelected = arr;
        });
    }
}
</script>