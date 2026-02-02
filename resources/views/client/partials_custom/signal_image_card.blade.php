@php
    $badgeClass = $badge['class'] ?? 'bg-primary';
    $emptyVariant = $empty['variant'] ?? 'default';
@endphp

<div class="card shadow-sm border-0 signal-card h-100">
    <div class="card-header text-white signal-card__header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <i class="{{ $icon['class'] }}" style="{{ $icon['style'] ?? '' }}"></i>
            <span>{{ $title }}</span>
        </div>

        @if(($badge['text'] ?? null) === 'Result' && $badgeClass === 'signal-badge-soft-success')
            <span class="badge {{ $badgeClass }}">{{ $badge['text'] }}</span>
        @else
            <span class="badge {{ $badgeClass }}">{{ $badge['text'] ?? '' }}</span>
        @endif
    </div>

    <div class="card-body d-flex flex-column">
        @if(!empty($imgUrl))
            <button
                type="button"
                class="signal-imgwrap"
                data-bs-toggle="modal"
                data-bs-target="#signalImageModal"
                data-img-src="{{ $imgUrl }}"
                data-img-title="{{ $imgTitle }}"
            >
                <img src="{{ $imgUrl }}" class="signal-img" alt="{{ $imgAlt }}">
                <span class="signal-imgoverlay">
                    <i class="fas fa-search-plus"></i>
                    <span>Click to expand</span>
                </span>
            </button>

            <div class="mt-3">
                @foreach($meta ?? [] as $row)
                    <div class="signal-meta">
                        <span class="k">{{ $row['label'] }}</span>
                        <span class="v {{ $row['valueClass'] ?? '' }}">{{ $row['value'] }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="signal-empty {{ $emptyVariant === 'pending' ? 'is-pending' : '' }}">
                <div class="icon"><i class="{{ $empty['icon'] }}"></i></div>
                <div class="ttl">{{ $empty['title'] }}</div>
                <div class="txt">{{ $empty['text'] }}</div>

                @if(!empty($empty['actionUrl']))
                    <a href="{{ $empty['actionUrl'] }}" class="btn btn-sm btn-outline-primary mt-3">
                        <i class="fas fa-arrow-left me-2"></i>{{ $empty['actionText'] ?? 'Back' }}
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>