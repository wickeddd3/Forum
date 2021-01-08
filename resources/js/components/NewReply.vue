<template>
<div>
    <template v-if="signedIn">
        <div class="container my-5" v-if="verified">
            <textarea class="textarea is-small" v-model="message" placeholder="Write your reply here..."></textarea>
            <p class="is-block has-text-right my-2">
                <button class="button is-small is-success " @click="addReply">Post reply</button>
            </p>
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
