@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-flex is-justify-content-center mt-2">
        <div class="column is-5">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Reset Password
                    </p>
                </header>
                <div class="card-content">
                    @if (session('status'))
                        <div class="notification is-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="field">
                            <label class="label">E-Mail Address</label>
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
                        <button class="button is-success is-fullwidth my-3" type="submit">Send Password Reset Link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
