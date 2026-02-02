<!-- About Start (Enhanced Design) -->
<section class="tpl-about" id="about">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-9">

                    {{-- Top Head --}}
                    <div class="tpl-about-head text-center mb-5 mb-lg-6">
                        <span class="tpl-kicker">
                            <i class="bi bi-info-circle-fill"></i>
                            About PipLab
                        </span>

                        <h2 class="tpl-about-title mt-4 mb-4">
                            Empowering Traders with 20+ Years of Collective Expertise
                        </h2>

                        <p class="tpl-about-lead mb-0">
                            PipLab delivers reliable market insights, structured education, and practical tools designed to
                            support traders with clarity and consistency. Whether you're building your foundation or refining
                            an advanced approach — our focus is a clean client experience backed by real market time.
                        </p>
                    </div>

                    {{-- Feature Grid --}}
                    <div class="row g-3 g-lg-4 mb-5 mb-lg-6">

                        <div class="col-12 col-md-6">
                            <div class="tpl-about-feature">
                                <div class="tpl-about-ic">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="tpl-about-content">
                                    <div class="tpl-about-ftitle">Proven Process</div>
                                    <div class="tpl-about-fsub">Structured updates designed for decision clarity.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="tpl-about-feature">
                                <div class="tpl-about-ic">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="tpl-about-content">
                                    <div class="tpl-about-ftitle">Experienced Team</div>
                                    <div class="tpl-about-fsub">Guidance built on years in global markets.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="tpl-about-feature">
                                <div class="tpl-about-ic">
                                    <i class="bi bi-headset"></i>
                                </div>
                                <div class="tpl-about-content">
                                    <div class="tpl-about-ftitle">Client-First Support</div>
                                    <div class="tpl-about-fsub">Fast responses with clear, helpful direction.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="tpl-about-feature">
                                <div class="tpl-about-ic">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                </div>
                                <div class="tpl-about-content">
                                    <div class="tpl-about-ftitle">Premium Value</div>
                                    <div class="tpl-about-fsub">High-quality tools without unnecessary complexity.</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- PREMIUM COMMUNITY BOX --}}
                    <div class="tpl-about-cta">
                        <div class="tpl-about-cta-bg"></div>
                        
                        <div class="tpl-about-cta-content">
                            <div class="tpl-about-cta-head">
                                <div class="tpl-about-cta-ic">
                                    <i class="bi bi-chat-dots-fill"></i>
                                </div>
                                <div>
                                    <div class="tpl-about-cta-title">Join Our Premium Community</div>
                                    <div class="tpl-about-cta-sub">
                                        Daily market updates, exclusive insights, and real-time discussion — in one place.
                                    </div>
                                </div>
                            </div>

                            <div class="tpl-about-cta-divider"></div>

                            <div class="d-flex flex-wrap gap-3 justify-content-center">
                                <a href="https://chat.whatsapp.com/HIXCp2tljfZ7A2gqHQZ8S4"
                                   target="_blank" rel="noopener noreferrer"
                                   class="btn tpl-about-cta-btn tpl-about-cta-btn--wa">
                                    <i class="bi bi-whatsapp"></i>
                                    <span>Join WhatsApp</span>
                                </a>

                                <a href="https://t.me/YOUR_TELEGRAM_LINK"
                                   target="_blank" rel="noopener noreferrer"
                                   class="btn tpl-about-cta-btn tpl-about-cta-btn--tg">
                                    <i class="bi bi-telegram"></i>
                                    <span>Join Telegram</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- About End -->

@once
<style>
    /* ===== ABOUT: ENHANCED DESIGN ===== */
    
    :root {
        --tpl-primary: #06a3da;
        --tpl-accent: #39d5ff;
        --tpl-dark: #0b1220;
        --tpl-gradient: linear-gradient(135deg, #06a3da 0%, #39d5ff 100%);
    }

    .tpl-about {
        background: #fff;
        border-top: 1px solid rgba(2, 6, 23, .06);
        border-bottom: 1px solid rgba(2, 6, 23, .06);
        padding: 60px 0;
    }

    /* ===== HEAD SECTION ===== */
    .tpl-about-head {
        max-width: 860px;
        margin: 0 auto;
    }

    .tpl-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--tpl-primary);
        background: rgba(6, 163, 218, .08);
        padding: 8px 14px;
        border-radius: 999px;
        border: 1px solid rgba(6, 163, 218, .2);
    }

    .tpl-about-title {
        font-weight: 950;
        letter-spacing: -0.02em;
        line-height: 1.1;
        font-size: clamp(1.85rem, 1.35rem + 1.6vw, 2.7rem);
        color: var(--tpl-dark);
    }

    .tpl-about-lead {
        font-size: 1.06rem;
        line-height: 1.7;
        color: rgba(11, 18, 32, .70);
        font-weight: 600;
    }

    /* ===== FEATURE CARDS ===== */
    .tpl-about-feature {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 24px;
        border-radius: 20px;
        background: #fff;
        border: 1.5px solid rgba(2, 6, 23, .08);
        box-shadow: 0 8px 24px rgba(2, 6, 23, .04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .tpl-about-feature::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--tpl-primary);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .tpl-about-feature:hover {
        transform: translateY(-6px);
        border-color: rgba(6, 163, 218, .3);
        box-shadow: 0 20px 48px rgba(6, 163, 218, .15);
    }

    .tpl-about-feature:hover::before {
        transform: scaleX(1);
    }

    .tpl-about-ic {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(6, 163, 218, .15);
        border: 1.5px solid rgba(6, 163, 218, .25);
        color: var(--tpl-primary);
        font-size: 1.35rem;
        flex: 0 0 auto;
        box-shadow: 0 8px 20px rgba(6, 163, 218, .1);
    }

    .tpl-about-content {
        flex: 1;
    }

    .tpl-about-ftitle {
        font-weight: 900;
        color: var(--tpl-dark);
        letter-spacing: -0.01em;
        line-height: 1.2;
        font-size: 1.05rem;
        margin-bottom: 6px;
    }

    .tpl-about-fsub {
        color: rgba(11, 18, 32, .65);
        font-weight: 650;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* ===== PREMIUM CTA BOX ===== */
    .tpl-about-cta {
        position: relative;
        padding: 40px;
        border-radius: 28px;
        background: #000;
        border: 1.5px solid rgba(255, 255, 255, .12);
        box-shadow: 0 20px 60px rgba(0, 0, 0, .3), inset 0 1px 1px rgba(255, 255, 255, .1);
        overflow: hidden;
    }

    .tpl-about-cta-bg {
        position: absolute;
        top: -50%;
        right: -50%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(6, 163, 218, .15) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(20px, -20px); }
    }

    .tpl-about-cta-content {
        position: relative;
        z-index: 1;
    }

    .tpl-about-cta-head {
        display: flex;
        align-items: flex-start;
        gap: 18px;
    }

    .tpl-about-cta-ic {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, .1);
        border: 1.5px solid rgba(255, 255, 255, .2);
        color: var(--tpl-accent);
        font-size: 1.3rem;
        flex: 0 0 auto;
        box-shadow: 0 8px 20px rgba(6, 163, 218, .1);
    }

    .tpl-about-cta-title {
        font-weight: 950;
        color: #fff;
        letter-spacing: -0.01em;
        line-height: 1.2;
        font-size: 1.25rem;
    }

    .tpl-about-cta-sub {
        color: rgba(255, 255, 255, .8);
        font-weight: 650;
        margin-top: 6px;
        font-size: 0.95rem;
        line-height: 1.55;
        max-width: 70ch;
    }

    .tpl-about-cta-divider {
        height: 1.5px;
        background: rgba(255, 255, 255, .12);
        margin: 24px 0;
    }

    /* CTA BUTTONS */
    .tpl-about-cta-btn {
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 900;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1.5px solid rgba(255, 255, 255, .2);
        background: rgba(255, 255, 255, .1);
        color: #fff;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
        cursor: pointer;
        text-decoration: none;
    }

    .tpl-about-cta-btn:hover {
        transform: translateY(-3px);
        background: rgba(255, 255, 255, .15);
        border-color: rgba(255, 255, 255, .35);
        box-shadow: 0 12px 32px rgba(0, 0, 0, .2);
        color: #fff;
    }

    .tpl-about-cta-btn--wa {
        border-color: rgba(37, 211, 102, .3);
        background: rgba(37, 211, 102, .08);
    }

    .tpl-about-cta-btn--wa:hover {
        background: rgba(37, 211, 102, .15);
        border-color: rgba(37, 211, 102, .5);
        box-shadow: 0 12px 32px rgba(37, 211, 102, .1);
    }

    .tpl-about-cta-btn--wa i {
        color: #25d366;
    }

    .tpl-about-cta-btn--tg {
        border-color: rgba(57, 213, 255, .3);
        background: rgba(57, 213, 255, .08);
    }

    .tpl-about-cta-btn--tg:hover {
        background: rgba(57, 213, 255, .15);
        border-color: rgba(57, 213, 255, .5);
        box-shadow: 0 12px 32px rgba(57, 213, 255, .1);
    }

    .tpl-about-cta-btn--tg i {
        color: var(--tpl-accent);
    }

    .tpl-about-cta-btn i {
        font-size: 1.15rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 767.98px) {
        .tpl-about {
            padding: 40px 0;
        }

        .tpl-about-feature {
            padding: 20px;
            border-radius: 16px;
        }

        .tpl-about-ic {
            width: 48px;
            height: 48px;
            font-size: 1.2rem;
        }

        .tpl-about-cta {
            padding: 28px;
            border-radius: 20px;
        }

        .tpl-about-cta-btn {
            width: 100%;
            justify-content: center;
            padding: 14px 20px;
        }

        .tpl-about-cta-head {
            flex-direction: column;
            text-align: center;
            align-items: center;
        }

        .tpl-about-cta-ic {
            width: 48px;
            height: 48px;
            font-size: 1.1rem;
        }

        .tpl-about-cta-sub {
            max-width: 100%;
            text-align: center;
        }

        .tpl-about-cta-title {
            font-size: 1.1rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .tpl-about-feature,
        .tpl-about-cta-btn,
        .tpl-about-cta-bg {
            transition: none;
            animation: none;
        }

        .tpl-about-feature:hover,
        .tpl-about-cta-btn:hover {
            transform: none;
        }
    }
</style>
@endonce