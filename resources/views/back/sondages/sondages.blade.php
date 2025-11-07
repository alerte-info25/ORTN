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
    <link rel="stylesheet" href="{{ asset("css/back/sondages.css") }}">
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
                    <span>ORTN Admin</span>
                @endif
            </div>
            <div class="loader-text">ORTN</div>
            <div class="loader-subtext">Sondages</div>
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
                    <div>
                        <h1 class="page-title">Sondages</h1>
                        <p class="page-description">Créez et gérez vos sondages interactifs</p>
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

                <!-- Create Poll Form -->
                <div class="create-poll-section" id="createPollForm" style="display: block;">
                    <h2 class="section-title">
                        <i class="fas fa-edit"></i>
                        Créer un nouveau sondage
                    </h2>

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

                                    <h2 class="success-title">Sondage ajouté avec succès !</h2>
                                    <p class="success-message">
                                        <strong>{{ session('alert')['nom'] ?? '' }}</strong> Le sondage été ajouté à la base de données ORTN.<br>
                                    </p>

                                    <button class="btn btn-primary" onclick="window.location.href='{{ route('dashboard.sondagesListe') }}'">
                                        <i class="fas fa-users"></i> Voir la liste des sondages
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endif
                    
                    <form id="pollForm" method="POST" action="{{ route("dashboard.sondages.post") }}">
                        @csrf
                        <!-- Poll Title -->
                        <div class="form-group">
                            <label class="form-label" for="pollTitle">
                                Titre du sondage *
                            </label>
                            <input 
                                type="text" 
                                id="pollTitle" 
                                class="form-control" 
                                placeholder="Ex: Quelle est votre émission préférée ?"
                                name="title"
                                value="{{ old("title") }}"
                                required
                            >
                        </div>

                        <!-- Poll Description -->
                        <div class="form-group">
                            <label class="form-label" for="pollDescription">
                                Description
                            </label>
                            <textarea 
                                id="pollDescription" 
                                class="form-control" 
                                placeholder="Décrivez votre sondage (optionnel)"
                                name="description"
                                value="{{ old("description") }}"
                            ></textarea>
                        </div>

                        <!-- Poll Options -->
                        <div class="form-group">
                            <label class="form-label">
                                Options de réponse *
                            </label>
                            <div class="options-container" id="optionsContainer">
                                <div class="option-item">
                                    <input 
                                        type="text" 
                                        class="form-control option-input" 
                                        placeholder="Option 1"
                                        name="option1"
                                        value="{{ old("option1") }}"
                                        required
                                    >
                                </div>
                                <div class="option-item">
                                    <input 
                                        type="text" 
                                        class="form-control option-input" 
                                        placeholder="Option 2"
                                        name="option2"
                                        value="{{ old("option2") }}"
                                        required
                                    >
                                </div>
                                <div class="option-item">
                                    <input 
                                        type="text" 
                                        class="form-control option-input" 
                                        placeholder="Option 3"
                                        name="option3"
                                        value="{{ old("option3") }}"
                                    >
                                </div>
                                <div class="option-item">
                                    <input 
                                        type="text" 
                                        class="form-control option-input" 
                                        placeholder="Option 4"
                                        name="option4"
                                        value="{{ old("option4") }}"
                                    >
                                </div>
                                <div class="option-item">
                                    <input 
                                        type="text" 
                                        class="form-control option-input" 
                                        placeholder="Option 5"
                                        name="option5"
                                        value="{{ old("option5") }}"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="form-group">
                            <label class="form-label" for="endDate">
                                Date de fin
                            </label>
                            <input 
                                type="datetime-local" 
                                id="endDate" 
                                class="form-control"
                                name="end_date"
                                value="{{ old("end_date") }}"
                            >
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-check"></i>
                                Créer le sondage
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/sondages.js") }}"></script>
</body>
</html>