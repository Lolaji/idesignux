<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{cardTitle}}</h3>

                <div class="card-options">
                    <slot name="card-option">
                        <button 
                            class="btn btn-primary btn-sm"
                            @click="openModal">
                            <span>
                                <i class="fe fe-plus text-white"></i>
                            </span> Add {{ name | titleCase }}
                        </button>
                    </slot>
                </div>
            </div>
            <div class="card-body">
                <milestone-table
                    ref="msTbl"
                    class-name="table table-striped table-bordered text-nowrap w-100"
                    containerClassName="table-responsive"
                    :opts="opts"
                    :fields="fields"
                    @edit="edit"
                    @delete="remove"
                    @table-created="tableCreated" />
            </div>
        </div>

        <ms-modal
            :id="name"
            :ref="name"
            :title="modal_title"
            x-class="fade"
            :centered="true"
            @hidden="modalHidden">
                <form @submit.prevent="save">
                    <div class="modal-body">
                        <div :class="`form-group ${name}`">
                            <label for="title" class="form-control-label">Title</label>
                            <input type="text" v-model="ms_input.title" id="title" class="form-control" placeholder="Title">
                        </div>
                        <div :class="`form-group ${name}`">
                            <label for="description" class="form-control-label">Description</label>
                            <textarea v-model="ms_input.description" id="description" class="form-control" placeholder="Write description..."></textarea>
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
                            :class="{'btn-loading': btn_loading}">
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
import filters from '@/plugin/util/filters';

import errorLog from '@/Mixins/errorLog';

import MilestoneTable from 'vue-datatables-net';
import MsModal from '@/components/admin/elements/Modal';

export default {
    mixins: [errorLog],
    filters: filters,
    props: {
        name: {
            type:String,
            required: true
        },
        tableData: Array,
        parentId: [String, Number],
        cardTitle: String,
        tableFields: Object,
        saveStorePath: {
            type: String,
            required: true
        },
        removeStorePath: {
            type: String,
            required: true
        },

    },
    components: {
        MilestoneTable,
        MsModal
    },
    data() {
        return {
            id: null,
            modal_title: `Add New ${_.startCase(this.name)}`,
            btn_loading: false,
            Instance: {},
            row_instance: null,
            ms_input: {
                id: null,
                title: '',
                description: ''
            },
            opts: {
                data: this.tableData,
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
                description: {
                    label: "Description", 
                    sortable:true, 
                    seachable:true,
                    render: (data) => _.truncate(data, {length: 45, separator: / /, omission: '...'})
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
        save(){
            form.clearError(`.${this.name}`);
            this.btn_loading = true;

            this.$store.dispatch(this.saveStorePath, {
                service_id: this.parentId,
                input: this.ms_input
            }).then(res => {
                console.log(res);
                if (res.success) {
                    if (res.operation == 'create'){
                        this.Instance.row.add(res.data).draw();
                    } else {
                        this.Instance.row(this.row_instance).data(res.data).draw();
                    }
                    $(this.$refs[this.name].$el).modal('hide');
                    swal.setTitle(res.message).setIcon('success').toast();
                } else {
                    if (res.message instanceof Object) {
                        form.showError(res.message, `.${this.name}`);
                    } else {
                        swal.setTitle(res.message).setIcon('error').toast();
                    }
                }

                this.btn_loading = false;
            }).catch(err => {
                this.axiosErrorLog(err);
            })
        },
        openModal(){
            $(this.$refs[this.name].$el).modal('show');
        },
        edit(data, row, tr, target){
            this.row_instance = row;
            form.set(this.ms_input, data);
            this.modal_title = `Updating ${_.startCase(this.name)}`;
            $(this.$refs[this.name].$el).modal('show');
        },
        remove(data, row, tr, target) {
            let id = data.id;
            swal.setTitle('Are you sure?')
                .setText("You won't be able to revert this.")
                .setIcon('warning')
                .confirm(() => {
                    target.addClass('btn-loading');
                    this.$store.dispatch(this.removeStorePath, id).then(res => {
                        console.log(res);
                        if (res) {
                            this.Instance.row(row).remove().draw();
                            swal.setTitle(`${_.startCase(this.name)} deleted successfully`).setIcon('success').toast();
                        } else {
                            swal.setTitle(`Unable to delete ${this.name} due to system error. Please try again.`).setIcon('error').toast();
                        }
                    }).catch(err => {
                        this.axiosErrorLog(err);
                    });
                });
        },
        tableCreated(t){
            this.Instance = t.dataTable;
        },
        modalHidden(){
            this.row_instance = null;
            this.modal_title = `Add New ${_.startCase(this.name)}`;
            form.clearError(`.${this.name}`)
            form.reset(this.ms_input)
        }
    },
    created(){
        if (!_.isNil (this.tableFields)) {
            this.fields = this.tableFields;
        }
    }
}
</script>