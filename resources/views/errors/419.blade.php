@extends('layouts.app')

@section('title', 'Session Expired')

@section('content')
<section class="tpl-auth">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-6 col-xl-5">
                    <div class="tpl-auth-card text-center">

                        <div class="tpl-auth-head">
                            <span class="tpl-kicker">
                                <i class="bi bi-clock-history"></i>
                                Session Expired
                            </span>
                            <h1 class="tpl-auth-title">Please refresh & try again</h1>
                            <p class="tpl-auth-sub">
                                This page was open for a while, so your session token expired for security reasons.
                            </p>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ url()->current() }}" class="tpl-btn-primary w-100">
                                Refresh Page
                            </a>

                            <a href="{{ route('client.login') }}" class="tpl-link d-inline-block mt-2">
                                Back to Login
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
