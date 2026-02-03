@extends('layouts.app')

@section('content')
    @include('partials.hero_modern')

    <section class="section-muted">
        @include('partials.about_modern')
    </section>

    <section>
        @include('partials.features_modern')
    </section>

    <section class="section-muted">
        @include('partials.service_modern')
    </section>

    <section>
        @include('partials.pricing_modern')
    </section>

    <section class="section-muted">
        @include('partials.quote_modern')
    </section>

    <section class="section-muted">
        @include('partials.testimonial_modern')
    </section>

    <section>
        @include('partials.blog_modern')
    </section>
@endsection

@push('head')
<style>
    /* Your muted section gradient (kept on HOME only) */
    .section-muted{
        background: linear-gradient(180deg, rgba(6, 163, 218, .07), rgba(57, 213, 255, .04));
        border: 0 !important;
    }
</style>
@endpush
