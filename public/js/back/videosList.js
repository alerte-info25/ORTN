// Loader
window.addEventListener('load', function() {
    let progress = 0;
    const progressBar = document.getElementById('loadingProgress');
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
                }, 500);
            }, 200);
        }
    }, 30);
});

// Sidebar toggle
const toggleSidebar = document.getElementById('toggleSidebar');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

toggleSidebar.addEventListener('click', function() {
    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('mobile-open');
        sidebarOverlay.classList.toggle('active');
    } else {
        sidebar.classList.toggle('collapsed');
    }
});

sidebarOverlay.addEventListener('click', function() {
    sidebar.classList.remove('mobile-open');
    sidebarOverlay.classList.remove('active');
});

// Nav links
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('mobile-open');
            sidebarOverlay.classList.remove('active');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const videoCards = document.querySelectorAll('.video-card');

    videoCards.forEach((card, index) => {
        const title = card.querySelector('.video-title').textContent;
        const description = card.dataset.description;
        const date = card.querySelector('.video-meta span').textContent;
        const image = card.querySelector('img').src;
        const videoUrl = card.dataset.videoUrl;
        const category = card.querySelector('.category-badge').textContent;

        // Détecte le type de vidéo
        let videoContent = '';

        if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
            // Récupération de l'ID YouTube
            let videoId = '';
            const youtubeRegex = /(?:youtube\.com\/.*v=|youtu\.be\/)([^&]+)/;
            const match = videoUrl.match(youtubeRegex);
            if (match && match[1]) {
                videoId = match[1];
            }

            videoContent = `
                <iframe width="100%" height="400"
                    src="https://www.youtube.com/embed/${videoId}"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            `;
        } else if (videoUrl.includes('vimeo.com')) {
            // Récupération de l'ID Vimeo
            const vimeoId = videoUrl.split('/').pop();
            videoContent = `
                <iframe width="100%" height="400"
                    src="https://player.vimeo.com/video/${vimeoId}"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen>
                </iframe>
            `;
        } else {
            // Fichier vidéo classique (.mp4)
            videoContent = `
                <video id="videoPlayer-${index}" controls>
                    <source src="${videoUrl}" type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>
            `;
        }

        // Création du modal
        const modal = document.createElement('div');
        modal.classList.add('modal');
        modal.id = `videoModal-${index}`;
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">${title}</h3>
                    <button class="close-btn" id="closeModal-${index}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="video-player-wrapper">
                        ${videoContent}
                    </div>
                    <div class="video-info-section">
                        <h4 class="video-info-title">${title}</h4>
                        <div class="video-info-meta">
                            <span><i class="fas fa-calendar"></i> ${date}</span>
                            <span><i class="fas fa-tags"></i> ${category}</span>
                        </div>
                        <div class="video-info-description">${description}</div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);

        const closeBtn = modal.querySelector(`#closeModal-${index}`);

        // Clique sur la carte - ouvre le modal
        card.addEventListener('click', e => {
            if (!e.target.closest('.video-actions')) {
                modal.classList.add('show');
            }
        });

        // Fermer le modal
        closeBtn.addEventListener('click', () => {
            modal.classList.remove('show');
            const videoPlayer = modal.querySelector('video');
            if (videoPlayer) {
                videoPlayer.pause();
                videoPlayer.currentTime = 0;
            }
            const iframe = modal.querySelector('iframe');
            if (iframe) {
                iframe.src = iframe.src; // stoppe la vidéo
            }
        });

        // Fermer si clic à l’extérieur
        modal.addEventListener('click', e => {
            if (e.target === modal) {
                modal.classList.remove('show');
                const videoPlayer = modal.querySelector('video');
                if (videoPlayer) {
                    videoPlayer.pause();
                    videoPlayer.currentTime = 0;
                }
                const iframe = modal.querySelector('iframe');
                if (iframe) {
                    iframe.src = iframe.src;
                }
            }
        });
    });
});


// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
    }
});