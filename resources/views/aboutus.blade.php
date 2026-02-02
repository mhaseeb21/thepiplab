@extends('layouts.app')

@section('content')
 <!-- About Start -->
 <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">About Us</h5>
                        <h1 class="mb-0">Leading Forex Trading Expertise with Proven Strategies</h1>
                    </div>
                    <p class="mb-4">
                        With over 5 years of experience in the forex market, we are a dedicated team of professional traders who combine data-driven strategies with real-world expertise. Our proprietary trading methods and advanced analytical tools help our clients stay ahead of market trends. Beyond trading, we offer an in-depth educational program designed to help beginners and experienced traders alike enhance their skills and gain a deeper understanding of the forex landscape.
                    </p>
                    <p class="mb-4">
                        Our services also include automated trading bots that leverage market insights and execute trades at optimal moments, helping clients maximize their returns with efficiency and precision. Whether you are looking to learn, trade, or invest, we provide comprehensive support at every step of your forex journey.
                    </p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Innovative Trading Strategies</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Advanced Trading Bots</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>Expert Educational Programs</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>24/7 Client Support</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call us on Whatsapp</h5>
                            <h4 class="text-primary mb-0"><a href="https://wa.me/447377277480">+44 7377 277480</a></h4>
                        </div>
                    </div>
                
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{ asset('assets/img/about.jpg') }}" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    


<!-- Partner Start -->
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
<div class="container py-5 text-center">
<h1 class="mb-4">Our Partner</h1>


<div class="d-flex justify-content-center align-items-center">
<a href="https://neomarkets.com/" target="_blank">
<img
src="{{ asset('images/neo.png') }}"
alt="Neo Markets"
class="img-fluid"
style="max-width: 320px;"
>
</a>
</div>
</div>
</div>
<!-- Partner End -->

@endsection
