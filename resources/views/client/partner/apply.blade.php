@extends('client.client_layouts.portal')

@section('content')
<div class="container py-5">

    <h3 class="mb-4">Become a Partner</h3>

    @if($existing)
        <div class="alert alert-info">
            Your partner request is currently
            <strong>{{ ucfirst($existing->status) }}</strong>.
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!$existing)
        <form method="POST" action="{{ route('client.partner.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Team Size</label>
                <input type="number" name="team_size" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Experience</label>
                <input type="text" name="experience" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Promotion Method</label>
                <input type="text" name="promotion_method" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Message</label>
                <textarea name="message" rows="4" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">
                Submit Partner Application
            </button>
        </form>
    @endif

</div>
@endsection
