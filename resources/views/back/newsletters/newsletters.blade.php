<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoyer Newsletter - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/newsletters.css") }}">
</head>
<body>
    <!-- Loader -->
    @include("back.partials.loader")

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

        @if (session()->has("alert"))
            @if (session('alert')['type'] == 'success')
                <!-- Success Modal -->
                <div class="success-modal show" id="successModal">
                    <div class="success-content">
                        <button class="close-btn" id="closeModal">&times;</button>

                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>

                        <h2 class="success-title">Newsletter envoyé avec succès !</h2>

                        <button class="btn btn-primary" onclick="window.location.href='{{ route('dashboard.newslettersListe') }}'">
                            <i class="fas fa-users"></i> Voir la liste des newsletters envoyées
                        </button>
                    </div>
                </div>
            @endif
        @endif

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
                    <h1 class="page-title">Envoyer une Newsletter</h1>
                    <p class="page-description">Créez et envoyez votre newsletter à vos abonnés</p>
                </div>

                <!-- Form Container -->
                <div class="form-container">
                    <form id="newsletterForm" method="POST" action="{{ route("dashboard.newsletters.store") }}" enctype="multipart/form-data">

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        @csrf
                        <!-- Informations de base -->
                        <div class="form-card">
                            <h2 class="form-section-title">
                                <i class="fas fa-info-circle"></i>
                                Informations de base
                            </h2>
                            
                            <div class="form-group">
                                <label class="form-label">
                                    Titre de la newsletter <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="newsletterTitle" name="title" placeholder="Ex: Actualités de la semaine" required>
                                <span class="form-text">Ce titre sera visible par vos abonnés</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Objet de l'email <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control" id="emailSubject" name="subject" placeholder="Ex: Ne manquez pas les actualités de cette semaine!" required>
                                <span class="form-text">L'objet qui apparaîtra dans la boîte de réception</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    Catégorie
                                </label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Sélectionnez une catégorie</option>
                                    <option value="actualites">Actualités</option>
                                    <option value="culture">Culture</option>
                                    <option value="sport">Sport</option>
                                    <option value="economie">Économie</option>
                                    <option value="politique">Politique</option>
                                    <option value="technologie">Technologie</option>
                                    <option value="education">Éducation</option>
                                    <option value="environnement">Environnement</option>
                                </select>
                            </div>

                        </div>

                        <!-- Contenu -->
                        <div class="form-card">
                            <h2 class="form-section-title">
                                <i class="fas fa-edit"></i>
                                Contenu de la newsletter
                            </h2>

                            <div class="form-group">
                                <label class="form-label">
                                    Contenu <span class="required">*</span>
                                </label>
                                
                                <div class="editor-toolbar">
                                    <button type="button" class="editor-btn" data-command="bold" title="Gras">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="editor-btn" data-command="italic" title="Italique">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="editor-btn" data-command="underline" title="Souligné">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                    <button type="button" class="editor-btn" data-command="insertUnorderedList" title="Liste">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                    <button type="button" class="editor-btn" data-command="insertOrderedList" title="Liste numérotée">
                                        <i class="fas fa-list-ol"></i>
                                    </button>
                                    <button type="button" class="editor-btn" data-command="createLink" title="Lien">
                                        <i class="fas fa-link"></i>
                                    </button>
                                    <button type="button" class="editor-btn" data-command="justifyLeft" title="Aligner à gauche">
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button type="button" class="editor-btn" data-command="justifyCenter" title="Centrer">
                                        <i class="fas fa-align-center"></i>
                                    </button>
                                    <button type="button" class="editor-btn" data-command="justifyRight" title="Aligner à droite">
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                </div>

                                <div contenteditable="true" class="editor-content" id="editorContent">
                                    <p>Commencez à rédiger votre newsletter ici...</p>
                                </div>

                                <!-- CHAMP CACHÉ POUR LARAVEL -->
                                <input type="hidden" name="content" id="hiddenContent">

                                <input type="file" id="imageUpload" accept="image/*" style="display: none;">
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label class="form-label">Image de couverture</label>
                                    <div class="upload-zone" onclick="document.getElementById('coverImage').click()">
                                        <div class="upload-icon"><i class="fas fa-image"></i></div>
                                        <div class="upload-text">Cliquer pour ajouter une image</div>
                                        <div class="upload-subtext">JPG, PNG ou JPEG (max 5MB)</div>
                                        <input type="file" id="coverImage" name="cover_image" accept=".jpg,.jpeg,.png,.gif" style="display: none;">
                                    </div>
                                    <!-- Ajoutez ceci pour voir le fichier sélectionné -->
                                    <div id="fileName" class="mt-2 small text-muted" style="display: none;"></div>
                                </div>
                            </div>

                        </div>

                        <!-- Boutons d'action -->
                        <div class="form-card">
                            <div class="action-buttons">
                                <button type="submit" class="btn btn-primary" id="sendBtn">
                                    <i class="fas fa-paper-plane"></i>
                                    <span id="sendBtnText">Envoyer maintenant</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/newsletters.js") }}"></script>
    
</body>
</html>