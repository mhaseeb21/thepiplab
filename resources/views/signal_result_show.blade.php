@extends('layouts.app')

@section('content')
<div class="container py-5">

    <a href="{{ route('signals.results') }}" class="btn btn-sm btn-outline-secondary mb-4">
        ← Back to Results
    </a>

    <div class="mb-3">
        <h3 class="fw-bold mb-1">{{ $signal->pair_name }}</h3>
        <div class="text-muted">
            {{ ucfirst($signal->signal_type) }}
            • {{ $signal->result_label }}
            • Updated {{ $signal->updated_at->diffForHumans() }}
        </div>
    </div>

    <div class="row g-4">

        {{-- BEFORE --}}
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header fw-semibold">Before (Setup)</div>
                <img src="{{ $signal->before_image_url }}"
                     class="w-100"
                     style="object-fit: cover;"
                     alt="Before Chart">
            </div>
        </div>

        {{-- AFTER --}}
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header fw-semibold">After (Result)</div>

                @if($signal->after_image_url)
                    <img src="{{ $signal->after_image_url }}"
                         class="w-100"
                         style="object-fit: cover;"
                         alt="After Chart">
                @else
                    <div class="p-4 text-center text-muted">
                        Proof image not available.
                    </div>
                @endif
            </div>
        </div>

        {{-- DESCRIPTION --}}
        @if($signal->description)
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header fw-semibold">Description</div>
                    <div class="card-body">
                        {!! nl2br(e($signal->description)) !!}
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection