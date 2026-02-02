@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Purchase Requests</h3>
            <div class="text-muted">
                Review and manage incoming purchase payments
            </div>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light text-dark border px-3 py-2">
                Total: {{ $purchaseRequests->count() }}
            </span>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-3 p-md-4">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Transaction</th>
                            <th>Proof</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($purchaseRequests as $request)
                            <tr>
                                <td class="text-muted">{{ $loop->iteration }}</td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $request->user->name ?? 'N/A' }}
                                    </div>
                                    <div class="small text-muted">
                                        ID: {{ $request->user_id }}
                                    </div>
                                </td>

                                <td class="fw-semibold">
                                    {{ ucfirst($request->product_type) }}
                                </td>

                                <td class="fw-semibold">
                                    ${{ number_format($request->amount, 2) }}
                                </td>

                                <td class="text-muted">
                                    {{ $request->transaction_id }}
                                </td>

                                <td>
                                    <a href="{{ asset('storage/' . $request->payment_proof) }}"
                                       target="_blank"
                                       class="btn btn-outline-primary btn-sm">
                                        View
                                    </a>
                                </td>

                                <td>
                                    @if($request->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($request->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($request->status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    @if($request->status === 'pending')
                                        <form action="{{ route('admin.purchase.update', $request->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button class="btn btn-success btn-sm">
                                                Accept
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.purchase.update', $request->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button class="btn btn-outline-danger btn-sm">
                                                Reject
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-outline-secondary btn-sm" disabled>
                                            {{ ucfirst($request->status) }}
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No purchase requests found.
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