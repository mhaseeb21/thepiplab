@extends('layouts.app')

@section('content')
@php
    $url = url()->current();
    $title = $post->title;

    $share = [
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='.urlencode($url),
        'linkedin' => 'https://www.linkedin.com/sharing/share-offsite/?url='.urlencode($url),
        'whatsapp' => 'https://wa.me/?text='.urlencode($title.' - '.$url),
        'x'        => 'https://twitter.com/intent/tweet?text='.urlencode($title).'&url='.urlencode($url),
    ];
@endphp

<div class="container-fluid py-5 px-3 px-lg-4" style="max-width: 1200px;">
    <div class="row g-4">

        {{-- LEFT: Article --}}
        <div class="col-12 col-lg-8">

            <a href="{{ route('posts.public.index') }}" class="text-decoration-none text-muted">
                ← Back to Market Insights
            </a>

            <div class="mt-3 mb-3">
                <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                    <span class="badge bg-{{ $post->type === 'news' ? 'info' : 'secondary' }}">
                        {{ strtoupper($post->type) }}
                    </span>
                    <span class="text-muted small">{{ $post->published_at?->format('d M Y') }}</span>
                </div>

                <h1 class="mb-2 fw-800" style="color:#091E3E; line-height:1.2;">
                    {{ $post->title }}
                </h1>

                @if($post->excerpt)
                    <p class="text-muted mb-0" style="font-size: 1.05rem;">
                        {{ $post->excerpt }}
                    </p>
                @endif
            </div>

            {{-- Share row under title (mobile friendly) --}}
            <div class="d-flex align-items-center gap-2 flex-wrap my-3">
                <span class="text-muted small me-2">Share:</span>

                <a class="btn btn-sm btn-outline-secondary rounded-10" target="_blank" href="{{ $share['facebook'] }}">
                    <i class="fab fa-facebook-f me-1"></i> Facebook
                </a>

                <a class="btn btn-sm btn-outline-secondary rounded-10" target="_blank" href="{{ $share['whatsapp'] }}">
                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                </a>

                <a class="btn btn-sm btn-outline-secondary rounded-10" target="_blank" href="{{ $share['linkedin'] }}">
                    <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                </a>

                <a class="btn btn-sm btn-outline-secondary rounded-10" target="_blank" href="{{ $share['x'] }}">
                    <i class="fab fa-x-twitter me-1"></i> X
                </a>

                <button class="btn btn-sm btn-outline-primary rounded-10"
                        type="button"
                        onclick="navigator.clipboard.writeText('{{ $url }}')">
                    <i class="fas fa-link me-1"></i> Copy Link
                </button>
            </div>

            @if($post->cover_image)
                <img src="{{ asset('storage/'.$post->cover_image) }}"
                     alt="Cover"
                     class="img-fluid mb-4"
                     style="border-radius:14px; width:100%; object-fit:cover; max-height:420px;">
            @endif

            <article class="card border-0 shadow-sm p-4 p-lg-5" style="border-radius:14px;">
                {!! $post->content !!}
            </article>
        </div>

        {{-- RIGHT: Sticky Markets Table --}}
        <div class="col-12 col-lg-4">
            <div class="position-sticky" style="top: 90px;">
                <div class="card border-0 shadow-sm" style="border-radius:14px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="fw-800" style="color:#091E3E;">Markets</div>
                                <div class="text-muted small">Live snapshot (cached)</div>
                            </div>
                            <span id="mkUpdated" class="text-muted small"></span>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small mb-2">FX</div>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Pair</th>
                                            <th class="text-end">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody id="fxBody">
                                        <tr><td colspan="2" class="text-muted small">Loading...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div>
                            <div class="text-muted small mb-2">Indices</div>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-end">Close</th>
                                        </tr>
                                    </thead>
                                    <tbody id="idxBody">
                                        <tr><td colspan="2" class="text-muted small">Loading...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="text-muted small mt-3">
                            Data sources: exchangerate.host (FX) and Stooq CSV (indices).
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
(async function () {
    try {
        const res = await fetch("{{ route('market.widget') }}", { headers: { "Accept": "application/json" } });
        const data = await res.json();

        // Update time
        document.getElementById('mkUpdated').textContent = data.updated_at ? ('Updated: ' + data.updated_at) : '';

        // FX
        const fxBody = document.getElementById('fxBody');
        fxBody.innerHTML = '';
        (data.fx || []).forEach(row => {
            const val = (row.value === null || row.value === undefined)
                ? '-'
                : Number(row.value).toFixed(4);

            fxBody.insertAdjacentHTML('beforeend', `
                <tr>
                    <td>${row.pair}</td>
                    <td class="text-end fw-semibold">${val}</td>
                </tr>
            `);
        });

        // Indices
        const idxBody = document.getElementById('idxBody');
        idxBody.innerHTML = '';
        (data.indices || []).forEach(row => {
            const close = row.close ? Number(row.close).toLocaleString() : '-';
            idxBody.insertAdjacentHTML('beforeend', `
                <tr>
                    <td>
                        <div class="fw-semibold">${row.name}</div>
                        <div class="text-muted small">${row.date || ''}</div>
                    </td>
                    <td class="text-end fw-semibold">${close}</td>
                </tr>
            `);
        });

        if (!data.fx?.length) fxBody.innerHTML = `<tr><td colspan="2" class="text-muted small">No FX data.</td></tr>`;
        if (!data.indices?.length) idxBody.innerHTML = `<tr><td colspan="2" class="text-muted small">No indices data.</td></tr>`;

    } catch (e) {
        document.getElementById('fxBody').innerHTML = `<tr><td colspan="2" class="text-muted small">Failed to load.</td></tr>`;
        document.getElementById('idxBody').innerHTML = `<tr><td colspan="2" class="text-muted small">Failed to load.</td></tr>`;
    }
})();
</script>
@endpush
