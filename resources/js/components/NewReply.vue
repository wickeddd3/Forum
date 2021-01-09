<template>
<div>
    <template v-if="signedIn">
        <div class="container my-5" v-if="verified">
            <template v-if="closed">
                <h6 class="subtitle is-6 has-text-centered my-5">
                    <span class="is-size-3 is-block my-2">
                        <i class="fas fa-comment-slash"></i>
                    </span>
                    Thread is closed, you can no longer post a reply.
                </h6>
            </template>
            <template v-else>
                <textarea class="textarea is-small" id="reply" v-model="message" placeholder="Write your reply here..."></textarea>
                <p class="is-block has-text-right my-2">
                    <button class="button is-small is-success " @click="addReply">Post reply</button>
                </p>
            </template>
        </div>
        <p class="has-text-centered my-5" v-else>
            You must <a href="/email/verify">&nbsp;Verify&nbsp;</a> your email to participate in this discussion.
        </p>
    </template>
    <template v-else>
        <p class="has-text-centered my-5">
            Please <a href="/login">Log In</a> to participate in this discussion.
        </p>
    </template>
</div>
</template>

<script>
import snackbar from './../mixins/snackbar'

export default {
    props:['closed'],

    mixins:[snackbar],

    data() {
        return {
            message: '',
        }
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        },
        verified() {
            return window.App.verified;
        }
    },

    methods: {
        addReply() {
            if(this.message != '') {
                axios.post(location.pathname + '/replies', { message: this.message })
                    .then(({data}) => {
                        this.message = '';
                        this.snackbar("Your reply has been posted.")
                        this.$emit('created', data);
                    })
                    .catch((error) => {
                        this.snackbar("Error occurred while posting your reply")
                    })
            } else {
                this.snackbar("Oops!, it seems like your reply is empty.");
            }
        }
    }
}
</script>
