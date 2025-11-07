<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Échoué - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Evenements/error.css") }}">
</head>
<body>

    <div class="failure-container">
        <div class="failure-icon">
            <i class="fas fa-times"></i>
        </div>
        
        <h1 class="failure-title">Paiement Échoué</h1>
        <p class="failure-subtitle">Une erreur est survenue lors du traitement de votre paiement. Veuillez réessayer.</p>
        
        <!-- Détails de l'événement -->
        <div class="event-card">
            <img src="{{ asset('storage/' . $payment->event->image) }}" alt="Conférence Nationale" class="event-image">
            <div class="event-info">
                <h3 class="event-title"></h3>
                    {{ $payment->event->title }}
                <div class="event-meta">
                    <div class="event-meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        @php
                            use Carbon\Carbon;
                            Carbon::setLocale('fr');
                        @endphp

                        <span>
                            Du {{ Carbon::parse($payment->event->start_date)->translatedFormat('d F Y') }} à {{ $payment->event->start_time }}
                            au {{ Carbon::parse($payment->event->end_date)->translatedFormat('d F Y') }} à {{ $payment->event->end_time }}
                        </span>
                    </div>
                    <div class="event-meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $payment->event->venue }}</span>
                    </div>
                </div>
                <span class="ticket-badge">1 Billet</span>
            </div>
        </div>
        
        <!-- Détails de la transaction échouée -->
        <div class="error-details">
            <h3 style="color: var(--navy-blue); margin-bottom: 1.5rem; text-align: center;">Détails de la transaction</h3>
            
            <div class="detail-row">
                <span class="detail-label">Référence</span>
                <span class="detail-value">{{ $payment->transaction_id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date de tentative</span>
                <span class="detail-value">{{ $payment->created_at->diffForHumans() }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Montant total</span>
                <span class="detail-value">{{ $payment->montant }} FCFA</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Statut</span>
                <span class="detail-value">
                    Échec
                    <span class="status-badge status-failed">{{ $payment->statut }}</span>
                </span>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="actions-container">
            <a href="{{ route("ortn.evenements") }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Retour aux événements
            </a>
        </div>
    </div>

    <script src="{{ asset("js/Front/Evenements/error.js") }}"></script>
</body>
</html>