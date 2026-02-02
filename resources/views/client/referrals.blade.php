
@extends('client.client_layouts.portal')

@section('content')
<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('about')}}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('services')}}">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://wa.me/447538005864">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <div class="container">
    <h1>Referral Dashboard</h1>

    <div class="wallet-section">
        <h3>Wallet Balance: ${{ number_format($wallet->balance, 2) }}</h3>
    </div>

    <h2>Your Referrals</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Referral Name</th>
                <th>Email</th>
                <th>Product Purchased</th>
                <th>Amount</th>
                <th>Purchase Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($referrals as $referral)
                @php
                    // Get all purchases made by the referral
                    $purchases = $referralPurchases->where('user_id', $referral->id);
                @endphp
                @if($purchases->isEmpty())
                    <tr>
                        <td>{{ $referral->name }}</td>
                        <td>{{ $referral->email }}</td>
                        <td colspan="3">No purchases made</td>
                    </tr>
                @else
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $referral->name }}</td>
                            <td>{{ $referral->email }}</td>
                            <td>{{ $purchase->product_type }}</td>
                            <td>${{ number_format($purchase->amount, 2) }}</td>
                            <td>{{ $purchase->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
</div>



</div>
@endsection

