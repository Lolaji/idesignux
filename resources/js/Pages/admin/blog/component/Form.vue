<template>
    <form @submit.prevent="save">
        <div class="row">
            <div class="col-md-4">

                <!-- Status & Visibility -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Status &amp; Visibility</h3>
                        <div class="card-options">
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12 form-group border-bottom">
                            <div class="row justify-content-between">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Visiblity</label>
                                <div class="col-sm-7">
                                    <select v-model="input.visibility" id="visibility" class="form-control form-control-sm" data-placeholder="Select Visiblity">
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                        <option value="password-protected">Password Protected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-between mb-1" v-if="input.visibility == 'password-protected'">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-7">
                                    <input type="text" v-model="password" class="form-control form-control-sm" placeholder="Enter protected password">
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-12 form-group">
                            <div class="row justify-content-between">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Publish</label>
                                <div class="col-sm-7">
                                    <input class="form-control form-control-sm fc-datepicker hasDatepicker" placeholder="MM/DD/YYYY" type="text" id="dp1614601001518">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Taxonomies -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Taxonomies</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Category</label>
                            <select v-model="input.category_id" id="category_id" class="form-control" data-placeholder="Select Category">
                                <option value="">Select Category</option>

                                <option 
                                    v-for="(c, index) in categories"
                                    :key="index" 
                                    :value="c.id">{{c.title}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Tags</label>
                            <tag-select 
                                v-model="input.tags" 
                                :options="options"
                                :settings="settings"
                                placeholder="Select tags"
                                @select="tagSelect" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
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
                                        <input type="text" v-model="input.title" id="title" class="form-control" placeholder="How to increase your income">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" v-model="input.slug" id="slug" class="form-control" placeholder="how-to-increase-your-income">
                                    </div>
                                </div>
                                <div class="col-md-12">
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
                                                @selected="fileSelected"></file-explorer>
                                        </div>
                                        <div class="col-md-9">
                                            
                                            <div 
                                                is="transition"
                                                enter-active-class="animate__animated animate__fadeIn"
                                                leave-active-class="animate__animated animate__fadeOut"
                                                class="row">
                                                    <div 
                                                        v-if="!!input.image"
                                                        class="col-xl-3 col-md-3 col-sm-3">
                                                            <button 
                                                                type="button"
                                                                class="btn btn-sm btn-dark rounded-circle position-absolute position-to-top"
                                                                @click="removeImage($event, input.image)">
                                                                <i class="fe fe-x text-white"></i>
                                                            </button>
                                                            <a href="#" class="thumbnail ">
                                                                <img :src="input.image.url" alt="thumb1" class="thumbimg">
                                                            </a>
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
                                            <select v-model="input.metadatas[index].name" id="meta_name" class="form-control">
                                                <option value="">-- Select Metadata Name --</option>
                                                <option value="robots">Robots</option>
                                                <option value="author">Author</option>
                                                <option value="keywords">Keywords</option>
                                                <option value="canonical">Canonical</option>
                                                <option value="description">Description</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" v-model="input.metadatas[index].content" id="keyword" placeholder="Metadata Content">
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
                        <idx-editor v-model="input.content" />
                    </div>

                    <div class="card-footer">
                        <div class="row justify-content-between">
                            <inertia-link class="btn btn-default btn-icon" href="/backoffice/posts">
                                <span>
                                    <i class="fe fe-arrow-left text-dark"></i>
                                </span> Back to posts
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
import TagSelect from 'v-select2-component';
// import '../../../../../assets/plugins/select2/select2.full.min.js';

export default {
    mixins: [formMixin],
    props: {
        post: Object,
        tags: Array,
        userId: Number,
        categories: Array
    },
    components: {
        TagSelect,
        fileExplorer,
        idxEditor
    },
    computed: {
        isUpdate(){
            return !_.isEmpty(this.post);
        }
    },
    data(){
        return {
            loading: false,
            id: null,
            input: {
                id: null,
                title: "",
                slug: "",
                category_id: '',
                description: "",
                content: "",
                tags: [],
                old_tags: [],
                image: null,
                visibility: 'public',
                metadatas: [
                    {
                        name: "",
                        content: ""
                    }
                ],
            },
            settings: {
                multiple: true,
            },
            options: []
        }
    },
    methods: {
        save() {
            let input = {
                user_id: this.userId,
                input: this.input
            }
            form.clearError();
            this.loading = true;

            if (!this.input.slug)
                this.input.slug = _.toLower(_.replace(this.input.title, / /g, '-'));
            
            // this.input.detach_tags = _.difference(this.input.old_tags, this.input.tags);
            // this.input.attach_tags = _.difference(this.input.tags, this.input.old_tags);


            this.$store.dispatch('post/save', input).then(res => {
                console.log(res);
                if (res.success) {
                    if (res.operation == 'create') {
                        this.$inertia.visit(`/backoffice/posts/${res.data.id}`);
                    }
                    swal.setTitle(res.message).toast();
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
                    this.input.metadatas.push({
                        name: "",
                        content: ""
                    });
                    break;
                case 'remove':
                    this.input.metadatas.splice(index, 1);
                    break;
            }
        },
        fileSelected(files) {
            this._fileSingleSelect(files, {
                instance: this.input,
                input: 'image'
            });
        },
        removeImage(e, file) {
            this._removeFile(e, file, 'image/remove', {
                instance: this.input,
                input: 'image'
            });
        },
        isEqualMetadataIndex (index){
            if ((index+1) == this.input.metadatas.length) {
                return true;
            }
            return false;
        },
        tagSelect(e){
            console.log(e)
            if (!e.selected) {

            }
            // $dif = _.difference(this.input.old_tags, e);
            // console.log(dif);
        }
    },
    created(){
        if (!_.isNil(this.tags)) {
            Object.entries(this.tags).forEach(([index, value]) => {
                this.options.push({
                    id: value.id,
                    text: value.title
                })
            });
        }

        if (!_.isEmpty(this.post)) {
            this.id = this.post.id;

            Object.entries(this.input).forEach(([index, value]) => {
                this.input[index] = this.post[index];
            });
        }

        if (!_.isNil(this.post)){
            Object.entries(this.post.tags).forEach(([index, val]) => {
                console.log(index)
                this.input.tags[index] = _.toString(val.id);
            });

            this.input.old_tags = this.input.tags;
        }
    }
}
</script>