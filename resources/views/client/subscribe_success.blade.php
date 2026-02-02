@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-5 text-center">

    <div class="mx-auto" style="max-width: 520px;">
        <div class="mb-4">
            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
        </div>

        <h2 class="mb-3">Subscription Activated 🎉</h2>

        <p class="text-muted mb-4">
            Your <strong>Signals subscription</strong> has been successfully activated.
            You can now access premium market insights from your portal.
        </p>

        <a href="{{ route('client.signals') }}" class="btn btn-primary btn-lg">
            Go to Signals
        </a>
    </div>

</div>
@endsection