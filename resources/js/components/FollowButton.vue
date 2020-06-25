<template>
    <span>
        <a class="has-text-dark" v-if="this.activeButton" @click="follow">
            Unfollow
        </a>
        <a class="has-text-dark" v-else @click="follow">
            Follow
        </a>
    </span>
</template>

<script>
export default {
    props: ['active'],

    data() {
        return {
            activeButton: this.active
        }
    },

    methods: {
        follow() {
            axios[(this.activeButton ? 'delete' : 'post')](location.pathname + '/follows')
                .then((response) => {
                    (this.activeButton) ? this.$emit('unfollowed') : this.$emit('followed');
                    this.activeButton = ! this.activeButton;
                });
        }
    }
}
</script>
