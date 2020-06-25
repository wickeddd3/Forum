<template>
    <div v-if="notifications.length">
        <template v-for="(notification, index) in notifications">
            <a class="dropdown-item"
                :key="index"
                :href="notification.data.link"
                v-text="notification.data.message"
                @click="markAsRead(notification)"></a>
        </template>
    </div>
    <div v-else>
        <a class="dropdown-item">No notifications</a>
    </div>
</template>

<script>
export default {

    data() {
        return {
            notifications: false
        }
    },

    created() {
        axios.get("/profiles/" + window.App.user.id + "/notifications")
             .then(response => this.notifications = response.data);
    },

    methods: {
        markAsRead(notification) {
            axios.delete('/profiles/' + window.App.user.id + '/notifications/' + notification.id)
        }
    }
}
</script>
