<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lire Communiqué - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/showCommunique.css") }}">
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
                    <h1>Lire un Communiqué</h1>
                </div>
            </div>

            <div class="header-right">
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
                
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="{{ route("dashboard.communiques.liste") }}"><i class="fas fa-home"></i> Communiqués</a>
                <i class="fas fa-chevron-right"></i>
                <span>Lire le communiqué</span>
            </div>

            <!-- Communiqué Container -->
            <div class="communique-container">
                <div class="communique-header">
                    <div class="communique-meta">
                        <div class="communique-source">
                            <i class="fas fa-building"></i>
                            {{ $communique->subtitle }}
                        </div>
                        <div class="communique-date">
                            <i class="far fa-calendar"></i>
                            {{ $communique->created_at->diffForHumans() }}
                        </div>
                    </div>
                    
                    <h1 class="communique-title">
                        {{ $communique->title }}
                    </h1>
                </div>

                <div class="communique-content">
                    <div class="communique-image">
                        @if (!empty($images))
                            @foreach ($images as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Image du communiqué" style="width: 100%; height: 450px; object-fit: contain; border-radius: 8px; margin: 5px;">
                            @endforeach
                        @else
                            <p>Aucune image disponible pour ce communiqué.</p>
                        @endif
                    </div>
                    <p>
                        {!! $communique->content !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset("js/back/showCommunique.js") }}"></script>
</body>
</html>