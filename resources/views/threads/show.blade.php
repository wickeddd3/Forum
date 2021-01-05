@extends('layouts.app')

@section('content')
<thread-view initial-replies-count="{{ $thread->replies_count }}" initial-follows-count="{{ $thread->followers()->count() }}" inline-template>
<div class="container mt-5 mb-5">

    <h1 class="is-size-4 is-family-monospace has-text-weight-semibold mb-2">
        {{ $thread->title }}
        @if($thread->updated_at)
            <span style="font-size:12px;">&nbsp; Edited</span>
        @endif
    </h1>

    <article class="media">

        <figure class="media-left">
            <p class="image is-64x64">
                <img src="{{ asset('/storage/'.$thread->creator->profile->avatar) }}" width="10%">
            </p>
        </figure>

        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ $thread->creator->name }}</strong>
                    <small>{{ '@'.$thread->creator->username }}</small>
                    <small>{{ \Carbon\Carbon::parse($thread->created_at)->diffForHumans() }}</small>
                    <br>
                </p>
                {!! $thread->content !!}
            </div>

            <nav class="level is-mobile">
                <div class="level-left">
                    @if(auth()->check())
                    <a href="#reply" class="level-item has-text-dark">
                        <span class="icon is-small"><i class="fas fa-reply"></i></span>
                    </a>
                    · &nbsp;
                    @endif
                    <span class="level-item">
                        <span v-text="followsCount"></span> &nbsp;
                        <span class="icon is-small"><i class="fas fa-user"></i></span>
                    </span>
                    @if(auth()->check())
                    · &nbsp;
                    <span class="level-item">
                        <follow-button @followed="followsCount++"
                                        @unfollowed="followsCount--"
                                        :active="{{ json_encode($thread->isFollowedTo) }}">
                        </follow-button>
                    </span>
                    @endif
                </div>
            </nav>

            <replies @added="repliesCount++" @removed="repliesCount--"></replies>
        </div>

        <figure class="media-right">
            @if(Auth::id() === $thread->user_id)
                <span class="is-size-7">
                    <a class="has-text-dark" href="{{ $thread->path() }}/edit">
                        <i class="fas fa-edit"></i>
                    </a>
                </span>
            @endif
        </figure>

    </article>

</div>
</thread-view>
@endsection
