@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <section class="empty-state mx-auto" style="max-width: 620px;">
            <i class="bi bi-envelope-check"></i>
            <h1 class="form-title">{{ __('Verify your email') }}</h1>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p class="muted-copy">
                {{ __('Before proceeding, please check your email for a verification link.') }}
            </p>

            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-app-primary">
                    {{ __('Send another link') }}
                </button>
            </form>
        </section>
    </div>
</div>
@endsection
