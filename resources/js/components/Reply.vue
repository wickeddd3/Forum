<template>
<article class="media my-2" :id="'reply-'+id">
    <div class="media-left">
        <figure class="image is-48x48">
            <img class="is-rounded" :src="'/storage/'+data.owner.profile.avatar">
        </figure>
    </div>
    <div class="media-content">
        <div class="content">
            <h6 class="subtitle is-6 is-inline">{{ data.owner.name }}</h6>
            <small> {{ `@${data.owner.username}` }} </small>
            <div v-if="editing">
                <textarea class="textarea is-small my-2" v-model="message"></textarea>
                <span>
                    <button class="button is-small is-success" @click="update">Update</button>
                    <button class="button is-small is-warning" @click="editing = false">Cancel</button>
                </span>
            </div>
            <div v-text="message" v-else></div>
            <small>
                <like :reply="data"></like>· {{ ago }}
            </small>
        </div>
    </div>
    <div v-if="canUpdate" class="media-right">
        <span  class="is-size-7">
            <a class="has-text-dark mr-2" @click="editing = true">
                <i class="fas fa-edit"></i>
            </a>
            <a class="has-text-dark" @click="destroy">
                <i class="fas fa-trash"></i>
            </a>
        </span>
    </div>
</article>
</template>

<script>
import Like from './Like.vue'
import moment from 'moment'
import snackbar from './../mixins/snackbar'

export default {
    props: ['data'],

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
        }
    }
}
</script>
