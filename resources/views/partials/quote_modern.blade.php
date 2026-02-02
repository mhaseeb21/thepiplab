<!-- Affiliate Program Start (PipLab Premium) -->
<section class="tpl-affiliate" id="affiliate">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-wrap tpl-section-inner">

            <div class="row g-4 g-lg-5 align-items-stretch">

                {{-- LEFT CONTENT --}}
                <div class="col-12 col-lg-7">
                    <div class="tpl-affiliate-panel h-100">

                        <span class="tpl-kicker">
                            <i class="bi bi-people-fill"></i>
                            Become Our Affiliate
                        </span>

                        <h2 class="tpl-affiliate-title mt-4 mb-4">
                            Earn Commissions & Bonuses By Joining Our Affiliate Program
                        </h2>

                        <p class="tpl-affiliate-lead mb-5">
                            If you have a team or network of potential clients, partner with PipLab and earn commissions
                            on every successful referral. We reward performance with clear incentives, bonuses, and a
                            long-term collaboration mindset.
                        </p>

                        {{-- Feature grid --}}
                        <div class="row g-3 g-lg-4 mb-5">

                            <div class="col-12 col-md-6">
                                <div class="tpl-affiliate-feature">
                                    <div class="tpl-affiliate-ic">
                                        <i class="bi bi-cash-coin"></i>
                                    </div>
                                    <div class="tpl-affiliate-content">
                                        <div class="tpl-affiliate-ftitle">High Commission Rates</div>
                                        <div class="tpl-affiliate-fsub">Attractive earnings for every qualified referral.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="tpl-affiliate-feature">
                                    <div class="tpl-affiliate-ic">
                                        <i class="bi bi-gift-fill"></i>
                                    </div>
                                    <div class="tpl-affiliate-content">
                                        <div class="tpl-affiliate-ftitle">Exclusive Bonuses</div>
                                        <div class="tpl-affiliate-fsub">Extra perks for consistent performance.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="tpl-affiliate-feature">
                                    <div class="tpl-affiliate-ic">
                                        <i class="bi bi-shield-check"></i>
                                    </div>
                                    <div class="tpl-affiliate-content">
                                        <div class="tpl-affiliate-ftitle">Trusted Brand</div>
                                        <div class="tpl-affiliate-fsub">A clean client experience built for retention.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="tpl-affiliate-feature">
                                    <div class="tpl-affiliate-ic">
                                        <i class="bi bi-headset"></i>
                                    </div>
                                    <div class="tpl-affiliate-content">
                                        <div class="tpl-affiliate-ftitle">Partner Support</div>
                                        <div class="tpl-affiliate-fsub">Fast communication and onboarding help.</div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Contact strip --}}
                        <div class="tpl-affiliate-contact">
                            <div class="tpl-affiliate-contact-ic">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div class="tpl-affiliate-contact-info">
                                <div class="tpl-affiliate-contact-title">Join Us Today</div>
                                <a class="tpl-affiliate-contact-link" href="https://wa.me/447476762948" target="_blank" rel="noopener">
                                    +44 7476762948
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- RIGHT FORM --}}
                <div class="col-12 col-lg-5">
                    <div class="tpl-affiliate-formcard h-100">

                        <div class="tpl-affiliate-formhead">
                            <div class="tpl-affiliate-formtitle">Apply to be an Affiliate</div>
                            <div class="tpl-affiliate-formsub">Tell us about your team — we'll get back to you.</div>
                        </div>

                        {{-- Alerts --}}
                        @if(session('success'))
                            <div class="alert tpl-alert-success mb-3">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert tpl-alert-danger mb-3">
                                <div class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the following:</div>
                                <ul class="mb-0 ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('affiliate.store') }}" method="POST" class="tpl-affiliate-form">
                            @csrf

                            <div class="row g-3">

                                <div class="col-12">
                                    <label class="tpl-form-label">Your Name</label>
                                    <input type="text" name="name" class="form-control tpl-input"
                                           placeholder="Enter your full name" required>
                                </div>

                                <div class="col-12">
                                    <label class="tpl-form-label">Your Email</label>
                                    <input type="email" name="email" class="form-control tpl-input"
                                           placeholder="Enter your email address" required>
                                </div>

                                <div class="col-12">
                                    <label class="tpl-form-label">Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control tpl-input"
                                           placeholder="WhatsApp / Phone number" required>
                                </div>

                                <div class="col-12">
                                    <label class="tpl-form-label">Total Team Members</label>
                                    <input type="number" name="team_members" class="form-control tpl-input"
                                           placeholder="e.g. 5" min="1" required>
                                </div>

                                <div class="col-12">
                                    <label class="tpl-form-label">About Your Team</label>
                                    <textarea name="description" class="form-control tpl-input tpl-textarea" rows="4"
                                              placeholder="Briefly describe your team, audience, and how you plan to refer clients" required></textarea>
                                </div>

                                <div class="col-12 pt-2">
                                    <button class="btn tpl-affiliate-submit w-100" type="submit">
                                        Apply Now <i class="bi bi-arrow-right ms-2"></i>
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- Affiliate Program End -->

@once
<style>
    /* ===== Affiliate Section ===== */
    .tpl-affiliate {
        background: #fff;
        border-top: 1px solid rgba(2, 6, 23, .06);
        border-bottom: 1px solid rgba(2, 6, 23, .06);
        padding: 60px 0;
    }

    /* ===== LEFT PANEL ===== */
    .tpl-affiliate-panel {
        background: #fff;
        border: 1.5px solid rgba(2, 6, 23, .08);
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 12px 32px rgba(2, 6, 23, .06);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .tpl-affiliate-panel:hover {
        border-color: rgba(2, 6, 23, .12);
        box-shadow: 0 16px 48px rgba(2, 6, 23, .08);
    }

    .tpl-affiliate-title {
        font-weight: 950;
        letter-spacing: -0.02em;
        line-height: 1.12;
        font-size: clamp(1.65rem, 1.2rem + 1.4vw, 2.35rem);
        color: #0b1220;
    }

    .tpl-affiliate-lead {
        font-size: 1.02rem;
        line-height: 1.7;
        color: rgba(11, 18, 32, .72);
        font-weight: 650;
        max-width: 75ch;
    }

    /* ===== FEATURE CARDS ===== */
    .tpl-affiliate-feature {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 20px;
        border-radius: 18px;
        background: #fff;
        border: 1.5px solid rgba(2, 6, 23, .08);
        box-shadow: 0 8px 20px rgba(2, 6, 23, .04);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .tpl-affiliate-feature::before {
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

    .tpl-affiliate-feature:hover {
        transform: translateY(-4px);
        border-color: rgba(6, 163, 218, .25);
        box-shadow: 0 16px 40px rgba(6, 163, 218, .12);
    }

    .tpl-affiliate-feature:hover::before {
        transform: scaleX(1);
    }

    .tpl-affiliate-ic {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(6, 163, 218, .12);
        border: 1.5px solid rgba(6, 163, 218, .22);
        color: #06a3da;
        font-size: 1.25rem;
        flex: 0 0 auto;
        box-shadow: 0 4px 12px rgba(6, 163, 218, .08);
    }

    .tpl-affiliate-content {
        flex: 1;
    }

    .tpl-affiliate-ftitle {
        font-weight: 900;
        color: #0b1220;
        letter-spacing: -0.01em;
        line-height: 1.2;
        font-size: 1.02rem;
        margin-bottom: 6px;
    }

    .tpl-affiliate-fsub {
        color: rgba(11, 18, 32, .65);
        font-weight: 650;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* ===== CONTACT STRIP ===== */
    .tpl-affiliate-contact {
        margin-top: 12px;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 20px;
        border-radius: 16px;
        border: 1.5px solid rgba(6, 163, 218, .2);
        background: rgba(6, 163, 218, .08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .tpl-affiliate-contact:hover {
        border-color: rgba(6, 163, 218, .35);
        background: rgba(6, 163, 218, .12);
    }

    .tpl-affiliate-contact-ic {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(6, 163, 218, .15);
        border: 1.5px solid rgba(6, 163, 218, .28);
        color: #06a3da;
        font-size: 1.2rem;
        flex: 0 0 auto;
    }

    .tpl-affiliate-contact-info {
        flex: 1;
    }

    .tpl-affiliate-contact-title {
        font-weight: 900;
        color: #0b1220;
        margin-bottom: 2px;
        letter-spacing: -0.01em;
        font-size: 0.98rem;
    }

    .tpl-affiliate-contact-link {
        color: #06a3da;
        font-weight: 950;
        text-decoration: none;
        font-size: 0.96rem;
        transition: color 0.2s ease;
    }

    .tpl-affiliate-contact-link:hover {
        color: #0487b8;
        text-decoration: underline;
    }

    /* ===== RIGHT FORM CARD (BLACK) ===== */
    .tpl-affiliate-formcard {
        background: #000;
        border-radius: 24px;
        padding: 32px;
        border: 1.5px solid rgba(255, 255, 255, .12);
        box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
        position: relative;
        overflow: hidden;
    }

    .tpl-affiliate-formcard::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(6, 163, 218, .1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .tpl-affiliate-formhead {
        margin-bottom: 24px;
        position: relative;
        z-index: 1;
    }

    .tpl-affiliate-formtitle {
        font-weight: 950;
        color: #fff;
        letter-spacing: -0.01em;
        font-size: 1.2rem;
        line-height: 1.2;
    }

    .tpl-affiliate-formsub {
        color: rgba(255, 255, 255, .72);
        font-weight: 650;
        margin-top: 6px;
        font-size: 0.95rem;
        line-height: 1.45;
    }

    .tpl-affiliate-form {
        position: relative;
        z-index: 1;
    }

    .tpl-form-label {
        color: rgba(255, 255, 255, .82);
        font-weight: 800;
        font-size: 0.87rem;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        display: block;
    }

    .tpl-input {
        color: #ffffff !important;
        -webkit-text-fill-color: #ffffff; /* Safari / Chrome autofill fix */
        border-radius: 12px;
        border: 1.5px solid rgba(255, 255, 255, .12);
        background: rgba(255, 255, 255, .06);
        color: #fff;
        padding: 11px 14px;
        font-weight: 700;
        font-size: 0.95rem;
        box-shadow: none !important;
        transition: all 0.2s ease;
    }

    .tpl-input::placeholder {
        color: rgba(255, 255, 255, .35);
        font-weight: 650;
    }

    .tpl-input:focus {
        border-color: rgba(6, 163, 218, .4);
        background: rgba(255, 255, 255, .08);
        outline: none;
        box-shadow: 0 0 0 2px rgba(6, 163, 218, .1);
    }

    .tpl-textarea {
        padding-top: 10px;
        resize: vertical;
        font-family: inherit;
    }

    /* ===== SUBMIT BUTTON ===== */
    .tpl-affiliate-submit {
        border-radius: 12px;
        padding: 12px 20px;
        font-weight: 950;
        font-size: 0.95rem;
        border: none;
        background: #06a3da;
        color: #fff;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .tpl-affiliate-submit:hover {
        background: #0487b8;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(6, 163, 218, .2);
        color: #fff;
    }

    .tpl-affiliate-submit:active {
        transform: translateY(0);
    }

    /* ===== ALERTS ===== */
    .tpl-alert-success {
        background: rgba(25, 135, 84, .15);
        border: 1.5px solid rgba(25, 135, 84, .3);
        color: rgba(255, 255, 255, .95);
        border-radius: 12px;
        padding: 14px 16px;
        font-weight: 700;
        font-size: 0.95rem;
        position: relative;
        z-index: 2;
    }

    .tpl-alert-danger {
        background: rgba(220, 53, 69, .15);
        border: 1.5px solid rgba(220, 53, 69, .3);
        color: rgba(255, 255, 255, .95);
        border-radius: 12px;
        padding: 14px 16px;
        font-weight: 700;
        font-size: 0.95rem;
        position: relative;
        z-index: 2;
    }

    .tpl-alert-danger ul {
        font-weight: 650;
        margin-top: 8px;
    }

    /* ===== KICKER ===== */
    .tpl-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.87rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #06a3da;
        background: rgba(6, 163, 218, .08);
        padding: 8px 14px;
        border-radius: 999px;
        border: 1.5px solid rgba(6, 163, 218, .2);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 767.98px) {
        .tpl-affiliate {
            padding: 40px 0;
        }

        .tpl-affiliate-panel {
            padding: 24px;
            border-radius: 18px;
        }

        .tpl-affiliate-formcard {
            padding: 24px;
            border-radius: 18px;
        }

        .tpl-affiliate-feature {
            padding: 16px;
            border-radius: 16px;
        }

        .tpl-affiliate-ic {
            width: 44px;
            height: 44px;
            font-size: 1.15rem;
            border-radius: 12px;
        }

        .tpl-affiliate-submit {
            padding: 13px 16px;
            font-size: 0.9rem;
        }

        .tpl-form-label {
            font-size: 0.85rem;
            margin-bottom: 6px;
        }

        .tpl-input {
            padding: 10px 12px;
            font-size: 0.9rem;
        }

        .tpl-affiliate-formhead {
            margin-bottom: 20px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .tpl-affiliate-feature,
        .tpl-affiliate-submit,
        .tpl-affiliate-panel,
        .tpl-affiliate-contact,
        .tpl-input {
            transition: none;
        }

        .tpl-affiliate-feature:hover,
        .tpl-affiliate-submit:hover,
        .tpl-affiliate-panel:hover {
            transform: none;
        }
    }
</style>
@endonce