{{-- resources/views/layout_custom/app.blade.php --}}

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

    {{-- Trustpilot --}}
    <script src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>

    {{-- ======================================================
         BASE DESIGN SYSTEM
    ======================================================= --}}
    <style>
        :root{
            --tpl-primary: #06a3da;
            --tpl-accent: #39d5ff;
            --tpl-white: #ffffff;
            --tpl-ink: #0b1220;
            --tpl-muted: #667085;
            --tpl-border: rgba(2, 6, 23, .10);
            --tpl-radius: 18px;
            --tpl-shadow: 0 12px 32px rgba(2, 6, 23, .08);
        }

        html, body{
            height: 100%;
        }

        body.tpl-body{
            margin: 0;
            font-family: "Manrope", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: #ffffff;
            color: var(--tpl-ink);
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;

            /* ✅ CRITICAL FIX */
            min-height: 100vh;
        }

        img{
            max-width: 100%;
            height: auto;
        }

        .tpl-main{
            flex: 1 1 auto; /* ✅ pushes footer down */
        }

        section{
            padding: 0 !important;
            margin: 0 !important;
        }

        .section-muted{
            background: #ffffff;
            border: 0 !important;
        }

        .tpl-section-inner{
            padding-top: clamp(3rem, 6vw, 5rem);
            padding-bottom: clamp(3rem, 6vw, 5rem);
        }

        .tpl-card{
            background: #ffffff;
            border: 1px solid var(--tpl-border);
            border-radius: var(--tpl-radius);
            box-shadow: var(--tpl-shadow);
        }

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

    @stack('head')

    {{-- Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6NR944DQZ9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6NR944DQZ9');
    </script>
</head>

{{-- ======================================================
     ✅ BODY STRUCTURE (FIXED)
====================================================== --}}
<body class="tpl-body d-flex flex-column">

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

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Back to top
        const btn = document.querySelector('.tpl-backtop');
        window.addEventListener('scroll', () => {
            btn?.classList.toggle('show', window.scrollY > 600);
        }, { passive: true });

        btn?.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Navbar scroll effect
        const nav = document.querySelector('.tpl-nav');
        window.addEventListener('scroll', () => {
            nav?.classList.toggle('scrolled', window.scrollY > 10);
        }, { passive: true });
    </script>

    @stack('scripts')
</body>
</html>
