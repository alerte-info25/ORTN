<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - ORTN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset("css/Front/Contact/index.css") }}">
</head>
<body>

    @include("Front.partials.loader")

    @include("Front.partials.header")

    <section class="page-hero">
        <div class="container">
            <div class="page-hero-content">
                <div class="breadcrumb-custom">
                    <a href="#">Accueil</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Contact</span>
                </div>
                <h1 class="page-title">Contactez-nous</h1>
                <p class="page-subtitle">
                    Notre équipe est à votre écoute pour répondre à toutes vos questions et préoccupations
                </p>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info-cards">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <h3>Notre Adresse</h3>
                            <p>Siège de l'ORTN<br>
                            Moroni, Ngazidja<br>
                            Union des Comores</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="info-content">
                            <h3>Téléphone</h3>
                            <p>Standard : <a href="tel:+2697731234">+269 773 12 34</a></p>
                            <p>Rédaction : <a href="tel:+2697731235">+269 773 12 35</a></p>
                            <p>Service commercial : <a href="tel:+2697731236">+269 773 12 36</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h3>Email</h3>
                            <p>Contact général : <a href="mailto:contact@ortn.km">contact@ortn.km</a></p>
                            <p>Rédaction : <a href="mailto:redaction@ortn.km">redaction@ortn.km</a></p>
                            <p>Publicité : <a href="mailto:pub@ortn.km">pub@ortn.km</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-content">
                            <h3>Horaires</h3>
                            <p><strong>Diffusion :</strong> 24h/24 - 7j/7</p>
                            <p><strong>Bureaux :</strong> Lun - Ven : 8h - 17h</p>
                            <p><strong>Samedi :</strong> 8h - 12h</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form-wrapper">

                    <h2 class="form-title">Envoyez-nous un message</h2>
                    <p class="form-subtitle">
                        Remplissez le formulaire ci-dessous et notre équipe vous répondra dans les meilleurs délais.
                    </p>

                    <form id="contactForm" method="POST" action="{{ route("ortn.contact.send") }}">
                        @csrf

                        @if (session()->has("alert"))
                            <div class="success-message show" id="successMessage">
                                <i class="fas fa-check-circle"></i> 
                                {{ session("alert")["message"] }}
                            </div>
                        @endif

                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">Prénom *</label>
                                <input type="text" id="firstName" name="firstName" required placeholder="Votre prénom">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Nom *</label>
                                <input type="text" id="lastName" name="lastName" required placeholder="Votre nom">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required placeholder="votre@email.com">
                            </div>
                            <div class="form-group">
                                <label for="phone">Téléphone</label>
                                <input type="tel" id="phone" name="phone" placeholder="+269 XXX XX XX">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Sujet *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Sélectionnez un sujet</option>
                                <option value="information">Demande d'information</option>
                                <option value="suggestion">Suggestion de programme</option>
                                <option value="publicite">Publicité / Partenariat</option>
                                <option value="reclamation">Réclamation</option>
                                <option value="emploi">Opportunités d'emploi</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" required placeholder="Écrivez votre message ici..."></textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i>
                            Envoyer le message
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <h2 class="section-title-modern">Où nous trouver</h2>
            <div class="map-container">
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3>Siège de l'ORTN</h3>
                    <p>Moroni, Ngazidja, Union des Comores</p>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <h2 class="section-title-modern">Questions Fréquentes</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Comment puis-je écouter la radio ORTN en ligne ?</h4>
                        <div class="faq-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Vous pouvez écouter la radio ORTN en direct sur notre site web en cliquant sur le bouton "Écouter la Radio" ou "EN DIRECT" disponible en haut de chaque page. Nous sommes également disponibles sur nos applications mobiles iOS et Android.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Comment proposer un sujet ou une émission ?</h4>
                        <div class="faq-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Nous sommes toujours à l'écoute de nouvelles idées ! Vous pouvez nous envoyer vos suggestions via le formulaire de contact ci-dessus en sélectionnant "Suggestion de programme" comme sujet, ou nous écrire directement à redaction@ortn.km.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Comment obtenir une rediffusion d'une émission ?</h4>
                        <div class="faq-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            La plupart de nos émissions sont disponibles en replay sur notre site web dans la section "Podcasts". Si une émission spécifique n'est pas disponible, contactez-nous avec la date et le titre de l'émission, et nous ferons notre possible pour vous la fournir.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Comment diffuser une publicité sur ORTN ?</h4>
                        <div class="faq-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Pour toute demande de publicité ou de partenariat commercial, veuillez contacter notre service commercial au +269 773 12 36 ou par email à pub@ortn.km. Notre équipe vous présentera nos différentes offres et tarifs.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>L'ORTN recrute-t-elle actuellement ?</h4>
                        <div class="faq-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Les offres d'emploi sont publiées sur notre site web dans la section "Carrières" et sur nos réseaux sociaux. Vous pouvez également envoyer une candidature spontanée via le formulaire de contact en sélectionnant "Opportunités d'emploi".
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Comment signaler un problème technique de diffusion ?</h4>
                        <div class="faq-icon">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            En cas de problème technique (coupure, mauvaise qualité du signal, etc.), veuillez nous contacter immédiatement via notre standard au +269 773 12 34 ou par email à contact@ortn.km en précisant votre localisation et la nature du problème.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="social-contact-section">
        <div class="container">
            <h2 class="social-title">Suivez-nous sur les réseaux sociaux</h2>
            <p class="social-subtitle">Restez connecté avec nous pour les dernières actualités et contenus exclusifs</p>
            
            <div class="social-grid">
                <a href="#" class="social-card">
                    <i class="fab fa-facebook-f"></i>
                    <h4>Facebook</h4>
                    <p>@ORTNOfficiel</p>
                </a>

                <a href="#" class="social-card">
                    <i class="fab fa-twitter"></i>
                    <h4>Twitter</h4>
                    <p>@ORTN_Officiel</p>
                </a>

                <a href="#" class="social-card">
                    <i class="fab fa-instagram"></i>
                    <h4>Instagram</h4>
                    <p>@ortn.officiel</p>
                </a>

                <a href="#" class="social-card">
                    <i class="fab fa-youtube"></i>
                    <h4>YouTube</h4>
                    <p>ORTN Ngazidja</p>
                </a>

                <a href="#" class="social-card">
                    <i class="fab fa-whatsapp"></i>
                    <h4>WhatsApp</h4>
                    <p>+269 773 12 34</p>
                </a>
            </div>
        </div>
    </section>

    @include("Front.partials.footer")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{ asset("js/Front/Contact/index.js") }}"></script>

</body>
</html>