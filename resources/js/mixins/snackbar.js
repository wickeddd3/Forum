export default {
    methods: {
        snackbar(message) {
            this.$buefy.toast.open({
                duration: 3000,
                message: `${message}`,
                position: 'is-top-right',
                queue: false
            })
        }
    }
}
