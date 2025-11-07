// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileNav = document.getElementById('mobileNav');
const mobileNavOverlay = document.getElementById('mobileNavOverlay');
const body = document.body;

if (mobileMenuBtn && mobileNav && mobileNavOverlay) {
    function toggleMobileMenu() {
        mobileNav.classList.toggle('active');
        mobileNavOverlay.classList.toggle('active');
        body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
        
        const icon = mobileMenuBtn.querySelector('i');
        if (icon) {
            if (mobileNav.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    }

    mobileMenuBtn.addEventListener('click', toggleMobileMenu);
    mobileNavOverlay.addEventListener('click', toggleMobileMenu);

    // Close mobile menu when clicking on a link
    document.querySelectorAll('.mobile-nav-item').forEach(item => {
        item.addEventListener('click', toggleMobileMenu);
    });

    // Prevent body scroll when mobile menu is open
    let lastScrollY = 0;
    mobileMenuBtn.addEventListener('click', function() {
        if (!mobileNav.classList.contains('active')) {
            lastScrollY = window.scrollY;
        } else {
            window.scrollTo(0, lastScrollY);
        }
    });

    // Keyboard navigation for accessibility
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
            toggleMobileMenu();
        }
    });
}

// Header scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.main-header');
    if (header) {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }
});

// Search functionality
const searchInput = document.querySelector('.search-box input');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const podcastCards = document.querySelectorAll('.podcast-card');
        
        podcastCards.forEach(card => {
            const titleEl = card.querySelector('.podcast-title');
            const descEl = card.querySelector('.podcast-description');
            
            if (titleEl && descEl) {
                const title = titleEl.textContent.toLowerCase();
                const description = descEl.textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    });
}

// Play button interactions (effet visuel uniquement)
document.querySelectorAll('.play-btn-small, .btn-hero-primary, .btn-hero-secondary').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        this.style.transform = 'scale(0.9)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe cards for animation
document.querySelectorAll('.podcast-card, .series-card').forEach(card => {
    if (card) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    }
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add hover effect to filter section when scrolling
let lastScrollTop = 0;
const filterSection = document.querySelector('.filter-section');

if (filterSection) {
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > lastScrollTop && scrollTop > 200) {
            filterSection.style.transform = 'translateY(-5px)';
            filterSection.style.boxShadow = '0 8px 30px rgba(0,51,102,0.12)';
        } else {
            filterSection.style.transform = 'translateY(0)';
            filterSection.style.boxShadow = '0 4px 20px rgba(0,51,102,0.05)';
        }
        
        lastScrollTop = scrollTop;
    });
}

// Lazy loading for images
const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const img = entry.target;
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.5s ease';
            
            setTimeout(() => {
                img.style.opacity = '1';
            }, 100);
            
            observer.unobserve(img);
        }
    });
});

document.querySelectorAll('.podcast-image, .series-cover img').forEach(img => {
    if (img) {
        imageObserver.observe(img);
    }
});

// Add ripple effect to buttons
function createRipple(event) {
    const button = event.currentTarget;
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    const rippleElement = button.querySelector('.ripple');
    if (rippleElement) {
        rippleElement.remove();
    }
    
    button.appendChild(ripple);
}

// Apply ripple to all buttons
document.querySelectorAll('button, .btn-hero-primary, .btn-hero-secondary, .btn-view-series').forEach(button => {
    if (button) {
        button.style.position = 'relative';
        button.style.overflow = 'hidden';
        button.addEventListener('click', createRipple);
    }
});

// Add CSS for ripple effect
const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Loader
window.addEventListener('load', function() {
    const progressBar = document.getElementById('loaderProgress');
    const loader = document.getElementById('loader');
    
    if (progressBar && loader) {
        let progress = 0;
        const interval = setInterval(() => {
            progress += 5;
            progressBar.style.width = progress + '%';
            
            if (progress >= 100) {
                clearInterval(interval);
                setTimeout(() => {
                    loader.style.opacity = '0';
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 600);
                }, 200);
            }
        }, 25);
    }
});

// ========================================
// GESTION RADIO ET BASCULEMENT PODCAST/RADIO
// ========================================

document.addEventListener('DOMContentLoaded', () => {
    // Éléments du lecteur de podcast
    const playButtons = document.querySelectorAll('.play-btn-small');
    const podcastPlayerContainer = document.getElementById('audioPlayerContainer');
    const podcastPlayer = document.getElementById('globalAudioPlayer');

    // Vérification de l'existence des éléments essentiels
    if (!podcastPlayer) {
        console.warn('Lecteur audio non trouvé');
        return;
    }

    // Éléments de la radio
    const radioPlayButton = document.querySelector('.play-button-large');
    const radioPlayer = new Audio('https://cast4.asurahosting.com/proxy/life/stream');
    radioPlayer.preload = 'none';

    // État global pour savoir ce qui joue
    let currentMode = null; // 'podcast' ou 'radio'
    let isRadioPlaying = false;

    // Éléments UI du mini-player podcast
    const thumb = document.getElementById('audioPlayerThumb');
    const titleEl = document.getElementById('audioPlayerTitle');
    const subEl = document.getElementById('audioPlayerSub');
    const toggleBtn = document.getElementById('togglePlayBtn');
    const toggleIcon = document.getElementById('togglePlayIcon');
    const progress = document.getElementById('audioProgress');
    const progressBar = document.getElementById('audioProgressBar');
    const currentTimeEl = document.getElementById('currentTime');
    const durationTimeEl = document.getElementById('durationTime');

    // ========================================
    // FONCTIONS UTILITAIRES
    // ========================================

    function formatTime(sec) {
        if (isNaN(sec)) return '0:00';
        const m = Math.floor(sec / 60);
        const s = Math.floor(sec % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    function showPodcastPlayer() {
        if (podcastPlayerContainer) {
            podcastPlayerContainer.style.display = 'flex';
        }
    }

    function updatePodcastIcon() {
        if (!toggleIcon) return;
        if (podcastPlayer.paused) {
            toggleIcon.classList.remove('fa-pause');
            toggleIcon.classList.add('fa-play');
        } else {
            toggleIcon.classList.remove('fa-play');
            toggleIcon.classList.add('fa-pause');
        }
    }

    function updateRadioButton() {
        if (!radioPlayButton) return;
        const icon = radioPlayButton.querySelector('i');
        if (icon) {
            if (isRadioPlaying) {
                icon.classList.remove('fa-play');
                icon.classList.add('fa-pause');
            } else {
                icon.classList.remove('fa-pause');
                icon.classList.add('fa-play');
            }
        }
    }

    function addWaveAnimation() {
        const waves = document.querySelectorAll('.wave-bar');
        waves.forEach(wave => {
            if (wave) {
                wave.style.animation = 'wave 1s ease-in-out infinite';
            }
        });
    }

    function removeWaveAnimation() {
        const waves = document.querySelectorAll('.wave-bar');
        waves.forEach(wave => {
            if (wave) {
                wave.style.animation = 'none';
            }
        });
    }

    // ========================================
    // ARRÊTER LA RADIO
    // ========================================

    function stopRadio() {
        if (isRadioPlaying) {
            radioPlayer.pause();
            radioPlayer.currentTime = 0;
            isRadioPlaying = false;
            updateRadioButton();
            removeWaveAnimation();
        }
    }

    // ========================================
    // ARRÊTER LE PODCAST
    // ========================================

    function stopPodcast() {
        if (podcastPlayer && !podcastPlayer.paused) {
            podcastPlayer.pause();
            updatePodcastIcon();
        }
    }

    // ========================================
    // GESTION DES BOUTONS PLAY DES PODCASTS
    // ========================================

    playButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            const src = btn.getAttribute('data-audio');
            const title = btn.getAttribute('data-title') || 'Podcast';
            const sub = btn.getAttribute('data-sub') || '';
            const img = btn.getAttribute('data-thumb');

            if (!src) {
                console.warn('Aucune source audio trouvée');
                return;
            }

            // Si la radio joue, on l'arrête
            if (currentMode === 'radio') {
                stopRadio();
            }

            // Basculer vers le mode podcast
            currentMode = 'podcast';

            // Si nouveau src, change tout
            if (!podcastPlayer.src || podcastPlayer.src !== src) {
                podcastPlayer.src = src;
                podcastPlayer.load();
                podcastPlayer.play().catch(e => {
                    console.warn('Playback failed:', e);
                });
            } else {
                // toggle play/pause
                if (podcastPlayer.paused) {
                    podcastPlayer.play().catch(e => {
                        console.warn('Playback failed:', e);
                    });
                } else {
                    podcastPlayer.pause();
                }
            }

            // Mettre à jour l'UI
            if (titleEl) titleEl.textContent = title;
            if (subEl) subEl.textContent = sub;
            if (thumb && img) thumb.src = img;
            showPodcastPlayer();
            updatePodcastIcon();
        });
    });

    // ========================================
    // GESTION DU BOUTON PLAY DE LA RADIO
    // ========================================

    if (radioPlayButton) {
        radioPlayButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            // Si un podcast joue, on l'arrête
            if (currentMode === 'podcast') {
                stopPodcast();
            }

            // Basculer vers le mode radio
            currentMode = 'radio';

            if (!isRadioPlaying) {
                // Démarrer la radio
                radioPlayer.play()
                    .then(() => {
                        isRadioPlaying = true;
                        updateRadioButton();
                        addWaveAnimation();
                        console.log('Radio en lecture');
                    })
                    .catch(e => {
                        console.error('Erreur de lecture radio:', e);
                        isRadioPlaying = false;
                        updateRadioButton();
                    });
            } else {
                // Arrêter la radio
                stopRadio();
            }
        });
    }

    // ========================================
    // MINI-PLAYER PODCAST - TOGGLE PLAY/PAUSE
    // ========================================

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            // Si la radio joue, on l'arrête d'abord
            if (currentMode === 'radio') {
                stopRadio();
            }

            currentMode = 'podcast';

            if (podcastPlayer.paused) {
                podcastPlayer.play().catch(e => {
                    console.warn('Playback failed:', e);
                });
            } else {
                podcastPlayer.pause();
            }
            updatePodcastIcon();
        });
    }

    // ========================================
    // ÉVÉNEMENTS DU PODCAST PLAYER
    // ========================================

    podcastPlayer.addEventListener('timeupdate', () => {
        if (progressBar) {
            const pct = (podcastPlayer.currentTime / podcastPlayer.duration) * 100 || 0;
            progressBar.style.width = pct + '%';
        }
        if (currentTimeEl) {
            currentTimeEl.textContent = formatTime(podcastPlayer.currentTime);
        }
    });

    podcastPlayer.addEventListener('loadedmetadata', () => {
        if (durationTimeEl) {
            durationTimeEl.textContent = formatTime(podcastPlayer.duration);
        }
    });

    podcastPlayer.addEventListener('play', updatePodcastIcon);
    podcastPlayer.addEventListener('pause', updatePodcastIcon);
    podcastPlayer.addEventListener('ended', updatePodcastIcon);

    // Seek dans la barre de progression
    if (progress) {
        progress.addEventListener('click', (e) => {
            const rect = progress.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const pct = x / rect.width;
            if (!isNaN(podcastPlayer.duration)) {
                podcastPlayer.currentTime = pct * podcastPlayer.duration;
            }
        });
    }

    // ========================================
    // GESTION DES ERREURS RADIO
    // ========================================

    radioPlayer.addEventListener('error', (e) => {
        console.error('Erreur flux radio:', e);
        isRadioPlaying = false;
        updateRadioButton();
        removeWaveAnimation();
    });

    radioPlayer.addEventListener('stalled', () => {
        console.warn('Flux radio en attente...');
    });

    radioPlayer.addEventListener('waiting', () => {
        console.log('Buffering radio...');
    });

    radioPlayer.addEventListener('canplay', () => {
        console.log('Radio prête');
    });
});

// ========================================
// CSS POUR L'ANIMATION DES ONDES
// ========================================

const waveStyle = document.createElement('style');
waveStyle.textContent = `
    @keyframes wave {
        0%, 100% {
            transform: scaleY(0.5);
        }
        50% {
            transform: scaleY(1);
        }
    }
    
    .wave-bar:nth-child(1) { animation-delay: 0s; }
    .wave-bar:nth-child(2) { animation-delay: 0.1s; }
    .wave-bar:nth-child(3) { animation-delay: 0.2s; }
    .wave-bar:nth-child(4) { animation-delay: 0.3s; }
    .wave-bar:nth-child(5) { animation-delay: 0.2s; }
    .wave-bar:nth-child(6) { animation-delay: 0.1s; }
    .wave-bar:nth-child(7) { animation-delay: 0s; }
`;
document.head.appendChild(waveStyle);