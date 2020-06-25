<template>
<div>
    <article class="media" id="reply" v-if="signedIn">
        <figure class="media-left">
            <p class="image is-64x64">
                <img :src="'/storage/'+user.profile.avatar" width="5%">
            </p>
        </figure>
        <div class="media-content">
            <div class="field">
                <p class="control">
                <textarea class="textarea is-small" v-model="message" placeholder="Add a reply..."></textarea>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <button class="button is-primary is-small" @click="addReply">Post reply</button>
                </p>
            </div>
        </div>
    </article>

    <div class="container has-text-centered" v-else>
        Please <a href="/login"><b>Log In</b></a> to participate in this discussions
    </div>
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
        user() {
            return window.App.user;
        },
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
