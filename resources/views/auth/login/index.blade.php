@extends('auth.app')

@section('title')
Login
@endsection

@section('content')
<section class="hero is-fullheight">
    <div class="hero-body has-text-centered">
        <div class="login">
            <a href="/">
                <img src="{{ asset('images/forum.png') }}" width="30px" />  <b style="font-size:38px;margin-left:8px;">forum</b>
            </a>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-rounded"
                               value="{{ old('username') }}"
                               type="text"
                               name="username"
                               placeholder="Username"
                               autocomplete="username"
                               autofocus />
                        @error('username')
                            <span class="help is-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-rounded"
                               type="password"
                               name="password"
                               placeholder="**********"
                               autocomplete="current-password" />
                        @error('password')
                            <span class="help is-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <br />
                <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                    Login
                </button>
            </form>
            <br>
            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                    <a href="/register">Create an Account</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</section>
@endsection
