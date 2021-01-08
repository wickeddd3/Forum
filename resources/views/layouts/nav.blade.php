<b-navbar wrapper-class="container">
    <template slot="brand">
        <b-navbar-item href="/">
            <div class="logo">
                <img src="{{ asset('images/forum.png') }}" class="logo__img" />
                <span class="logo__text">forum</span>
            </div>
        </b-navbar-item>
    </template>
    <template slot="start">
        <b-navbar-item href="/threads">
            Threads
        </b-navbar-item>
    </template>

    <template slot="end">
        @guest
            <b-navbar-item tag="div">
                <div class="buttons">
                    <a href="/register" class="button is-info">
                        <strong>Sign up</strong>
                    </a>
                    <a href="/login" class="button is-light">
                        Sign in
                    </a>
                </div>
            </b-navbar-item>
        @else
            <b-navbar-dropdown label="{{ Auth::user()->username }}">
                <b-navbar-item href="/{{ Auth::user()->username }}/profile">
                    &nbsp; <b-icon icon="account-circle" size="is-small"></b-icon> &nbsp; Profile
                </b-navbar-item>
                <b-navbar-item href="/{{ Auth::user()->username }}/notifications">
                    <b-icon icon="bell" size="is-small"></b-icon> &nbsp; Notifications
                    <strong class="has-text-info"> &nbsp; {{ Auth::user()->unreadNotifications->count() }}</strong>
                </b-navbar-item>
                <b-navbar-item href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <b-icon icon="login" size="is-small"></b-icon> &nbsp; Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </b-navbar-item>
            </b-navbar-dropdown>
        @endif
    </template>
</b-navbar>
