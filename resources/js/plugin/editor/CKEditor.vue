<template>
    <ck-editor 
        v-bind="$attrs"
        :editor="editor" 
        :config="editorConfig"
        :value="value"
        :tag-name="tagName"
        :disabled="disabled"
        @ready="editor => $emit('ready', editor)"
        @focus="editor => $emit('focus', editor)"
        @blur="editor => $emit('blur', editor)"
        @input="editor => $emit('input', editor)"
        @destroy="editor => $emit('destroy', editor)" />
</template>
<script>
import Vue from 'vue';
import CKEditor from '@ckeditor/ckeditor5-vue2';
import Classic from '@ckeditor/ckeditor5-build-classic';

// Vue.use(CKEditor);
export default {
    props:{
        value: {
            type:String,
            default: () => ''
        },
        tagName: {
            type:String,
            default: () => 'textarea'
        },
        disabled: Boolean,
        package: {
            type: String,
            default: () => 'classic',
            validator: (value) => {
                return ['classic', 'inline', 'balloon', 'balloon-block', 'decoupled-document'].indexOf(value) > -1;
            }
        }
    },
    components: {
        CkEditor: CKEditor.component
    },
    data(){
        return {
            editor: Classic,
            editorData: '',
            editorConfig: {
                // The configuration of the editor.
            }
        }
    },
    watch: {
        editorData(n, o){
            this.$emit('model', n);
        }
    },
    methods: {
        setBuildParckage(name='classic') {
            switch(name) {
                case 'classic':
                    this.editor = Classic;
                    break;
            }
        }
    },
    created(){
        this.setBuildParckage(this.package);
    }
}
</script>

<style lang="scss" scoped>
.ck-editor {
    .ck-editor__main {
        .ck-content {
            max-height: 700px;
        }
    }
}
</style>