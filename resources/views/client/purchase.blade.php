@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="mb-5">
        <h2 class="mb-2 fw-700" style="color:#091E3E;">Complete Your Purchase</h2>
        <p class="text-muted mb-0">
            @if($product === 'signals')
                <i class="fas fa-info-circle me-2"></i>
                Subscribe via crypto and your access will activate automatically.
            @else
                <i class="fas fa-info-circle me-2"></i>
                Submit your payment details to activate your product.
            @endif
        </p>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 alert-notification fade-in">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3"></i>
                <div>{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4 alert-notification fade-in">
            <div class="d-flex align-items-start">
                <i class="fas fa-exclamation-circle me-3 mt-1"></i>
                <div>
                    <div class="fw-semibold mb-2">Please fix the following errors:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- SIGNALS: AUTO FLOW --}}
    @if($product === 'signals')

        <div class="row g-4 justify-content-center">
            <div class="col-12 col-lg-8">

                {{-- Price Card --}}
                <div class="purchase-card price-card mb-4">
                    <div class="purchase-card-header">
                        <i class="fas fa-bolt me-2"></i> Subscription Details
                    </div>

                    <div class="purchase-card-body">
                        <div class="price-display">
                            <div class="price-label">Total Amount</div>
                            <div class="price-value">${{ $amount }}</div>
                            <div class="price-currency">USDT (TRC20 Network)</div>
                        </div>

                        <div class="features-list">
                            <div class="feature"><i class="fas fa-check-circle"></i>Instant access after payment</div>
                            <div class="feature"><i class="fas fa-check-circle"></i>Premium market updates</div>
                            <div class="feature"><i class="fas fa-check-circle"></i>Real-time alerts</div>
                            <div class="feature"><i class="fas fa-check-circle"></i>24/7 support</div>
                        </div>
                    </div>
                </div>

                {{-- Subscribe Button --}}
                <a href="{{ route('signals.subscribe') }}" class="btn btn-primary btn-lg w-100 subscribe-btn">
                    <i class="fas fa-credit-card me-2"></i>
                    Proceed to Payment
                </a>

                <div class="text-center text-muted small mt-3">
                    <i class="fas fa-shield-alt me-1"></i>
                    Payments are processed securely by NOWPayments
                </div>
            </div>
        </div>

    {{-- COURSE / BOT: MANUAL FLOW --}}
    @else

        <div class="row g-4 align-items-start">

            {{-- LEFT --}}
            <div class="col-12 col-lg-7">

                {{-- Amount --}}
                <div class="purchase-card price-card mb-4">
                    <div class="purchase-card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="price-label">Total Amount Due</div>
                            <div class="price-value">${{ $amount }}</div>
                        </div>
                        <div class="product-badge">{{ strtoupper($product) }}</div>
                    </div>
                </div>

                {{-- Form --}}
                <div class="purchase-card form-card">
                    <div class="purchase-card-header">
                        <i class="fas fa-credit-card me-2"></i> Payment Details
                    </div>

                    <div class="purchase-card-body">
                        <form action="{{ route('purchase.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Deposit --}}
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-wallet me-2"></i>TRC20 Deposit Address
                                </label>
                                <div class="input-group input-group-lg">
                                    <input type="text" id="trc20_deposit_link"
                                           class="form-control"
                                           value="TM4joC475PdZcVDA2En1TjjNqHFg3rKRrK"
                                           readonly>
                                    <button type="button" class="btn btn-primary copy-btn"
                                            onclick="copyDepositAddress()">
                                        <i class="fas fa-copy me-2"></i>Copy
                                    </button>
                                </div>
                                <div class="form-text">Send only USDT (TRC20) to this address</div>
                            </div>

                            {{-- Transaction --}}
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-key me-2"></i>Transaction ID
                                </label>
                                <input type="text"
                                       name="transaction_id"
                                       class="form-control form-control-lg"
                                       required
                                       placeholder="Transaction ID / Full Name / Client ID">
                            </div>

                            {{-- Upload --}}
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-image me-2"></i>Payment Proof
                                </label>

                                <div class="upload-area">
                                    <input type="file"
                                           name="payment_proof"
                                           id="payment_proof"
                                           accept="image/*"
                                           required>

                                    <div class="upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>

                                    <div class="upload-text">
                                        <p class="mb-1">Click to upload payment screenshot</p>
                                        <small>PNG, JPG, GIF (Max 5MB)</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Hidden --}}
                            <input type="hidden" name="product_type" value="{{ $product }}">
                            <input type="hidden" name="amount" value="{{ $amount }}">

                            <button type="submit" class="btn btn-primary btn-lg w-100 submit-btn">
                                <i class="fas fa-check-circle me-2"></i>Submit Payment
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="col-12 col-lg-5">
                <div class="purchase-card example-card sticky-top" style="top:20px;">
                    <div class="purchase-card-header">
                        <i class="fas fa-eye me-2"></i> Example Screenshot
                    </div>
                    <div class="purchase-card-body text-center">
                        <img src="{{ asset('images/ch.png') }}"
                             class="img-fluid rounded-12"
                             alt="Payment Example">
                        <p class="text-muted small mt-3">
                            This is only an example. Your screenshot may differ.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    @endif
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/purchase.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/purchase.js') }}"></script>
@endpush