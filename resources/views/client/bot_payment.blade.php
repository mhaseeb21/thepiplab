@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    <h2 class="mb-2 fw-700" style="color:#091E3E;">Bot Payment</h2>
    <p class="text-muted">Submit payment proof for your accepted quote.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    @php
        $quoteMissing = empty($botRequest->quoted_amount) || $botRequest->quoted_amount <= 0;
    @endphp

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="mb-3">
                <div class="fw-semibold">Quoted Amount</div>

                @if($quoteMissing)
                    <div class="text-danger fw-bold">Pending Quote</div>
                    <div class="text-muted small mt-1">
                        Your quote has not been set yet. Please wait for admin to send the quote.
                    </div>
                @else
                    <div style="font-size:22px;">
                        <strong>${{ number_format($botRequest->quoted_amount, 2) }}</strong>
                    </div>
                @endif
            </div>

            @if($quoteMissing)
                <div class="alert alert-warning mb-0">
                    Quote is not available yet, so payment cannot be submitted.
                </div>

            @elseif($hasPendingPayment)
                <div class="alert alert-warning mb-0">
                    You already submitted payment proof. Please wait for admin approval.
                </div>

            @else
                <form method="POST"
                      action="{{ route('bot.request.payment.submit', $botRequest->id) }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">TRC20 Deposit Address</label>
                        <input class="form-control"
                               value="TM4joC475PdZcVDA2En1TjjNqHFg3rKRrK"
                               readonly>
                        <div class="form-text">Send only USDT (TRC20) to this address</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Transaction ID</label>
                        <input name="transaction_id"
                               class="form-control"
                               required
                               placeholder="Transaction ID / Full Name / Client ID">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Proof</label>
                        <input type="file"
                               name="payment_proof"
                               class="form-control"
                               required
                               accept="image/*">
                        <div class="form-text">Upload screenshot (JPG/PNG/GIF, max 2MB)</div>
                    </div>

                    <button class="btn btn-primary w-100">
                        Submit Payment
                    </button>
                </form>
            @endif

        </div>
    </div>
</div>
@endsection
