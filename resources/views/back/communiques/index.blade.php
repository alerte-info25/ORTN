<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier Communiqué - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/communiques.css") }}">
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    @include("back.partials.loader")

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
                    <h1>Publier un Communiqué</h1>
                </div>
            </div>

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
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="communique-info">
                <h3><i class="fas fa-info-circle"></i> À propos des communiqués</h3>
                <p>Les communiqués sont des annonces officielles destinées à être diffusées rapidement. Ils sont généralement plus courts que les articles et ont un format plus direct. Utilisez ce formulaire pour publier un communiqué officiel.</p>
            </div>

            <div class="editor-container">
                <div class="editor-header">
                    <h2 class="editor-title">Nouveau Communiqué</h2>
                </div>

                <form id="communiqueForm" method="POST" action="{{ route("dashboard.communiques.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-grid">

                        @if (session()->has('alert'))
                            <x-alert type="{{ session('alert')['type'] }}">
                                {{ session('alert')['message'] }}
                            </x-alert>
                        @endif
                        
                        <!-- Main Content Column -->
                        <div class="form-column">
                            <!-- Titre et contenu -->
                            <div class="form-section">
                                <div class="form-group">
                                    <label class="form-label required" for="communiqueTitle">Titre du communiqué</label>
                                    <input type="text" class="form-input" id="communiqueTitle" name="title" placeholder="Entrez un titre clair et concis..." value="{{ old('title') }}" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label required" for="subtitle">Sous titre du communiqué</label>
                                    <input type="text" class="form-input" id="subtitle" name="subtitle" placeholder="Ex: Ministère de la Santé, Présidence..." value="{{ old('source') }}" >
                                </div>

                                <div class="form-group">
                                    <label class="form-label required">Contenu du communiqué</label>
                                    <input type="hidden" id="communiqueContentHidden" name="content" value="{{ old('content') }}">
                                    <div class="rich-text-editor">
                                        <div class="editor-toolbar-rich">
                                            <button type="button" class="toolbar-btn" data-command="bold" title="Gras">
                                                <i class="fas fa-bold"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="italic" title="Italique">
                                                <i class="fas fa-italic"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="underline" title="Souligné">
                                                <i class="fas fa-underline"></i>
                                            </button>
                                            <div class="toolbar-group">
                                                <button type="button" class="toolbar-btn" data-command="insertUnorderedList" title="Liste à puces">
                                                    <i class="fas fa-list-ul"></i>
                                                </button>
                                                <button type="button" class="toolbar-btn" data-command="insertOrderedList" title="Liste numérotée">
                                                    <i class="fas fa-list-ol"></i>
                                                </button>
                                            </div>
                                            <div class="toolbar-group">
                                                <button type="button" class="toolbar-btn" data-command="formatBlock" data-value="H1" title="Titre 1">
                                                    H1
                                                </button>
                                                <button type="button" class="toolbar-btn" data-command="formatBlock" data-value="H2" title="Titre 2">
                                                    H2
                                                </button>
                                                <button type="button" class="toolbar-btn" data-command="formatBlock" data-value="H3" title="Titre 3">
                                                    H3
                                                </button>
                                            </div>
                                            <button type="button" class="toolbar-btn" data-command="createLink" title="Lien">
                                                <i class="fas fa-link"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="insertImage" title="Image">
                                                <i class="fas fa-image"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="insertHorizontalRule" title="Ligne horizontale">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="undo" title="Annuler">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="redo" title="Refaire">
                                                <i class="fas fa-redo"></i>
                                            </button>
                                        </div>
                                        <div class="editor-body" id="communiqueContent" contenteditable="true">
                                            {!! old('content', '<p>Rédigez le contenu de votre communiqué ici...</p>') !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="excerpt-box">
                                    <div class="excerpt-label">Extrait généré automatiquement :</div>
                                    <div class="excerpt-text" id="communiqueExcerpt">
                                        {{ old('excerpt', 'L\'extrait du communiqué apparaîtra ici automatiquement.') }}
                                    </div>
                                </div>
                            </div>

                            <!-- image -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-image"></i>
                                    image
                                </h3>

                                <div class="file-upload" id="attachmentUpload">
                                    <div class="upload-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="upload-text">
                                        <h4>Ajouter une image</h4>
                                    </div>
                                    <button type="button" class="btn-browse">Choisir des fichiers</button>
                                    <input type="file" id="attachmentFiles" name="images[]" multiple accept=".jpg,.jpeg,.gif,.png" style="display: none;">
                                </div>

                                <div class="file-preview" id="attachmentPreview">
                                    <!-- Les images ajoutées apparaîtront ici -->
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
                            <i class="fas fa-bullhorn"></i>
                            Publier le communiqué
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset("js/back/communiques.js") }}"></script>
</body>
</html>