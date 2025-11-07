<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ORTN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/login.css") }}">
</head>
<body>

    @include("Front.partials.loader")

    <div class="login-container">
        <!-- Left Side - Brand Section -->
        <div class="brand-section">
            <div>
                <div class="brand-header">
                    <div class="brand-logo">
                        <i class="fas fa-broadcast-tower"></i>
                    </div>
                    <h1 class="brand-title">ORTN</h1>
                    <p class="brand-subtitle">Office de Radiodiffusion et Télévision du Niger</p>
                </div>

                <ul class="features-list">
                    <li class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Gestion de Contenu</h4>
                            <p>Publiez et gérez vos articles en temps réel</p>
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-podcast"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Podcasts Multimédias</h4>
                            <p>Diffusez vos contenus audio et vidéo</p>
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Analytiques Avancées</h4>
                            <p>Suivez vos performances en détail</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="brand-footer">
                <p>© 2025 ORTN. Développé par <a href="" style="color: #fff">ALERTE INFO</a> Tous droits réservés.</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="login-section">
            <div class="login-header">
                <h2 class="login-title">Connexion</h2>
                <p class="login-subtitle">Accédez à votre espace d'administration</p>
            </div>

            <!-- Alert Messages -->
            <div class="alert alert-error" id="errorAlert">
                <i class="fas fa-exclamation-circle"></i>
                <span id="errorMessage">Identifiants incorrects. Veuillez réessayer.</span>
            </div>

            <div class="alert alert-success" id="successAlert">
                <i class="fas fa-check-circle"></i>
                <span>Connexion réussie ! Redirection en cours...</span>
            </div>

            <form class="login-form" method="POST" action="{{ route("ortn.login.post") }}">

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

                @if (session()->has("alert"))
                    <div class="alert alert-{{ session("alert")["type"] }}">
                        {{ session("alert")["message"] }}
                    </div>
                @endif

                <div class="form-group">
                    <label class="form-label" for="email">Adresse Email</label>
                    <div class="input-group">
                        <input type="email" class="form-input" id="email" name="email" placeholder="votre@email.com" required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="input-group">
                        <input type="password" class="form-input" id="password" name="password" placeholder="Votre mot de passe" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="loginButton">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </button>

                <div class="login-footer">
                    <p>Nouveau sur ORTN ? <a href="{{ route("ortn.register") }}">Créer un compte</a></p>
                </div>

            </form>

        </div>
    </div>

    <script src="{{ asset("js/Front/login.js") }}"></script>

</body>
</html>