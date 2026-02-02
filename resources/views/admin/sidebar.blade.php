{{-- resources/views/admin/sidebar.blade.php --}}
<aside class="piplab-sb d-flex flex-column">

    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="piplab-sb-brand text-decoration-none">
        <img src="{{ asset('images/logo.png') }}" alt="PipLab" class="piplab-sb-logo">
        <div class="ms-2">
            <div class="piplab-sb-title">ThePipLab</div>
            <div class="piplab-sb-subtitle">Admin Panel</div>
        </div>
    </a>

    {{-- Navigation --}}
    <nav class="nav flex-column piplab-sb-nav">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="piplab-sb-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-gauge-high me-2"></i> Dashboard
        </a>

        <div class="my-2 piplab-sb-divider"></div>

        {{-- Signals Management --}}
        <a href="{{ route('admin.signal') }}"
           class="piplab-sb-link {{ Route::is('admin.signal') ? 'active' : '' }}">
            <i class="fas fa-cloud-arrow-up me-2"></i> Upload Signals
        </a>

        <a href="{{ route('admin.signals.show') }}"
           class="piplab-sb-link {{ Route::is('admin.signals.show') ? 'active' : '' }}">
            <i class="fas fa-list me-2"></i> Signals List
        </a>

        <a href="{{ route('admin.signals.subscribers') }}"
           class="piplab-sb-link {{ Route::is('admin.signals.subscribers') ? 'active' : '' }}">
            <i class="fas fa-signal me-2"></i> Active Signals Subscribers
        </a>

        <a href="{{ route('admin.signals.access') }}"
           class="piplab-sb-link {{ Route::is('admin.signals.access') ? 'active' : '' }}">
            <i class="fas fa-user-check me-2"></i> Signals Access
        </a>

        <div class="my-2 piplab-sb-divider"></div>

        {{-- Purchases & Finance --}}
        <a href="{{ route('admin.purchaseRequest') }}"
           class="piplab-sb-link {{ Route::is('admin.purchaseRequest') ? 'active' : '' }}">
            <i class="fas fa-receipt me-2"></i> Purchase Requests
        </a>

        <a href="{{ route('admin.withdraw.requests') }}"
           class="piplab-sb-link {{ Route::is('admin.withdraw.requests') ? 'active' : '' }}">
            <i class="fas fa-money-bill-transfer me-2"></i> Withdraw Requests
        </a>

        <div class="my-2 piplab-sb-divider"></div>

        {{-- Requests & Partnerships --}}
        <a href="{{ route('admin.bot_requests.index') }}"
           class="piplab-sb-link {{ request()->routeIs('admin.bot_requests.*') ? 'active' : '' }}">
            <i class="fas fa-robot me-2"></i> Bot Requests
        </a>

        <a href="{{ route('admin.affiliate.inquiries') }}"
           class="piplab-sb-link {{ Route::is('admin.affiliate.inquiries') ? 'active' : '' }}">
            <i class="fas fa-handshake me-2"></i> Affiliate Inquiries
        </a>

        <a href="{{ route('admin.partner.requests') }}"
           class="piplab-sb-link {{ Route::is('admin.partner.requests') ? 'active' : '' }}">
            <i class="fas fa-handshake-angle me-2"></i> Partner Requests
        </a>

        <div class="my-2 piplab-sb-divider"></div>

        {{-- Content & Education --}}
        <a href="{{ route('admin.materials.create') }}"
           class="piplab-sb-link {{ request()->routeIs('admin.materials.create') ? 'active' : '' }}">
            <i class="fas fa-folder-plus me-2"></i> Add Study Material
        </a>

        <a href="{{ route('admin.posts.index') }}"
           class="piplab-sb-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper me-2"></i> Insights Manager
        </a>

        <div class="my-2 piplab-sb-divider"></div>

        {{-- Logout --}}
        <a href="{{ route('admin.logout') }}"
           class="piplab-sb-link piplab-sb-link-danger {{ Route::is('admin.logout') ? 'active' : '' }}">
            <i class="fas fa-right-from-bracket me-2"></i> Logout
        </a>

    </nav>

    {{-- Footer --}}
    <div class="mt-auto piplab-sb-footer">
        <div class="piplab-sb-footer-pill">
            <span class="piplab-sb-dot"></span>
            Secure Admin Area
        </div>
    </div>

</aside>
