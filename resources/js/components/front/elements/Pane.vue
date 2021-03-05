<template>
    <div 
        ref="pane"
        class="side-nav" :id="id">
        <div class="side-nav-inner">
            <slot name="header"/>

            <!-- Start Side Content  -->
            <div class="side-nav-content">
                <slot />
            </div>
            <!-- End Side Content  -->
            <!-- End of .side-nav-inner -->
            <div class="close-sidenav" id="close-sidenav">
                <button class="close-button"><i class="fal fa-times"></i></button>
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
        toggleBtnId: {
            type: String,
            required: true
        }
    },
    data(){
        return {
            toggle_btn: '',
            pane: ''
        }
    },
    methods: {
        close (e) {
            if (!$('.side-nav, .side-nav *:not(".close-sidenav, .close-sidenav *")').is(e.target)) {
                console.log('close side nav')
                this.pane.removeClass('opened');
                $('html').removeClass(`side-nav-opened`);
            }
        }
    },
    mounted(){
        this.toggle_btn = $(`#${this.toggleBtnId}`);
        let toggleAttr = this.toggle_btn.data("toggle-pane");

        $(document)
            .on('click', `#${this.toggleBtnId}`, (e) => {
                e.preventDefault()
                this.$emit('show', e);
                this.pane = $(`#${toggleAttr}`)
                console.log(this.pane);
                this.pane.addClass('opened');
                $('html').addClass(`side-nav-opened`);
                this.$emit('shown', e);
            })

            .on('click', `#${toggleAttr} #close-sidenav`, '.side-nav-opened', (e) => {
                this.$emit('hide', e);
                this.close(e);
                this.$emit('hidden', e);
            });
    }
}
</script>