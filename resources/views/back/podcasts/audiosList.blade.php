<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podcasts Audio - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/audiosList.css") }}">
</head>
<body>

    <!-- Loader --> 
    @include("back.partials.loader")

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route("dashboard.audios") }}" class="sidebar-brand">
                    @if (file_exists(public_path('storage/ORTNlogo.jpg')))
                        <img src="{{  asset('storage/ORTNlogo.jpg') }}" alt="Logo Hayba" style="width:100px; height:75px; object-fit:contain;">
                    @else
                        <i class="fas fa-broadcast-tower"></i>
                        <span>ORTN Admin</span>
                    @endif
                </a>
            </div>
            
            @include("back.partials.sidebar")

        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="user-menu">
                    <div class="user-info">
                        <div class="user-details">
                            @include("back.partials.link")
                        </div>
                    </div>
                </div>

                <div class="header-right">
                    <div class="user-profile">
                        <div class="user-avatar">
                            {{ substr(auth()->user()->nom, 0, 1) . substr(auth()->user()->prenom, 0, 1) }}
                        </div>
                        <div class="user-info">
                            <div class="user-name">{{ auth()->user()->nom . " " . auth()->user()->prenom }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Podcasts Audio</h1>
                        <p class="page-description">Gérez et écoutez tous vos podcasts audio</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon red">
                            <i class="fas fa-microphone-alt"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $audiosCount }}</div>
                            <div class="stat-label">Total Podcasts</div>
                        </div>
                    </div>

                </div>

                @if (session()->has('alert'))
                    <x-alert type="{{ session('alert')['type'] }}">
                        {{ session('alert')['message'] }}
                    </x-alert>
                @endif
                
                <!-- Audio Grid -->
                <div class="audio-grid" id="audioGrid">
                    <!-- Audio Card -->
                    @forelse ($audios as $audio)

                        <div class="audio-card" data-audio-id="1">
                            <div class="audio-cover">
                                @if (!empty($audio->media?->image))
                                    <img src="{{ $audio->media->image }}" alt="Logo Hayba">
                                @else
                                    <i class="fas fa-microphone-alt audio-cover-icon"></i>
                                @endif
                            </div>
                            <div class="audio-content">
                                <h4 class="audio-title">{{ $audio->media->titre }}</h4>
                                <div class="audio-meta">
                                    <span><i class="fas fa-calendar"></i>{{ $audio->created_at ? $audio->created_at->diffForHumans() : $audio->created_at }}</span>
                                </div>
                                <p class="audio-description">
                                    {!! Str::limit(strip_tags($audio->media->description), 150, '...') !!}
                                </p>
                                <div class="audio-footer">
                                    <span class="category-badge">{{ $audio->categorieAudio->libelle }}</span>
                                    @if ($audio->media->redacteur_id === auth()->user()->redacteur->id)
                                        <div class="audio-actions">
                                            <button class="action-btn btn-play"
                                                    title="Écouter"
                                                    data-title="{{ $audio->media->titre }}"
                                                    data-url="{{ $audio->url_audio }}"
                                                    data-host="{{ $audio->media->redacteur->user->nom ?? 'Animateur inconnu' }}"
                                                    data-description="{{ strip_tags($audio->media->description) }}"
                                                    data-date="{{ $audio->created_at->format('d/m/Y') }}"
                                                    data-category="{{ $audio->categorieAudio->libelle }}"
                                                    data-image="{{ $audio->media->image }}">
                                                <i class="fas fa-play"></i>
                                            </button>
                                            
                                            <form action="" onsubmit="window.location({{ route('dashboard.audios.edit', ['audio' => $audio->id]) }})">
                                                <button type="button"
                                                        class="action-btn btn-edit"
                                                        title="Modifier"
                                                        onclick="window.location.href='{{ route('dashboard.audios.edit', ['audio' => $audio->id]) }}'">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('dashboard.audio.destroy', ['audio' => $audio->id]) }}" method="POST" onsubmit="return confirm ('voulez-vous supprimer ce podcast ? l\'action est irreversible')">
                                                @csrf
                                                @method("DELETE")
                                                <button class="action-btn btn-delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="alert alert-warning">Aucun podcast audio trouvé</div>
                    @endforelse
                    
                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination">
                    {{ $audios->links() }}
                </nav>
            </div>
        </div>
    </div>

    <!-- Audio Player Modal -->
    <div id="audioModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalAudioTitle">Titre du podcast</h3>
                <button class="close-btn" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="audio-player-wrapper">
                    <div class="audio-player-cover">
                        <i class="fas fa-microphone-alt"></i>
                    </div>
                    <div class="audio-player-info">
                        <div class="audio-player-title" id="playerTitle">Titre du podcast</div>
                        <div class="audio-player-artist" id="playerHost">Crée par</div>
                    </div>
                    <div class="audio-player-controls">
                        <audio id="audioPlayer" controls>
                            <source src="" type="audio/mpeg">
                            Votre navigateur ne supporte pas la lecture audio.
                        </audio>
                    </div>
                </div>
                <div class="audio-info-section">
                    <h4 class="audio-info-title" id="modalInfoTitle">Titre complet</h4>
                    <div class="audio-info-meta" id="modalInfoMeta">
                        <span><i class="fas fa-user"></i> Animateur</span>
                        <span><i class="fas fa-calendar"></i> Date</span>
                        <span><i class="fas fa-headphones"></i> Écoutes</span>
                        <span><i class="fas fa-clock"></i> Durée</span>
                    </div>
                    <div class="audio-info-description" id="modalInfoDescription">
                        Description du podcast...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/audiosList.js") }}"></script>
</body>
</html>