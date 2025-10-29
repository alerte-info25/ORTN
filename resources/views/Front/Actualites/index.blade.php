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
                    <option>Politique</option>
                    <option>Économie</option>
                    <option>Culture</option>
                    <option>Sport</option>
                    <option>Santé</option>
                    <option>Éducation</option>
                    <option>Société</option>
                </select>
                <select class="filter-select">
                    <option>Plus récents</option>
                    <option>Plus vus</option>
                    <option>Plus commentés</option>
                </select>
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
                    <span class="featured-badge">🔥 À LA UNE</span>
                    <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article principal" class="featured-image">
                </div>
                <div class="featured-content">
                    <span class="featured-category">Politique</span>
                    <h2 class="featured-title">Sommet de la CEDEAO : Le Ngazidja au cœur des discussions régionales</h2>
                    <p class="featured-excerpt">
                        La délégation nigérienne a présenté plusieurs initiatives majeures lors du sommet annuel de la CEDEAO, portant notamment sur la sécurité, le développement économique et la coopération transfrontalière. Ces propositions ont été saluées par l'ensemble des États membres.
                    </p>
                    <div class="featured-meta">
                        <span class="meta-item">
                            <i class="far fa-clock"></i>
                            Il y a 30 minutes
                        </span>
                        <span class="meta-item">
                            <i class="far fa-eye"></i>
                            12.5K vues
                        </span>
                        <span class="meta-item">
                            <i class="far fa-comment"></i>
                            248 commentaires
                        </span>
                    </div>
                    <button class="featured-btn">
                        Lire l'article complet
                        <i class="fas fa-arrow-right"></i>
                    </button>
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
                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">Économie</span>
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Le secteur agricole enregistre une croissance de 8%</h3>
                        <p class="article-excerpt">
                            Les nouvelles politiques de soutien aux agriculteurs portent leurs fruits avec une augmentation significative de la production céréalière.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 1h</span>
                                <span><i class="far fa-eye"></i> 3.2K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">Culture</span>
                        <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Festival Cure Salée : Un succès retentissant à Ingall</h3>
                        <p class="article-excerpt">
                            Des milliers de visiteurs ont célébré la culture touareg lors de cette édition exceptionnelle du festival traditionnel.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 2h</span>
                                <span><i class="far fa-eye"></i> 5.8K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">Éducation</span>
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Construction de 150 nouvelles salles de classe à Niamey</h3>
                        <p class="article-excerpt">
                            Le gouvernement lance un vaste programme de construction pour améliorer l'accès à l'éducation dans la capitale.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 3h</span>
                                <span><i class="far fa-eye"></i> 4.1K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">Sport</span>
                        <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Les Menas se qualifient pour la phase finale de la CAN</h3>
                        <p class="article-excerpt">
                            L'équipe nationale de football décroche sa qualification après une victoire éclatante face au Burkina Faso.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 4h</span>
                                <span><i class="far fa-eye"></i> 8.9K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">Santé</span>
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Lancement d'une campagne nationale de dépistage du paludisme</h3>
                        <p class="article-excerpt">
                            Le ministère de la Santé mobilise toutes les régions pour une vaste campagne de prévention et de dépistage.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 5h</span>
                                <span><i class="far fa-eye"></i> 3.7K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">Société</span>
                        <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Inclusion numérique : 500 villages connectés à Internet</h3>
                        <p class="article-excerpt">
                            Un programme ambitieux vise à réduire la fracture numérique en équipant les zones rurales en connexion haut débit.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 6h</span>
                                <span><i class="far fa-eye"></i> 6.2K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">Environnement</span>
                        <img src="https://images.unsplash.com/photo-1466611653911-95081537e5b7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Grande Muraille Verte : Le Ngazidja plante 2 millions d'arbres</h3>
                        <p class="article-excerpt">
                            Dans le cadre du projet panafricain, des milliers de volontaires participent à la reforestation du Sahel.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 1j</span>
                                <span><i class="far fa-eye"></i> 5.4K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">Technologie</span>
                        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Innovation : Des startups nigériennes primées à Lagos</h3>
                        <p class="article-excerpt">
                            Trois jeunes entreprises technologiques du Ngazidja remportent des prix lors du sommet africain de l'innovation.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 1j</span>
                                <span><i class="far fa-eye"></i> 4.8K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="article-card">
                    <div class="article-image-wrapper">
                        <span class="article-category">International</span>
                        <img src="https://images.unsplash.com/photo-1526628953301-3e589a6a8b74?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="Article" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title">Coopération bilatérale : Accord commercial avec le Maroc</h3>
                        <p class="article-excerpt">
                            Les deux pays signent un partenariat stratégique visant à renforcer les échanges économiques et culturels.
                        </p>
                        <div class="article-footer">
                            <div class="article-meta">
                                <span><i class="far fa-clock"></i> Il y a 2j</span>
                                <span><i class="far fa-eye"></i> 7.1K</span>
                            </div>
                            <a href="#" class="read-more">
                                Lire plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More -->
            <div class="load-more-container">
                <button class="load-more-btn">
                    Charger plus d'articles
                    <i class="fas fa-chevron-down"></i>
                </button>
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
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Votre adresse email" required>
                    <button type="submit" class="newsletter-btn">
                        S'abonner
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