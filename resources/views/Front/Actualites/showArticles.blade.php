<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Actualites/showArticles.css") }}">

</head>
<body>

    @include("Front.partials.loader")

    @include("Front.partials.header")

    <!-- Article Hero -->
    <section class="article-hero">
        <img src="{{ asset("storage/". $article->media->image) }}" alt="Article" class="article-hero-image">
        
        <div class="article-hero-overlay"></div>

        @if (session()->has("alert"))
            <div class="alert alert-{{ session("alert")["type"] }}">
                {{ session("alert")["message"] }}
            </div>
        @endif

        <div class="container">
            <div class="article-hero-content">
                <div class="article-breadcrumb">
                    <a href="{{ route("ortn.home") }}">Accueil</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{ route("ortn.actualites") }}">Actualités</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Article</span>
                </div>
                <span class="article-category-badge">{{ $article->categorieArticle->libelle }}</span>
                <h1 class="article-hero-title">{{ $article->media->titre }}</h1>
                <p class="article-hero-excerpt"> 
                    {{ $article->sous_titre }}
                </p>
                <div class="article-meta-bar">
                    <div class="meta-item">
                        <i class="far fa-eye"></i>
                        <span>{{ $article->views }} lectures</span>
                    </div>
                    <div class="meta-item">
                        <i class="far fa-comment"></i>
                        <span>{{ $article->commentaires_count }} commentaires</span>
                    </div>
                    <div class="meta-item">
                        <i class="far fa-clock"></i>
                        <span>8 min de lecture</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="article-content-section">
        <div class="container">
            <div class="article-main-container">
                <!-- Toolbar -->
                <div class="article-toolbar">
                    <div class="share-buttons">
                        <span class="share-label">Partager :</span>
                        <button class="share-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button class="share-btn twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="share-btn whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <button class="share-btn linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </button>
                    </div>
                    <div class="article-actions">
                        {{-- <button class="action-btn">
                            <i class="far fa-bookmark"></i>
                            Sauvegarder
                        </button> --}}
                        <button class="action-btn">
                            <i class="fas fa-print"></i>
                            Imprimer
                        </button>
                    </div>
                </div>

                <!-- Article Body -->
                <div class="article-body">
                    <p style="text-align: justify">
                        {!! strip_tags($article->media->description) !!}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    <section class="related-section">
        <div class="container">
            <h2 class="section-title">Articles similaires</h2>

            <div class="related-grid">

                @forelse ($articlesSimilaires as $similaire)
                    <a href="{{ route("ortn.showArticles", ["slug" => $similaire->media->slug]) }}" class="related-card" style="text-decoration: none">
                        <img src="{{ (asset("storage/". $similaire->media->image)) }}" alt="Article" class="related-card-image">
                        <div class="related-card-content">
                            <span class="related-category">{{ $similaire->categorieArticle->libelle }}</span>
                            <h3 class="related-card-title">{{ $similaire->media->titre }}</h3>
                            <div class="related-card-meta">
                                <span><i class="far fa-clock"></i> {{ $similaire->created_at->diffForHumans() }}</span>
                                <span><i class="far fa-eye"></i> {{ $similaire->views }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="alert alert-warning">Aucun article similaire trouvé.</div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- Comments Section -->
    <section class="comments-section">
        <div class="container">
            <div class="comments-container">

                <div class="comments-header">
                    <h2 class="comments-count">
                        <i class="far fa-comments"></i> ({{ $article->commentaires_count }}) Commentaires
                    </h2>
                </div>

                <!-- Comment Form -->
                @auth
                    <div class="comment-form">
                        <h4 class="form-title"><i class="fas fa-pen me-2"></i>Laisser un commentaire</h4>
                        <form id="commentForm" method="POST" action="{{ route('ortn.comments.store') }}">
                            @csrf

                            <input type="hidden" name="article_id" value="{{ $article->id }}">

                            <div class="form-group">
                                <label for="commentText" class="form-label">Votre commentaire *</label>
                                <textarea class="form-control" name="contenu" id="commentText" rows="5" placeholder="Partagez votre avis sur cet article..." required></textarea>
                            </div>

                            <button type="submit" class="submit-comment-btn">
                                <i class="fas fa-paper-plane me-2"></i>Publier le commentaire
                            </button>
                        </form>
                    </div>
                @endauth

                @if($article->commentaires->isNotEmpty())
                    <div class="comments-list">
                        @foreach($article->commentaires as $commentaire)
                            <div class="comments-list">
                                <div class="comment-item">
                                    <img src="https://static.vecteezy.com/system/resources/previews/008/149/271/large_2x/user-icon-for-graphic-design-logo-website-social-media-mobile-app-ui-illustration-free-vector.jpg" alt="Utilisateur" class="comment-avatar">
                                    <div class="comment-content">
                                        <div class="comment-header">
                                            <h4 class="comment-author">{{ $commentaire->user->nom . " " . $commentaire->user->prenom }}</h4>
                                            <span class="comment-date"><i class="far fa-clock me-1"></i>{{ $commentaire->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="comment-text">
                                            {{ $commentaire->contenu }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h2 class="newsletter-title">Restez informé en temps réel</h2>

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
    
    <script src="{{ asset("js/Front/Actualites/showArticles.js") }}"></script>

</body>
</html>