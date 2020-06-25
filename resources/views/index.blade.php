@extends('layouts.app')

@section('title')
Forum
@endsection

@section('content')
<section class="hero">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="columns is-8 is-variable is-vcentered">
                <div class="column is-two-thirds has-text-left">
                    <h1 class="title is-1">Create your account now!</h1>
                    <p class="is-size-4">
                        Share your ideas, questions, and insights with the topics you like.
                    </p>
                </div>
                <div class="column is-one-third has-text-left">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input @error('name') is-danger @enderror"
                                       value="{{ old('name') }}"
                                       type="text"
                                       name="name"
                                       placeholder="Name"
                                       autocomplete="name"
                                       autofocus />
                                @error('name')
                                    <span class="help is-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Username</label>
                            <div class="control">
                                <input class="input @error('username') is-danger @enderror"
                                       value="{{ old('username') }}"
                                       type="text"
                                       name="username"
                                       placeholder="Username"
                                       autocomplete="username"
                                       autofocus />
                                @error('username')
                                    <span class="help is-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">E-mail</label>
                            <div class="control">
                                <input class="input @error('email') is-danger @enderror"
                                       value="{{ old('email') }}"
                                       type="email"
                                       name="email"
                                       placeholder="E-mail"
                                       autocomplete="email"
                                       autofocus />
                                @error('email')
                                    <span class="help is-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input @error('password') is-danger @enderror"
                                       type="password"
                                       name="password"
                                       placeholder="**********"
                                       autocomplete="current-password"
                                       autofocus />
                                @error('password')
                                    <span class="help is-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input"
                                       type="password"
                                       name="password_confirmation"
                                       placeholder="confirm *****"
                                       autocomplete="new-password" />
                            </div>
                        </div>

                        <div class="control">
                            <button type="submit" class="button is-link is-fullwidth has-text-weight-medium is-medium">Create account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
