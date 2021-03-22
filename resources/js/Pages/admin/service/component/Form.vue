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

                        <!-- File selector -->
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
                                                class="col-xl-3 col-md-3 col-sm-3">
                                                    <button 
                                                        type="button"
                                                        class="btn btn-sm btn-dark rounded-circle position-absolute position-to-top"
                                                        @click="removeImage($event, file, index)">
                                                        <i class="fe fe-x text-white"></i>
                                                    </button>
                                                    <a href="#" class="thumbnail ">
                                                        <img :src="file.url" alt="service image" class="thumbimg">
                                                    </a>

                                                    <select v-model="file.data.name" class="form-control form-control-sm mb-1">
                                                        <option value="icon">icon</option>
                                                        <option value="header">Header</option>
                                                    </select>
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
                            v-for="(m, index) in input.metadata"
                            :key="index">
                            <div class="row">
                                <div class="col-md-4">
                                    <select v-model="input.metadata[index].name" id="meta_name" class="form-control">
                                        <option value="">-- Select Metadata Name --</option>
                                        <option value="robots">Robots</option>
                                        <option value="author">Author</option>
                                        <option value="keywords">Keywords</option>
                                        <option value="canonical">Canonical</option>
                                        <option value="description">Description</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" v-model="input.metadata[index].content" id="keyword" placeholder="Metadata Content">
                                </div>
                                <div class="col-md-2">
                                    <button 
                                        type="button"
                                        v-if="isEqualMetadataIndex(index)"
                                        class="btn btn-icon btn-primary btn-sm"
                                        @click="metadataInput('add')">
                                        <span><i class="fe fe-plus"></i></span>
                                    </button>

                                    <button 
                                        type="button"
                                        v-else
                                        class="btn btn-icon btn-danger btn-sm"
                                        @click="metadataInput('remove', index)">
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
                <h3 class="card-title">Content</h3>
            </div>

            <div class="card-body">
                <!-- <textarea v-model="input.content" id="content" cols="30" rows="10" class="form-control" placeholder="Write a content..."></textarea> -->
                <idx-editor v-model="input.content" />
            </div>

            <div class="card-footer">
                <div class="row justify-content-between">
                    <inertia-link class="btn btn-default btn-icon" :href="url">
                        <span>
                            <i class="fe fe-arrow-left text-dark"></i>
                        </span> Back to service
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

// Mixins
import formMixin from '@/Mixins/form';

import fileExplorer from '../../media/FileSelector';
import idxEditor from '@/plugin/editor/CKEditor';
export default {
    components: {fileExplorer, idxEditor},
    mixins: [formMixin],
    props: {
        service: Object,
        serviceId: String
    },
    computed: {
        isUpdate(){
            return !_.isEmpty(this.service);
        }
    },
    data(){
        return {
            url: "/backoffice/services",
            loading: false,
            input: {
                id: null,
                title: "",
                description: "",
                content: "",
                images: [],
                metadata: [
                    {
                        name: "",
                        content: ""
                    }
                ],
            }
        }
    },
    methods: {
        save() {
            let store_path = 'service/save';
            let input = {
                input: this.input
            }
            form.clearError();
            this.loading = true;
            this.input.slug = _.toLower(_.replace(this.input.title, / /g, '-'));
            
            if (!_.isEmpty(this.serviceId)) {
                store_path = 'service/subservice/save';
                this.input.relation = 'child';
                input.service_id = this.serviceId;
            }

            // console.log(store_path);

            this.$store.dispatch(store_path, input).then(res => {
                console.log(res);
                if (res.success) {
                    if (res.operation == 'create') {
                        let url = '/backoffice/services';
                        if (!_.isEmpty(this.serviceId)) {
                            url += `/${this.serviceId}/${res.data.id}`;
                        }else{
                            url+= `/${res.data.id}`;
                        }
                        this.$inertia.visit(url);
                    } else {
                        if (res.operation == 'update' && !_.isEmpty(res.hook.images)) {
                            Object.entries(res.hook.images).forEach(([index, value]) => {
                                console.log(value);
                                this._setSelectedFileId(this.input.images, value);
                            });
                        }
                        swal.setTitle(res.message).setIcon('success').toast();
                    }
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
        metadataInput(flag, index=null){
            switch(flag) {
                case 'add':
                    this.input.metadata.push({
                        name: "",
                        content: ""
                    });
                    break;
                case 'remove':
                    this.input.metadata.splice(index, 1);
                    break;
            }
        },
        fileSelected(files) {
            let extra = {
                data: {
                    name: ""
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
        isEqualMetadataIndex (index){
            if ((index+1) == this.input.metadata.length) {
                return true;
            }
            return false;
        }
    },
    created(){
        if (!_.isNil(this.serviceId)){
            this.url += `/${this.serviceId}`;
        }

        if (!_.isEmpty(this.service)) {
            Object.entries(this.input).forEach(([index, value]) => {
                this.input[index] = this.service[index];
            });
        }
    }
}
</script>