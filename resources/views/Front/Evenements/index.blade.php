<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/Front/Evenements/index.css") }}">
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
                    <span>Événements</span>
                </div>
                <h1 class="page-title">Nos Événements</h1>
                <p class="page-subtitle">
                    Découvrez tous les événements culturels, sportifs et communautaires organisés et couverts par l'ORTN
                </p>
            </div>
        </div>
    </section>

    <section class="filters-section">
        <div class="container">
            <div class="filters-wrapper">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-th"></i> Tous les événements
                </button>
                <button class="filter-btn" data-filter="upcoming">
                    <i class="fas fa-calendar-plus"></i> À venir
                </button>
                <button class="filter-btn" data-filter="ongoing">
                    <i class="fas fa-broadcast-tower"></i> En cours
                </button>
                <button class="filter-btn" data-filter="culture">
                    <i class="fas fa-theater-masks"></i> Culture
                </button>
                <button class="filter-btn" data-filter="sport">
                    <i class="fas fa-futbol"></i> Sport
                </button>
                <button class="filter-btn" data-filter="community">
                    <i class="fas fa-users"></i> Communautaire
                </button>
            </div>
        </div>
    </section>

    <section class="featured-event-section">
        <div class="container">
            <div class="featured-event">
                <div class="featured-grid">
                    <div class="featured-image" style="background-image: url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');">
                        <span class="featured-badge">
                            <i class="fas fa-star"></i> Événement phare
                        </span>
                    </div>
                    <div class="featured-content">
                        <div class="featured-date">
                            <div class="date-box">
                                <div class="date-day">15</div>
                                <div class="date-month">Décembre</div>
                            </div>
                            <div class="featured-info">
                                <div class="featured-info-item">
                                    <i class="fas fa-clock"></i>
                                    <span>18h00 - 23h00</span>
                                </div>
                                <div class="featured-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Place de l'Indépendance, Moroni</span>
                                </div>
                                <div class="featured-info-item">
                                    <i class="fas fa-ticket-alt"></i>
                                    <span>Entrée gratuite</span>
                                </div>
                            </div>
                        </div>
                        <h2 class="featured-title">Festival des Arts et Culture de Ngazidja 2024</h2>
                        <p class="featured-description">
                            Rejoignez-nous pour la plus grande célébration culturelle de l'année ! Musique traditionnelle, danse, artisanat local, gastronomie comorienne et bien plus encore. Un événement familial exceptionnel organisé par l'ORTN.
                        </p>
                        <div class="featured-actions">
                            <a href="#" class="btn-primary-custom">
                                <i class="fas fa-ticket-alt"></i>
                                S'inscrire gratuitement
                            </a>
                            <a href="#" class="btn-secondary-custom">
                                <i class="fas fa-info-circle"></i>
                                Plus d'informations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="events-section">
        <div class="container">
            <h2 class="section-title-modern">Événements à venir</h2>
            <div class="events-grid">
                <div class="event-card" data-category="culture upcoming">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Concert" class="event-image">
                        <span class="event-category">Culture</span>
                        <span class="event-status upcoming">À venir</span>
                    </div>
                    <div class="event-content">
                        <div class="event-date-info">
                            <div class="event-date-box">
                                <div class="event-date-day">20</div>
                                <div class="event-date-month">Nov</div>
                            </div>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>19h00 - 22h00</span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Centre Culturel, Moroni</span>
                                </div>
                            </div>
                        </div>
                        <h3 class="event-title">Concert de Musique Traditionnelle</h3>
                        <p class="event-description">
                            Soirée dédiée à la musique traditionnelle comorienne avec les plus grands artistes locaux.
                        </p>
                        <div class="event-footer">
                            <div class="event-participants">
                                <i class="fas fa-users"></i>
                                <span class="participants-count">156</span> inscrits
                            </div>
                            <a href="#" class="event-btn">Détails</a>
                        </div>
                    </div>
                </div>

                <div class="event-card" data-category="sport upcoming">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1579952363873-27f3bade9f55?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Match" class="event-image">
                        <span class="event-category">Sport</span>
                        <span class="event-status upcoming">À venir</span>
                    </div>
                    <div class="event-content">
                        <div class="event-date-info">
                            <div class="event-date-box">
                                <div class="event-date-day">22</div>
                                <div class="event-date-month">Nov</div>
                            </div>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>15h00 - 17h00</span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Stade de Moroni</span>
                                </div>
                            </div>
                        </div>
                        <h3 class="event-title">Tournoi de Football Inter-Quartiers</h3>
                        <p class="event-description">
                            Grande finale du championnat inter-quartiers, retransmise en direct sur ORTN.
                        </p>
                        <div class="event-footer">
                            <div class="event-participants">
                                <i class="fas fa-users"></i>
                                <span class="participants-count">324</span> inscrits
                            </div>
                            <a href="#" class="event-btn">Détails</a>
                        </div>
                    </div>
                </div>

                <div class="event-card" data-category="community ongoing">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Forum" class="event-image">
                        <span class="event-category">Communautaire</span>
                        <span class="event-status ongoing">En cours</span>
                    </div>
                    <div class="event-content">
                        <div class="event-date-info">
                            <div class="event-date-box">
                                <div class="event-date-day">18</div>
                                <div class="event-date-month">Nov</div>
                            </div>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>09h00 - 17h00</span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Hôtel Al-Amal, Moroni</span>
                                </div>
                            </div>
                        </div>
                        <h3 class="event-title">Forum sur le Développement Durable</h3>
                        <p class="event-description">
                            Deux jours de conférences et d'ateliers sur les enjeux environnementaux aux Comores.
                        </p>
                        <div class="event-footer">
                            <div class="event-participants">
                                <i class="fas fa-users"></i>
                                <span class="participants-count">89</span> inscrits
                            </div>
                            <a href="#" class="event-btn">Détails</a>
                        </div>
                    </div>
                </div>

                <div class="event-card" data-category="culture upcoming">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1478737270239-2f02b77fc618?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Exposition" class="event-image">
                        <span class="event-category">Culture</span>
                        <span class="event-status upcoming">À venir</span>
                    </div>
                    <div class="event-content">
                        <div class="event-date-info">
                            <div class="event-date-box">
                                <div class="event-date-day">25</div>
                                <div class="event-date-month">Nov</div>
                            </div>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>10h00 - 18h00</span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Galerie Nationale</span>
                                </div>
                            </div>
                        </div>
                        <h3 class="event-title">Exposition d'Art Contemporain Comorien</h3>
                        <p class="event-description">
                            Découvrez les œuvres de jeunes artistes comoriens talentueux dans une exposition inédite.
                        </p>
                        <div class="event-footer">
                            <div class="event-participants">
                                <i class="fas fa-users"></i>
                                <span class="participants-count">67</span> inscrits
                            </div>
                            <a href="#" class="event-btn">Détails</a>
                        </div>
                    </div>
                </div>

                <div class="event-card" data-category="community upcoming">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Formation" class="event-image">
                        <span class="event-category">Communautaire</span>
                        <span class="event-status upcoming">À venir</span>
                    </div>
                    <div class="event-content">
                        <div class="event-date-info">
                            <div class="event-date-box">
                                <div class="event-date-day">28</div>
                                <div class="event-date-month">Nov</div>
                            </div>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>14h00 - 17h00</span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Studios ORTN</span>
                                </div>
                            </div>
                        </div>
                        <h3 class="event-title">Atelier de Formation en Journalisme</h3>
                        <p class="event-description">
                            Session de formation gratuite pour les jeunes aspirants journalistes, animée par l'équipe ORTN.
                        </p>
                        <div class="event-footer">
                            <div class="event-participants">
                                <i class="fas fa-users"></i>
                                <span class="participants-count">42</span> inscrits
                            </div>
                            <a href="#" class="event-btn">Détails</a>
                        </div>
                    </div>
                </div>

                <div class="event-card" data-category="sport upcoming">
                    <div style="position: relative;">
                        <img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Marathon" class="event-image">
                        <span class="event-category">Sport</span>
                        <span class="event-status upcoming">À venir</span>
                    </div>
                    <div class="event-content">
                        <div class="event-date-info">
                            <div class="event-date-box">
                                <div class="event-date-day">01</div>
                                <div class="event-date-month">Déc</div>
                            </div>
                            <div class="event-meta">
                                <div class="event-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>06h00 - 12h00</span>
                                </div>
                                <div class="event-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Ville de Moroni</span>
                                </div>
                            </div>
                        </div>
                        <h3 class="event-title">Marathon de Moroni 2024</h3>
                        <p class="event-description">
                            Course annuelle à travers la capitale avec plusieurs catégories pour tous les niveaux.
                        </p>
                        <div class="event-footer">
                            <div class="event-participants">
                                <i class="fas fa-users"></i>
                                <span class="participants-count">512</span> inscrits
                            </div>
                            <a href="#" class="event-btn">Détails</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="calendar-section">
        <div class="container">
            <h2 class="section-title-modern">Calendrier des événements</h2>
            <div class="calendar-wrapper">
                <div class="calendar-header">
                    <div class="calendar-month">Novembre 2024</div>
                    <div class="calendar-nav">
                        <button class="calendar-nav-btn">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="calendar-nav-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="calendar-grid">
                    <div class="calendar-day-header">Lun</div>
                    <div class="calendar-day-header">Mar</div>
                    <div class="calendar-day-header">Mer</div>
                    <div class="calendar-day-header">Jeu</div>
                    <div class="calendar-day-header">Ven</div>
                    <div class="calendar-day-header">Sam</div>
                    <div class="calendar-day-header">Dim</div>
                    
                    <div class="calendar-day"></div>
                    <div class="calendar-day"></div>
                    <div class="calendar-day"></div>
                    <div class="calendar-day"><span class="calendar-day-number">1</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">2</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">3</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">4</span></div>
                    
                    <div class="calendar-day"><span class="calendar-day-number">5</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">6</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">7</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">8</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">9</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">10</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">11</span></div>
                    
                    <div class="calendar-day"><span class="calendar-day-number">12</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">13</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">14</span></div>
                    <div class="calendar-day has-event"><span class="calendar-day-number">15</span><span class="calendar-event-dot"></span></div>
                    <div class="calendar-day"><span class="calendar-day-number">16</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">17</span></div>
                    <div class="calendar-day has-event"><span class="calendar-day-number">18</span><span class="calendar-event-dot"></span></div>
                    
                    <div class="calendar-day"><span class="calendar-day-number">19</span></div>
                    <div class="calendar-day has-event"><span class="calendar-day-number">20</span><span class="calendar-event-dot"></span></div>
                    <div class="calendar-day"><span class="calendar-day-number">21</span></div>
                    <div class="calendar-day has-event"><span class="calendar-day-number">22</span><span class="calendar-event-dot"></span></div>
                    <div class="calendar-day"><span class="calendar-day-number">23</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">24</span></div>
                    <div class="calendar-day has-event"><span class="calendar-day-number">25</span><span class="calendar-event-dot"></span></div>
                    
                    <div class="calendar-day"><span class="calendar-day-number">26</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">27</span></div>
                    <div class="calendar-day has-event"><span class="calendar-day-number">28</span><span class="calendar-event-dot"></span></div>
                    <div class="calendar-day"><span class="calendar-day-number">29</span></div>
                    <div class="calendar-day"><span class="calendar-day-number">30</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <i class="fas fa-calendar-check newsletter-icon"></i>
                <h2 class="newsletter-title">Ne manquez aucun événement</h2>
                <p class="newsletter-description">
                    Inscrivez-vous à notre newsletter pour recevoir toutes les annonces d'événements directement dans votre boîte mail
                </p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Votre adresse email" required>
                    <button type="submit" class="newsletter-btn">
                        <i class="fas fa-paper-plane"></i> S'abonner
                    </button>
                </form>
            </div>
        </div>
    </section>

    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/Front/Evenements/index.js") }}"></script>

</body>
</html>