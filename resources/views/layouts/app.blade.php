<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'ThePipLab') }}</title>
    <meta name="keywords" content="Trading Services">
    <meta name="description" content="Financial Market Education">

    <link href="{{ asset('images/piplabLogo.png') }}" rel="icon">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ✅ Your centralized CSS (ALL styles moved here) --}}
    <link href="{{ asset('assets/css/app-modern.css') }}" rel="stylesheet">

    {{-- ✅ page/partial extra CSS --}}
    @stack('head')

    {{-- Google tag --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6NR944DQZ9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6NR944DQZ9');
    </script>

    {{-- Trustpilot (ONLY ONCE) --}}
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
</head>

<body class="tpl-body">

    @include('partials.topbar_modern')
    @include('partials.navbar_modern')
    @include('partials.price_ticker_modern')

    <main class="tpl-main">
        @yield('content')
    </main>

    @include('partials.footer_modern')

    <button class="tpl-backtop btn btn-primary rounded-circle shadow" type="button" aria-label="Back to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ✅ Smooth mobile scroll + correct selector + passive listener --}}
    <script>
        const btn = document.querySelector('.tpl-backtop');
        const nav = document.querySelector('.tpl-nav');

        let ticking = false;

        function updateOnScroll(){
            const y = window.scrollY || 0;

            if (btn) btn.classList.toggle('show', y > 600);

            if (nav) {
                const should = y > 10;
                if (should !== nav.classList.contains('scrolled')) {
                    nav.classList.toggle('scrolled', should);
                }
            }

            ticking = false;
        }

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateOnScroll);
                ticking = true;
            }
        }, { passive: true });

        btn?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    </script>

    @stack('scripts')
</body>
</html>
