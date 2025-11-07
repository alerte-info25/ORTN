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
            </div>
        </div>
    </section>

    <section class="featured-event-section">
        @if ($todayEvent)
            <div class="container">
                <div class="featured-event">
                    <div class="featured-grid">
                        <div class="featured-image" style="background-image: url('{{ asset('storage/' . $todayEvent->image) }}');">
                            <span class="featured-badge">
                                <i class="fas fa-star"></i> Événement phare
                            </span>
                        </div>
                        <div class="featured-content">
                            <div class="featured-date">
                                <div class="date-box">
                                    <div class="date-day">{{ \Carbon\Carbon::parse($todayEvent->start_date)->format('d') }}</div>
                                    <div class="date-month">{{ \Carbon\Carbon::parse($todayEvent->start_date)->translatedFormat('F') }}</div>
                                </div>
                                <div class="featured-info">
                                    <div class="featured-info-item">
                                        <i class="fas fa-clock"></i>
                                        <span>{{ \Carbon\Carbon::parse($todayEvent->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($todayEvent->end_time)->format('H:i') }}</span>
                                    </div>
                                    <div class="featured-info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $todayEvent->address }}, {{ $todayEvent->city }}</span>
                                    </div>
                                    <div class="featured-info-item">
                                        <i class="fas fa-ticket-alt"></i>
                                        <span>{{ strtolower($todayEvent->access_type) === 'free' ? 'Entrée gratuite' : 'Payant' }}</span>
                                    </div>
                                </div>
                            </div>
                            <h2 class="featured-title">{{ $todayEvent->event_name }}</h2>
                            <p class="featured-description" style="text-align: justify">
                                {{ $todayEvent->description }}
                            </p>
                            <div class="featured-actions">
                                <a href="{{ route("ortn.evenements.show", ["slug" => $todayEvent->slug]) }}" class="btn-secondary-custom">
                                    <i class="fas fa-info-circle"></i>
                                    Plus d'informations
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </section>

    <section class="events-section">
        <div class="container">
            <h2 class="section-title-modern">Événements à venir</h2>
            <div class="events-grid">
                @foreach ($upcomingEvents as $event)
                    @include('Front.Evenements.event-card', ['event' => $event])
                @endforeach
            </div>
            
            <div class="pagination-wrapper">
                <div class="pagination-section">
                    {{ $upcomingEvents->appends(request()->except('upcoming_page'))->links() }}
                </div>
            </div>

            <h2 class="section-title-modern">Événements en cours</h2>
            <div class="events-grid">
                @foreach ($ongoingEvents as $event)
                    @include('Front.Evenements.event-card', ['event' => $event])
                @endforeach
            </div>

            <div class="pagination-wrapper">
                <div class="pagination-section">
                    {{ $ongoingEvents->appends(request()->except('ongoing_page'))->links() }}
                </div>
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

    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/Front/Evenements/index.js") }}"></script>

</body>
</html>