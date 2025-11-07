<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Événements - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("css/back/eventListe.css") }}">
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
                <div class="header-title">
                    <h1>Événements</h1>
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
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">évènements en cours</div>
                        <div class="stat-value">
                            {{ $ongoing }}
                        </div>
                    </div>
                    
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fa-solid fa-calendar-plus"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">évènements à venir</div>
                        <div class="stat-value">
                            {{ $upcoming }}
                        </div>
                    </div>                    
                </div>
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fa-solid fa-calendar-xmark"></i>  
                    </div>
                    <div class="stat-content">
                        <div class="stat-label">évènements passés</div>
                        <div class="stat-value">
                            {{ $past }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Events Container -->
            <div class="events-container">
                <div class="events-header">
                    <h2 class="events-title">Liste des événements</h2>
                    <div class="view-toggle">
                        <button class="view-btn active" id="tableView">
                            <i class="fas fa-list"></i>
                        </button>
                        <button class="view-btn" id="gridView">
                            <i class="fas fa-th-large"></i>
                        </button>
                    </div>
                </div>

                <!-- Table View -->
                <div id="tableViewContent">
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th>Événement</th>
                                <th>Date</th>
                                <th>Catégorie</th>
                                <th>Lieu</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="eventsTableBody">
                            @forelse($events as $event)
                                <tr>
                                    <td>
                                        <div class="event-info">
                                            <img 
                                                src="{{ $event->image ? asset('storage/' . $event->image) : 'https://via.placeholder.com/120x120?text=Event' }}" 
                                                alt="Event" 
                                                class="event-image"
                                            >
                                            <div class="event-details">
                                                <div class="event-title">{{ $event->title }}</div>
                                                <div class="event-meta">
                                                    <span><i class="fas fa-user"></i> {{ $event->participants_count }} participants</span>
                                                    @if($event->capacity)
                                                        <span><i class="fas fa-users"></i> {{ $event->capacity }} places disponibles</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="event-date">
                                            <div class="date-display">
                                                du {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} au 
                                                {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                            </div>
                                            <div class="time-display">
                                                {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="event-category category-{{ strtolower($event->category) }}">
                                            {{ ucfirst($event->category) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($event->format === 'online')
                                            En ligne
                                        @else
                                            {{ $event->venue ?? '—' }}, {{ $event->city ?? '' }}
                                        @endif
                                    </td>

                                    <td>
                                        @php
                                            $now = now();
                                            $start = \Carbon\Carbon::parse($event->start_date . ' ' . $event->start_time);
                                            $end = \Carbon\Carbon::parse($event->end_date . ' ' . $event->end_time);

                                            if ($now->lt($start)) {
                                                $statusClass = 'status-upcoming';
                                                $statusIcon = 'fa-clock';
                                                $statusText = 'À venir';
                                            } elseif ($now->between($start, $end)) {
                                                $statusClass = 'status-ongoing';
                                                $statusIcon = 'fa-bolt';
                                                $statusText = 'En cours';
                                            } else {
                                                $statusClass = 'status-past';
                                                $statusIcon = 'fa-history';
                                                $statusText = 'Terminé';
                                            }
                                        @endphp

                                        <span class="event-status {{ $statusClass }}">
                                            <i class="fas {{ $statusIcon }}"></i>
                                            {{ $statusText }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="event-actions">
                                            <a href="{{ route('dashboard.events.show', ["slug" => $event->slug]) }}" class="action-btn view" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form 
                                                action="{{ route('dashboard.events.destroy', $event->id) }}" 
                                                method="POST" 
                                                onsubmit="return confirm('Supprimer cet événement ?')" 
                                                style="display:inline;"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button class="action-btn delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-gray-500 py-4">
                                        Aucun événement trouvé
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Grid View -->
                <div id="gridViewContent" style="display: none;">
                    <div class="events-grid">
                        @forelse($events as $event)
                            @php
                                $now = now();
                                $start = \Carbon\Carbon::parse($event->start_date . ' ' . $event->start_time);
                                $end = \Carbon\Carbon::parse($event->end_date . ' ' . $event->end_time);

                                if ($now->lt($start)) {
                                    $statusClass = 'status-upcoming';
                                    $statusIcon = 'fa-clock';
                                    $statusText = 'À venir';
                                } elseif ($now->between($start, $end)) {
                                    $statusClass = 'status-ongoing';
                                    $statusIcon = 'fa-bolt';
                                    $statusText = 'En cours';
                                } else {
                                    $statusClass = 'status-past';
                                    $statusIcon = 'fa-history';
                                    $statusText = 'Terminé';
                                }
                            @endphp

                            <div class="event-card">
                                <img 
                                    src="{{ $event->image ? asset('storage/' . $event->image) : 'https://via.placeholder.com/400x200?text=Évènement' }}" 
                                    alt="{{ $event->title }}" 
                                    class="event-card-image"
                                >

                                <div class="event-card-body">
                                    <div class="event-card-header">
                                        <span class="event-card-category category-{{ strtolower($event->category) }}">
                                            {{ ucfirst($event->category) }}
                                        </span>
                                        <span class="event-status {{ $statusClass }}">
                                            <i class="fas {{ $statusIcon }}"></i>
                                            {{ $statusText }}
                                        </span>
                                    </div>

                                    <h3 class="event-card-title">{{ $event->title }}</h3>

                                    <div class="event-card-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        du {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} - au {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                        •
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                    </div>

                                    <div class="event-card-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        @if($event->format === 'online')
                                            En ligne
                                        @else
                                            {{ $event->venue ?? '—' }}, {{ $event->city ?? '' }}
                                        @endif
                                    </div>

                                    <div class="event-card-footer">
                                        <div class="event-meta">
                                            <i class="fas fa-users"></i>
                                            {{ $event->capacity ? $event->capacity . 'places disponibles' : 'places non définie' }}
                                        </div>
                                        <div class="event-meta">
                                            <i class="fas fa-users"></i>
                                            {{ $event->participants_count }} Participants
                                        </div>

                                        <div class="event-actions">
                                            <a href="{{ route('dashboard.events.show', ["slug" => $event->slug]) }}" class="action-btn view" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <form 
                                                action="{{ route('dashboard.events.destroy', $event->id) }}" 
                                                method="POST" 
                                                onsubmit="return confirm('Supprimer cet évènement ?')" 
                                                style="display:inline;"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button class="action-btn delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-gray-500 py-4 w-full">Aucun évènement trouvé.</p>
                        @endforelse
                    </div>
                </div>

            </div>
            <div class="custom-pagination">
                {{ $events->links() }}
            </div>
        </div>
    </div>

    <script src="{{ asset("js/back/eventListe.js") }}"></script>
</body>
</html>