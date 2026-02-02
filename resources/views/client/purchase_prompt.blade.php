@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7 col-xl-6">

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5 text-center">

                    <div class="mb-3">
                        <span class="badge bg-warning text-dark px-3 py-2">
                            Access Required
                        </span>
                    </div>

                    <h3 class="mb-2">Purchase Required</h3>
                    <p class="text-muted mb-4">
                        You need to make a valid purchase to access the forex signals.
                    </p>

                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        <a href="{{ route('client.portal') }}" class="btn btn-primary btn-lg">
                            Go to Purchase Page
                        </a>

                        <a href="{{ route('client.dashboard') }}" class="btn btn-outline-secondary btn-lg">
                            Back to Dashboard
                        </a>
                    </div>

                    <div class="text-muted small mt-4">
                        If you believe this is a mistake, please contact support.
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection