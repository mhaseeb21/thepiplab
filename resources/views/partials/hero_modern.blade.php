<section class="tpl-hero">

    {{-- HERO MAIN --}}
    <div class="tpl-hero-main">
        <div class="container-fluid px-4 px-lg-5">
            <div class="tpl-wrap tpl-section-inner">
                <div class="row align-items-center g-4 g-lg-5">

                    {{-- LEFT CONTENT --}}
                    <div class="col-lg-6">

                        <span class="tpl-kicker">
                            <i class="bi bi-lightning-charge-fill"></i>
                            Real-Time Market Intelligence
                        </span>

                        <h1 class="tpl-h1 mb-3">
                            Trade With Clarity, Not Noise
                        </h1>

                        <p class="tpl-hero-paragraph mb-4">
                            PipLab delivers structured market insights, live pricing feeds, and professional-grade education
                            designed to help traders make informed decisions with confidence. No hype — just clarity,
                            consistency, and experience built over years in global markets.
                        </p>

                        {{-- SINGLE CTA --}}
                        <a href="{{ route('client.register') }}" class="btn btn-tpl btn-lg tpl-btn-lg">
                            Get Started <i class="bi bi-arrow-right ms-2"></i>
                        </a>

                    </div>

                    {{-- RIGHT: IMAGE CAROUSEL --}}
                    <div class="col-lg-6">
                        <div class="tpl-hero-media">

                            <div id="heroMediaCarousel"
                                 class="carousel slide tpl-hero-carousel"
                                 data-bs-ride="carousel"
                                 data-bs-interval="3500"
                                 data-bs-touch="true"
                                 data-bs-pause="false">

                                {{-- INDICATORS ONLY --}}
                                <div class="carousel-indicators tpl-hero-indicators">
                                    <button type="button" data-bs-target="#heroMediaCarousel" data-bs-slide-to="0"
                                            class="active" aria-current="true"></button>
                                    <button type="button" data-bs-target="#heroMediaCarousel" data-bs-slide-to="1"></button>
                                    <button type="button" data-bs-target="#heroMediaCarousel" data-bs-slide-to="2"></button>
                                </div>

                                <div class="carousel-inner">

                                    <div class="carousel-item active">
                                        <img src="{{ asset('assets/img/carousel-1.png') }}"
                                             class="tpl-hero-img"
                                             alt="PipLab Platform">
                                    </div>

                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/img/carousel2.png') }}"
                                             class="tpl-hero-img"
                                             alt="Market Analysis">
                                    </div>

                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/img/carousel3.png') }}"
                                             class="tpl-hero-img"
                                             alt="Trading Education">
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- FACT STRIP --}}
    <div class="tpl-hero-facts">
        <div class="container-fluid px-4 px-lg-5">
            <div class="tpl-wrap tpl-wrap--narrow">
                <div class="row g-3 text-center">

                    <div class="col-md-4">
                        <div class="tpl-fact-card">
                            <strong>{{ $totalClients }}+</strong>
                            <span>Active Clients</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="tpl-fact-card">
                            <strong>{{ $totalSignals }}</strong>
                            <span>Market Updates</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="tpl-fact-card">
                            <strong>20+</strong>
                            <span>Years Experience</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>

@once
<style>
/* ===== HERO BASE ===== */
.tpl-hero{
    background:#fff;
    border-bottom:1px solid rgba(2,6,23,.06);
}
.tpl-hero-main{
    background:#fff;
}
.tpl-section-inner{
    padding-top: clamp(3rem, 6vw, 5rem);
    padding-bottom: clamp(3rem, 6vw, 5rem);
}

/* ===== TEXT ===== */
.tpl-kicker{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 16px;
    border-radius:999px;
    background:rgba(6,163,218,.08);
    border:1px solid rgba(6,163,218,.18);
    color:var(--tpl-primary);
    font-weight:900;
    font-size:.9rem;
    text-transform:uppercase;
    letter-spacing:.08em;
    margin-bottom: 20px; /* ✅ SPACE AFTER KICKER */
}

.tpl-h1{
    font-weight:950;
    letter-spacing:-.03em;
    line-height:1.05;
    font-size:clamp(2.2rem,1.6rem + 2.2vw,3.5rem);
    color:#0b1220;
}

.tpl-hero-paragraph{
    font-size:1.06rem;
    line-height:1.65;
    color:rgba(11,18,32,.72);
    max-width:60ch;
}

/* ✅ FIX: Button styling */
.btn-tpl{
    background: var(--tpl-primary, #06a3da);
    color: #fff;
    border: none;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-tpl:hover{
    background: #0587ba;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(6,163,218,.3);
}

.tpl-btn-lg{
    padding:.95rem 1.35rem;
    font-weight:950;
    border-radius:999px;
}

/* ===== HERO MEDIA ===== */
.tpl-hero-media{
    position:relative;
}

/* ✅ FIX: Set height on carousel itself (responsive) */
.tpl-hero-carousel{
    position: relative; /* REQUIRED for overlay */
    border-radius:24px;
    overflow:hidden;
    border:1px solid rgba(2,6,23,.10);
    background:#fff;
    box-shadow:0 40px 100px rgba(2,6,23,.12);

    /* This controls the box height and makes images fill */
    height: clamp(320px, 42vw, 480px);
}

/* Make inner/items match carousel height */
.tpl-hero-carousel .carousel-inner,
.tpl-hero-carousel .carousel-item{
    height: 100%;
}

/* BLACKISH OVERLAY */
.tpl-hero-carousel::after{
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.25);
    pointer-events: none;
    z-index: 2;
}

/* ✅ FIX: Image fills full box always */
.tpl-hero-img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* INDICATORS ONLY */
.tpl-hero-indicators{
    bottom:12px;
    z-index: 3; /* above overlay */
}
.tpl-hero-indicators [data-bs-target]{
    width:8px;
    height:8px;
    border-radius:999px;
    background-color:rgba(255,255,255,.6);
    border:0;
    margin:0 4px;
}
.tpl-hero-indicators .active{
    width:22px;
    background-color:var(--tpl-primary);
}

/* ===== FACT STRIP ===== */
.tpl-hero-facts{
    background:#000;
    padding:14px 0;
}
.tpl-fact-card{
    color:#fff;
}
.tpl-fact-card strong{
    display:block;
    font-size:1.85rem;
    font-weight:950;
}
.tpl-fact-card span{
    font-size:.8rem;
    letter-spacing:.3px;
    opacity:.75;
}

/* ===== RESPONSIVE ===== */
@media (max-width:991.98px){
    .tpl-hero-paragraph{ max-width:100%; }
}

/* Mobile fine-tune */
@media (max-width:575.98px){
    .tpl-hero-carousel{
        height: 300px;
        border-radius: 18px;
    }
}
</style>
@endonce