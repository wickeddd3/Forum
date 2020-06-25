@extends('layouts.app')

@section('title')
Forum
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/forum.css') }}" />
<style>
.sticky {
    position: -webkit-sticky; /* Safari */
    position: sticky;
    top: 0;
}
</style>
@endsection

@section('content')
<threads-view inline-template>
<div>
    <section class="container">
        <div class="columns">
            <div class="column is-3">
                <div id="sidebar">
                    <a class="button is-info is-block" href="/thread/create">Start Discussion</a>
                    <a class="button is-primary is-small is-block mt-3" href="/threads">All Discussion</a>
                    <aside class="menu mt-5">
                        <p class="menu-label">
                            Topics
                        </p>
                        <ul class="menu-list">
                            @foreach($channels as $channel)
                                <li>
                                    <a href="/threads/{{ $channel->slug }}" class="button is-small is-primary">
                                        {{ $channel->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </aside>
                </div>
            </div>
            <div class="column is-9">
                <div class="box content">
                    <thread></thread>
                </div>
            </div>
        </div>
    </section>
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
