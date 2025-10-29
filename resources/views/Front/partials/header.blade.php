<div class="animated-bg"></div>

<!-- Mobile Menu Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>

<!-- Mobile Navigation -->
<nav class="mobile-nav" id="mobileNav">
    <a href="{{ route("ortn.home") }}" class="mobile-nav-item {{ request()->routeIS("ortn.home") ? "active" : "" }}">Accueil</a>
    <a href="{{ route("ortn.actualites") }}" class="mobile-nav-item {{ request()->routeIS("ortn.actualites") ? "active" : "" }}">Actualités</a>
    <a href="{{ route("ortn.programmes") }}" class="mobile-nav-item {{ request()->routeIS("ortn.programmes") ? "active" : "" }}">Programmes</a>
    <a href="{{ route("ortn.podcasts") }}" class="mobile-nav-item {{ request()->routeIS("ortn.podcasts") ? "active" : "" }}">Podcasts</a>
    <a href="{{ route("ortn.evenements") }}" class="mobile-nav-item {{ request()->routeIS("ortn.evenements") ? "active" : "" }}">Évènements</a>
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
                <a href="{{ route("ortn.podcasts") }}" class="nav-item {{ request()->routeIS("ortn.podcasts") ? "active" : "" }}">Podcasts</a>
                <a href="{{ route("ortn.evenements") }}" class="nav-item {{ request()->routeIs("ortn.evenements") ? "active" : "" }}">Évènements</a>
                <a href="{{ route("ortn.about") }}" class="nav-item {{ request()->routeIs("ortn.about") ? "active" : "" }}">À propos</a>
                <a href="{{ route("ortn.contact") }}" class="nav-item {{ request()->routeIs("ortn.contact") ? "active" : "" }}">Contact</a>
            </nav>

            <div class="header-actions">
                <button class="live-indicator">
                    <span class="live-dot"></span>
                    EN DIRECT
                </button>
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>