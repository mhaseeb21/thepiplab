<nav class="navbar navbar-expand-lg tpl-nav sticky-top" aria-label="Primary navigation">
    <div class="container-fluid px-4 px-lg-5">

        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="ThePipLab" class="tpl-logo">
            <span class="tpl-brand-text d-none d-sm-inline">ThePipLab</span>
        </a>

        <button class="navbar-toggler tpl-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="tpl-toggler-line"></span>
            <span class="tpl-toggler-line"></span>
            <span class="tpl-toggler-line"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav align-items-lg-center gap-lg-2 ms-auto">

                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link tpl-navlink {{ request()->routeIs('home') ? 'active' : '' }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link tpl-navlink {{ request()->routeIs('about') ? 'active' : '' }}">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('services') }}" class="nav-link tpl-navlink {{ request()->routeIs('services') ? 'active' : '' }}">
                            Services
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('Live') }}" class="nav-link tpl-navlink {{ request()->routeIs('Live') ? 'active' : '' }}">
                            Live Prices
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('signals.results') }}" class="nav-link tpl-navlink {{ request()->routeIs('signals.results') ? 'active' : '' }}">
                            Market Analysis
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('posts.public.index') }}" class="nav-link tpl-navlink {{ request()->routeIs('posts.public.index') ? 'active' : '' }}">
                            Market Insights
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link tpl-navlink dropdown-toggle {{ request()->routeIs('client.login') || request()->routeIs('client.register') ? 'active' : '' }}"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Login / Signup
                        </a>

                        <ul class="dropdown-menu tpl-dropdown dropdown-menu-end">
                            <li>
                                <a href="{{ route('client.login') }}" class="dropdown-item">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('client.register') }}" class="dropdown-item">
                                    <i class="bi bi-person-plus me-2"></i>Sign Up
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ms-lg-2 mt-3 mt-lg-0">
                        <a href="https://wa.me/447377277480" class="btn tpl-cta" role="button">
                            <i class="bi bi-whatsapp me-2"></i>Contact
                        </a>
                    </li>

            </ul>
        </div>

    </div>
</nav>
@once

<style>
    /* Navbar shell - Black background with modern glassmorphism */
    .tpl-nav{
        background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(57, 213, 255, 0.1);
        z-index: 1030;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    }

    .tpl-nav.scrolled {
        box-shadow: 0 12px 48px rgba(0, 0, 0, 0.4);
        border-bottom: 1px solid rgba(6, 163, 218, 0.15);
    }

    /* Brand - Enhanced for dark background */
    .tpl-logo{
        height: 40px;
        width: auto;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(6, 163, 218, 0.2);
        transition: transform 0.3s ease;
    }

    .tpl-logo:hover {
        transform: scale(1.05);
    }

    .tpl-brand-text{
        font-weight: 900;
        letter-spacing: -.02em;
        color: #ffffff;
        font-size: 1.1rem;
        background: linear-gradient(135deg, #39d5ff 0%, #06a3da 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Links - Light text on dark background */
    .tpl-navlink{
        position: relative;
        font-weight: 800;
        color: rgba(255, 255, 255, 0.8) !important;
        padding: .6rem 1rem !important;
        border-radius: 8px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        line-height: 1.1;
    }

    .tpl-navlink:hover{
        color: #39d5ff !important;
        transform: translateY(-2px);
    }

    .tpl-navlink.active{
        color: #39d5ff !important;
        border-bottom: 2px solid #39d5ff;
    }

    /* Dropdown - Dark themed */
    .tpl-dropdown{
        border-radius: 12px;
        border: 1px solid rgba(57, 213, 255, 0.2);
        background: rgba(15, 20, 25, 0.98);
        box-shadow: 0 20px 48px rgba(0, 0, 0, 0.5);
        padding: .5rem;
        overflow: hidden;
        min-width: 240px;
        backdrop-filter: blur(12px);
    }

    .tpl-dropdown .dropdown-item{
        border-radius: 12px;
        padding: .7rem .85rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .tpl-dropdown .dropdown-item:hover{
        background: rgba(6, 163, 218, 0.25);
        color: #39d5ff;
        transform: translateX(4px);
    }

    /* CTA button - Enhanced */
    .tpl-cta{
        background: linear-gradient(135deg, #06a3da 0%, #0288c6 100%);
        border: 1px solid rgba(57, 213, 255, 0.4);
        color: #ffffff;
        border-radius: 999px;
        font-weight: 900;
        padding: .75rem 1.2rem;
        box-shadow: 0 8px 20px rgba(6, 163, 218, 0.3);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
    }

    .tpl-cta:hover{
        background: linear-gradient(135deg, #39d5ff 0%, #06a3da 100%);
        border-color: #39d5ff;
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(6, 163, 218, 0.4);
    }

    .tpl-cta:active {
        transform: translateY(-1px);
    }

    /* Custom hamburger - Dark themed */
    .tpl-toggler{
        border: 1px solid rgba(57, 213, 255, 0.25);
        border-radius: 14px;
        padding: .55rem .6rem;
        background: rgba(57, 213, 255, 0.08);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.2s ease;
    }

    .tpl-toggler:hover {
        background: rgba(57, 213, 255, 0.12);
        border-color: rgba(57, 213, 255, 0.4);
    }

    .tpl-toggler:focus{
        box-shadow: 0 0 0 .25rem rgba(57, 213, 255, 0.35);
        outline: none;
    }

    .tpl-toggler-line{
        width: 22px;
        height: 2.5px;
        background: rgba(255, 255, 255, 0.85);
        display: block;
        border-radius: 999px;
        transition: all 0.3s ease;
    }

    .tpl-toggler-line + .tpl-toggler-line{ margin-top: 5px; }

    /* Mobile behavior */
    @media (max-width: 991.98px){
        .navbar-nav {
            gap: 0.5rem !important;
        }
        .tpl-navlink{
            border-radius: 8px;
            padding: .7rem .8rem !important;
        }
        .tpl-cta{
            width: 100%;
            justify-content: center;
            display: inline-flex;
            margin-top: .5rem;
        }
    }

    /* keyboard accessibility */
    .tpl-navlink:focus-visible,
    .tpl-cta:focus-visible{
        outline: 2px solid rgba(57, 213, 255, 0.6);
        outline-offset: 3px;
    }
</style>

@endonce