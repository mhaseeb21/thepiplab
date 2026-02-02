@extends('admin.admin_layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Signals Access (Admin Grants)</h3>
            <div class="text-muted">Search a client and grant complimentary signals access.</div>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Search --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body">
            <form class="row g-2 align-items-center" method="GET" action="{{ route('admin.signals.access') }}">
                <div class="col-12 col-md-8">
                    <input
                        type="text"
                        name="q"
                        class="form-control rounded-3"
                        value="{{ $q }}"
                        placeholder="Search by name, email, or ID..."
                    >
                </div>
                <div class="col-12 col-md-4 d-grid d-md-flex gap-2 justify-content-md-end">
                    <button class="btn btn-primary rounded-3">
                        <i class="fas fa-search me-2"></i>Search
                    </button>
                    <a href="{{ route('admin.signals.access') }}" class="btn btn-outline-secondary rounded-3">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Users Table --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr class="text-muted small">
                            <th style="width:90px;">ID</th>
                            <th>Client</th>
                            <th>Email</th>
                            <th style="width:260px;">Grant Signals</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="fw-semibold">{{ $user->id }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                    <div class="text-muted small">Joined: {{ optional($user->created_at)->format('d M Y') }}</div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.signals.access.grant') }}" class="d-flex gap-2">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <input
                                            type="number"
                                            name="days"
                                            class="form-control form-control-sm rounded-3"
                                            style="max-width: 110px;"
                                            value="30"
                                            min="1"
                                            max="365"
                                            title="Days"
                                        >
                                        <button type="submit" class="btn btn-sm btn-success rounded-3"
                                            onclick="return confirm('Grant signals access to {{ $user->name }} for 30 days (or custom days)?');">
                                            <i class="fas fa-bolt me-1"></i>Grant
                                        </button>
                                    </form>
                                    <div class="text-muted small mt-1">
                                        Extends if already active.
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
