<template>
    <idx-admin-layout>

        <idx-page-header>
            <span slot="title">{{page_title}}</span>

            <ol slot="breadcrumb" class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales Dashboard</li>
            </ol>

            <div class="btn-list">
                <!-- <inertia-link
                    href="/backoffice/portfolios/create"
                    class="btn btn-info btn-icon text-white" 
                    data-toggle="tooltip" 
                    title="Add New Services" 
                    data-placement="top">
                        <span>
                            <i class="fe fe-plus"></i>
                        </span> Add New Portfolio
                </inertia-link> -->
            </div>
        </idx-page-header>

        <div class="row">
            <div class="col-md-12 col-lg-12">
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
                                            v-for="(c, index) in _contacts"
                                            :key="index"
                                            :class="{unread: !c.read}"
                                            @dblclick="view(c)">
                                            <td class="inbox-small-cells">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input contact" name="example-checkbox1" value="option1">
                                                    <span class="custom-control-label"></span>
                                                </label>
                                            </td>
                                            <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                            <td class="view-message  dont-show">{{c.name}}</td>
                                            <td class="view-message">{{c.message | limit(50)}}</td>
                                            <td class="view-message inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                            <td class="view-message text-right">{{c.created_at | msgDate}}</td>
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
            </div><!-- COL-END -->
        </div>
        
        <contact-modal
            id="cModal"
            x-class="fade"
            title="Contact Detail"
            :centered="true"
            :scrollable="true"
            @shown="modalShown"
            @hidden="modalHidden">
                <div slot="header" class="media mt-0">
                    <div class="mr-3">
                        <img alt="avatar" class="avatar avatar-md brround" src="/images/users/10.jpg">
                    </div>
                    <div class="media-body tx-inverse">
                        <div class="float-right d-none d-md-flex fs-15 mt-4">
                            <small class="mr-2"><i class="fe fe-paperclip mr-2"></i> {{contact.created_at | moment("MMMM D, YYYY hh:mm a")}} </small>
                            <small class="mr-2"><i class="fe fe-star" data-toggle="tooltip" title="" data-original-title="Rated"></i></small>
                            <small class="mr-2"><i class="fa fa-reply" data-toggle="tooltip" title="" data-original-title="Reply"></i></small>
                            <div class="mr-2">
                                <a href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fe fe-more-horizontal text-dark" data-toggle="tooltip" title="" data-original-title="View more"></i></a>
                                <div class="dropdown-menu dropdown-menu-right shadow">
                                    <a class="dropdown-item" href="#">Reply</a>
                                    <a class="dropdown-item" href="#">Report Spam</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <a class="dropdown-item" href="#">Show Original</a>
                                    <a class="dropdown-item" href="#">Print</a>
                                    <a class="dropdown-item" href="#">Filter</a>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="media-title font-weight-semiblod mt-2">{{contact.name}}
                            <p class="mb-0 text-muted">{{contact.email}} </p>
                            <small class="mr-2 d-md-none">May 2, 2020 12:45 pm</small>
                            <small class="mr-2 d-md-none"><i class="fe fe-star" data-toggle="tooltip" title="" data-original-title="Rated"></i></small>
                            <small class="mr-2 d-md-none"><i class="fa fa-reply" data-toggle="tooltip" title="" data-original-title="Reply"></i></small>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="eamil-body">
                        <p>{{contact.message}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-list text-right">
                        <a class="btn btn-sm btn-primary mt-1 mb-1" href="#"><i class="fa fa-reply"></i> Reply</a>
                        <a class="btn btn-sm btn-secondary mt-1 mb-1" href="#"><i class="fa fa-share"></i> Forward</a>
                    </div>
                </div>
            
        </contact-modal>

    </idx-admin-layout>
</template>

<script>
import Vue from 'vue';
import form from '@/plugin/util/Form';
import swal from '@/plugin/util/swal';

// Mixins
import errorLog from '@/Mixins/errorLog';

// Filters
import filters from '@/plugin/util/filters';

import idxAdminLayout from '@/Layouts/AdminLayout';
import idxPageHeader from '@/components/admin/parts/PageHeader';
import contactModal from '@/components/admin/elements/Modal';

Vue.use(require('vue-moment'));

export default {
    mixins: [errorLog],
    filters: filters,
    props: {
        page_title: String,
        contacts: Array
    },
    components: {
        idxAdminLayout,
        idxPageHeader,
        contactModal
    },
    computed: {
        _contacts(){
            return this.contacts;
        }
    },
    data(){
        return {
            rowSelected: [],
            contact: {},
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
            this.contact = data;
            $('#cModal').modal('show');
        },
        remove(data, row, tr, target){
            let id = data.id;
            swal.setTitle('Are you sure?')
                .setText("You won't be able to revert this.")
                .setIcon('warning')
                .confirm(() => {
                    target.addClass('btn-loading');
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
        modalShown(e){
            if (!this.contact.read){
                this.contact.read = true;
                this.$store.dispatch('contact/save', {
                    id: this.contact.id,
                    input: {read: 1}
                });
            }
        },
        modalHidden(e){
            this.contact = {};
        },
        listen(){
            Echo.channel('contact')
                .listen('ContactEvent', (res) => {
                    this._contacts.unshift(res.contact);
                });
        }
    },
    mounted(){
        form.checkAll('#checkAll', '.contact', (arr) => {
            this.rowSelected = arr;
        });
    }
}
</script>