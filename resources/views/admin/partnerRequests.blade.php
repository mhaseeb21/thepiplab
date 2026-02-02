@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Partner Applications</h3>
            <p class="text-muted mb-0">
                Requests from registered users who want to become partners
            </p>
        </div>

        <span class="badge bg-light text-dark border px-3 py-2">
            Total: {{ $requests->count() }}
        </span>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Team Size</th>
                            <th>Experience</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td class="text-muted">{{ $loop->iteration }}</td>

                                <td class="fw-semibold">
                                    {{ $request->user->name ?? 'N/A' }}
                                </td>

                                <td class="text-muted">
                                    {{ $request->user->email ?? 'N/A' }}
                                </td>

                                <td class="text-muted">
                                    {{ $request->team_size }}
                                </td>

                                <td class="text-muted">
                                    {{ ucfirst($request->experience_level) }}
                                </td>

                                {{-- Full message (wrapped, readable) --}}
                                <td style="max-width: 320px;">
                                    <div style="white-space: pre-wrap; word-break: break-word;">
                                        {{ $request->message }}
                                    </div>
                                </td>

                                <td>
                                    @if($request->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($request->status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>

                                <td class="text-muted">
                                    {{ $request->created_at->format('M d, Y') }}
                                </td>

                                <td class="text-end">
                                    @if($request->status === 'pending')
                                        <form action="{{ route('admin.partner.requests.update', $request->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button class="btn btn-success btn-sm">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.partner.requests.update', $request->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button class="btn btn-outline-danger btn-sm">
                                                Reject
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">
                                            Reviewed
                                        </span>

                                        @if($request->reviewed_at)
                                            <div class="small text-muted">
                                                {{ \Carbon\Carbon::parse($request->reviewed_at)->format('M d, Y') }}
                                            </div>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    No partner requests found.
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
