<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Inscrits - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/inscrits.css") }}">
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
                        <h1 class="page-title">Liste des Inscrits</h1>
                        <p class="page-description">Gérez vos abonnés à la newsletter</p>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-icon red">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-value">{{ $clientCount }}</div>
                        <div class="stat-label">Total des inscrits</div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-container">
                    <table class="subscribers-table">
                        <thead>
                            <tr>
                                <th>
                                    N°
                                </th>
                                <th>Abonné</th>
                                <th>Date d'inscription</th>
                                <th>Statut</th>
                                <th>Catégories</th>
                            </tr>
                        </thead>
                        <tbody id="subscribersTableBody">

                            @forelse ($clients as $client)

                                @php
                                    $initials = strtoupper(substr($client->user->prenom,0,1) . substr($client->user->nom,0,1));
                                    $statusClass = $client->user->actif == 1 ? 'bg-success text-white' : 'bg-danger text-white';
                                @endphp
                            
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="subscriber-info">
                                            <div class="subscriber-avatar">{{ $initials }}</div>
                                            <div class="subscriber-details">
                                                <div class="subscriber-name">{{ $client->user->nom . " " . $client->user->prenom }}</div>
                                                <div class="subscriber-email">{{ $client->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $client->user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <span class="status-badge {{ $statusClass }}">
                                            {{ $client->user->actif == 1 ? 'Actif' : 'Non actif' }}
                                        </span>
                                    </td>
                                    <td>{{ $client->user->contacts->pluck('libelle')->join(', ') }}</td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">Aucun client inscrit</div>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination-container">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/inscrits.js") }}"></script>
</body>
</html>