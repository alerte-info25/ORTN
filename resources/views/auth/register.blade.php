<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("css/Front/register.css") }}">
</head>
<body>

    <!-- Loader Overlay -->
    <div class="loader-overlay" id="loaderOverlay">
        <div class="loader-content">
            <div class="loader-spinner"></div>
            <div class="loader-text">Création de votre compte</div>
            <div class="loader-subtext">Veuillez patienter pendant que nous terminons l'opération.</div>
        </div>
    </div>

    <div class="register-container">
        <!-- Left Side - Form Section -->
        <div class="form-section">
            <div class="form-header">
                <h2 class="form-title">Créer un compte</h2>
                <p class="form-subtitle">Rejoignez la plateforme ORTN</p>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-step">
                    <div class="step-number active" id="step1Number">1</div>
                    <div class="step-label active">Informations</div>
                </div>
                <div class="step-connector" id="step1Connector"></div>
                <div class="progress-step">
                    <div class="step-number" id="step2Number">2</div>
                    <div class="step-label">Profil</div>
                </div>
                <div class="step-connector" id="step2Connector"></div>
                <div class="progress-step">
                    <div class="step-number" id="step3Number">3</div>
                    <div class="step-label">Confirmation</div>
                </div>
            </div>

            <!-- Alert Messages -->
            <div class="alert alert-error" id="errorAlert">
                <i class="fas fa-exclamation-circle"></i>
                <span id="errorMessage">Veuillez corriger les erreurs dans le formulaire.</span>
            </div>

            <form class="register-form" id="registerForm" method="POST" action="{{ route("ortn.register.post") }}">

                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Step 1: Personal Information -->
                <div class="form-step active" id="step1">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required" for="firstName">Prénom</label>
                            <div class="input-group">
                                <input type="text" class="form-input" id="firstName" name="prenom" placeholder="Votre prénom" value="{{ old('prenom') }}" required>
                                <i class="fas fa-user input-icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label required" for="lastName">Nom</label>
                            <div class="input-group">
                                <input type="text" class="form-input" id="lastName" name="nom" placeholder="Votre nom" value="{{ old('nom') }}" required>
                                <i class="fas fa-user input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required" for="email">Adresse Email</label>
                        <div class="input-group">
                            <input type="email" class="form-input" id="email" name="email" placeholder="votre@email.com" value="{{ old('email') }}" required>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required" for="phone">Téléphone</label>
                        <div class="input-group">
                            <input type="tel" class="form-input" id="phone" name="contact" placeholder="+227 XX XX XX XX" value="{{ old('contact') }}" required>
                            <i class="fas fa-phone input-icon"></i>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-next" id="nextToStep2">
                            Suivant
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Profile Information -->
                <div class="form-step" id="step2">

                    <div class="form-group">
                        <label for="role" class="form-label required">Genre</label>
                        <div class="input-group">
                            <select name="genre" class="form-select" id="role">
                                <option value="">choisissez votre genre</option>
                                <option value="homme">Homme</option>
                                <option value="Femme">Femme</option>
                                <option value="autres">autres</option>
                            </select>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Localité</label>
                        <div class="input-group">
                            <input type="text" class="form-input" id="localite" name="localite" placeholder="abidjan" value="{{ old('localite') }}" required>
                            <i class="fas fa-location input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required" for="password">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-input" id="password" name="password" placeholder="Créez un mot de passe" required>
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="password-toggle" id="passwordToggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <div class="strength-text" id="strengthText">Force du mot de passe</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required" for="confirmPassword">Confirmer le mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-input" id="confirmPassword" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-prev" id="prevToStep1">
                            <i class="fas fa-arrow-left"></i>
                            Précédent
                        </button>
                        <button type="button" class="btn btn-next" id="nextToStep3">
                            Suivant
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Confirmation -->
                <div class="form-step" id="step3">
                    <div class="terms-group">
                        <div class="terms-checkbox">
                            <div class="checkbox" id="termsCheckbox">
                                <i class="fas fa-check" style="font-size: 12px; display: none;"></i>
                            </div>
                        </div>
                        <div class="terms-text">
                            <p>
                                J'accepte les <a href="#">conditions d'utilisation</a> et la 
                                <a href="#">politique de confidentialité</a> de ORTN. Je confirme que 
                                toutes les informations fournies sont exactes et que j'ai le droit 
                                de créer ce compte pour mon organisation.
                            </p>
                        </div>
                        <input type="checkbox" id="termsAgreement" style="display: none;">
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-prev" id="prevToStep2">
                            <i class="fas fa-arrow-left"></i>
                            Précédent
                        </button>
                        <button type="submit" class="btn btn-submit" id="submitForm">
                            <i class="fas fa-user-plus"></i>
                            Créer mon compte
                        </button>
                    </div>
                </div>
            </form>

            <div class="login-link">
                <p>Déjà un compte ? <a href="{{ route("ortn.login") }}">Se connecter</a></p>
            </div>
        </div>

        <!-- Right Side - Brand Section -->
        <div class="brand-section">
            <div>
                <div class="brand-header">
                    <div class="brand-logo">
                        <i class="fas fa-broadcast-tower"></i>
                    </div>
                    <h1 class="brand-title">ORTN</h1>
                    <p class="brand-subtitle">Office de Radiodiffusion et Télévision du Niger</p>
                </div>

                <ul class="benefits-list">
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="benefit-text">
                            <h4>Compte Sécurisé</h4>
                            <p>Protection avancée de vos données et accès</p>
                        </div>
                    </li>
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <div class="benefit-text">
                            <h4>Accès Immédiat</h4>
                            <p>Commencez à utiliser la plateforme dès l'approbation</p>
                        </div>
                    </li>
                    {{-- <li class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div class="benefit-text">
                            <h4>Support Dédié</h4>
                            <p>Équipe d'assistance disponible pour vous accompagner</p>
                        </div>
                    </li> --}}
                    <li class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="benefit-text">
                            <h4>Analytiques Complètes</h4>
                            <p>Suivez vos performances en temps réel</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="brand-footer">
                <p>© 2024 ORTN. Tous droits réservés.</p>
            </div>
        </div>
    </div>

    <script src="{{ asset("js/Front/register.js") }}"></script>
</body>
</html>