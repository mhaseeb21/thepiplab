@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4 signal-show">

    {{-- Disclaimer --}}
    <div class="alert alert-light border text-muted small mb-4">
        <strong>Disclaimer:</strong>
        This trade setup is provided for educational and informational purposes only.
        It does not constitute financial advice or a guarantee of results.
        Market conditions can change rapidly, and past performance does not ensure future outcomes.
    </div>

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1 fw-bold text-dark">Trade Setup Details</h2>
            <div class="text-muted">
                <span class="signal-pill signal-pill--pair">{{ $signal->pair_name }}</span>
                <span class="mx-2">•</span>
                <span class="signal-pill signal-pill--type">
                    @if($signal->signal_type === 'buy')
                        <i class="fas fa-arrow-up me-1"></i>Bullish (Buy)
                    @else
                        <i class="fas fa-arrow-down me-1"></i>Bearish (Sell)
                    @endif
                </span>
            </div>
        </div>

        <a href="{{ route('client.signals') ?? url()->previous() }}" class="btn btn-outline-secondary btn-sm rounded-3">
            <i class="fas fa-arrow-left me-2"></i>Back to Trade Setups
        </a>
    </div>

    <div class="row g-4">

        {{-- Images --}}
        <div class="col-12 col-lg-6">
            @include('client.partials_custom.signal_image_card', [
                'title' => 'Before Chart',
                'badge' => ['text' => 'Setup', 'class' => 'bg-dark'], // changed from primary to dark (black feel)
                'icon'  => ['class' => 'fas fa-chart-line', 'style' => 'color:#000;'], // changed to black
                'imgUrl' => $signal->before_image_url,
                'imgAlt' => 'Before Chart',
                'imgTitle' => "Before Chart - {$signal->pair_name}",
                'meta' => [
                    ['label' => 'Type', 'value' => 'Market Entry Setup'],
                    ['label' => 'Uploaded', 'value' => $signal->created_at->format('M d, Y • H:i')],
                ],
                'empty' => [
                    'icon' => 'fas fa-image',
                    'title' => 'No Before Image',
                    'text' => 'The before chart image is not available for this setup.',
                    'actionText' => 'View Other Setups',
                    'actionUrl' => route('client.signals'),
                ],
            ])
        </div>

        <div class="col-12 col-lg-6">
            @include('client.partials_custom.signal_image_card', [
                'title' => 'After / Proof',
                'badge' => ['text' => 'Result', 'class' => 'signal-badge-soft-success'],
                'icon'  => ['class' => 'fas fa-check-circle', 'style' => 'color:#4CAF50;'],
                'imgUrl' => $signal->after_image_url,
                'imgAlt' => 'After Chart',
                'imgTitle' => "After / Proof - {$signal->pair_name}",
                'meta' => [
                    [
                        'label' => 'Status',
                        'value' => $signal->result_label ?? 'Pending',
                        'valueClass' => ($signal->result_label === 'Win') ? 'text-success fw-bold' : (($signal->result_label === 'Loss') ? 'text-danger fw-bold' : 'text-warning fw-bold'),
                    ],
                    ['label' => 'Updated', 'value' => $signal->updated_at->format('M d, Y • H:i')],
                ],
                'empty' => [
                    'variant' => 'pending',
                    'icon' => 'fas fa-hourglass-half',
                    'title' => 'Awaiting Proof',
                    'text' => 'This setup is still pending completion. The proof image will appear here once the trade is closed.',
                ],
            ])
        </div>

        {{-- Info --}}
        <div class="col-12">
            <div class="card shadow-sm border-0 signal-card">
                <div class="card-header text-white signal-card__header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2" style="color:#000;"></i>
                        Trade Information
                    </h5>
                </div>

                <div class="card-body">
                    {{-- Entry & Targets --}}
                    <h6 class="signal-section-title">Entry & Target Levels</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="signal-kv">
                                <div class="signal-kv__k">Entry Criteria</div>
                                <div class="signal-kv__v">{{ $signal->entry_criteria ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="signal-kv">
                                <div class="signal-kv__k">TP1</div>
                                <div class="signal-kv__v text-success">{{ $signal->tp1 ?? '—' }}</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="signal-kv">
                                <div class="signal-kv__k">TP2</div>
                                <div class="signal-kv__v text-success">{{ $signal->tp2 ?? '—' }}</div>
                            </div>
                        </div>

                        @if($signal->stop_loss)
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="signal-kv">
                                    <div class="signal-kv__k">Stop Loss</div>
                                    <div class="signal-kv__v text-danger">{{ $signal->stop_loss }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Status --}}
                    <h6 class="signal-section-title">Status</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-4">
                            <div class="signal-kv">
                                <div class="signal-kv__k">Current Status</div>
                                <div class="signal-kv__v">
                                    @if($signal->result_label === 'Win')
                                        <span class="signal-pill signal-pill--win"><i class="fas fa-trophy me-1"></i>Win</span>
                                    @elseif($signal->result_label === 'Loss')
                                        <span class="signal-pill signal-pill--loss"><i class="fas fa-times-circle me-1"></i>Loss</span>
                                    @else
                                        <span class="signal-pill signal-pill--pending"><i class="fas fa-clock me-1"></i>{{ $signal->result_label ?? 'Pending' }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="signal-kv">
                                <div class="signal-kv__k">Pair</div>
                                <div class="signal-kv__v">
                                    <span class="signal-pill signal-pill--pair">{{ $signal->pair_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="signal-kv">
                                <div class="signal-kv__k">Type</div>
                                <div class="signal-kv__v">
                                    @if($signal->signal_type === 'buy')
                                        <span class="signal-pill signal-pill--win"><i class="fas fa-arrow-up me-1"></i>Bullish</span>
                                    @else
                                        <span class="signal-pill signal-pill--loss"><i class="fas fa-arrow-down me-1"></i>Bearish</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    @if($signal->description)
                        <h6 class="signal-section-title">Description</h6>
                        <div class="signal-box mb-4">
                            <p class="mb-0">{!! nl2br(e($signal->description)) !!}</p>
                        </div>
                    @endif

                    {{-- Timeline --}}
                    <h6 class="signal-section-title">Timeline</h6>
                    <ul class="signal-timeline">
                        <li>
                            <span class="dot"></span>
                            <div>
                                <div class="label">Setup Created</div>
                                <div class="time">{{ $signal->created_at->timezone('Asia/Karachi')->format('l, F j, Y - h:i A') }} PKT</div>
                            </div>
                        </li>

                        @if($signal->updated_at !== $signal->created_at)
                            <li>
                                <span class="dot"></span>
                                <div>
                                    <div class="label">Last Updated</div>
                                    <div class="time">{{ $signal->updated_at->timezone('Asia/Karachi')->format('l, F j, Y - h:i A') }} PKT</div>
                                </div>
                            </li>
                        @endif

                        @if($signal->completed_at)
                            <li class="completed">
                                <span class="dot"></span>
                                <div>
                                    <div class="label">Setup Completed</div>
                                    <div class="time">{{ $signal->completed_at->timezone('Asia/Karachi')->format('l, F j, Y - h:i A') }} PKT</div>
                                </div>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- Full Screen Image Modal --}}
<div class="modal fade" id="signalImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen m-0">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0 signal-modal-header">
                <h5 class="modal-title text-white" id="signalImageTitle">Trade Setup</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 signal-modal-body">
                <img id="signalImagePreview" src="" alt="Trade Setup Fullscreen" class="signal-modal-img">
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/signal-show.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/signal-show.js') }}"></script>
@endpush
