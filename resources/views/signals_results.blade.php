@extends('layouts.app')

@php
    use Illuminate\Support\Str;

    // ✅ Tell layout to hide the big page header/banner on this page
    $hidePageHeader = true;
@endphp

@section('content')
<div class="container-fluid pt-3 pb-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-0">

        {{-- Top note + premium upsell --}}
        <div class="alert alert-info border-0 shadow-sm mb-4">
            <strong>Note:</strong>
            The information displayed below reflects historical market outcomes and completed trade scenarios.
            It is shared strictly for educational and transparency purposes.
            <br><br>
            <strong>Want real-time market updates and premium insights?</strong>
            Access our premium package to receive live market coverage and exclusive analytical content.
            <a href="{{ route('home') }}#pricing" class="fw-semibold text-decoration-underline ms-1">
                View Premium Plans
            </a>
        </div>

        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h2 class="mb-1 fw-bold">Market Outcomes</h2>
                <p class="text-muted mb-0">Previously shared market scenarios with updated outcomes</p>
            </div>
        </div>

        @if($signals->count())
            <div class="row g-4">
                @foreach($signals as $signal)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm">

                            <div class="ratio ratio-16x9 bg-light">
                                <img src="{{ $signal->before_image_url }}"
                                     alt="Market Context"
                                     style="object-fit: cover;"
                                     class="w-100 h-100">
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <div>
                                        <div class="fw-bold">{{ $signal->pair_name }}</div>
                                        <div class="text-muted small">
                                            {{ $signal->signal_type === 'buy' ? 'Bullish' : 'Bearish' }}
                                            • Updated {{ $signal->updated_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <span class="badge {{ $signal->result_badge_class }}">
                                        {{ $signal->result_label }}
                                    </span>
                                </div>

                                @if($signal->description)
                                    <p class="text-muted small mt-3 mb-0">
                                        {{ Str::limit($signal->description, 120) }}
                                    </p>
                                @endif
                            </div>

                            @if($signal->after_image_url)
                                <div class="p-3 pt-0">
                                    <a href="{{ route('signals.results.show', $signal) }}"
                                       class="btn btn-sm btn-outline-primary w-100">
                                        View Market Outcome
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $signals->links() }}
            </div>
        @else
            <div class="text-center text-muted py-5">
                No outcomes available yet.
            </div>
        @endif

        {{-- Optional footer disclaimer --}}
        <p class="text-muted small mt-5 mb-0">
            Past market outcomes are not indicative of future performance.
            All content is provided for informational purposes only and should not be considered financial advice.
        </p>

    </div>
</div>
@endsection