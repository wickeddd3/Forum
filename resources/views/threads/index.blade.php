@extends('layouts.app')

@section('title')
Forum | Threads
@endsection

@section('content')
<threads-view inline-template>
<div class="container">
    <div class="columns">
        <div class="column is-3 p-5">
            <div id="sidebar" class="py-3">
                <a class="button is-success is-block" href="/thread/create">Start Discussion</a>
                <a class="button is-info is-block mt-3" href="/threads">All Discussions</a>
                <aside class="menu mt-5">
                    <h6 class="title is-6">
                        <i class="fas fa-lightbulb"></i> Topics
                    </h6>
                    <div class="tags">
                        @foreach($channels as $channel)
                            <span class="tag is-info">
                                <a class="has-text-white" @click="filter( {{ json_encode($channel->slug) }} , 'channel')">
                                    {{ $channel->name }}
                                </a>
                            </span>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
        <div class="column is-9">
            <div class="box content">
                <div class="columns">
                    <div class="column">
                        <b-dropdown v-model="currentMenu" aria-role="list">
                            <button class="button is-small is-info" type="button" slot="trigger">
                                <template>
                                    <span v-text="currentMenu.text"></span>
                                </template>
                                <b-icon icon="menu-down"></b-icon>
                            </button>
                            <b-dropdown-item
                                v-for="(menu, index) in menus"
                                :key="index"
                                @click="filter(menu.text, 'filter')"
                                :value="menu"
                                aria-role="listitem"
                                v-text="menu.text">
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
                            @icon-click="filter(search, 'query')"
                            @icon-right-click="search = ''">
                        </b-input>
                    </div>
                </div>

                <div v-if="all_threads.length > 0">
                    <div v-for="thread in all_threads" :key="thread.id">
                        <article class="post">
                            <h1 class="is-size-6">
                                <a class="has-text-dark" :href="thread.path" v-text="limitContent(thread.title, 70)"></a>
                            </h1>
                            <div class="media">
                                <div class="media-left">
                                    <p class="image is-32x32">
                                        <img class="is-rounded" :src="'/storage/'+thread.creator.avatar">
                                    </p>
                                </div>
                                <div class="media-content">
                                    <div class="content">
                                        <p class="has-text-dark" v-text="creator(thread)"></p>
                                    </div>
                                </div>
                                <div class="media-right">
                                    <span class="has-text-grey-light">
                                        <span class="tag mr-2" v-text="thread.channel.name"></span>
                                        <i class="fa fa-comments"></i>
                                        <span v-text="thread.replies_count"></span>
                                    </span>
                                </div>
                            </div>
                        </article>
                    </div>
                    <load-more :data-set="dataSet" :loading="loading" @changed="updatePage"></load-more>
                </div>

                <div class="container has-text-centered" v-else>
                    <h6>No discussions found</h6>
                </div>
            </div>
        </div>
    </div>
</div>
</threads-view>
@endsection

@section('scripts')
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("sidebar");
var sticky = header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
    } else {
    header.classList.remove("sticky");
    }
}
</script>
@endsection
