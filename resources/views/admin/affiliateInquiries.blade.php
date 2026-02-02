@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Affiliate / Partnership Inquiries</h3>
            <p class="text-muted mb-0">
                Leads submitted from the public partnership inquiry form
            </p>
        </div>

        <span class="badge bg-light text-dark border px-3 py-2">
            Total: {{ $inquiries->count() }}
        </span>
    </div>

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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Team</th>
                            <th>Message</th>
                            <th>Submitted</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($inquiries as $inquiry)
                            <tr>
                                <td class="text-muted">{{ $loop->iteration }}</td>

                                <td class="fw-semibold">{{ $inquiry->name }}</td>

                                <td class="text-muted">{{ $inquiry->email }}</td>

                                <td class="text-muted">{{ $inquiry->contact_number }}</td>

                                <td class="text-muted">{{ $inquiry->team_members }}</td>

                                {{-- Short preview --}}
                                <td style="max-width: 260px;">
                                    <div class="text-muted text-truncate" style="max-width: 240px;">
                                        {{ \Illuminate\Support\Str::limit($inquiry->description, 80) }}
                                    </div>
                                </td>

                                <td class="text-muted">
                                    {{ $inquiry->created_at?->format('M d, Y') ?? '—' }}
                                </td>

                                <td class="text-end">
                                    <button class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#inquiryModal{{ $inquiry->id }}">
                                        View
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL --}}
                            <div class="modal fade" id="inquiryModal{{ $inquiry->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Partnership Inquiry – {{ $inquiry->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <strong>Email:</strong>
                                                <div>{{ $inquiry->email }}</div>
                                            </div>

                                            <div class="mb-3">
                                                <strong>Contact Number:</strong>
                                                <div>{{ $inquiry->contact_number }}</div>
                                            </div>

                                            <div class="mb-3">
                                                <strong>Team Members:</strong>
                                                <div>{{ $inquiry->team_members }}</div>
                                            </div>

                                            <div class="mb-3">
                                                <strong>Message:</strong>
                                                <div class="border rounded p-3 mt-1"
                                                     style="white-space: pre-wrap; word-break: break-word;">
                                                    {{ $inquiry->description }}
                                                </div>
                                            </div>

                                            <div class="text-muted small">
                                                Submitted on {{ $inquiry->created_at?->format('M d, Y · h:i A') }}
                                            </div>

                                        </div>

                                <div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">
        Close
    </button>

    @if(isset($inquiry->is_contacted) && $inquiry->is_contacted)
        <span class="badge bg-success px-3 py-2">
            Contacted
        </span>

        @if($inquiry->contacted_at)
            <span class="text-muted small">
                {{ \Carbon\Carbon::parse($inquiry->contacted_at)->format('M d, Y') }}
            </span>
        @endif
    @else
        <form action="{{ route('admin.affiliate.inquiries.contacted', $inquiry->id) }}"
              method="POST"
              class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-primary">
                Mark Contacted
            </button>
        </form>
    @endif

    @if(!empty($inquiry->email))
        <a href="mailto:{{ $inquiry->email }}" class="btn btn-primary">
            Contact via Email
        </a>
    @endif
</div>


                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No inquiries yet.
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
