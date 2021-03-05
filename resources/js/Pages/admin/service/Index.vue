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
                        </span> Add New Service
                </inertia-link>

                <a href="#" >
                    
                </a>
            </div>
        </idx-page-header>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Services</h3>
                    </div>
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                            <service-table
                                ref="serviceTbl"
                                class-name="table table-striped table-bordered text-nowrap w-100"
                                containerClassName="table-responsive"
                                :opts="options"
                                :fields="fields"
                                @edit="edit"
                                @delete="remove"
                                @table-created="tableCreated">

                            </service-table>

                            
                        <!-- </div> -->
                    </div>
                    <div class="card-footer">
                        <button 
                            v-if="rowSelected.length > 0"
                            type="button" 
                            class="btn btn-danger btn-icon"
                            :class="{'btn-loading': btn_loading}"
                            @click="bulkAction('delete')"> <i class="fe fe-trash-2"></i> Delete {{rowSelected.length}} services </button>
                    </div>
                    <!-- TABLE WRAPPER -->
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

import idxAdminLayout from '@/Layouts/AdminLayout';
import idxPageHeader from '@/components/admin/parts/PageHeader';
import idxOverviewBox from '@/components/admin/widget/OverviewBox';

import ServiceTable from 'vue-datatables-net';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-responsive-bs4';
export default {
    mixins: [errorLog],
    props: {
        page_title: String,
        services: [Array, Object]
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        idxOverviewBox,
        ServiceTable
    },
    data(){
        return {
            rowSelected: [],
            sInstance: {},
            btn_loading: false,
            options: {
                data: this.services,
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
                            length: 60,
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
                created_at: {label: "Date Created", sortable:true, searchable: true},
                actions: {
                    isLocal: true,
                    label: 'Actions',
                    // data: 'status',
                    render: () => {
                        
                        return `<button 
                                    type="button"
                                    class="btn btn-info btn-sm text-white" 
                                    data-action="edit">
                                        <i class="fa fa-pencil"></i>
                                </button>

                                <button 
                                    type="button"
                                    class="btn btn-danger btn-sm text-white" 
                                    data-toggle="tooltip" 
                                    data-action="delete"
                                    title="Delete Service" 
                                    data-placement="top">
                                        <i class="fa fa-trash"></i>
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
        edit(data){
            this.$inertia.visit(`/backoffice/services/${data.id}`)
        },
        remove(data, row, tr, target){
            let id = data.id;
            swal.setTitle('Are you sure?')
                .setText("You won't be able to revert this.")
                .setIcon('warning')
                .confirm(() => {
                    target.addClass('btn-loading');
                    this.$store.dispatch('service/remove', id).then(res => {
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
        bulkAction(action) {
            switch(action) {
                case 'delete':
                    swal.setTitle('Are you sure?')
                        .setText(`${this.rowSelected.length} services will be remove from this table`)
                        .setIcon('warning')
                        .confirm(() => {
                            this.btn_loading = true;
                            this.$store.dispatch('service/remove', this.rowSelected).then(res => {
                                console.log(res)
                                if (res){
                                    // this.sInstance.rows().remove().draw();
                                    swal.setText(`${this.rowSelected.length} services deleted successfully`);
                                    this.rowSelected = [];
                                    this.btn_loading = true;
                                }
                            }).catch(err => {
                                this.axiosErrorLog(err);
                            })
                        });
                    break;
            }
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