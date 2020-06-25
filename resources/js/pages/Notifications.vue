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
