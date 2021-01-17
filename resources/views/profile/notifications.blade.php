@extends('layouts.app')

@section('title')
Forum | Notifications
@endsection

@section('content')
<notifications-view inline-template>
<div class="container mt-4">
    <h1 class="is-size-4 mb-4">
        Notifications <b-icon icon="bell-ring" size="is-small">
    </h1>
    <div v-if="notifications.length">
        <template v-for="(notification, index) in notifications">
            <a @click="markAsRead(notification)"
               :href="notification.data.link"
               :key="index"
               class="p-1">
                <div class="notification is-success is-light"
                     v-text="notification.data.message">
                </div>
            </a>
        </template>
    </div>
    <div v-else>
        <div class="has-text-centered">No new notifications</div>
    </div>
</div>
</notifications-view>
@endsection
