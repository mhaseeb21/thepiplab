@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Admin Dashboard</h3>
            <div class="text-muted">
                Welcome back, <span class="fw-semibold">{{ Auth::guard('admin')->user()->name }}</span>
            </div>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light text-dark border px-3 py-2">
                Administrator
            </span>
        </div>
    </div>

    {{-- Top Stats Cards --}}
    <div class="row g-4 mb-4">

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Total Users</div>
                    <div class="fs-4 fw-bold">{{ $stats['users'] ?? '—' }}</div>
                    <div class="small text-muted mt-2">
                        Verified: <span class="fw-semibold">{{ $stats['verified_users'] ?? '—' }}</span>
                        · Partners: <span class="fw-semibold">{{ $stats['partners'] ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Signals Subscribers (Active)</div>
                    <div class="fs-4 fw-bold">{{ $stats['active_signals_subscribers'] ?? '—' }}</div>
                    <div class="small mt-2">
                        <span class="text-warning fw-semibold">
                            Expiring ≤3 days: {{ $stats['signals_expiring_soon'] ?? '—' }}
                        </span>
                        <span class="text-muted"> · Expired: {{ $stats['signals_expired'] ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Manual Purchases (Course/Bot)</div>
                    <div class="fs-4 fw-bold">{{ $stats['manual_purchases_total'] ?? '—' }}</div>
                    <div class="small mt-2">
                        Pending: <span class="fw-semibold text-warning">{{ $stats['manual_purchases_pending'] ?? '—' }}</span>
                        · Approved: <span class="fw-semibold text-success">{{ $stats['manual_purchases_approved'] ?? '—' }}</span>
                        · Rejected: <span class="fw-semibold text-danger">{{ $stats['manual_purchases_rejected'] ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Pending Withdrawals</div>
                    <div class="fs-4 fw-bold text-warning">{{ $stats['pending_withdrawals'] ?? '—' }}</div>
                    <div class="small text-muted mt-2">
                        Total pending amount:
                        <span class="fw-semibold">${{ number_format($stats['pending_withdrawals_amount'] ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Second Row: Operational Boxes --}}
    <div class="row g-4 mb-4">

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Signals Content</h5>
                        <a href="{{ route('admin.signals.show') }}" class="btn btn-outline-primary btn-sm">
                            Manage Signals
                        </a>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-sm-4">
                            <div class="p-3 border rounded">
                                <div class="text-muted small">Total Signals</div>
                                <div class="fs-5 fw-bold">{{ $stats['signals'] ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="p-3 border rounded">
                                <div class="text-muted small">Pending</div>
                                <div class="fs-5 fw-bold text-warning">{{ $stats['signals_pending'] ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="p-3 border rounded">
                                <div class="text-muted small">Completed</div>
                                <div class="fs-5 fw-bold text-success">{{ $stats['signals_completed'] ?? '—' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-muted small mt-3">
                        Pending = result_status “pending”. Completed = all other statuses.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Affiliate / Partnership Inquiries</h5>
                        <a href="{{ route('admin.affiliate.inquiries') }}" class="btn btn-outline-primary btn-sm">
                            View Inquiries
                        </a>
                    </div>

                    <div class="row g-3">
                        <div class="col-12 col-sm-4">
                            <div class="p-3 border rounded">
                                <div class="text-muted small">Total</div>
                                <div class="fs-5 fw-bold">{{ $stats['affiliate_inquiries_total'] ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="p-3 border rounded">
                                <div class="text-muted small">Uncontacted</div>
                                <div class="fs-5 fw-bold text-warning">{{ $stats['affiliate_inquiries_uncontacted'] ?? '—' }}</div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="p-3 border rounded">
                                <div class="text-muted small">Contacted</div>
                                <div class="fs-5 fw-bold text-success">{{ $stats['affiliate_inquiries_contacted'] ?? '—' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-muted small mt-3">
                        These are public leads (manual follow-up). No auto partner creation.
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent Activity --}}
    <div class="row g-4">

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Recent Manual Purchases</h6>
                        <a href="{{ route('admin.purchaseRequest') }}" class="btn btn-outline-secondary btn-sm">
                            Open
                        </a>
                    </div>

                    @if(isset($recentManualPurchases) && $recentManualPurchases->count())
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentManualPurchases as $p)
                                        <tr>
                                            <td class="small">
                                                {{ $p->user->name ?? 'N/A' }}
                                            </td>
                                            <td class="small">{{ strtoupper($p->product_type) }}</td>
                                            <td class="small">
                                                @if($p->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($p->status === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($p->status === 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($p->status) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-muted small">No recent purchases.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Recent Withdraw Requests</h6>
                        <a href="{{ route('admin.withdraw.requests') }}" class="btn btn-outline-secondary btn-sm">
                            Open
                        </a>
                    </div>

                    @if(isset($recentWithdrawals) && $recentWithdrawals->count())
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentWithdrawals as $w)
                                        <tr>
                                            <td class="small">${{ number_format($w->amount, 2) }}</td>
                                            <td class="small">
                                                @if($w->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($w->status === 'approved')
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif($w->status === 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($w->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="small text-muted">
                                                {{ $w->created_at?->format('M d') ?? '—' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-muted small">No recent withdrawals.</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Recent Inquiries</h6>
                        <a href="{{ route('admin.affiliate.inquiries') }}" class="btn btn-outline-secondary btn-sm">
                            Open
                        </a>
                    </div>

                    @if(isset($recentInquiries) && $recentInquiries->count())
                        <div class="table-responsive">
                            <table class="table table-sm align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Contacted</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentInquiries as $i)
                                        <tr>
                                            <td class="small fw-semibold">{{ $i->name }}</td>
                                            <td class="small">
                                                @if($i->is_contacted)
                                                    <span class="badge bg-success">Yes</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">No</span>
                                                @endif
                                            </td>
                                            <td class="small text-muted">{{ $i->created_at?->format('M d') ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-muted small">No recent inquiries.</div>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
