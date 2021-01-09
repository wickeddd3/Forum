@extends('layouts.app')

@section('title')
Forum Threads
@endsection

@section('content')
<threads-view inline-template>
<div class="container">
    <div class="columns">
        <div class="column is-3">
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
                                <a class="has-text-white" href="/threads/{{ $channel->slug }}">
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
                <thread></thread>
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
