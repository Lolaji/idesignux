<template>
     <input 
        ref="fileUpload"
        type="file"
        class="dropify" 
        :multiple="multiple"
        data-height="300" />
</template>

<script>
require('./assets/js/fileupload');
import './assets/css/fileupload.css';
export default {
    props: {
        messages: {
            type: Object,
            default: () => {
                return {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong appended.'
                }
            }
        },
        error: {
            type: Object,
            default: () => {
                return {
                    'fileSize': 'The file size is too big (2M max).'
                }
            }
        },
        multiple: {
            type: Boolean,
            default: () => false
        }
    },
    mounted(){
        let settings = {};

        
        settings.messages = this.messages;
        settings.error = this.error;

        
        $(this.$refs.fileUpload).dropify(settings);
    }
}
</script>