<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Événement - {{ $event->title }} - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/eventShow.css") }}">
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @include("back.partials.loader")

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="sidebar-brand">
                <h2>ORTN</h2>
                <span>Admin Dashboard</span>
            </div>
        </div>

        @include("back.partials.sidebar")
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <button class="back-btn" onclick="window.history.back()">
                    <i class="fas fa-arrow-left"></i>
                    Retour
                </button>
                <div class="header-title">
                    <h1>Détails de l'Événement</h1>
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
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Event Hero Section -->
            <div class="event-hero">
                <div style="position: relative;">
                    <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&h=400&fit=crop' }}" alt="Event" class="event-hero-image">
                </div>

                <div class="event-hero-content">
                    <span class="event-status-badge status-publie">
                        <i class="fas fa-check-circle"></i>
                        Publié
                    </span>

                    <h1 class="event-title-main">
                        {{ $event->title }}
                    </h1>
                    <p class="event-subtitle" style="text-align: justify">
                        {{ $event->description }}
                    </p>

                    <div class="event-meta-row">
                        <div class="meta-item">
                            <div class="meta-icon date">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="meta-content">
                                <h4>Date début</h4>
                                <p>{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-icon date">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="meta-content">
                                <h4>Date fin</h4>
                                <p>{{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-icon time">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="meta-content">
                                <h4>Horaires</h4>
                                <p>{{ $event->start_time }} - {{ $event->end_time }}</p>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-icon location">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="meta-content">
                                <h4>Lieu</h4>
                                <p>{{ $event->venue }}, {{ $event->city }}</p>
                            </div>
                        </div>

                        <div class="meta-item">
                            <div class="meta-icon organizer">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="meta-content">
                                <h4>Organisateur</h4>
                                <p>{{ $event->organizer }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">

                <!-- Sidebar Info -->
                <div>
                    <!-- Event Info Card -->
                    <div class="info-card">
                        <h3 class="info-card-title">
                            <i class="fas fa-info-circle"></i>
                            Informations
                        </h3>

                        <div class="info-item">
                            <span class="info-label">Catégorie</span>
                            <span class="category-tag category-{{ strtolower($event->category) }}">
                                {{ $event->category }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Capacité</span>
                            <span class="info-value">
                                {{ $event->capacity }} {{ $event->capacity > 1 ? 'personnes' : 'personne' }}
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Accès</span>
                            <span class="info-value">
                                @if ($event->access_type == "paid")
                                    payant
                                @else
                                    gratuit
                                @endif
                            </span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Date de création</span>
                            <span class="info-value">
                                {{ \Carbon\Carbon::parse($event->created_at)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="info-card">
                        <h3 class="info-card-title">
                            <i class="fas fa-phone"></i>
                            Contact
                        </h3>

                        <div class="contact-list">
                            @if($event->organizer_email)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-label">Email</div>
                                        <div class="contact-value">{{ $event->organizer_email }}</div>
                                    </div>
                                </div>
                            @endif

                            @if($event->organizer_phone)
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-info">
                                        <div class="contact-label">Téléphone</div>
                                        <div class="contact-value">{{ $event->organizer_phone }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('dashboard.events.participants', ['slug' => $event->slug]) }}" class="btn btn-primary">
                        Voir les participants
                    </a>

                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset("js/back/eventShow.js") }}"></script>
</body>
</html>