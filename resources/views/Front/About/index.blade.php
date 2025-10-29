<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/About/index.css") }}">
</head>
<body>

    @include("Front.partials.loader")

    @include("Front.partials.header")

    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <div class="breadcrumb-custom">
                    <a href="#">Accueil</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>À propos</span>
                </div>
                <h1 class="page-title">Qui sommes-nous ?</h1>
                <p class="page-subtitle">
                    Plus de 50 ans d'engagement au service de l'information, de l'éducation et du divertissement au Niger
                </p>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1598550476439-6847785fcea6?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="ORTN">
                    <div class="about-image-badge">
                        <div class="badge-number">50+</div>
                        <div class="badge-text">Ans d'Excellence</div>
                    </div>
                </div>

                <div class="about-content">
                    <h2>Notre Histoire</h2>
                    <p>
                        Fondé dans les années 1970, <span class="highlight-text">l'Office de Radiodiffusion Télévision du Niger (ORTN)</span> est l'organisme public de référence pour la diffusion radio et télévisuelle au Niger.
                    </p>
                    <p>
                        Au fil des décennies, l'ORTN s'est imposé comme un pilier essentiel de la démocratie nigérienne, offrant une plateforme d'expression libre et une couverture médiatique équitable sur l'ensemble du territoire national.
                    </p>
                    <p>
                        Avec une couverture de plus de 85% du territoire et une audience de millions d'auditeurs et téléspectateurs quotidiens, nous continuons à innover pour répondre aux besoins d'information et de divertissement des Nigériens.
                    </p>
                </div>
            </div>

            <div class="about-grid" style="flex-direction: row-reverse;">
                <div class="about-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1551818255-e6e10975bc17?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" alt="ORTN Studio">
                    <div class="about-image-badge">
                        <div class="badge-number">2M+</div>
                        <div class="badge-text">Auditeurs quotidiens</div>
                    </div>
                </div>

                <div class="about-content">
                    <h2>Notre Présence</h2>
                    <p>
                        L'ORTN dispose d'un réseau de <span class="highlight-text">stations régionales</span> réparties sur tout le territoire national, garantissant une proximité avec les populations et une meilleure prise en compte des réalités locales.
                    </p>
                    <p>
                        Nos équipements modernes et nos studios à la pointe de la technologie nous permettent de produire des contenus de qualité internationale, tout en conservant notre identité culturelle forte.
                    </p>
                    <p>
                        À travers nos programmes variés diffusés 24h/24 et 7j/7, nous touchons toutes les catégories sociales et toutes les générations, des zones urbaines aux régions les plus reculées du pays.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mission-vision-section">
        <div class="container">
            <div class="mission-vision-grid">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Notre Mission</h3>
                    <p>
                        Informer avec objectivité et rigueur, éduquer les citoyens sur les enjeux nationaux et internationaux, promouvoir la culture nigérienne et contribuer au développement socio-économique du pays à travers des programmes de qualité accessibles à tous.
                    </p>
                </div>

                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Notre Vision</h3>
                    <p>
                        Devenir le média de référence en Afrique de l'Ouest, reconnu pour l'excellence de ses contenus, son professionnalisme et son engagement au service de la démocratie, tout en embrassant les nouvelles technologies pour atteindre une audience toujours plus large.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="values-section">
        <div class="container">
            <h2 class="section-title-modern">Nos Valeurs</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h4>Intégrité</h4>
                    <p>Nous nous engageons à diffuser une information vérifiée, objective et impartiale, respectant les principes déontologiques du journalisme.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>Excellence</h4>
                    <p>Nous visons la qualité dans tous nos programmes, en investissant dans la formation continue et les équipements de pointe.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h4>Service Public</h4>
                    <p>Nous plaçons l'intérêt général au cœur de nos actions, en garantissant l'accès à l'information pour tous les Nigériens.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4>Innovation</h4>
                    <p>Nous adoptons les nouvelles technologies et explorons de nouveaux formats pour rester pertinents et attractifs.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-globe-africa"></i>
                    </div>
                    <h4>Diversité Culturelle</h4>
                    <p>Nous célébrons la richesse culturelle du Niger en donnant la parole à toutes les communautés et en promouvant nos langues nationales.</p>
                </div>

                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Proximité</h4>
                    <p>Nous restons à l'écoute de notre audience et participons activement au débat public national et local.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="timeline-section">
        <div class="container">
            <h2 class="section-title-modern">Notre Parcours</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">1974</div>
                    <div class="timeline-content">
                        <h4>Création de l'ORTN</h4>
                        <p>L'Office de Radiodiffusion Télévision du Niger voit le jour, marquant une étape décisive dans le paysage médiatique nigérien.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">1985</div>
                    <div class="timeline-content">
                        <h4>Extension Nationale</h4>
                        <p>Mise en place d'un réseau de stations régionales couvrant l'ensemble du territoire et permettant une meilleure proximité avec les populations.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">1995</div>
                    <div class="timeline-content">
                        <h4>Modernisation Technique</h4>
                        <p>Acquisition d'équipements de diffusion modernes et construction de nouveaux studios à la pointe de la technologie.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2005</div>
                    <div class="timeline-content">
                        <h4>Ère Numérique</h4>
                        <p>Lancement de la diffusion numérique et création d'une présence en ligne avec un site web et des plateformes digitales.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2015</div>
                    <div class="timeline-content">
                        <h4>Excellence Reconnue</h4>
                        <p>Récompenses nationales et internationales saluant la qualité de nos programmes et notre contribution au développement.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2024</div>
                    <div class="timeline-content">
                        <h4>Vision d'Avenir</h4>
                        <p>Lancement de nouveaux formats innovants et expansion de notre présence sur les réseaux sociaux pour toucher une audience plus jeune.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <h2 class="section-title-modern">Notre Équipe de Direction</h2>
            <div class="team-grid">
                <div class="team-card">
                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Directeur Général" class="team-image">
                    <div class="team-info">
                        <div class="team-name">Amadou Diallo</div>
                        <div class="team-role">Directeur Général</div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team-card">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Directrice Radio" class="team-image">
                    <div class="team-info">
                        <div class="team-name">Fatouma Ibrahim</div>
                        <div class="team-role">Directrice de la Radio</div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team-card">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Directeur TV" class="team-image">
                    <div class="team-info">
                        <div class="team-name">Moussa Sani</div>
                        <div class="team-role">Directeur de la Télévision</div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <div class="team-card">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Directrice Communication" class="team-image">
                    <div class="team-info">
                        <div class="team-name">Aïcha Abdou</div>
                        <div class="team-role">Directrice de la Communication</div>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/Front/About/index.js") }}"></script>

</body>
</html>