
<link rel="stylesheet" href="{{ asset("css/Front/popup.css") }}">
<!-- Popup de réussite -->
<div class="success-popup-overlay" id="successPopup">
    <div class="success-popup">
        <button class="success-popup-close" id="closePopup">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h2>Félicitations !</h2>
        <p>Votre action a été réalisée avec succès. Vous pouvez maintenant continuer à explorer notre plateforme ou retourner à l'accueil.</p>
        
        <div class="success-popup-buttons">
            <button class="success-popup-btn success-popup-btn-primary" id="continueBtn">
                <i class="fas fa-arrow-right"></i>
                Continuer
            </button>
            <button class="success-popup-btn success-popup-btn-secondary" id="homeBtn">
                <i class="fas fa-home"></i>
                Retour à l'accueil
            </button>
        </div>
        
        <div class="confetti-container" id="confettiContainer"></div>
    </div>
</div>