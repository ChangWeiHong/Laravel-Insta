@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <section class="form-panel mx-auto" style="max-width: 520px;">
            <h1 class="form-title">{{ __('Reset password') }}</h1>
            <p class="form-subtitle">Send a reset link to the email connected to your profile.</p>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label fw-bold">{{ __('Email address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-app-primary w-100">
                    <i class="bi bi-send me-2"></i>{{ __('Send reset link') }}
                </button>
            </form>
        </section>
    </div>
</div>
@endsection
