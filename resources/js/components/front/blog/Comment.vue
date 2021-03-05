<template>
    <!-- Start Blog Comment  -->
    <div class="axil-blog-comment mt--60 mt_md--40 mt_sm--30">
        <div class="mb--40">
            <div class="row justify-content-between">
                <h4 class="pt-1">Comments</h4>
                <button 
                    id="comment"
                    type="button" 
                    class="axil-button btn-small btn-solid"
                    data-toggle-pane="commentPane">
                    <!-- <span class="button-text"></span> -->
                    Write a comment
                </button>
            </div>
        </div>
        
        <div
            v-for="(comment, index) in _comments" 
            :key="index"
            class="comment-list">
            <!-- Start Single Comment  -->
            <div class="comment">
                <div class="thumbnail">
                    <img src="/images/blog/author-01.jpg" alt="Blog Comment" />
                </div>
                <div class="content">
                    <div class="heading">
                        <div class="title mr-5">
                            <h5>{{comment.name}}</h5>
                        </div>
                        <div class="coment-date">
                            <p>{{comment.created_at | msgDate}}</p>
                            <a 
                                href="#" 
                                id="commentReply"
                                class="reply-btn" 
                                :data-comment-id="comment.id">
                                <i class="fas fa-reply"></i
                            ></a>
                        </div>
                    </div>
                    <p class="description">
                        {{comment.message}}
                    </p>
                </div>
            </div>
            <!-- End Single Comment  -->
            <!-- Start Single Comment  -->
            <div 
                v-for="(reply, i) in comment.replies"
                :key="reply.id"
                class="comment comment-reply">
                <div class="thumbnail">
                    <img src="/images/blog/author-01.jpg" alt="Blog Comment" />
                </div>
                <div class="content">
                    <div class="heading">
                        <div class="title">
                            <h5>{{reply.name}}</h5>
                        </div>
                        <div class="coment-date">
                            <p>{{reply.created_at | msgDate}}</p>
                            <a class="reply-btn" href="#" :data-comment-id="reply.id" id="commentReply">
                                <i class="fas fa-reply"></i
                            ></a>
                        </div>
                    </div>
                    <p class="description">
                        {{reply.message}}
                    </p>
                </div>
            </div>
            <!-- End Single Comment  -->
        </div>

        <div v-if="_comments.length == 0" class="col text-center">
            <p>There are no comments</p>
        </div>

        <!-- Comment Form Pane -->
        <idx-pane id="commentPane" toggle-btn-id="comment">
            <h4 slot="header" class="mb--40">Leave a comment:</h4>
            <form @submit.prevent="save">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" v-model="input.name" id="name">
                            <label for="name">Name</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="email" v-model="input.email" id="email">
                            <label for="email">Email address</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" v-model="input.company" id="company">
                            <label for="company">Company name (Optional)</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <input type="text" v-model="input.website" id="website">
                            <label for="website">Website (Optioanl)</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <textarea v-model="input.message" id="message"></textarea>
                            <label for="message">Write your comment here…</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="comment-submit-btn">
                            <button class="axil-button btn-large btn-transparent" type="submit"><span class="button-text">Submit</span><span
                                    class="button-icon"></span></button>
                        </div>
                    </div>
                </div>
            </form>
        </idx-pane>
    </div>
    <!-- Start Blog Comment  -->
</template>

<script>
import form from '@/plugin/util/Form';
import swal from '@/plugin/util/swal';
import errorLog from '@/Mixins/errorLog';

import filters from '@/plugin/util/filters';

import idxPane from '@/components/front/elements/Pane';

export default {
    mixins: [errorLog],
    filters: filters,
    props: {
        postId: Number,
        comments: Array
    },
    components: {
        idxPane
    },
    computed: {
        _comments(){
            return this.comments;
        }
    },
    data(){
        return {
            open_pane: false,
            comment_id: null,
            input: {
                name: '',
                email: '',
                company: '',
                website: '',
                message: ''
            }
        }
    },
    methods: {
        save(){
            form.clearError();
            this.$store.dispatch('comment/save', {
                postId: this.postId,
                commentId: this.comment_id,
                input: this.input
            }).then(res => {
                console.log(res);
                if (res.success) {
                    this._comments.unshift(res.hook.comment);
                    form.reset(this.input);
                } else {
                    if (res.message instanceof Object) {
                        form.showError(res.message);
                    } else {
                        swal.setTitle(res.message).setIcon('error').toast();
                    }
                }
            }).catch(err => {
                this.axiosErrorLog(err);
            });
        },
        listen(){
            Echo.channel(`post.${this.postId}`)
                .listen('CommentEvent', (comment) => {
                    console.log(comment);
                    this._comments.unshift(comment.comment);
                });
        }
    },
    mounted(){
        $(document).on('click', '#commentReply', (e) => {
            e.preventDefault();
            this.comment_id = $(this).data('comment-id');
            console.log($(e.target))

            $('#commentPane').addClass('opened');
            $('html').addClass(`side-nav-opened`);
        })
        this.listen();
    }
}
</script>
