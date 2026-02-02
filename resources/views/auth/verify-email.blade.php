@extends('layout_custom.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <h3 class="mb-3">Verify your email</h3>

                    <p class="text-muted">
                        We’ve sent a verification link to your email.
                        Please open it to activate your account.
                    </p>

                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif

                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button class="btn btn-primary">Resend Verification Email</button>
                    </form>

                    <div class="mt-3">
                        <form method="POST" action="{{ route('client.logout') }}">
                            @csrf
                            <button class="btn btn-link">Logout</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection