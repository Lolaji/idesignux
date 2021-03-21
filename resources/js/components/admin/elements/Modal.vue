<template>
    <div 
        :id="id" 
        class="modal" 
        :class="xClass"
        tabindex="-1" 
        role="dialog" 
        aria-hidden="true">
            <div
                role="document" 
                class="modal-dialog"
                :class="{
                    'modal-dialog-centered' : centered,
                    'modal-dialog-scrollable': scrollable,
                    'modal-sm': (size == 'sm'),
                    'modal-lg': (size == 'lg'),
                    'modal-xl': (size == 'xl')
                }">
                <div class="modal-content">
                    <div class="modal-header" :class="xHeaderClass">
                        <slot name="header">
                            <h5 class="modal-title font-weight-bolder" id="example-Modal3">{{title}}</h5>
                        </slot>
                        <button v-if="closeBtn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <slot />
                </div>
            </div>
    </div>
</template>

<script>
export default {
    props: {
        id: String,
        size: String,
        title: String,
        xClass: {
            type: [String, Array, Object],
            default: () => 'animate__animated animate__zoomIn animate__faster'
        },
        centered: {
            type: Boolean,
            default: () => false
        },
        scrollable: {
            type: Boolean,
            default: () => false
        },
        closeBtn: {
            type: Boolean,
            default: () => true
        },
        xHeaderClass: [String, Array, Object]
    },
    mounted(){
        let id = $(`#${this.id}`);

        let events = [
            'show.bs.modal',
            'shown.bs.modal',
            'hide.bs.modal',
            'hidden.bs.modal',
            'hidePrevented.bs.modal'
        ];

        for(let i in events) {
            let event = events[i],
                event_name = event.split('.')[0];

            id.on(event, (e) => {
                this.$emit(event_name, e);
            });
        }

    }
}
</script>