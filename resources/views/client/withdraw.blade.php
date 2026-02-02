@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="mb-4">
        <h3 class="mb-1">Request Withdrawal</h3>
        <div class="text-muted">Submit a withdrawal request from your available balance</div>
    </div>

    <div class="row g-4">
        {{-- Balance Card --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-muted small mb-1">Available Balance</div>
                    <div class="fs-4 fw-semibold text-success">
                        ${{ number_format($wallet->balance, 2) }}
                    </div>
                    <div class="small text-muted mt-2">
                        Withdrawals are processed manually and may take some time.
                    </div>
                </div>
            </div>
        </div>

        {{-- Withdrawal Form --}}
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4">

                    <form action="{{ route('client.withdraw.store') }}" method="POST">
                        @csrf

                        {{-- Amount --}}
                        <div class="mb-3">
                            <label for="amount" class="form-label">Withdraw Amount</label>
                            <input
                                type="number"
                                name="amount"
                                class="form-control"
                                id="amount"
                                placeholder="Enter amount"
                                min="1"
                                required
                            >
                        </div>

                        {{-- Withdraw Type --}}
                        <div class="mb-3">
                            <label for="withdraw_type" class="form-label">Withdraw Method</label>
                            <select
                                name="withdraw_type"
                                class="form-select"
                                id="withdraw_type"
                                required
                            >
                                <option value="">Select Method</option>
                                <option value="trc20">USDT (TRC20)</option>
                                <option value="btc">Bitcoin (BTC)</option>
                                <option value="eth">Ethereum (ETH)</option>
                            </select>
                            <div class="form-text">
                                Make sure your wallet supports the selected network.
                            </div>
                        </div>

                        {{-- Withdraw Address --}}
                        <div class="mb-4">
                            <label for="withdraw_address" class="form-label">Wallet Address</label>
                            <input
                                type="text"
                                name="withdraw_address"
                                class="form-control"
                                id="withdraw_address"
                                placeholder="Enter wallet address"
                                required
                            >
                        </div>

                        {{-- Submit --}}
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                Submit Withdrawal
                            </button>

                            <a href="{{ route('client.withdraw.history') }}"
                               class="btn btn-outline-secondary px-4">
                                View History
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

{{-- Dynamic Placeholder Script --}}
<script>
    document.getElementById('withdraw_type').addEventListener('change', function () {
        const addressInput = document.getElementById('withdraw_address');

        if (this.value === 'trc20') {
            addressInput.placeholder = 'Enter your USDT (TRC20) address';
        } else if (this.value === 'btc') {
            addressInput.placeholder = 'Enter your Bitcoin (BTC) address';
        } else if (this.value === 'eth') {
            addressInput.placeholder = 'Enter your Ethereum (ETH) address';
        } else {
            addressInput.placeholder = 'Enter wallet address';
        }
    });
</script>
@endsection