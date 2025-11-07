    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Actualites/index.css") }}">
</head>
<body>

    @include("Front.partials.loader")

    @include("Front.partials.header")

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <div class="page-breadcrumb">
                    <a href="#">Accueil</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Actualités</span>
                </div>
                <h1 class="page-title">
                    Toute l'<span class="highlight">actualité</span> du Ngazidja
                </h1>
                <p class="page-subtitle">
                    Suivez l'actualité nationale et internationale en temps réel. Une information fiable, vérifiée et accessible à tous.
                </p>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <div class="container">
        <div class="filters-section">
            <div class="filters-grid">
                <div class="search-input-group">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Rechercher une actualité...">
                </div>
                <select class="filter-select">
                    <option>Toutes catégories</option>
                    @foreach ($categoriesArticle as $cat)
                        <option value="{{ $cat->libelle }}">{{ $cat->libelle }}</option>
                    @endforeach
                </select>
                {{-- <select class="filter-select">
                    <option>Plus récents</option>
                    <option>Plus vus</option>
                    <option>Plus commentés</option>
                </select> --}}
                <button class="filter-btn">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
            </div>
        </div>
    </div>

    <!-- Featured Article -->
    <section class="featured-section">
        <div class="container">
            <div class="featured-article">
                <div class="featured-image-wrapper">
                    <span class="featured-badge">À LA UNE</span>
                    <img src="{{ asset("storage/".$featuredArticle->media->image) }}" alt="Article principal" class="featured-image">
                </div>
                <div class="featured-content">
                    <span class="featured-category">{{ $featuredArticle->categorieArticle->libelle }}</span>
                    <h2 class="featured-title">{{ $featuredArticle->media->titre }}</h2>
                    <p class="featured-excerpt">
                        {!! Str::limit(strip_tags($featuredArticle->media->description), 150) !!}
                    </p>
                    <div class="featured-meta">
                        <span class="meta-item">
                            <i class="far fa-clock"></i>
                            {{ $featuredArticle->created_at->diffForHumans() }}
                        </span>
                        <span class="meta-item">
                            <i class="far fa-eye"></i>
                            {{ $featuredArticle->views }}
                        </span>
                        <span class="meta-item">
                            <i class="far fa-comment"></i>
                            {{ $featuredArticle->commentaires_count }}
                            {{ Str::plural('commentaire', $featuredArticle->commentaires_count) }}
                        </span>
                    </div>
                    <a href="{{ route("ortn.showArticles", ["slug" => $featuredArticle->media->slug]) }}" class="featured-btn" style="text-decoration: none">
                        Lire l'article complet
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="articles-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Dernières actualités</h2>
            </div>

            <div class="articles-grid">

                {{-- @dd(get_defined_vars()) --}}

                @forelse ($articles as $index => $article)
                    <div class="article-card" data-index="{{ $index }}">
                        <div class="article-image-wrapper">
                            <span class="article-category">{{ $article->categorieArticle->libelle }}</span>
                            <img src="{{ asset("storage/".$article->media->image) }}" alt="Article" class="article-image">
                        </div>
                        <div class="article-content">
                            <h3 class="article-title">{{ $article->media->titre }}</h3>
                            <p class="article-excerpt">
                                {!! Str::limit(strip_tags($article->media->description), 150) !!}
                            </p>
                            <div class="article-footer">
                                <div class="article-meta">
                                    <span><i class="far fa-clock"></i> {{ $article->created_at->diffForHumans() }}</span>
                                    <span><i class="far fa-eye"></i> {{ $article->views }}</span>
                                </div>
                                <a href="{{ route("ortn.showArticles", ["slug" => $article->media->slug]) }}" class="read-more">
                                    Lire plus
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">Aucun article trouvé.</div>
                @endforelse

            </div>

            <!-- Load More -->
            <div class="load-more-container">
                {{-- <button class="load-more-btn">
                    Charger plus d'articles
                    <i class="fas fa-chevron-down"></i>
                </button> --}}
                {{ $articles->links() }}
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
    
    <script src="{{ asset("js/Front/Actualites/index.js") }}"></script>
</body>
</html>