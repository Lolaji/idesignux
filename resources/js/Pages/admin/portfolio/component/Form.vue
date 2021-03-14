<template>
    <form @submit.prevent="save">
            
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">General</h3>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" v-model="input.title" id="title" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="input.description" id="description" class="form-control" placeholder="Write a decription..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4 border-top pt-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <file-explorer
                                        :multiple="true"
                                        @selected="fileSelected"></file-explorer>
                                </div>
                                <div class="col-md-9">
                                    
                                    <div 
                                        is="transition-group"
                                        enter-active-class="animate__animated animate__fadeIn"
                                        leave-active-class="animate__animated animate__fadeOut"
                                        class="row">
                                            <div 
                                                v-for="(file, index) in input.images"
                                                :key="index"
                                                class="col-xl-3">
                                                    <button 
                                                        type="button"
                                                        class="btn btn-sm btn-dark rounded-circle position-absolute position-to-top"
                                                        @click="removeImage($event, file, index)">
                                                        <i class="fe fe-x text-white"></i>
                                                    </button>
                                                    <a :href="file.url" target="__blank" class="thumbnail ">
                                                        <img :src="file.url" alt="thumb1" class="thumbimg">
                                                    </a>
                                                    <select v-model="file.data.name" class="form-control form-control-sm mb-1">
                                                        <option value="header">Header</option>
                                                        <option value="overview">Overview</option>
                                                        <option value="gallery">Gallery</option>
                                                    </select>

                                                    <input type="text" v-model="file.data.description" class="form-control form-control-sm" placeholder="enter description">
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            v-if="!isUpdate" 
            class="card">
            <div class="card-header">
                <h3 class="card-title">SEO</h3>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="meta-data">
                        <h4>Metadata</h4>
                        <div class="form-group"
                            v-for="(m, index) in input.metadatas"
                            :key="index">
                            <div class="row">
                                <div class="col-md-4">
                                    <select v-model="input.metadatas[index].name" required id="meta_name" class="form-control">
                                        <option value="">-- Select Metadatas Name --</option>
                                        <option value="robots">Robots</option>
                                        <option value="author">Author</option>
                                        <option value="keywords">Keywords</option>
                                        <option value="canonical">Canonical</option>
                                        <option value="description">Description</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" v-model="input.metadatas[index].content" required id="keyword" placeholder="Metadata Content">
                                </div>
                                <div class="col-md-2">
                                    <button 
                                        type="button"
                                        v-if="isEqualIndex(input.metadatas, index)"
                                        class="btn btn-icon btn-primary btn-sm"
                                        @click="delsertElement('add', input.metadatas)">
                                        <span><i class="fe fe-plus text-white"></i></span>
                                    </button>

                                    <button 
                                        type="button"
                                        class="btn btn-icon btn-danger btn-sm"
                                        @click="delsertElement('remove', input.metadatas, index)">
                                        <span><i class="fe fe-minus"></i></span>
                                    </button>
                                </div>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Challenge</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label for="">Description</label>
                        <idx-editor v-model="challenge.description" />
                    </div>
                    <div class="col-6">
                        <label for="">Highlight</label>
                        <idx-editor v-model="challenge.highlight" />
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Solution</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label for="">Description</label>
                        <idx-editor v-model="solution.description" />
                    </div>
                    <div class="col-6">
                        <label for="">Highlight</label>
                        <idx-editor v-model="solution.highlight" />
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Result</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-6 pr-3 border-right">
                        <label for="">Description</label>
                        <idx-editor v-model="result.detail" />
                    </div>
                    <div class="col-6">
                        <label for="">Overview</label>
                        <div class="form-group"
                            v-for="(m, index) in result.overview"
                            :key="index">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="number" v-model="result.overview[index].percentage" required class="form-control" placeholder="10">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" v-model="result.overview[index].description" required placeholder="Description">
                                </div>
                                <div class="col-md-4">
                                    <button 
                                        v-if="result.overview.length > 1"
                                        type="button"
                                        class="btn btn-icon btn-danger btn-sm"
                                        @click="delsertElement('remove', result.overview, index)">
                                        <span><i class="fe fe-minus text-white"></i></span>
                                    </button>

                                    <button 
                                        type="button"
                                        v-if="isEqualIndex(result.overview, index)"
                                        class="btn btn-icon btn-primary btn-sm"
                                        @click="delsertElement('add', result.overview)">
                                        <span><i class="fe fe-plus text-white"></i></span>
                                    </button>
                                </div>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Content</h3>
            </div>

            <div class="card-body">
                <!-- <textarea v-model="input.content" id="content" cols="30" rows="10" class="form-control" placeholder="Write a content..."></textarea> -->
                <idx-editor v-model="input.content" />
            </div>


            <div class="card-footer">
                <div class="row justify-content-between">
                    <inertia-link class="btn btn-default btn-icon" href="/backoffice/portfolios">
                        <span>
                            <i class="fe fe-arrow-left text-dark"></i>
                        </span> Back to portfolios
                    </inertia-link>

                    <button 
                        type="submit" 
                        class="btn btn-dark btn-icon" 
                        :class="{'btn-loading': loading}">
                        <span>
                            <i class="fe fe-save text-white"></i>
                        </span> SAVE
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>

import form from '@/plugin/util/Form';
import swal from '@/plugin/util/swal';

import formMixin from '@/Mixins/form';

import fileExplorer from '../../media/FileSelector';
import idxEditor from '@/plugin/editor/CKEditor';
export default {
    components: {fileExplorer, idxEditor},
    mixins:[formMixin],
    props: {
        portfolio: Object
    },
    computed: {
        isUpdate(){
            return !_.isEmpty(this.portfolio);
        }
    },
    data(){
        return {
            loading: false,
            id: null,
            input: {
                title: "",
                description: "",
                content: "",
                images: [],
                challenge: "",
                solution: "",
                metadatas: [
                    {
                        name: "",
                        content: ""
                    }
                ],
            },
            challenge: {
                description: "",
                highlight: ''
            },
            solution: {
                description: "",
                highlight: ''
            },
            result: {
                detail: "",
                overview: [
                    {
                        percentage: "",
                        description: ""
                    }
                ]
            }
        }
    },
    methods: {
        save() {
            this.input.challenge = this.challenge;
            this.input.solution = this.solution;
            this.input.result = this.result;

            let input = {
                id: this.id,
                input: this.input
            }
            form.clearError();
            this.loading = true;
            this.input.slug = _.toLower(_.replace(this.input.title, / /g, '-'));

            console.log(this.input);

            this.$store.dispatch('portfolio/save', input).then(res => {
                console.log(res);
                if (res.success) {
                    if (res.operation == 'update' && !_.isEmpty(res.hook.images)) {
                        Object.entries(res.hook.images).forEach(([index, value]) => {
                            this._setSelectedFileId(this.input.images, value);
                        });
                    }
                    swal.setTitle(res.message).setIcon('success').toast();
                    
                } else {
                    if (res.message instanceof Object){
                        form.showError(res.message);
                    } else {
                        swal.setTitle(res.message).setIcon('error').toast();
                    }
                }

                this.loading = false;
            }).catch(err => {
                if (err.response)
                    console.error(err.response.data.message);
            });

        },
        delsertElement(flag, instance, index=null){
            switch(flag) {
                case 'add':
                    instance.push({
                        name: "",
                        content: ""
                    });
                    break;
                case 'remove':
                    instance.splice(index, 1);
                    break;
            }
        },
        fileSelected(files) {
            let extra = {
                data: {
                    name: "",
                    description: ""
                }
            };

            this._fileMultiSelect(files, {
                instance: this.input,
                input: 'images'
            }, extra);
        },
        removeImage(e, file, index) {
            this._removeFile(e, file, 'image/remove', {
                instance:this.input,
                input: 'images',
                index: index
            });
        },
        isEqualIndex (arrObj, index) {
            if ((index+1) == arrObj.length) {
                return true;
            }
            return false;
        }
    },
    created() {
        if (!_.isEmpty(this.portfolio)) {
            
            this.id = this.portfolio.id;
            Object.entries(this.input).forEach(([index, value]) => {
                this.input[index] = this.portfolio[index];
            });

            this.challenge = this.portfolio.challenge;
            this.solution = this.portfolio.solution;
            this.result = this.portfolio.result;
        }
    }
}
</script>