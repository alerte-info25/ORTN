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

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('audioModal');
    const closeModal = document.getElementById('closeModal');
    const audioPlayer = document.getElementById('audioPlayer');
    const modalAudioTitle = document.getElementById('modalAudioTitle');
    const playerTitle = document.getElementById('playerTitle');
    const playerHost = document.getElementById('playerHost');
    const modalInfoTitle = document.getElementById('modalInfoTitle');
    const modalInfoMeta = document.getElementById('modalInfoMeta');
    const modalInfoDescription = document.getElementById('modalInfoDescription');
    const audioCover = modal.querySelector('.audio-player-cover');

    document.querySelectorAll('.btn-play').forEach(button => {
        button.addEventListener('click', function () {
            const title = this.dataset.title;
            const url = this.dataset.url;
            const host = this.dataset.host;
            const description = this.dataset.description;
            const date = this.dataset.date;
            const category = this.dataset.category;
            const image = this.dataset.image;

            modalAudioTitle.textContent = title;
            playerTitle.textContent = title;
            playerHost.textContent = host;
            modalInfoTitle.textContent = title;
            modalInfoDescription.textContent = description;

            modalInfoMeta.innerHTML = `
                <span><i class="fas fa-user"></i> ${host}</span>
                <span><i class="fas fa-calendar"></i> ${date}</span>
            `;

            audioPlayer.src = url;

            if (image && image !== '') {
                audioCover.innerHTML = `<img src="${image}" alt="Cover" style="width:150%; height:100%; object-fit:contain; border-radius: 10px">`;
            } else {
                audioCover.innerHTML = `<i class="fas fa-microphone-alt"></i>`;
            }

            modal.classList.add("show");
        });
    });

    closeModal.addEventListener('click', function () {
        modal.classList.remove("show");
        audioPlayer.pause();
    });

});




// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
    }
});