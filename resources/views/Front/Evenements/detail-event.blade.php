<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Festival des Arts et Culture - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Evenements/detail-event.css") }}">
</head>
<body>
    <div class="animated-bg"></div>

    <div id="loader">
        <div class="loader-container">
            <div class="loader-logo">ORTN</div>
            <div class="loader-bar">
                <div class="loader-progress" id="loaderProgress"></div>
            </div>
        </div>
    </div>

    @include("Front.partials.header")

    <section class="event-hero">
        <img src="{{ $event->image ? asset('storage/' . $event->image) : "https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80" }}" alt="{{ $event->event_name }}" class="event-hero-image">
        <div class="event-hero-overlay"></div>
        <div class="container">
            <div class="event-hero-content">
                <h1 class="event-hero-title">{{ $event->title }}</h1>
                <div class="event-hero-meta">
                    {{-- Date --}}
                    <div class="hero-meta-item">
                        <div class="hero-meta-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.9rem; opacity: 0.8;">Date</div>
                            <div style="font-weight: 700;">
                                {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </div>

                    {{-- Horaire --}}
                    <div class="hero-meta-item">
                        <div class="hero-meta-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.9rem; opacity: 0.8;">Horaire</div>
                            <div style="font-weight: 700;">
                                {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                            </div>
                        </div>
                    </div>

                    {{-- Lieu --}}
                    <div class="hero-meta-item">
                        <div class="hero-meta-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.9rem; opacity: 0.8;">Lieu</div>
                            <div style="font-weight: 700;">
                                {{ $event->address ?? 'Lieu non précisé' }}
                            </div>
                        </div>
                    </div>

                    {{-- Tarif --}}
                    <div class="hero-meta-item">
                        <div class="hero-meta-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div>
                            <div style="font-size: 0.9rem; opacity: 0.8;">Tarif</div>
                            <div style="font-weight: 700;">
                                {{ strtolower($event->access_type) === 'free' ? 'Entrée gratuite' : ($event->price ?? 'Tarif non précisé') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="event-main">
        <div class="container">
            <div class="event-content-grid">
                <div class="event-content-main">
                    <div class="content-section">
                        <h2 class="section-title">À propos de l'événement</h2>
                        <p class="content-text" style="text-align: justify">
                            {{ $event->description }}
                        </p>
                    </div>
                </div>

                <div class="event-sidebar">
                    <div class="sidebar-card">
                        <h3 class="sidebar-title">Informations clés</h3>

                        {{-- Dates --}}
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Date début</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}
                                </div>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Date fin</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y') }}
                                </div>
                            </div>
                        </div>

                        {{-- Horaires --}}
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Horaire début</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                                </div>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Horaire fin</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                </div>
                            </div>
                        </div>

                        {{-- Lieu --}}
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Lieu</div>
                                <div class="info-value">
                                    {{ $event->address }}, {{ $event->city }}
                                </div>
                            </div>
                        </div>

                        {{-- Tarif --}}
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Tarif</div>
                                <div class="info-value">
                                    {{ strtolower($event->access_type) === 'free' ? 'Entrée gratuite' : ($event->price ?? 'Tarif non précisé') }}
                                </div>
                            </div>
                        </div>

                        {{-- Participants --}}
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Participants</div>
                                <div class="info-value">
                                    {{ $event->capacity }} attendus
                                </div>
                            </div>
                        </div>

                        {{-- CTA inscription --}}
                        <div class="cta-buttons">
                            @if (strtolower($event->access_type) !== 'free')
                                <a href="{{ route('ortn.payments', ['slug' => $event->slug]) }}" class="btn-primary-cta">
                                    <i class="fas fa-check-circle"></i>
                                    S'inscrire gratuitement
                                </a>
                            @endif
                            <a href="#" class="btn-secondary-cta">
                                <i class="fas fa-calendar-plus"></i>
                                Ajouter au calendrier
                            </a>
                        </div>

                        {{-- Partage --}}
                        <div class="share-section">
                            <div class="share-title">Partager cet événement</div>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" class="share-btn facebook" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}" class="share-btn twitter" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode(request()->fullUrl()) }}" class="share-btn whatsapp" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" class="share-btn linkedin" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-card organizer-card">
                        <h3 class="sidebar-title">Organisateur</h3>
                        <div class="organizer-logo">
                            <i class="fas fa-radio"></i>
                        </div>
                        <div class="organizer-name">{{ $event->organizer }}</div>
                        <p class="organizer-description">
                            <a href="mailto:{{ $event->organizer_email }}">{{ $event->organizer_email }}</a>
                            <br>
                            <a href="tel:{{ $event->organizer_phone }}">{{ $event->organizer_phone }}</a>
                        </p>
                        <a href="mailto:{{ $event->organizer_email }}" class="contact-btn">
                            <i class="fas fa-envelope"></i>
                            Contacter l'organisateur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($similares->count())
        <section class="related-events">
            <div class="container">
                <h2 class="section-title-modern">Événements similaires</h2>
                <div class="events-grid">
                    @foreach ($similares as $event)
                        @php
                            $start = \Carbon\Carbon::parse($event->start_date);
                            $dateFormatted = $start->translatedFormat('d F Y');
                        @endphp

                        <div class="event-card">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->event_name }}" class="event-image">
                            <div class="event-card-content">
                                <div class="event-card-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $dateFormatted }}
                                </div>
                                <h3 class="event-card-title">{{ $event->event_name }}</h3>
                                <div class="event-card-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $event->address ?? 'Lieu non précisé' }}, {{ $event->city }}
                                </div>
                                <a href="{{ route("ortn.evenements.show", ["slug" => $event->slug]) }}" class="event-card-btn">Voir les détails</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/Front/Evenements/detail-event.js") }}"></script>
</body>
</html>