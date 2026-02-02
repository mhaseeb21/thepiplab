@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="mb-1 fw-700" style="color:#091E3E;">My Bot Requests</h2>
            <p class="text-muted mb-0">Track your request status and quotes here.</p>
        </div>
        <a href="{{ route('bot.request.create') }}" class="btn btn-primary btn-sm">
            New Request
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @forelse($requests as $r)
                <div class="border rounded p-3 mb-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="fw-semibold">{{ $r->bot_type }} • {{ $r->platform }} • {{ $r->market }}</div>
                            <div class="text-muted small">Status: <strong>{{ strtoupper($r->status) }}</strong></div>
                        </div>
                        <div class="text-muted small">{{ $r->created_at->format('d M Y') }}</div>
                    </div>

                    @if($r->status === 'quoted')
                        <div class="mt-2">
                            <div><strong>Quote:</strong> ${{ number_format($r->quoted_amount, 2) }}</div>
                            <div class="text-muted small">{!! nl2br(e($r->quote_message)) !!}</div>

                            <form method="POST" action="{{ route('bot.request.accept', $r->id) }}" class="mt-2">
                                @csrf
                                <button class="btn btn-success btn-sm">Accept Quote</button>
                            </form>
                        </div>
                    @elseif($r->status === 'accepted')
                        <div class="mt-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('bot.request.payment.form', $r->id) }}">
                                Submit Payment
                            </a>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted mb-0">No bot requests yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
