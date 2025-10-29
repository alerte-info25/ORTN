<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podcasts - ORTN | Office de la Radio et Télévision de Ngazidja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Podcasts/index.css") }}">
</head>
<body>

    @include("Front.partials.loader")

    @include("Front.partials.header")
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <span class="hero-badge">🎧 Découvrez nos contenus audio</span>
                <h1 class="hero-title">
                    Explorez nos <span class="highlight">Podcasts</span>
                </h1>
                <p class="hero-description">
                    Plongez dans l'univers audio de l'ORTN avec nos podcasts exclusifs. Actualités, culture, débats et reportages pour rester connecté à Ngazidja et aux Comores.
                </p>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="container">
            <div class="filter-container">
                <div class="filter-tabs">
                    <button class="filter-btn active">Tous</button>
                    <button class="filter-btn">Actualités</button>
                    <button class="filter-btn">Culture</button>
                    <button class="filter-btn">Société</button>
                    <button class="filter-btn">Sport</button>
                    <button class="filter-btn">Économie</button>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher un podcast...">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Podcast -->
    <section class="featured-section">
        <div class="container">
            <div class="featured-podcast">
                <div class="featured-image">
                    <img src="https://images.unsplash.com/photo-1590602847861-f357a9332bbc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Podcast Featured">
                    <span class="featured-badge">À la une</span>
                    <div class="featured-play">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <div class="featured-content">
                    <div class="featured-category">🎙️ Actualités & Société</div>
                    <h2 class="featured-title">Les Voix de Ngazidja - Spécial Patrimoine</h2>
                    <p class="featured-description">
                        Un voyage sonore à travers les traditions et le patrimoine culturel de Ngazidja. Rencontres avec les gardiens de notre histoire et découverte des trésors cachés de notre île.
                    </p>
                    <div class="featured-meta">
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>45 min</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>25 Oct 2025</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-headphones"></i>
                            <span>12.5K écoutes</span>
                        </div>
                    </div>
                    <div class="featured-actions">
                        <button class="btn-play">
                            <i class="fas fa-play"></i>
                            Écouter maintenant
                        </button>
                        <button class="btn-subscribe">
                            <i class="fas fa-rss"></i>
                            S'abonner
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Podcasts Grid -->
    <section class="podcasts-section">
        <div class="container">
            <h2 class="section-title">Derniers épisodes</h2>
            <div class="podcasts-grid">
                <!-- Podcast Card 1 -->
                <div class="podcast-card">
                    <div class="podcast-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1478737270239-2f02b77fc618?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Podcast">
                        <span class="podcast-category-tag">Actualités</span>
                        <span class="podcast-duration">
                            <i class="fas fa-clock"></i>
                            32 min
                        </span>
                        <div class="podcast-overlay">
                            <div class="play-btn-small">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="podcast-content">
                        <h3 class="podcast-title">Journal de la semaine - Édition du 28 octobre</h3>
                        <p class="podcast-description">
                            Retour sur les événements marquants de la semaine à Ngazidja et dans l'archipel des Comores.
                        </p>
                        <div class="podcast-footer">
                            <span class="podcast-date">
                                <i class="far fa-calendar"></i>
                                Il y a 2 jours
                            </span>
                            <div class="podcast-stats">
                                <span><i class="fas fa-headphones"></i> 8.2K</span>
                                <span><i class="far fa-heart"></i> 342</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Podcast Card 2 -->
                <div class="podcast-card">
                    <div class="podcast-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Podcast">
                        <span class="podcast-category-tag">Culture</span>
                        <span class="podcast-duration">
                            <i class="fas fa-clock"></i>
                            28 min
                        </span>
                        <div class="podcast-overlay">
                            <div class="play-btn-small">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="podcast-content">
                        <h3 class="podcast-title">Mémoires de Ngazidja - Les musiciens traditionnels</h3>
                        <p class="podcast-description">
                            À la rencontre des gardiens de la musique traditionnelle comorienne et leurs instruments ancestraux.
                        </p>
                        <div class="podcast-footer">
                            <span class="podcast-date">
                                <i class="far fa-calendar"></i>
                                Il y a 4 jours
                            </span>
                            <div class="podcast-stats">
                                <span><i class="fas fa-headphones"></i> 6.7K</span>
                                <span><i class="far fa-heart"></i> 289</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Podcast Card 3 -->
                <div class="podcast-card">
                    <div class="podcast-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Podcast">
                        <span class="podcast-category-tag">Économie</span>
                        <span class="podcast-duration">
                            <i class="fas fa-clock"></i>
                            40 min
                        </span>
                        <div class="podcast-overlay">
                            <div class="play-btn-small">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="podcast-content">
                        <h3 class="podcast-title">Entreprendre aux Comores - Success stories</h3>
                        <p class="podcast-description">
                            Portraits d'entrepreneurs comoriens qui réussissent et partagent leurs expériences inspirantes.
                        </p>
                        <div class="podcast-footer">
                            <span class="podcast-date">
                                <i class="far fa-calendar"></i>
                                Il y a 5 jours
                            </span>
                            <div class="podcast-stats">
                                <span><i class="fas fa-headphones"></i> 9.1K</span>
                                <span><i class="far fa-heart"></i> 412</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Podcast Card 4 -->
                <div class="podcast-card">
                    <div class="podcast-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Podcast">
                        <span class="podcast-category-tag">Société</span>
                        <span class="podcast-duration">
                            <i class="fas fa-clock"></i>
                            35 min
                        </span>
                        <div class="podcast-overlay">
                            <div class="play-btn-small">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="podcast-content">
                        <h3 class="podcast-title">Débat citoyen - L'éducation à Ngazidja</h3>
                        <p class="podcast-description">
                            Un débat ouvert sur les défis et opportunités du système éducatif à Ngazidja avec experts et citoyens.
                        </p>
                        <div class="podcast-footer">
                            <span class="podcast-date">
                                <i class="far fa-calendar"></i>
                                Il y a 1 semaine
                            </span>
                            <div class="podcast-stats">
                                <span><i class="fas fa-headphones"></i> 7.8K</span>
                                <span><i class="far fa-heart"></i> 356</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Podcast Card 5 -->
                <div class="podcast-card">
                    <div class="podcast-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Podcast">
                        <span class="podcast-category-tag">Sport</span>
                        <span class="podcast-duration">
                            <i class="fas fa-clock"></i>
                            25 min
                        </span>
                        <div class="podcast-overlay">
                            <div class="play-btn-small">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="podcast-content">
                        <h3 class="podcast-title">Sport Comores - Les talents de demain</h3>
                        <p class="podcast-description">
                            Focus sur les jeunes sportifs comoriens qui brillent dans différentes disciplines sportives.
                        </p>
                        <div class="podcast-footer">
                            <span class="podcast-date">
                                <i class="far fa-calendar"></i>
                                Il y a 1 semaine
                            </span>
                            <div class="podcast-stats">
                                <span><i class="fas fa-headphones"></i> 5.9K</span>
                                <span><i class="far fa-heart"></i> 278</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Podcast Card 6 -->
                <div class="podcast-card">
                    <div class="podcast-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Podcast">
                        <span class="podcast-category-tag">Santé</span>
                        <span class="podcast-duration">
                            <i class="fas fa-clock"></i>
                            38 min
                        </span>
                        <div class="podcast-overlay">
                            <div class="play-btn-small">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="podcast-content">
                        <h3 class="podcast-title">Santé pour tous - Prévention et bien-être</h3>
                        <p class="podcast-description">
                            Conseils santé et témoignages de professionnels pour une meilleure prévention sanitaire aux Comores.
                        </p>
                        <div class="podcast-footer">
                            <span class="podcast-date">
                                <i class="far fa-calendar"></i>
                                Il y a 2 semaines
                            </span>
                            <div class="podcast-stats">
                                <span><i class="fas fa-headphones"></i> 6.4K</span>
                                <span><i class="far fa-heart"></i> 301</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Series Section -->
    <section class="series-section">
        <div class="container">
            <h2 class="section-title">Nos séries phares</h2>

            <!-- Series Card 1 -->
            <div class="series-card">
                <div class="series-cover">
                    <img src="https://images.unsplash.com/photo-1478737270239-2f02b77fc618?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Série">
                </div>
                <div class="series-info">
                    <div class="series-category">🎙️ Actualités Hebdomadaires</div>
                    <h3 class="series-title">La Semaine à Ngazidja</h3>
                    <p class="series-description">
                        Chaque semaine, retrouvez un condensé complet de l'actualité de Ngazidja et des Comores. Politique, économie, société et culture analysées en profondeur.
                    </p>
                    <div class="series-meta">
                        <span class="series-meta-item">
                            <i class="fas fa-list"></i>
                            48 épisodes
                        </span>
                        <span class="series-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            Chaque lundi
                        </span>
                        <span class="series-meta-item">
                            <i class="fas fa-users"></i>
                            45K abonnés
                        </span>
                    </div>
                    <div class="series-actions">
                        <button class="btn-view-series">
                            Voir tous les épisodes
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Series Card 2 -->
            <div class="series-card">
                <div class="series-cover">
                    <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Série">
                </div>
                <div class="series-info">
                    <div class="series-category">🎵 Culture & Patrimoine</div>
                    <h3 class="series-title">Racines Comoriennes</h3>
                    <p class="series-description">
                        Une plongée au cœur de la culture comorienne. Traditions, musique, artisanat et témoignages pour préserver et transmettre notre riche patrimoine.
                    </p>
                    <div class="series-meta">
                        <span class="series-meta-item">
                            <i class="fas fa-list"></i>
                            32 épisodes
                        </span>
                        <span class="series-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            Tous les 15 jours
                        </span>
                        <span class="series-meta-item">
                            <i class="fas fa-users"></i>
                            38K abonnés
                        </span>
                    </div>
                    <div class="series-actions">
                        <button class="btn-view-series">
                            Voir tous les épisodes
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Series Card 3 -->
            <div class="series-card">
                <div class="series-cover">
                    <img src="https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Série">
                </div>
                <div class="series-info">
                    <div class="series-category">💬 Débats & Société</div>
                    <h3 class="series-title">Paroles Citoyennes</h3>
                    <p class="series-description">
                        Un espace de dialogue ouvert où citoyens, experts et décideurs échangent sur les grands enjeux qui façonnent l'avenir de Ngazidja et des Comores.
                    </p>
                    <div class="series-meta">
                        <span class="series-meta-item">
                            <i class="fas fa-list"></i>
                            25 épisodes
                        </span>
                        <span class="series-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            Chaque mercredi
                        </span>
                        <span class="series-meta-item">
                            <i class="fas fa-users"></i>
                            52K abonnés
                        </span>
                    </div>
                    <div class="series-actions">
                        <button class="btn-view-series">
                            Voir tous les épisodes
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/Front/Podcasts/index.js") }}"></script>
</body>
</html>