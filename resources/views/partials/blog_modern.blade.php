<!-- Live Forex Prices Start (Modern) -->
<section class="tpl-livefx" id="live-forex">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            {{-- Section Head --}}
            <div class="tpl-sectionhead tpl-sectionhead--center mb-4 mb-lg-5">
                <span class="tpl-kicker">
                    <i class="bi bi-activity"></i>
                    Live Forex Prices
                </span>
                <h2 class="tpl-h2 mb-2">Track Real-Time Forex Rates for Key Currency Pairs</h2>
                <p class="tpl-lead mb-0">
                    Clean, fast quotes — updated live from TradingView.
                </p>
            </div>

            <div class="row g-3 g-md-4">
                {{-- EURUSD --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-quote-card h-100">
                        <div class="tpl-quote-head">
                            <div class="tpl-quote-ic"><i class="bi bi-currency-exchange"></i></div>
                            <div>
                                <div class="tpl-quote-pair">EUR / USD</div>
                                <div class="tpl-quote-sub">Euro vs US Dollar</div>
                            </div>
                            <span class="tpl-quote-pill">Live</span>
                        </div>

                        <div class="tpl-quote-body">
                            <div class="tradingview-widget-container tpl-tv-wrap">
                                <div class="tradingview-widget-container__widget"></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                {
                                    "symbol": "FX:EURUSD",
                                    "width": "100%",
                                    "isTransparent": true,
                                    "colorTheme": "light",
                                    "locale": "en"
                                }
                                </script>
                            </div>
                        </div>

                        <div class="tpl-quote-foot">
                            <i class="bi bi-info-circle"></i>
                            Powered by TradingView
                        </div>
                        <div class="tpl-quote-glow"></div>
                    </div>
                </div>

                {{-- GBPUSD --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-quote-card h-100">
                        <div class="tpl-quote-head">
                            <div class="tpl-quote-ic"><i class="bi bi-currency-exchange"></i></div>
                            <div>
                                <div class="tpl-quote-pair">GBP / USD</div>
                                <div class="tpl-quote-sub">British Pound vs US Dollar</div>
                            </div>
                            <span class="tpl-quote-pill">Live</span>
                        </div>

                        <div class="tpl-quote-body">
                            <div class="tradingview-widget-container tpl-tv-wrap">
                                <div class="tradingview-widget-container__widget"></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                {
                                    "symbol": "FX:GBPUSD",
                                    "width": "100%",
                                    "isTransparent": true,
                                    "colorTheme": "light",
                                    "locale": "en"
                                }
                                </script>
                            </div>
                        </div>

                        <div class="tpl-quote-foot">
                            <i class="bi bi-info-circle"></i>
                            Powered by TradingView
                        </div>
                        <div class="tpl-quote-glow"></div>
                    </div>
                </div>

                {{-- USDJPY --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-quote-card h-100">
                        <div class="tpl-quote-head">
                            <div class="tpl-quote-ic"><i class="bi bi-currency-exchange"></i></div>
                            <div>
                                <div class="tpl-quote-pair">USD / JPY</div>
                                <div class="tpl-quote-sub">US Dollar vs Japanese Yen</div>
                            </div>
                            <span class="tpl-quote-pill">Live</span>
                        </div>

                        <div class="tpl-quote-body">
                            <div class="tradingview-widget-container tpl-tv-wrap">
                                <div class="tradingview-widget-container__widget"></div>
                                <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-single-quote.js" async>
                                {
                                    "symbol": "FX:USDJPY",
                                    "width": "100%",
                                    "isTransparent": true,
                                    "colorTheme": "light",
                                    "locale": "en"
                                }
                                </script>
                            </div>
                        </div>

                        <div class="tpl-quote-foot">
                            <i class="bi bi-info-circle"></i>
                            Powered by TradingView
                        </div>
                        <div class="tpl-quote-glow"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Live Forex Prices End -->

@once
<style>
    /* Section */
    .tpl-livefx{
        background:
            radial-gradient(900px 520px at 12% 10%, rgba(57,213,255,.10), transparent 60%),
            radial-gradient(900px 620px at 90% 25%, rgba(6,163,218,.08), transparent 60%),
            #fff;
        border-top: 1px solid rgba(2,6,23,.06);
        border-bottom: 1px solid rgba(2,6,23,.06);
    }

    /* Quote card */
    .tpl-quote-card{
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        border: 1px solid rgba(2,6,23,.08);
        background: rgba(255,255,255,.92);
        box-shadow: 0 18px 55px rgba(2,6,23,.10);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        height: 100%;
    }

    .tpl-quote-card:hover{
        transform: translateY(-4px);
        border-color: rgba(57,213,255,.55);
        box-shadow: 0 30px 85px rgba(2,6,23,.14);
    }

    .tpl-quote-head{
        display:flex;
        align-items:center;
        gap: 12px;
        padding: 16px 16px 12px;
    }

    .tpl-quote-ic{
        width: 44px;
        height: 44px;
        border-radius: 16px;
        display:flex;
        align-items:center;
        justify-content:center;
        background: rgba(57,213,255,.16);
        border: 1px solid rgba(6,163,218,.18);
        color: var(--tpl-primary);
        font-size: 1.15rem;
        flex: 0 0 auto;
    }

    .tpl-quote-pair{
        font-weight: 950;
        color: rgba(11,18,32,.92);
        letter-spacing: -.01em;
        line-height: 1.1;
        font-size: 1.05rem;
    }

    .tpl-quote-sub{
        font-weight: 800;
        color: rgba(11,18,32,.55);
        font-size: .85rem;
        margin-top: 2px;
    }

    .tpl-quote-pill{
        margin-left: auto;
        display:inline-flex;
        align-items:center;
        gap: 6px;
        padding: .35rem .65rem;
        border-radius: 999px;
        font-weight: 950;
        font-size: .72rem;
        letter-spacing: .25px;

        color: var(--tpl-primary);
        background: rgba(6,163,218,.10);
        border: 1px solid rgba(6,163,218,.18);
        white-space: nowrap;
    }

    .tpl-quote-body{
        padding: 0 16px 12px;
    }

    /* TradingView wrapper */
    .tpl-tv-wrap{
        border-radius: 18px;
        border: 1px solid rgba(2,6,23,.06);
        background: rgba(255,255,255,.75);
        padding: 10px;
        overflow: hidden;
        min-height: 118px;
    }

    .tpl-quote-foot{
        padding: 10px 16px 14px;
        color: rgba(11,18,32,.55);
        font-weight: 800;
        font-size: .85rem;
        display:flex;
        align-items:center;
        gap: 8px;
        border-top: 1px solid rgba(2,6,23,.06);
    }

    .tpl-quote-glow{
        position:absolute;
        right:-70px;
        top:-70px;
        width:200px;
        height:200px;
        border-radius:50%;
        background: radial-gradient(circle at 30% 30%, rgba(57,213,255,.28), transparent 65%);
        opacity:.6;
        pointer-events:none;
    }

    /* Mobile */
    @media (max-width: 575.98px){
        .tpl-quote-head{ padding: 14px 14px 10px; }
        .tpl-quote-body{ padding: 0 14px 10px; }
        .tpl-quote-foot{ padding: 10px 14px 12px; }
        .tpl-quote-card{ border-radius: 20px; }
        .tpl-tv-wrap{ border-radius: 16px; }
    }

    @media (prefers-reduced-motion: reduce){
        .tpl-quote-card{ transition: none; }
        .tpl-quote-card:hover{ transform: none; }
    }
</style>
@endonce
