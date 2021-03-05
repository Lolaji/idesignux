<template>
    <idx-admin-layout>

        <idx-page-header>
            <span slot="title">{{page_title}}</span>

            <ol slot="breadcrumb" class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>

            <div class="btn-list">
                <button 
                    class="btn btn-primary btn-sm"
                    data-target="#mlModal"
                    data-toggle="modal">
                    <span>
                        <i class="fe fe-plus text-white"></i>
                    </span> Add Mailing List
                </button>
            </div>

        </idx-page-header>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Mailing List</h3>
                    </div>
                    <div class="card-body">
                        <!-- <div class="table-responsive"> -->
                            <mailing-list
                                ref="mlTbl"
                                class-name="table table-striped table-bordered text-nowrap w-100"
                                containerClassName="table-responsive"
                                :opts="options"
                                :fields="fields"
                                @edit="edit"
                                @delete="remove"
                                @table-created="tableCreated" />

                            
                        <!-- </div> -->
                    </div>
                    <!-- TABLE WRAPPER -->
                </div>
                <!-- SECTION WRAPPER -->
            </div>
        </div>
        

        <ms-modal
            id="mlModal"
            :title="ml_modal_title"
            x-class="fade"
            :centered="true"
            @hidden="modalHidden">
                <form @submit.prevent="save">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname" class="form-control-label">Firstname</label>
                            <input type="text" v-model="input.firstname" id="firstname" class="form-control" placeholder="Firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="form-control-label">Lastname</label>
                            <input type="text" v-model="input.lastname" id="lastname" class="form-control" placeholder="Lastname">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input type="text" v-model="input.email" id="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Designation</label>
                            <input type="text" v-model="input.designation" id="designation" class="form-control" placeholder="Body">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Body</label>
                            <textarea v-model="input.body" id="body" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm btn-icon" data-dismiss="modal">
                            <span><i class="fe fe-x text-dark"></i></span>
                            Close
                        </button>
                        <button 
                            type="Submit" 
                            class="btn btn-primary btn-sm btn-icon"
                            :class="{'btn-loading': ml_btn_loading}">
                            <span><i class="fe fe-save text-white"></i></span>
                            Save
                        </button>
                    </div>
                </form>
        </ms-modal>
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
import MsModal from '@/components/admin/elements/Modal';

import MailingList from 'vue-datatables-net';
import 'datatables.net-bs4';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'datatables.net-responsive-bs4';
export default {
    mixins: [errorLog],
    props: {
        page_title: String,
        reviews: Array
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        idxOverviewBox,
        MailingList,
        MsModal
    },
    data(){
        return {
            rowSelected: [],
            sInstance: {},
            ml_row_instance: null,
            ml_btn_loading: false,
            ml_modal_title: 'Add New Mailing List',
            input: {
                id: null,
                firstname: "",
                lastname: "",
                email: "",
                designation: "",
                body: ""
            },
            options: {
                data: this.reviews,
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
                firstname: {label: "Firstname", sortable:true, seachable:true},
                lastname: {label: "Lastname", sortable:true, seachable:true},
                email: {label: "Email", sortable:true, seachable:true},
                body: {
                    label: "Body", 
                    sortable:true, 
                    seachable:true,
                    render: (data) => _.truncate(data, {
                        length: 50, separator: / /, omission: "..."
                    })
                },
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
        save(){
            form.clearError();
            this.ml_btn_loading = true;

            this.$store.dispatch('review/save', this.input).then(res => {
                console.log(res);
                if (res.success) {
                    if (res.operation == 'create') {
                        this.sInstance.row.add(res.data).draw();
                    } else {
                        this.sInstance.row(this.ml_row_instance).data(res.data).draw();
                    }
                    $('#mlModal').modal('hide');
                    swal.setTitle(res.message).setIcon('success').toast();
                } else {
                    if (res.message instanceof Object) {
                        form.showError(res.message);
                    } else {
                        swal.setTitle(res.message).setIcon('error').toast();
                    }
                }

                this.ml_btn_loading = false;
            }).catch(err => {
                this.axiosErrorLog(err);
            })
        },
        edit(data, row, tr, target) {
            this.ml_row_instance = row;
            this.ml_modal_title = 'Update Mailing List';
            form.set(this.input, data);
            $('#mlModal').modal('show');
        },
        remove(data, row, tr, target){
            let id = data.id;
            swal.setTitle('Are you sure?')
                .setText("You won't be able to revert this.")
                .setIcon('warning')
                .confirm(() => {
                    target.addClass('btn-loading');
                    this.$store.dispatch('mailinglist/remove', id).then(res => {
                        console.log(res);
                        if (res) {
                            this.sInstance.row(row).remove().draw();
                            swal.setTitle('Mailing list deleted successfully').setIcon('success').toast();
                        } else {
                            swal.setTitle('Unable to delete Mailing list due to system error. Please try again').setIcon('error').toast();
                        }
                    }).catch(err => {
                        this.axiosErrorLog(err);
                    });
                });
        },
        tableCreated(t){
            this.sInstance = t.dataTable;
        },
        modalHidden(){
            this.ml_modal_title = 'Add Mailing List';
            this.ml_row_instance = null;
            form.clearError();
            form.reset(this.input);
        }
    },
    mounted(){
        form.checkAll('#checkAll', '.service', (arr) => {
            this.rowSelected = arr;
        });
    }
}
</script>