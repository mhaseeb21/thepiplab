<!-- Service Start (Modern / Dark) -->
<section class="tpl-services tpl-services--dark" id="services">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            {{-- Section Head --}}
            <div class="tpl-sectionhead tpl-sectionhead--center mb-4 mb-lg-5">
                <span class="tpl-kicker tpl-kicker--dark">
                    <i class="bi bi-grid-fill"></i>
                    Our Services
                </span>
                <h2 class="tpl-h2 tpl-h2--dark mb-2" style="color:white">
                    Customized Solutions for Your Trading Success
                </h2>
                <p class="tpl-lead tpl-lead--dark mb-0" style="color:white">
                    Built for clarity, consistency, and a clean client experience across markets.
                </p>
            </div>

            <div class="row g-3 g-md-4 g-lg-4">

                {{-- Service 1 --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-service-card h-100">
                        <div class="tpl-service-top">
                            <div class="tpl-service-ic">
                                <i class="bi bi-broadcast"></i>
                            </div>
                            <span class="tpl-service-pill">Live</span>
                        </div>

                        <h5 class="tpl-service-title mt-3 mb-2">Market Updates</h5>
                        <p class="tpl-service-text mb-4">
                            Get real-time forex, commodities & crypto market updates to help you make informed trading decisions.
                        </p>

                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <span class="tpl-service-meta">Forex • Crypto • Commodities</span>
                      
                        </div>

                        <div class="tpl-service-glow"></div>
                    </div>
                </div>

                {{-- Service 2 --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-service-card h-100">
                        <div class="tpl-service-top">
                            <div class="tpl-service-ic">
                                <i class="bi bi-journal-richtext"></i>
                            </div>
                            <span class="tpl-service-pill tpl-service-pill--soft">Learn</span>
                        </div>

                        <h5 class="tpl-service-title mt-3 mb-2">Educational Resources</h5>
                        <p class="tpl-service-text mb-4">
                            Learn the ins and outs of forex trading with our extensive range of educational materials.
                        </p>

                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <span class="tpl-service-meta">Courses • Guides • Strategy</span>
                          
                        </div>

                        <div class="tpl-service-glow"></div>
                    </div>
                </div>

                {{-- Service 3 --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="tpl-service-card h-100">
                        <div class="tpl-service-top">
                            <div class="tpl-service-ic">
                                <i class="bi bi-cpu"></i>
                            </div>
                            <span class="tpl-service-pill tpl-service-pill--soft">Automate</span>
                        </div>

                        <h5 class="tpl-service-title mt-3 mb-2">Trading Bots</h5>
                        <p class="tpl-service-text mb-4">
                            Automate your trading strategy with efficient bots designed to optimize execution and workflow.
                        </p>

                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <span class="tpl-service-meta">Automation • Efficiency</span>
                       
                        </div>

                        <div class="tpl-service-glow"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Service End -->

@once
<style>
    /* ✅ SAME INNER PADDING SYSTEM AS FEATURES */
    .tpl-section-inner{
        padding: 84px 0;
    }
    @media (max-width: 991.98px){
        .tpl-section-inner{ padding: 72px 0; }
    }
    @media (max-width: 575.98px){
        .tpl-section-inner{ padding: 56px 0; }
    }

    /* ===== SERVICES DARK SECTION ===== */
    .tpl-services--dark{
        background:
            radial-gradient(900px 500px at 15% 10%, rgba(57,213,255,.12), transparent 60%),
            radial-gradient(900px 600px at 90% 30%, rgba(6,163,218,.10), transparent 60%),
            #000;
        border-top: 1px solid rgba(255,255,255,.08);
        border-bottom: 1px solid rgba(255,255,255,.08);
        color: #fff;
    }

    /* Dark section head */
    .tpl-kicker--dark{
        background: rgba(255,255,255,.06);
        border: 1px solid rgba(255,255,255,.14);
        color: rgba(255,255,255,.85);
        box-shadow: none;
    }
    .tpl-h2--dark{ color: #fff; }
    .tpl-lead--dark{ color: rgba(255,255,255,.70); }

    /* Service card */
    .tpl-service-card{
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;

        padding: 20px;
        border-radius: 22px;

        background: rgba(255,255,255,.05);
        border: 1px solid rgba(255,255,255,.12);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);

        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }

    .tpl-service-card:hover{
        transform: translateY(-4px);
        border-color: rgba(57,213,255,.55);
        box-shadow: 0 30px 90px rgba(0,0,0,.55);
    }

    /* Top row */
    .tpl-service-top{
        display:flex;
        align-items:center;
        justify-content:space-between;
    }

    .tpl-service-ic{
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display:flex;
        align-items:center;
        justify-content:center;

        background: rgba(57,213,255,.18);
        border: 1px solid rgba(57,213,255,.40);
        color: #39d5ff;
        font-size: 1.15rem;
    }

    .tpl-service-pill{
        font-size: .75rem;
        font-weight: 900;
        letter-spacing: .3px;
        padding: .35rem .7rem;
        border-radius: 999px;

        color: #39d5ff;
        background: rgba(57,213,255,.14);
        border: 1px solid rgba(57,213,255,.35);
    }

    .tpl-service-pill--soft{
        color: rgba(255,255,255,.85);
        background: rgba(255,255,255,.10);
        border-color: rgba(255,255,255,.20);
    }

    /* Text */
    .tpl-service-title{
        font-weight: 950;
        letter-spacing: -.02em;
        color: #fff;
    }

    .tpl-service-text{
        color: rgba(255,255,255,.70);
        font-size: .95rem;
        line-height: 1.45;
    }

    .tpl-service-meta{
        font-size: .8rem;
        font-weight: 700;
        color: rgba(255,255,255,.55);
    }

    /* Button */
    .tpl-service-btn{
        border-radius: 999px;
        padding: .4rem .8rem;
        font-weight: 900;

        color: #000;
        background: linear-gradient(135deg, #06a3da, #39d5ff);
        border: none;
    }

    .tpl-service-btn:hover{
        opacity: .9;
        color: #000;
    }

    /* Glow */
    .tpl-service-glow{
        position:absolute;
        right:-60px;
        bottom:-60px;
        width:180px;
        height:180px;
        border-radius:50%;
        background: radial-gradient(circle at 30% 30%, rgba(57,213,255,.35), transparent 65%);
        opacity:.6;
        pointer-events:none;
    }

    /* Responsive */
    @media (max-width: 575.98px){
        .tpl-service-card{
            padding: 16px;
            border-radius: 18px;
        }
        .tpl-service-ic{
            width: 42px;
            height: 42px;
        }
    }

    @media (prefers-reduced-motion: reduce){
        .tpl-service-card{ transition: none; }
        .tpl-service-card:hover{ transform: none; }
    }
</style>
@endonce
