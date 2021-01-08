<template>
<div>
    <div class="columns mt-0 mb-0">
        <div class="column">
            <b-dropdown v-model="currentMenu" aria-role="list">
                <button class="button is-small is-info" type="button" slot="trigger">
                    <template>
                        <span>{{currentMenu.text}}</span>
                    </template>
                    <b-icon icon="menu-down"></b-icon>
                </button>
                <b-dropdown-item
                    v-for="(menu, index) in menus"
                    :key="index"
                    @click="filter(menu.text)"
                    :value="menu" aria-role="listitem">
                    {{menu.text}}
                </b-dropdown-item>
            </b-dropdown>
        </div>
        <div class="column">
            <b-input
                v-model="search"
                rounded
                size="is-small"
                type="text"
                icon="magnify"
                icon-right="close-circle"
                icon-right-clickable
                icon-clickable
                @icon-click="fetch()"
                @icon-right-click="search = ''">
            </b-input>
        </div>
    </div>

    <div v-if="all_threads.length > 0">
        <div v-for="thread in all_threads" :key="thread.id">
            <article class="post">
                <h1 class="is-size-6">
                    <a class="has-text-dark" :href="thread.path">{{ limitContent(thread.title, 70) }}</a>
                </h1>
                <div class="media">
                    <div class="media-left">
                        <p class="image is-32x32">
                            <img :src="'/storage/'+thread.creator.profile.avatar">
                        </p>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <p class="has-text-dark">
                                {{ `@${thread.creator.username} ${created(thread.created_at)}` }}
                            </p>
                        </div>
                    </div>
                    <div class="media-right">
                        <span class="has-text-grey-light">
                            <span class="tag mr-2">{{ thread.channel.name }}</span>
                            <i class="fa fa-comments"></i> {{ thread.replies_count }}
                        </span>
                    </div>
                </div>
            </article>
        </div>
        <load-more :dataSet="dataSet" :loading="loading" @changed="fetch"></load-more>
    </div>

    <div class="container has-text-centered" v-else>
        <h6>No discussions found</h6>
    </div>
</div>
</template>

<script>
import moment from 'moment'
import LoadMore from '../components/LoadMore'

export default {
    components: {
        LoadMore
    },

    data() {
        return {
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
        created(date) {
            return moment(date).fromNow();
        },
        filter(filter) {
            this.search = '';
            history.pushState(null, null, `/threads/${filter.toLowerCase()}`);
            this.fetch();
        },
        fetch(page) {
            this.loading = true;
            if(! page) {
                let query = location.search.match(/page=(\d+)/);
                page = query ? query[1] : 1;
                this.dataSet = [];
                this.all_threads = [];
            }

            let url;
            if(this.search != "") {
                history.pushState(null, null, '/threads?search='+this.search)
                url = `/threads?search=${this.search}&page=${page}`
            } else {
                url = `${location.pathname}?page=${page}`;
            }

            axios.get(url)
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
        limitContent(content, noOfChar) {
            if(content.length > noOfChar) {
                return content.substr(0, noOfChar) + '...';
            }
            return content;
        },
    }
}
</script>
