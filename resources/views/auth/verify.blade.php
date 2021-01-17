@extends('layouts.app')

@section('title')
Forum | Verify E-Mail
@endsection

@section('content')
<div class="columns is-flex is-justify-content-center mt-5">
    <div class="column is-5">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    Verify Your Email Address
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    @if (session('resent'))
                    <article class="message is-success">
                        <div class="message-body">
                            A fresh verification link has been sent to your email address.
                        </div>
                    </article>
                    @endif
                    Before proceeding, please check your email for a verification link.
                    If you did not receive the email click here to request another.
                    <form method="POST" action="{{ route('verification.resend') }}" class="is-flex is-justify-content-center mt-3">
                        @csrf
                        <button type="submit" class="button is-success">
                            Request another verification link
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
