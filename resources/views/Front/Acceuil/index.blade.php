<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podcasts - ORTN | Office de la Radio et Télévision de Ngazidja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Acceuil/index.css") }}">
    
</head>
<body>

    @include("Front.partials.loader")

    @include("Front.partials.header")

    @php 
        $alert = session('alert'); 
    @endphp

    @if ($alert && isset($alert['action']))
        @include("Front.partials.popup")
        <script>
            window.popupData = @json($alert);
        </script>
    @endif

    <!-- Hero Section Révolutionnaire -->
    <section class="hero-section">
        <div class="hero-particles" id="particlesContainer"></div>
        
        <div class="container">
            <div class="hero-grid-modern">
                <div class="hero-left">
                    <div class="hero-eyebrow">
                        <div class="eyebrow-icon">
                            <i class="fas fa-podcast"></i>
                        </div>
                        <span class="eyebrow-text">BIBLIOTHÈQUE AUDIO ORTN</span>
                    </div>

                    <h1 class="hero-title-modern">
                        Écoutez l'âme de <span class="gradient-text">Ngazidja</span>
                    </h1>

                    <p class="hero-subtitle">
                        Plongez dans nos podcasts exclusifs qui racontent les histoires, la culture et l'actualité des Comores. Une expérience audio immersive disponible 24/7.
                    </p>

                    <div class="hero-stats-inline">
                        <div class="stat-inline">
                            <div class="stat-inline-number">100%</div>
                            <div class="stat-inline-label">Accéssible partout</div>
                        </div>
                        <div class="stat-inline">
                            <div class="stat-inline-number">15</div>
                            <div class="stat-inline-label">Séries originales</div>
                        </div>
                        <div class="stat-inline">
                            <div class="stat-inline-number">45K</div>
                            <div class="stat-inline-label">Auditeurs mensuels</div>
                        </div>
                    </div>

                    <div class="hero-cta-group">
                        <a href="{{ route("ortn.podcasts") }}" class="btn-hero-primary">
                            <i class="fa-solid fa-microphone"></i>
                            Podcasts audios
                        </a>
                        <a href="{{ route("ortn.podcastsvideos") }}" class="btn-hero-secondary">
                            <i class="fa-solid fa-video"></i>
                            Podcasts vidéos
                        </a>
                    </div>
                </div>

                <div class="hero-right">
                    <div class="audio-visualizer-container">
                        <div class="floating-podcast-cards">
                            <div class="floating-mini-card">
                                <div class="mini-card-icon">
                                    <i class="fas fa-microphone"></i>
                                </div>
                                <div class="mini-card-content">
                                    <h4>Voix de Ngazidja</h4>
                                    <p>Nouveau épisode</p>
                                </div>
                            </div>

                            <div class="floating-mini-card">
                                <div class="mini-card-icon">
                                    <i class="fas fa-music"></i>
                                </div>
                                <div class="mini-card-content">
                                    <h4>Culture Comores</h4>
                                    <p>En tendance</p>
                                </div>
                            </div>

                            <div class="floating-mini-card">
                                <div class="mini-card-icon">
                                    <i class="fas fa-headphones"></i>
                                </div>
                                <div class="mini-card-content">
                                    <h4>12.5K écoutes</h4>
                                    <p>Cette semaine</p>
                                </div>
                            </div>
                        </div>

                        <div class="main-circle">
                            <div class="inner-circle">
                                <div class="visualizer-icon">
                                    <i class="fas fa-broadcast-tower"></i>
                                </div>
                                <div class="visualizer-text">
                                    <div class="visualizer-title">ORTN Podcasts</div>
                                    <div class="visualizer-subtitle">Diffusion en continu</div>
                                </div>
                                <div class="play-button-large">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                        </div>

                        <div class="sound-waves">
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                            <div class="wave-bar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Podcasts Grid -->
    <section class="podcasts-section">
        <div class="container">

            <div class="podcasts-actions">
                <h2 class="section-title">Podcasts audios</h2>

                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher un podcast...">
                </div>
            </div>

            <div class="podcasts-grid">
                @foreach ($audios as $audio)

                    @php
                        // $audioUrl = $audio->url_audio;
                        // if (!Str::startsWith($audioUrl, ['http://', 'https://'])) {
                        //     $audioUrl = asset('storage/' . ltrim($audioUrl, '/'));
                        // }

                        $audioUrl = $audio->url_audio;
                        if (!Str::startsWith($audioUrl, ['http://', 'https://'])) {
                            $audioUrl = asset('storage/' . ltrim($audioUrl, '/'));
                        }
                        $thumb = $audio->media->image ? (Str::startsWith($audio->media->image, ['http://','https://']) ? $audio->media->image : asset('storage/' . ltrim($audio->media->image, '/'))) : null;
                    @endphp

                    <div class="podcast-card">
                        <div class="podcast-image-wrapper">
                            <img src="{{ $audio->media->image }}" alt="{{ $audio->media->titre }}" style="object-fit: cover">
                            @if($audio->categorieAudio)
                                <span class="podcast-category-tag">{{ $audio->categorieAudio->libelle }}</span>
                            @endif
                            <div class="podcast-overlay">
                                <div class="play-btn-small"
                                    data-audio="{{ $audioUrl }}"
                                    data-title="{{ e($audio->media->titre) }}"
                                    data-sub="{{ $audio->categorieAudio ? e($audio->categorieAudio->libelle) : '' }}"
                                    data-thumb="{{ $thumb }}">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                        </div>
                        <div class="podcast-content">
                            <h3 class="podcast-title">{{ $audio->media->titre }}</h3>
                            <p class="podcast-description">
                                {{ Str::limit($audio->media->description, 120) }}
                            </p>
                            <div class="podcast-footer">
                                <span class="podcast-date">
                                    <i class="far fa-calendar"></i>
                                    {{ $audio->created_at->diffForHumans() }}
                                </span>
                                <div class="podcast-stats">
                                    <span><i class="fas fa-headphones"></i> {{ rand(1000, 9000) }}</span>
                                    <span><i class="far fa-heart"></i> {{ rand(100, 500) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="display:flex; justify-content:center; margin-top:1.5rem;">
                <a href="{{ route("ortn.podcasts") }}" class="btn"
                style="
                    background: var(--gold);
                    color: var(--dark-navy);
                    font-weight:600;
                    padding: 0.6rem 1.2rem;
                    border-radius:8px;
                    transition: 0.2s ease;
                    text-decoration:none;
                "
                onmouseover="this.style.background= 'var(--dark-gold)'"
                onmouseout="this.style.background= 'var(--gold)'"
                >
                    Voir plus
                </a>
            </div>

        </div>  
    </section>

    <!-- NOUVELLE SECTION ACTUALITÉS -->
    <section class="news-section">
        <div class="container">
            <h2 class="section-title">Dernières ctualités</h2>
            <div class="news-grid">
                <!-- Actualité -->
                @forelse ($articles as $article)
                    <div class="news-card">
                        <div class="news-image-wrapper">
                            <img src="{{ asset("storage/".$article->media->image) }}" alt="Actualité" class="news-image">
                            <span class="news-category-tag">{{ $article->categorieArticle->libelle }}</span>
                            <span class="news-date">
                                <i class="far fa-calendar"></i>
                                {{ $article->created_at->format('d M') }}
                            </span>
                        </div>
                        <div class="news-content">
                            <h3 class="news-title">
                                {{ $article->media->titre }}
                            </h3>
                            <p class="news-excerpt">
                                {{ $article->sous_titre }}
                            </p>
                            <div class="news-footer">
                                <a href="{{ route("ortn.showArticles", ["slug" => $article->media->slug]) }}" class="news-read-more">
                                    Lire la suite
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <div class="news-stats">
                                    <span><i class="far fa-eye"></i> {{ $article->views }}</span>
                                    <span><i class="far fa-comment"></i> 
                                        {{ $article->commentaires_count }}
                                        {{ Str::plural('commentaire', $article->commentaires_count) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">Aucun article trouvé.</div>
                @endforelse
            </div>
        </div>

        <div style="display:flex; justify-content:center; margin-top:1.5rem;">
            <a href="{{ route("ortn.actualites") }}" class="btn"
            style="
                background: var(--gold);
                color: var(--dark-navy);
                font-weight:600;
                padding: 0.6rem 1.2rem;
                border-radius:8px;
                transition: 0.2s ease;
                text-decoration:none;
            "
            onmouseover="this.style.background= 'var(--dark-gold)'"
            onmouseout="this.style.background= 'var(--gold)'"
            >
                Voir plus
            </a>
        </div>

    </section>

    <!-- Programmes Section -->
    <section class="series-section">
        <div class="container">
            <h2 class="section-title">Nos programmes en ce jour</h2>

            @foreach($programmesDuJour as $programme)
                @for($i = 1; $i <= 4; $i++)
                    @php
                        $start = data_get($programme, 'heure_debut'.$i);
                        $end   = data_get($programme, 'heure_fin'.$i);
                    @endphp

                    @if($start && $end)
                        <div class="series-card">
                            <div class="series-cover">
                                <img src="{{ asset('storage/ortn_logo.png') }}" alt="Série">
                            </div>

                            <div class="series-info">
                                <div class="series-category">
                                    🎙️ {{ $programme->typeProgramme->libelle ?? 'Sans type' }}
                                </div>

                                <h3 class="series-title">{{ $programme->nom }}</h3>

                                <p class="series-description">
                                    {{ Str::limit($programme->description, 150) }}
                                </p>

                                <div class="series-meta">
                                    <span class="series-meta-item">
                                        <i class="fas fa-list"></i>
                                        {{ \Carbon\Carbon::parse($start)->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($end)->format('H:i') }}
                                    </span>

                                    <span class="series-meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        Chaque {{ ucfirst($jourActuel) }}
                                    </span>

                                    <span class="series-meta-item">
                                        <i class="fas fa-users"></i>
                                        Animateur :
                                        {{ $programme->animateur ?? 'Non spécifié' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            @endforeach

        </div>

        <div style="display:flex; justify-content:center; margin-top:1.5rem;">
            <a href="{{ route("ortn.programmes") }}" class="btn"
            style="
                background: var(--gold);
                color: var(--dark-navy);
                font-weight:600;
                padding: 0.6rem 1.2rem;
                border-radius:8px;
                transition: 0.2s ease;
                text-decoration:none;
            "
            onmouseover="this.style.background= 'var(--dark-gold)'"
            onmouseout="this.style.background= 'var(--gold)'"
            >
                Voir tout les programmes
            </a>
        </div>

    </section>

    <!-- Mini sticky audio player (place avant </body>) -->
    <div id="audioPlayerContainer" role="region" aria-label="Lecteur audio">
        <img id="audioPlayerThumb" src="" alt="Artwork">
        <div id="audioPlayerInfo">
            <div id="audioPlayerTitle">Titre</div>
            <div id="audioPlayerSub">Catégorie • Durée</div>

            <div style="display:flex; gap:8px; align-items:center;">
                <div id="audioProgress" title="Cliquer pour seek">
                    <div id="audioProgressBar"></div>
                </div>
            </div>
        </div>

        <div id="audioPlayerControls">
            <button id="togglePlayBtn" class="player-btn" aria-label="Play/Pause">
                <i id="togglePlayIcon" class="fas fa-play"></i>
            </button>
            <div id="audioTimes" style="color:var(--light-gray); font-size:12px;">
                <span id="currentTime">0:00</span> / <span id="durationTime">0:00</span>
            </div>
        </div>

        <!-- Element audio natif (caché) -->
        <audio id="globalAudioPlayer" preload="metadata"></audio>
    </div>

    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/Front/Acceuil/index.js") }}"></script>

    @if ($alert && isset($alert['action']))
        <script src="{{ asset("js/Front/popupInitialize.js") }}"></script>
    @endif

</body>
</html>