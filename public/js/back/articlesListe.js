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
    const modal = document.getElementById('articleModal');
    const closeModalBtn = document.getElementById('closeModal');

    const modalTitle = document.getElementById('modalArticleTitle');
    const modalImage = document.getElementById('modalArticleImage');
    const modalAuthor = document.getElementById('modalArticleAuthor');
    const modalDate = document.getElementById('modalArticleDate');
    const modalViews = document.getElementById('modalArticleViews');
    const modalReadingTime = document.getElementById('modalArticleReadingTime');
    const modalCategory = document.getElementById('modalArticleCategory');
    const modalFullTitle = document.getElementById('modalFullTitle');
    const modalContent = document.getElementById('modalArticleContent');

    document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = btn.closest('.article-card');

            modalTitle.textContent = card.dataset.title;
            modalImage.src = card.dataset.image;
            modalAuthor.textContent = card.dataset.author;
            modalDate.textContent = card.dataset.date;
            modalViews.textContent = card.dataset.views;
            modalReadingTime.textContent = card.dataset.readingTime;
            modalCategory.textContent = card.dataset.category;
            modalFullTitle.textContent = card.dataset.title;
            modalContent.innerHTML = card.dataset.content;

            modal.classList.add("show");
        });
    });

    closeModalBtn.addEventListener('click', function() {
        modal.classList.remove("show");
    });

    window.addEventListener('click', function(e) {
        if (e.target == modal) {
            modal.classList.remove("show");
        }
    });
});

// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
    }
});