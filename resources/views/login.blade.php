@extends('layouts.app')

@section('content')

<section class="tpl-auth">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-5 col-xl-4">

                    <div class="tpl-auth-card">

                        {{-- Header --}}
                        <div class="tpl-auth-head">
                            <span class="tpl-kicker">
                                <i class="bi bi-shield-lock-fill"></i>
                                Secure Access
                            </span>

                            <h1 class="tpl-auth-title">Log in to PipLab</h1>

                            <p class="tpl-auth-sub">
                                Welcome back — enter your details to continue.
                            </p>
                        </div>

                        {{-- Global error --}}
                        @if(session('error'))
                            <div class="alert alert-danger mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Login Form --}}
                        <form action="{{ route('login') }}" method="POST" novalidate>
                            @csrf

                            {{-- Email --}}
                            <div class="tpl-field">
                                <label class="tpl-label" for="email">Email Address</label>
                                <input
                                    type="email"
                                    class="tpl-input"
                                    id="email"
                                    name="email"
                                    placeholder="you@example.com"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                >
                                @error('email')
                                    <div class="tpl-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="tpl-field">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <label class="tpl-label mb-0" for="password">Password</label>
                                    <a class="tpl-link" href="{{ route('password.request') }}">
                                        Forgot password?
                                    </a>
                                </div>

                                <div class="tpl-password">
                                    <input
                                        type="password"
                                        class="tpl-input"
                                        id="password"
                                        name="password"
                                        placeholder="Enter your password"
                                        required
                                        autocomplete="current-password"
                                    >

                                    {{-- ✅ Better eye + working toggle --}}
                                    <button
                                        type="button"
                                        class="tpl-eye"
                                        data-target="password"
                                        aria-label="Toggle password visibility"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <div class="tpl-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <button type="submit" class="tpl-btn-primary w-100">
                                Log In
                            </button>
                        </form>

                        {{-- Footer --}}
                        <div class="tpl-auth-footer">
                            Don’t have an account?
                            <a href="{{ route('client.register') }}">Sign up</a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@once
<style>
/* ✅ spacing so it doesn't attach to header/footer */
.tpl-auth{
    background:#fff;
    padding-block: clamp(24px, 4vw, 56px);
    min-height: calc(100vh - 120px);
    display:flex;
    align-items:center;
}

/* Card */
.tpl-auth-card{
    padding: 34px;
    border:1px solid rgba(2,6,23,.10);
    border-radius: 18px;
    box-shadow: 0 20px 60px rgba(2,6,23,.10);
    background:#fff;
}

.tpl-auth-head{
    text-align:center;
    margin-bottom: 26px;
}

.tpl-auth-title{
    font-weight:950;
    letter-spacing:-.02em;
    margin: 10px 0 6px;
    color: #0b1220;
}

.tpl-auth-sub{
    color:rgba(11,18,32,.65);
    font-size:.95rem;
    margin: 0;
}

.tpl-field{ margin-bottom: 18px; }

.tpl-label{
    font-weight:800;
    font-size:.9rem;
    display:block;
    margin-bottom:6px;
    color:#0b1220;
}

.tpl-input{
    width:100%;
    padding:12px 14px;
    border-radius: 12px;
    border:1px solid rgba(2,6,23,.12);
    font-size:.95rem;
    background:#fff;
}
.tpl-input:focus{
    outline:none;
    border-color: var(--tpl-primary);
    box-shadow: 0 0 0 4px rgba(6,163,218,.12);
}

.tpl-password{ position:relative; }

/* ✅ Better eye button (and leave padding for it) */
.tpl-password .tpl-input{ padding-right: 52px; }

.tpl-eye{
    position:absolute;
    right:10px;
    top:50%;
    transform:translateY(-50%);
    width:38px;
    height:38px;
    border-radius:10px;
    border:1px solid rgba(2,6,23,.10);
    background: rgba(2,6,23,.02);
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    color: rgba(11,18,32,.70);
    padding:0;
}
.tpl-eye:hover{
    background: rgba(6,163,218,.10);
    border-color: rgba(6,163,218,.25);
    color:#0b1220;
}

.tpl-link{
    font-size:.85rem;
    font-weight:800;
    color: rgba(11,18,32,.65);
    text-decoration:none;
}
.tpl-link:hover{ color: var(--tpl-primary); }

.tpl-error{
    font-size:.8rem;
    color:#dc3545;
    margin-top:6px;
}

.tpl-btn-primary{
    margin-top: 8px;
    padding: .85rem 1rem;
    border-radius: 999px;
    font-weight:900;
    border:none;
    background:#0b1220;
    color:#fff;
}
.tpl-btn-primary:hover{
    background: var(--tpl-primary);
    color:#fff;
}

.tpl-auth-footer{
    text-align:center;
    margin-top:18px;
    font-size:.9rem;
    color: rgba(11,18,32,.75);
}
.tpl-auth-footer a{
    font-weight:900;
    color:#0b1220;
    text-decoration:none;
}
.tpl-auth-footer a:hover{ color: var(--tpl-primary); }

@media (max-width: 575.98px){
    .tpl-auth-card{ padding: 24px; }
}
</style>
@endonce

@once
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tpl-eye[data-target]').forEach(function(btn){
        btn.addEventListener('click', function () {
            const targetId = btn.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = btn.querySelector('i');
            if (!input || !icon) return;

            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';

            icon.classList.toggle('bi-eye', !show);
            icon.classList.toggle('bi-eye-slash', show);
        });
    });
});
</script>
@endonce

@endsection
