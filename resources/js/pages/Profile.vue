<script>
import Profile from './../components/profile/Profile'
import Discussions from './../components/profile/Discussions'
import Replies from './../components/profile/Replies'
import Activity from './../components/profile/Activity'
import snackbar from './../mixins/snackbar'

export default {
    mixins:[snackbar],

    data() {
        return {
            profile:[],
            threads:[],
            replies:[],
            activity:[],
        }
    },

    created() {
        this.fetch();
    },

    components: {
        Profile,
        Discussions,
        Replies,
        Activity,
    },

    methods: {
        fetch() {
            axios.post(location.pathname)
                 .then((response) => {
                    this.profile = response.data.profile;
                    this.threads = response.data.threads;
                    this.replies = response.data.replies;
                    this.activity = response.data.activity;
                 })
                 .catch((error) => {
                    this.snackbar("Error occurred while fetching your profile");
                 })
        }
    }

}
</script>
