@extends('client.client_layouts.portal')

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
        <div>
            <h3 class="mb-1">Become a Partner</h3>
            <div class="text-muted">Earn commissions by referring clients to PipLab</div>
        </div>

        <div class="mt-3 mt-md-0 d-flex gap-2 flex-wrap">
            <a href="mailto:partner@thepiplab.com" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-envelope me-2"></i>Email
            </a>
            <a href="https://wa.me/447476762948" target="_blank" class="btn btn-primary btn-sm">
                <i class="fab fa-whatsapp me-2"></i>WhatsApp
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Main Info --}}
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3 p-md-4">
                    <p class="mb-3">
                        If you want to become a partner and earn commissions from referrals,
                        contact our team for onboarding and details.
                    </p>

                    <div class="bg-light rounded-4 p-3 p-md-4">
                        <h5 class="mb-3">Benefits of Becoming a Partner</h5>
                        <ul class="mb-0">
                            <li class="mb-2">Earn <strong>20%</strong> commission on purchases made by your referrals.</li>
                            <li class="mb-2">Access tools and resources to help you grow your network.</li>
                            <li class="mb-0">Receive reports on your referral performance and earnings.</li>
                        </ul>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <div>
                            <div class="text-muted small">Contact Email</div>
                            <div class="fw-semibold">partner@thepiplab.com</div>
                        </div>

                        <div>
                            <div class="text-muted small">WhatsApp</div>
                            <a class="fw-semibold text-decoration-none" href="https://wa.me/447476762948" target="_blank">
                                +44 7476 762948
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Side Card / CTA --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3 p-md-4">
                    <h5 class="mb-2">Ready to Start?</h5>
                    <p class="text-muted mb-3">
                        Message us on WhatsApp and we’ll guide you through the partner onboarding.
                    </p>

                    <div class="d-grid gap-2">
                        <a href="https://wa.me/447476762948" target="_blank" class="btn btn-primary">
                            <i class="fab fa-whatsapp me-2"></i>Start on WhatsApp
                        </a>
                        <a href="mailto:partner@thepiplab.com" class="btn btn-outline-secondary">
                            <i class="fas fa-envelope me-2"></i>Email Partner Team
                        </a>
                    </div>

                    <div class="text-muted small mt-3">
                        We usually respond within business hours.
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection