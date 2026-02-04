@extends('layouts.app')

@section('content')

<section class="tpl-auth">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-6 col-xl-5">

                    <div class="tpl-auth-card">

                        {{-- Header --}}
                        <div class="tpl-auth-head">
                            <span class="tpl-kicker">
                                <i class="bi bi-person-plus-fill"></i>
                                Create Account
                            </span>
                            <h1 class="tpl-auth-title">Join PipLab</h1>
                            <p class="tpl-auth-sub">
                                Create your account to access market insights, tools, and education.
                            </p>
                        </div>

                        {{-- Global error --}}
                        @if(session('error'))
                            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('store.register') }}" method="POST" novalidate>
                            @csrf

                            {{-- Referral Code --}}
                            <div class="tpl-field">
                                <label class="tpl-label">Referral Code <span>(optional)</span></label>
                                <input type="text"
                                       class="tpl-input"
                                       name="referral_code"
                                       placeholder="Enter referral code"
                                       value="{{ $referral_code ?? old('referral_code') }}">
                                @error('referral_code')
                                    <div class="tpl-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Name --}}
                            <div class="tpl-field">
                                <label class="tpl-label">Full Name</label>
                                <input type="text"
                                       class="tpl-input"
                                       name="name"
                                       placeholder="Your full name"
                                       value="{{ old('name') }}"
                                       required>
                                @error('name')
                                    <div class="tpl-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="tpl-field">
                                <label class="tpl-label">Email Address</label>
                                <input type="email"
                                       class="tpl-input"
                                       name="email"
                                       placeholder="you@example.com"
                                       value="{{ old('email') }}"
                                       required>
                                @error('email')
                                    <div class="tpl-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Contact --}}
                            <div class="tpl-field">
                                <label class="tpl-label">Contact Number</label>

                                <div class="tpl-phone">
                                    <select class="tpl-select" name="country_code" required>
                                        <option value="+92" {{ old('country_code', '+92') == '+92' ? 'selected' : '' }}>🇵🇰 +92</option>
                                        <option value="+44" {{ old('country_code') == '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                                        <option value="+1"  {{ old('country_code') == '+1'  ? 'selected' : '' }}>🇺🇸 +1</option>
                                        <option value="+971" {{ old('country_code') == '+971' ? 'selected' : '' }}>🇦🇪 +971</option>
                                        <option value="+91" {{ old('country_code') == '+91' ? 'selected' : '' }}>🇮🇳 +91</option>
                                    </select>

                                    <input type="tel"
                                           class="tpl-input"
                                           id="contact"
                                           name="contact"
                                           placeholder="3001234567"
                                           value="{{ old('contact') }}"
                                           inputmode="numeric"
                                           required>
                                </div>

                                <div class="tpl-help">Digits only · 7–15 characters</div>
                                <div class="tpl-error d-none" id="phone_error">
                                    Please enter a valid phone number.
                                </div>

                                @error('contact')
                                    <div class="tpl-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="tpl-field">
                                <label class="tpl-label">Password</label>
                                <div class="tpl-password">
                                    <input
                                        type="password"
                                        class="tpl-input"
                                        id="password"
                                        name="password"
                                        required
                                        autocomplete="new-password"
                                    >
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

                            {{-- Confirm Password --}}
                            <div class="tpl-field">
                                <label class="tpl-label">Confirm Password</label>
                                <div class="tpl-password">
                                    <input
                                        type="password"
                                        class="tpl-input"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                    >
                                    <button
                                        type="button"
                                        class="tpl-eye"
                                        data-target="password_confirmation"
                                        aria-label="Toggle password visibility"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <div class="tpl-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Submit --}}
                            <button type="submit" class="tpl-btn-primary w-100">
                                Create Account
                            </button>
                        </form>

                        <div class="tpl-auth-footer">
                            Already have an account?
                            <a href="{{ route('client.login') }}">Log in</a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== Styles ===== --}}
@once
<style>
/* ✅ Fix #1: spacing from header/footer */
.tpl-auth{
    background:#fff;
    padding-block: clamp(24px, 4vw, 56px); /* top+bottom spacing */
    min-height: calc(100vh - 120px);       /* keeps it from sticking to footer */
    display:flex;
    align-items:center;
}

.tpl-auth-card{
    padding: 34px;
    border:1px solid rgba(2,6,23,.10);
    border-radius: 18px;
    box-shadow: 0 20px 60px rgba(2,6,23,.10);
    background:#fff;
}

.tpl-auth-head{
    text-align:center;
    margin-bottom: 28px;
}

.tpl-auth-title{
    font-weight:950;
    letter-spacing:-.02em;
    margin: 10px 0;
}

.tpl-auth-sub{
    color:rgba(11,18,32,.65);
    font-size:.95rem;
}

.tpl-field{ margin-bottom: 18px; }

.tpl-label{
    font-weight:800;
    font-size:.9rem;
    margin-bottom:6px;
    display:block;
}

.tpl-label span{
    font-weight:600;
    color:rgba(11,18,32,.55);
}

.tpl-input,
.tpl-select{
    width:100%;
    padding:12px 14px;
    border-radius: 12px;
    border:1px solid rgba(2,6,23,.12);
    font-size:.95rem;
    background:#fff;
}

.tpl-input:focus,
.tpl-select:focus{
    outline:none;
    border-color: var(--tpl-primary);
    box-shadow: 0 0 0 4px rgba(6,163,218,.12);
}

.tpl-phone{
    display:flex;
    gap:8px;
    align-items:stretch;
}

.tpl-password{ position:relative; }

/* ✅ Fix #2: better eye button + clickable */
.tpl-eye{
    position:absolute;
    right:10px;
    top:50%;
    transform:translateY(-50%);
    width: 38px;
    height: 38px;
    border-radius: 10px;
    border: 1px solid rgba(2,6,23,.10);
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
    color: #0b1220;
}

/* leave room for eye button */
.tpl-password .tpl-input{
    padding-right: 52px;
}

.tpl-help{
    font-size:.8rem;
    margin-top:4px;
    color:rgba(11,18,32,.55);
}

.tpl-error{
    font-size:.8rem;
    color:#dc3545;
    margin-top:4px;
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

.tpl-btn-primary:hover{ background: var(--tpl-primary); }

.tpl-auth-footer{
    text-align:center;
    margin-top:18px;
    font-size:.9rem;
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

{{-- ✅ Fix #2: working toggle script --}}
@once
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tpl-eye[data-target]').forEach(function(btn){
        btn.addEventListener('click', function () {
            const targetId = btn.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = btn.querySelector('i');
            if (!input || !icon) return;

            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';

            icon.classList.toggle('bi-eye', !isPassword);
            icon.classList.toggle('bi-eye-slash', isPassword);
        });
    });
});
</script>
@endonce

@endsection
