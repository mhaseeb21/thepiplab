@extends('client.client_layouts.portal')

@section('content')
@php
    $formatMb = function ($bytes) {
        $bytes = (int) ($bytes ?? 0);
        return number_format($bytes / 1024 / 1024, 2) . ' MB';
    };
@endphp

<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="mb-1 fw-700" style="color:#091E3E;">Extra Resources</h2>
            <p class="text-muted mb-0">Cheat sheets, templates, tools, and guides to support your learning.</p>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('student.lectures') }}" class="btn btn-outline-primary btn-sm rounded-10">
                <i class="fas fa-chalkboard-user me-2"></i>Lecture Material
            </a>
        </div>
    </div>

    {{-- Search + Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm rounded-12">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-magnifying-glass text-muted"></i>
                        <input id="resourceSearch"
                               type="text"
                               class="form-control border-0 p-0"
                               placeholder="Search resources by title..."
                               style="outline:none; box-shadow:none;">
                    </div>
                    <div class="text-muted small mt-2">
                        Tip: try “risk”, “checklist”, “template”, “journal” etc.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-12">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Total Resources</div>
                        <div class="fs-4 fw-700" style="color:#091E3E;">{{ $items->count() }}</div>
                    </div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                         style="width:44px;height:44px;background:rgba(6,163,218,0.12);">
                        <i class="fas fa-toolbox" style="color:#06a3da;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Content --}}
    @if($items->count())
        <div class="row g-3" id="resourcesGrid">
            @foreach($items as $item)
                <div class="col-12 col-md-6 col-xl-4 resource-card" data-title="{{ strtolower($item->title) }}">
                    <div class="card border-0 shadow-sm rounded-12 h-100">
                        <div class="card-body d-flex flex-column">

                            {{-- Top --}}
                            <div class="d-flex align-items-start justify-content-between gap-2 mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-10 d-flex align-items-center justify-content-center"
                                         style="width:40px;height:40px;background:rgba(6,163,218,0.12);">
                                        <i class="fas fa-file-arrow-down" style="color:#06a3da;"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">Resource</div>
                                        <span class="badge rounded-pill"
                                              style="background:rgba(6,163,218,0.12); color:#06a3da;">
                                            File
                                        </span>
                                    </div>
                                </div>

                                @if(isset($item->is_published) && !$item->is_published)
                                    <span class="badge bg-warning text-dark rounded-pill">Hidden</span>
                                @endif
                            </div>

                            {{-- Title --}}
                            <h6 class="mb-2 fw-700" style="color:#091E3E;">
                                {{ $item->title }}
                            </h6>

                            {{-- Description --}}
                            @if(!empty($item->description))
                                <p class="text-muted small mb-3" style="min-height: 40px;">
                                    {{ \Illuminate\Support\Str::limit($item->description, 110) }}
                                </p>
                            @else
                                <p class="text-muted small mb-3" style="min-height: 40px;">
                                    Download and use this resource as part of your trading workflow.
                                </p>
                            @endif

                            {{-- Meta + Actions --}}
                            <div class="mt-auto">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge bg-light text-dark rounded-pill">
                                        <i class="fas fa-database me-1"></i> {{ $formatMb($item->size ?? 0) }}
                                    </span>

                                    @if(!empty($item->created_at))
                                        <span class="badge bg-light text-dark rounded-pill">
                                            <i class="fas fa-calendar-days me-1"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('student.materials.download', $item->id) }}"
                                       class="btn btn-primary btn-sm rounded-10 w-100">
                                        <i class="fas fa-download me-2"></i>Download
                                    </a>

                                    <a href="{{ route('student.materials.download', $item->id) }}"
                                       class="btn btn-outline-secondary btn-sm rounded-10"
                                       title="Open">
                                        <i class="fas fa-arrow-up-right-from-square"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty state --}}
        <div class="card border-0 shadow-sm rounded-12">
            <div class="card-body text-center py-5">
                <div class="mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center"
                     style="width:64px;height:64px;background:rgba(6,163,218,0.12);">
                    <i class="fas fa-folder-open fa-2x" style="color:#06a3da;"></i>
                </div>

                <h5 class="mb-2 fw-700" style="color:#091E3E;">No extra resources uploaded yet</h5>
                <p class="text-muted mb-0">Please check back later. New resources will appear here once published.</p>

                <div class="mt-4">
                    <a href="{{ route('student.lectures') }}" class="btn btn-outline-primary btn-sm rounded-10">
                        ← Back to Lecture Material
                    </a>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
    (function () {
        const input = document.getElementById('resourceSearch');
        const cards = document.querySelectorAll('.resource-card');

        if (!input) return;

        input.addEventListener('input', function () {
            const q = (this.value || '').toLowerCase().trim();

            cards.forEach(card => {
                const title = card.getAttribute('data-title') || '';
                card.style.display = title.includes(q) ? '' : 'none';
            });
        });
    })();
</script>
@endpush
