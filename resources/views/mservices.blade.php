@extends('layouts.app')

@section('content')

{{-- ===================== SERVICES (MODERN / CLEAN / ENHANCED DESIGN) ===================== --}}
<section class="tpl-services-page">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            {{-- Header --}}
            <div class="tpl-pagehead text-center wow fadeInUp" data-wow-delay="0.1s">
                <span class="tpl-kicker">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Our Services
                </span>
                <h1 class="tpl-h1 mb-3 mt-4">Empowering Your Forex Journey with Expert Solutions</h1>
                <p class="tpl-lead mb-0">
                    Clear market updates, structured education, and automation tools — built for traders who value consistency.
                </p>
            </div>

            {{-- Services (clean lines, modern design) --}}
            <div class="row g-4 mt-5">
                <div class="col-12 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="tpl-service">
                        <div class="tpl-service-top">
                            <div class="tpl-service-ic">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>
                            <div class="tpl-service-header">
                                <h3 class="tpl-service-title">Market Updates</h3>
                                <div class="tpl-service-sub">Forex • Commodities • Crypto</div>
                            </div>
                        </div>

                        <p class="tpl-service-text">
                            Get daily market updates curated by our team to help you stay aligned with momentum, levels, and key events.
                        </p>

                        <div class="tpl-service-actions">
                            <a class="tpl-service-link" href="{{ route('posts.public.index') }}">
                                Explore Updates <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="tpl-service">
                        <div class="tpl-service-top">
                            <div class="tpl-service-ic">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <div class="tpl-service-header">
                                <h3 class="tpl-service-title">Forex Education</h3>
                                <div class="tpl-service-sub">Structured learning</div>
                            </div>
                        </div>

                        <p class="tpl-service-text">
                            Comprehensive courses and practical resources designed to build confidence, discipline, and repeatable process.
                        </p>

                        <div class="tpl-service-actions">
                            <a class="tpl-service-link" href="{{ route('client.register') }}">
                                View Programs <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tpl-service">
                        <div class="tpl-service-top">
                            <div class="tpl-service-ic">
                                <i class="bi bi-cpu-fill"></i>
                            </div>
                            <div class="tpl-service-header">
                                <h3 class="tpl-service-title">Trading Bots</h3>
                                <div class="tpl-service-sub">Automation support</div>
                            </div>
                        </div>

                        <p class="tpl-service-text">
                            Automation built around clear rules and strategy logic — designed to support efficiency and reduce manual load.
                        </p>

                        <div class="tpl-service-actions">
                            <a class="tpl-service-link" href="{{ route('client.register') }}">
                                Get Started <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Resource Download (enhanced) --}}
            <div class="tpl-resourcebar wow fadeInUp" data-wow-delay="0.15s">
                <div class="tpl-resource-left">
                    <div class="tpl-resource-ic"><i class="bi bi-file-earmark-arrow-down"></i></div>
                    <div>
                        <div class="tpl-resource-title">Download our Course Outline</div>
                        <div class="tpl-resource-sub">PDF • Quick overview of the curriculum</div>
                    </div>
                </div>

                <a href="{{ asset('files/Thepiplab_Course_Outline.pdf') }}"
                   class="tpl-resource-btn"
                   download="Forex_Education">
                    Download <i class="bi bi-arrow-down"></i>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ===================== TESTIMONIALS (UNIQUE MODERN DESIGN) ===================== --}}
<section class="tpl-testimonials">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner tpl-section-inner--sm">

            <div class="tpl-pagehead text-center wow fadeInUp" data-wow-delay="0.1s">
                <span class="tpl-kicker">
                    <i class="bi bi-chat-quote-fill"></i>
                    Testimonial
                </span>
                <h2 class="tpl-h2 mb-3 mt-4">What Our Clients Say</h2>
                <p class="tpl-lead mb-0">
                    Real experiences from traders learning, improving, and building confidence.
                </p>
            </div>

            {{-- Trustpilot Widget --}}
            <div class="tpl-trustpilot-container wow fadeInUp" data-wow-delay="0.15s">
                <div class="tpl-trustpilot-widget">
                    <div class="tpl-trustpilot-icon">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="tpl-trustpilot-content">
                        <div class="tpl-trustpilot-title">Rate Us on Trustpilot</div>
                        <div class="tpl-trustpilot-sub">Share your experience and help others discover PipLab</div>
                    </div>
                    <a href="https://www.trustpilot.com/review/www.thepiplab.com" target="_blank" rel="noopener" class="tpl-trustpilot-btn">
                        Leave Review <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">

                {{-- Item 1 --}}
                <div class="tpl-testi">
                    <div class="tpl-testi-head">
                        <img src="{{ asset('images/halanoor.jpeg') }}" alt="Hala Noor" class="tpl-testi-avatar">
                        <div class="tpl-testi-meta">
                            <div class="tpl-testi-name">Hala Noor</div>
                            <div class="tpl-testi-role">Aspiring Trader</div>
                        </div>
                    </div>
                    <div class="tpl-testi-body">
                        <div class="tpl-testi-email">halanoor473@gmail.com</div>
                        <p class="tpl-testi-quote">
                            PipLab has given me the confidence to understand market movements and make informed trades.
                            The mentorship was fantastic, and I'm now able to manage my trades with a clear strategy.
                        </p>
                    </div>
                </div>

                {{-- Item 2 --}}
                <div class="tpl-testi">
                    <div class="tpl-testi-head">
                        <img src="{{ asset('images/hammadkhalid.jpg') }}" alt="Hammad Khalid" class="tpl-testi-avatar">
                        <div class="tpl-testi-meta">
                            <div class="tpl-testi-name">Hammad Khalid</div>
                            <div class="tpl-testi-role">Forex Enthusiast</div>
                        </div>
                    </div>
                    <div class="tpl-testi-body">
                        <div class="tpl-testi-email">hs4002794@gmail.com</div>
                        <p class="tpl-testi-quote">
                            Learning with PipLab has been transformative. I've gained insights I couldn't find elsewhere,
                            and the hands-on guidance helped me become a confident trader.
                        </p>
                    </div>
                </div>

                {{-- Item 3 --}}
                <div class="tpl-testi">
                    <div class="tpl-testi-head">
                        <img src="{{ asset('images/chaudaryali.jpeg') }}" alt="Chaudary Muhammad Ali" class="tpl-testi-avatar">
                        <div class="tpl-testi-meta">
                            <div class="tpl-testi-name">Chaudary Muhammad Ali</div>
                            <div class="tpl-testi-role">Independent Trader</div>
                        </div>
                    </div>
                    <div class="tpl-testi-body">
                        <div class="tpl-testi-email">ajandran269@gmail.com</div>
                        <p class="tpl-testi-quote">
                            PipLab has been instrumental in my trading journey. Their training program provided the essential
                            tools I needed to start trading confidently. Highly recommended.
                        </p>
                    </div>
                </div>

                {{-- Item 4 --}}
                <div class="tpl-testi">
                    <div class="tpl-testi-head">
                        <img src="{{ asset('images/ghasharib.jpeg') }}" alt="Ghasharib Ghafoor" class="tpl-testi-avatar">
                        <div class="tpl-testi-meta">
                            <div class="tpl-testi-name">Ghasharib Ghafoor</div>
                            <div class="tpl-testi-role">Trading Student</div>
                        </div>
                    </div>
                    <div class="tpl-testi-body">
                        <div class="tpl-testi-email">ghasharibch370@gmail.com</div>
                        <p class="tpl-testi-quote">
                            With PipLab's guidance, I now have a solid foundation in trading. The mentorship was clear,
                            structured, and helped me grasp the intricacies of the forex market.
                        </p>
                    </div>
                </div>

                {{-- Item 5 --}}
                <div class="tpl-testi">
                    <div class="tpl-testi-head">
                        <img src="{{ asset('images/salmankhan.jpeg') }}" alt="Salman Khan" class="tpl-testi-avatar">
                        <div class="tpl-testi-meta">
                            <div class="tpl-testi-name">Salman Khan</div>
                            <div class="tpl-testi-role">Forex Newcomer</div>
                        </div>
                    </div>
                    <div class="tpl-testi-body">
                        <div class="tpl-testi-email">khakankhan13@gmail.com</div>
                        <p class="tpl-testi-quote">
                            PipLab has made learning to trade a rewarding experience. I'm grateful for the skills I've gained,
                            and the support I received made all the difference.
                        </p>
                    </div>
                </div>

                {{-- Item 6 --}}
                <div class="tpl-testi">
                    <div class="tpl-testi-head">
                        <img src="{{ asset('images/aqsaiqbal.jpeg') }}" alt="Aqsa Iqbal" class="tpl-testi-avatar">
                        <div class="tpl-testi-meta">
                            <div class="tpl-testi-name">Aqsa Iqbal</div>
                            <div class="tpl-testi-role">Trading Learner</div>
                        </div>
                    </div>
                    <div class="tpl-testi-body">
                        <div class="tpl-testi-email">aqsa606070@gmail.com</div>
                        <p class="tpl-testi-quote">
                            Thanks to PipLab, I'm able to approach the forex market with confidence. The training was comprehensive,
                            and I appreciate how practical the lessons were.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@once
<style>
/* ===================== PAGE BASE ===================== */
.tpl-services-page,
.tpl-testimonials {
    background: #fff;
    border-top: 1px solid rgba(2, 6, 23, .06);
}

.tpl-section-inner {
    padding-top: clamp(3.5rem, 7vw, 5.5rem);
    padding-bottom: clamp(3.5rem, 7vw, 5.5rem);
}

.tpl-section-inner--sm {
    padding-top: clamp(3rem, 6vw, 4.5rem);
    padding-bottom: clamp(3rem, 6vw, 4.5rem);
}

.tpl-pagehead {
    max-width: 760px;
    margin: 0 auto;
}

.tpl-kicker {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 15px;
    border-radius: 999px;
    background: rgba(6, 163, 218, .08);
    border: 1.5px solid rgba(6, 163, 218, .2);
    color: #06a3da;
    font-weight: 900;
    font-size: 0.87rem;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}

.tpl-h1 {
    font-weight: 950;
    letter-spacing: -0.03em;
    line-height: 1.06;
    font-size: clamp(2rem, 1.4rem + 1.8vw, 3rem);
    color: #0b1220;
}

.tpl-h2 {
    font-weight: 950;
    letter-spacing: -0.02em;
    color: #0b1220;
    font-size: clamp(1.7rem, 1.3rem + 1.2vw, 2.3rem);
}

.tpl-lead {
    font-size: 1.02rem;
    line-height: 1.7;
    color: rgba(11, 18, 32, .72);
    font-weight: 600;
}

/* ===================== SERVICES (ENHANCED) ===================== */
.tpl-service {
    padding: 28px 0;
    border-top: 1.5px solid rgba(2, 6, 23, .08);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.tpl-service:hover {
    padding-top: 30px;
}

.tpl-service::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: #06a3da;
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.tpl-service:hover::before {
    transform: scaleX(1);
}

@media (min-width: 992px) {
    .tpl-service {
        padding: 32px 0;
    }
}

.tpl-service-top {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 14px;
}

.tpl-service-ic {
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(6, 163, 218, .12);
    border: 1.5px solid rgba(6, 163, 218, .22);
    color: #06a3da;
    font-size: 1.25rem;
    flex: 0 0 auto;
    box-shadow: 0 4px 12px rgba(6, 163, 218, .08);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.tpl-service:hover .tpl-service-ic {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(6, 163, 218, .12);
}

.tpl-service-header {
    flex: 1;
}

.tpl-service-title {
    margin: 0;
    font-weight: 950;
    color: #0b1220;
    font-size: 1.3rem;
    letter-spacing: -0.01em;
    line-height: 1.2;
}

.tpl-service-sub {
    font-weight: 800;
    color: rgba(11, 18, 32, .62);
    font-size: 0.9rem;
    margin-top: 4px;
    letter-spacing: 0.2px;
}

.tpl-service-text {
    margin: 0;
    color: rgba(11, 18, 32, .72);
    line-height: 1.7;
    font-size: 1rem;
    max-width: 62ch;
    font-weight: 500;
}

.tpl-service-actions {
    margin-top: 14px;
}

.tpl-service-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    font-weight: 950;
    color: #0b1220;
    padding: 8px 0;
    border-bottom: 2px solid transparent;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 0.97rem;
}

.tpl-service-link:hover {
    color: #06a3da;
    border-color: #06a3da;
    transform: translateX(4px);
}

.tpl-service-link i {
    transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.tpl-service-link:hover i {
    transform: translateX(2px);
}

/* ===================== RESOURCE BAR (ENHANCED) ===================== */
.tpl-resourcebar {
    margin-top: clamp(3rem, 5vw, 3.5rem);
    padding: 20px 0;
    border-top: 1.5px solid rgba(2, 6, 23, .08);
    border-bottom: 1.5px solid rgba(2, 6, 23, .08);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.tpl-resourcebar:hover {
    border-color: rgba(6, 163, 218, .15);
}

.tpl-resource-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.tpl-resource-ic {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(6, 163, 218, .12);
    border: 1.5px solid rgba(6, 163, 218, .22);
    color: #06a3da;
    flex: 0 0 auto;
    font-size: 1.2rem;
    box-shadow: 0 4px 12px rgba(6, 163, 218, .08);
}

.tpl-resource-title {
    font-weight: 950;
    color: #0b1220;
    line-height: 1.2;
    font-size: 1.05rem;
}

.tpl-resource-sub {
    font-weight: 700;
    color: rgba(11, 18, 32, .62);
    font-size: 0.92rem;
    margin-top: 4px;
}

.tpl-resource-btn {
    text-decoration: none;
    border-radius: 12px;
    padding: 11px 22px;
    font-weight: 950;
    background: #0b1220;
    color: #fff;
    border: 1.5px solid rgba(2, 6, 23, .15);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
}

.tpl-resource-btn:hover {
    background: #06a3da;
    border-color: #06a3da;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(6, 163, 218, .2);
}

.tpl-resource-btn i {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.tpl-resource-btn:hover i {
    transform: translateY(2px);
}

/* ===================== TRUSTPILOT WIDGET ===================== */
.tpl-trustpilot-container {
    margin-bottom: clamp(2.5rem, 5vw, 3.5rem);
}

.tpl-trustpilot-widget {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 24px 28px;
    background: linear-gradient(135deg, rgba(6, 163, 218, .08) 0%, rgba(6, 163, 218, .04) 100%);
    border: 1.5px solid rgba(6, 163, 218, .15);
    border-radius: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.tpl-trustpilot-widget:hover {
    border-color: rgba(6, 163, 218, .3);
    box-shadow: 0 12px 36px rgba(6, 163, 218, .1);
}

.tpl-trustpilot-icon {
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #06a3da;
    border-radius: 12px;
    color: #fff;
    font-size: 1.35rem;
    flex: 0 0 auto;
    box-shadow: 0 8px 20px rgba(6, 163, 218, .2);
}

.tpl-trustpilot-content {
    flex: 1;
}

.tpl-trustpilot-title {
    font-weight: 950;
    color: #0b1220;
    font-size: 1.1rem;
    line-height: 1.2;
    margin-bottom: 4px;
}

.tpl-trustpilot-sub {
    font-weight: 650;
    color: rgba(11, 18, 32, .65);
    font-size: 0.95rem;
}

.tpl-trustpilot-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 20px;
    background: #06a3da;
    color: #fff;
    border: none;
    border-radius: 10px;
    font-weight: 950;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 0.95rem;
    cursor: pointer;
    white-space: nowrap;
}

.tpl-trustpilot-btn:hover {
    background: #0487b8;
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(6, 163, 218, .25);
}

.tpl-trustpilot-btn i {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 0.9rem;
}

.tpl-trustpilot-btn:hover i {
    transform: translateX(3px);
}

/* ===================== TESTIMONIALS (UNIQUE DESIGN) ===================== */
.tpl-testimonials {
    border-top: 0;
}

.tpl-testi {
    background: #fff;
    border: 1.5px solid rgba(2, 6, 23, .08);
    border-radius: 18px;
    padding: 26px;
    box-shadow: 0 8px 24px rgba(2, 6, 23, .06);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* Unique left border accent */
.tpl-testi::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: #06a3da;
    transform: scaleY(0);
    transform-origin: top;
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.tpl-testi:hover::before {
    transform: scaleY(1);
}

/* Subtle background accent on hover */
.tpl-testi::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(6, 163, 218, .05) 0%, transparent 70%);
    border-radius: 50%;
    transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
    pointer-events: none;
}

.tpl-testi:hover::after {
    top: -30%;
    right: -30%;
}

.tpl-testi:hover {
    transform: translateY(-8px);
    border-color: rgba(6, 163, 218, .2);
    box-shadow: 0 24px 56px rgba(6, 163, 218, .14);
}

.tpl-testi-head {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 18px;
    position: relative;
    z-index: 1;
}

.tpl-testi-avatar {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    object-fit: cover;
    border: 2px solid #06a3da;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 6px 18px rgba(6, 163, 218, .15);
}

.tpl-testi:hover .tpl-testi-avatar {
    transform: scale(1.08) rotate(2deg);
    box-shadow: 0 12px 32px rgba(6, 163, 218, .25);
}

.tpl-testi-meta {
    flex: 1;
}

.tpl-testi-name {
    font-weight: 950;
    color: #0b1220;
    line-height: 1.15;
    font-size: 1.08rem;
    letter-spacing: -0.01em;
}

.tpl-testi-role {
    font-weight: 800;
    color: #06a3da;
    font-size: 0.88rem;
    margin-top: 4px;
    letter-spacing: 0.2px;
    text-transform: uppercase;
}

.tpl-testi-body {
    flex: 1;
    position: relative;
    z-index: 1;
}

.tpl-testi-email {
    font-weight: 750;
    color: rgba(11, 18, 32, .55);
    font-size: 0.87rem;
    margin-bottom: 12px;
    letter-spacing: 0.15px;
}

.tpl-testi-quote {
    margin: 0;
    color: rgba(11, 18, 32, .76);
    line-height: 1.8;
    font-size: 1rem;
    font-weight: 550;
    font-style: italic;
    position: relative;
    padding-left: 18px;
}

/* Quote mark styling */
.tpl-testi-quote::before {
    content: '"';
    position: absolute;
    left: 0;
    top: -8px;
    font-size: 2.4rem;
    color: rgba(6, 163, 218, .15);
    font-weight: 900;
    font-style: normal;
}

/* ===================== RESPONSIVE ===================== */
@media (max-width: 767.98px) {
    .tpl-section-inner {
        padding-top: clamp(2.5rem, 5vw, 3.5rem);
        padding-bottom: clamp(2.5rem, 5vw, 3.5rem);
    }

    .tpl-service {
        padding: 24px 0;
    }

    .tpl-resourcebar {
        flex-direction: column;
        align-items: stretch;
        padding: 18px 0;
    }

    .tpl-resource-btn {
        width: 100%;
        justify-content: center;
        padding: 12px 16px;
    }

    .tpl-testi {
        padding: 18px;
    }

    .tpl-service-ic {
        width: 48px;
        height: 48px;
        font-size: 1.15rem;
    }

    .tpl-trustpilot-widget {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }

    .tpl-trustpilot-btn {
        width: 100%;
    }
}

@media (prefers-reduced-motion: reduce) {
    .tpl-service,
    .tpl-service-ic,
    .tpl-service-link,
    .tpl-resource-btn,
    .tpl-resourcebar,
    .tpl-testi,
    .tpl-testi-avatar,
    .tpl-trustpilot-widget,
    .tpl-trustpilot-btn {
        transition: none;
    }

    .tpl-service:hover,
    .tpl-service-ic:hover,
    .tpl-service-link:hover,
    .tpl-resource-btn:hover,
    .tpl-testi:hover,
    .tpl-testi:hover .tpl-testi-avatar,
    .tpl-trustpilot-widget:hover,
    .tpl-trustpilot-btn:hover {
        transform: none;
    }

    .tpl-service::before,
    .tpl-testi::before {
        display: none;
    }
}
</style>
@endonce

@endsection