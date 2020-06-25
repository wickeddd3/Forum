<template>
<div>
    <div v-if="items.length > 0">
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)"></reply>
            <br>
        </div>
    </div>
    <div v-else>
        <div class="container has-text-centered has-text-weight-semibold pb-5">
            No replies yet.
        </div>
    </div>

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
