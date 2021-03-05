<template>
    <div>
        <!--APP-SIDEBAR-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
            <div class="side-header">
                <inertia-link class="header-brand1" href="/backoffice/dashboard">
                    <img src="/images/logo/idesignux-logo-blue.png" class="header-brand-img desktop-logo" alt="logo">
                    <img src="/images/logo/idesignux-logo-blue.png" class="header-brand-img toggle-logo" alt="logo">
                    <img src="/images/logo/idesignux-logo-blue.png" class="header-brand-img light-logo" alt="logo">
                    <img src="/images/logo/idesignux-logo-blue.png" class="header-brand-img light-logo1" alt="logo">
                </inertia-link>
                <a >
                    <!-- <img src="/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                    <img src="/images/brand/logo-1.png" class="header-brand-img toggle-logo" alt="logo">
                    <img src="/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                    <img src="/images/brand/logo-3.png" class="header-brand-img light-logo1" alt="logo"> -->
                </a><!-- LOGO -->
            </div>
            <ul class="side-menu">
                <li><h3>Main</h3></li>
                <li class="slide">
                    <a class="side-menu__item"  data-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 4h18v10H3z" opacity=".3"/><path d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7l-2 3v1h8v-1l-2-3h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 12H3V4h18v10z"/></svg>
                        <span class="side-menu__label">Dashboard</span><i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="index.html"><span>Sales Dashboard</span></a></li>
                        <li><a class="slide-item"  href="index2.html"><span>Marketing Dashboard</span></a></li>
                        <li><a class="slide-item" href="index3.html"><span>App Dashboard</span></a></li>
                        <li><a class="slide-item" href="index4.html"><span>LMS Dashboard</span></a></li>
                        <li><a class="slide-item" href="index5.html"><span>Analytics Dashboard</span></a></li>
                    </ul>
                </li>

                <!-- Service -->
                <li class="slide">
                    <inertia-link
                        href="/backoffice/services"
                        class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                        <span class="side-menu__label">Services</span>
                    </inertia-link>
                </li>

                <!-- Portfolio -->
                <li class="slide">
                    <inertia-link
                        href="/backoffice/portfolios"
                        class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                        <span class="side-menu__label">Portfolios</span>
                    </inertia-link>

                <!-- Contacts -->
                <li class="slide">
                    <inertia-link
                        href="/backoffice/contacts"
                        class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"></path></svg>
                        <span class="side-menu__label">Contacts</span>
                    </inertia-link>
                </li>

                <!-- Contacts -->
                <li class="slide">
                    <inertia-link
                        href="/backoffice/posts"
                        class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"></path></svg>
                        <span class="side-menu__label">Post</span>
                    </inertia-link>
                </li>

                <!-- Taxonomies -->
                <li class="slide">
                    <inertia-link
                        href="/backoffice/taxonomies"
                        class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"></path></svg>
                        <span class="side-menu__label">Taxonomies</span>
                    </inertia-link>
                </li>

                <!-- Mailing List -->
                <li class="slide">
                    <inertia-link
                        href="/backoffice/review"
                        class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"></path></svg>
                        <span class="side-menu__label">Review</span>
                    </inertia-link>
                </li>

                <!-- Mailing List -->
                <li class="slide">
                    <inertia-link
                        href="/backoffice/mailing_list"
                        class="side-menu__item">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"></path></svg>
                        <span class="side-menu__label">Mailing List</span>
                    </inertia-link>
                </li>

                <li><h3>Widgets & Maps, Mails</h3></li>
                <li class="slide">
                    <a class="side-menu__item" href="widgets.html">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24" class="side-menu__icon"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                        <span class="side-menu__label">Widgets</span>
                    </a>
                </li>
            </ul>
        </aside>
        <!--/APP-SIDEBAR-->
    </div>
</template>

<script>
window.PerfectScrollbar = require('../../../../assets/plugins/p-scroll/perfect-scrollbar.min');
import {SideMenu, ActivateSidebarScroll} from '@/plugin/admin/main';
export default {
    mounted(){
        SideMenu();
        ActivateSidebarScroll();
    }
}
</script>
