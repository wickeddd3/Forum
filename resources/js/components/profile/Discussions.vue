<template>
<div class="container">
    <div v-for="thread in threads" :key="thread.id">
        <article class="media mb-1">
            <figure class="media-left">
                <p class="image is-48x48">
                    <img :src="'/storage/'+thread.creator.profile.avatar" class="is-rounded">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <a class="has-text-dark" :href="thread.path">
                        <strong>{{ thread.creator.name }}</strong> <small>posted {{ created(thread.created_at) }}</small>
                        <br>
                        {{ thread.title }}
                    </a>
                </div>
            </div>
            <div class="media-right">
                <span class="tag">{{ thread.channel.name }}</span>
            </div>
        </article>
    </div>
</div>
</template>

<script>
import moment from 'moment'

export default {
    props:['threads'],

    methods: {
        created(date) {
            return moment(date).fromNow();
        },
    }
}
</script>
