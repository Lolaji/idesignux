<template>
    <div>
        <button 
            type="button"
            class="btn btn-secondary border-0 h-auto"
            data-target="#fileExplorer"
            data-toggle="modal">
            <i class="fe fe-image text-white fa-3x"></i><br>
            Select Image
        </button>

        <file-explorer-modal
            id="fileExplorer"
            size="lg"
            x-header-class="pb-0"
            :scrollable="true"
            @show="showModal"
            @hide="hideModal">
            <div slot="header" class="mb-0">
                <h5 class="modal-title font-weight-bolder">File Explorer</h5>

                <div class="wideget-user-tab mb--0 pb-0">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li><a href="#library" data-toggle="tab" class="active show"> <i class="fe fe-folder"></i> Library</a></li>
                                <li class=""><a href="#upload" data-toggle="tab"> <i class="fe fe-upload"></i> Upload</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-body p-0">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="library">
                            <div class="row">
                                <div 
                                    id="main"
                                    class="col-md-9 library-list overflow-y-auto">
                                    <!-- <transition
                                        enter-active-class="animate__animated animate__fadeIn animate__faster"
                                        leave-active-class="animate__animated animate__fadeOut">
                                        <div
                                            v-show="loading" 
                                            class="row justify-content-center align-items-center position-absolute w-100 h-100 stack-top bg-white dimmer acitve">
                                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                        </div>
                                    </transition> -->

                                        <div class="row dropdown">
                                            <div class="col-md-12 mb-1 border-bottom">
                                                <div class="row">
                                                    <div class="col-md-8 row align-self-center">
                                                        <div class="d-flex">
                                                            <button 
                                                                type="button"
                                                                class="btn btn-sm btn-white btn-icon text-dark p-1"
                                                                :class="{'btn-loading': loading}"
                                                                :disabled="_path_link_array.length < 1"
                                                                @click.prevent="history()">
                                                                <span><i class="fe fe-arrow-left fs-12"></i></span>
                                                            </button>
                                                        </div>

                                                        <!-- File Breadcrumb -->
                                                        <div class="d-flex align-self-center">
                                                            <nav aria-label="breadcrumb">
                                                                <ol class="breadcrumb fs-11">
                                                                    <li class="breadcrumb-item">
                                                                        <a 
                                                                            href="#"
                                                                            @click.prevent="history('')">Storage</a></li>
                                                                    <li 
                                                                        v-for="(p, index) in _path_link_array"
                                                                        :key="index"
                                                                        class="breadcrumb-item"
                                                                        :class="{active: _current_folder_in_path == p}">
                                                                            <a 
                                                                                v-if="_current_folder_in_path != p"
                                                                                href="#"
                                                                                @click.prevent="history(index)">{{p}}</a>

                                                                            <span v-else>{{p}}</span>
                                                                    </li>
                                                                </ol>
                                                            </nav>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ml--10 row align-self-center">
                                                        <div class="d-flex mr-1">
                                                            <button 
                                                                type="button"
                                                                class="btn btn-sm btn-dark btn-icon p-1"
                                                                :disabled="loading"
                                                                @click.prevent="openPane('add-folder')">
                                                                <span><i class="fe fe-folder-plus fs-12 text-white"></i></span>
                                                            </button>
                                                        </div>

                                                        <div class="d-flex mr-1">
                                                            <button 
                                                                type="button"
                                                                class="btn btn-sm btn-dark btn-icon p-1"
                                                                :class="{'btn-loading': loading}"
                                                                :disabled="loading"
                                                                @click.prevent="reloadFolder">
                                                                <span><i class="fe fe-refresh-ccw fs-12 text-white"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Add Folder Form -->
                                            <!-- <transition
                                                enter-active-class="animate__animated animate__slideInDown animate__fast"
                                                leave-active-class="animate__animated animate__slideOutUp animate__fast"> -->
                                                <div 
                                                    v-if="form_to_open == 'add-folder'"
                                                    class="col-md-12 mb-1 pb-1 border-bottom">

                                                        <form>
                                                            <div class="col-md-12 row justify-content-center align-self-center">
                                                                <div class="d-flex align-self-center mr-1">
                                                                    <label for="">Folder Name: </label>
                                                                </div>
                                                                <div class="d-flex mr-1">
                                                                    <input type="text" v-model="input.folder.name" class="form-control-sm">
                                                                </div>
                                                                <div class="d-flex mr-1">
                                                                    <button 
                                                                        type="button"
                                                                        class="btn btn-sm btn-dark btn-icon p-1"
                                                                        :class="{'btn-loading': processing.folder}"
                                                                        @click="upsert()">
                                                                        <span><i class="fe fe-folder-plus fs-12 text-white"></i></span>
                                                                        Add
                                                                    </button>
                                                                </div>
                                                                <div class="d-flex mr-1">
                                                                    <button 
                                                                        type="button"
                                                                        class="btn btn-sm btn-danger btn-icon p-1"
                                                                        @click="openPane('close')">
                                                                        <span><i class="fe fe-x fs-12 text-white"></i></span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        
                                                </div>
                                            <!-- </transition> -->
                                            
                                            <div 
                                                class="col-md-12"
                                                @click.right.prevent="openOption($event, true)">
                                                <div class="row mx-1">
                                                    <div
                                                        v-for="e in explorer" 
                                                        :key="e.id"
                                                        class="col-2 p-1 explorer-item">
                                                            <div v-if="e.type == 'folder'" class="dropdown dropright">
                                                                <button 
                                                                    type="button"
                                                                    id="folder"
                                                                    class="btn btn-white overflow-hidden"
                                                                    @dblclick="openFolder($event, e.name)"
                                                                    @click.right.prevent="openOption($event, false, e.type)">
                                                                    <i class="fe fe-folder fa-3x text-yellow"></i><br>
                                                                    {{ e.name | limit(15) }}
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="folder">
                                                                    <a 
                                                                        class="dropdown-item" 
                                                                        href="#"
                                                                        @click.prevent="openFolder($event, e.name)"> <i class="fe fe-book-open"></i> Open</a>

                                                                    <a 
                                                                        class="dropdown-item" 
                                                                        href="#"> <i class="fe fe-edit-2"></i> Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#"> <i class="fe fe-trash-2"></i> Delete</a>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div v-else-if="e.type=='file'" class="dropdown dropright">
                                                                <a 
                                                                    v-if="isFile(e.ext)"
                                                                    href="#" 
                                                                    class="btn btn-white overflow-hidden"
                                                                    @click.right.prevent="openOption($event, false, e.type)"
                                                                    @click.prevent="select($event, e)">
                                                                    <figure class="figure">
                                                                        <img :src="e.url" class="figure-img img-fluid w-40 h-40 rounded" :alt="e.name"><br>
                                                                        <figcaption class="figure-caption text-dark">{{ e.name | limit(15) }}</figcaption>
                                                                    </figure>
                                                                </a>

                                                                <a 
                                                                    v-else
                                                                    href="#" 
                                                                    class="btn btn-white overflow-hidden"
                                                                    @click.right.prevent="openOption($event, false, e.type)"
                                                                    @click.prevent="select($event, e)">
                                                                    <i 
                                                                        class="fe fa-3x"
                                                                        :class="{
                                                                            'fe-music': isFile(e.ext, 'audio'),
                                                                            'fe-github': isFile(e.ext, 'git'),
                                                                            'text-dark': isFile(e.ext, 'git'),
                                                                        }"></i><br>
                                                                    <span>{{e.name || e.filename | limit(15)}}</span>
                                                                </a>

                                                                <div class="dropdown-menu" aria-labelledby="folder">
                                                                    <a 
                                                                        class="dropdown-item" 
                                                                        href="#"
                                                                        @click.prevent="openFolder($event, e.name)"> <i class="fe fe-book-open"></i> Open</a>

                                                                    <a 
                                                                        class="dropdown-item" 
                                                                        href="#"> <i class="fe fe-edit-2"></i> Edit</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#"> <i class="fe fe-trash-2"></i> Delete</a>
                                                                </div>
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Main option to show when right-click -->
                                            <div class="dropdown-menu main-option pt-0" aria-labelledby="main">
                                                <h2 class="dropdown-header bg-light-gray">Main Option</h2>
                                                <a 
                                                    class="dropdown-item" 
                                                    href="#"
                                                    @click.prevent="addFolder"> <i class="fe fe-book-open"></i> Add Folder</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"> <i class="fe fe-trash-2"></i> Delete</a>
                                            </div>

                                        </div>
                                </div>

                                <!-- File Detail -->
                                <div class="col-md-3 library-detail overflow-y-auto pt-2 bg-light">
                                    <h5 class="title">Media Detail</h5>

                                    <div class="col-12 preview px-0 border-bottom mb-2">
                                        <div class="row">
                                            <div class="col-md-6 px-1">
                                                <div class="thumbnail">
                                                    <img src="/images/blog/author-01.jpg" alt="thumb1" class="thumbimg">
                                                </div>
                                            </div>
                                            <div class="col-md-6 detail">
                                                <a href="/idesignux.jpg" class="font-weight-bold">idesignux.jpg</a>
                                                <span>Feb 9, 2021</span><br>
                                                <span>76kb</span><br>
                                                <span>800 <i class="fe fe-x"></i> 600</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 ">
                                        <form>
                                            <div class="form-group">
                                                <div class="row">
                                                    <input 
                                                        type="text" 
                                                        class="form-control col-md-12" 
                                                        readonly
                                                        @focus="$event.target.select()"
                                                        value="http://localhost:3000/storate/images/idesignux.jpg">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <!-- <label for="" class="label col-md-3 pt-2">Title</label> -->
                                                    <input type="text" class="form-control col-md-12" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <!-- <label for="" class="label col-md-3 pt-2">Caption</label> -->
                                                    <input type="text" class="form-control col-md-12" placeholder="Caption">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <!-- <label for="" class="label col-md-3 pt-2">Alt</label> -->
                                                    <input type="text" class="form-control col-md-12" placeholder="Alt Text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <!-- <label for="" class="label col-md-3 pt-2">Description</label> -->
                                                    <textarea name="" class="form-control" placeholder="Description"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="upload">
                            <div class="col-md-12 py-3">
                                <file-uploader
                                    id="fu"
                                    ref="fu"
                                    :options="fu_options"
                                    v-on:vdropzone-success="uploadSuccess"
                                    v-on:vdropzone-error="uploadError" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button 
                    type="button" 
                    class="btn btn-xs btn-icon btn-primary text-white"
                    @click="add">
                    <i class="fe fe-plus"></i> 
                    Add Gallery
                </button>
            </div>
        </file-explorer-modal>
    </div>
</template>

<script>
import swal from '@/plugin/util/swal';
import filters from '@/plugin/util/filters';

import errorLog from '@/Mixins/errorLog';
import fileExplorerModal from '@/components/admin/elements/Modal';
import fileUploader from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    components: {
        fileExplorerModal,
        fileUploader
    },
    mixins: [errorLog],
    props: {
        multiple: {
            type: Boolean,
            default: () => false
        }
    },
    filters,
    computed: {
        _path_link_array() {
            return _.compact(this.path.split('/'));
        },
        _current_folder_in_path(){
            let c = _.last (this._path_link_array);
            console.log(c)
            return c;
        },
        _storage_url () {
            return "https://idesignux.s3.eu-west-3.amazonaws.com";
        }
    },
    data(){
        return {
            path: '',
            loading: false,
            processing: {
                folder: false
            },
            files: [],
            directories: [],
            explorer: [],
            form_to_open: null,
            selected_files: [],
            is_single_select: false,
            input: {
                folder: {
                    name: ''
                }
            },
            fu_options: {
                url: `/api/explorer/upload`,
                // uploadMultiple: true,
                // thumbnailWidth: 100,
                // thumbnailHeight: 100,
                maxFilesize: 2,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                // acceptedFiles: '',
                addRemoveLinks: true,
                dictCancelUpload: '<i class="fe fe-x"></i>',
                dictCancelUploadConfirmation: '<i class="fe fe-check-circle"></i>',
                dictRemoveFile: '<i class="fe fe-stop-circle"></i>',
                dictDefaultMessage: `<i class="fe fe-upload fa-3x"></i> <br> Drag and Drop or Click to upload image`,
                params: {
                    foldername: ''
                }
            }
        }
    },
    watch: {
        _path_link_array(n, o){
            this.fu_options.params.foldername = n;
        },
        fu_options(n, o){
            console.log(n);
        }
    },
    methods: {
        /**
         * Create new folder at the current path if the flag is created
         * and delete folder if the flag is set to delete.
         */
        upsert(flag='create') {
            let foldername = this.input.folder.name;
            console.log(foldername);
            this.processing.folder = true;
            if (!_.isEmpty(foldername)){
                let save_path = `${this.path}/${foldername}`;
                this.$store.dispatch('filemanager/delsert', {
                    flag: flag,
                    path: save_path
                }).then(res => {
                    console.log(res);
                    if (res.success) {
                        this.load();
                        this.openPane('close');
                        swal.setTitle(`Folder (${foldername} created successfully)`).setIcon('success').toast()
                    } else {
                        swal.setTitle(`folder not created)`).setIcon('success').toast()
                    }
                    this.processing.folder = false;
                }).catch(err => {
                    this.axiosErrorLog(err);
                    this.processing.folder = false;
                });
            } else {
                swal.setTitle('Folder name is required.').setIcon('error').toast()
                this.processing.folder = false;
            }
        },
        select(e, file){
            let parent = $(e.target).closest('.explorer-item');
            if (e.ctrlKey && this.multiple) {
                if (this.is_single_select){
                    let curr_selected = this.selected_files;
                    this.selected_files = [];
                    this.selected_files.push(curr_selected);
                    this.is_single_select = false;
                }

                if (parent.hasClass('selected')) {
                    parent.removeClass('selected');
                    this.selected_files = _.remove((n) => {
                        return n == file.id
                    }, this.selected_files);
                } else {
                    parent.addClass('selected');
                    this.selected_files.push(file);
                }
            } else {
                parent.siblings().removeClass('selected');
                this.is_single_select = true;
                if (parent.hasClass('selected')) {
                    parent.removeClass('selected');
                    this.selected_files = [];
                } else {
                    parent.addClass('selected');
                    this.selected_files = file;
                }
            }
        },
        add(){
            this.$emit('selected', this.selected_files);
            $('#fileExplorer').modal('hide');
        },
        uploadSuccess(file, res) {
            console.log(res);
            swal.setTitle(`${res.filename} uploaded successfully`).setIcon('success').toast();
        },
        uploadError(file, msg, xhr){
            console.log(msg);
            console.log(file);
            this.load();
            swal.setTitle('Unable to upload file due to system error. Please try again.').setIcon('error').toast();
        },
        load(path=''){
            if (!_.isEmpty(path))
                this.path += `/${path}`;

            this.loading = true;
            let directories = [];
            let files = [];
            let counter = 1;
            
            this.$store.dispatch('filemanager/fetch', this.path).then(res => {
                console.log(res);
                if (!_.isEmpty(res)) {
                    Object.entries(res.directories).forEach(([index, value]) => {
                        counter = counter+parseInt(index)
                        directories.push({
                            id: counter,
                            name: this.getPath(value),
                            type: 'folder'
                        });
                    });
                    Object.entries(res.files).forEach(([index, value]) => {
                        let filename = this.getPath(value)
                        counter = counter+parseInt(index)+1
                        files.push({
                            id: counter,
                            ext: this.getFileExt(filename),
                            name: this.getFileExt(filename, true),
                            filename: filename,
                            type: 'file',
                            url: `${this._storage_url}/public${this.path}/${filename}`
                        });
                    });

                    this.directories = directories;
                    this.files = files;

                    this.explorer = _.concat(this.directories, this.files);

                    this.loading = false;
                }
            }).catch(err => {
                this.axiosErrorLog(err);
            })
        },
        openFolder(e, dirname) {
            $('.dropdown-menu').dropdown('hide');
            this.load(dirname);
            this.hideModal();
        },
        editFolder(){
            console.log('edit folder');
        },
        openOption(e, main=false, type='') {
            let parent = $(e.target).closest('.dropdown'),
                dd_class = '.dropdown-menu.main-option';

            if (!main) {
                parent = $(e.target).closest('.dropdown');
                dd_class = '.dropdown-menu';
            }

            console.log(parent);
            if (parent.hasClass('show')) {
                parent.find(dd_class).dropdown('hide');
            } else {
                $(dd_class).dropdown('hide')
                parent.find(dd_class).dropdown('show');
            }
        },
        showModal(e) {
            this.load();
        },
        hideModal(){
            this.selected_files = [];
            $('.explorer-item').removeClass('selected');
        },
        getPath(path, index = null) {
            let folderArr = path.split('/');
            return (!_.isNull(index))?  folderArr[index] : _.last(folderArr);
        },
        getFileExt(filename, name=false) {
            let fileArr = filename.split('.');
            console.log(fileArr);
            return (name)? fileArr[0] : _.last(fileArr);
        },
        isFile(ext, type='image') {
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'svg':
                    return type == 'image';
                    break;
                
                case 'mp3':
                    return type == 'audio'
                    break
                
                case 'mp4':
                    return type == 'video'
                    break
                
                case '.git':
                case 'gitignore':
                    return type == 'git'
                    break
            }
        },
        history(folderIndex=null) {
            let pathArr = _.compact(this._path_link_array);
            if (_.isNull(folderIndex)) {
                pathArr.pop(); //remove the last path
                this.path = (pathArr.length>0)? `/${pathArr.join('/')}` : '';
            } else {
                let index = parseInt(folderIndex);
                if (!_.isNaN(index)) {
                    index = index + 1;
                    pathArr.splice(index);
                    this.path = `/${pathArr.join('/')}`;
                } else {
                    this.path = ''
                }
            }
            this.load();
        },
        reloadFolder(){
            this.load();
        },
        openPane(pane=null) {
            if (pane != 'close') {
                this.form_to_open = pane;
            } else {
                this.form_to_open = null;
            }
        }
    },
    mounted() {
        $(document).on('click', (e) => {
            $('.dropdown-menu').dropdown('hide');
        });
        $('.dropdown-item').click(() => {
            $(this).closest('.dropdown-menu').dropdown('hide');
        });
    }
}
</script>

<style lang="scss" scoped>
    .library-list,
    .library-detail {
        // overflow-y: auto;
        height: 450px;
    }
    .library-list {
        .explorer-item {
            border: 1px solid #fff;
            &.selected {
                border: 1px solid #525ce5;
                // .display-none {
                //     display: block;
                // }
            }
        }
        .main-option {
            position: absolute;
            top:0;
            left: 0;
        }
    }
    .library-detail {
        font-size: 6px;
        title {
            font-weight: 900;
        }
        .preview {
            .detail {
                font-size: 11px;
            }
        }
    }
    button{
        &:disabled {
            cursor: not-allowed;
        }
    }
</style>