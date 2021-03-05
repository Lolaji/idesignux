<template>
    <div class="axil-newsletter">
        <form class="newsletter-form" action="#">
            <input type="email" placeholder="firtname">
            <input type="email" placeholder="lastname">
            <input type="email" placeholder="Email">
            <a class="axil-button btn-transparent" href="#"><span class="button-text">Subscribe</span><span class="button-icon"></span></a>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            input: {
                firstname: "",
                lastname: "",
                email: ""
            }
        }
    }
}
</script>