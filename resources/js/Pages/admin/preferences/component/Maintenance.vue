<template>
    <div class="card">
        <form @submit.prevent="save">
            <div class="card-body">
                <div class="col-12 border-bottom">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="font-weight-bold">Maintenance Mode</h4>
                            <p class="text-muted">Only the admin can browse through the site on maintenance mode.</p>
                        </div>
                        <div class="col-6">
                            <label class="custom-switch">
                                <input 
                                    type="checkbox" 
                                    v-model="input.in_maintenance" 
                                    class="custom-switch-input"
                                    :disabled="loading">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer border-top">
                <button 
                    type="submit" 
                    class="btn btn-dark btn-sm btn-icon" 
                    :class="{'btn-loading': loading}">
                    <span>
                        <i class="fe fe-save text-white"></i>
                    </span> SAVE
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import swal from '@/plugin/util/swal';
import errorLog from '@/Mixins/errorLog';

export default {
    mixins: [errorLog],
    props: {
        modelId: {
            type: [String, Number],
            required: true
        },
        payload: {
            required: true
        }
    },
    data(){
        return {
            loading: false,
            input: {
                in_maintenance: false
            }
        }
    },
    methods: {
        save() {
            this.loading = true;
            
            this.$store.dispatch('preference/save', {
                id: this.modelId,
                settings: {
                    maintenance: this.input
                }
            }).then(res => {
                console.log(res);
                this.loading = false;
            }).catch(err => {
                this.axiosErrorLog(err, true);
            })
        }
    },
    created(){
        if (!_.isNull(this.payload)) {
            this.input = this.payload.maintenance;
        }
    }
}
</script>
