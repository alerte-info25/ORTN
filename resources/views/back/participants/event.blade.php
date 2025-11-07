<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants de l'Événement - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("css/back/showParticipantByEvent.css") }}">
</head>
<body>

    @include("back.partials.loader")

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

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
                    <h1>Participants</h1>
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

            <!-- Filters Section -->
            <div class="filters-section">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label class="filter-label">Date d'inscription</label>
                        <input type="date" class="filter-input" id="dateFilter">
                    </div>

                    <button class="btn-filter" onclick="applyFilters()">
                        <i class="fas fa-filter"></i>
                        Filtrer
                    </button>
                </div>
            </div>

            <!-- Participants Section -->
            <div class="participants-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-users"></i>
                        Liste des Participants
                    </h2>
                </div>

                <!-- Participants Grid -->
                <div class="participants-grid" id="participantsGrid">
                    @forelse ($participants as $participant)
                        <div class="participant-card">
                            <div class="participant-header">
                                <div class="participant-avatar avatar-orange">
                                    {{ strtoupper(substr($participant->prenom, 0, 1) . substr($participant->nom, 0, 1)) }}
                                </div>
                                <div class="participant-info">
                                    <div class="participant-name">{{ $participant->prenom }} {{ $participant->nom }}</div>
                                    <div class="participant-role">{{ $participant->pivot->status ?? '—' }}</div>
                                </div>
                            </div>

                            <div class="participant-status status-{{ $participant->pivot->status }}">
                                <i class="fas {{ $statusIcons[$participant->pivot->status] ?? 'fa-question' }}"></i>
                                {{ ucfirst($participant->pivot->status) }}
                            </div>

                            <div class="participant-details">
                                <div class="detail-row">
                                    <div class="detail-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="detail-text">{{ $participant->organisation ?? '—' }}</div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="detail-text">{{ $participant->email ?? '—' }}</div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="detail-text">{{ $participant->telephone ?? '—' }}</div>
                                </div>
                            </div>

                            <div class="participant-actions">
                                <a class="btn-action btn-view" style="text-decoration: none">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    {{ $participant->created_at->diffForHumans() }}
                                </a>
                                <a href="mailto:{{ $participant->email }}" class="btn-action btn-contact" style="text-decoration: none">
                                    <i class="fas fa-envelope"></i>
                                    Contact
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">Aucun participant inscrit pour cet événement.</p>
                    @endforelse
                </div>


                <!-- Pagination -->
                <div class="pagination">
                    {{ $participants->appends(request()->query())->links() }}
                </div>

            </div>
        </div>

    </div>

    <script src="{{ asset("js/back/showParticipantByEvent.js") }}"></script>

</body>
</html>
