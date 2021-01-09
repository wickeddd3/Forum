<script>
import Replies from '../components/Replies.vue';
import FollowButton from '../components/FollowButton.vue';
import snackbar from './../mixins/snackbar';

export default {
    props: [
        'initialRepliesCount',
        'initialFollowsCount'
    ],

    mixins:[snackbar],

    components: {
        Replies,
        FollowButton
    },

    data() {
        return {
            repliesCount: this.initialRepliesCount,
            followsCount: this.initialFollowsCount
        }
    },

    methods: {
        closeThread() {
            axios.put(`${location.pathname}/closethread`)
                .then(response => {
                    this.snackbar("Thread has been closed")
                })
                .catch((error) => {
                    this.snackbar("Error occurred while closing thread");
                });
        },
        openThread() {
            axios.put(`${location.pathname}/openthread`)
                .then(response => {
                    this.snackbar("Thread has been opened")
                })
                .catch((error) => {
                    this.snackbar("Error occurred while opening thread");
                });
        },
    }
}
</script>
