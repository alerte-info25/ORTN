<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communiqués - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Communiques/index.css") }}">
</head>
<body>
    <div class="animated-bg"></div>

    <!-- Loader -->
    @include("Front.partials.loader")

    @include("Front.partials.header")

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <div class="page-breadcrumb">
                    <a href="#">Accueil</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Communiqués</span>
                </div>
                <h1 class="page-title">
                    Tous les <span class="highlight">communiqués</span> officiels
                </h1>
                <p class="page-subtitle">
                    Retrouvez l'ensemble des communiqués officiels du gouvernement, des institutions et des partenaires de l'ORTN.
                </p>
            </div>
        </div>
    </section>

    <!-- Official Communique -->
    <section class="communiques-section">
        <div class="container">

            @forelse ($communiques as $communique)
                <div class="official-communique">
                    <div class="official-content">
                        <div class="official-header">
                            {{-- <div class="official-icon">
                                <i class="fas fa-scroll"></i>
                            </div> --}}
                            <div>
                                <h2 class="official-title">
                                    {{ $communique->subtitle }}
                                </h2>
                                <p class="official-subtitle">
                                    {{ $communique->title }}
                                </p>
                            </div>
                        </div>
                        <div class="official-body">
                            <p>
                                {!! $communique->content !!}
                            </p>
                        </div>
                        <div class="official-footer">
                            <div class="official-signature">
                                <div class="signature-stamp">
                                    <i class="fas fa-stamp"></i>
                                </div>
                                <div class="signature-text">
                                    Office de Radio et Télévision
                                    <span>de Ngazidja</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Aucun communiqués trouvé.</div>
            @endforelse

        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h2 class="newsletter-title">Restez informé en temps réel</h2>

                @if (session()->has("alert"))
                    <div class="alert alert-{{ session("alert")["type"] }}">
                        {{ session("alert")["message"] }}
                    </div>
                @endif

                <p class="newsletter-description">
                    Abonnez-vous à notre newsletter et recevez les dernières actualités directement dans votre boîte mail.
                </p>
                <form method="POST" action="{{ route("ortn.newsletters.store") }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Votre adresse email" required style="border-radius: 2px solid rgba(255,255,255,0.5); padding: 12px 20px; border: none;">
                    </div>
                    <button type="submit" class="btn w-100" style="background: white; color: var(--primary-red); border-radius: 2px solid rgba(255,255,255,0.5); padding: 12px; font-weight: 600; border: none;">
                        S'abonner maintenant
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand">ORTN</div>
                    <p class="footer-description">
                        Office de Radiodiffusion Télévision du Niger - Votre média de service public pour une information de qualité, fiable et accessible à tous.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="social-link">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="footer-title">Navigation</h3>
                    <ul class="footer-links">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Actualités</a></li>
                        <li><a href="#">Communiqués</a></li>
                        <li><a href="#">Programmes TV & Radio</a></li>
                        <li><a href="#">Vidéos / Podcasts</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer-title">Services</h3>
                    <ul class="footer-links">
                        <li><a href="#">Radio en direct</a></li>
                        <li><a href="#">TV en direct</a></li>
                        <li><a href="#">Replay</a></li>
                        <li><a href="#">Archives</a></li>
                        <li><a href="#">Communiqués</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer-title">Contact</h3>
                    <div class="footer-contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Niamey, Niger</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+227 XX XX XX XX</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>contact@ortn.ne</span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-clock"></i>
                        <span>24h/24 - 7j/7</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 ORTN - Office de Radiodiffusion Télévision du Niger. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset("js/Front/Communiques/index.js") }}"></script>

</body>
</html>