<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletters envoyées - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    {{-- local css --}}
    <link rel="stylesheet" href="{{ asset("css/back/newslettersListe.css") }}">
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
                        <h1 class="page-title">Newsletters envyées</h1>
                        <p class="page-description">Gérez et diffusez vos newsletters</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fa-solid fa-paper-plane"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $newslettersCount }}</div>
                            <div class="stat-label">envoyées</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $abonnesCount }}</div>
                            <div class="stat-label">Abonnés</div>
                        </div>
                    </div>
                </div>
                
                <!-- Newsletters Grid -->
                <div class="newsletters-grid" id="newslettersGrid">
                    <!-- Newsletter Card -->
                    @forelse ($newsletters as $newsletter)

                        @php
                            $initials = strtoupper(substr($newsletter->media->redacteur->user->prenom,0,1) . substr($newsletter->media->redacteur->user->nom,0,1));
                        @endphp

                        <div class="newsletter-card" 
                            data-newsletter-id="{{ $newsletter->id }}"
                            data-title="{{ $newsletter->media->titre }}"
                            data-date="{{ $newsletter->created_at->diffForHumans() }}"
                            data-author="{{ $newsletter->media->redacteur->user->nom }} {{ $newsletter->media->redacteur->user->prenom }}"
                            data-tag="{{ $newsletter->categorieNewsletter->libelle }}"
                            data-image="{{ $newsletter->media->image ?? '' }}"
                            data-content='@json($newsletter->media->description)'>
                            
                            <div class="newsletter-header">
                                <span class="newsletter-status status-sent">Envoyée</span>
                                <div class="newsletter-number">Newsletter #{{ $newsletter->id }}</div>
                                <h3 class="newsletter-title">{{ $newsletter->media->titre }}</h3>
                                <div class="newsletter-date">
                                    <i class="fas fa-calendar"></i> {{ $newsletter->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="newsletter-content">
                                <p class="newsletter-excerpt">{{ Str::limit(strip_tags($newsletter->media->description), 100) }}</p>
                                <div class="newsletter-tags">
                                    <span class="tag">{{ $newsletter->categorieNewsletter->libelle }}</span>
                                </div>
                                <div class="newsletter-footer">
                                    <div class="newsletter-author">
                                        <div class="author-avatar">{{ $initials }}</div>
                                        <span>{{ $newsletter->media->redacteur->user->nom }} {{ $newsletter->media->redacteur->user->prenom }}</span>
                                    </div>
                                    <div class="newsletter-actions">
                                        <button class="action-btn btn-view" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="alert alert-danger">Aucune newsletters envoyées</div>
                    @endforelse
                    
                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination">
                    {{ $newsletters->links() }}
                </nav>
            </div>
        </div>
    </div>

    <!-- Newsletter Preview Modal -->
    <div id="newsletterModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalNewsletterTitle">Titre de la Newsletter</h3>
                <button class="close-btn" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="newsletter-preview">
                    <div class="preview-header">
                        <h2 class="preview-title" id="previewTitle">Titre de la Newsletter</h2>
                        <div class="preview-meta" id="previewMeta">
                            <span><i class="fas fa-user"></i> Auteur</span>
                            <span><i class="fas fa-calendar"></i> Date</span>
                            <span><i class="fas fa-tag"></i> Catégorie</span>
                        </div>
                    </div>

                    <!-- ✅ Image bien contenue -->
                    <div class="preview-image-container">
                        <img id="previewImage" src="" alt="Image de la newsletter">
                    </div>

                    <div class="preview-content" id="previewContent">
                        <p>Contenu de la newsletter...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    <script src="{{ asset("js/back/newslettersListe.js") }}"></script>
</body>
</html>