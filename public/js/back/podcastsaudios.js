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

// Sidebar toggle for mobile and desktop
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

// Close sidebar when clicking overlay
sidebarOverlay.addEventListener('click', function() {
    sidebar.classList.remove('mobile-open');
    sidebarOverlay.classList.remove('active');
});

// Close sidebar when clicking a link on mobile
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        navLinks.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
        
        // Close sidebar on mobile
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('mobile-open');
            sidebarOverlay.classList.remove('active');
        }
    });
});

// File upload functionality
const audioUpload = document.getElementById('audioUpload');
const audioFile = document.getElementById('audioFile');
const audioPlayer = document.getElementById('audioPlayer');
const audioPreview = document.getElementById('audioPreview');

const coverUpload = document.getElementById('coverUpload');
const coverFile = document.getElementById('coverFile');
const coverPreview = document.getElementById('coverPreview');

// Audio file upload
audioUpload.addEventListener('click', function() {
    audioFile.click();
});

audioFile.addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const file = this.files[0];
        const objectURL = URL.createObjectURL(file);
        audioPreview.src = objectURL;
        audioPlayer.style.display = 'block';
        audioUpload.classList.add('active');
        
        // Calculate duration when audio loads
        audioPreview.addEventListener('loadedmetadata', function() {
            const duration = Math.floor(audioPreview.duration / 60);
            document.getElementById('podcastDuration').value = duration;
        });
    }
});

// Cover image upload
coverUpload.addEventListener('click', function() {
    coverFile.click();
});

coverFile.addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const file = this.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            coverPreview.src = e.target.result;
            coverPreview.style.display = 'block';
            coverUpload.classList.add('active');
        }
        
        reader.readAsDataURL(file);
    }
});

// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
    }
});