<!-- Pricing Start (Futuristic / White - NO GRADIENTS, NO BLACK) -->
<section class="tpl-pricing tpl-pricing--neo2" id="pricing">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            {{-- Section Head --}}
            <div class="tpl-sectionhead tpl-sectionhead--center mb-4 mb-lg-5">
                <span class="tpl-kicker">
                    <i class="bi bi-cash-stack"></i>
                    Pricing Plans
                </span>
                <h2 class="tpl-h2 mb-2">Competitive Pricing Tailored to Your Needs</h2>
                <p class="tpl-lead mb-0">
                    Choose a plan that aligns with your trading goals and experience.
                </p>
            </div>

            <div class="row g-3 g-md-4 align-items-stretch">

                {{-- Daily Market Updates --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-price-card tpl-price-card--neo2 h-100">

                        <div class="tpl-price-head">
                            <div class="tpl-price-headline">
                                <span class="tpl-led" aria-hidden="true"></span>
                                <span class="tpl-price-chip">
                                    <i class="bi bi-broadcast"></i> Live Updates
                                </span>
                            </div>

                            <h5 class="tpl-price-title mt-3">Daily Market Updates</h5>
                            <p class="tpl-price-sub mb-0">Forex, Crypto & Commodities</p>
                        </div>

                        <div class="tpl-price-body">
                            <div class="tpl-price-amount">
                                <span class="tpl-currency">$</span>15
                                <span class="tpl-duration">/ month</span>
                            </div>

                            <div class="tpl-price-badges">
                                <span class="tpl-badge tpl-badge-danger">Limited Time</span>
                                <span class="tpl-badge tpl-badge-success">50% OFF</span>
                                <span class="tpl-old-price">$30</span>
                            </div>

                            <ul class="tpl-price-list">
                                <li><i class="bi bi-check-circle-fill"></i> 10+ Daily Market Updates</li>
                                <li><i class="bi bi-check-circle-fill"></i> Forex, Crypto & Commodities</li>
                                <li><i class="bi bi-check-circle-fill"></i> Real-time Alerts</li>
                            </ul>

                            <a href="{{ route('client.register') }}" class="btn tpl-price-btn w-100">
                                Get Premium Access <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>

                    </div>
                </div>

                {{-- Educational Program (Featured) --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-price-card tpl-price-card--neo2 tpl-price-card--featured2 h-100">
                        <div class="tpl-price-ribbon2">Most Popular</div>

                        <div class="tpl-price-head">
                            <div class="tpl-price-headline">
                                <span class="tpl-led tpl-led--accent" aria-hidden="true"></span>
                                <span class="tpl-price-chip tpl-price-chip--featured">
                                    <i class="bi bi-mortarboard-fill"></i> Education
                                </span>
                            </div>

                            <h5 class="tpl-price-title mt-3">Educational Program</h5>
                            <p class="tpl-price-sub mb-0">Comprehensive Trading Education</p>
                        </div>

                        <div class="tpl-price-body">
                            <div class="tpl-price-amount">
                                <span class="tpl-currency">$</span>200
                            </div>

                            <ul class="tpl-price-list">
                                <li><i class="bi bi-check-circle-fill"></i> Technical Analysis</li>
                                <li><i class="bi bi-check-circle-fill"></i> Fundamental Analysis</li>
                                <li><i class="bi bi-check-circle-fill"></i> Psychological Training</li>
                            </ul>

                            <a href="{{ route('client.register') }}" class="btn tpl-price-btn w-100">
                                Enroll Now <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>

                    </div>
                </div>

                {{-- Custom Bot Development --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-price-card tpl-price-card--neo2 h-100">

                        <div class="tpl-price-head">
                            <div class="tpl-price-headline">
                                <span class="tpl-led" aria-hidden="true"></span>
                                <span class="tpl-price-chip">
                                    <i class="bi bi-cpu-fill"></i> Automation
                                </span>
                            </div>

                            <h5 class="tpl-price-title mt-3">Custom Bot Development</h5>
                            <p class="tpl-price-sub mb-0">Automate Your Strategy</p>
                        </div>

                        <div class="tpl-price-body">
                            <div class="tpl-price-amount">
                                Price depends on strategy complexity & features
                            </div>

                            <ul class="tpl-price-list">
                                <li><i class="bi bi-check-circle-fill"></i> Custom Trading Bot</li>
                                <li><i class="bi bi-check-circle-fill"></i> Built to Your Strategy</li>
                                <li><i class="bi bi-check-circle-fill"></i> Expert Support</li>
                            </ul>

                            <a href="{{ route('client.register') }}" class="btn tpl-price-btn w-100">
                                Get Started <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Pricing End -->

@once
<style>
    /* ===== PRICING (NEO2) - NO GRADIENTS, NO BLACK ===== */
    .tpl-pricing--neo2{
        background:#fff;
        border-top: 1px solid rgba(2,6,23,.06);
        border-bottom: 1px solid rgba(2,6,23,.06);
    }

    /* Card base */
    .tpl-price-card--neo2{
        position: relative;
        display:flex;
        flex-direction:column;
        height:100%;

        padding: 22px;
        border-radius: 24px;

        background:#fff;
        border: 1px solid rgba(2,6,23,.10);
        box-shadow: 0 18px 55px rgba(2,6,23,.08);
        overflow:hidden;

        transition: transform .20s ease, box-shadow .20s ease, border-color .20s ease;
    }

    /* Futuristic grid (solid lines) */
    .tpl-price-card--neo2::before{
        content:"";
        position:absolute;
        inset:0;
        background:
            repeating-linear-gradient(
                to bottom,
                rgba(6,163,218,.06) 0,
                rgba(6,163,218,.06) 1px,
                transparent 1px,
                transparent 18px
            ),
            repeating-linear-gradient(
                to right,
                rgba(57,213,255,.05) 0,
                rgba(57,213,255,.05) 1px,
                transparent 1px,
                transparent 22px
            );
        opacity:.55;
        pointer-events:none;
    }

    /* Topline (solid) */
    .tpl-price-card--neo2::after{
        content:"";
        position:absolute;
        top:0; left:0; right:0;
        height: 3px;
        background: #0b1220;
        pointer-events:none;
    }

    /* Hover sweep (solid tint) */
    .tpl-price-card--neo2 .tpl-sweep{
        display:none;
    }
    .tpl-price-card--neo2:hover{
        transform: translateY(-4px);
        border-color: rgba(57,213,255,.55);
        box-shadow: 0 30px 85px rgba(2,6,23,.14);
    }
    .tpl-price-card--neo2:hover .tpl-price-btn{
        transform: translateY(-2px);
        box-shadow: 0 20px 50px rgba(6,163,218,.22);
    }

    /* Featured */
    .tpl-price-card--featured2{
        border-color: rgba(6,163,218,.28);
        box-shadow: 0 30px 95px rgba(6,163,218,.12);
    }

    .tpl-price-ribbon2{
        position:absolute;
        top: 14px;
        right: 14px;

        padding: .38rem .72rem;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 950;
        letter-spacing: .35px;

        background: rgba(6,163,218,.12); /* solid tint */
        border: 1px solid rgba(6,163,218,.28);
        color: rgba(11,18,32,.92);
        z-index: 3;
        backdrop-filter: blur(6px);
    }

    /* Keep content above grid */
    .tpl-price-head,
    .tpl-price-body{
        position: relative;
        z-index: 2;
    }

    /* Headline row */
    .tpl-price-headline{
        display:flex;
        align-items:center;
        gap: 10px;
    }

    /* LED dot */
    .tpl-led{
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: rgba(25,135,84,.85); /* solid green */
        box-shadow: 0 0 0 6px rgba(25,135,84,.12);
        flex: 0 0 auto;
    }
    .tpl-led--accent{
        background: rgba(57,213,255,.85);
        box-shadow: 0 0 0 6px rgba(57,213,255,.14);
    }

    /* Chip */
    .tpl-price-chip{
        display:inline-flex;
        align-items:center;
        gap: 8px;

        padding: 8px 12px;
        border-radius: 999px;

        font-weight: 900;
        font-size: .82rem;
        letter-spacing: .25px;

        background: rgba(6,163,218,.07);
        border: 1px solid rgba(6,163,218,.16);
        color: rgba(11,18,32,.90);
    }
    .tpl-price-chip i{ color: var(--tpl-primary); }
    .tpl-price-chip--featured{
        background: rgba(57,213,255,.09);
        border-color: rgba(57,213,255,.22);
    }

    /* Titles */
    .tpl-price-title{
        font-weight: 950;
        color:#0b1220;
        letter-spacing: -.01em;
        margin-bottom: 2px;
    }
    .tpl-price-sub{
        font-size: .92rem;
        font-weight: 750;
        color: rgba(11,18,32,.58);
    }

    /* Body */
    .tpl-price-body{
        margin-top: 18px;
        display:flex;
        flex-direction:column;
        gap: 16px;
        flex-grow: 1;
    }

    .tpl-price-amount{
        font-weight: 975;
        font-size: 2.25rem;
        color:#0b1220;
        letter-spacing: -.03em;
    }
    .tpl-currency{ font-size: .75em; margin-right: 2px; }
    .tpl-duration{
        font-size: .55em;
        font-weight: 850;
        color: rgba(11,18,32,.58);
        margin-left: 4px;
    }

    /* Badges */
    .tpl-price-badges{
        display:flex;
        gap: 6px;
        flex-wrap:wrap;
        align-items:center;
    }
    .tpl-badge{
        font-size: .7rem;
        font-weight: 950;
        padding: .32rem .62rem;
        border-radius: 999px;
        letter-spacing: .2px;
        background: rgba(2,6,23,.03);
        border: 1px solid rgba(2,6,23,.08);
        color: rgba(11,18,32,.82);
    }
    .tpl-badge-danger{
        background: rgba(220,53,69,.10);
        border-color: rgba(220,53,69,.30);
        color:#dc3545;
    }
    .tpl-badge-success{
        background: rgba(25,135,84,.10);
        border-color: rgba(25,135,84,.30);
        color:#198754;
    }
    .tpl-old-price{
        font-size: .86rem;
        font-weight: 850;
        color: rgba(11,18,32,.45);
        text-decoration: line-through;
        margin-left: 4px;
    }

    /* List */
    .tpl-price-list{
        list-style:none;
        padding:0;
        margin:0;
    }
    .tpl-price-list li{
        display:flex;
        align-items:center;
        gap: 8px;
        font-weight: 850;
        font-size: .94rem;
        color: rgba(11,18,32,.75);
        margin-bottom: 8px;
    }
    .tpl-price-list i{ color: var(--tpl-primary); }

    /* Button (solid) */
/* ===== FIXED FUTURISTIC BUTTON (BLACK → BLUE HOVER) ===== */
.tpl-price-btn{
    margin-top: auto;
    padding: .85rem 1.1rem;
    border-radius: 999px;

    font-weight: 950;
    font-size: .95rem;

    background: #0b1220;              /* solid black */
    color: #ffffff;                   /* ALWAYS visible */
    border: 1px solid #0b1220;

    box-shadow: 0 14px 30px rgba(11,18,32,.25);
    transition: 
        background-color .18s ease,
        border-color .18s ease,
        box-shadow .18s ease,
        transform .18s ease;
}

.tpl-price-btn:hover{
    background: var(--tpl-primary);   /* solid blue on hover */
    border-color: var(--tpl-primary);
    color: #ffffff;                   /* FORCE white text */
    transform: translateY(-2px);
    box-shadow: 0 20px 45px rgba(6,163,218,.35);
}

.tpl-price-btn:active{
    transform: translateY(0);
    box-shadow: 0 10px 24px rgba(6,163,218,.25);
}


    /* Responsive */
    @media (max-width: 575.98px){
        .tpl-price-card--neo2{
            padding: 18px;
            border-radius: 20px;
        }
    }

    @media (prefers-reduced-motion: reduce){
        .tpl-price-card--neo2,
        .tpl-price-btn{
            transition:none;
        }
        .tpl-price-card--neo2:hover{
            transform:none;
        }
        .tpl-price-card--neo2:hover .tpl-price-btn{
            transform:none;
        }
    }
</style>
@endonce
