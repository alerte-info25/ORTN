<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier Événement - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/events.css") }}">
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
                    <h1>Créer un Événement</h1>
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
            <div class="editor-container">

                <form id="eventForm" action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if (session()->has('alert'))
                        <x-alert type="{{ session('alert')['type'] }}">
                            {{ session('alert')['message'] }}
                        </x-alert>
                    @endif

                    <div class="editor-content">
                        <div class="form-grid">
                            <!-- Main Content Column -->
                            <div class="form-column">
                                <!-- Informations de base -->
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-info-circle"></i>
                                        Informations de base
                                    </h3>

                                    <div class="form-group">
                                        <label class="form-label required" for="eventTitle">Titre de l'événement</label>
                                        <input type="text" class="form-input" id="eventTitle" name="title"
                                            value="{{ old('title') }}"
                                            placeholder="Ex: Conférence Nationale sur le Développement Durable" required>
                                        @error('title')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label required" for="eventDescription">Description</label>
                                        <textarea class="form-textarea" id="eventDescription" name="description" rows="6"
                                                placeholder="Décrivez l'événement en détail..." required>{{ old('description') }}</textarea>
                                        <div class="form-hint">Minimum 50 caractères recommandés</div>
                                        @error('description')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label required" for="eventCategory">Type d'événement</label>
                                        <select class="form-select" id="eventCategory" name="category" required>
                                            <option value="">Sélectionnez un type</option>
                                            <option value="conference" {{ old('category') == 'conference' ? 'selected' : '' }}>Conférence</option>
                                            <option value="seminaire" {{ old('category') == 'seminaire' ? 'selected' : '' }}>Séminaire</option>
                                            <option value="atelier" {{ old('category') == 'atelier' ? 'selected' : '' }}>Atelier</option>
                                            <option value="festival" {{ old('category') == 'festival' ? 'selected' : '' }}>Festival</option>
                                            <option value="concert" {{ old('category') == 'concert' ? 'selected' : '' }}>Concert</option>
                                            <option value="spectacle" {{ old('category') == 'spectacle' ? 'selected' : '' }}>Spectacle</option>
                                            <option value="exposition" {{ old('category') == 'exposition' ? 'selected' : '' }}>Exposition</option>
                                            <option value="competition" {{ old('category') == 'competition' ? 'selected' : '' }}>Compétition sportive</option>
                                            <option value="ceremonie" {{ old('category') == 'ceremonie' ? 'selected' : '' }}>Cérémonie</option>
                                            <option value="autre" {{ old('category') == 'autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('category')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Date et heure -->
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-clock"></i>
                                        Date et heure
                                    </h3>

                                    <div class="datetime-grid">
                                        <div class="form-group">
                                            <label class="form-label required" for="eventStartDate">Date de début</label>
                                            <input type="date" class="form-input" id="eventStartDate" name="start_date"
                                                value="{{ old('start_date') }}" required>
                                            @error('start_date')
                                                <span class="error-text">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label required" for="eventStartTime">Heure de début</label>
                                            <input type="time" class="form-input" id="eventStartTime" name="start_time"
                                                value="{{ old('start_time') }}" required>
                                            @error('start_time')
                                                <span class="error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="datetime-grid">
                                        <div class="form-group">
                                            <label class="form-label required" for="eventEndDate">Date de fin</label>
                                            <input type="date" class="form-input" id="eventEndDate" name="end_date"
                                                value="{{ old('end_date') }}" required>
                                            @error('end_date')
                                                <span class="error-text">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label required" for="eventEndTime">Heure de fin</label>
                                            <input type="time" class="form-input" id="eventEndTime" name="end_time"
                                                value="{{ old('end_time') }}" required>
                                            @error('end_time')
                                                <span class="error-text">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Lieu -->
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Lieu de l'événement
                                    </h3>

                                    <div class="form-group">
                                        <label class="form-label">Format</label>
                                        <div class="checkbox-group">
                                            <div class="checkbox-item">
                                                <input type="radio" id="formatOnline" name="format" value="online"
                                                    {{ old('format') == 'online' ? 'checked' : '' }}>
                                                <label for="formatOnline">En ligne</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input type="radio" id="formatHybride" name="format" value="hybride"
                                                    {{ old('format') == 'hybride' ? 'checked' : '' }}>
                                                <label for="formatHybride">Hybride (Présentiel + En ligne)</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="physicalLocation">
                                        <div class="form-group">
                                            <label class="form-label required" for="eventVenue">Nom du lieu</label>
                                            <input type="text" class="form-input" id="eventVenue" name="venue"
                                                value="{{ old('venue') }}" placeholder="Ex: Palais des Congrès de Niamey">
                                        </div>

                                        <div class="location-grid">
                                            <div class="form-group">
                                                <label class="form-label required" for="eventAddress">Adresse</label>
                                                <input type="text" class="form-input" id="eventAddress" name="address"
                                                    value="{{ old('address') }}" placeholder="Rue, avenue...">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label required" for="eventCity">Ville</label>
                                                <input type="text" class="form-input" id="eventCity" name="city"
                                                    value="{{ old('city') }}" placeholder="Niamey">
                                            </div>
                                        </div>
                                    </div>

                                    <div id="onlineLocation" style="display: none;">
                                        <div class="form-group">
                                            <label class="form-label required" for="eventOnlineUrl">Lien de l'événement en ligne</label>
                                            <input type="url" class="form-input" id="eventOnlineUrl" name="online_url"
                                                value="{{ old('online_url') }}" placeholder="https://zoom.us/j/...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Organisateur -->
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-users-cog"></i>
                                        Organisateur
                                    </h3>

                                    <div class="form-group">
                                        <label class="form-label required" for="eventOrganizer">Nom de l'organisateur</label>
                                        <input type="text" class="form-input" id="eventOrganizer" name="organizer"
                                            value="{{ old('organizer') }}" placeholder="Ex: ORTN" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="eventOrganizerEmail">Email de contact</label>
                                        <input type="email" class="form-input" id="eventOrganizerEmail" name="organizer_email"
                                            value="{{ old('organizer_email') }}" placeholder="contact@ortn.ne">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="eventOrganizerPhone">Téléphone de contact</label>
                                        <input type="tel" class="form-input" id="eventOrganizerPhone" name="organizer_phone"
                                            value="{{ old('organizer_phone') }}" placeholder="+227 XX XX XX XX">
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar Column -->
                            <div class="form-column editor-sidebar">
                                <!-- Image de l'événement -->
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-image"></i>
                                        Image de l'événement
                                    </h3>

                                    <div class="file-upload" id="eventImageUpload">
                                        <input type="file" id="eventImage" name="image" accept=".jpg,.jpeg,.png" style="display: none;">
                                        <div class="upload-icon">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                        <div class="upload-text">
                                            <h4>Ajouter une image</h4>
                                            <p>JPG, PNG - Recommandé: 1200x630px</p>
                                        </div>
                                        <button type="button" class="btn-browse">Choisir une image</button>
                                    </div>
                                </div>

                                <!-- Capacité et tarifs -->
                                <div class="form-section">
                                    <h3 class="section-title">
                                        <i class="fas fa-ticket-alt"></i>
                                        Capacité et tarifs
                                    </h3>

                                    <div class="form-group">
                                        <label class="form-label" for="eventCapacity">Capacité maximum</label>
                                        <input type="number" class="form-input" id="eventCapacity" name="capacity"
                                            value="{{ old('capacity') }}" placeholder="Ex: 500" min="1">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Type d'accès</label>
                                        <div class="checkbox-group">
                                            <div class="checkbox-item">
                                                <input type="radio" id="accessFree" name="access_type" value="free"
                                                    {{ old('access_type', 'free') == 'free' ? 'checked' : '' }}>
                                                <label for="accessFree">Gratuit</label>
                                            </div>
                                            <div class="checkbox-item">
                                                <input type="radio" id="accessPaid" name="access_type" value="paid"
                                                    {{ old('access_type') == 'paid' ? 'checked' : '' }}>
                                                <label for="accessPaid">Payant</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="pricingSection" style="display: none;">
                                        <div class="form-group">
                                            <label class="form-label" for="eventPrice">Prix du billet (FCFA)</label>
                                            <input type="number" class="form-input" id="eventPrice" name="price"
                                                value="{{ old('price') }}" placeholder="Ex: 5000" min="0">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Inscription requise</label>
                                        <div class="checkbox-item">
                                            <input type="checkbox" id="requiresRegistration" name="requires_registration"
                                                {{ old('requires_registration') ? 'checked' : '' }}>
                                            <label for="requiresRegistration">Les participants doivent s'inscrire</label>
                                        </div>
                                    </div>

                                    <div id="registrationSection" style="display: none;">
                                        <div class="form-group">
                                            <label class="form-label" for="registrationUrl">Lien d'inscription</label>
                                            <input type="url" class="form-input" id="registrationUrl" name="registration_url"
                                                value="{{ old('registration_url') }}" placeholder="https://...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions du formulaire -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-cancel">
                            <i class="fas fa-times"></i>
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-publish">
                            <i class="fas fa-calendar-check"></i>
                            Publier l'événement
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset("js/back/events.js") }}"></script>

</body>
</html>