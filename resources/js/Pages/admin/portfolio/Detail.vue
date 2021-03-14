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
                                        <inertia-link :href="`/backoffice/portfolios`">
                                            <i class="fe fe-arrow-left"></i>
                                        </inertia-link>
                                    </li>
                                    <li class=""><a href="#detail" class="active show" data-toggle="tab">Detail</a></li>
                                    <li><a href="#metadata" data-toggle="tab" class="">Metadata</a></li>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Metadatas</h3>

                                <div class="card-options">
                                    <button 
                                        class="btn btn-primary btn-sm"
                                        data-target="#mdModal"
                                        data-toggle="modal">
                                        <span>
                                            <i class="fe fe-plus text-white"></i>
                                        </span> Add New Metadata
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <metadata-table
                                    ref="mdTbl"
                                    class-name="table table-striped table-bordered text-nowrap w-100"
                                    containerClassName="table-responsive"
                                    :opts="options"
                                    :fields="fields"
                                    @edit="edit"
                                    @delete="remove"
                                    @table-created="mdTableCreated" />
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <md-modal
            id="mdModal"
            :title="md_modal_title"
            x-class="fade"
            :centered="true"
            @hidden="modalHidden">
                <form @submit.prevent="saveMetadata">
                    <div class="modal-body">
                        <div class="form-group portfolio">
                            <label for="name" class="form-control-label">Name</label>
                            <select v-model="metadata_input.name" id="name" class="form-control custom-select">
                                <option value="">-- Select Meta Name --</option>
                                <option value="robots">Robots</option>
                                <option value="author">Author</option>
                                <option value="keywords">Keywords</option>
                                <option value="canonical">Canonical</option>
                                <option value="description">Description</option>
                            </select>
                        </div>
                        <div class="form-group portfolio">
                            <label for="content" class="form-control-label">Content</label>
                            <textarea v-model="metadata_input.content" id="content" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm btn-icon" data-dismiss="modal">
                            <span><i class="fe fe-x"></i></span>
                            Close
                        </button>
                        <button 
                            type="Submit" 
                            class="btn btn-primary btn-sm btn-icon"
                            :class="{'btn-loading': btn_loading}">
                            <span><i class="fe fe-save"></i></span>
                            Save
                        </button>
                    </div>
                </form>
        </md-modal>
        
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
import MdModal from '@/components/admin/elements/Modal';

import MetadataTable from 'vue-datatables-net';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-responsive-bs4';

export default {
    mixins: [errorLog],
    props: {
        page_title: String,
        portfolio: [Array, Object]
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        idxOverviewBox,
        PortfolioForm,
        MdModal,
        MetadataTable
    },
    data(){
        return {
            rowSelected: [],
            mdInstance: {},
            md_modal_title: 'Add New Metadata',
            btn_loading: false,
            //hold the intance of the row to updated
            md_row_instance: null,
            metadata_input:{
                id: null,
                name: '',
                content: ''
            },
            options: {
                data: this.portfolio.metadatas,
                dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>tr<'col-sm-12'><'row vdtnet-footer'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
                                <input type="checkbox" name="mdCheckAll" id="mdCheckAll" class="custom-control-input checkAll">
                                <span class="custom-control-label"></span>
                            </label>`,
                    render: (id) => {
                        return `<label for="md${id}" class="custom-control custom-checkbox">
                                    <input type="checkbox" name="md" id="md${id}" class="custom-control-input md" value="${id}">
                                    <span class="custom-control-label"></span>
                                </label>`
                    }
                },
                name: {label: "Name", sortable:true, seachable:true},
                content: {label: "Content", sortable:true, seachable:true},
                created_at: {label: "Date Created", sortable:true, searchable: true},
                actions: {
                    isLocal: true,
                    label: 'Actions',
                    // data: 'status',
                    render: () => {
                        
                        return `<button 
                                    type="button"
                                    class="btn btn-info btn-sm btn-icon" 
                                    data-action="edit">
                                        <i class="fa fa-pencil text-white"></i>
                                </button>

                                <button 
                                    type="button"
                                    class="btn btn-danger btn-sm btn-icon" 
                                    data-toggle="tooltip" 
                                    data-action="delete"
                                    title="Delete Service" 
                                    data-placement="top">
                                        <i class="fa fa-trash text-white"></i>
                                </button>`
                    }
                }
            }
        }
    },
    methods: {
        saveMetadata(){
            form.clearError()
            this.btn_loading = true;

            this.$store.dispatch('portfolio/metadata/save', {
                id: this.portfolio.id,
                model: 'portfolios',
                input: this.metadata_input
            }).then(res => {
                console.log(res);
                if (res.success) {
                    if (res.operation == 'create'){
                        this.mdInstance.row.add(res.data).draw();
                    } else {
                        this.mdInstance.row(this.md_row_instance).data(res.data).draw();
                    }
                    $('#mdModal').modal('hide');
                    swal.setTitle(res.message).setIcon('success').toast();
                } else {
                    if (res.message instanceof Object) {
                        form.showError(res.message, '.portfolio');
                    } else {
                        swal.setTitle(res.message).setIcon('error').toast();
                    }
                }

                this.btn_loading = false;
            }).catch(err => {
                this.axiosErrorLog(err);
            })
        },
        mdTableCreated(dt){
            this.mdInstance = dt.dataTable;
        },
        edit(data, row, tr, target) {
            this.md_row_instance = row;
            form.set(this.metadata_input, data);
            this.md_modal_title = 'Update Metadata';

            $('#mdModal').modal('show');
        },
        remove(data, row, tr, target) {
            let id = data.id;
            swal.setTitle('Are you sure?')
                .setText("You won't be able to revert this.")
                .setIcon('warning')
                .confirm(() => {
                    target.addClass('btn-loading');
                    this.$store.dispatch('service/metadata/remove', id).then(res => {
                        console.log(res);
                        if (res) {
                            // let newData = this.options.data.filter(e => e.id !== id);
                            // this.options.data = newData;
                            this.mdInstance.row(row).remove().draw();
                            swal.setTitle('Metadata deleted successfully').setIcon('success').toast();
                        } else {
                            swal.setTitle('Unable to delete metadata due to system error. Please try again').setIcon('error').toast();
                        }
                    }).catch(err => {
                        this.axiosErrorLog(err);
                    });
                });
        },
        modalHidden(){
            this.md_row_instance = null;
            form.clearError();
            form.reset(this.metadata_input);
        }
    },
    mounted(){
        form.checkAll('#mdCheckAll', '.md', (arr) => {
            this.md_modal_title = 'Add New Metadata';
            this.rowSelected = arr;
        })
    }
}
</script>