<script>
import moment from 'moment'
import LoadMore from '../components/LoadMore'

export default {
    components: {
        LoadMore
    },

    data() {
        return {
            url: location.pathname,
            page: 1,
            all_threads: [],
            dataSet: false,
            search: '',
            currentMenu: { text: 'Latest' },
            menus: [
                { text: 'Latest' },
                { text: 'Popular' },
                { text: 'Oldest' },
            ],
            loading: false,
        }
    },

    created() {
        this.fetch();
    },

    computed: {
        signedIn() {
            return window.App.signedIn;
        },
    },

    methods: {
        ago(date) {
            return moment(date).fromNow();
        },
        filter(query, filter) {
            if(filter == "channel") {
                history.pushState(null, null, `/threads/${query}`);
                this.search = '';
            } else if(filter == "filter") {
                history.pushState(null, null, `/threads?search=${query.toLowerCase()}`);
                this.search = '';
            } else {
                history.pushState(null, null, `/threads?search=${query.toLowerCase()}`);
            }
            this.page = 1;
            this.fetch();
        },
        setUrl() {
            if(!location.search) {
                this.url = `${location.pathname}?page=${this.page}`;
            } else {
                this.url = `${location.pathname}${location.search}&page=${this.page}`;
            }
        },
        clearData() {
            if(this.page == 1) {
                this.dataSet = [];
                this.all_threads = [];
            }
        },
        fetch() {
            this.loading = true;
            this.clearData();
            this.setUrl();
            axios.get(`${this.url}`)
                 .then(({data}) => {
                    let items = data.threads.data;
                    this.dataSet = data.threads
                    this.all_threads = [...this.all_threads, ...items];
                    this.loading = false;
                })
                .catch((error) => {
                    this.loading = false;
                });
        },
        updatePage(page) {
            this.page = page;
            this.fetch();
        },
        limitContent(content, noOfChar) {
            if(content.length > noOfChar) {
                return content.substr(0, noOfChar) + '...';
            }
            return content;
        },
        creator(thread) {
            return `@${thread.creator.username} ${this.ago(thread.created_at)}`
        }
    }
}
</script>
