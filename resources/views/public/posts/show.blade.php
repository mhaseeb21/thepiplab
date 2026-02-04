@extends('layouts.app')

@php
    use Illuminate\Support\Str;

    $url = url()->current();
    $title = $post->title;

    $share = [
        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='.urlencode($url),
        'linkedin' => 'https://www.linkedin.com/sharing/share-offsite/?url='.urlencode($url),
        'whatsapp' => 'https://wa.me/?text='.urlencode($title.' - '.$url),
        'x'        => 'https://twitter.com/intent/tweet?text='.urlencode($title).'&url='.urlencode($url),
    ];

    // ✅ Social preview (WhatsApp/FB) needs OG tags (absolute URL)
    $ogImage = $post->cover_image
        ? asset('storage/'.$post->cover_image)
        : asset('images/piplabLogo.png');

    $ogDesc = $post->excerpt
        ? Str::limit(strip_tags($post->excerpt), 160)
        : Str::limit(strip_tags($post->content ?? ''), 160);
@endphp

{{-- ✅ These sections are used by your updated layout_custom/app.blade.php --}}
@section('title', $post->title)
@section('meta_description', $ogDesc)
@section('canonical', $url)

@section('og_type', 'article')
@section('og_title', $post->title)
@section('og_description', $ogDesc)
@section('og_image', $ogImage)

@section('content')
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
                            <div class="text-end">
                                <div id="mkUpdated" class="text-muted small"></div>
                                <div id="mkStatus" class="text-muted small"></div>
                            </div>
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
                                        {{-- Skeleton rows (prevents layout jumping) --}}
                                        @for($i=0; $i<5; $i++)
                                            <tr class="mk-skel">
                                                <td><span class="mk-skel-bar w-70"></span></td>
                                                <td class="text-end"><span class="mk-skel-bar w-40"></span></td>
                                            </tr>
                                        @endfor
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
                                        @for($i=0; $i<4; $i++)
                                            <tr class="mk-skel">
                                                <td>
                                                    <span class="mk-skel-bar w-80"></span>
                                                    <div class="mt-1"><span class="mk-skel-bar w-50"></span></div>
                                                </td>
                                                <td class="text-end"><span class="mk-skel-bar w-35"></span></td>
                                            </tr>
                                        @endfor
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

@push('styles')
<style>
/* Keep markets area stable while loading */
#fxBody, #idxBody { min-height: 180px; }

/* Skeleton shimmer */
.mk-skel .mk-skel-bar{
    display:inline-block;
    height: 12px;
    border-radius: 999px;
    background: linear-gradient(90deg,
        rgba(2,6,23,.06) 25%,
        rgba(2,6,23,.12) 37%,
        rgba(2,6,23,.06) 63%
    );
    background-size: 400% 100%;
    animation: mkShimmer 1.2s ease-in-out infinite;
}
@keyframes mkShimmer{
    0%{ background-position: 100% 0; }
    100%{ background-position: 0 0; }
}
.mk-skel td{ padding-top: .6rem; padding-bottom: .6rem; }

/* widths */
.w-80{ width:80%; }
.w-70{ width:70%; }
.w-50{ width:50%; }
.w-40{ width:40%; }
.w-35{ width:35%; }

/* Fade-in for real rows */
.mk-fade-in{ animation: mkFade .25s ease-out; }
@keyframes mkFade{
    from{ opacity:0; transform: translateY(2px); }
    to{ opacity:1; transform: translateY(0); }
}
</style>
@endpush

@push('scripts')
<script>
(function () {
    const endpoint = @json(route('market.widget'));
    const LS_KEY = 'piplab_market_widget_v1';
    const LS_MAX_AGE_MS = 5 * 60 * 1000; // 5 minutes
    const FETCH_TIMEOUT_MS = 8000;

    const fxBody = document.getElementById('fxBody');
    const idxBody = document.getElementById('idxBody');
    const mkUpdated = document.getElementById('mkUpdated');
    const mkStatus = document.getElementById('mkStatus');

    function setStatus(text) {
        if (mkStatus) mkStatus.textContent = text || '';
    }

    function render(data, { animate = false } = {}) {
        if (mkUpdated) mkUpdated.textContent = data.updated_at ? ('Updated: ' + data.updated_at) : '';

        // FX
        fxBody.innerHTML = '';
        (data.fx || []).forEach(row => {
            const val = (row.value === null || row.value === undefined)
                ? '-'
                : Number(row.value).toFixed(4);

            fxBody.insertAdjacentHTML('beforeend', `
                <tr class="${animate ? 'mk-fade-in' : ''}">
                    <td>${row.pair}</td>
                    <td class="text-end fw-semibold">${val}</td>
                </tr>
            `);
        });
        if (!data.fx?.length) {
            fxBody.innerHTML = `<tr><td colspan="2" class="text-muted small">No FX data.</td></tr>`;
        }

        // Indices
        idxBody.innerHTML = '';
        (data.indices || []).forEach(row => {
            const close = (row.close === null || row.close === undefined || row.close === '')
                ? '-'
                : Number(row.close).toLocaleString();

            idxBody.insertAdjacentHTML('beforeend', `
                <tr class="${animate ? 'mk-fade-in' : ''}">
                    <td>
                        <div class="fw-semibold">${row.name}</div>
                        <div class="text-muted small">${row.date || ''}</div>
                    </td>
                    <td class="text-end fw-semibold">${close}</td>
                </tr>
            `);
        });
        if (!data.indices?.length) {
            idxBody.innerHTML = `<tr><td colspan="2" class="text-muted small">No indices data.</td></tr>`;
        }
    }

    function loadFromLocalStorage() {
        try {
            const raw = localStorage.getItem(LS_KEY);
            if (!raw) return false;

            const parsed = JSON.parse(raw);
            if (!parsed || !parsed.data || !parsed.saved_at) return false;

            const age = Date.now() - parsed.saved_at;
            if (age > LS_MAX_AGE_MS) return false;

            render(parsed.data, { animate: false });
            setStatus('Showing cached…');
            return true;
        } catch (_) {
            return false;
        }
    }

    async function fetchWithTimeout(url, timeoutMs) {
        const controller = new AbortController();
        const t = setTimeout(() => controller.abort(), timeoutMs);

        try {
            const res = await fetch(url, {
                headers: { "Accept": "application/json" },
                signal: controller.signal
            });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return await res.json();
        } finally {
            clearTimeout(t);
        }
    }

    async function init() {
        const hadCache = loadFromLocalStorage();

        if (!hadCache) setStatus('Loading…');
        else setStatus('Updating…');

        try {
            const data = await fetchWithTimeout(endpoint, FETCH_TIMEOUT_MS);

            try {
                localStorage.setItem(LS_KEY, JSON.stringify({
                    saved_at: Date.now(),
                    data: data
                }));
            } catch (_) {}

            render(data, { animate: true });
            setStatus('');
        } catch (e) {
            if (hadCache) {
                setStatus('Update failed (showing cached)');
                return;
            }
            fxBody.innerHTML = `<tr><td colspan="2" class="text-muted small">Failed to load.</td></tr>`;
            idxBody.innerHTML = `<tr><td colspan="2" class="text-muted small">Failed to load.</td></tr>`;
            setStatus('Failed');
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
@endpush
