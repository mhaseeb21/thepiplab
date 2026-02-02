@extends('client.client_layouts.portal')

@section('content')
<div class="tpl-page">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="tpl-alert tpl-alert-success" role="alert">
            <div class="tpl-alert-ic"><i class="fas fa-check"></i></div>
            <div>
                <div class="tpl-alert-title">{{ session('success') }}</div>
                <div class="tpl-alert-sub">Redirecting to your dashboard…</div>
            </div>
        </div>

        <script>
            setTimeout(() => window.location.href = "{{ route('client.dashboard') }}", 5000);
        </script>
    @endif

    {{-- Header --}}
    <div class="tpl-page-head">
        <div>
            <h1 class="tpl-page-title">Your Profile</h1>
            <p class="tpl-page-sub">View and manage your account information</p>
        </div>

        <div class="tpl-page-actions">
            <a href="{{ route('home') }}" class="btn tpl-btn tpl-btn-ghost">
                <i class="fas fa-globe me-2"></i>Website
            </a>
            <a href="https://wa.me/447538005864" class="btn tpl-btn tpl-btn-primary" target="_blank" rel="noopener">
                <i class="fas fa-message me-2"></i>Contact
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Profile --}}
        <div class="col-12 col-lg-5">
            <section class="tpl-card">
                <header class="tpl-card-head">
                    <div class="tpl-card-head-left">
                        <span class="tpl-card-ic"><i class="fas fa-user"></i></span>
                        <div>
                            <div class="tpl-card-title">Profile</div>
                            <div class="tpl-card-sub">Account details</div>
                        </div>
                    </div>
                </header>

                <div class="tpl-card-body">
                    <div class="tpl-kv">
                        <div class="tpl-k">Full Name</div>
                        <div class="tpl-v">{{ $user->name }}</div>
                    </div>

                    <div class="tpl-kv">
                        <div class="tpl-k">Email</div>
                        <div class="tpl-v tpl-break">{{ $user->email }}</div>
                    </div>

                    <div class="tpl-kv">
                        <div class="tpl-k">User ID</div>
                        <div class="tpl-v">
                            <span class="tpl-pill tpl-pill-muted">100_{{ $user->id }}</span>
                        </div>
                    </div>

                    <div class="tpl-kv">
                        <div class="tpl-k">Account Role</div>
                        <div class="tpl-v">{{ ucfirst($user->role) }}</div>
                    </div>

                    <div class="tpl-kv">
                        <div class="tpl-k">Account Status</div>
                        <div class="tpl-v">
                            @if($user->ib_status)
                                <span class="tpl-pill tpl-pill-success">
                                    <i class="fas fa-star me-1"></i> Partner Account
                                </span>
                            @else
                                <span class="tpl-pill tpl-pill-primary">
                                    <i class="fas fa-user me-1"></i> Customer Account
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="tpl-kv">
                        <div class="tpl-k">Member Since</div>
                        <div class="tpl-v">{{ $user->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </section>
        </div>

        {{-- Purchases --}}
        <div class="col-12 col-lg-7">
            <section class="tpl-card">
                <header class="tpl-card-head">
                    <div class="tpl-card-head-left">
                        <span class="tpl-card-ic"><i class="fas fa-receipt"></i></span>
                        <div>
                            <div class="tpl-card-title">Purchases</div>
                            <div class="tpl-card-sub">Purchase history</div>
                        </div>
                    </div>

                    @if($purchases->count() > 0)
                        <div class="tpl-card-head-right">
                            <span class="tpl-metric">
                                <span class="tpl-metric-k">Total</span>
                                <span class="tpl-metric-v">{{ $purchases->count() }}</span>
                            </span>
                            <span class="tpl-metric">
                                <span class="tpl-metric-k">Spent</span>
                                <span class="tpl-metric-v">${{ number_format($purchases->sum('amount'), 2) }}</span>
                            </span>
                        </div>
                    @endif
                </header>

                <div class="tpl-card-body">
                    @if($purchases->count() > 0)
                        <div class="tpl-table">
                            @foreach($purchases as $purchase)
                                <div class="tpl-row">
                                    <div class="tpl-row-left">
                                        <div class="tpl-row-title text-capitalize">{{ $purchase->product_type }}</div>
                                        <div class="tpl-row-sub">{{ $purchase->created_at->format('M d, Y • H:i') }}</div>
                                    </div>
                                    <div class="tpl-row-right">
                                        ${{ number_format($purchase->amount, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="tpl-empty">
                            <div class="tpl-empty-ic"><i class="fas fa-bag-shopping"></i></div>
                            <div class="tpl-empty-title">No purchases yet</div>
                            <div class="tpl-empty-sub">Explore services to get started.</div>
                            <a href="{{ route('client.portal') }}" class="btn tpl-btn tpl-btn-primary mt-3">
                                <i class="fas fa-layer-group me-2"></i>Browse Services
                            </a>
                        </div>
                    @endif
                </div>
            </section>
        </div>

        {{-- Referral (Partner only) --}}
        @if($user->ib_status)
            <div class="col-12">
                <section class="tpl-card">
                    <header class="tpl-card-head">
                        <div class="tpl-card-head-left">
                            <span class="tpl-card-ic"><i class="fas fa-link"></i></span>
                            <div>
                                <div class="tpl-card-title">Partner Referral Program</div>
                                <div class="tpl-card-sub">Share your link and earn commissions</div>
                            </div>
                        </div>

                        <a href="{{ route('referrals.dashboard') }}" class="btn tpl-btn tpl-btn-ghost">
                            View Earnings <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </header>

                    <div class="tpl-card-body">
                        <p class="tpl-muted mb-3">
                            Share your referral link to earn commissions on new registrations.
                        </p>

                        <div class="tpl-copy">
                            <input
                                type="text"
                                id="referral-link"
                                class="tpl-copy-input"
                                value="{{ route('client.register', ['referral_code' => $user->referral_code]) }}"
                                readonly
                            />
                            <button class="btn tpl-btn tpl-btn-primary tpl-copy-btn" type="button" onclick="copyReferralLink(this)">
                                <i class="fas fa-copy me-2"></i>Copy
                            </button>
                        </div>

                        <div class="tpl-benefits">
                            <div class="tpl-benefit"><i class="fas fa-check"></i><span>Competitive commissions</span></div>
                            <div class="tpl-benefit"><i class="fas fa-check"></i><span>Real-time tracking</span></div>
                            <div class="tpl-benefit"><i class="fas fa-check"></i><span>Marketing materials</span></div>
                            <div class="tpl-benefit"><i class="fas fa-check"></i><span>Dedicated support</span></div>
                        </div>
                    </div>
                </section>
            </div>
        @endif
    </div>
</div>

<script>
    function copyReferralLink(btn) {
        const input = document.getElementById('referral-link');
        if (!input) return;

        navigator.clipboard.writeText(input.value).then(() => {
            const prev = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-2"></i>Copied';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = prev;
                btn.disabled = false;
            }, 1800);
        }).catch(() => alert('Failed to copy link. Please try again.'));
    }
</script>
@endsection
