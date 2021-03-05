<template>
    <div class="axil-blog-author">
        <div class="author d-flex">
            <div class="author-thumb">
                <img src="/images/blog/author-01.jpg" alt="Blog Author">
            </div>
            <div class="info">
                <h5 class="title"><a href="#">{{author.name}}</a></h5>
                <p class="subtitle-2">Email is a crucial channel in any marketing mix,
                    and never has this been truer than for today’s entrepreneur. Curious
                    what to say.</p>
                <ul class="social-share justify-content-start">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                    <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fab fa-behance"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        author: Object
    }
}
</script>