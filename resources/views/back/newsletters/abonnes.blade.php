<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Abonnés - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/abonnes.css") }}">
</head>
<body>

    <!-- Loader -->
    <div id="loader">
        <div class="loader-content">
            <div class="loader-icon">
                @if (file_exists(public_path('storage/ORTNlogo.jpg')))
                    <img src="{{  asset('storage/ORTNlogo.jpg') }}" alt="Logo Hayba" style="width:450px; height:250px; object-fit:contain;">
                @else
                    <i class="fas fa-broadcast-tower"></i>
                @endif
            </div>
            <div class="loader-text">ORTN</div>
            <div class="loader-subtext" style="color: #fff">Abonnés</div>
            <div class="progress-bar-container">
                <div class="progress" id="loadingProgress"></div>
            </div>
        </div>
    </div>

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
                    <div class="page-title-section">
                        <h1 class="page-title">Liste des Abonnés</h1>
                        <p class="page-description">Gérez vos abonnés et suivez leur engagement</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div>
                                <div class="stat-title">Total Abonnés</div>
                                <div class="stat-value" id="totalSubscribers">{{ $abonnesCount }}</div>
                            </div>
                            <div class="stat-icon primary">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Container -->
                <div class="table-container">
                    
                    <div class="subscribers-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Abonné</th>
                                    <th>email</th>
                                    <th>Date d'inscription</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody id="subscribersTableBody">

                                @forelse ($abonnesAll as $abonnes)

                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="subscriber-info">
                                                <div class="subscriber-details">
                                                    <div class="subscriber-email">{{ $abonnes->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($abonnes->date_abonnement)->diffForHumans() }}</td>
                                        <td>
                                            <span class="status-badge ">
                                                {{ $abonnes->actif == 1 ? 'Actif' : 'Non actif' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">Aucun abonné trouvé</div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        {{ $abonnesAll->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/abonnes.js") }}"></script>
</body>
</html>