@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-4 py-lg-5">
        <!-- Header -->
        <div class="text-center mb-4 mb-lg-5">
            <h5 class="fw-bold text-primary text-uppercase mb-2">Live Market</h5>
            <h1 class="mb-2">Live Prices & Forex Heatmap</h1>
            <p class="text-muted mb-0">Track indices, futures, bonds, and FX strength in real-time.</p>
        </div>

        <!-- Grid -->
        <div class="row g-4 align-items-stretch">
            <!-- Market Quotes -->
            <div class="col-12 col-lg-7 d-flex">
                <div class="card shadow-sm border-0 w-100 h-100">
                    <div class="card-body p-3 p-lg-4 d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="mb-0">Market Quotes</h4>
                            <span class="badge bg-primary-subtle text-primary">Live</span>
                        </div>

                        <div class="flex-grow-1">
                            <div class="tradingview-widget-container w-100">
                                <div class="tradingview-widget-container__widget"></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-quotes.js" async>
                                {
                                  "width": "100%",
                                  "height": 520,
                                  "symbolsGroups": [
                                    {
                                      "name": "Indices",
                                      "originalName": "Indices",
                                      "symbols": [
                                        { "name": "FOREXCOM:SPXUSD", "displayName": "S&P 500 Index" },
                                        { "name": "FOREXCOM:NSXUSD", "displayName": "US 100 Cash CFD" },
                                        { "name": "FOREXCOM:DJI", "displayName": "Dow Jones Industrial Average Index" },
                                        { "name": "INDEX:NKY", "displayName": "Nikkei 225" },
                                        { "name": "INDEX:DEU40", "displayName": "DAX Index" },
                                        { "name": "FOREXCOM:UKXGBP", "displayName": "FTSE 100 Index" }
                                      ]
                                    },
                                    {
                                      "name": "Futures",
                                      "originalName": "Futures",
                                      "symbols": [
                                        { "name": "CME_MINI:ES1!", "displayName": "S&P 500" },
                                        { "name": "CME:6E1!", "displayName": "Euro" },
                                        { "name": "COMEX:GC1!", "displayName": "Gold" },
                                        { "name": "NYMEX:CL1!", "displayName": "WTI Crude Oil" },
                                        { "name": "NYMEX:NG1!", "displayName": "Gas" },
                                        { "name": "CBOT:ZC1!", "displayName": "Corn" }
                                      ]
                                    },
                                    {
                                      "name": "Bonds",
                                      "originalName": "Bonds",
                                      "symbols": [
                                        { "name": "CBOT:ZB1!", "displayName": "T-Bond" },
                                        { "name": "CBOT:UB1!", "displayName": "Ultra T-Bond" },
                                        { "name": "EUREX:FGBL1!", "displayName": "Euro Bund" },
                                        { "name": "EUREX:FBTP1!", "displayName": "Euro BTP" },
                                        { "name": "EUREX:FGBM1!", "displayName": "Euro BOBL" }
                                      ]
                                    },
                                    {
                                      "name": "Forex",
                                      "originalName": "Forex",
                                      "symbols": [
                                        { "name": "FX:EURUSD", "displayName": "EUR to USD" },
                                        { "name": "FX:GBPUSD", "displayName": "GBP to USD" },
                                        { "name": "FX:USDJPY", "displayName": "USD to JPY" },
                                        { "name": "FX:USDCHF", "displayName": "USD to CHF" },
                                        { "name": "FX:AUDUSD", "displayName": "AUD to USD" },
                                        { "name": "FX:USDCAD", "displayName": "USD to CAD" }
                                      ]
                                    }
                                  ],
                                  "showSymbolLogo": true,
                                  "isTransparent": false,
                                  "colorTheme": "light",
                                  "locale": "en",
                                  "backgroundColor": "#ffffff"
                                }
                                </script>
                            </div>
                        </div>

                        <div class="mt-3 text-muted small">
                            Data by TradingView
                        </div>
                    </div>
                </div>
            </div>

            <!-- Heatmap -->
            <div class="col-12 col-lg-5 d-flex">
                <div class="card shadow-sm border-0 w-100 h-100">
                    <div class="card-body p-3 p-lg-4 d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h4 class="mb-0">Forex Heatmap</h4>
                            <span class="badge bg-primary-subtle text-primary">Live</span>
                        </div>

                        <div class="flex-grow-1">
                            <div class="tradingview-widget-container w-100">
                                <div class="tradingview-widget-container__widget"></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-heat-map.js" async>
                                {
                                  "width": "100%",
                                  "height": 520,
                                  "currencies": ["EUR","USD","JPY","GBP","CHF","AUD","CAD","NZD","CNY"],
                                  "isTransparent": false,
                                  "colorTheme": "light",
                                  "locale": "en",
                                  "backgroundColor": "#ffffff"
                                }
                                </script>
                            </div>
                        </div>

                        <div class="mt-3 text-muted small">
                            Currency strength overview
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- row -->
    </div>
</div>

{{-- Small CSS for a premium look --}}
<style>
    .card { border-radius: 16px; }
    .bg-primary-subtle { background: rgba(13,110,253,.1); }
</style>
@endsection