@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-flex is-justify-content-center mt-2">
        <div class="column is-5">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Sign In
                    </p>
                </header>
                <div class="card-content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="field">
                            <label class="label">E-Mail</label>
                            <div class="control">
                                <input class="input @error('email') is-danger @enderror"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        autocomplete="email"
                                        autofocus>
                            </div>
                        </div>
                        @error('email')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                        <div class="field">
                            <label class="label">Password</label>
                            <div class="control">
                                <input class="input @error('password') is-danger @enderror"
                                        type="password"
                                        name="password"
                                        placeholder="********"
                                        autocomplete="current-password">
                            </div>
                        </div>
                        @error('password')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                        <div class="field my-5">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <button class="button is-success is-fullwidth" type="submit">Login</button>
                    </form>
                </div>
                <footer class="card-footer">
                    <a href="/register" class="card-footer-item">
                        Already have an account ?
                    </a>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="card-footer-item">
                            Forgot Your Password
                        </a>
                    @endif
                </footer>
            </div>
        </div>
    </div>
</div>
@endsection
