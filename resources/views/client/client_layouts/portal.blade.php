<!doctype html>
<html lang="en">
<head>
    <title>ThePipLab – Client Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link href="{{ asset('images/piplabLogo.png') }}" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Client Portal CSS -->
    <link href="{{ asset('assets/client/css/client-portal.css') }}" rel="stylesheet">

    {{-- DASHBOARD BASE STYLES --}}
    <style>
        :root{
            /* PipLab Brand */
            --pl-blue: #06a3da;
            --pl-black: #000000;
            --pl-white: #ffffff;

            /* Layout */
            --content-bg: #ffffff;
            --content-border: rgba(0,0,0,.08);
            --text-main: #0b1220;
            --text-muted: #6b7280;
        }

        body{
            font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: var(--content-bg);
            color: var(--text-main);
            margin: 0;
        }

        /* MAIN WRAPPER */
        .dashboard-wrapper{
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* MAIN COLUMN */
        .dashboard-main{
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background: var(--content-bg);
        }

        /* MOBILE TOP BAR */
        .dashboard-topbar{
            background: var(--pl-white);
            border-bottom: 1px solid var(--content-border);
            padding: .75rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dashboard-topbar .title{
            font-weight: 600;
            font-size: .95rem;
        }

        .dashboard-topbar .btn-outline-primary{
            color: var(--pl-blue);
            border-color: var(--pl-blue);
        }
        .dashboard-topbar .btn-outline-primary:hover{
            background: var(--pl-blue);
            color: #fff;
        }

        /* CONTENT AREA */
        .dashboard-content{
            padding: clamp(1rem, 2vw, 2rem);
            background: var(--content-bg);
        }

        /* PAGE WRAPPER (OPTIONAL – REMOVE IF YOU WANT FULL-WIDTH) */
        .dashboard-page{
            background: var(--pl-white);
            border: 1px solid var(--content-border);
            border-radius: 14px;
            padding: clamp(1rem, 2vw, 1.75rem);
        }

        /* OFFCANVAS */
        .offcanvas{
            background: var(--pl-black);
            color: #fff;
        }

        .offcanvas-header{
            border-bottom: 1px solid rgba(255,255,255,.12);
        }

        .offcanvas-title{
            font-size: .95rem;
            font-weight: 600;
        }

        @media (max-width: 991.98px){
            .dashboard-page{
                border-radius: 10px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="dashboard-wrapper">

    {{-- DESKTOP SIDEBAR (BLACK) --}}
    <aside class="d-none d-lg-block">
        @include('client.sidebar')
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="dashboard-main">

        {{-- MOBILE TOP BAR --}}
        <div class="dashboard-topbar d-lg-none">
            <button class="btn btn-outline-primary btn-sm"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#mobileSidebar">
                <i class="fas fa-bars"></i>
            </button>

            <div class="title">Client Portal</div>

            <a href="{{ route('client.logout') }}" class="btn btn-outline-danger btn-sm">
                Logout
            </a>
        </div>

        {{-- PAGE CONTENT --}}
        <main class="dashboard-content">
            <div class="dashboard-page">
                @yield('content')
            </div>
        </main>

    </div>
</div>

{{-- MOBILE SIDEBAR --}}
<div class="offcanvas offcanvas-start d-lg-none"
     tabindex="-1"
     id="mobileSidebar">

    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">
        @include('client.sidebar')
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')
</body>
</html>
