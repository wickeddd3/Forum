<template>
<div class="container">
    <div v-for="reply in replies" :key="reply.id">
        <article class="media mb-1">
            <figure class="media-left">
                <p class="image is-48x48">
                    <img :src="'/storage/'+reply.owner.avatar" class="is-rounded">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <a class="has-text-dark" :href="reply.thread.path">
                        <strong>{{ reply.owner.name }}</strong>
                        <small>replied to <b>{{ reply.thread.title }}</b> {{ created(reply.created_at) }}</small>
                        <br>
                        {{ reply.message }}
                    </a>
                </div>
            </div>
            <div class="media-right">
                <span class="tag">{{ reply.likesCount }} likes</span>
            </div>
        </article>
    </div>
</div>
</template>

<script>
import moment from 'moment'

export default {
    props:['replies'],

    methods: {
        created(date) {
            return moment(date).fromNow();
        },
    }
}
</script>
