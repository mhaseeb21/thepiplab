@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    <h2 class="mb-2 fw-700" style="color:#091E3E;">Request a Custom Bot</h2>
    <p class="text-muted">Tell us what you need — we’ll review and send you a quote.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('bot.request.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Bot Type</label>
                        <select name="bot_type" class="form-control" required>
                            <option value="">Select</option>
                            <option value="EA">EA (Auto Trading)</option>
                            <option value="Indicator">Indicator</option>
                            <option value="Strategy Automation">Strategy Automation</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Platform</label>
                        <select name="platform" class="form-control" required>
                            <option value="">Select</option>
                            <option value="MT4">MT4</option>
                            <option value="MT5">MT5</option>
                            <option value="TradingView">TradingView</option>
                            <option value="Binance">Binance</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Market</label>
                        <select name="market" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Forex">Forex</option>
                            <option value="Crypto">Crypto</option>
                            <option value="Commodities">Commodities</option>
                            <option value="Mixed">Mixed</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Risk Profile</label>
                        <select name="risk_profile" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Timeframe (optional)</label>
                        <input name="timeframe" class="form-control" placeholder="e.g., M15 / H1 / H4">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Budget Range (optional)</label>
                        <input name="budget_range" class="form-control" placeholder="e.g., $200-$500">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Contact (WhatsApp/Telegram)</label>
                        <input name="contact" class="form-control" placeholder="+44... / @username">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Strategy Notes</label>
                        <textarea name="strategy_notes" class="form-control" rows="5"
                                  placeholder="Explain what you want the bot to do..."></textarea>
                    </div>
                </div>

                <button class="btn btn-primary mt-3">
                    Submit Request
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
