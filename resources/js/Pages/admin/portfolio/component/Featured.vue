<template>
    <div>
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
                                        <h3 class="font-weight-semibold">{{f.featurable.title}}</h3>
                                        <p class="mb-lg-0 text-dark">{{f.featurable.description}}</p>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-6 text-lg-center mt-xl-4 border-left">
                                    <div class="btn-list mb-xl-0">
                                        <inertia-link
                                            :href="`/backoffice/portfolios/${f.featurable.id}`" 
                                            class="btn btn-sm btn-dark mb-xl-0">
                                            View Details
                                        </inertia-link>

                                        <button 
                                            class="btn btn-sm btn-danger mb-xl-0" 
                                            @click="remove($event, f.id, index, f.featurable)">
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
                                <small class='text-muted'>There are no featured portfolios</small>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>
<script>
import swal from '@/plugin/util/swal';
import errorLog from  '@/Mixins/errorLog';
export default {
    mixins: [errorLog],
    props: {
        features: {
            type: Array,
            default: () => []
        }
    },
    computed: {
        _portfolios(){
            return this.features;
        }
    },
    methods: {
        remove(e, id, index, featurable=null){
            let btn = $(e.target);

            btn.addClass('btn-loading');
            this.$store.dispatch('feature/remove', id).then(res => {
                if (res) {
                    this._portfolios.splice(index, 1);
                    btn.removeClass('btn-loading');
                    swal.setTitle('Featured removed').toast();
                    featurable.feature = null;
                    this.$emit('removed', featurable);
                } else {
                    swal.setTitle('Unable to remove featured portfolio due to system error. Please try again.').setIcon('error').toast();
                }
            }).catch(err => {
                this.axiosErrorLog(err);
            })
        }
    }
}
</script>