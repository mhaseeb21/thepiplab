<div class="tpl-topbar d-none d-lg-block">
    <div class="container-fluid px-4 px-lg-5">
        <div class="tpl-topbar-inner d-flex align-items-center justify-content-between">

            <a href="javascript:void(0)" class="tpl-powered text-decoration-none" aria-label="Powered by Neo Markets">
                <span class="tpl-powered-chip">
                    <span class="tpl-powered-muted">Powered by</span>
                    <img src="{{ asset('images/neo.png') }}" alt="Neo Markets" class="tpl-powered-logo">
                    <span class="tpl-powered-name">Neo Markets</span>
                </span>
            </a>

            <div class="d-flex align-items-center gap-2">
                <a class="tpl-social" href="https://www.instagram.com/the.pip.lab/profilecard/?igsh=cjYwZnp1dmV5c3lr"
                   target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>

                <a class="tpl-social" href="https://www.facebook.com/thepiplabofficial"
                   target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>

                <a class="tpl-social" href="https://t.me/The_piplab"
                   target="_blank" rel="noopener noreferrer" aria-label="Telegram">
                    <i class="bi bi-telegram"></i>
                </a>
            </div>

        </div>
    </div>
</div>

@once
<style>
    .tpl-topbar{
        position: relative;
        z-index: 1035;
        background: rgba(255,255,255,.75);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid rgba(2,6,23,.08);
    }

    .tpl-topbar-inner{
        padding: .55rem 0;
    }

    .tpl-powered-chip{
        display: inline-flex;
        align-items: center;
        gap: .6rem;
        padding: .35rem .65rem;
        border-radius: 999px;
        border: 1px solid rgba(2,6,23,.08);
        background: rgba(255,255,255,.85);
        box-shadow: 0 8px 22px rgba(2,6,23,.06);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }

    .tpl-powered-chip:hover{
        transform: translateY(-1px);
        border-color: rgba(57,213,255,.55);
        box-shadow: 0 12px 28px rgba(2,6,23,.10);
    }

    .tpl-powered-muted{
        font-size: .82rem;
        font-weight: 700;
        color: rgba(11,18,32,.55);
        letter-spacing: .2px;
    }

    .tpl-powered-logo{
        height: 22px;
        width: auto;
        border-radius: 6px;
        display: inline-block;
    }

    .tpl-powered-name{
        font-weight: 800;
        font-size: .92rem;
        letter-spacing: .2px;
        color: #0b1220;
    }

    .tpl-social{
        width: 36px;
        height: 36px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(2,6,23,.10);
        background: rgba(255,255,255,.80);
        color: rgba(11,18,32,.80);
        box-shadow: 0 10px 26px rgba(2,6,23,.06);
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease, color .18s ease;
        text-decoration: none;
    }

    .tpl-social:hover{
        transform: translateY(-1px);
        border-color: rgba(6,163,218,.55);
        color: var(--tpl-primary);
        box-shadow: 0 14px 34px rgba(2,6,23,.10);
    }

    .tpl-social:focus-visible,
    .tpl-powered:focus-visible{
        outline: 3px solid rgba(57,213,255,.45);
        outline-offset: 3px;
        border-radius: 999px;
    }

    .tpl-social i{
        font-size: 1.05rem;
        line-height: 1;
    }
</style>

@endonce
