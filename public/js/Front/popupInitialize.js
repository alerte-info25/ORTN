// Fonction pour afficher le popup de réussite
function showSuccessPopup(title, message, options = {}) {
    const popup = document.getElementById('successPopup');
    const popupTitle = popup.querySelector('h2');
    const popupMessage = popup.querySelector('p');
    const continueBtn = document.getElementById('continueBtn');
    const homeBtn = document.getElementById('homeBtn');
    
    // Personnaliser le contenu du popup
    if (title) popupTitle.textContent = title;
    if (message) popupMessage.textContent = message;
    
    // Personnaliser les boutons si fournis
    if (options.continueText) continueBtn.innerHTML = `<i class="fas fa-arrow-right"></i> ${options.continueText}`;
    if (options.homeText) homeBtn.innerHTML = `<i class="fas fa-home"></i> ${options.homeText}`;
    
    // Ajouter des actions personnalisées aux boutons
    if (options.onContinue) {
        continueBtn.onclick = options.onContinue;
    }
    
    if (options.onHome) {
        homeBtn.onclick = options.onHome;
    }
    
    // Afficher le popup
    popup.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Générer des confettis
    createConfetti();
}

// Fonction pour fermer le popup
function closeSuccessPopup() {
    const popup = document.getElementById('successPopup');
    popup.classList.remove('active');
    document.body.style.overflow = '';
    window.location.reload();
}

// Fonction pour créer des confettis
function createConfetti() {
    const container = document.getElementById('confettiContainer');
    container.innerHTML = '';
    
    const colors = ['#003366', '#2D8659', '#FFD700', '#DAA520', '#1F5F3F'];
    
    for (let i = 0; i < 100; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.left = Math.random() * 100 + '%';
        confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        confetti.style.animationDelay = Math.random() * 5 + 's';
        confetti.style.animationDuration = (Math.random() * 3 + 3) + 's';
        container.appendChild(confetti);
    }
}

window.addEventListener('load', function () {
    if (window.popupData) {
        const data = window.popupData;

        let title = "Notification";
        let message = data.message || "Action effectuée.";
        let type = data.type || "info";

        // Définir le titre selon l'action
        switch (data.action) {
            case 'register':
                title = "Inscription réussie !";
                break;
            case 'login':
                title = "Connexion réussie !";
                break;
            case 'logout':
                title = "Déconnexion";
                break;
            default:
                title = type === 'success' ? "Succès" :
                        type === 'warning' ? "Attention" :
                        type === 'error' ? "Erreur" : "Notification";
        }

        // Affichage du popup
        showSuccessPopup(
            title,
            message,
            {
                continueText: data.continueText || "Continuer",
                homeText: data.homeText || "Accueil",
                onContinue: function () {
                    if (data.continueUrl) {
                        window.location.href = data.continueUrl;
                    }
                    closeSuccessPopup();
                },
                onHome: function () {
                    if (data.homeUrl) {
                        window.location.href = data.homeUrl;
                    }
                    closeSuccessPopup();
                }
            }
        );
    }
});

// Fermer le popup avec le bouton de fermeture
document.getElementById('closePopup').addEventListener('click', closeSuccessPopup);