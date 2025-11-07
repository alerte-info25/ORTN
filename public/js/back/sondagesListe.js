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

// window.addEventListener('resize', handleResize);

// Smooth scroll for anchors
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

// Add hover effect on poll cards
const pollCards = document.querySelectorAll('.poll-card');
pollCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.3s ease';
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('pollModal');
    const closeBtn = document.getElementById('closePollModal');

    const modalTitle = document.getElementById('pollModalTitle');
    const meta = document.getElementById('pollPreviewMeta');
    const desc = document.getElementById('pollPreviewDescription');
    const optionsContainer = document.getElementById('pollPreviewOptions');

    const buttons = document.querySelectorAll('.poll-card .btn-view');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.poll-card');

            const title = card.dataset.title;
            const description = JSON.parse(card.dataset.description);
            const status = card.dataset.status;
            const date = card.dataset.date;
            const dateFin = card.dataset.datefin;
            const author = card.dataset.author;
            const options = JSON.parse(card.dataset.options);

            modalTitle.textContent = title;

            meta.innerHTML = `
                <p><i class="fas fa-user"></i> ${author}</p>
                <p><i class="fas fa-calendar"></i> Créé ${date}</p>
                <p><i class="fas fa-hourglass-end"></i> Fin ${dateFin}</p>
                <p><i class="fas fa-circle"></i> Statut : <strong>${status}</strong></p>
            `;

            desc.innerHTML = `<p>${description}</p>`;

            // Liste des options
            optionsContainer.innerHTML = `
                <h4>Options :</h4>
                <ul>
                    ${options.map(o => `<li>${o}</li>`).join('')}
                </ul>
            `;

            modal.style.display = 'flex';
        });
    });

    closeBtn.addEventListener('click', () => modal.style.display = 'none');
    modal.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; });
});