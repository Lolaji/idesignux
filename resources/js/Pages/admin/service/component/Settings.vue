<template>
    <div class="card">
        <form @submit.prevent="save">
            <div class="card-body">
                <div class="col-12 border-bottom">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="font-weight-bold">Service Availability</h4>
                            <p class="text-muted">Visitors will not be able to view this service when switched off</p>
                        </div>
                        <div class="col-6">
                            <label class="custom-switch">
                                <input 
                                    type="checkbox" 
                                    v-model="input.settings.is_published" 
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

export default {
    props: {
        modelId: {
            type: [String, Number],
            required: true
        },
        modelName: {
            type: String,
            // required: true
        },
        payload: {
            type: Object,
        }
    },
    data(){
        return {
            loading: false,
            input: {
                settings: {
                    is_published: false,
                }
            }
        }
    },
    methods: {
        save() {
            this.loading = true;
            this.input.id = this.modelId;
            this.$store.dispatch('service/save', {
                input: this.input
            }).then(res => {
                console.log(res)
                if(res.success) {
                    swal.setTitle('Saved').setIcon('success').toast();
                } else {
                    swal.setTitle(res.message).setIcon('success').toast();
                }
                this.loading = false;
            }).catch(err => {
                if (err.response)
                    console.error(err.response.data);
            });
        }
    },
    created() {
        if (!_.isNil(this.payload)) {
            this.input.settings = this.payload;
        }
    }
}
</script>
