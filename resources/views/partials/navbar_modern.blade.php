{{-- resources/views/partials/navbar_modern.blade.php --}}

<nav class="navbar navbar-expand-lg tpl-nav sticky-top" aria-label="Primary navigation">
    <div class="container-fluid px-4 px-lg-5">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="ThePipLab" class="tpl-logo">
            <span class="tpl-brand-text d-none d-sm-inline">ThePipLab</span>
        </a>

        <button class="navbar-toggler tpl-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="tpl-toggler-line"></span>
            <span class="tpl-toggler-line"></span>
            <span class="tpl-toggler-line"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav align-items-lg-center gap-lg-2 ms-auto">

                <li class="nav-item">
                    <a href="{{ route('home') }}"
                       class="nav-link tpl-navlink {{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about') }}"
                       class="nav-link tpl-navlink {{ request()->routeIs('about') ? 'active' : '' }}">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('services') }}"
                       class="nav-link tpl-navlink {{ request()->routeIs('services') ? 'active' : '' }}">
                        Services
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('Live') }}"
                       class="nav-link tpl-navlink {{ request()->routeIs('Live') ? 'active' : '' }}">
                        Live Prices
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('signals.results') }}"
                       class="nav-link tpl-navlink {{ request()->routeIs('signals.results') ? 'active' : '' }}">
                        Market Analysis
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('posts.public.index') }}"
                       class="nav-link tpl-navlink {{ request()->routeIs('posts.public.index') ? 'active' : '' }}">
                        Market Insights
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link tpl-navlink dropdown-toggle {{ request()->routeIs('client.login') || request()->routeIs('client.register') ? 'active' : '' }}"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown"
                       aria-expanded="false">
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
                    <a href="https://wa.me/447377277479" class="btn tpl-cta" role="button">
                        <i class="bi bi-whatsapp me-2"></i>Contact
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

@once
<style>
/* =========================================================
   ThePipLab Navbar – Smooth Mobile Optimized
   Primary: #06a3da | Accent: #39d5ff
========================================================= */

/* Navbar shell */
.tpl-nav{
    background: linear-gradient(135deg, #0f1419 0%, #1a1f2e 100%);
    border-bottom: 1px solid rgba(57, 213, 255, 0.10);
    z-index: 1030;

    /* keep transitions light (avoid "transition: all") */
    transition: box-shadow .2s ease, border-color .2s ease, background .2s ease;

    /* ✅ default: NO blur on mobile to avoid lag */
    box-shadow: 0 8px 24px rgba(0,0,0,.28);
}

/* ✅ enable blur only on desktop (usually smoother GPU) */
@media (min-width: 992px){
    .tpl-nav{
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 10px 30px rgba(0,0,0,.30);
    }
}

/* scrolled state (applied via JS) */
.tpl-nav.scrolled{
    box-shadow: 0 12px 44px rgba(0,0,0,.38);
    border-bottom: 1px solid rgba(6, 163, 218, 0.16);
}

/* Brand */
.tpl-logo{
    height: 40px;
    width: auto;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(6, 163, 218, 0.18);
    transition: transform .25s ease;
}
.tpl-logo:hover{ transform: scale(1.05); }

.tpl-brand-text{
    font-weight: 900;
    letter-spacing: -0.02em;
    font-size: 1.1rem;
    background: linear-gradient(135deg, #39d5ff 0%, #06a3da 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Links */
.tpl-navlink{
    position: relative;
    font-weight: 800;
    color: rgba(255,255,255,.82) !important;
    padding: .6rem 1rem !important;
    border-radius: 10px;
    line-height: 1.1;
    transition: color .18s ease, background .18s ease, transform .18s ease;
}
.tpl-navlink:hover{
    color: #39d5ff !important;
    transform: translateY(-2px);
}
.tpl-navlink.active{
    color: #39d5ff !important;
    border-bottom: 2px solid #39d5ff;
}

/* Dropdown */
.tpl-dropdown{
    border-radius: 14px;
    border: 1px solid rgba(57, 213, 255, 0.20);
    background: rgba(15, 20, 25, 0.98);
    box-shadow: 0 20px 48px rgba(0, 0, 0, 0.50);
    padding: .5rem;
    overflow: hidden;
    min-width: 240px;
}

/* keep blur only on desktop for dropdown too */
@media (min-width: 992px){
    .tpl-dropdown{
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }
}

.tpl-dropdown .dropdown-item{
    border-radius: 12px;
    padding: .7rem .85rem;
    font-weight: 700;
    color: rgba(255,255,255,.82);
    transition: background .18s ease, color .18s ease, transform .18s ease;
}
.tpl-dropdown .dropdown-item:hover{
    background: rgba(6, 163, 218, 0.25);
    color: #39d5ff;
    transform: translateX(4px);
}

/* CTA */
.tpl-cta{
    background: linear-gradient(135deg, #06a3da 0%, #0288c6 100%);
    border: 1px solid rgba(57, 213, 255, 0.40);
    color: #ffffff;
    border-radius: 999px;
    font-weight: 900;
    padding: .75rem 1.2rem;
    box-shadow: 0 8px 18px rgba(6, 163, 218, 0.26);
    transition: transform .18s ease, box-shadow .18s ease, background .18s ease, border-color .18s ease;
    white-space: nowrap;
}
.tpl-cta:hover{
    background: linear-gradient(135deg, #39d5ff 0%, #06a3da 100%);
    border-color: #39d5ff;
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(6, 163, 218, 0.34);
}
.tpl-cta:active{ transform: translateY(-1px); }

/* Hamburger */
.tpl-toggler{
    border: 1px solid rgba(57, 213, 255, 0.25);
    border-radius: 14px;
    padding: .55rem .6rem;
    background: rgba(57, 213, 255, 0.08);
    transition: background .18s ease, border-color .18s ease, box-shadow .18s ease;
}
.tpl-toggler:hover{
    background: rgba(57, 213, 255, 0.12);
    border-color: rgba(57, 213, 255, 0.40);
}
.tpl-toggler:focus{
    box-shadow: 0 0 0 .25rem rgba(57, 213, 255, 0.35);
    outline: none;
}
.tpl-toggler-line{
    width: 22px;
    height: 2.5px;
    background: rgba(255,255,255,.88);
    display: block;
    border-radius: 999px;
}
.tpl-toggler-line + .tpl-toggler-line{ margin-top: 5px; }

/* =========================================================
   ✅ Mobile performance fixes
========================================================= */
@media (max-width: 991.98px){
    /* Bootstrap collapse animation is height-based:
       contain + will-change reduces repaint cost */
    #navbarCollapse{
        contain: layout paint;
        will-change: height;
    }

    /* remove hover transforms on mobile */
    .tpl-navlink:hover{
        transform: none;
    }

    /* make CTA full-width */
    .tpl-cta{
        width: 100%;
        justify-content: center;
        display: inline-flex;
        margin-top: .5rem;
    }
}

/* Keyboard accessibility */
.tpl-navlink:focus-visible,
.tpl-cta:focus-visible{
    outline: 2px solid rgba(57, 213, 255, 0.6);
    outline-offset: 3px;
}
</style>
@endonce
