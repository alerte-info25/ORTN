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
const videoUpload = document.getElementById('videoUpload');
const videoFile = document.getElementById('videoFile');
const videoPlayer = document.getElementById('videoPlayer');
const videoPreview = document.getElementById('videoPreview');

const thumbnailUpload = document.getElementById('thumbnailUpload');
const thumbnailFile = document.getElementById('thumbnailFile');
const thumbnailPreview = document.getElementById('thumbnailPreview');

// Video file upload
videoUpload.addEventListener('click', function() {
    videoFile.click();
});

videoFile.addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const file = this.files[0];
        const objectURL = URL.createObjectURL(file);
        videoPreview.src = objectURL;
        videoPlayer.style.display = 'block';
        videoUpload.classList.add('active');
        
        // Calculate duration when video loads
        videoPreview.addEventListener('loadedmetadata', function() {
            const duration = Math.floor(videoPreview.duration / 60);
            document.getElementById('podcastDuration').value = duration;
        });
    }
});

// Thumbnail image upload
thumbnailUpload.addEventListener('click', function() {
    thumbnailFile.click();
});

thumbnailFile.addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const file = this.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            thumbnailPreview.src = e.target.result;
            thumbnailPreview.style.display = 'block';
            thumbnailUpload.classList.add('active');
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