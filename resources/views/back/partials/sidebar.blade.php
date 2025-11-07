<nav class="sidebar-nav">
    <div class="nav-section">
        <div class="nav-section-title">Gestion des contenus</div>
        <div class="nav-item">
            <a href="{{ route("dashboard.audios") }}" class="nav-link {{ request()->routeIs("dashboard.audios") ? "active" : "" }}">
                <i class="fas fa-microphone-alt"></i>
                <span>Podcasts audio</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.audiosList") }}" class="nav-link {{ request()->routeIs("dashboard.audiosList") ? "active" : "" }}">
                <i class="fa-solid fa-list"></i>
                <span>Liste des podcasts audio</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.videos") }}" class="nav-link {{ request()->routeIs("dashboard.videos") ? "active" : "" }}">
                <i class="fas fa-video"></i>
                <span>Podcasts Vidéo</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.videosList") }}" class="nav-link {{ request()->routeIs("dashboard.videosList") ? "active" : "" }}">
                <i class="fa-solid fa-table-list"></i>
                <span>Liste des podcasts vidéos</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.articles") }}" class="nav-link {{ request()->routeIs("dashboard.articles") ? "active" : "" }}">
                <i class="fas fa-newspaper"></i>
                <span>Publier un Article</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.articlesListe") }}" class="nav-link {{ request()->routeIs("dashboard.articlesListe") ? "active" : "" }}">
                <i class="fas fa-folder-open"></i>
                <span>Tous les Articles</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.programmes") }}" class="nav-link {{ request()->routeIs("dashboard.programmes") ? "active" : "" }}">
                <i class="fas fa-clock"></i>
                <span>Horaires des programmes</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.programmesList") }}" class="nav-link {{ request()->routeIs("dashboard.programmesList") ? "active" : "" }}">
                <i class="fas fa-clock"></i>
                <span>Grille des programmes</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.communiques") }}" class="nav-link {{ request()->routeIs("dashboard.communiques") ? "active" : "" }}">
                <i class="fas fa-newspaper"></i>
                <span>Publier un Communiqué</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.communiques.liste") }}" class="nav-link {{ request()->routeIs("dashboard.communiques.liste") ? "active" : "" }}">
                <i class="fas fa-clock"></i>
                <span>Tout les communiques</span>
            </a>
        </div>
    </div>

    <div class="nav-section">
        <div class="nav-section-title">Audience & Communication</div>
        <div class="nav-item">
            <a href="{{ route("dashboard.newsletters") }}" class="nav-link {{ request()->routeIs("dashboard.newsletters") ? "active" : "" }}">
                <i class="fas fa-envelope-open-text"></i>
                <span>Newsletters</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.newslettersListe") }}" class="nav-link {{ request()->routeIs("dashboard.newslettersListe") ? "active" : "" }}">
                <i class="fa-solid fa-list"></i>
                <span>Newsletters envoyées</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.abonnes") }}" class="nav-link {{ request()->routeIs("dashboard.abonnes") ? "active" : "" }}">
                <i class="fas fa-users"></i>
                <span>Abonnés</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.inscrits") }}" class="nav-link {{ request()->routeIs("dashboard.inscrits") ? "active" : "" }}">
                <i class="fas fa-user"></i>
                <span>Inscrits</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.events.create") }}" class="nav-link {{ request()->routeIs("dashboard.events.create") ? "active" : "" }}">
                <i class="fa-solid fa-calendar"></i>
                <span>Evènements</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.events.liste") }}" class="nav-link {{ request()->routeIs("dashboard.events.liste") ? "active" : "" }}">
                <i class="fas fa-list"></i>
                <span>Liste des évènements</span>
            </a>
        </div>
        {{-- <div class="nav-item">
            <a href="{{ route("dashboard.sondages") }}" class="nav-link {{ request()->routeIs("dashboard.sondages") ? "active" : "" }}">
                <i class="fas fa-poll"></i>
                <span>Sondages</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.sondagesListe") }}" class="nav-link {{ request()->routeIs("dashboard.sondagesListe") ? "active" : "" }}">
                <i class="fa-solid fa-table-list"></i>
                <span>Liste des sondages</span>
            </a>
        </div> --}}
    </div>

    <div class="nav-section">
        <div class="nav-section-title">Gestion interne</div>
        <div class="nav-item">
            <a href="{{ route("dashboard.redacteurs") }}" class="nav-link {{ request()->routeIs("dashboard.redacteurs") ? "active" : "" }}">
                <i class="fas fa-user-plus"></i>
                <span>Ajouter un redacteur</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route("dashboard.redacteursListe") }}" class="nav-link {{ request()->routeIs("dashboard.redacteursListe") ? "active" : "" }}">
                <i class="fas fa-users"></i>
                <span>Liste des redacteurs</span>
            </a>
        </div>
    </div>
</nav>