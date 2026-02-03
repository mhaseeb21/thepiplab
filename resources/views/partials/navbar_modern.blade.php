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
