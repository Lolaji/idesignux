<template>
    <!-- Start Single Blog  -->
    <div class="axil-blog-list" :class="xClass">
        <div class="blog-top">
            <slot name="top">
                <h4 class="title"><a href="blog-details.html">An oral history of the AIM away
                    message (by the people who were there)</a></h4>
                <div class="author">
                    <div class="author-thumb">
                        <img src="/images/blog/author-01.jpg" alt="Blog Author">
                    </div>
                    <div class="info">
                        <h6>Blanche Owens</h6>
                        <ul class="blog-meta">
                            <li>Aug 27, 2019</li>
                            <li>9 min to read</li>
                        </ul>
                    </div>
                </div>
            </slot>
        </div>

        <div class="thumbnail">
            <slot name="thumbnail">
                <a href="blog-details.html">
                    <img class="w-100" src="/images/blog/blog-list-01.jpg" alt="Blog Images">
                </a>
            </slot>
        </div>

        <div class="content">
            <slot>
                <p>Donec metus lorem, vulputate at sapien sit amet, auctor iaculis lorem. In vel
                    hendrerit nisi. Vestibulum eget risus velit. Aliquam tristique libero at dui
                    sodales, et placerat orci lobortis. Maecenas ipsum neque, elementum id dignissim
                    et, imperdiet vitae mauris.</p>
                    
                <a class="axil-button btn-large btn-transparent" href="blog-details.html"><span
                        class="button-text">Read More</span><span class="button-icon"></span></a>
            </slot>
        </div>
    </div>
    <!-- End Single Blog  -->
</template>

<script>
export default {
    props: {
        xClass: {
            type: [String, Array, Object]
        }
    }
}
</script>