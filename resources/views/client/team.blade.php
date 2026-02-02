@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Referrals</h3>
            <div class="text-muted">
                Referrals for <span class="fw-semibold">{{ $user->name }}</span>
            </div>
        </div>

        <div class="mt-3 mt-md-0">
            <span class="badge bg-light text-dark border">
                Total: {{ $user->referrals->count() }}
            </span>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-3 p-md-4">

            @if($user->referrals->isEmpty())
                <div class="text-center py-4">
                    <div class="text-muted mb-2">No referrals found.</div>
                    <div class="small text-muted">When someone registers using your referral link, they will appear here.</div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->referrals as $referral)
                                <tr>
                                    <td class="fw-semibold">{{ $referral->name }}</td>
                                    <td class="text-muted">{{ $referral->email }}</td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($referral->role) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($referral->ib_status)
                                            <span class="badge bg-success">Partner</span>
                                        @else
                                            <span class="badge bg-light text-dark border">Customer</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection