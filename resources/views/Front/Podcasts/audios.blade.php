<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podcasts Audio - ortn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    {{-- local css --}}
    <link rel="stylesheet" href="{{ asset("css/Front/Podcasts/podcastsaudio.css") }}">
</head>
<body>

    <!-- Loader -->
    @include("Front.partials.loader")

    @include("Front.partials.header")

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            
            @if (session()->has("alert"))
                <div class="alert alert-{{ session("alert")["type"] }}">
                    {{ session("alert")["message"] }}
                </div>
            @endif

            <div class="page-header">
                <div class="page-header-content">
                    <h1 class="page-title">
                        <i class="fas fa-podcast"></i>
                        Podcasts Audio
                    </h1>
                    <p class="page-description">
                        Découvrez nos émissions et podcasts exclusifs. Culture, actualités, débats et musique à écouter quand vous voulez, où vous voulez.
                    </p>
                    
                    <div class="podcast-stats">
                        <div class="stat-item">
                            <span class="stat-number">24h/24</span>
                            <span class="stat-label">Disponible</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Gratuit</span>
                        </div>
                    </div>
                </div>
                
                <!-- Audio Waves Animation -->
                <div class="audio-waves">
                    <div class="wave-bar"></div>
                    <div class="wave-bar"></div>
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

    <!-- Main Content -->
    <div class="container my-4">

        <!-- radio -->
        <div class="featured-podcast p-4 bg-light rounded shadow-sm">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-3 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1478737270239-2f02b77fc618?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                        alt="Podcast à la une" 
                        class="img-fluid rounded featured-img">
                </div>
                <div class="col-lg-7">
                    <div class="featured-content">
                        {{-- <span class="featured-badge badge bg-danger mb-2">À la une</span> --}}
                        <h2 class="featured-title">Office de Radio et Télévision de Ngazidja: Là où l'information rencontre la culture</h2>
                        <div class="featured-meta mb-2 text-muted">
                            <span class="me-3"><i class="fas fa-calendar"></i> {{ now() }}</span>
                            <span><i class="fas fa-broadcast-tower"></i> EN DIRECT</span>
                        </div>
                        <p class="featured-description">
                            Office de Radio et Télévision de Ngazidja- Votre station de radio préférée pour l'information, la culture et la musique.
                        </p>
                        <div class="audio-player-live d-flex align-items-center mt-3">
                            <button class="play-btn-large btn btn-primary me-3" id="featuredPlayBtn">
                                <i class="fas fa-play" id="featuredPlayIcon"></i>
                            </button>
                            <span id="liveStatus" class="text-success fw-bold">En pause</span>
                            <audio id="featuredAudio" src="https://cast4.asurahosting.com/proxy/life/stream" preload="none"></audio>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-16">
                <!-- Latest Podcasts -->
                <div class="section-header">
                    <h2 class="section-title">Derniers podcasts</h2>
                </div>

                <div class="row">

                    <div class="row">
                        @forelse ($audios as $audio)
                            <div class="col-md-6 mb-4">
                                <div class="podcast-card">
                                    <div class="podcast-image position-relative">
                                        <img 
                                            src="{{ $audio->media->image }}" 
                                            alt="{{ $audio->media->titre }}" 
                                            class="img-fluid rounded-3"
                                        >
                                        <div class="podcast-overlay">
                                            <button class="play-btn-overlay" 
                                                    data-audio="{{ $audio->url_audio }}"
                                                    data-title="{{ $audio->media->titre }}"
                                                    data-category="{{ $audio->categorieAudio->libelle ?? 'Non catégorisé' }}"
                                                    data-cover="{{ $audio->media->image }}">
                                                <i class="fas fa-play"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="podcast-body">
                                        <span class="podcast-category">{{ $audio->categorieAudio->libelle ?? 'Non catégorisé' }}</span>
                                        <h5 class="podcast-title">{{ $audio->media->titre }}</h5>
                                        <p class="podcast-description">
                                            {{ Str::limit($audio->media->description, 120) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">Aucun podcast disponible pour le moment.</p>
                        @endforelse

                        <!-- Lecteur audio contextuel -->
                        <div id="audioPlayerBar" class="audio-player-bar" style="display: none;">
                            <div class="audio-player-content">
                                <img id="playerCover" src="" alt="Cover" class="player-cover">
                                <div class="player-info">
                                    <h5 id="playerTitle">Titre du podcast</h5>
                                    <p id="playerCategory">Catégorie</p>
                                </div>
                                <audio id="playerAudio" controls controlsList="nodownload"></audio>
                                <button id="closePlayer" class="close-player">&times;</button>
                            </div>
                        </div>

                    </div>

                    {{ $audios->links() }}

                </div>

            </div>

            
        </div>
    </div>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h2 class="newsletter-title">Restez informé en temps réel</h2>

                @if (session()->has("alert"))
                    <div class="alert alert-{{ session("alert")["type"] }}">
                        {{ session("alert")["message"] }}
                    </div>
                @endif

                <p class="newsletter-description">
                    Abonnez-vous à notre newsletter et recevez les dernières actualités directement dans votre boîte mail.
                </p>
                <form method="POST" action="{{ route("ortn.newsletters.store") }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Votre adresse email" required style="border-radius: 2px solid rgba(255,255,255,0.5); padding: 12px 20px; border: none;">
                    </div>
                    <button type="submit" class="btn w-100" style="background: white; color: var(--primary-red); border-radius: 2px solid rgba(255,255,255,0.5); padding: 12px; font-weight: 600; border: none;">
                        S'abonner maintenant
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset("js/Front/Podcasts/podcastsaudios.js") }}"></script>
    
</body>
</html>