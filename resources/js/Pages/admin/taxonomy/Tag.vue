<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tags</h3>

                <div class="card-options">
                    <button 
                        class="btn btn-primary btn-sm"
                        data-target="#tModal"
                        data-toggle="modal">
                        <span>
                            <i class="fe fe-plus text-white"></i>
                        </span> Add Tags
                    </button>
                </div>
            </div>
            <div class="card-body">
                <tag-table
                    ref="tTbl"
                    class-name="table table-striped table-bordered text-nowrap w-100"
                    containerClassName="table-responsive"
                    :opts="opts"
                    :fields="fields"
                    @edit="sEdit"
                    @delete="sRemove"
                    @table-created="msTableCreated" />
            </div>
        </div>

        <ms-modal
            id="tModal"
            :title="ms_modal_title"
            :centered="true"
            @hidden="modalHidden">
                <form @submit.prevent="saveTag">
                    <div class="modal-body">
                        <div class="form-group" id="tag">
                            <label for="title" class="form-control-label">Title</label>
                            <input type="text" v-model="ms_input.title" id="title" class="form-control" placeholder="tag Title">
                        </div>
                        <div class="form-group" id="tag">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea v-model="ms_input.description" id="description" class="form-control" placeholder="Write tag description..."></textarea>
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

import TagTable from 'vue-datatables-net';
import MsModal from '@/components/admin/elements/Modal';

export default {
    mixins: [errorLog],
    props: {
        tags: Array
    },
    components: {
        TagTable,
        MsModal
    },
    data() {
        return {
            id: null,
            ms_modal_title: 'Add New Tag',
            ms_btn_loading: false,
            msInstance: {},
            ms_row_instance: null,
            ms_input: {
                id: null,
                title: '',
                description: ''
            },
            opts: {
                data: this.tags,
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
        saveTag(){
            form.clearError('#tag');
            this.ms_btn_loading = true;

            this.$store.dispatch('tag/save', {
                input: this.ms_input
            }).then(res => {
                console.log(res);
                if (res.success) {
                    if (res.operation == 'create'){
                        this.msInstance.row.add(res.data).draw();
                    } else {
                        this.msInstance.row(this.ms_row_instance).data(res.data).draw();
                    }
                    $('#tModal').modal('hide');
                    swal.setTitle(res.message).setIcon('success').toast();
                } else {
                    if (res.message instanceof Object) {
                        form.showError(res.message, '#tag');
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
            this.ms_modal_title = "Update Tag"
            form.set(this.ms_input, data);
            $('#tModal').modal('show');
        },
        sRemove(data, row, tr, target){
            let id = data.id;
            swal.setTitle('Are you sure?')
                .setText("You won't be able to revert this.")
                .setIcon('warning')
                .confirm(() => {
                    target.addClass('btn-loading');
                    this.$store.dispatch('tag/remove', id).then(res => {
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
            console.log('Tag Modal Hidden');
            this.ms_row_instance = null;
            form.clearError('#tag')
            form.reset(this.ms_input)
        }
    }
}
</script>