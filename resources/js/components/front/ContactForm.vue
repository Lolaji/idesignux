<template>
    <div class="contact-form-wrapper">
        <!-- Start Contact Form -->
        <div class="axil-contact-form contact-form-style-1">
            <h3 class="title">{{title}}</h3>
            <form @submit.prevent="save">
                <div class="form-group">
                    <input type="text" v-model="input.name" id="name">
                    <label>Full Name</label>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <input type="email" v-model="input.email" id="email">
                    <label>Email</label>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <input type="text" v-model="input.company" id="company">
                    <label>Company</label>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <input type="text" v-model="input.country" id="country">
                    <label>Country</label>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <input type="text" v-model="input.phone" id="phone">
                    <label>Phone</label>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <textarea name="" v-model="input.message" id="message"></textarea>
                    <label>Message</label>
                    <span class="focus-border"></span>
                </div>
                <div class="form-group">
                    <button class="axil-button btn-large btn-transparent w-100">
                        <span class="button-text">Get Quote</span><span
                            class="button-icon"></span>
                    </button>
                </div>
            </form>
            <div class="callto-action-wrapper text-center" v-show="footer">
                <span class="text">Or call us now</span>
                <span><i class="fal fa-phone-alt"></i> <a href="#"> (234) 806 048 5046</a></span>
            </div>
        </div>
        <!-- End Contact Form -->
    </div>
</template>

<script>
import form from '@/plugin/util/Form';
import swal from '@/plugin/util/swal';

import errorLog from '@/Mixins/errorLog';

export default {
    mixins:[errorLog],
    props: {
        title: {
            type: String,
            default: () => 'Get a free quote now'
        },
        footer: {
            type: Boolean,
            default: () => false
        }
    },
    data() {
        return {
            input: {
                name: '',
                email: '',
                company: '',
                country: '',
                phone: '',
                message: ''
            }
        }
    },
    methods: {
        save() {
            this.$store.dispatch('contact/save', {input: this.input}).then(res => {
                console.log(res)
                if (res.success){
                    swal.setTitle(res.message).setIcon('success').toast();
                    form.reset(this.input);
                } else {
                    if(res.message instanceof Object){
                        form.showError(res.message);
                    } else {
                        swal.setTitle(res.message).setIcon('error').toast();
                    }
                }
            }).catch(err => {
                this.axiosErrorLog(err);
            });
        }
    }
}
</script>