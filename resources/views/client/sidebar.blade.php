{{-- resources/views/client/sidebar.blade.php --}}
<aside class="piplab-sb d-flex flex-column">

    {{-- Brand --}}
    <a href="{{ route('client.dashboard') }}" class="piplab-sb-brand text-decoration-none">
        <img src="{{ asset('images/logo.png') }}" alt="PipLab" class="piplab-sb-logo">
        <div class="ms-2">
            <div class="piplab-sb-title">ThePipLab</div>
            <div class="piplab-sb-subtitle">Client Portal</div>
        </div>
    </a>

    {{-- Nav --}}
    <nav class="nav flex-column piplab-sb-nav">

        {{-- Dashboard --}}
        <a class="piplab-sb-link {{ Route::is('client.dashboard') ? 'active' : '' }}"
           href="{{ route('client.dashboard') }}">
            <span class="piplab-sb-link-left">
                <i class="fas fa-gauge-high"></i>
                Dashboard
            </span>
        </a>

        {{-- Services --}}
        <a class="piplab-sb-link {{ Route::is('client.portal') ? 'active' : '' }}"
           href="{{ route('client.portal') }}">
            <span class="piplab-sb-link-left">
                <i class="fas fa-layer-group"></i>
                Services
            </span>
        </a>

        {{-- Market Analysis --}}
        <a class="piplab-sb-link {{ Route::is('client.signals') ? 'active' : '' }}"
           href="{{ route('client.signals') }}">
            <span class="piplab-sb-link-left">
                <i class="fas fa-signal"></i>
                Market Analysis
            </span>
        </a>

        @php
            use App\Models\Purchase;

            $hasActiveCourse = auth()->check()
                ? Purchase::where('user_id', auth()->id())
                    ->where('product_type', 'course')
                    ->where('status', 'approved')
                    ->exists()
                : false;
        @endphp

        @if($hasActiveCourse)
            {{-- Study Material dropdown --}}
            <button
                class="piplab-sb-link piplab-sb-link-btn {{ Route::is('student.*') ? 'active' : '' }}"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#sbStudy"
                aria-expanded="{{ Route::is('student.*') ? 'true' : 'false' }}"
                aria-controls="sbStudy"
            >
                <span class="piplab-sb-link-left">
                    <i class="fas fa-graduation-cap"></i>
                    Study Material
                </span>
                <i class="fas fa-chevron-down piplab-sb-chevron"></i>
            </button>

            <div class="collapse {{ Route::is('student.*') ? 'show' : '' }}" id="sbStudy">
                <div class="piplab-sb-subnav">
                    <a class="piplab-sb-sublink {{ Route::is('student.lectures') ? 'active' : '' }}"
                       href="{{ route('student.lectures') }}">
                        Lecture Material
                    </a>

                    <a class="piplab-sb-sublink {{ Route::is('student.resources') ? 'active' : '' }}"
                       href="{{ route('student.resources') }}">
                        Extra Resources
                    </a>
                </div>
            </div>
        @endif

        {{-- Bot Requests --}}
        <a class="piplab-sb-link {{ request()->routeIs('bot.request.*') ? 'active' : '' }}"
           href="{{ route('bot.request.my') }}">
            <span class="piplab-sb-link-left">
                <i class="fas fa-robot"></i>
                My Bot Requests
            </span>
        </a>

        <div class="my-2 piplab-sb-divider"></div>

        {{-- Become a Partner --}}
        <a class="piplab-sb-link {{ Route::is('client.partner.apply') ? 'active' : '' }}"
           href="{{ route('client.partner.apply') }}">
            <span class="piplab-sb-link-left">
                <i class="fas fa-user-tie"></i>
                Become a Partner
            </span>
        </a>

        {{-- Partner dropdown --}}
        <button
            class="piplab-sb-link piplab-sb-link-btn {{ Route::is('referrals.*') || Route::is('client.withdraw*') ? 'active' : '' }}"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sbPartner"
            aria-expanded="{{ Route::is('referrals.*') || Route::is('client.withdraw*') ? 'true' : 'false' }}"
            aria-controls="sbPartner"
        >
            <span class="piplab-sb-link-left">
                <i class="fas fa-users"></i>
                Partner
            </span>
            <i class="fas fa-chevron-down piplab-sb-chevron"></i>
        </button>

        <div class="collapse {{ Route::is('referrals.*') || Route::is('client.withdraw*') ? 'show' : '' }}" id="sbPartner">
            <div class="piplab-sb-subnav">
                <a class="piplab-sb-sublink {{ Route::is('referrals.dashboard') ? 'active' : '' }}"
                   href="{{ route('referrals.dashboard') }}">
                    Overview
                </a>

                <a class="piplab-sb-sublink {{ Route::is('referrals.team') ? 'active' : '' }}"
                   href="{{ route('referrals.team', Auth::user()->id) }}">
                    Team
                </a>

                <a class="piplab-sb-sublink {{ Route::is('client.withdraw') ? 'active' : '' }}"
                   href="{{ route('client.withdraw') }}">
                    Withdraw
                </a>

                <a class="piplab-sb-sublink {{ Route::is('client.withdraw.history') ? 'active' : '' }}"
                   href="{{ route('client.withdraw.history') }}">
                    Withdrawal History
                </a>
            </div>
        </div>

        <div class="my-2 piplab-sb-divider"></div>

        {{-- Logout --}}
        <a class="piplab-sb-link piplab-sb-link-danger" href="{{ route('client.logout') }}">
            <span class="piplab-sb-link-left">
                <i class="fas fa-right-from-bracket"></i>
                Logout
            </span>
        </a>

    </nav>

    {{-- Footer --}}
    <div class="mt-auto piplab-sb-footer">
        <div class="piplab-sb-footer-pill">
            <span class="piplab-sb-dot"></span>
            Secure Client Area
        </div>
    </div>

</aside>

