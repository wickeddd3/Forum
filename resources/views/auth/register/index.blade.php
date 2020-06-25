@extends('auth.app')

@section('title')
Register
@endsection

@section('content')
<section class="hero is-fullheight">
    <div class="hero-body has-text-centered">
        <div class="login">
            <a href="/">
                <img src="{{ asset('images/forum.png') }}" width="30px" />  <b style="font-size:38px;margin-left:8px;">forum</b>
            </a>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-rounded @error('name') is-danger @enderror"
                               value="{{ old('name') }}"
                               type="text"
                               name="name"
                               placeholder="Name"
                               autocomplete="name"
                               autofocus />
                        @error('name')
                            <span class="help is-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-rounded @error('username') is-danger @enderror"
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
                        <input class="input is-medium is-rounded @error('email') is-danger @enderror"
                               value="{{ old('email') }}"
                               type="email"
                               name="email"
                               placeholder="E-mail"
                               autocomplete="email"
                               autofocus />
                        @error('email')
                            <span class="help is-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-rounded @error('password') is-danger @enderror"
                               type="password"
                               name="password"
                               placeholder="**********"
                               autocomplete="current-password"
                               autofocus />
                        @error('password')
                            <span class="help is-danger"> {{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input is-medium is-rounded"
                               type="password"
                               name="password_confirmation"
                               placeholder="confirm *****"
                               autocomplete="new-password" />
                    </div>
                </div>
                <br />
                <button class="button is-block is-fullwidth is-primary is-medium is-rounded" type="submit">
                    Register
                </button>
            </form>
            <br>
            <nav class="level">
                <div class="level-item has-text-centered">
                    <div>
                        Already have an account <a href="/login">Login</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</section>
@endsection
