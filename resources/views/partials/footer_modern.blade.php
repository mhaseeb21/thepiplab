<!-- Footer Start (Modern / Black) -->
<footer class="tpl-footer">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap">

            {{-- MAIN FOOTER CONTENT --}}
            <div class="row gy-4 gy-lg-0 tpl-footer-main">

                {{-- Brand --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{ route('home') }}" class="tpl-footer-brand">
                        <img src="{{ asset('images/logo.png') }}" alt="ThePipLab">
                        <span>ThePipLab</span>
                    </a>

                    <p class="tpl-footer-text mt-3">
                        Your trusted source for professional market updates, expert analysis,
                        and trading education — built for consistency and clarity.
                    </p>
                </div>

                {{-- Contact --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <h6 class="tpl-footer-title">Get In Touch</h6>

                    <ul class="tpl-footer-list">
                        <li>
                            <i class="bi bi-envelope"></i>
                            support@thepiplab.com
                        </li>
                        <li>
                            <i class="bi bi-whatsapp"></i>
                            <a href="https://wa.me/447476762948">+44 7476 762948</a>
                        </li>
                    </ul>

                    <div class="tpl-footer-social">
                        <a href="https://www.facebook.com/share/1AickiGF8e/?mibextid=wwXIfr" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://instagram.com/the.pip.lab" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://t.me/The_piplab" aria-label="Telegram">
                            <i class="bi bi-telegram"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="col-12 col-md-6 col-lg-2">
                    <h6 class="tpl-footer-title">Quick Links</h6>
                    <ul class="tpl-footer-list">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                    </ul>
                </div>

                {{-- Resources --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <h6 class="tpl-footer-title">Resources</h6>
                    <ul class="tpl-footer-list">
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="{{ route('posts.public.index') }}">Market Insights</a></li>
                        <li><a href="{{ route('signals.results') }}">Analysis</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- Disclaimer --}}
    <div class="tpl-footer-disclaimer">
        <div class="container px-4 px-lg-5">
            <p class="mb-0">
                <strong>Risk Disclaimer:</strong> Trading financial markets involves substantial risk and may not be suitable
                for all investors. PipLab provides educational and informational content only and does not offer
                financial or investment advice. Past performance does not guarantee future results.
            </p>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="tpl-footer-bottom">
        <div class="container px-4 px-lg-5 text-center">
            © {{ date('Y') }} <strong>ThePipLab</strong>. All rights reserved.
        </div>
    </div>
</footer>
<!-- Footer End -->
@once
<style>
/* ===== FOOTER (CLEAN BLACK) ===== */
.tpl-footer{
    background: #000;
    color: rgba(255,255,255,.75);
}

/* Main spacing — THIS fixes your issue */
.tpl-footer-main{
    padding-top: clamp(3rem, 6vw, 5rem);
    padding-bottom: clamp(2.5rem, 5vw, 4rem);
}

/* Brand */
.tpl-footer-brand{
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: 900;
    font-size: 1.3rem;
    color: #fff;
    text-decoration: none;
}

.tpl-footer-brand img{
    height: 36px;
}

/* Text */
.tpl-footer-text{
    max-width: 380px;
    font-size: .95rem;
    line-height: 1.7;
    color: rgba(255,255,255,.65);
}

/* Titles */
.tpl-footer-title{
    font-weight: 900;
    font-size: .85rem;
    letter-spacing: .3px;
    margin-bottom: 14px;
    text-transform: uppercase;
    color: #fff;
}

/* Lists */
.tpl-footer-list{
    list-style: none;
    padding: 0;
    margin: 0;
}

.tpl-footer-list li{
    margin-bottom: 10px;
    font-weight: 700;
    font-size: .92rem;
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,.7);
}

.tpl-footer-list li i{
    color: #39d5ff;
}

.tpl-footer-list a{
    color: rgba(255,255,255,.65);
    text-decoration: none;
    word-break: break-word;
}

.tpl-footer-list a:hover{
    color: #39d5ff;
}

/* Social */
.tpl-footer-social{
    display: flex;
    gap: 10px;
    margin-top: 14px;
}

.tpl-footer-social a{
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #39d5ff;
    transition: transform .2s ease, background .2s ease;
}

.tpl-footer-social a:hover{
    transform: translateY(-2px);
    background: rgba(57,213,255,.25);
}

/* Disclaimer */
.tpl-footer-disclaimer{
    border-top: 1px solid rgba(255,255,255,.08);
    padding: 20px 0;
    font-size: .85rem;
    line-height: 1.7;
    color: rgba(255,255,255,.6);
}

/* Bottom */
.tpl-footer-bottom{
    background: #050505;
    padding: 16px 0;
    font-size: .85rem;
    font-weight: 700;
    color: rgba(255,255,255,.6);
}

/* Tablet adjustments */
@media (max-width: 991.98px){
    .tpl-footer-main{
        padding-top: clamp(2rem, 5vw, 3rem);
        padding-bottom: clamp(2rem, 5vw, 3rem);
    }
}

/* Mobile adjustments */
@media (max-width: 575.98px){
    .tpl-footer-text{
        max-width: 100%;
    }

    .tpl-footer-list li{
        font-size: .85rem;
        margin-bottom: 8px;
    }

    .tpl-footer-brand{
        font-size: 1.1rem;
    }

    .tpl-footer-title{
        font-size: .8rem;
        margin-bottom: 10px;
    }

    .tpl-footer-main .col-md-6{
        margin-bottom: 15px;
    }
}
</style>
@endonce