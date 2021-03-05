<template>
    <v-select
        :options="options"
        :settings="vs_settings" />
</template>

<script>
import vSelect from 'v-select2-component';
export default {
    props: {
        options: Array,
        settings: Object,
        multiple: {
            type: Boolean,
            default: () => false
        },
        placeholder: {
            type: String,
            default: () => "Select option"
        }
    },
    components: {
        vSelect
    },
    data(){
        return {
            vs_settings: {}
        }
    },
    mounted(){
        this.vs_settings.multiple = this.multiple;
    }
}
</script>