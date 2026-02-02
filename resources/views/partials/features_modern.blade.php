<!-- Features Start (Modern / Light) -->
<section class="tpl-features" id="features">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            {{-- Section Head --}}
            <div class="tpl-sectionhead tpl-sectionhead--center mb-4 mb-lg-5">
                <span class="tpl-kicker">
                    <i class="bi bi-stars"></i>
                    Why Choose PipLab
                </span>
                <h2 class="tpl-h2 mb-2">We Help Your Trading Grow Exponentially</h2>
                <p class="tpl-lead mb-0">
                    Premium insights, strong support, and a clear client experience — built for consistency.
                </p>
            </div>

            <div class="row g-4 g-lg-5 align-items-center">

                {{-- Left Features --}}
                <div class="col-12 col-lg-4">
                    <div class="row g-3 g-lg-4">
                        <div class="col-12">
                            <div class="tpl-feature-card h-100">
                                <div class="tpl-feature-ic">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <div>
                                    <div class="tpl-feature-title">Top-Tier Market Insights</div>
                                    <div class="tpl-feature-text">
                                        Our analysis are based on real-time market, ensuring you're always ahead of the curve.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tpl-feature-card h-100">
                                <div class="tpl-feature-ic">
                                    <i class="bi bi-award"></i>
                                </div>
                                <div>
                                    <div class="tpl-feature-title">Recognized for Excellence</div>
                                    <div class="tpl-feature-text">
                                        PipLab has earned trust from traders worldwide for its consistency and reliability.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Center Image --}}
                <div class="col-12 col-lg-4">
                    <div class="tpl-feature-media">
                        <div class="tpl-feature-frame">
                            <img src="{{ asset('images/support.png') }}" alt="PipLab Support" class="tpl-feature-img">
                        </div>

                        {{-- Badge (premium touch) --}}
                    
                    </div>
                </div>

                {{-- Right Features --}}
                <div class="col-12 col-lg-4">
                    <div class="row g-3 g-lg-4">
                        <div class="col-12">
                            <div class="tpl-feature-card h-100">
                                <div class="tpl-feature-ic">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div>
                                    <div class="tpl-feature-title">Expert Team</div>
                                    <div class="tpl-feature-text">
                                        Our team consists of seasoned professionals with years of trading experience and market knowledge.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="tpl-feature-card h-100">
                                <div class="tpl-feature-ic">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div>
                                    <div class="tpl-feature-title">24/7 Support</div>
                                    <div class="tpl-feature-text">
                                        Our dedicated support team is always available to assist you with your trading queries.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- Features End -->

@once
<style>
    /* Section background */
    .tpl-features{
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(900px 520px at 12% 10%, rgba(57,213,255,.10), transparent 60%),
            radial-gradient(900px 620px at 90% 25%, rgba(6,163,218,.08), transparent 60%),
            rgba(255,255,255,.55);
        border-top: 1px solid rgba(2,6,23,.06);
        border-bottom: 1px solid rgba(2,6,23,.06);
    }

    /* Centered head */
    .tpl-sectionhead--center{
        max-width: 720px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }

    /* Feature cards */
    .tpl-feature-card{
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: flex-start;
        gap: 14px;

        padding: 16px;
        border-radius: 22px;

        border: 1px solid rgba(2,6,23,.08);
        background: rgba(255,255,255,.78);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);

        box-shadow: 0 18px 55px rgba(2,6,23,.08);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        height: 100%;
    }

    .tpl-feature-card:hover{
        transform: translateY(-2px);
        border-color: rgba(57,213,255,.55);
        box-shadow: 0 26px 75px rgba(2,6,23,.12);
    }

    /* subtle corner glow */
    .tpl-feature-card:after{
        content:"";
        position:absolute;
        right:-40px;
        top:-40px;
        width:150px;
        height:150px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(57,213,255,.30), transparent 60%);
        opacity: .55;
        pointer-events:none;
    }

    .tpl-feature-ic{
        width: 46px;
        height: 46px;
        border-radius: 16px;
        display:flex;
        align-items:center;
        justify-content:center;

        background: rgba(57,213,255,.18);
        border: 1px solid rgba(6,163,218,.20);
        color: var(--tpl-primary);
        font-size: 1.15rem;
        flex: 0 0 auto;
        margin-top: 1px;
    }

    .tpl-feature-title{
        font-weight: 950;
        color: rgba(11,18,32,.92);
        letter-spacing: -.01em;
        line-height: 1.15;
        font-size: 1.05rem;
        margin-bottom: 4px;
    }

    .tpl-feature-text{
        color: rgba(11,18,32,.66);
        font-weight: 700;
        font-size: .95rem;
        line-height: 1.35;
    }

    /* Center media */
    .tpl-feature-media{
        position: relative;
        padding: 6px;
    }

    .tpl-feature-frame{
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid rgba(2,6,23,.10);
        background:
            radial-gradient(900px 500px at 30% 20%, rgba(57,213,255,.18), transparent 60%),
            rgba(255,255,255,.78);
        box-shadow: 0 30px 90px rgba(2,6,23,.14);
    }

    .tpl-feature-img{
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        transform: scale(1.01);
    }

    .tpl-feature-badge{
        position: absolute;
        left: 16px;
        bottom: 16px;

        display: inline-flex;
        align-items: center;
        gap: .55rem;

        padding: .6rem .8rem;
        border-radius: 999px;

        font-weight: 950;
        font-size: .9rem;
        color: rgba(11,18,32,.90);

        background: rgba(255,255,255,.92);
        border: 1px solid rgba(2,6,23,.10);
        box-shadow: 0 18px 55px rgba(2,6,23,.14);
        white-space: nowrap;
    }
    .tpl-feature-badge i{ color: var(--tpl-primary); }

    /* Responsive */
    @media (max-width: 991.98px){
        .tpl-feature-media{ padding: 0; }
        .tpl-feature-badge{ left: 12px; bottom: 12px; }
    }

    @media (max-width: 575.98px){
        .tpl-feature-card{ padding: 14px; border-radius: 18px; }
        .tpl-feature-ic{ width: 42px; height: 42px; border-radius: 14px; }
        .tpl-feature-badge{ font-size: .82rem; }
    }

    @media (prefers-reduced-motion: reduce){
        .tpl-feature-card{ transition: none; }
        .tpl-feature-card:hover{ transform: none; }
    }
</style>
@endonce
