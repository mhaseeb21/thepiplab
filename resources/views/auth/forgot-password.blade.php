@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 520px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="text-center mb-3">Forgot Password</h3>
            <p class="text-muted small">
                Enter your email and we’ll send you a password reset link.
            </p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                {{-- ✅ Turnstile --}}
                <div class="mb-3">
                    <div class="cf-turnstile"
                         data-sitekey="{{ config('services.turnstile.site_key') }}">
                    </div>

                    @error('cf-turnstile-response')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Send Reset Link
                    </button>
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('client.login') }}">Back to login</a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ✅ Turnstile script (load once) --}}
@once
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
@endonce

@endsection
