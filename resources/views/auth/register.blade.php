@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-flex is-justify-content-center mt-2">
        <div class="column is-5">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Sign Up
                    </p>
                </header>
                <div class="card-content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input @error('name') is-danger @enderror"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        autocomplete="name"
                                        autofocus>
                            </div>
                        </div>
                        @error('name')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                        <div class="field">
                            <label class="label">Username</label>
                            <div class="control">
                                <input class="input @error('username') is-danger @enderror"
                                        type="text"
                                        name="username"
                                        value="{{ old('username') }}"
                                        autocomplete="username"
                                        autofocus>
                            </div>
                        </div>
                        @error('username')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                        <div class="field">
                            <label class="label">E-Mail</label>
                            <div class="control">
                                <input class="input @error('email') is-danger @enderror"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        autocomplete="email">
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
                        <div class="field">
                            <label class="label">Confirm Password</label>
                            <div class="control">
                                <input class="input"
                                        type="password"
                                        name="password_confirmation"
                                        placeholder="********"
                                        autocomplete="new-password">
                            </div>
                        </div>
                        <button class="button is-success is-fullwidth" type="submit">Register</button>
                    </form>
                </div>
                <footer class="card-footer">
                    <a href="/login" class="card-footer-item">
                        Already have an account ?
                    </a>
                </footer>
            </div>
        </div>
    </div>
</div>
@endsection
