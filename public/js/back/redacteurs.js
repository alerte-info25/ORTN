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

// Close modal on background click
document.getElementById('successModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.remove('show');
        document.getElementById('employeeForm').reset();
        document.getElementById('photoPreview').innerHTML = '<i class="fas fa-user photo-preview-placeholder"></i>';
    }
});

// Phone number formatting
document.getElementById('phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 0 && !value.startsWith('225')) {
        value = '225' + value;
    }
    e.target.value = value;
});

// Responsive handling
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
    }
});

window.addEventListener('beforeunload', function(e) {
    if (hasUnsavedChanges) {
        e.preventDefault();
        e.returnValue = '';
        return '';
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('successModal');
    const closeBtn = document.getElementById('closeModal');

    // Fermer quand on clique sur le bouton X
    closeBtn.addEventListener('click', () => {
        modal.classList.add('fade-out');
        setTimeout(() => modal.style.display = 'none', 300);
    });

    // Fermer quand on clique sur le fond noir
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('fade-out');
            setTimeout(() => modal.style.display = 'none', 300);
        }
    }); 
});