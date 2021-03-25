<template>
    <div>
        <!-- App-Header -->
        <div class="app-header header">
            <div class="container-fluid">
                <div class="d-flex">
                    <inertia-link 
                        class="header-brand d-md-none" 
                        href="/backoffice/dashboard">
                            <img src="/images/logo/idesignux-logo-blue.png" class="header-brand-img mobile-icon" alt="logo">
                            <img src="/images/logo/idesignux-logo-blue.png" class="header-brand-img desktop-logo mobile-logo" alt="logo">
                    </inertia-link>
                    <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 15v2H5v-2h14m2-10H3v2h18V5zm0 4H3v2h18V9zm0 4H3v6h18v-6z"/><path d="M5 15h14v2H5z" opacity=".3"/></svg>
                    </a><!-- sidebar-toggle-->
                    <div class="header-search d-none d-md-flex">
                        <form class="form-inline">
                            <div class="search-element">
                                <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
                                <button class="btn btn-primary-color" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex ml-auto header-right-icons header-search-icon">
                        <button class="navbar-toggler navresponsive-toggler d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                            aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="navbar-toggler-icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        </button>
                        <div class="dropdown d-none d-lg-flex">
                            <a class="nav-link icon full-screen-link nav-link-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="fullscreen-button"><path d="M0 0h24v24H0V0z" fill="none"/><circle cx="12" cy="12" opacity=".3" r="3"/><path d="M7 12c0 2.76 2.24 5 5 5s5-2.24 5-5-2.24-5-5-5-5 2.24-5 5zm8 0c0 1.65-1.35 3-3 3s-3-1.35-3-3 1.35-3 3-3 3 1.35 3 3zM3 19c0 1.1.9 2 2 2h4v-2H5v-4H3v4zM3 5v4h2V5h4V3H5c-1.1 0-2 .9-2 2zm18 0c0-1.1-.9-2-2-2h-4v2h4v4h2V5zm-2 14h-4v2h4c1.1 0 2-.9 2-2v-4h-2v4z"/></svg>
                            </a>
                        </div>
                        <!--/ FULL-SCREEN -->

                        <!-- NOTIFICATIONS -->
                        <div class="dropdown d-none d-md-flex notifications">
                            <a class="nav-link icon" data-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6.5c-2.49 0-4 2.02-4 4.5v6h8v-6c0-2.48-1.51-4.5-4-4.5z" opacity=".3"/><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/></svg>
                                <span class="pulse1 bg-success"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <div class="notifications-menu">
                                    <a class="dropdown-item d-flex pb-4" href="#">
                                        <span class="avatar mr-3 br-3 align-self-center avatar-md cover-image bg-primary brround">
                                            <i class="fe fe-mail"></i></span>
                                        <div>
                                            <span class="font-weight-bold"> Commented on your post </span>
                                            <div class="small text-muted d-flex">
                                                3 hours ago
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex pb-4" href="#">
                                        <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-secondary brround">
                                            <i class="fe fe-download"></i>
                                        </span>
                                        <div>
                                            <span class="font-weight-bold"> New file has been Uploaded </span>
                                            <div class="small text-muted d-flex">
                                                5 hour ago
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex pb-4" href="#">
                                        <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-warning brround">
                                            <i class="fe fe-user"></i>
                                        </span>
                                        <div>
                                            <span class="font-weight-bold"> User account has Updated</span>
                                            <div class="small text-muted d-flex">
                                                20 mins ago
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex pb-4" href="#">
                                        <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-info brround">
                                            <i class="fe fe-shopping-cart"></i>
                                        </span>
                                        <div>
                                            <span class="font-weight-bold"> New Order Recevied</span>
                                            <div class="small text-muted d-flex">
                                                1 hour ago
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex pb-4" href="#">
                                        <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-danger brround">
                                            <i class="fa fa-commenting-o"></i>
                                        </span>
                                        <div>
                                            <span class="font-weight-bold"> 3 New Comments</span>
                                            <div class="small text-muted d-flex">
                                                1 day ago
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex pb-4" href="#">
                                        <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-success brround">
                                            <i class="fe fe-server"></i>
                                        </span>
                                        <div>
                                            <span class="font-weight-bold">Server Rebooted</span>
                                            <div class="small text-muted d-flex">
                                                2 hour ago
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item text-center">View all Notification</a>
                            </div>
                        </div>
                        <!--/ NOTIFICATIONS -->

                        <!-- MESSAGE-BOX -->
                        <div class="dropdown d-none d-md-flex message">
                            <a class="nav-link icon text-center" data-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg>
                                
                                <span class="nav-unread badge badge-danger badge-pill pulse" v-if="count.message > 0">{{count.message}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" id="message">
                                <div class="message-menu">
                                    <inertia-link 
                                        v-for="(contact, index) in messages"
                                        :key="index"
                                        class="dropdown-item d-flex pb-3" 
                                        href="/backoffice/contacts">
                                            <span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="/images/users/1.jpg"></span>
                                            <div>
                                                <strong>{{contact.name}}</strong> {{contact.message | limit}}
                                                <div class="small text-muted">
                                                    {{contact.created_at | msgDate}}
                                                </div>
                                            </div>
                                    </inertia-link>

                                    <div
                                        v-if="messages.length == 0"
                                        class="dropdown-item d-flex pb-3">
                                        <strong>There are no new contacts</strong>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <inertia-link 
                                    href="/backoffice/contacts" 
                                    class="dropdown-item text-center">See all Contacts</inertia-link>
                            </div>
                        </div>
                        <!--/ MESSAGE-BOX -->

                        <!-- User widget -->
                        <div class="dropdown profile-1">
                            <a href="#" data-toggle="dropdown" class="nav-link pl-2 pr-2  leading-none d-flex">
                                <span>
                                    <img src="/images/users/10.jpg" alt="profile-user" class="avatar  mr-xl-3 profile-user brround cover-image">
                                </span>
                                <div class="text-center mt-2 d-none d-xl-block">
                                    <h6 class="text-dark mb-0 fs-13 font-weight-semibold">{{_user.name}}</h6>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon mdi mdi-account-outline"></i> My Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon zmdi zmdi-edit"></i> Edit Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon  mdi mdi-settings"></i> Account Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <span class="float-right"></span>
                                    <i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?
                                </a>
                                <form method="POST" @submit.prevent="logout">
                                    <!-- <a class="dropdown-item" href="login.html">
                                        <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                                    </a> -->
                                    <button class="dropdown-item">
                                        <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!--/ User widget -->

                        <div class="dropdown d-md-flex header-settings">
                            <a href="#" class="nav-link icon " data-toggle="sidebar-right" data-target=".sidebar-right">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 15v2H5v-2h14m2-10H3v2h18V5zm0 4H3v2h18V9zm0 4H3v6h18v-6z"/><path d="M5 15h14v2H5z" opacity=".3"/></svg>
                            </a>
                        </div><!-- SIDE-MENU -->
                    </div>
                </div>
            </div>
        </div>

        <!-- responsive-navbar -->
        <div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <div class="d-flex order-lg-2 ml-auto">
                    <div class="dropdown d-sm-flex">
                        <a href="#" class="nav-link icon" data-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                        </a>
                        <div class="dropdown-menu header-search dropdown-menu-left">
                            <div class="input-group w-100 p-2">
                                <input type="text" class="form-control " placeholder="Search....">
                                <div class="input-group-append ">
                                    <button type="button" class="btn btn-primary ">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><!-- SEARCH -->
                    
                    <div class="dropdown d-md-flex">
                        <a class="nav-link icon full-screen-link nav-link-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="fullscreen-button"><path d="M0 0h24v24H0V0z" fill="none"/><circle cx="12" cy="12" opacity=".3" r="3"/><path d="M7 12c0 2.76 2.24 5 5 5s5-2.24 5-5-2.24-5-5-5-5 2.24-5 5zm8 0c0 1.65-1.35 3-3 3s-3-1.35-3-3 1.35-3 3-3 3 1.35 3 3zM3 19c0 1.1.9 2 2 2h4v-2H5v-4H3v4zM3 5v4h2V5h4V3H5c-1.1 0-2 .9-2 2zm18 0c0-1.1-.9-2-2-2h-4v2h4v4h2V5zm-2 14h-4v2h4c1.1 0 2-.9 2-2v-4h-2v4z"/></svg>
                        </a>
                    </div><!-- FULL-SCREEN -->
                    <div class="dropdown d-md-flex notifications">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 6.5c-2.49 0-4 2.02-4 4.5v6h8v-6c0-2.48-1.51-4.5-4-4.5z" opacity=".3"/><path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.63-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.64 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2zm-2 1H8v-6c0-2.48 1.51-4.5 4-4.5s4 2.02 4 4.5v6z"/></svg>
                            <span class="pulse1 bg-success"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <div class="notifications-menu">
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar mr-3 br-3 align-self-center avatar-md cover-image bg-primary brround">
                                        <i class="fe fe-mail"></i></span>
                                    <div>
                                        <span class="font-weight-bold"> Commented on your post </span>
                                        <div class="small text-muted d-flex">
                                            3 hours ago
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-secondary brround">
                                        <i class="fe fe-download"></i>
                                    </span>
                                    <div>
                                        <span class="font-weight-bold"> New file has been Uploaded </span>
                                        <div class="small text-muted d-flex">
                                            5 hour ago
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-warning brround">
                                        <i class="fe fe-user"></i>
                                    </span>
                                    <div>
                                        <span class="font-weight-bold"> User account has Updated</span>
                                        <div class="small text-muted d-flex">
                                            20 mins ago
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-info brround">
                                        <i class="fe fe-shopping-cart"></i>
                                    </span>
                                    <div>
                                        <span class="font-weight-bold"> New Order Recevied</span>
                                        <div class="small text-muted d-flex">
                                            1 hour ago
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-danger brround">
                                        <i class="fa fa-commenting-o"></i>
                                    </span>
                                    <div>
                                        <span class="font-weight-bold"> 3 New Comments</span>
                                        <div class="small text-muted d-flex">
                                            1 day ago
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex pb-4" href="#">
                                    <span class="avatar avatar-md br-3 mr-3 align-self-center cover-image bg-success brround">
                                        <i class="fe fe-server"></i>
                                    </span>
                                    <div>
                                        <span class="font-weight-bold">Server Rebooted</span>
                                        <div class="small text-muted d-flex">
                                            2 hour ago
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-center">View all Notification</a>
                        </div>
                    </div><!-- NOTIFICATIONS -->

                    <div class="dropdown d-md-flex message">
                        <a class="nav-link icon text-center" data-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg>
                            <span class="nav-unread badge badge-danger badge-pill pulse" v-if="count.message > 0">{{count.message}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" id="responsiveMessage">
                            <div class="message-menu">
                                <a 
                                    v-for="(msg, index) in messages"
                                    :key="index"
                                    class="dropdown-item d-flex pb-3" 
                                    href="#">
                                    <span class="avatar avatar-md brround mr-3 align-self-center cover-image" data-image-src="/images/users/1.jpg"></span>
                                    <div>
                                        <strong>{{msg.name}}</strong> {{msg.message | limit}}
                                        <div class="small text-muted">
                                            {{msg.created_at | msgDate}}
                                        </div>
                                    </div>
                                </a>

                                <div
                                    v-if="messages.lenght == 0"
                                    class="dropdown-item d-flex pb-3">
                                    <strong>There are no new contacts</strong> 
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-center">See all Messages</a>
                        </div>
                    </div>
                    <!--/ MESSAGE-BOX -->

                </div>
            </div>
        </div>
        <!-- End responsive-navbar -->
        <!-- App-Header -->
    </div>
</template>
<script>
import { FullScreen } from '@/plugin/admin/main';

import filters from '@/plugin/util/filters';
export default {
    filters: filters,
    computed: {
        _user(){
            return this.$page.props.user;
        }
    },
    data(){
        return {
            count: {
                notification: 0,
                message: 0
            },
            loading: {
                message: false,
            },
            notification: [],
            messages: []
        }
    },
    methods: {
        contactListener(){
            Echo.private('contact')
                .listen('ContactEvent', (res) => {
                    let contact = res.contact;
                    console.log(res);
                    this.messages.unshift({
                        id: contact.id,
                        name: contact.name,
                        message: contact.message,
                        created_at: contact.created_at
                    });
                    this.count.message+=1;
                    
                });
        },
        logout(){
            axios.post(route('logout').url()).then(response => {
                window.location = '/backoffice/login';
            });
        },
        fetchUnreadContacts () {
            let query = {
                where: JSON.stringify([['read', 0]]),
                fields: ['id', 'name', 'message', 'created_at'],
                // sort: 'created_at',
                limit: 10
            }
            this.$store.dispatch('contact/get', query).then(res => {
                this.messages = res;
                this.count.message = res.length;
            });
        }
    },
    created(){
        FullScreen();
        this.fetchUnreadContacts();
        this.contactListener();
    },
    mounted(){
        $('.dropdown.message').on('shown.bs.dropdown', (e) => {
            this.count.message = 0;
        });
    }
}
</script>