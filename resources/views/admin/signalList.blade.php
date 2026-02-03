@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Uploaded Signals</h3>
            <div class="text-muted">Manage results, proof images, and signal status</div>
        </div>

        <span class="badge bg-light text-dark border px-3 py-2">
            Total: {{ $signals->count() }}
        </span>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-3 p-md-4">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Pair</th>
                            <th>Type</th>
                            <th>Levels</th>
                            <th>Before</th>
                            <th>After</th>
                            <th>Status</th>
                            <th style="min-width: 300px;">Update</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($signals as $signal)

                            @php
                                // ✅ Support both formats:
                                // New: image = "uploads/abc.png"
                                // Old: image = "abc.png"
                                $beforePath = $signal->image ? (str_starts_with($signal->image, 'uploads/') ? $signal->image : 'uploads/'.$signal->image) : null;
                                $afterPath  = $signal->after_image ? (str_starts_with($signal->after_image, 'uploads/') ? $signal->after_image : 'uploads/'.$signal->after_image) : null;

                                $beforeUrl = $beforePath ? asset('storage/'.$beforePath) : null;
                                $afterUrl  = $afterPath ? asset('storage/'.$afterPath) : null;
                            @endphp

                            <tr>
                                {{-- ID --}}
                                <td class="text-muted">{{ $signal->id }}</td>

                                {{-- Pair --}}
                                <td class="fw-semibold">{{ $signal->pair_name }}</td>

                                {{-- Type --}}
                                <td>
                                    <span class="badge {{ $signal->signal_type === 'buy' ? 'bg-success' : 'bg-danger' }} text-uppercase">
                                        {{ $signal->signal_type }}
                                    </span>
                                </td>

                                {{-- TP / Entry --}}
                                <td class="small">
                                    @if($signal->tp1)
                                        <div><strong>TP1:</strong> {{ $signal->tp1 }}</div>
                                    @endif
                                    @if($signal->tp2)
                                        <div><strong>TP2:</strong> {{ $signal->tp2 }}</div>
                                    @endif
                                    @if($signal->entry_criteria)
                                        <div class="text-muted">
                                            <strong>Entry:</strong> {{ $signal->entry_criteria }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Before Image --}}
                                <td>
                                    @if($beforeUrl)
                                        <a href="{{ $beforeUrl }}" target="_blank">
                                            <img
                                                src="{{ $beforeUrl }}"
                                                class="rounded border"
                                                style="width:70px;height:45px;object-fit:cover;"
                                                alt="Before Image"
                                            >
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                {{-- After Image --}}
                                <td>
                                    @if($afterUrl)
                                        <a href="{{ $afterUrl }}" target="_blank">
                                            <img
                                                src="{{ $afterUrl }}"
                                                class="rounded border"
                                                style="width:70px;height:45px;object-fit:cover;"
                                                alt="After Image"
                                            >
                                        </a>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td>
                                    <span class="badge
                                        @if($signal->result_status === 'pending') bg-warning
                                        @elseif($signal->result_status === 'tp_hit') bg-success
                                        @elseif($signal->result_status === 'sl_hit') bg-danger
                                        @elseif($signal->result_status === 'entry_not_met') bg-info
                                        @else bg-secondary
                                        @endif
                                    ">
                                        {{ strtoupper(str_replace('_',' ', $signal->result_status)) }}
                                    </span>
                                </td>

                                {{-- Update Form --}}
                                <td>
                                    <form
                                        action="{{ route('admin.signals.edit', $signal->id) }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                        class="d-flex flex-column gap-2"
                                    >
                                        @csrf

                                        <select name="result_status" class="form-select form-select-sm" required>
                                            <option value="pending" {{ $signal->result_status=='pending'?'selected':'' }}>Pending</option>
                                            <option value="tp_hit" {{ $signal->result_status=='tp_hit'?'selected':'' }}>TP Hit</option>
                                            <option value="sl_hit" {{ $signal->result_status=='sl_hit'?'selected':'' }}>SL Hit</option>
                                            <option value="entry_not_met" {{ $signal->result_status=='entry_not_met'?'selected':'' }}>Entry Criteria Not Met</option>
                                        </select>

                                        <input
                                            type="file"
                                            name="after_image"
                                            class="form-control form-control-sm"
                                            accept="image/*"
                                        >

                                        <button class="btn btn-primary btn-sm">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No signals found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection
