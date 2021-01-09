<template>
<article class="media my-2" :class="{'has-background-success-light p-5': best_reply_id == data.id}" :id="'reply-'+id">
    <div class="media-left">
        <figure class="image is-48x48">
            <img class="is-rounded" :src="'/storage/'+data.owner.avatar">
        </figure>
    </div>
    <div class="media-content">
        <div class="content">
            <div class="is-flex is-justify-content-space-between">
                <span>
                    <h6 class="subtitle is-6 is-inline">{{ data.owner.name }}</h6>
                    <small> {{ `@${data.owner.username}` }} </small>
                </span>
                <span>
                    <span class="is-size-7" v-if="canUpdate">
                        <a class="has-text-dark mr-2" @click="editing = true">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="has-text-dark" @click="destroy">
                            <i class="fas fa-trash"></i>
                        </a>
                    </span>
                </span>
            </div>
            <div v-if="editing">
                <textarea class="textarea is-small my-2" v-model="message"></textarea>
                <span>
                    <button class="button is-small is-success" @click="update">Update</button>
                    <button class="button is-small is-warning" @click="editing = false">Cancel</button>
                </span>
            </div>
            <div v-text="message" v-else></div>
            <div class="is-flex is-justify-content-space-between is-flex-wrap-wrap">
                <small>
                    <like :reply="data"></like>· {{ ago }}
                </small>
                <small>
                    <span v-if="best_reply_id == data.id">
                        <i class="fas fa-award"></i> Marked as Best Reply
                    </span>
                    <span v-else>
                        <a v-if="canMarkReplyAsBestReply" @click="markAsBestReply">Mark as Best Reply</a>
                    </span>
                </small>
            </div>
        </div>
    </div>
</article>
</template>

<script>
import Like from './Like.vue'
import moment from 'moment'
import snackbar from './../mixins/snackbar'

export default {
    props: [
        'data',
        'best_reply_id',
        'thread_user_id'
    ],

    mixins:[snackbar],

    components: {
        Like,
    },

    data() {
        return {
            editing: false,
            id: this.data.id,
            message: this.data.message,
        }
    },

    computed: {
        ago() {
            return moment(this.data.created_at).fromNow();
        },
        canUpdate() {
            if(window.App.user && window.App.verified){
                return this.data.user_id == window.App.user;
            }
        },
        canMarkReplyAsBestReply() {
            return (this.thread_user_id === window.App.user) ? true : false;
        }
    },

    methods: {
        update() {
            axios.patch('/replies/' + this.data.id, {
                    message: this.message
                })
                .then((response) => {
                    this.editing = false;
                    this.snackbar("Your reply has been updated.")
                })
                .catch((error) => {
                    this.editing = false;
                    this.snackbar("Error occurred while updating your reply");
                });
        },
        destroy() {
            axios.delete('/replies/' + this.data.id)
                .then((response) => {
                    this.$emit('deleted', this.data.id);
                    this.snackbar("Your reply has been deleted.")
                })
                .catch((error) => {
                    this.snackbar("Error occurred while deleting your reply");
                });
        },
        markAsBestReply() {
            axios.put(`${location.pathname}/bestreply`, {reply_id: this.data.id})
                .then(response => {
                    this.snackbar("Reply has been mark as best reply.")
                })
                .catch((error) => {
                    this.snackbar("Error occurred while marking reply as best reply");
                });
        }
    }
}
</script>
