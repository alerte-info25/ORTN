<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Réussi - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Evenements/success.css") }}">
</head>
<body>

    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h1 class="success-title">Paiement Confirmé !</h1>
        <p class="success-subtitle">Votre réservation a été effectuée avec succès. Vous recevrez un email de confirmation avec vos billets.</p>
        
        <div class="confirmation-message">
            <h4>
                <i class="fas fa-info-circle"></i>
                Important
            </h4>
            <p>Présentez ce QR code à l'entrée de l'événement. Vos billets électroniques ont également été envoyés à votre adresse email.</p>
        </div>
        
        <!-- Détails de l'événement -->
        <div class="event-card">
            <img src="{{ asset('storage/' . $payment->event->image) }}" alt="Conférence Nationale" class="event-image">
            <div class="event-info">
                <h3 class="event-title">
                    {{ $payment->event->title }}
                </h3>
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
        
        <!-- Détails de la transaction -->
        <div class="confirmation-details">
            <h3 style="color: var(--navy-blue); margin-bottom: 1.5rem; text-align: center;">Détails de la transaction</h3>
            
            <div class="detail-row">
                <span class="detail-label">Référence de paiement</span>
                <span class="detail-value">{{ $payment->transaction_id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Date de transaction</span>
                <span class="detail-value">{{ $payment->created_at->diffForHumans() }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Montant total</span>
                <span class="detail-value">{{ $payment->montant }} FCFA</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Statut</span>
                <span class="detail-value" style="color: var(--green);">{{ $payment->statut }}</span>
            </div>
        </div>
        
        <!-- Informations du reçu -->
        <div class="receipt-info">
            <div class="receipt-item">
                <span class="receipt-label">N° de Transaction</span>
                <span class="receipt-value">{{ $payment->transaction_id }}</span>
            </div>
            <div class="receipt-item">
                <span class="receipt-label">Billets Réservés</span>
                <span class="receipt-value">1</span>
            </div>
            <div class="receipt-item">
                <span class="receipt-label">Email</span>
                <span class="receipt-value">{{ $payment->email }}</span>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="actions-container">
            <a href="#" class="btn btn-primary">
                <i class="fas fa-download"></i>
                Télécharger le billets
            </a>
            <a href="{{ route("ortn.evenements") }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Retour aux événements
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script src="{{ asset("js/Front/Evenements/success.js") }}"></script>
</body>
</html>