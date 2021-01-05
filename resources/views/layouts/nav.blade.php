<nav class="navbar is-white topNav">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="{{ asset('images/forum.png') }}" width="20px" />  <b style="font-size:24px;margin-left:8px;">forum</b>
            </a>
            <div class="navbar-burger burger" data-target="topNav">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="topNav" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/threads">Threads</a>
            </div>
            <div class="navbar-end">
                @guest
                <a class="navbar-item" href="/register">Sign Up</a>
                <a class="navbar-item" href="/login">Sign In</a>
                @else
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        <span class="image is-24x24 mr-2">
                            <img src="{{ '/storage/'.Auth::user()->profile->avatar }}" class="is-rounded">
                        </span>
                        {{ Auth::user()->username }}
                    </a>
                    <div class="navbar-dropdown">
                        <a  href="/{{ Auth::user()->username }}/profile" class="navbar-item">
                            <b-icon icon="account-circle" size="is-small"></b-icon> &nbsp; Profile
                        </a>
                        <a href="/{{ Auth::user()->username }}/notifications" class="navbar-item">
                            <b-icon icon="bell" size="is-small"></b-icon> &nbsp; Notifications
                            <strong class="has-text-info"> &nbsp; {{ Auth::user()->unreadNotifications->count() }}</strong>
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <b-icon icon="login" size="is-small"></b-icon> &nbsp; Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</nav>


{{-- <b-navbar>
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
        <b-navbar-dropdown label="Profile">
            <b-navbar-item href="#">
                About
            </b-navbar-item>
            <b-navbar-item href="#">
                Contact
            </b-navbar-item>
        </b-navbar-dropdown>
        <b-navbar-item tag="div">
            <div class="buttons">
                <a href="/register" class="button is-primary">
                    <strong>Sign up</strong>
                </a>
                <a href="/login" class="button is-light">
                    Log in
                </a>
            </div>
        </b-navbar-item>
    </template>
</b-navbar> --}}
