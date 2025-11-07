<style>
    * {
        list-style: none;
    }

    .dropdown-menu {
        display: none;
        flex-direction: column;
        background: #fff;
        border-radius: 8px;
        padding: 10px;
    }

    .dropdown-menu.show {
        display: flex;
    }

    .mobile-nav-item.active {
        background: #1F5F3F;
        color: #fff;
        padding: 10px;
        border-radius: 50px;
    }

</style>
<div class="animated-bg"></div>

<!-- Mobile Menu Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>

<!-- Mobile Navigation -->
<nav class="mobile-nav" id="mobileNav">
    <a href="{{ route("ortn.home") }}" class="mobile-nav-item {{ request()->routeIS("ortn.home") ? "active" : "" }}">Accueil</a>
    <a href="{{ route("ortn.actualites") }}" class="mobile-nav-item {{ request()->routeIS("ortn.actualites") ? "active" : "" }}">Actualités</a>
    <a href="{{ route("ortn.programmes") }}" class="mobile-nav-item {{ request()->routeIS("ortn.programmes") ? "active" : "" }}">Programmes</a>
    <a href="{{ route("ortn.podcasts") }}" class="mobile-nav-item {{ request()->routeIS("ortn.podcasts") ? "active" : "" }}">Podcasts audios</a>
    <a href="{{ route("ortn.podcastsvideos") }}" class="mobile-nav-item {{ request()->routeIS("ortn.podcastsvideos") ? "active" : "" }}">Podcasts videos</a>
    <a href="{{ route("ortn.evenements") }}" class="mobile-nav-item {{ request()->routeIS("ortn.evenements") ? "active" : "" }}">Évènements</a>
    <a href="{{ route("ortn.communiques") }}" class="mobile-nav-item {{ request()->routeIS("ortn.communiques") ? "active" : "" }}">Communiqués</a>
    <a href="#" class="mobile-nav-item">À propos</a>
    <a href="{{ route("ortn.contact") }}" class="mobile-nav-item {{ request()->routeIs("ortn.contact") ? "active" : "" }}">Contact</a>
</nav>

<!-- Header -->
<header class="main-header">
    <div class="container">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-radio"></i>
                </div>
                <div class="logo-text">
                    <h1>ORTN</h1>
                    <span>Radio & TV de Ngazidja</span>
                </div>
            </div>

            <nav class="main-nav">
                <a href="{{ route("ortn.home") }}" class="nav-item {{ request()->routeIS("ortn.home") ? "active" : "" }}">Accueil</a>
                <a href="{{ route("ortn.actualites") }}" class="nav-item {{ request()->routeIs("ortn.actualites") ? "active" : "" }}">Actualités</a>
                <a href="{{ route("ortn.programmes") }}" class="nav-item {{ request()->routeIS("ortn.programmes") ? "active" : "" }}">Programmes</a>
                {{-- <a href="{{ route("ortn.podcasts") }}" class="nav-item {{ request()->routeIS("ortn.podcasts") ? "active" : "" }}">Podcasts</a> --}}
                
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('ortn.podcasts') ? 'active' : '' }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Podcasts
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item {{ request()->routeIs('ortn.podcasts') ? 'active' : '' }}" href="{{ route('ortn.podcasts') }}">Audios</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('ortn.podcastsvideos') ? 'active' : '' }}" href="{{ route('ortn.podcastsvideos') }}">Vidéos</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('ortn.podcasts') ? 'active' : '' }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Communications
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a href="{{ route("ortn.evenements") }}" class="dropdown-item {{ request()->routeIs("ortn.evenements") ? "active" : "" }}">Évènements</a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('ortn.communiques') ? 'active' : '' }}" href="{{ route('ortn.communiques') }}">communiqués</a>
                        </li>
                    </ul>
                </li>

                
                <a href="{{ route("ortn.about") }}" class="nav-item {{ request()->routeIs("ortn.about") ? "active" : "" }}">À propos</a>
                <a href="{{ route("ortn.contact") }}" class="nav-item {{ request()->routeIs("ortn.contact") ? "active" : "" }}">Contact</a>
            </nav>

            @guest
                <div class="header-actions">
                    <a href="{{ route("ortn.login") }}" class="live-indicator">
                        <span class="live-dot"></span>
                        Connexion
                    </a>
                    <button class="mobile-menu-btn" id="mobileMenuBtn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            @endguest

            @auth
                @if (auth()->user()->role == "admin" || auth()->user()->role == "redacteur")
                        <li class="nav-item dropdown header-actions">
                            <span class="dropdown-toggle live-indicator" style="background: #003366" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="live-dot"></span>
                                Mon espace
                            </span>

                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li>
                                    <form action="{{ route("ortn.logout") }}" method="POST" onclick="return confirm('voulez-vous vous déconnecté ?')">
                                        @csrf
                                        <button type="submit" class="dropdown-item" href="{{ route('ortn.login') }}" style="color: crimson">
                                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route("dashboard.audios") }}">
                                        <i class="fas fa-tools"></i> Administration
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <button class="mobile-menu-btn" id="mobileMenuBtn">
                            <i class="fas fa-bars"></i>
                        </button>
                    @else
                        <li>
                            <form action="{{ route("ortn.logout") }}" method="POST" onclick="return confirm('voulez-vous vous déconnecté ?')" class="live-indicator" style="background: crimson">
                                @csrf
                                <button type="submit" class="dropdown-item" href="{{ route('ortn.login') }}">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        </li>

                        <button class="mobile-menu-btn" id="mobileMenuBtn">
                            <i class="fas fa-bars"></i>
                        </button>
                @endif
            @endauth

        </div>
    </div>
</header>