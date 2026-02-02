@extends('admin.admin_layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-3">Bot Requests</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
@if($errors->any())
    <div class="alert alert-danger">
        <strong>Fix these errors:</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Quote</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $r)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $r->user->name ?? 'N/A' }}</div>
                                <div class="text-muted small">{{ $r->user->email ?? '' }}</div>
                            </td>
                            <td class="small">
                                <div><strong>{{ $r->bot_type }}</strong> • {{ $r->platform }} • {{ $r->market }}</div>
                                <div class="text-muted">{{ Str::limit($r->strategy_notes, 80) }}</div>
                            </td>
                            <td><span class="badge bg-secondary">{{ strtoupper($r->status) }}</span></td>
                            <td>
                                @if($r->quoted_amount)
                                    ${{ number_format($r->quoted_amount, 2) }}
                                @else
                                    —
                                @endif
                            </td>
                            <td style="min-width:320px;">
                                {{-- send quote --}}
                              <form method="POST" action="{{ route('admin.bot_requests.quote', $r->id) }}" class="mb-2">
    @csrf
    <div class="row g-2">
        <div class="col-4">
            <input type="number"
                   step="0.01"
                   min="1"
                   name="quoted_amount"
                   class="form-control form-control-sm"
                   placeholder="Quote $"
                   value="{{ old('quoted_amount', $r->quoted_amount) }}">
        </div>

        <div class="col-8">
            <input type="text"
                   name="quote_message"
                   class="form-control form-control-sm"
                   placeholder="Quote message (short)"
                   value="{{ old('quote_message', $r->quote_message) }}">
        </div>

        <div class="col-12">
            <button class="btn btn-primary btn-sm w-100">Send Quote</button>
        </div>
    </div>
</form>


                                {{-- set status --}}
                                <form method="POST" action="{{ route('admin.bot_requests.status', $r->id) }}">
                                    @csrf
                                    <div class="input-group input-group-sm">
                                        <select name="status" class="form-select">
                                            @foreach(['new','quoted','accepted','rejected','in_progress','delivered'] as $st)
                                                <option value="{{ $st }}" @selected($r->status === $st)>
                                                    {{ strtoupper($st) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-outline-secondary">Update</button>
                                    </div>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
