// Menu Toggle
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

menuToggle.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    sidebarOverlay.classList.toggle('active');
});

sidebarOverlay.addEventListener('click', () => {
    sidebar.classList.remove('active');
    sidebarOverlay.classList.remove('active');
});

// View Toggle
const tableViewBtn = document.getElementById('tableView');
const gridViewBtn = document.getElementById('gridView');
const tableViewContent = document.getElementById('tableViewContent');
const gridViewContent = document.getElementById('gridViewContent');

tableViewBtn.addEventListener('click', () => {
    tableViewBtn.classList.add('active');
    gridViewBtn.classList.remove('active');
    tableViewContent.style.display = 'block';
    gridViewContent.style.display = 'none';
});

gridViewBtn.addEventListener('click', () => {
    gridViewBtn.classList.add('active');
    tableViewBtn.classList.remove('active');
    tableViewContent.style.display = 'none';
    gridViewContent.style.display = 'block';
});

// loader
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