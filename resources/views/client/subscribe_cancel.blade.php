@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-5 text-center">

    <div class="mx-auto" style="max-width: 520px;">
        <div class="mb-4">
            <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
        </div>

        <h2 class="mb-3">Payment Cancelled</h2>

        <p class="text-muted mb-4">
            Your payment was not completed.
            If this was a mistake, you can try again anytime.
        </p>

        <a href="{{ route('purchase.create', ['product' => 'signals']) }}" class="btn btn-outline-primary">
            Try Again
        </a>
    </div>

</div>
@endsection