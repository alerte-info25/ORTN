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

// Responsive handling
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
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

// Add animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
        }
    });
}, observerOptions);

document.querySelectorAll('.newsletter-card, .stat-card').forEach(element => {
    observer.observe(element);
});

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('newsletterModal');
    const closeModalBtn = document.getElementById('closeModal');

    const modalTitle = document.getElementById('modalNewsletterTitle');
    const previewTitle = document.getElementById('previewTitle');
    const previewMeta = document.getElementById('previewMeta');
    const previewContent = document.getElementById('previewContent');
    const previewImage = document.getElementById('previewImage');

    const viewButtons = document.querySelectorAll('.btn-view');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const card = button.closest('.newsletter-card');

            const title = card.dataset.title;
            const date = card.dataset.date;
            const author = card.dataset.author;
            const tag = card.dataset.tag;
            const image = card.dataset.image;
            const content = JSON.parse(card.dataset.content);

            // Injection des données dans le modal
            modalTitle.textContent = title;
            previewTitle.textContent = title;

            previewMeta.innerHTML = `
                <span><i class="fas fa-user"></i> ${author}</span>
                <span><i class="fas fa-calendar"></i> ${date}</span>
                <span><i class="fas fa-tag"></i> ${tag}</span>
            `;

            // Gestion de l'image
            if (image && image.trim() !== "") {
                previewImage.src = image.startsWith('http') ? image : `/storage/${image}`;
                previewImage.style.display = 'block';
            } else {
                previewImage.style.display = 'none';
            }

            previewImage.alt = `Image de ${title}`;
            previewContent.innerHTML = content;

            // Affichage du modal
            modal.style.display = 'flex';
        });
    });

    // Fermeture du modal
    closeModalBtn.addEventListener('click', () => modal.style.display = 'none');
    modal.addEventListener('click', e => {
        if (e.target === modal) modal.style.display = 'none';
    });
});