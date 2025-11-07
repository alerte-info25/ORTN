<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un Article - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    {{-- local css --}}
    <link rel="stylesheet" href="{{ asset("css/back/articles.css") }}">
</head>
<body>

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
                    <h1 class="page-title">Publier un Nouvel Article</h1>
                    <p class="page-description">Créez et publiez du contenu pour votre audience</p>
                </div>

                <form class="form-container"
                        action="{{ isset($article) ? route('dashboard.articles.update', $article->id) : route('dashboard.articles.store') }}" 
                        method="POST" enctype="multipart/form-data" novalidate>

                    @csrf
                    @if(isset($article))
                        @method('PUT')
                    @endif

                    @if (session()->has('alert'))
                        <x-alert type="{{ session('alert')['type'] }}">
                            {{ session('alert')['message'] }}
                        </x-alert>
                    @endif

                    <!-- Basic Information -->
                    <div class="form-card">
                        <h3 class="form-section-title">
                            <i class="fas fa-info-circle"></i>
                            Informations de base
                        </h3>

                        <div class="form-group">
                            <label for="articleTitle" class="form-label required">Titre de l'article</label>

                            <input type="text" 
                                class="form-control @error('title') is-invalid @enderror" 
                                id="articleTitle" name="title" 
                                placeholder="Entrez un titre accrocheur..." 
                                value="{{ old('title', $article->media->titre ?? '') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="form-text">Le titre apparaîtra en haut de votre article</small>
                        </div>

                        <div class="form-group">
                            <label for="articleSubtitle" class="form-label">Sous-titre</label>

                            <input type="text" 
                                class="form-control @error('subtitle') is-invalid @enderror" 
                                id="articleSubtitle" name="subtitle" 
                                placeholder="Sous-titre..." 
                                value="{{ old('subtitle', $article->sous_titre ?? '') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="form-text">Un sous-titre pour compléter votre titre principal</small>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="articleCategory" class="form-label required">Catégorie</label>
                                    <select class="form-select" name="category" id="articleCategory">
                                        <option value="">Sélectionner une catégorie</option>
                                        <option value="politique">Politique</option>
                                        <option value="economie">Économie</option>
                                        <option value="culture">Culture</option>
                                        <option value="sport">Sport</option>
                                        <option value="societe">Société</option>
                                        <option value="international">International</option>
                                        <option value="technologie">Technologie</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type" class="form-label required">Type d'article</label>
                                    <select class="form-select" id="type" name="type">
                                        <option value="">Sélectionner un type</option>
                                        <option value="Tribune">Tribune</option>
                                        <option value="Analyse">Analyse</option>
                                        <option value="Chronique">Chronique</option>
                                        <option value="Reportage">Reportage</option>
                                        <option value="Breve">Brève</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tags</label>
                            <div class="tags-container" id="tagsContainer">

                                <input type="text"
                                    class="tag-input @error('tags') is-invalid @enderror"
                                    id="articleTags"
                                    name="tags"
                                    placeholder="sport, actualité, culture..."
                                    value="{{ old('tags', isset($article) ? $article->media->tags->pluck('libelle')->implode(', ') : '') }}">
                                @error('tags')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                            <small class="form-text">Ajoutez des mots-clés pour faciliter la recherche de votre article</small>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="form-card">
                        <h3 class="form-section-title">
                            <i class="fas fa-image"></i>
                            Image à la une
                        </h3>

                        <div class="image-upload-area" id="imageUploadArea">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <div class="upload-text">Cliquez pour télécharger ou glissez-déposez</div>
                            <div class="upload-hint">PNG, JPG ou JPEG (MAX. 5MB)</div>
                            <input type="file" id="imageInput" accept="image/*" name="image" style="display: none;">
                        </div>

                        @if (isset($article))
                            <img src="{{ asset("storage/".$article->media->image) }}" alt="Preview" style="margin: 10px auto; display: flex; width: 350px">
                        @endif

                        <div class="image-preview-container" id="imagePreviewContainer">
                            <div class="image-preview">
                                <img id="imagePreview" src="" alt="Preview">
                                <button class="remove-image-btn" id="removeImageBtn">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="form-card">
                        <h3 class="form-section-title">
                            <i class="fas fa-pen"></i>
                            Contenu de l'article
                        </h3>

                        <div class="form-group">
                            <label class="form-label required">Corps de l'article</label>
                            <div class="editor-toolbar">
                                <button class="editor-btn" data-command="bold" title="Gras">
                                    <i class="fas fa-bold"></i>
                                </button>
                                <button class="editor-btn" data-command="italic" title="Italique">
                                    <i class="fas fa-italic"></i>
                                </button>
                                <button class="editor-btn" data-command="underline" title="Souligné">
                                    <i class="fas fa-underline"></i>
                                </button>
                                <button class="editor-btn" data-command="insertUnorderedList" title="Liste à puces">
                                    <i class="fas fa-list-ul"></i>
                                </button>
                                <button class="editor-btn" data-command="insertOrderedList" title="Liste numérotée">
                                    <i class="fas fa-list-ol"></i>
                                </button>
                                <button class="editor-btn" data-command="justifyLeft" title="Aligner à gauche">
                                    <i class="fas fa-align-left"></i>
                                </button>
                                <button class="editor-btn" data-command="justifyCenter" title="Centrer">
                                    <i class="fas fa-align-center"></i>
                                </button>
                                <button class="editor-btn" data-command="justifyRight" title="Aligner à droite">
                                    <i class="fas fa-align-right"></i>
                                </button>
                                <button class="editor-btn" data-command="createLink" title="Insérer un lien">
                                    <i class="fas fa-link"></i>
                                </button>
                            </div>
                            <div class="editor-content" id="editorContent" contenteditable="true">
                               <p>
                                    {!! old('content', isset($article) ? $article->media->description : 'Commencez à rédiger votre article ici...') !!}
                                </p>

                            </div>
                        </div>
                    </div>

                    <textarea id="hiddenContent" name="content" style="display: none;"></textarea>

                    <!-- Action Buttons -->
                    <div class="form-card">
                        <div class="action-buttons">
                            <button class="btn btn-primary" id="publishBtn">
                                <i class="fas fa-paper-plane"></i>
                                Publier l'article
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="success-modal" id="successModal">
        <div class="success-modal-content">
            <i class="fas fa-check-circle success-icon"></i>
            <h2 class="success-title">Article publié avec succès!</h2>
            <p class="success-message">Votre article est maintenant visible par votre audience.</p>
            <button class="btn btn-primary" id="closeSuccessBtn">
                <i class="fas fa-check"></i>
                Parfait!
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/articles.js") }}"></script>
</body>
</html>