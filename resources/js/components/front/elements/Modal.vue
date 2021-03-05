<template>
    <div class="modal fade" :id="id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" :class="dailog_setting">
            <div class="modal-content">
                <div class="modal-header">
                    <slot name="header" />
                </div>
                <div class="modal-body">
                    <slot />
                </div>
                <div class="modal-footer">
                    <slot name="footer"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: String
        },
        centered: {
            type: Boolean,
            default: () => false
        },
        scrollable: {
            type: Boolean,
            default: () => false
        },

    },
    data(){
        return {
            dailog_setting: {}
        }
    },
    created(){
        this.dailog_setting['modal-dialog-centered'] = this.centered;
        this.dailog_setting['modal-dialog-scrollable'] = this.scrollable;
    },
    mounted(){
        // if (!_.isNil(this.id)) {
        //     $(`#${this.id}`).modal('show');
        // }
    }
}
</script>