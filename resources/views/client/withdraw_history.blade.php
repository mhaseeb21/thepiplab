@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="mb-4">
        <h3 class="mb-1">Withdrawal History</h3>
        <div class="text-muted">Track the status of your withdrawal requests</div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-3 p-md-4">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Requested On</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($withdrawals as $withdrawal)
                            <tr>
                                <td class="fw-semibold">
                                    ${{ number_format($withdrawal->amount, 2) }}
                                </td>

                                <td>
                                    @if($withdrawal->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($withdrawal->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($withdrawal->status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($withdrawal->status) }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-muted">
                                    {{ $withdrawal->created_at->format('Y-m-d H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
                                    No withdrawal requests found.
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