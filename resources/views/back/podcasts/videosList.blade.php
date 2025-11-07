<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podcasts Vidéo - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/videosList.css") }}">
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
                        <img src="{{  asset('storage/ORTNlogo.jpg') }}" alt="Logo ORTN" style="width:100px; height:75px; object-fit:contain;">
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
                        <h1 class="page-title">Podcasts Vidéo</h1>
                        <p class="page-description">Gérez et visionnez tous vos podcasts vidéo</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon red">
                            <i class="fas fa-video"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $VideosCount }}</div>
                            <div class="stat-label">Total Vidéos</div>
                        </div>
                    </div>
                </div>
                
                <!-- Videos Grid -->
                <div class="videos-grid" id="videosGrid">
                    <!-- Video Card -->
                    @forelse ($videos as $video)
                        <div class="video-card"
                            data-video-id="{{ $video->id }}"
                            data-video-url="{{ $video->url_video }}"
                            data-description="{{ strip_tags($video->media->description) }}">
                            <div class="video-thumbnail">
                                @if (!empty($video->media->image))
                                    <img src="{{ $video->media->image }}" alt="{{ $video->media->titre }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1594359640393-160e1cfeef0e?auto=format&fit=crop&q=60&w=600"
                                        alt="{{ $video->titre }}">
                                @endif
                                <div class="play-overlay">
                                    <button class="play-btn">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="video-content">
                                <h4 class="video-title">{{ $video->media->titre }}</h4>
                                <div class="video-meta">
                                    <span><i class="fas fa-calendar"></i> {{ $video->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="video-description">
                                    {!! Str::limit(strip_tags($video->media->description), 150, '...') !!}
                                </p>
                                <div class="video-footer">
                                    <span class="category-badge">{{ $video->categorieVideo->libelle }}</span>
                                    <div class="video-actions">
                                        @if ($video->media->redacteur_id === auth()->user()->redacteur->id)
                                            <a href="{{ route("dashboard.videos.edit", ['video' => $video->id]) }}" class="action-btn btn-edit" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action=""
                                                onsubmit="return confirm('Voulez-vous supprimer ce podcast ? L\'action est irréversible.')">
                                                @csrf
                                                @method("DELETE")
                                                <button class="action-btn btn-delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="alert alert-warning">Aucun podcast vidéo trouvé</div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination">
                    {{ $videos->links() }}
                </nav>
                
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/videosList.js") }}"></script>

</body>
</html>