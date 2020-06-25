<template>
    <span>
        <span>
            <span v-text="count"></span>
            <i class="fas fa-thumbs-up"></i>
        </span>
        <span v-if="signedIn">
            <a class="has-text-dark" v-if="this.active" @click="toggle()">
               · Unlike
            </a>
            <a class="has-text-dark" v-else @click="toggle()">
               · Like
            </a>
        </span>
    </span>
</template>

<script>
export default {
    props: ['reply'],

    data() {
        return {
            count: this.reply.likesCount,
            active: this.reply.isLiked,
        }
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        },
        endpoint() {
            return '/replies/' + this.reply.id + '/likes';
        }
    },

    methods: {
        toggle() {
            this.active ? this.destroy() : this.create();
        },
        create() {
            axios.post(this.endpoint);
            this.active = true;
            this.count++;
        },
        destroy() {
            axios.delete(this.endpoint);
            this.active = false;
            this.count--;
        }
    }
}
</script>
