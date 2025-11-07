<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grille des Programmes - ORTN Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/back/programmesList.css") }}">
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
                        <h1 class="page-title">Grille des Programmes</h1>
                        <p class="page-description">Gérez les horaires de diffusion de vos programmes</p>
                    </div>

                    @if (session()->has('alert'))
                        <div class="alert alert-info">
                            <i class="fas fa-lightbulb"></i>
                            {{ session('alert')['message'] }}
                        </div>
                    @endif

                </div>

                <!-- Schedule Container -->
                <div class="schedule-container">

                    @php
                        $daysOfWeek = ['lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'];
                    @endphp

                    @foreach ($daysOfWeek as $day)
                        <div class="day-section">
                            <div class="schedule-header">
                                <h2 class="schedule-day-title">{{ ucfirst($day) }}</h2>
                            </div>

                            @php
                                // Collecter tous les programmes uniques pour ce jour
                                $programsForDay = collect();
                                
                                foreach ($programmes as $program) {
                                    $programDays = json_decode($program->jour_diffusion, true);
                                    
                                    if (in_array($day, $programDays)) {
                                        $hasTimeSlot = false;
                                        for ($i = 1; $i <= 4; $i++) {
                                            if ($program->{'heure_debut'.$i} && $program->{'heure_fin'.$i}) {
                                                $hasTimeSlot = true;
                                                break;
                                            }
                                        }
                                        
                                        if ($hasTimeSlot && !$programsForDay->contains('id', $program->id)) {
                                            $programsForDay->push($program);
                                        }
                                    }
                                }
                            @endphp

                            @forelse ($programsForDay as $program)
                                <div class="program-card">
                                    <!-- Header avec titre et actions -->
                                    <div class="program-header">
                                        <div class="program-info">
                                            <h3 class="program-name">{{ $program->nom }}</h3>
                                            <span class="program-type">
                                                <i class="fas fa-tag"></i>
                                                {{ $program->typeProgramme->libelle }}
                                            </span>
                                        </div>
                                        <div class="program-actions">
                                            {{-- <a href="{{ route('dashboard.programmes.edit', $program->id) }}" 
                                            class="action-btn btn-edit" 
                                            title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a> --}}
                                            <form action="{{ route('dashboard.programmes.destroy', $program->id) }}" 
                                                method="POST" 
                                                style="display: inline;"
                                                onsubmit="return confirm('Voulez-vous supprimer le programme {{ $program->nom }} ? il sera supprimé sur tout les jours pour lesquels il est programmé.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn btn-delete" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p class="program-description">{{ $program->description }}</p>

                                    <!-- Horaires multiples -->
                                    <div class="time-slots-grid">
                                        @for ($i = 1; $i <= 4; $i++)
                                            @php
                                                $start = $program->{'heure_debut'.$i};
                                                $end = $program->{'heure_fin'.$i};
                                            @endphp

                                            @if ($start && $end)
                                                <div class="time-slot-item">
                                                    <div class="time-badge">
                                                        <i class="fas fa-clock"></i>
                                                        {{ \Carbon\Carbon::parse($start)->format('H:i') }} - {{ \Carbon\Carbon::parse($end)->format('H:i') }}
                                                    </div>
                                                    <div class="animator-badge">
                                                        <i class="fas fa-microphone"></i>
                                                        {{ $program->animateur }}
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            @empty
                                <div class="no-program">
                                    <i class="fas fa-calendar-times"></i>
                                    <p>Aucun programme pour ce jour</p>
                                </div>
                            @endforelse
                        </div>
                    @endforeach
                    
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/back/programmesList.js") }}"></script>
</body>
</html>