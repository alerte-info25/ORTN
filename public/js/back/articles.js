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

// Image Upload
const imageUploadArea = document.getElementById('imageUploadArea');
const imageInput = document.getElementById('imageInput');
const imagePreviewContainer = document.getElementById('imagePreviewContainer');
const imagePreview = document.getElementById('imagePreview');
const removeImageBtn = document.getElementById('removeImageBtn');

imageUploadArea.addEventListener('click', () => imageInput.click());

imageUploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    imageUploadArea.classList.add('active');
});

imageUploadArea.addEventListener('dragleave', () => {
    imageUploadArea.classList.remove('active');
});

imageUploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    imageUploadArea.classList.remove('active');
    const file = e.dataTransfer.files[0];
    handleImageUpload(file);
});

imageInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    handleImageUpload(file);
});

function handleImageUpload(file) {
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.src = e.target.result;
            imagePreviewContainer.classList.add('show');
            imageUploadArea.style.display = 'none';
            updatePreviewImage(e.target.result);
        };
        reader.readAsDataURL(file);
    }
}

removeImageBtn.addEventListener('click', (e) => {
    e.preventDefault()
    imagePreview.src = '';
    imagePreviewContainer.classList.remove('show');
    imageUploadArea.style.display = 'block';
    imageInput.value = '';
    document.getElementById('previewImageContainer').innerHTML = '<i class="fas fa-image" style="font-size: 3rem;"></i>';
});

// Editor Toolbar
const editorButtons = document.querySelectorAll('.editor-btn');
const editorContent = document.getElementById('editorContent');

editorButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        const command = btn.getAttribute('data-command');
        
        if (command === 'createLink') {
            const url = prompt('Entrez l\'URL du lien:');
            if (url) {
                document.execCommand(command, false, url);
            }
        } else {
            document.execCommand(command, false, null);
        }
        editorContent.focus();
    });
});

closeSuccessBtn.addEventListener('click', () => {
    successModal.classList.remove('show');
});

// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        sidebar.classList.remove('mobile-open');
        sidebarOverlay.classList.remove('active');
    }
});

document.querySelector('form').addEventListener('submit', function (e) {
    const editorContent = document.getElementById('editorContent').innerHTML;
    document.getElementById('hiddenContent').value = editorContent;
});