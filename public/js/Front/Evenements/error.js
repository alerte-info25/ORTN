// Animation supplémentaire pour les éléments
document.addEventListener('DOMContentLoaded', function() {
    // Animation d'apparition progressive
    const elements = document.querySelectorAll('.failure-icon, .failure-title, .failure-subtitle, .error-message, .event-card, .error-details, .actions-container');
    
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 200);
    });
    
    // Animation de secousse pour l'icône d'échec
    const failureIcon = document.querySelector('.failure-icon');
    setTimeout(() => {
        failureIcon.style.animation = 'shake 0.5s ease-in-out';
    }, 1000);
});

// Réappliquer l'animation de secousse au survol
document.querySelector('.failure-icon').addEventListener('mouseover', function() {
    this.style.animation = 'shake 0.5s ease-in-out';
});