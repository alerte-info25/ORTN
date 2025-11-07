<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Communiqués - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/communiquesListe.css") }}">
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
                <div class="header-title">
                    <h1>Liste des Communiqués</h1>
                </div>
            </div>

            <div class="user-info">
                <div class="user-details">
                    @include("back.partials.link")
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
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-title">
                    <h2>Gestion des Communiqués</h2>
                    <p class="page-subtitle">Consultez et gérez tous les communiqués publiés</p>
                </div>
                <div class="page-actions">
                    <button class="btn btn-primary" onclick="window.location.href='{{ route('dashboard.communiques') }}'">
                        <i class="fas fa-plus"></i>
                        Nouveau Communiqué
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon published">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-number">{{ $allCount }}</div>
                        <div class="stat-label">Communiqués publiés</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon published">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-info">
                        <div class="stat-number">{{ $viewsCount }}</div>
                        <div class="stat-label">Vues totales</div>
                    </div>
                </div>
            </div>

            <!-- Communiqués Table -->
            <div class="communiques-container">
                <div class="table-header">
                    <h3 class="table-title">Communiqués récents</h3>
                    <div class="table-actions">
                        <span class="form-hint">{{ $allCount }} communiqués au total</span>
                    </div>
                </div>

                <div class="table-container">
                    <table class="communiques-table">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Source</th>
                                <th>Date de publication</th>
                                <th>Statut</th>
                                <th>Vues</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="communiquesTableBody">
                            @forelse ($communiques as $communique)
                                <tr>
                                    <td>
                                        <div class="communique-title">{{ $communique->title }}</div>
                                    </td>
                                    <td>
                                        <div class="communique-source">{{ $communique->subtitle }}</div>
                                    </td>
                                    <td>{{ $communique->created_at->diffForHumans() }}</td>
                                    <td>
                                        <span class="status-badge status-published">
                                            Publié
                                        </span>
                                    </td>
                                    <td>{{ $communique->views_count }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('dashboard.communiques.show', ['communique' => $communique->slug]) }}" 
                                                class="action-btn view" 
                                                title="Voir" 
                                                style="text-decoration: none">
                                                    <i class="fas fa-eye"></i>
                                            </a>

                                            <form action="{{ route('dashboard.communiques.destroy', ['communique' => $communique->slug]) }}" 
                                                method="POST" 
                                                onsubmit="return confirm('Voulez-vous supprimer ce communiqué ?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="action-btn delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-warning">Aucun comuniqué trouvé.</div>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    {{ $communiques->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset("js/back/communiquesListe.js") }}"></script>
</body>
</html>