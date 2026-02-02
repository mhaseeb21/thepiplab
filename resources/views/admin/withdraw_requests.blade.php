@extends('admin.admin_layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Pending Withdrawal Requests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Amount</th>
                <th>Withdraw Type</th>
                <th>Withdraw Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($withdrawRequests as $request)
                <tr>
                    <td>{{ $request->user_id }}</td>
                    <td>${{ number_format($request->amount, 2) }}</td>
                    <td>{{ strtoupper($request->withdraw_type) }}</td>
                    <td>{{ $request->withdraw_address }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>
                        <form action="{{ route('admin.withdraw.approve', $request->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('admin.withdraw.reject', $request->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
