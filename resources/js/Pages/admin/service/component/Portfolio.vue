<template>
    <div>
        <div class="card bg-transparent border-0">
            <div class="card-body">
                <button
                    class="btn btn-primary btn-sm float-right"
                    @click="openModal">Select Portfolio</button>
            </div>
        </div>
        <transition-group
            enter-active-class="animate__animated animate__fadeInLeft"
            leave-active-class="animate__animated animate__fadeOutRight animate__faster">
            <div 
                v-for="(f, index) in _portfolios"
                :key="f.id"
                class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-2 text-center">
                            <img src="/images/blog/author-01.jpg" alt="img" class="w-30">
                        </div>
                        <div class="col-xl-9 col-lg-10 pl-lg-0">
                            <div class="row">
                                <div class="col-xl-7 col-lg-6">
                                    <div class="text-left text-dark">
                                        <h3 class="font-weight-semibold">{{f.title}}</h3>
                                        <p class="mb-lg-0 text-dark">{{f.description}}</p>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-6 text-lg-center mt-xl-4 border-left">
                                    <div class="btn-list mb-xl-0">
                                        <inertia-link
                                            :href="`/backoffice/portfolios/${f.id}`" 
                                            class="btn btn-sm btn-dark mb-xl-0">
                                            View Details
                                        </inertia-link>

                                        <button 
                                            class="btn btn-sm btn-danger mb-xl-0" 
                                            @click="remove($event, f.id, index)">
                                            <i class="fe fe-x text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition-group>

        <transition
            enter-active-class="animate__animated animate__fadeIn animate__delay-1s"
            leave-active-class="animate__animated animate__fadeOutRight">
            <div class="card" v-if="_portfolios.length == 0">
                <div class="card-body">
                    <div class="col-12">
                        <div class="row justify-content-center">
                            <h1 class="text-center">
                                <span class="font--50">
                                    <i class="fe fe-feather text-dark"></i>
                                </span><br>
                                <small class='text-muted'>There are no selected portfolios</small>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </transition>

         <p-modal
            id="portfolio"
            ref="pModal"
            title="Select Portfolio"
            x-class="fade"
            :centered="true"
            @hidden="modalHidden">
                <form @submit.prevent="save">
                    <div class="modal-body">
                        <portfolio-select 
                            v-model="input.attach" 
                            :options="options"
                            :settings="settings"
                            placeholder="Select Portfolios" />

                            <span ref="deatachError" class="text-danger"></span>
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
        </p-modal>
    </div>
</template>
<script>
import swal from '@/plugin/util/swal';
import errorLog from  '@/Mixins/errorLog';

import PModal from '@/components/admin/elements/Modal';
import PortfolioSelect from 'v-select2-component';

export default {
    mixins: [errorLog],
    props: {
        serviceId: Number,
        portfolios: {
            type: Array,
            default: () => []
        }
    },
    components:{
        PModal,
        PortfolioSelect,
    },
    computed: {
        _portfolios(){
            return this.portfolios;
        }
    },
    data() {
        return {
            btn_loading: false,
            input: {
                attach: [],
                detach: []
            },
            settings: {
                multiple: true,
                width: '100%',
            },
            options: []
        }
    },
    methods: {
        save(){
            this.btn_loading = true;

            this._deattach('sync', this.input.attach);
        },
        openModal(){
            $(this.$refs.pModal.$el).modal('show');
        },
        async remove(e, id, index){
            let btn = $(e.target);

            btn.addClass('btn-loading');
            await this._deattach('detach', id, index);
        },
        _deattach(operation, value, index=null) {
            this.$refs.deatachError.innerHTML = "";
            this.$store.dispatch('service/deattach', {
                service_id: this.serviceId,
                relationship: 'portfolios',
                input: {
                    value: value,
                    operation: operation
                }
            }).then(res => {
                console.log(res);
                if (res.success){
                    if (operation == 'attach') {
                        this._portfolios.push(res.data);
                    } 
                    
                    if(operation == 'detach') {
                        if (!_.isNull(index)) {
                            this._portfolios.splice(index, 1);
                            let without = _.without(this.input.attach, value);
                            console.log(without)
                            this.input.attach = without;
                        }
                    }

                    if (operation == 'sync') {
                        let detached = res.hook.detached;
                        let attached = res.hook.attached;

                        if (!_.isEmpty(detached)) {
                            Object.entries(detached).forEach(([index, value]) => {
                                let found_index = _.findIndex(this._portfolios, (v) => v.id == value);
                                console.log(found_index);
                                this._portfolios.splice(found_index, 1);
                            });
                        }

                        if (!_.isEmpty(attached)) {
                            Object.entries(attached).forEach(([key, value]) => {
                                console.log(value);
                                this._portfolios.push(value);
                            });
                        }
                    }
                } else {
                    if (res.message == 'empty-value') {
                        this.$refs.deatachError.innerHTML = "This field must not be empty";
                    }
                }
                this.btn_loading=false;
            }).catch(err => {
                this.axiosErrorLog(err);
            });
        },
        modalHidden(e){

        },
        fetchPortfolios(){
            let query = {
                // where: JSON.stringify([['read', 0]]),
                fields: ['id', 'title'],
                sort: 'id',
                // limit: 10
            }
            this.$store.dispatch('portfolio/fetch', query).then(res => {
                console.log(res);
                _.map(res, (elem) => {
                    this.options.push({
                        id: elem.id,
                        text: elem.title
                    });
                })
            }).catch(err => {
                this.axiosErrorLog(err);
            });
        }
    },
    created(){
        this.fetchPortfolios();
        if (!_.isNil(this.portfolios)) {
            _.map(this.portfolios, (elem) => {
                this.input.attach.push(elem.id);
                // this.old_select.push(elem.id);
            });
        }
    }
}
</script>