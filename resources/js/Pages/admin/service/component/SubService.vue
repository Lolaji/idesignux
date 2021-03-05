<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sub Services</h3>

            <div class="card-options">
                <inertia-link
                    :href="`/backoffice/services/${serviceId}/create`"
                    class="btn btn-sm btn-primary btn-icon">
                        <span><i class="fe fe-plus-circle text-white"></i></span> 
                        Add Sub-Service
                </inertia-link>
            </div>
        </div>
        <div class="card-body">
            <sub-service-table
                ref="ssTbl"
                class-name="table table-striped table-bordered text-nowrap w-100"
                containerClassName="table-responsive"
                :opts="opts"
                :fields="fields"
                @edit="sEdit"
                @delete="sRemove"
                @table-created="tableCreated" />
        </div>
    </div>
</template>

<script>
import swal from '@/plugin/util/swal';

import errorLog from '@/Mixins/errorLog';

import SubServiceTable from 'vue-datatables-net';

export default {
    mixins:[errorLog],
    props: {
        services: Array,
        serviceId: [String, Number]
    },
    components: {
        SubServiceTable
    },
    data() {
        return {
            sInstance: {},
            opts: {
                data: this.services,
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
                    render: (data) => {
                        return _.truncate(data, {
                            length: 45, separator: / /, omission: '...'
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
                                        <i class="fa fa-pencil text-white" data-action="edit"></i>
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
        sEdit(data){
            this.$inertia.visit(`/backoffice/services/${this.serviceId}/${data.id}`);
        },
        sRemove(data, row, tr, target){
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
        tableCreated(t) {
            this.sInstance = t.dataTable;
        }
    }
}
</script>