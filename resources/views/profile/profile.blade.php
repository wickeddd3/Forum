@extends('layouts.app')

@section('content')
<profile-view inline-template>
<div>
    <section class="hero is-info">
        <div class="hero-body">
            <div class="container">
                <article class="media">
                    <div class="media-left">
                        <figure class="image is-64x64">
                            <img src="{{ asset('/storage/'.$profile->profile->avatar) }}" class="is-rounded" alt="Image">
                        </figure>
                    </div>
                    <div class="media-content">
                        <div class="content">
                            <strong class="has-text-white">{{ $profile->name }}</strong>
                            <p>
                                <small class="has-text-weight-bold">{{ '@'.$profile->username }}</small>
                                <small>joined {{ $profile->created_at->diffForHumans() }}</small>
                                <br>
                            </p>
                            {{ $profile->profile->about }}
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <br>

    <section class="container">
        <b-tabs type="is-boxed" size="is-small" position="is-centered">
            <b-tab-item label="Profile" icon="account">
                <profile :profile="profile"></profile>
            </b-tab-item>
            <b-tab-item label="Discussions" icon="message-reply-text">
                <discussions :threads="threads"></discussions>
            </b-tab-item>
            <b-tab-item label="Replies" icon="message-reply">
                <replies :replies="replies"></replies>
            </b-tab-item>
            <b-tab-item label="Activity" icon="comment-account">
                <activity :activity="activity"></activity>
            </b-tab-item>
        </b-tabs>
    </section>
</div>
</profile-view>
@endsection
