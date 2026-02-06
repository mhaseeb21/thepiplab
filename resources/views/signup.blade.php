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

                            {{-- Full Name --}}
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

                            {{-- Contact Number --}}
                            <div class="tpl-field">
                                <label class="tpl-label">Contact Number</label>

                                {{-- Country + phone --}}
                                <div class="tpl-phone">
                                    {{-- Custom Searchable Dropdown --}}
                                    <div class="tpl-country-dropdown">
                                        <input type="hidden" name="country_code" id="country_code_input" value="{{ old('country_code', '+92') }}">
                                        
                                        <button type="button" class="tpl-country-trigger" id="country_trigger">
                                            <span class="tpl-country-selected" id="country_selected">
                                                @php
                                                    $defaultCode = old('country_code', '+92');
                                                    $defaultCountry = collect(config('country_codes'))->firstWhere('code', $defaultCode);
                                                @endphp
                                                {{ $defaultCountry['flag'] ?? '🌍' }} {{ $defaultCountry['code'] ?? '+92' }}
                                            </span>
                                            <i class="bi bi-chevron-down"></i>
                                        </button>

                                        <div class="tpl-country-panel" id="country_panel">
                                            <div class="tpl-country-search-wrapper">
                                                <i class="bi bi-search"></i>
                                                <input
                                                    type="text"
                                                    id="country_search"
                                                    class="tpl-country-search-input"
                                                    placeholder="Search country..."
                                                    autocomplete="off"
                                                >
                                            </div>

                                            <div class="tpl-country-list" id="country_list">
                                                @foreach (config('country_codes') as $country)
                                                    <div class="tpl-country-option" 
                                                         data-code="{{ $country['code'] }}"
                                                         data-name="{{ $country['name'] }}"
                                                         data-flag="{{ $country['flag'] }}">
                                                        <span class="tpl-country-flag">{{ $country['flag'] }}</span>
                                                        <span class="tpl-country-name">{{ $country['name'] }}</span>
                                                        <span class="tpl-country-code">{{ $country['code'] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <input
                                        type="tel"
                                        class="tpl-input"
                                        name="contact"
                                        placeholder="3001234567"
                                        value="{{ old('contact') }}"
                                        inputmode="numeric"
                                        required
                                    >
                                </div>

                                <div class="tpl-help">Digits only · 7–15 characters</div>

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
                                    <button type="button"
                                            class="tpl-eye"
                                            data-target="password">
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
                                    <button type="button"
                                            class="tpl-eye"
                                            data-target="password_confirmation">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <div class="tpl-error">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Turnstile --}}
                            <div class="tpl-field">
                                <div class="cf-turnstile"
                                     data-sitekey="{{ config('services.turnstile.site_key') }}">
                                </div>
                                @error('cf-turnstile-response')
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

@endsection


{{-- ================= STYLES ================= --}}
@once
<style>
.tpl-auth{
    background:#fff;
    padding-block: clamp(24px, 4vw, 56px);
    min-height: calc(100vh - 120px);
    display:flex;
    align-items:center;
}

.tpl-auth-card{
    padding:34px;
    border:1px solid rgba(2,6,23,.10);
    border-radius:18px;
    box-shadow:0 20px 60px rgba(2,6,23,.10);
}

.tpl-auth-head{text-align:center;margin-bottom:28px}
.tpl-auth-title{font-weight:950;letter-spacing:-.02em}
.tpl-auth-sub{color:rgba(11,18,32,.65);font-size:.95rem}

.tpl-field{margin-bottom:18px}

.tpl-label{font-weight:800;font-size:.9rem;margin-bottom:6px;display:block}
.tpl-input,.tpl-select{
    width:100%;
    padding:12px 14px;
    border-radius:12px;
    border:1px solid rgba(2,6,23,.12);
}

.tpl-input:focus,.tpl-select:focus{
    border-color:var(--tpl-primary);
    box-shadow:0 0 0 4px rgba(6,163,218,.12);
    outline:none;
}

.tpl-phone{
    display:grid;
    grid-template-columns:170px 1fr;
    gap:10px;
}

/* Custom Country Dropdown */
.tpl-country-dropdown{
    position:relative;
}

.tpl-country-trigger{
    width:100%;
    padding:12px 14px;
    border-radius:12px;
    border:1px solid rgba(2,6,23,.12);
    background:#fff;
    display:flex;
    align-items:center;
    justify-content:space-between;
    cursor:pointer;
    transition:all 0.2s;
}

.tpl-country-trigger:hover{
    border-color:rgba(2,6,23,.2);
}

.tpl-country-trigger:focus{
    border-color:var(--tpl-primary);
    box-shadow:0 0 0 4px rgba(6,163,218,.12);
    outline:none;
}

.tpl-country-trigger i{
    font-size:.75rem;
    color:rgba(11,18,32,.5);
    transition:transform 0.2s;
}

.tpl-country-trigger.active i{
    transform:rotate(180deg);
}

.tpl-country-selected{
    font-size:.9rem;
    font-weight:600;
}

.tpl-country-panel{
    position:absolute;
    top:calc(100% + 4px);
    left:0;
    right:0;
    background:#fff;
    border:1px solid rgba(2,6,23,.12);
    border-radius:12px;
    box-shadow:0 10px 40px rgba(2,6,23,.15);
    z-index:1000;
    display:none;
    overflow:hidden;
}

.tpl-country-panel.active{
    display:block;
}

.tpl-country-search-wrapper{
    position:relative;
    padding:12px;
    border-bottom:1px solid rgba(2,6,23,.08);
}

.tpl-country-search-wrapper i{
    position:absolute;
    left:24px;
    top:50%;
    transform:translateY(-50%);
    color:rgba(11,18,32,.4);
    font-size:.85rem;
}

.tpl-country-search-input{
    width:100%;
    padding:10px 12px 10px 36px;
    border:1px solid rgba(2,6,23,.12);
    border-radius:8px;
    font-size:.9rem;
}

.tpl-country-search-input:focus{
    border-color:var(--tpl-primary);
    outline:none;
}

.tpl-country-list{
    max-height:280px;
    overflow-y:auto;
}

.tpl-country-option{
    display:grid;
    grid-template-columns:32px 1fr auto;
    gap:10px;
    align-items:center;
    padding:10px 14px;
    cursor:pointer;
    transition:background 0.15s;
}

.tpl-country-option:hover{
    background:rgba(6,163,218,.06);
}

.tpl-country-option.selected{
    background:rgba(6,163,218,.1);
}

.tpl-country-flag{
    font-size:1.2rem;
}

.tpl-country-name{
    font-size:.9rem;
    color:rgba(11,18,32,.85);
}

.tpl-country-code{
    font-size:.85rem;
    color:rgba(11,18,32,.6);
    font-weight:600;
}

.tpl-country-option.hidden{
    display:none;
}

.tpl-password{position:relative}

.tpl-eye{
    position:absolute;
    right:10px;
    top:50%;
    transform:translateY(-50%);
    width:38px;height:38px;
    border-radius:10px;
    border:1px solid rgba(2,6,23,.1);
    background:rgba(2,6,23,.02);
    cursor:pointer;
}

.tpl-password .tpl-input{padding-right:52px}

.tpl-help{font-size:.8rem;color:rgba(11,18,32,.55);margin-top:6px}
.tpl-error{font-size:.8rem;color:#dc3545;margin-top:4px}

.tpl-btn-primary{
    margin-top:8px;
    padding:.85rem;
    border-radius:999px;
    border:none;
    font-weight:900;
    background:#0b1220;
    color:#fff;
}

.tpl-btn-primary:hover{background:var(--tpl-primary)}

.tpl-auth-footer{text-align:center;margin-top:18px}

@media(max-width:575px){
    .tpl-auth-card{padding:24px}
    .tpl-phone{grid-template-columns:1fr}
    .tpl-country-trigger{font-size:.85rem}
}
</style>
@endonce


{{-- ================= SCRIPTS ================= --}}
@once
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<script>
// Password toggle
document.querySelectorAll('.tpl-eye').forEach(btn=>{
    btn.onclick=()=>{
        const i=document.getElementById(btn.dataset.target);
        i.type=i.type==='password'?'text':'password';
    }
});

// Country dropdown functionality
document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('country_trigger');
    const panel = document.getElementById('country_panel');
    const search = document.getElementById('country_search');
    const list = document.getElementById('country_list');
    const input = document.getElementById('country_code_input');
    const selected = document.getElementById('country_selected');
    const options = list.querySelectorAll('.tpl-country-option');

    // Toggle dropdown
    trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        const isActive = panel.classList.toggle('active');
        trigger.classList.toggle('active');
        
        if (isActive) {
            search.focus();
        } else {
            search.value = '';
            options.forEach(opt => opt.classList.remove('hidden'));
        }
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
        if (!panel.contains(e.target) && e.target !== trigger) {
            panel.classList.remove('active');
            trigger.classList.remove('active');
            search.value = '';
            options.forEach(opt => opt.classList.remove('hidden'));
        }
    });

    // Search functionality
    search.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase().trim();
        
        options.forEach(option => {
            const name = option.dataset.name.toLowerCase();
            const code = option.dataset.code.toLowerCase();
            
            if (name.includes(query) || code.includes(query)) {
                option.classList.remove('hidden');
            } else {
                option.classList.add('hidden');
            }
        });
    });

    // Select country
    options.forEach(option => {
        option.addEventListener('click', () => {
            const code = option.dataset.code;
            const flag = option.dataset.flag;
            
            // Update hidden input
            input.value = code;
            
            // Update trigger display
            selected.innerHTML = `${flag} ${code}`;
            
            // Update selected state
            options.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');
            
            // Close panel
            panel.classList.remove('active');
            trigger.classList.remove('active');
            search.value = '';
            options.forEach(opt => opt.classList.remove('hidden'));
        });
    });

    // Mark initially selected country
    const initialCode = input.value;
    options.forEach(option => {
        if (option.dataset.code === initialCode) {
            option.classList.add('selected');
        }
    });

    // Prevent form submission when pressing Enter in search
    search.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            
            // Select first visible option
            const firstVisible = list.querySelector('.tpl-country-option:not(.hidden)');
            if (firstVisible) {
                firstVisible.click();
            }
        }
    });
});
</script>
@endonce
</document_content>