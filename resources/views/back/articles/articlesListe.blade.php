<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    {{-- local css --}}
    <link rel="stylesheet" href="{{ asset("css/back/articlesListe.css") }}">
</head>
<body>

    <div id="loader">
        <div class="loader-content">
            <div class="loader-icon">
                @if (file_exists(public_path('storage/ORTNlogo.jpg')))
                    <img src="{{  asset('storage/ORTNlogo.jpg') }}" alt="Logo ORTN" style="width:450px; height:250px; object-fit:contain;">
                @else
                    <i class="fas fa-newspaper"></i>
                @endif
            </div>
            <div class="loader-text">ORTN</div>
            <div class="loader-subtext">Articles & Actualités</div>
            <div class="progress-bar-container">
                <div class="progress" id="loadingProgress"></div>
            </div>
        </div>
    </div>

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
                        <h1 class="page-title">Articles & Actualités</h1>
                        <p class="page-description">Gérez et publiez tous vos articles</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon red">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $articlesCount }}</div>
                            <div class="stat-label">Total Articles</div>
                        </div>
                    </div>
                </div>

                @if (session()->has("alert"))
                    <div class="alert alert-{{ session('alert')['type'] }}">
                        {{ session('alert')['message'] }}
                    </div>
                @endif
                
                <!-- Articles Grid -->
                <div class="articles-grid" id="articlesGrid">
                    <!-- Article Card -->
                    @forelse ($articles as $article)
                        @php
                            $media = $article->media;
                            $categorie = $article->categorieArticle;
                            $auteur = $media->redacteur ?? auth()->user();
                            $date = $media->created_at->format('d M Y');
                            $image = $media->image 
                                ? asset('storage/' . $media->image)
                                : 'https://via.placeholder.com/600x400?text=Article';
                        @endphp

                        <div class="article-card" data-article-id="{{ $article->id }}"
                            data-title="{{ $article->media->titre }}"
                            data-image="{{ asset('storage/' . $article->media->image) }}"
                            data-author="{{ $article->media->redacteur->user->nom }}"
                            data-date="{{ $article->created_at->format('d M Y') }}"
                            data-views="{{ $article->sous_titre }}"
                            data-reading-time="{{ $article->created_at->format("H:i:s") }} min"
                            data-category="{{ $article->categorieArticle->libelle }}"
                            data-content="{{ $article->media->description }}">
                            
                            <div class="article-image">
                                <img src="{{ $image }}" alt="{{ $media->titre }}">
                                
                                @if($categorie)
                                    <span class="article-badge">{{ $categorie->libelle }}</span>
                                @endif

                                <span class="status-badge status-published">
                                    Publié
                                </span>

                            </div>

                            <div class="article-content">
                                
                                <div class="article-meta">
                                    <span><i class="fas fa-calendar"></i> {{ $date }}</span>
                                    <span class="type">
                                        {{ $article->typeArticle->libelle }}
                                    </span>
                                </div>

                                <h4 class="article-title">{{ $media->titre }}</h4>

                                <p class="article-excerpt">
                                    {{ Str::words(strip_tags($media->description), 20, '...') }}
                                    {{-- {{ Str::limit(strip_tags($media->description), 150) }} --}}
                                </p>

                                <div class="article-footer">
                                    <div class="article-author">
                                        <div class="author-avatar">
                                            {{ strtoupper(substr($auteur->prenom ?? 'A', 0, 1) . substr($auteur->nom ?? 'U', 0, 1)) }}
                                        </div>
                                        <span class="author-name">{{ $auteur->prenom ?? '' }} {{ $auteur->nom ?? '' }}</span>
                                    </div>

                                    <div class="article-actions">
                                        <button class="action-btn btn-view open-modal-btn" title="Voir l'article">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <a href="{{ route('dashboard.articles.edit', $article->id) }}" class="action-btn btn-edit" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form method="POST" action="{{ route('dashboard.articles.destroy', $article->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn btn-delete" title="Supprimer" onclick="return confirm('Supprimer cet article ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="alert alert-warning">Aucun article trouvé.</div>
                    @endforelse

                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination">
                    {{ $articles->links() }}
                </nav>
            </div>
        </div>
    </div>

    <!-- Article Modal -->
    <div id="articleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalArticleTitle">Titre de l'article</h3>
                <button class="close-btn" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <img src="" alt="Article" class="article-full-image" id="modalArticleImage">
                <div class="article-full-meta" id="modalArticleMeta">
                    <span><i class="fas fa-user"></i> <span id="modalArticleAuthor">Auteur</span></span>
                    <span><i class="fas fa-calendar"></i> <span id="modalArticleDate">Date</span></span>
                    <span> <span id="modalArticleViews">Vues</span></span>
                    <span><i class="fas fa-clock"></i> <span id="modalArticleReadingTime">Temps de lecture</span></span>
                    <span><i class="fas fa-tag"></i> <span id="modalArticleCategory">Catégorie</span></span>
                </div>
                <h2 class="article-full-title" id="modalFullTitle">Titre complet de l'article</h2>
                <div class="article-full-content" id="modalArticleContent">
                    <p>Contenu de l'article...</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/articlesListe.js") }}"></script>
</body>
</html>