<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programmes - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Programmes/index.css") }}">
</head>
<body>

    @include("Front.partials.loader")
    
    @include("Front.partials.header")

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <div class="breadcrumb-nav">
                    <a href="#"><i class="fas fa-home"></i> Accueil</a>
                    <span>/</span>
                    <span style="color: var(--gold);">Programmes</span>
                </div>
                <h1 class="page-title">
                    Nos <span class="highlight">Programmes</span> TV & Radio
                </h1>
                <p class="page-description">
                    Découvrez notre grille complète de programmes. Des émissions variées et de qualité 
                    pour informer, divertir et enrichir votre quotidien 24h/24.
                </p>
            </div>
        </div>
    </section>

    <!-- Weekly Schedule Section -->
    <section class="weekly-schedule" id="weeklySchedule">
        <div class="container">
            <div class="timeline-container">
                <div class="timeline-programs" id="timelinePrograms">
                    @foreach($programmesParJour as $jour => $groupes)
                        <h2 class="mb-4 text-uppercase">{{ ucfirst($jour) }}</h2>

                        @foreach($groupes as $item)
                            @php
                                $programme = $item['programme'];
                            @endphp

                            @for($i = 1; $i <= 4; $i++)
                                @php
                                    $start = data_get($programme, 'heure_debut'.$i);
                                    $end = data_get($programme, 'heure_fin'.$i);
                                @endphp

                                @if($start && $end)
                                    <div class="timeline-program mb-4">
                                        <div class="program-time">
                                            <div class="program-time-start">{{ \Carbon\Carbon::parse($start)->format('H:i') }}</div>
                                            <div class="program-time-end">{{ \Carbon\Carbon::parse($end)->format('H:i') }}</div>
                                        </div>
                                        <div class="program-icon">
                                            <i class="fas fa-tv"></i>
                                        </div>
                                        <div class="program-details">
                                            <span class="program-category">{{ optional($programme->typeProgramme)->libelle ?? 'Programme' }}</span>
                                            <h3 class="program-title">{{ $programme->nom }}</h3>
                                            <p class="program-description">{{ $programme->description }}</p>
                                            <div class="program-meta">
                                                <span><i class="fas fa-user"></i> {{ $programme->animateur }}</span>
                                                <span><i class="fas fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($start)->diffInMinutes(\Carbon\Carbon::parse($end)) }} min
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endfor
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset("js/Front/Programmes/index.js") }}"></script>
    
</body>
</html>