@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4 client-signals">
    {{-- Disclaimer --}}
    <div class="alert alert-light border text-muted small mb-4">
        <strong>Disclaimer:</strong>
        This trade setup is provided for educational and informational purposes only.
        It does not constitute financial advice or a guarantee of results.
        Market conditions can change rapidly, and past performance does not ensure future outcomes.
    </div>
    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5">
        <div class="mb-3 mb-md-0">
            <h2 class="mb-2 fw-700" style="color: #091E3E;">Trade Setups</h2>
            <p class="text-muted mb-0">Real-time market analysis</p>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('client.portal') }}" class="btn btn-outline-secondary btn-sm rounded-10">
                <i class="fas fa-arrow-left me-2"></i>Back
            </a>
            <button class="btn btn-primary btn-sm rounded-10" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="fas fa-filter me-2"></i>Filter
            </button>
        </div>
    </div>

    {{-- Trade Setup Tabs --}}
    <div class="signals-tabs mb-4">
        <div class="nav nav-tabs border-bottom" role="tablist" style="border-color: rgba(6, 163, 218, 0.2) !important;">
            <button class="nav-link active signal-tab-btn" id="pending-tab" data-bs-toggle="tab"
                    data-bs-target="#pending-signals" type="button" role="tab"
                    aria-controls="pending-signals" aria-selected="true">
                <i class="fas fa-clock me-2"></i>
                Ongoing Trade Ideas
                <span class="signal-badge">{{ $pendingCount ?? ($pendingSignals->total() ?? 0) }}</span>
            </button>

            <button class="nav-link signal-tab-btn" id="completed-tab" data-bs-toggle="tab"
                    data-bs-target="#completed-signals" type="button" role="tab"
                    aria-controls="completed-signals" aria-selected="false">
                <i class="fas fa-check-circle me-2"></i>
                Completed
                <span class="signal-badge">{{ $completedCount ?? ($completedSignals->total() ?? 0) }}</span>
            </button>
        </div>
    </div>

    {{-- Tab Content --}}
    <div class="tab-content">

        {{-- PENDING --}}
        <div class="tab-pane fade show active" id="pending-signals" role="tabpanel" aria-labelledby="pending-tab">
            @if(isset($pendingSignals) && $pendingSignals->count() > 0)
                <div class="signals-grid">
                    @foreach($pendingSignals as $signal)
                        <div class="signal-card-wrapper">
                            <div class="signal-card pending">

                                <div class="signal-image-container">
                                    @if(!empty($signal->before_image_url))
                                        <img src="{{ $signal->before_image_url }}"
                                             alt="Signal"
                                             class="signal-image js-open-image"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageModal"
                                             data-image="{{ $signal->before_image_url }}"
                                             data-title="{{ $signal->pair_name ?? 'Signal Image' }}">
                                        <div class="signal-zoom-hint">
                                            <i class="fas fa-search-plus"></i> Click to enlarge
                                        </div>
                                    @else
                                        <div class="signal-no-image">
                                            <i class="fas fa-image"></i>
                                            <p>No image available</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="signal-content">
                                    <div class="signal-header">
                                        <div>
                                            <h5 class="signal-title">{{ $signal->pair_name ?? 'Market Signal' }}</h5>
                                            <div class="signal-meta">
                                                <span class="signal-pair">{{ $signal->pair_name ?? 'N/A' }}</span>
                                                <span class="signal-separator">•</span>
                                                <span class="signal-type">
                                                    {{ ($signal->signal_type ?? '') === 'buy' ? 'Bullish' : 'Bearish' }}
                                                </span>
                                            </div>
                                        </div>
                                        <span class="badge signal-status-pending">
                                            <span class="status-dot"></span> Pending
                                        </span>
                                    </div>

                                    <div class="signal-details-grid">
                                        @if(!empty($signal->entry_criteria))
                                            <div class="signal-detail">
                                                <div class="detail-label">Entry Criteria</div>
                                                <div class="detail-value">{{ $signal->entry_criteria }}</div>
                                            </div>
                                        @endif

                                        @if(!empty($signal->tp1))
                                            <div class="signal-detail">
                                                <div class="detail-label">TP1</div>
                                                <div class="detail-value text-success">{{ $signal->tp1 }}</div>
                                            </div>
                                        @endif

                                        @if(!empty($signal->tp2))
                                            <div class="signal-detail">
                                                <div class="detail-label">TP2</div>
                                                <div class="detail-value text-success">{{ $signal->tp2 }}</div>
                                            </div>
                                        @endif

                                        @if(!empty($signal->sl))
                                            <div class="signal-detail">
                                                <div class="detail-label">Stop Loss</div>
                                                <div class="detail-value text-danger">{{ $signal->sl }}</div>
                                            </div>
                                        @endif
                                    </div>

                                    @if(!empty($signal->description))
                                        <div class="signal-description">
                                            <p>{{ \Illuminate\Support\Str::limit($signal->description, 150) }}</p>
                                        </div>
                                    @endif

                                    <div class="signal-footer">
                                        <span class="signal-time">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $signal->created_at?->diffForHumans() }}
                                        </span>
                                        <a href="{{ route('client.signals.show', $signal->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-8">
                                            View Details
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 pagination-wrap">
                    {{ $pendingSignals->appends(['activeTab' => 'pending'])->links() }}
                </div>
            @else
                <div class="empty-state-card">
                    <i class="fas fa-inbox empty-icon"></i>
                    <h4 class="mt-3">No Pending Signals</h4>
                    <p class="text-muted">There are no pending signals at the moment. Check back soon!</p>
                </div>
            @endif
        </div>

        {{-- COMPLETED --}}
        <div class="tab-pane fade" id="completed-signals" role="tabpanel" aria-labelledby="completed-tab">
            @if(isset($completedSignals) && $completedSignals->count() > 0)
                <div class="signals-grid">
                    @foreach($completedSignals as $signal)
                        <div class="signal-card-wrapper">
                            <div class="signal-card completed">

                                <div class="signal-image-container">
                                    @if(!empty($signal->after_image_url))
                                        <img src="{{ $signal->after_image_url }}"
                                             alt="Signal"
                                             class="signal-image js-open-image"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageModal"
                                             data-image="{{ $signal->after_image_url }}"
                                             data-title="{{ $signal->pair_name ?? 'Signal Image' }}">
                                        <div class="signal-zoom-hint">
                                            <i class="fas fa-search-plus"></i> Click to enlarge
                                        </div>
                                    @else
                                        <div class="signal-no-image">
                                            <i class="fas fa-image"></i>
                                            <p>No image available</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="signal-content">
                                    <div class="signal-header">
                                        <div>
                                            <h5 class="signal-title">{{ $signal->pair_name ?? 'Market Signal' }}</h5>
                                            <div class="signal-meta">
                                                <span class="signal-pair">{{ $signal->pair_name ?? 'N/A' }}</span>
                                                <span class="signal-separator">•</span>
                                                <span class="signal-type">
                                                    {{ ($signal->signal_type ?? '') === 'buy' ? 'Bullish' : 'Bearish' }}
                                                </span>
                                            </div>
                                        </div>

                                        <span class="badge signal-status-completed">
                                            <span class="status-dot"></span> {{ $signal->result_label ?? 'Completed' }}
                                        </span>
                                    </div>

                                    <div class="signal-details-grid">
                                        @if(!empty($signal->tp1))
                                            <div class="signal-detail">
                                                <div class="detail-label">TP1</div>
                                                <div class="detail-value text-success">{{ $signal->tp1 }}</div>
                                            </div>
                                        @endif

                                        @if(!empty($signal->tp2))
                                            <div class="signal-detail">
                                                <div class="detail-label">TP2</div>
                                                <div class="detail-value text-success">{{ $signal->tp2 }}</div>
                                            </div>
                                        @endif

                                        @if(!empty($signal->sl))
                                            <div class="signal-detail">
                                                <div class="detail-label">SL</div>
                                                <div class="detail-value text-danger">{{ $signal->sl }}</div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="signal-footer">
                                        <span class="signal-time">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ ($signal->updated_at ?? $signal->created_at)?->diffForHumans() }}
                                        </span>

                                        <a href="{{ route('client.signals.show', $signal->id) }}"
                                           class="btn btn-sm btn-outline-primary rounded-8">
                                            View Details
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 pagination-wrap">
                    {{ $completedSignals->appends(['activeTab' => 'completed'])->links() }}
                </div>
            @else
                <div class="empty-state-card">
                    <i class="fas fa-check-circle empty-icon success"></i>
                    <h4 class="mt-3">No Completed Signals</h4>
                    <p class="text-muted">Completed signals will appear here</p>
                </div>
            @endif
        </div>

    </div>

</div>

{{-- Image Modal --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-dark text-white">
                <h5 class="modal-title" id="imageModalTitle">Signal Image</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0" style="background: #f8f9fa;">
                <img id="modalImage" src="" alt="Signal" style="width: 100%; height: auto; display: block;">
            </div>
        </div>
    </div>
</div>

{{-- Signal Detail Modal (kept if you use it elsewhere) --}}
<div class="modal fade" id="signalDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 bg-dark text-white">
                <h5 class="modal-title">Signal Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="signalDetailContent"></div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/client/css/signals.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/client/js/signals.js') }}"></script>
@endpush