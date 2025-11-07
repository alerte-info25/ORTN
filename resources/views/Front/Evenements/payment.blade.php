<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement | ORTN | Office de la Radio et Télévision de Ngazidja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Evenements/payment.css") }}">
</head>
<body>
    
    @include("Front.partials.loader")

    @include("Front.partials.header")

    <!-- Payment Hero Section -->
    <section class="payment-hero-section">
        <div class="payment-hero-particles" id="paymentParticlesContainer"></div>
        
        <div class="container">
            <div class="payment-hero-content">
                <div class="payment-eyebrow">
                    <div class="payment-eyebrow-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <span class="payment-eyebrow-text">PAIEMENT SÉCURISÉ</span>
                </div>

                <h1 class="payment-hero-title">
                    Finalisez votre <span class="gradient-text">paiement</span>
                </h1>

                <p class="payment-hero-subtitle">
                    Votre transaction est protégée par les dernières technologies de sécurité. Remplissez vos informations pour finaliser votre achat.
                </p>
            </div>
        </div>
    </section>

    <!-- Payment Section -->
    <section class="payment-section">
        <div class="container">
            <div class="payment-container">
                <!-- Payment Form -->
                <div class="payment-form-container">
                    <h2 class="section-title">Informations personnelles</h2>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    @if (session()->has('alert'))
                        <x-alert type="{{ session('alert')['type'] }}">
                            {{ session('alert')['message'] }}
                        </x-alert>
                    @endif
                    
                    <form id="paymentForm" method="POST" action="{{ route('ortn.payments.store', ['slug' => $event->slug]) }}">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label for="lastName" class="form-label">Nom *</label>
                                <input type="text" id="lastName" name="prenom" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="firstName" class="form-label">Prénom *</label>
                                <input type="text" id="firstName" name="nom" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Adresse email *</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Numéro de téléphone *</label>
                            <input type="tel" id="phone" name="telephone" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="organization" class="form-label">Organisation</label>
                            <input type="text" id="organization" name="organisation" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="nationalite" class="form-label">Nationalité *</label>
                            <input type="text" id="nationalite" name="nationalite" class="form-control" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="pays" class="form-label">Pays *</label>
                                <input type="text" id="pays" name="pays" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="ville" class="form-label">Ville *</label>
                                <input type="text" id="ville" name="ville" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="adresse" class="form-label">Adresse *</label>
                            <input type="text" id="adresse" name="adresse" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="code_postal" class="form-label">Code postal *</label>
                            <input type="text" id="code_postal" name="code_postal" class="form-control" required>
                        </div>

                        <!-- Payment Summary -->
                        <div class="payment-summary-container">
                            <h2 class="section-title">Récapitulatif</h2>

                            <div class="summary-item">
                                <span class="summary-label">Abonnement évènements</span>
                                <span class="summary-value">{{ $event->title }}</span>
                            </div>

                            <div class="summary-item">
                                <span class="summary-label">Coût de l'abonnement</span>
                                <span class="summary-value">{{ $event->price }} Fcfa</span>
                            </div>

                            <div class="summary-item">
                                <span class="summary-label">Nombre de place à acheter</span>
                                <span class="summary-value">1 place</span>
                            </div>
                        </div>
                        
                        <input type="hidden" name="montant" value="{{ $event->price }}">

                        <button type="submit" class="btn-pay">
                            <i class="fas fa-lock"></i>
                            Payer maintenant
                        </button>

                        <div class="secure-payment">
                            <i class="fas fa-shield-alt"></i>
                            Paiement 100% sécurisé - Vos données sont cryptées
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset("js/Front/Evenements/payment.js") }}"></script>
</body>
</html>