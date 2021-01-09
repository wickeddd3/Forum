<template>
<div>
    <template v-if="items.length > 0">
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply"
                   :thread_user_id="thread_user_id"
                   :best_reply_id="best_reply_id"
                   @deleted="remove(index)"
            ></reply>
        </div>
    </template>
    <template v-else>
        <h6 class="subtitle is-6 has-text-centered my-5">
            <span class="is-size-3 is-block my-2">
                <i class="fas fa-comments"></i>
            </span>
            No replies
        </h6>
    </template>
    <new-reply @created="add"
               :closed="closed">
    </new-reply>
</div>
</template>

<script>
import Reply from './Reply.vue';
import NewReply from './NewReply.vue';
import collection from '../mixins/collection';

export default {
    props:[
        'best_reply_id',
        'thread_user_id',
        'closed'
    ],

    components: {
        Reply,
        NewReply
    },

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
