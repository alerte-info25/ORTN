<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sondages - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    {{-- local css --}}
    <link rel="stylesheet" href="{{ asset("css/back/sondagesListe.css") }}">
</head>
<body>
    <!-- Loader -->
    @include("back.partials.loader")

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route("dashboard.audios") }}" class="sidebar-brand">
                    @if (file_exists(public_path('storage/ORTNlogo.jpg')))
                        <img src="{{  asset('storage/ORTNlogo.jpg') }}" alt="Logo Hayba" style="width:100px; height:75px; object-fit:contain;">
                    @else
                        <i class="fas fa-broadcast-tower"></i>
                        <span>ORTN Admin</span>
                    @endif
                </a>
            </div>

            @include("back.partials.sidebar")
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="user-menu">
                    <div class="user-info">
                        <div class="user-details">
                            @include("back.partials.link")
                        </div>
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
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Page Header -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Sondages</h1>
                        <p class="page-description">Créez et gérez vos sondages interactifs</p>
                        @if (session()->has("alert"))
                            <div class="alert alert-{{ session("alert")["type"] }}">
                                {{ session("alert")["message"] }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon red">
                            <i class="fas fa-poll"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $sondagesCount }}</div>
                            <div class="stat-label">Total Sondages</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $sondagesActif }}</div>
                            <div class="stat-label">En cours</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon blue">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $sondagesParticipations }}</div>
                            <div class="stat-label">Participants</div>
                        </div>
                    </div>
                </div>
                
                <!-- Polls Grid -->
                <div class="polls-grid" id="pollsGrid">

                    @forelse ($sondagesAll as $sondage)
                        @php
                            $status = 'Terminé';
                            $badgeClass = 'bg-secondary';
                            $now = now();

                            if ($sondage->actif) {
                                if ($sondage->date_debut && $sondage->date_fin && $now->between($sondage->date_debut, $sondage->date_fin)) {
                                    $status = 'En cours';
                                    $badgeClass = 'bg-success';
                                } elseif ($sondage->date_debut && $now->lt($sondage->date_debut)) {
                                    $status = 'À venir';
                                    $badgeClass = 'bg-info';
                                }
                            }

                            $options = [];
                            foreach (range(1, 5) as $i) {
                                if (!empty($sondage->{'option' . $i})) {
                                    $options[] = $sondage->{'option' . $i};
                                }
                            }
                        @endphp

                        <div class="poll-card"
                            data-id="{{ $sondage->id }}"
                            data-title="{{ $sondage->titre }}"
                            data-description='@json($sondage->description)'
                            data-status="{{ $status }}"
                            data-date="{{ $sondage->created_at->diffForHumans() }}"
                            data-datefin="{{ \Carbon\Carbon::parse($sondage->date_fin)->diffForHumans() }}"
                            data-author="{{ $sondage->redacteur->user->nom }} {{ $sondage->redacteur->user->prenom }}"
                            data-options='@json($options)'>
                            
                            <div class="poll-header">
                                <span class="poll-status {{ $badgeClass }}">{{ $status }}</span>
                                <div class="poll-number">Sondage #{{ $loop->iteration }}</div>
                                <h3 class="poll-title">{{ $sondage->titre }}</h3>
                                <div class="poll-date">
                                    <i class="fas fa-calendar"></i> {{ $sondage->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="poll-content">
                                <p class="poll-question">{!! Str::limit(strip_tags($sondage->description), 150, '...') !!}</p>

                                <div class="poll-footer">
                                    <div class="poll-author">
                                        <div class="author-avatar">SM</div>
                                        <span>{{ $sondage->redacteur->user->nom }} {{ $sondage->redacteur->user->prenom }}</span>
                                    </div>
                                    <div class="poll-actions">
                                        <button class="action-btn btn-view" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <form action="{{ route('dashboard.sondage.delete', ['sondage' => $sondage->id]) }}" method="POST" onsubmit="return confirm('Voulez-vous supprimer ce sondage ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="action-btn btn-delete" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    @empty
                        <div class="alert alert-warning">Aucun sondage trouvé</div>
                    @endforelse

                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination">
                    {{ $sondagesAll->links() }}
                </nav>
            </div>
        </div>
    </div>

    <!-- Poll Results Modal -->
    <div id="pollModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pollModalTitle">Titre du sondage</h3>
                <button class="close-btn" id="closePollModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="poll-preview">
                    <div class="preview-meta" id="pollPreviewMeta"></div>
                    <div class="preview-description" id="pollPreviewDescription"></div>
                    <div class="preview-options" id="pollPreviewOptions"></div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/sondagesListe.js") }}"></script>
</body>
</html>