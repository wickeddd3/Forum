<template>
<div class="content">
    <div v-for="(activities, date, index) in activity" :key="index">
        <div class="container pb-2">
            <h1 class="is-size-6">{{ date }}</h1>
            <div v-for="activity in activities" :key="activity.id">
                <div v-if="activity.type == 'created_thread'">
                    <strong>{{ activity.subject.creator.name }}</strong>
                    <small>posted: {{ activity.subject.title }}</small>
                </div>
                <div v-else-if="activity.type == 'created_reply'">
                    <strong>{{ activity.subject.owner.name }}</strong>
                    <small>replied {{ activity.subject.message }} to: {{ activity.subject.thread.title }}</small>
                </div>
                <!-- <div v-else-if="activity.type == 'created_like'">
                    <strong>{{ activity.subject.user.name }}</strong>
                    <small>liked: {{ activity.subject.reply.message }}</small>
                </div> -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:['activity']
}
</script>
