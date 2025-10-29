<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programmes - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Programmes/index.css") }}">
</head>
<body>

    @include("Front.partials.loader")
    
    @include("Front.partials.header")

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <div class="breadcrumb-nav">
                    <a href="#"><i class="fas fa-home"></i> Accueil</a>
                    <span>/</span>
                    <span style="color: var(--gold);">Programmes</span>
                </div>
                <h1 class="page-title">
                    Nos <span class="highlight">Programmes</span> TV & Radio
                </h1>
                <p class="page-description">
                    Découvrez notre grille complète de programmes. Des émissions variées et de qualité 
                    pour informer, divertir et enrichir votre quotidien 24h/24.
                </p>
            </div>
        </div>
    </section>

    <!-- Schedule Tabs -->
    <section class="schedule-tabs-section" id="scheduleTabsSection">
        <div class="container">
            <div class="schedule-tabs">
                <button class="schedule-tab active" data-type="all">
                    <i class="fas fa-th-large"></i>
                    Tous les programmes
                </button>
                <button class="schedule-tab" data-type="tv">
                    <i class="fas fa-tv"></i>
                    Télévision
                </button>
                <button class="schedule-tab" data-type="radio">
                    <i class="fas fa-microphone"></i>
                    Radio
                </button>
                <button class="schedule-tab" data-type="timeline">
                    <i class="fas fa-calendar-alt"></i>
                    Grille hebdomadaire
                </button>
            </div>
        </div>
    </section>

    <!-- Weekly Schedule Section -->
    <section class="weekly-schedule" id="weeklySchedule" style="display: none;">
        <div class="container">
            <div class="day-selector">
                <button class="day-btn active" data-day="lundi">
                    <div class="day-name">Lundi</div>
                    <div class="day-date">30 Oct</div>
                </button>
                <button class="day-btn" data-day="mardi">
                    <div class="day-name">Mardi</div>
                    <div class="day-date">31 Oct</div>
                </button>
                <button class="day-btn" data-day="mercredi">
                    <div class="day-name">Mercredi</div>
                    <div class="day-date">1 Nov</div>
                </button>
                <button class="day-btn" data-day="jeudi">
                    <div class="day-name">Jeudi</div>
                    <div class="day-date">2 Nov</div>
                </button>
                <button class="day-btn" data-day="vendredi">
                    <div class="day-name">Vendredi</div>
                    <div class="day-date">3 Nov</div>
                </button>
                <button class="day-btn" data-day="samedi">
                    <div class="day-name">Samedi</div>
                    <div class="day-date">4 Nov</div>
                </button>
                <button class="day-btn" data-day="dimanche">
                    <div class="day-name">Dimanche</div>
                    <div class="day-date">5 Nov</div>
                </button>
            </div>

            <div class="timeline-container">
                <div class="timeline-programs" id="timelinePrograms">
                    <!-- Lundi Programs -->
                    <div class="timeline-program">
                        <div class="program-time">
                            <div class="program-time-start">06:00</div>
                            <div class="program-time-end">07:30</div>
                        </div>
                        <div class="program-icon">
                            <i class="fas fa-sun"></i>
                        </div>
                        <div class="program-details">
                            <span class="program-category">Matinale Radio</span>
                            <h3 class="program-title">Bonjour Niger</h3>
                            <p class="program-description">
                                Démarrez votre journée avec les dernières actualités, la météo et une sélection musicale énergisante.
                            </p>
                            <div class="program-meta">
                                <span><i class="fas fa-microphone"></i> Radio</span>
                                <span><i class="fas fa-user"></i> Amadou Diallo</span>
                                <span><i class="fas fa-clock"></i> 90 min</span>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-program">
                        <div class="program-time">
                            <div class="program-time-start">07:30</div>
                            <div class="program-time-end">08:00</div>
                        </div>
                        <div class="program-icon" style="background: linear-gradient(135deg, var(--navy-blue), var(--dark-navy));">
                            <i class="fas fa-newspaper" style="color: var(--gold);"></i>
                        </div>
                        <div class="program-details">
                            <span class="program-category">Actualités TV</span>
                            <h3 class="program-title">Journal du Matin</h3>
                            <p class="program-description">
                                Toute l'actualité nationale et internationale avec nos correspondants et experts.
                            </p>
                            <div class="program-meta">
                                <span><i class="fas fa-tv"></i> Télévision</span>
                                <span><i class="fas fa-user"></i> Fatima Moussa</span>
                                <span><i class="fas fa-clock"></i> 30 min</span>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-program">
                        <div class="program-time">
                            <div class="program-time-start">12:00</div>
                            <div class="program-time-end">13:00</div>
                        </div>
                        <div class="program-icon" style="background: linear-gradient(135deg, var(--green), var(--dark-green));">
                            <i class="fas fa-utensils" style="color: white;"></i>
                        </div>
                        <div class="program-details">
                            <span class="program-category">Magazine TV</span>
                            <h3 class="program-title">À Table avec l'ORTN</h3>
                            <p class="program-description">
                                Découvrez les saveurs du Niger avec nos chefs et leurs recettes traditionnelles revisitées.
                            </p>
                            <div class="program-meta">
                                <span><i class="fas fa-tv"></i> Télévision</span>
                                <span><i class="fas fa-user"></i> Aïcha Ibrahim</span>
                                <span><i class="fas fa-clock"></i> 60 min</span>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-program">
                        <div class="program-time">
                            <div class="program-time-start">20:00</div>
                            <div class="program-time-end">20:30</div>
                        </div>
                        <div class="program-icon" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                            <i class="fas fa-bullhorn" style="color: white;"></i>
                        </div>
                        <div class="program-details">
                            <span class="program-category">Journal Principal</span>
                            <h3 class="program-title">Le 20h - Journal du Soir</h3>
                            <p class="program-description">
                                Le rendez-vous quotidien pour suivre l'essentiel de l'actualité du jour en profondeur.
                            </p>
                            <div class="program-meta">
                                <span><i class="fas fa-tv"></i> Télévision</span>
                                <span><i class="fas fa-user"></i> Issoufou Garba</span>
                                <span><i class="fas fa-clock"></i> 30 min</span>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-program">
                        <div class="program-time">
                            <div class="program-time-start">21:00</div>
                            <div class="program-time-end">22:30</div>
                        </div>
                        <div class="program-icon" style="background: linear-gradient(135deg, #9b59b6, #8e44ad);">
                            <i class="fas fa-film" style="color: white;"></i>
                        </div>
                        <div class="program-details">
                            <span class="program-category">Cinéma TV</span>
                            <h3 class="program-title">Ciné Lundi</h3>
                            <p class="program-description">
                                Une sélection des meilleurs films africains et internationaux pour votre soirée.
                            </p>
                            <div class="program-meta">
                                <span><i class="fas fa-tv"></i> Télévision</span>
                                <span><i class="fas fa-user"></i> Production ORTN</span>
                                <span><i class="fas fa-clock"></i> 90 min</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Grid -->
    <section class="programs-grid-section" id="programsGrid">
        <div class="container">
            <div class="section-header-modern">
                <h2 class="section-title-modern">Programmes Phares</h2>
            </div>

            <div class="programs-grid">
                <!-- Program 1 -->
                <div class="program-card" data-type="tv">
                    <div class="program-card-header">
                        <div class="program-card-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="program-card-time">20:00</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Actualités TV</span>
                        <h3 class="program-card-title">Le Journal du Soir</h3>
                        <p class="program-card-description">
                            Le rendez-vous incontournable de l'information. Toute l'actualité nationale 
                            et internationale analysée en profondeur.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Issoufou Garba</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 30 min</span>
                        </div>
                    </div>
                </div>

                <!-- Program 2 -->
                <div class="program-card" data-type="radio">
                    <div class="program-card-header" style="background: linear-gradient(135deg, var(--green), var(--dark-green));">
                        <div class="program-card-icon">
                            <i class="fas fa-microphone-alt"></i>
                        </div>
                        <div class="program-card-time">07:00</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Matinale Radio</span>
                        <h3 class="program-card-title">Bonjour Niger</h3>
                        <p class="program-card-description">
                            Commencez votre journée avec l'essentiel de l'actualité, la météo et 
                            une sélection musicale dynamique.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Amadou Diallo</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 90 min</span>
                        </div>
                    </div>
                </div>

                <!-- Program 3 -->
                <div class="program-card" data-type="tv">
                    <div class="program-card-header" style="background: linear-gradient(135deg, #e74c3c, #c0392b);">
                        <div class="program-card-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="program-card-time">Mer 20:30</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Débat TV</span>
                        <h3 class="program-card-title">Face à Face</h3>
                        <p class="program-card-description">
                            Un débat citoyen sur les sujets d'actualité qui concernent les Nigériens. 
                            Échanges libres et constructifs.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Mariama Sani</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 60 min</span>
                        </div>
                    </div>
                </div>

                <!-- Program 4 -->
                <div class="program-card" data-type="radio">
                    <div class="program-card-header" style="background: linear-gradient(135deg, #3498db, #2980b9);">
                        <div class="program-card-icon">
                            <i class="fas fa-music"></i>
                        </div>
                        <div class="program-card-time">18:00</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Musique Radio</span>
                        <h3 class="program-card-title">Sons du Sahel</h3>
                        <p class="program-card-description">
                            Découvrez les talents musicaux du Niger et de l'Afrique de l'Ouest. 
                            Une célébration de notre patrimoine musical.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Halima Ousmane</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 120 min</span>
                        </div>
                    </div>
                </div>

                <!-- Program 5 -->
                <div class="program-card" data-type="tv">
                    <div class="program-card-header" style="background: linear-gradient(135deg, #f39c12, #e67e22);">
                        <div class="program-card-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div class="program-card-time">Sam 18:00</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Culture TV</span>
                        <h3 class="program-card-title">Horizon Culturel</h3>
                        <p class="program-card-description">
                            Plongez dans la richesse du patrimoine culturel nigérien à travers 
                            reportages, rencontres et découvertes.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Aïcha Ibrahim</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 45 min</span>
                        </div>
                    </div>
                </div>

                <!-- Program 6 -->
                <div class="program-card" data-type="radio">
                    <div class="program-card-header" style="background: linear-gradient(135deg, #16a085, #138d75);">
                        <div class="program-card-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="program-card-time">15:00</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Éducation Radio</span>
                        <h3 class="program-card-title">Apprendre Ensemble</h3>
                        <p class="program-card-description">
                            Un programme éducatif pour tous les âges. Cours, conseils et astuces 
                            pour enrichir vos connaissances.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Moussa Ali</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 60 min</span>
                        </div>
                    </div>
                </div>

                <!-- Program 7 -->
                <div class="program-card" data-type="tv">
                    <div class="program-card-header" style="background: linear-gradient(135deg, #27ae60, #229954);">
                        <div class="program-card-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <div class="program-card-time">Dim 10:00</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Agriculture TV</span>
                        <h3 class="program-card-title">Terre Fertile</h3>
                        <p class="program-card-description">
                            Conseils pratiques, innovations et témoignages d'agriculteurs pour 
                            développer l'agriculture nigérienne.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Abdou Harouna</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 50 min</span>
                        </div>
                    </div>
                </div>

                <!-- Program 8 -->
                <div class="program-card" data-type="radio">
                    <div class="program-card-header" style="background: linear-gradient(135deg, #8e44ad, #71368a);">
                        <div class="program-card-icon">
                            <i class="fas fa-moon"></i>
                        </div>
                        <div class="program-card-time">22:00</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Nocturne Radio</span>
                        <h3 class="program-card-title">Nuits du Niger</h3>
                        <p class="program-card-description">
                            Musique douce, poésie et récits pour accompagner vos nuits. 
                            Une ambiance apaisante jusqu'au petit matin.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Boubacar Maman</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 480 min</span>
                        </div>
                    </div>
                </div>

                <!-- Program 9 -->
                <div class="program-card" data-type="tv">
                    <div class="program-card-header" style="background: linear-gradient(135deg, #e67e22, #d35400);">
                        <div class="program-card-icon">
                            <i class="fas fa-football-ball"></i>
                        </div>
                        <div class="program-card-time">Dim 17:00</div>
                    </div>
                    <div class="program-card-content">
                        <span class="program-card-category">Sport TV</span>
                        <h3 class="program-card-title">Stade du Dimanche</h3>
                        <p class="program-card-description">
                            Résumés, analyses et débats sur l'actualité sportive nationale et 
                            internationale avec nos experts.
                        </p>
                        <div class="program-card-footer">
                            <div class="program-card-host">
                                <i class="fas fa-user-circle"></i>
                                <span>Issoufou Garba</span>
                            </div>
                            <span><i class="fas fa-clock"></i> 90 min</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset("js/Front/Programmes/index.js") }}"></script>
    
</body>
</html>