@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <section class="form-panel mx-auto" style="max-width: 520px;">
            <h1 class="form-title">{{ __('Confirm password') }}</h1>
            <p class="form-subtitle">{{ __('Please confirm your password before continuing.') }}</p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-app-primary w-100">
                    <i class="bi bi-unlock me-2"></i>{{ __('Confirm password') }}
                </button>

                @if (Route::has('password.request'))
                    <div class="text-center mt-3">
                        <a class="fw-bold" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </section>
    </div>
</div>
@endsection
