<template>
<div>
    <template v-if="items.length > 0">
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>
    </template>
    <template v-else>
        <p class="has-text-centered my-5">
            <i class="fas fa-comments"></i> No replies
        </p>
    </template>
    <new-reply @created="add"></new-reply>
</div>
</template>

<script>
import Reply from './Reply.vue';
import NewReply from './NewReply.vue';
import collection from '../mixins/collection';

export default {
    components: { Reply, NewReply },

    mixins: [collection],

    data() {
        return { dataSet: false };
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch() {
            axios.get(location.pathname + '/replies')
                 .then((response) => {
                    this.dataSet = response;
                    this.items = response.data;
            });
        },

    }
}
</script>
