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

// Rich Text Editor
const editorButtons = document.querySelectorAll('.editor-btn');
editorButtons.forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const command = this.getAttribute('data-command');
        
        if (command === 'createLink') {
            const url = prompt('Entrez l\'URL:');
            if (url) {
                document.execCommand(command, false, url);
            }
        } else if (command) {
            document.execCommand(command, false, null);
        }
        
        document.getElementById('editorContent').focus();
    });
});

// Image upload
document.getElementById('imageUpload').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = `<img src="${event.target.result}" style="max-width: 100%; height: auto; margin: 1rem 0;">`;
            document.execCommand('insertHTML', false, img);
        };
        reader.readAsDataURL(file);
    }
});

window.addEventListener('beforeunload', function(e) {
    if (hasUnsavedChanges) {
        e.preventDefault();
        e.returnValue = '';
        return '';
    }
});

// Responsive handling
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
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

document.getElementById('coverImage').addEventListener('change', function(e) {
    const fileNameDiv = document.getElementById('fileName');
    if (this.files.length > 0) {
        fileNameDiv.textContent = 'Fichier sélectionné : ' + this.files[0].name;
        fileNameDiv.style.display = 'block';
        
        const file = this.files[0];
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Créer ou mettre à jour l'aperçu
                let preview = document.getElementById('imagePreview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'imagePreview';
                    preview.style.maxWidth = '100%';
                    preview.style.maxHeight = '200px';
                    preview.style.marginTop = '10px';
                    fileNameDiv.parentNode.appendChild(preview);
                }
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    } else {
        fileNameDiv.style.display = 'none';
        const preview = document.getElementById('imagePreview');
        if (preview) preview.remove();
    }
});

document.getElementById('newsletterForm').addEventListener('submit', function(e) {
    const editor = document.getElementById('editorContent');
    const hidden = document.getElementById('hiddenContent');
    hidden.value = editor.innerHTML.trim(); // copie le contenu
});