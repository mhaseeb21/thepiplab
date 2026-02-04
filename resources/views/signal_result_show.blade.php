@extends('layouts.app')

@php
    use Illuminate\Support\Str;

    $url = url()->current();

    // ✅ Choose which image should be used for WhatsApp preview
    // Prefer AFTER image if available, otherwise BEFORE, otherwise fallback logo
    $ogImage = $signal->after_image_url
        ? $signal->after_image_url
        : ($signal->before_image_url ? $signal->before_image_url : asset('images/piplabLogo.png'));

    // ✅ Title/Description for preview
    $signalType = ucfirst($signal->signal_type);
    $resultLabel = $signal->result_label ?? 'Result Update';

    $ogTitle = trim($signal->pair_name.' • '.$signalType.' • '.$resultLabel);

    $descRaw = $signal->description
        ? strip_tags($signal->description)
        : ($signalType.' result update for '.$signal->pair_name.'.');

    $ogDesc = Str::limit($descRaw, 160);
@endphp

{{-- ✅ These sections are used by your updated layout head tags --}}
@section('title', $ogTitle)
@section('meta_description', $ogDesc)
@section('canonical', $url)

@section('og_type', 'article')
@section('og_title', $ogTitle)
@section('og_description', $ogDesc)
@section('og_image', $ogImage)

@section('content')
<div class="container py-5" style="max-width: 1100px;">

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
            <div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden;">
                <div class="card-header fw-semibold bg-white">
                    Before (Setup)
                </div>

                @if($signal->before_image_url)
                    <img src="{{ $signal->before_image_url }}"
                         class="w-100"
                         style="object-fit: cover; max-height: 420px;"
                         alt="Before Chart">
                @else
                    <div class="p-4 text-center text-muted">
                        Setup image not available.
                    </div>
                @endif
            </div>
        </div>

        {{-- AFTER --}}
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow-sm" style="border-radius:14px; overflow:hidden;">
                <div class="card-header fw-semibold bg-white">
                    After (Result)
                </div>

                @if($signal->after_image_url)
                    <img src="{{ $signal->after_image_url }}"
                         class="w-100"
                         style="object-fit: cover; max-height: 420px;"
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
                <div class="card border-0 shadow-sm" style="border-radius:14px;">
                    <div class="card-header fw-semibold bg-white">Description</div>
                    <div class="card-body">
                        {!! nl2br(e($signal->description)) !!}
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
