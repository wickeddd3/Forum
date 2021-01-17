<script>
export default {
    data() {
        return {
            notifications: false
        }
    },

    created() {
        axios.get(`/profiles/${window.App.user}/notifications`)
             .then(response => this.notifications = response.data);
    },

    methods: {
        markAsRead(notification) {
            axios.post(`/profiles/${window.App.user}/notifications`, {id: notification.id})
        }
    }
}
</script>
