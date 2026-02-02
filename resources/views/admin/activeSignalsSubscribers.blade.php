@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Active Signals Subscribers</h3>
            <p class="text-muted mb-0">
                Clients with currently active Signals subscriptions
            </p>
        </div>

        <span class="badge bg-success px-3 py-2">
            Active: {{ $subscribers->count() }}
        </span>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Email</th>
                            <th>Subscription Started</th>
                            <th>Expires At</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($subscribers as $subscriber)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td class="fw-semibold">
                                    {{ $subscriber->user->name ?? 'N/A' }}
                                </td>

                                <td class="text-muted">
                                    {{ $subscriber->user->email ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $subscriber->created_at->format('M d, Y') }}
                                </td>

                                <td>
                                    <span class="text-success fw-semibold">
                                        {{ $subscriber->expires_at->format('M d, Y') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    No active Signals subscribers found.
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