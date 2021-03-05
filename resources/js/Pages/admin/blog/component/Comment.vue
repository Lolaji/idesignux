<template>
    <div>
        <div class="card">
                    <div class="card-body p-6">
                        <div class="inbox-body">
                            <div class="mail-option">
                                <div class="chk-all">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkAll" id="checkAll" name="example-checkbox1" value="option1">
                                        <span class="custom-control-label"></span>
                                    </label>
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                            All
                                            <i class="fa fa-angle-down "></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"> None</a></li>
                                            <li><a href="#"> Read</a></li>
                                            <li><a href="#"> Unread</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                        <i class=" fa fa-refresh"></i>
                                    </a>
                                </div>
                                <div class="btn-group hidden-phone">
                                    <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                        More
                                        <i class="fa fa-angle-down "></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                        <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                    </ul>
                                </div>
                                <ul class="unstyled inbox-pagination">
                                    <li><span>1-50 of 234</span></li>

                                    <li>
                                        <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                    </li>
                                </ul>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-inbox table-hover text-nowrap">
                                    <tbody>
                                        <tr 
                                            v-for="i in 10"
                                            :key="i"
                                            :class="{unread: (i == i+1)}" 
                                            style="font-size: 12px">
                                            <td class="inbox-small-cells">
                                                <div class="d-md-flex">

                                                    <div class="mr-2">
                                                        <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                            <i 
                                                                class="fe fe-more-vertical text-dark font-weight-bold" 
                                                                data-toggle="tooltip" title="" 
                                                                data-original-title="More option"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right shadow">
                                                            <a class="dropdown-item" href="#">Approve</a>
                                                            <a class="dropdown-item" href="#">Report Spam</a>
                                                            <a class="dropdown-item" href="#">Delete</a>
                                                        </div>
                                                    </div>

                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input contact" name="example-checkbox1" value="option1">
                                                        <span class="custom-control-label"></span>
                                                    </label>

                                                </div>
                                            </td>
                                            <td class="inbox-small-cells">
                                                <span class="avatar brround cover-image" data-image-src="/images/users/12.jpg"></span>
                                            </td>
                                            <td class="view-message dont-show">
                                                <h6 class="mt-0">Salami Ajibola</h6>
                                                <small class="text-muted mr-1">
                                                    <span><i class="fe fe-message-square"></i></span>
                                                    <span>ayo.lolade@gmail.com</span>
                                                </small> <br>
                                                <small class="text-muted">
                                                    <span><i class="fe fe-link"></i></span>
                                                    <span><a href="https://idesignux.net" target="__blank">idesignux.net</a></span>
                                                </small>
                                            </td>
                                            <td class="view-message">
                                                    <p>
                                                        This is my comments written by me This is my comments written by me This 
                                                        is my comments ...
                                                    </p>
                                            </td>
                                            <!-- <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td> -->
                                            <td class="view-message text-right">7 days ago</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <ul class="pagination float-right mb-5">
                        <li class="page-item page-prev disabled">
                            <a class="page-link" href="#" tabindex="-1">Prev</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item page-next">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </div>

        <ms-modal
            id="msModal"
            :title="ms_modal_title"
            x-class="fade"
            :centered="true"
            @hidden="modalHidden">
                <form @submit.prevent="saveMilestone">
                    <div class="modal-body">
                        <div class="form-group milestone">
                            <label for="title" class="form-control-label">Title</label>
                            <input type="text" v-model="ms_input.title" id="title" class="form-control" placeholder="Milestone Title">
                        </div>
                        <div class="form-group milestone">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea v-model="ms_input.description" id="description" class="form-control" placeholder="Write milestone description..."></textarea>
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
                            :class="{'btn-loading': ms_btn_loading}">
                            <span><i class="fe fe-save text-white"></i></span>
                            Save
                        </button>
                    </div>
                </form>
        </ms-modal>
    </div>
</template>

<script>
import form from '@/plugin/util/Form';
import swal from '@/plugin/util/swal';

import errorLog from '@/Mixins/errorLog';

import MilestoneTable from 'vue-datatables-net';
import MsModal from '@/components/admin/elements/Modal';

export default {
    mixins: [errorLog],
    props: {
        comments: Array,
    },
    components: {
        MilestoneTable,
        MsModal
    },
    data() {
        return {
            id: null,
            ms_modal_title: 'Add New Milestone',
            ms_btn_loading: false,
            msInstance: {},
            ms_row_instance: null,
            ms_input: {
                id: null,
                title: '',
                description: ''
            },
            opts: {
                data: this.milestones,
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
                title: {label: "Name", sortable:true, seachable:true},
                description: {label: "Description", sortable:true, seachable:true},
                created_at: {label: "Date Created", sortable:true, searchable: true},
                actions: {
                    isLocal: true,
                    label: 'Actions',
                    // data: 'status',
                    render: () => {
                        
                        return `<button 
                                    type="button"
                                    class="btn btn-info btn-sm" 
                                    data-action="edit">
                                        <i class="fa fa-pencil text-white"></i>
                                </button>

                                <button 
                                    type="button"
                                    class="btn btn-danger btn-sm" 
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
        saveMilestone(){
            form.clearError('.milestone');
            this.ms_btn_loading = true;

            this.$store.dispatch('service/milestone/save', {
                service_id: this.serviceId,
                input: this.ms_input
            }).then(res => {
                console.log(res);
                if (res.success) {
                    if (res.operation == 'create'){
                        this.msInstance.row.add(res.data).draw();
                    } else {
                        this.msInstance.row(this.ms_row_instance).data(res.data).draw();
                    }
                    $('#msModal').modal('hide');
                    swal.setTitle(res.message).setIcon('success').toast();
                } else {
                    if (res.message instanceof Object) {
                        form.showError(res.message, '.milestone');
                    } else {
                        swal.setTitle(res.message).setIcon('error').toast();
                    }
                }

                this.ms_btn_loading = false;
            }).catch(err => {
                this.axiosErrorLog(err);
            })
        },
        sEdit(data, row, tr, target){
            this.ms_row_instance = row;
            form.set(this.ms_input, data);
            $('#msModal').modal('show');
        },
        sRemove(data, row, tr, target){
            let id = data.id;
            swal.setTitle('Are you sure?')
                .setText("You won't be able to revert this.")
                .setIcon('warning')
                .confirm(() => {
                    target.addClass('btn-loading');
                    this.$store.dispatch('service/milestone/remove', id).then(res => {
                        console.log(res);
                        if (res) {
                            this.msInstance.row(row).remove().draw();
                            swal.setTitle('Milestone deleted successfully').setIcon('success').toast();
                        } else {
                            swal.setTitle('Unable to delete milestone due to system error. Please try again').setIcon('error').toast();
                        }
                    }).catch(err => {
                        this.axiosErrorLog(err);
                    });
                });
        },
        msTableCreated(t){
            this.msInstance = t.dataTable;
        },
        modalHidden(){
            console.log('Milestone Modal Hidden');
            this.ms_row_instance = null;
            form.clearError('.milestone')
            form.reset(this.ms_input)
        }
    }
}
</script>