@extends('client.client_layouts.portal')

@section('content')

@php
    use Illuminate\Support\Carbon;
    use App\Models\Purchase;

    $userId = auth()->id();

    // ✅ ACTIVE checks
    $hasActiveSignals = Purchase::where('user_id', $userId)
        ->where('product_type', 'signals')
        ->where('status', 'approved')
        ->whereNotNull('expires_at')
        ->where('expires_at', '>', Carbon::now())
        ->exists();

    $hasActiveCourse = Purchase::where('user_id', $userId)
        ->where('product_type', 'course')
        ->where('status', 'approved')
        ->exists(); // course has no expiry in your setup

    // ✅ PENDING checks (mainly for course/bot; signals optional)
    $hasPendingSignals = Purchase::where('user_id', $userId)
        ->where('product_type', 'signals')
        ->where('status', 'pending')
        ->exists();

    $hasPendingCourse = Purchase::where('user_id', $userId)
        ->where('product_type', 'course')
        ->where('status', 'pending')
        ->exists();
@endphp

<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5">
        <div class="mb-3 mb-md-0">
            <h2 class="mb-2 fw-700" style="color:#091E3E;">Our Services</h2>
            <p class="text-muted mb-0">Choose the perfect service to enhance your trading journey</p>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm rounded-10">
                <i class="fas fa-globe me-2"></i>Website
            </a>
            <a href="https://wa.me/447538005864" class="btn btn-primary btn-sm rounded-10" target="_blank">
                <i class="fas fa-message me-2"></i>Contact
            </a>
        </div>
    </div>

    {{-- Services Grid --}}
    <div class="services-grid">

        {{-- Premium Signals Card --}}
        <div class="service-card-wrapper">
            <div class="service-card signals-card">
                <div class="service-card-image">
                    <img src="{{ asset('images/signals.webp') }}" alt="Premium Signals" class="service-image">
                    <div class="service-overlay">
                        <div class="overlay-badge">
                            <i class="fas fa-bolt"></i>
                            Premium
                        </div>
                    </div>
                </div>

                <div class="service-card-content">
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>

                    <h4 class="service-title">Premium Technical Analysis</h4>

                    <p class="service-description">
                        Real-time Forex | Commodities & Crypto market analysis with high accuracy. Get instant alerts and stay ahead of market movements with our expert analysis.
                    </p>

                    <div class="service-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Real-time alerts</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Technical analysis</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Expert Market Analysis</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>24/7 support</span>
                        </div>
                    </div>

                 @if($hasActiveSignals)
    <button class="service-btn is-disabled" type="button" disabled>
        Already Active <i class="fas fa-check ms-2"></i>
    </button>
    <div class="service-note success">
        <i class="fas fa-info-circle me-1"></i>
        Your Premium Technical Analysis access is currently active.
    </div>
@elseif($hasPendingSignals)
    <button class="service-btn is-disabled" type="button" disabled>
        Payment Pending <i class="fas fa-hourglass-half ms-2"></i>
    </button>
    <div class="service-note warning">
        <i class="fas fa-info-circle me-1"></i>
        Your payment is being confirmed. Access will activate automatically after confirmation.
    </div>
@else
    <a href="{{ route('purchase.create', ['product' => 'signals']) }}" class="service-btn">
        Get Access <i class="fas fa-arrow-right ms-2"></i>
    </a>
@endif
                </div>

                <div class="service-card-footer">
                    <span class="service-category">
                        <i class="fas fa-tag me-1"></i>Trading Updates
                    </span>
                </div>
            </div>
        </div>

        {{-- Education Program Card --}}
        <div class="service-card-wrapper">
            <div class="service-card education-card">
                <div class="service-card-image">
                    <img src="{{ asset('images/education.webp') }}" alt="Education Program" class="service-image">
                    <div class="service-overlay">
                        <div class="overlay-badge">
                            <i class="fas fa-book"></i>
                            Courses
                        </div>
                    </div>
                </div>

                <div class="service-card-content">
                    <div class="service-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>

                    <h4 class="service-title">Education Program</h4>

                    <p class="service-description">
                        Master trading with our comprehensive curriculum. Learn from industry experts through structured lessons and practical strategies.
                    </p>

                    <div class="service-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Structured courses</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Expert instructors</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Practical strategies</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Lifetime access</span>
                        </div>
                    </div>

                    @if($hasActiveCourse)
    <button class="service-btn is-disabled" type="button" disabled>
        Already Enrolled <i class="fas fa-check ms-2"></i>
    </button>
    <div class="service-note success">
        <i class="fas fa-info-circle me-1"></i>
        You already have access to the Education Program.
    </div>
@elseif($hasPendingCourse)
    <button class="service-btn is-disabled" type="button" disabled>
        Request Pending <i class="fas fa-hourglass-half ms-2"></i>
    </button>
    <div class="service-note warning">
        <i class="fas fa-info-circle me-1"></i>
        Your purchase request is pending admin approval.
    </div>
@else
    <a href="{{ route('purchase.create', ['product' => 'course']) }}" class="service-btn">
        Enroll Now <i class="fas fa-arrow-right ms-2"></i>
    </a>
@endif
                </div>

                <div class="service-card-footer">
                    <span class="service-category">
                        <i class="fas fa-book-open me-1"></i>Learning
                    </span>
                </div>
            </div>
        </div>

        {{-- Bots / Strategy Card --}}
        <div class="service-card-wrapper">
            <div class="service-card bots-card">
                <div class="service-card-image">
                    <img src="{{ asset('images/bots.webp') }}" alt="Bots / Strategies" class="service-image">
                    <div class="service-overlay">
                        <div class="overlay-badge">
                            <i class="fas fa-robot"></i>
                            Automated
                        </div>
                    </div>
                </div>

                <div class="service-card-content">
                    <div class="service-icon">
                        <i class="fas fa-cogs"></i>
                    </div>

                    <h4 class="service-title">Bots & Strategies</h4>

                    <p class="service-description">
                        Automate your trading with intelligent bots. Execute trades 24/7 with proven strategies and minimal supervision.
                    </p>

                    <div class="service-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Automated trading</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Proven strategies</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>Risk management</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            <span>24/7 operation</span>
                        </div>
                    </div>

<a href="{{ route('bot.request.create') }}" class="service-btn">
    Request a Quote <i class="fas fa-arrow-right ms-2"></i>
</a>
                </div>

                <div class="service-card-footer">
                    <span class="service-category">
                        <i class="fas fa-microchip me-1"></i>Automation
                    </span>
                </div>
            </div>
        </div>

    </div>

    {{-- Additional Info Section --}}
    <div class="mt-5 pt-4">
        <div class="info-section">
            <div class="info-header">
                <i class="fas fa-lightbulb me-2"></i>
                <h5 class="mb-0">Why Choose PipLab?</h5>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h6>Expert Analysis</h6>
                    <p>Professional-grade signals and analysis</p>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h6>Secure & Reliable</h6>
                    <p>Enterprise-level security and uptime</p>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h6>24/7 Support</h6>
                    <p>Always available to help you succeed</p>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h6>Proven Results</h6>
                    <p>Track record of consistent performance</p>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    /* ============================================
       SERVICES PAGE STYLING
       ============================================ */

    :root {
        --piplab-primary: #06a3da;
        --piplab-accent: #39d5ff;
        --piplab-dark: #091E3E;
    }

    .fw-700 {
        font-weight: 700 !important;
    }

    .rounded-10 {
        border-radius: 10px !important;
    }

    h2 {
        letter-spacing: -0.5px;
    }

    /* ============================================
       PAGE HEADER
       ============================================ */

    h2 {
        font-weight: 700;
    }

    /* ============================================
       SERVICES GRID
       ============================================ */

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 28px;
        margin-bottom: 40px;
    }

    .service-card-wrapper {
        animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ============================================
       SERVICE CARD
       ============================================ */

    .service-card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(6, 163, 218, 0.08);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(6, 163, 218, 0.15);
        border-color: rgba(6, 163, 218, 0.15);
    }

    /* ============================================
       SERVICE IMAGE
       ============================================ */

    .service-card-image {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    }

    .service-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .service-card:hover .service-image {
        transform: scale(1.08);
    }

    .service-overlay {
        position: absolute;
        top: 12px;
        right: 12px;
    }

    .overlay-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(6, 163, 218, 0.95);
        color: white;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* ============================================
       SERVICE CONTENT
       ============================================ */

    .service-card-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .service-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(6, 163, 218, 0.1);
        border-radius: 12px;
        color: var(--piplab-primary);
        font-size: 24px;
        margin-bottom: 16px;
        transition: all 0.3s ease;
    }

    .service-card:hover .service-icon {
        background: var(--piplab-primary);
        color: white;
        transform: scale(1.1);
    }

    .service-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--piplab-dark);
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .service-description {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 16px;
        flex: 1;
    }

    /* ============================================
       SERVICE FEATURES
       ============================================ */

    .service-features {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 20px;
        padding: 16px;
        background: rgba(6, 163, 218, 0.04);
        border-radius: 10px;
        border-left: 3px solid var(--piplab-primary);
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #333;
    }

    .feature-item i {
        color: var(--piplab-primary);
        font-weight: 700;
        font-size: 12px;
        flex-shrink: 0;
    }

    /* ============================================
       SERVICE BUTTON
       ============================================ */

    .service-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 12px 16px;
        background: linear-gradient(135deg, var(--piplab-primary) 0%, #0582b8 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .service-btn:hover {
        background: linear-gradient(135deg, #0582b8 0%, #046a94 100%);
        transform: translateX(2px);
        color: white;
        box-shadow: 0 6px 16px rgba(6, 163, 218, 0.3);
    }

    .service-btn:active {
        transform: translateX(0);
    }

    /* ============================================
       SERVICE CARD FOOTER
       ============================================ */

    .service-card-footer {
        padding: 12px 24px;
        background: rgba(6, 163, 218, 0.04);
        border-top: 1px solid rgba(6, 163, 218, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .service-category {
        font-size: 12px;
        color: var(--piplab-primary);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ============================================
       CARD TYPE VARIANTS
       ============================================ */

    .signals-card .overlay-badge {
        background: rgba(229, 57, 53, 0.95);
    }

    .signals-card .service-icon {
        background: rgba(229, 57, 53, 0.1);
        color: #e53935;
    }

    .signals-card:hover .service-icon {
        background: #e53935;
    }

    .signals-card .service-btn {
        background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
    }

    .signals-card .service-btn:hover {
        background: linear-gradient(135deg, #c62828 0%, #ad1457 100%);
    }

    .education-card .overlay-badge {
        background: rgba(76, 175, 80, 0.95);
    }

    .education-card .service-icon {
        background: rgba(76, 175, 80, 0.1);
        color: #4CAF50;
    }

    .education-card:hover .service-icon {
        background: #4CAF50;
    }

    .education-card .service-btn {
        background: linear-gradient(135deg, #4CAF50 0%, #388E3C 100%);
    }

    .education-card .service-btn:hover {
        background: linear-gradient(135deg, #388E3C 0%, #2E7D32 100%);
    }

    .bots-card .overlay-badge {
        background: rgba(156, 39, 176, 0.95);
    }

    .bots-card .service-icon {
        background: rgba(156, 39, 176, 0.1);
        color: #9C27B0;
    }

    .bots-card:hover .service-icon {
        background: #9C27B0;
    }

    .bots-card .service-btn {
        background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%);
    }

    .bots-card .service-btn:hover {
        background: linear-gradient(135deg, #7B1FA2 0%, #6A1B9A 100%);
    }

    /* ============================================
       INFO SECTION
       ============================================ */

    .info-section {
        background: linear-gradient(135deg, rgba(6, 163, 218, 0.04) 0%, rgba(57, 213, 255, 0.02) 100%);
        border: 1px solid rgba(6, 163, 218, 0.1);
        border-radius: 16px;
        padding: 32px;
    }

    .info-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(6, 163, 218, 0.2);
    }

    .info-header i {
        color: var(--piplab-primary);
        font-size: 24px;
    }

    .info-header h5 {
        font-size: 18px;
        font-weight: 700;
        color: var(--piplab-dark);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 24px;
    }

    .info-item {
        text-align: center;
    }

    .info-icon {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--piplab-primary);
        color: white;
        border-radius: 12px;
        font-size: 24px;
        margin: 0 auto 12px;
        transition: all 0.3s ease;
    }

    .info-item:hover .info-icon {
        transform: scale(1.1) rotateZ(5deg);
        box-shadow: 0 8px 16px rgba(6, 163, 218, 0.25);
    }

    .info-item h6 {
        font-size: 14px;
        font-weight: 700;
        color: var(--piplab-dark);
        margin-bottom: 6px;
    }

    .info-item p {
        font-size: 12px;
        color: #999;
        line-height: 1.5;
        margin: 0;
    }

    /* ============================================
       RESPONSIVE DESIGN
       ============================================ */

    @media (max-width: 1200px) {
        .services-grid {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }
    }

    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .info-section {
            padding: 24px;
        }

        .info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .info-item {
            text-align: center;
        }

        h2 {
            font-size: 24px;
        }
    }

    @media (max-width: 576px) {
        .service-card-content {
            padding: 16px;
        }

        .service-title {
            font-size: 16px;
        }

        .service-features {
            padding: 12px;
            gap: 6px;
        }

        .feature-item {
            font-size: 12px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .info-section {
            padding: 16px;
        }
    }
    .service-btn.is-disabled{
    opacity: 0.65;
    cursor: not-allowed;
    pointer-events: none;
    filter: grayscale(20%);
    box-shadow: none !important;
    transform: none !important;
}

.service-note{
    margin-top: 10px;
    font-size: 12px;
    line-height: 1.5;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid rgba(0,0,0,0.06);
    background: rgba(0,0,0,0.03);
    color: #333;
}

.service-note.success{
    background: rgba(76, 175, 80, 0.10);
    border-color: rgba(76, 175, 80, 0.25);
}

.service-note.warning{
    background: rgba(255, 152, 0, 0.10);
    border-color: rgba(255, 152, 0, 0.25);
}
</style>

@endsection