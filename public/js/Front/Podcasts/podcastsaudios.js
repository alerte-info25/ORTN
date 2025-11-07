// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileNav = document.getElementById('mobileNav');
const mobileNavOverlay = document.getElementById('mobileNavOverlay');
const body = document.body;

function toggleMobileMenu() {
    mobileNav.classList.toggle('active');
    mobileNavOverlay.classList.toggle('active');
    body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
    
    const icon = mobileMenuBtn.querySelector('i');
    if (mobileNav.classList.contains('active')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
    } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
}

mobileMenuBtn.addEventListener('click', toggleMobileMenu);
mobileNavOverlay.addEventListener('click', toggleMobileMenu);

// Close mobile menu when clicking on a link
document.querySelectorAll('.mobile-nav-item').forEach(item => {
    item.addEventListener('click', toggleMobileMenu);
});

// Header scroll effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('.main-header');
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// -------------------- Loader --------------------
window.addEventListener('load', function() {
    let progress = 0;
    const progressBar = document.getElementById('loaderProgress');
    const loader = document.getElementById('loader');
    
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
});

// -------------------- Navbar scroll effect --------------------
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('scrolled', window.scrollY > 50);
});

// -------------------- Podcast Player --------------------
document.addEventListener('DOMContentLoaded', () => {
    const playerBar = document.getElementById('audioPlayerBar');
    const playerAudio = document.getElementById('playerAudio');
    const playerTitle = document.getElementById('playerTitle');
    const playerCategory = document.getElementById('playerCategory');
    const playerCover = document.getElementById('playerCover');
    const closePlayer = document.getElementById('closePlayer');

    const radioAudio = document.getElementById('featuredAudio');
    const radioPlayBtn = document.getElementById('featuredPlayBtn');
    const radioPlayIcon = document.getElementById('featuredPlayIcon');
    const radioStatus = document.getElementById('liveStatus');

    // Fonction pour mettre en pause la radio si un podcast démarre
    function pauseRadioIfPlaying() {
        if (!radioAudio.paused) {
            radioAudio.pause();
            radioPlayIcon.classList.remove('fa-pause');
            radioPlayIcon.classList.add('fa-play');
            radioStatus.textContent = "En pause";
        }
    }

    // Lecture d’un podcast depuis la carte
    document.querySelectorAll('.play-btn-overlay').forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.podcast-card');
            const audioUrl = btn.getAttribute('data-audio');
            const title = card.querySelector('.podcast-title').textContent;
            const category = card.querySelector('.podcast-category').textContent;
            const img = card.querySelector('img').src;

            pauseRadioIfPlaying();

            playerAudio.src = audioUrl;
            playerTitle.textContent = title;
            playerCategory.textContent = category;
            playerCover.src = img;

            playerBar.style.display = 'flex';
            playerAudio.play();
        });
    });

    closePlayer.addEventListener('click', () => {
        playerAudio.pause();
        playerBar.style.display = 'none';
    });

    // -------------------- Radio Featured Player --------------------
    radioPlayBtn.addEventListener('click', function() {
        // Pause le podcast si la radio démarre
        if (!playerAudio.paused) {
            playerAudio.pause();
            playerBar.style.display = 'none';
        }

        if (radioAudio.paused) {
            radioAudio.play();
            radioPlayIcon.classList.replace('fa-play', 'fa-pause');
            radioStatus.textContent = "EN DIRECT";
        } else {
            radioAudio.pause();
            radioPlayIcon.classList.replace('fa-pause', 'fa-play');
            radioStatus.textContent = "En pause";
        }
    });

    radioAudio.addEventListener('ended', function() {
        radioPlayIcon.classList.replace('fa-pause', 'fa-play');
        radioStatus.textContent = "En pause";
    });
});
