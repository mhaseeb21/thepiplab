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
    <!-- TrustBox script -->
<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
<!-- End TrustBox script -->

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ✅ Brand + base tokens + layout system --}}
    <style>
        :root{
            --tpl-primary: #06a3da;
            --tpl-accent:  #39d5ff;
            --tpl-white:   #ffffff;

            --tpl-ink:     #0b1220;
            --tpl-muted:   #667085;

            /* ✅ CHANGED: base page bg is now solid white */
            --tpl-bg:      #ffffff;

            --tpl-card:    #ffffff;
            --tpl-border:  rgba(2, 6, 23, .10);

            --tpl-radius:  18px;
            --tpl-shadow:  0 12px 32px rgba(2, 6, 23, .08);
        }

        /* Basic reset to prevent random gaps */
        html, body{ height: 100%; }

        /* ✅ CHANGED: body background is now pure white */
        body{
            margin: 0;
            font-family: "Manrope", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: #ffffff; /* ✅ pure white */
            color: var(--tpl-ink);
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        img{ max-width: 100%; height: auto; }

        /* Ultra-wide safe wrapper */
        .tpl-wrap{
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
        }
        @media (min-width: 1400px){ .tpl-wrap{ max-width: 1320px; } }
        @media (min-width: 1800px){ .tpl-wrap{ max-width: 1480px; } }
        @media (min-width: 2200px){ .tpl-wrap{ max-width: 1600px; } }

        /* ======================================================
           ✅ SECTION FLOW: NO GAPS BETWEEN SECTIONS
           - wrappers have ZERO padding/margin
           - spacing is handled INSIDE partials via tpl-section-inner
           ====================================================== */
        section{
            padding: 0 !important;
            margin: 0 !important;
        }

        /* ✅ CHANGED: muted sections are also solid white (NO gradient) */
        .section-muted{
            background: #ffffff !important;
            border: 0 !important;
        }

        /* ======================================================
           ✅ INNER SPACING UTILITIES (use inside partials)
           ====================================================== */
        .tpl-section-inner{
            padding-top: clamp(3rem, 6vw, 5rem);
            padding-bottom: clamp(3rem, 6vw, 5rem);
        }
        .tpl-section-inner--sm{
            padding-top: clamp(2.5rem, 5vw, 4rem);
            padding-bottom: clamp(2.5rem, 5vw, 4rem);
        }
        .tpl-section-inner--lg{
            padding-top: clamp(4rem, 8vw, 6.5rem);
            padding-bottom: clamp(4rem, 8vw, 6.5rem);
        }

        /* Card helper (optional) */
        .tpl-card{
            background: var(--tpl-card);
            border: 1px solid var(--tpl-border);
            border-radius: var(--tpl-radius);
            box-shadow: var(--tpl-shadow);
        }

        /* Button helper (optional) */
        .btn-tpl{
            background: var(--tpl-primary);
            border-color: var(--tpl-primary);
            color: #fff;
            border-radius: 999px;
            font-weight: 800;
            padding: .8rem 1.1rem;
        }
        .btn-tpl:hover{
            background: #058fbe;
            border-color:#058fbe;
            color:#fff;
        }

        .btn-tpl-outline{
            background: transparent;
            border: 1px solid var(--tpl-primary);
            color: var(--tpl-primary);
            border-radius: 999px;
            font-weight: 800;
            padding: .8rem 1.1rem;
        }
        .btn-tpl-outline:hover{
            background: var(--tpl-primary);
            color:#fff;
        }

        /* Back to top */
        .tpl-backtop{
            position: fixed;
            right: 18px;
            bottom: 18px;
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
            transition: .2s ease;
            z-index: 9999;
        }
        .tpl-backtop.show{
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }
    </style>

    {{-- ✅ page/partial CSS goes here --}}
    @stack('head')

    {{-- Google tag --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6NR944DQZ9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6NR944DQZ9');
    </script>

    {{-- Trustpilot --}}
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

    <script>
        // Back to top button
        const btn = document.querySelector('.tpl-backtop');
        window.addEventListener('scroll', () => {
            btn?.classList.toggle('show', window.scrollY > 600);
        });
        btn?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

        // Navbar glass effect on scroll
        const nav = document.querySelector('.tpl-navbar');
        window.addEventListener('scroll', () => {
            nav?.classList.toggle('scrolled', window.scrollY > 10);
        });
    </script>

    @stack('scripts')
</body>
</html>
