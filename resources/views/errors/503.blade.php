@extends('layouts.app')

@section('title', 'Something went wrong')

@section('content')
<section class="tpl-auth">
  <div class="container-fluid px-4 px-lg-5">
    <div class="tpl-wrap tpl-section-inner">
      <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6 col-xl-5">
          <div class="tpl-auth-card text-center">
            <div class="tpl-auth-head">
              <span class="tpl-kicker">
                <i class="bi bi-exclamation-triangle-fill"></i>
                Oops
              </span>
              <h1 class="tpl-auth-title">We’re having a temporary issue</h1>
              <p class="tpl-auth-sub">
                Please refresh the page or try again in a few minutes.
              </p>
            </div>

            <a href="{{ route('home') }}" class="tpl-btn-primary w-100">Go to Homepage</a>

            <div class="tpl-auth-footer">
              If it keeps happening, contact support.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
