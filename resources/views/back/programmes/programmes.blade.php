<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Horaire - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/programmes.css") }}">
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
                <a href="#" class="sidebar-brand">
                    @if (file_exists(public_path('storage/ORTNlogo.jpg')))
                        <img src="{{  asset('storage/ORTNlogo.jpg') }}" alt="Logo Hayba" style="width:100px; height:75px; object-fit:contain;">
                    @else
                        <i class="fas fa-broadcast-tower"></i>
                        <span>ORTN</span>
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
                        <h1 class="page-title">Ajouter un Horaire de Programme</h1>
                        <p class="page-description">Définissez les horaires de diffusion de vos programmes</p>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="form-container">

                    <div class="form-header">
                        <h2>
                            <i class="fas fa-calendar-plus"></i>
                            Nouvel horaire
                        </h2>
                        <p>Remplissez les informations ci-dessous pour créer un nouvel horaire de programme</p>
                    </div>

                    <form id="scheduleForm" method="POST" action="{{ route('dashboard.programmes.store') }}" class="form-body">
                        @csrf

                        <!-- Informations du Programme -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Informations du Programme
                            </h3>

                            @if (session()->has('alert'))
                                <div class="alert alert-info">
                                    <i class="fas fa-lightbulb"></i>
                                    {{ session('alert')['message'] }}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="programName" class="form-label">
                                        Nom du Programme <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="nom" id="programName" required placeholder="Ex: Journal du Matin"
                                        value="{{ old('nom') }}">
                                    <div class="form-text">Le nom tel qu'il apparaîtra dans la grille</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="programType" class="form-label">
                                        Type de Programme <span class="required">*</span>
                                    </label>
                                    <select class="form-select" id="programType" name="programme" required>
                                        <option value="">Sélectionner un type</option>
                                        <option value="info" {{ old('programme') == 'info' ? 'selected' : '' }}>Informations</option>
                                        <option value="debat" {{ old('programme') == 'debat' ? 'selected' : '' }}>Débat</option>
                                        <option value="musique" {{ old('programme') == 'musique' ? 'selected' : '' }}>Musique</option>
                                        <option value="sport" {{ old('programme') == 'sport' ? 'selected' : '' }}>Sport</option>
                                        <option value="culture" {{ old('programme') == 'culture' ? 'selected' : '' }}>Culture</option>
                                        <option value="divertissement" {{ old('programme') == 'divertissement' ? 'selected' : '' }}>Divertissement</option>
                                        <option value="religieux" {{ old('programme') == 'religieux' ? 'selected' : '' }}>Religieux</option>
                                        <option value="educatif" {{ old('programme') == 'educatif' ? 'selected' : '' }}>Éducatif</option>
                                        <option value="autre" {{ old('programme') == 'autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="programDescription" class="form-label">Description du Programme</label>
                                <textarea class="form-control" name="description" id="programDescription" rows="3"
                                        placeholder="Brève description du programme et de son contenu">{{ old('description') }}</textarea>
                                <div class="form-text">Décrivez brièvement le contenu et les objectifs du programme</div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="hostName" class="form-label">Animateur / Présentateur</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" name="animateur" class="form-control" id="hostName" placeholder="Nom de l'animateur"
                                            value="{{ old('animateur') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Horaires de Diffusion -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-clock"></i>
                                Horaires de Diffusion
                            </h3>

                            <div class="mb-4">
                                <label class="form-label">Jours de Diffusion <span class="required">*</span></label>
                                <div class="days-selector">
                                    @php
                                        $oldJours = old('jours', []);
                                    @endphp
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="monday" name="jours[]" value="lundi" {{ in_array('lundi', $oldJours) ? 'checked' : '' }}>
                                        <label for="monday" class="day-label">Lundi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="tuesday" name="jours[]" value="mardi" {{ in_array('mardi', $oldJours) ? 'checked' : '' }}>
                                        <label for="tuesday" class="day-label">Mardi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="wednesday" name="jours[]" value="mercredi" {{ in_array('mercredi', $oldJours) ? 'checked' : '' }}>
                                        <label for="wednesday" class="day-label">Mercredi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="thursday" name="jours[]" value="jeudi" {{ in_array('jeudi', $oldJours) ? 'checked' : '' }}>
                                        <label for="thursday" class="day-label">Jeudi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="friday" name="jours[]" value="vendredi" {{ in_array('vendredi', $oldJours) ? 'checked' : '' }}>
                                        <label for="friday" class="day-label">Vendredi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="saturday" name="jours[]" value="samedi" {{ in_array('samedi', $oldJours) ? 'checked' : '' }}>
                                        <label for="saturday" class="day-label">Samedi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="sunday" name="jours[]" value="dimanche" {{ in_array('dimanche', $oldJours) ? 'checked' : '' }}>
                                        <label for="sunday" class="day-label">Dimanche</label>
                                    </div>
                                </div>
                                <div class="form-text mt-2">Sélectionnez tous les jours où le programme est diffusé</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Créneaux Horaires <span class="required">*</span></label>
                                <div class="time-slots-container" id="timeSlotsContainer">

                                    <div class="time-slot">
                                        <div>
                                            <label class="form-label">Heure de début 1</label>
                                            <input type="time" name="heure_debut1" class="form-control" required value="{{ old('heure_debut1') }}">
                                        </div>
                                        <div>
                                            <label class="form-label">Heure de fin 1</label>
                                            <input type="time" name="heure_fin1" class="form-control" required value="{{ old('heure_fin1') }}">
                                        </div>
                                    </div>

                                    <div class="time-slot">
                                        <div>
                                            <label class="form-label">Heure de début 2</label>
                                            <input type="time" name="heure_debut2" class="form-control" required value="{{ old('heure_debut2') }}">
                                        </div>
                                        <div>
                                            <label class="form-label">Heure de fin 2</label>
                                            <input type="time" name="heure_fin2" class="form-control" required value="{{ old('heure_fin2') }}">
                                        </div>
                                    </div>

                                    <div class="time-slot">
                                        <div>
                                            <label class="form-label">Heure de début 3</label>
                                            <input type="time" name="heure_debut3" class="form-control" value="{{ old('heure_debut3') }}">
                                        </div>
                                        <div>
                                            <label class="form-label">Heure de fin 3</label>
                                            <input type="time" name="heure_fin3" class="form-control" value="{{ old('heure_fin3') }}">
                                        </div>
                                    </div>

                                    <div class="time-slot">
                                        <div>
                                            <label class="form-label">Heure de début 4</label>
                                            <input type="time" name="heure_debut4" class="form-control" value="{{ old('heure_debut4') }}">
                                        </div>
                                        <div>
                                            <label class="form-label">Heure de fin 4</label>
                                            <input type="time" name="heure_fin4" class="form-control" value="{{ old('heure_fin4') }}">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i>
                                Publier l'horaire
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/programmes.js") }}"></script>
</body>
</html>