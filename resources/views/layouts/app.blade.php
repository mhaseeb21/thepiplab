{{-- resources/views/layout_custom/app.blade.php --}}

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ✅ Title + basic SEO --}}
    <title>@yield('title', config('app.name', 'ThePipLab'))</title>
    <meta name="keywords" content="@yield('meta_keywords', 'Trading Services')">
    <meta name="description" content="@yield('meta_description', 'Financial Market Education')">

    {{-- ✅ Canonical --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- ✅ Favicon --}}
    <link href="{{ asset('images/piplabLogo.png') }}" rel="icon">

    {{-- ✅ Default Open Graph / Twitter --}}
    @php
        $siteName = config('app.name', 'ThePipLab');

        // WhatsApp prefers absolute https URLs
        $pageUrl = url()->current();
        $defaultOgImage = secure_url('images/piplabLogo.png');

        $ogTitle = trim($__env->yieldContent('og_title')) ?: trim($__env->yieldContent('title')) ?: $siteName;
        $ogDesc  = trim($__env->yieldContent('og_description')) ?: trim($__env->yieldContent('meta_description')) ?: 'Financial Market Education';

        $ogImageRaw = trim($__env->yieldContent('og_image')) ?: $defaultOgImage;

        // If page passes a relative path accidentally, force absolute
        $ogImage = \Illuminate\Support\Str::startsWith($ogImageRaw, ['http://', 'https://'])
            ? $ogImageRaw
            : secure_url(ltrim($ogImageRaw, '/'));

        $ogType  = trim($__env->yieldContent('og_type')) ?: 'website';
    @endphp

    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:url" content="{{ $pageUrl }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:secure_url" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- ✅ FIXED: twitter meta (name="twitter:card") --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- ✅ Allow pages to override OG/Twitter tags if needed --}}
    @stack('meta')

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

        html, body{ height: 100%; }

        body{
            margin: 0;
            font-family: "Manrope", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: #ffffff;
            color: var(--tpl-ink);
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        img{ max-width: 100%; height: auto; }

        /* ✅ Footer overlap FIX */
        body.tpl-body{
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main.tpl-main{
            flex: 1 1 auto;
        }

        section{ margin: 0; }

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

    {{-- page/partial CSS goes here --}}
    @stack('head')

    {{-- Google tag --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-6NR944DQZ9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-6NR944DQZ9');
    </script>
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
        // Back to top
        const btn = document.querySelector('.tpl-backtop');
        window.addEventListener('scroll', () => {
            btn?.classList.toggle('show', window.scrollY > 600);
        }, { passive: true });

        btn?.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Navbar scrolled state
        const nav = document.querySelector('.tpl-nav');
        window.addEventListener('scroll', () => {
            nav?.classList.toggle('scrolled', window.scrollY > 10);
        }, { passive: true });
    </script>

    @stack('scripts')
</body>
</html>
