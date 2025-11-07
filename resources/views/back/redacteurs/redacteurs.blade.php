<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Employé - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/redacteurs.css") }}">
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
                    <h1 class="page-title">Ajouter un Employé</h1>
                    <p class="page-description">Enregistrez un nouveau membre de l'équipe ORTN</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session()->has("alert"))
                    @if (session('alert')['type'] == 'success')

                        <!-- Success Modal -->
                        <div class="success-modal show" id="successModal">
                            <div class="success-content">
                                <button class="close-btn" id="closeModal">&times;</button>

                                <div class="success-icon">
                                    <i class="fas fa-check"></i>
                                </div>

                                <h2 class="success-title">Employé ajouté avec succès !</h2>
                                <p class="success-message">
                                    <strong>{{ session('alert')['nom'] ?? '' }}</strong> a été ajouté à la base de données ORTN.<br>
                                    Son matricule est : <strong>{{ session('alert')['matricule'] ?? '' }}</strong>
                                </p>

                                <button class="btn btn-primary" onclick="window.location.href='{{ route('dashboard.redacteursListe') }}'">
                                    <i class="fas fa-users"></i> Voir la liste des employés
                                </button>
                            </div>
                        </div>
                    @endif
                @endif


                <!-- Form Container -->
                <div class="form-container">
                    <form id="employeeForm" method="POST" action="{{ route("dashboard.redacteurs.post") }}">
                        @csrf
                        <!-- Informations personnelles -->
                        <div class="form-card">
                            <h2 class="form-section-title">
                                <i class="fas fa-user"></i>
                                Informations personnelles
                            </h2>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        Nom <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="lastName" name="nom" placeholder="Ex: Kouassi" value="{{ old("nom") }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Prénoms <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="firstName" name="prenom" value="{{ old("prenom") }}" placeholder="Ex: Jean-Baptiste" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Genre <span class="required">*</span>
                                </label>
                                <select class="form-select" id="gender" name="genre" required>
                                    <option value="">Sélectionnez</option>
                                    <option value="homme">Homme</option>
                                    <option value="femme">Femme</option>
                                    <option value="autres">autres</option>
                                </select>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        Numéro de téléphone <span class="required">*</span>
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="contact" placeholder="+225 XX XX XX XX XX" value="{{ old("contact") }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Email <span class="required">*</span>
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="exemple@ORTN.ci" value="{{ old("email") }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Adresse complète
                                </label>
                                <input type="text" class="form-control" id="address" name="localite" placeholder="Commune, quartier, rue" value="{{ old("localite") }}">
                            </div>
                        </div>

                        <!-- Informations professionnelles -->
                        <div class="form-card">
                            <h2 class="form-section-title">
                                <i class="fas fa-briefcase"></i>
                                Informations professionnelles
                            </h2>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        Poste <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="position" name="poste" placeholder="Ex: Journaliste, Technicien, etc." value="{{ old("poste") }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        Département <span class="required">*</span>
                                    </label>
                                    <select class="form-select" id="department" name="departement" required>
                                        <option value="">Sélectionnez un département</option>
                                        <option value="redaction">Rédaction</option>
                                        <option value="technique">Technique</option>
                                        <option value="production">Production</option>
                                        <option value="administration">Administration</option>
                                        <option value="marketing">Marketing</option>
                                        <option value="communication">Communication</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Date d'embauche <span class="required">*</span>
                                </label>
                                <input type="date" class="form-control" id="hireDate" name="date_embauche" value="{{ old("date_embauche") }}" required>
                            </div>                            
                        </div>

                        <!-- Boutons d'action -->
                        <div class="form-card">
                            <div class="action-buttons">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-check"></i>
                                    Ajouter l'employé
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/redacteurs.js") }}"></script>
</body>
</html>