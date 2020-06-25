<script>
import Replies from '../components/Replies.vue';
import FollowButton from '../components/FollowButton.vue';

export default {
    props: [
        'initialRepliesCount',
        'initialFollowsCount'
    ],

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
}
</script>
