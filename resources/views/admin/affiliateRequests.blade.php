@extends('admin.admin_layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Affiliate Requests</h3>
            <p class="text-muted mb-0">
                Review applications to become a PipLab partner
            </p>
        </div>

        <span class="badge bg-info px-3 py-2">
            Total Requests: {{ $requests->count() }}
        </span>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Applicant</th>
                            <th>Contact</th>
                            <th>Team Size</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- Applicant --}}
                                <td>
                                    <div class="fw-semibold">{{ $request->name }}</div>
                                    <div class="text-muted small">{{ $request->email }}</div>
                                </td>

                                {{-- Contact --}}
                                <td class="text-muted">
                                    {{ $request->contact_number }}
                                </td>

                                {{-- Team --}}
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $request->team_members }} Members
                                    </span>
                                </td>

                                {{-- Message Preview --}}
                                <td style="max-width: 260px;">
                                    <span class="text-muted">
                                        {{ Str::limit($request->description, 80) }}
                                    </span>

                                    <div class="mt-1">
                                        <button
                                            class="btn btn-link btn-sm p-0 text-decoration-none"
                                            data-bs-toggle="modal"
                                            data-bs-target="#affiliateModal{{ $request->id }}">
                                            Read full message
                                        </button>
                                    </div>
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($request->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($request->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($request->status === 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="text-end">
                                    @if($request->status === 'pending')
                                        <form action="{{ route('admin.affiliate.requests.update', $request->id) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button class="btn btn-success btn-sm">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.affiliate.requests.update', $request->id) }}"
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

                            {{-- 🔹 FULL DETAILS MODAL --}}
                            <div class="modal fade"
                                 id="affiliateModal{{ $request->id }}"
                                 tabindex="-1"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Affiliate Application — {{ $request->name }}
                                            </h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <strong>Name</strong>
                                                    <div>{{ $request->name }}</div>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>Email</strong>
                                                    <div>{{ $request->email }}</div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <strong>Contact Number</strong>
                                                    <div>{{ $request->contact_number }}</div>
                                                </div>

                                                <div class="col-md-6">
                                                    <strong>Team Members</strong>
                                                    <div>{{ $request->team_members }}</div>
                                                </div>
                                            </div>

                                            <hr>

                                            <strong>Full Application Message</strong>
                                            <div class="mt-2 p-3 bg-light rounded"
                                                 style="white-space: pre-line;">
                                                {{ $request->description }}
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary"
                                                    data-bs-dismiss="modal">
                                                Close
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="7"
                                    class="text-center py-4 text-muted">
                                    No affiliate requests found.
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