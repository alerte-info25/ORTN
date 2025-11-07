<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Podcast Vidéo - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    {{-- local css --}}
    <link rel="stylesheet" href="{{ asset("css/back/podcastsvideos.css") }}">
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
                        <img src="{{  asset('storage/ORTNlogo.jpg') }}" alt="Logo ORTN" style="width:100px; height:75px; object-fit:contain;">
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
                    <h1 class="page-title">Gestion des Podcasts Vidéo</h1>
                    <p class="page-description">Créez et gérez vos podcasts vidéo pour Office de Radio et télévision de Ngazidja</p>
                </div>

                <!-- Dashboard Content -->
                <div class="dashboard-content">
                    <!-- Podcast Form -->
                    <div class="form-section fade-in">
                        <div class="section-header">
                            <h3 class="section-title">
                                <i class="fas fa-plus-circle"></i>
                                Nouveau Podcast Vidéo
                            </h3>
                        </div>

                        <form id="videoForm" class="needs-validation" 
                            action="{{ isset($video) ? route('dashboard.videos.update', $video->id) : route('dashboard.videos.store') }}" 
                            method="POST" enctype="multipart/form-data" novalidate>
                            
                            @csrf

                            @if(isset($video))
                                @method('PUT')
                            @endif

                            @if (session()->has('alert'))
                                <x-alert type="{{ session('alert')['type'] }}">
                                    {{ session('alert')['message'] }}
                                </x-alert>
                            @endif

                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Fichier vidéo -->
                                    <div class="mb-4">
                                        <label class="form-label">Url Vidéo *</label>

                                        <input type="text" name="url" placeholder="Ex : https://www.youtube.com/watch?v=dfhZFB6xmkE" 
                                                            class="form-control @error('url') is-invalid @enderror" 
                                                            value="{{ old('url', $video->url_video ?? '') }}">

                                        @error('url')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <!-- Titre -->
                                    <div class="mb-4">
                                        <label for="videoTitle" class="form-label">Titre *</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                            id="videoTitle" name="title" 
                                            value="{{ old('title', $video->media->titre ?? '') }}" 
                                            placeholder="Titre du contenu vidéo..." required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Sous-titre -->
                                    <div class="mb-4">
                                        <label for="videoSubtitle" class="form-label">Sous-titre *</label>
                                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                                            id="videoSubtitle" name="subtitle" 
                                            value="{{ old('subtitle', $video->media->subtitle ?? '') }}" 
                                            placeholder="Sous-titre du contenu vidéo..." required>
                                        @error('subtitle')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                </div>

                                <div class="col-lg-12">

                                    <!-- Contenu -->
                                    <div class="mb-4">
                                        <label for="videoContent" class="form-label">Contenu *</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                                id="videoDescription" name="content" rows="4" 
                                                placeholder="Contenu du vidéo..." required>{{ old('content', $video->media->description ?? '') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Catégorie -->
                                    <div class="mb-4">
                                        <label for="videoCategory" class="form-label">Catégorie *</label>
                                        <select class="form-select @error('category') is-invalid @enderror" id="videoCategory" name="category" required>
                                            <option value="">-- Choisir une catégorie --</option>
                                            @foreach(['actualite','sport','culture','economie','politique','societe','international','technologie'] as $cat)
                                                <option value="{{ $cat }}" 
                                                    {{ old('category', $video->categorieMedia->libelle ?? '') == $cat ? 'selected' : '' }}>
                                                    {{ ucfirst($cat) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tags -->
                                    <div class="mb-4">
                                        <label for="videoTags" class="form-label">Tags *</label>
                                        <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                            id="videoTags" name="tags" 
                                            value="{{ old('tags', isset($video) ? $video->media->tags->pluck('libelle')->implode(', ') : '') }}" 
                                            placeholder="Tags séparés par des virgules..." required>
                                        <small class="form-text text-muted">Ex: musique, clip, artiste, 2024</small>
                                        @error('tags')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex gap-3 justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    {{ isset($video) ? 'Mettre à jour la vidéo' : 'Enregistrer la vidéo' }}
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/podcastsvideos.js") }}"></script>
</body>
</html>