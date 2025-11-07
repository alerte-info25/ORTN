<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Redacteurs - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/redacteursListe.css") }}">
</head>
<body>

    @include("back.partials.loader")

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="dashboard-container">
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

        <div class="main-content">
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

            <div class="content-area">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Liste des Redacteurs</h1>
                        <p class="page-description">Gérez votre équipe ORTN</p>
                    </div>
                </div>

                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon red">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-value">{{ $redacteursCount }}</div>
                        <div class="stat-label">Total rédacteurs</div>
                        @if (session()->has("alert"))
                            <div class="alert alert-{{ session("alert")["type"] }}">
                                {{ session("alert")["message"] }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="table-card">
                    <div class="table-header">
                        <h3 class="table-title">Tous les redacteurs</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="employees-table" id="employeesTable">
                            <thead>
                                <tr>
                                    <th>Employé</th>
                                    <th>Département</th>
                                    <th>Poste</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="employeesTableBody">
                                @forelse ($redacteurs as $redacteur)
                                    @if ($redacteur->user->role !== "admin")
                                        <tr>
                                            <td>
                                                <div class="employee-info">
                                                    <div class="employee-details">
                                                        <div class="employee-name">{{ $redacteur->user->nom . " " . $redacteur->user->prenom }}</div>
                                                        <div class="employee-id">{{ $redacteur->matricule }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $redacteur->departement->libelle }}</td>
                                            <td>{{ $redacteur->profession }}</td>
                                            <td>{{ $redacteur->user->email }}</td>
                                            <td>{{ $redacteur->user->contacts->pluck('libelle')->join(', ') }}</td>
                                            <td>{{ $redacteur->user->actif == 1 ? "actif" : "non actif" }}</td>
                                            <td>
                                                <form action="{{ route("dashboard.redacteur.delete", ['redacteur' => $redacteur->id]) }}" method="POST" onsubmit="return confirm ('voulez-vous supprimer ce redacteur ? l\' action est irreversible')">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button>
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <div class="alert alert-warning">Aucun redacteur trouvé</div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination" id="pagination">
                        {{ $redacteurs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/redacteursListe.js") }}"></script>
</body>
</html>