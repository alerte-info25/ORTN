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

// Rich Text Editor Functionality
const editor = document.getElementById('communiqueContent');
const toolbarButtons = document.querySelectorAll('.toolbar-btn');

toolbarButtons.forEach(button => {
    button.addEventListener('click', function() {
        const command = this.dataset.command;
        const value = this.dataset.value;
        
        if (command === 'createLink') {
            const url = prompt('Entrez l\'URL:');
            if (url) document.execCommand(command, false, url);
        } else if (command === 'insertImage') {
            const url = prompt('Entrez l\'URL de l\'image:');
            if (url) document.execCommand(command, false, url);
        } else if (value) {
            document.execCommand(command, false, value);
        } else {
            document.execCommand(command, false, null);
        }
        
        editor.focus();
    });
});

// Auto-generate excerpt from content
editor.addEventListener('input', function() {
    const text = this.textContent.trim();
    const excerpt = text.substring(0, 150) + (text.length > 150 ? '...' : '');
    document.getElementById('communiqueExcerpt').textContent = excerpt || 'L\'extrait du communiqué apparaîtra ici automatiquement.';
});

// Image Upload Functionality
const attachmentUpload = document.getElementById('attachmentUpload');
const attachmentFiles = document.getElementById('attachmentFiles');
const attachmentPreview = document.getElementById('attachmentPreview');
const btnBrowse = document.querySelector('.btn-browse');
let uploadedFiles = [];

// Click on upload area or button
btnBrowse.addEventListener('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    attachmentFiles.click();
});

attachmentUpload.addEventListener('click', (e) => {
    if (e.target !== btnBrowse) {
        attachmentFiles.click();
    }
});

// Drag and drop
attachmentUpload.addEventListener('dragover', (e) => {
    e.preventDefault();
    attachmentUpload.classList.add('active');
});

attachmentUpload.addEventListener('dragleave', () => {
    attachmentUpload.classList.remove('active');
});

attachmentUpload.addEventListener('drop', (e) => {
    e.preventDefault();
    attachmentUpload.classList.remove('active');
    const files = Array.from(e.dataTransfer.files);
    handleFiles(files);
});

// File input change
attachmentFiles.addEventListener('change', (e) => {
    const files = Array.from(e.target.files);
    handleFiles(files);
});

function handleFiles(files) {
    const validFiles = files.filter(file => {
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        return validTypes.includes(file.type);
    });

    if (validFiles.length === 0) {
        alert('Veuillez sélectionner des fichiers image valides (JPG, PNG, GIF)');
        return;
    }

    validFiles.forEach(file => {
        if (!uploadedFiles.some(f => f.name === file.name && f.size === file.size)) {
            uploadedFiles.push(file);
            displayFilePreview(file);
        }
    });
}

function displayFilePreview(file) {
    attachmentPreview.classList.add('active');
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const previewItem = document.createElement('div');
        previewItem.className = 'preview-item';
        previewItem.innerHTML = `
            <div class="preview-icon">
                <i class="fas fa-image"></i>
            </div>
            <div class="preview-info">
                <div class="preview-name">${file.name}</div>
                <div class="preview-size">${formatFileSize(file.size)}</div>
            </div>
            <img src="${e.target.result}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; margin-right: 10px;">
            <button type="button" class="preview-remove" onclick="removeFile('${file.name}', ${file.size})">
                <i class="fas fa-times"></i>
            </button>
        `;
        attachmentPreview.appendChild(previewItem);
    };
    reader.readAsDataURL(file);
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

window.removeFile = function(fileName, fileSize) {
    uploadedFiles = uploadedFiles.filter(f => !(f.name === fileName && f.size === fileSize));
    
    // Remove preview item
    const previewItems = attachmentPreview.querySelectorAll('.preview-item');
    previewItems.forEach(item => {
        const nameElement = item.querySelector('.preview-name');
        if (nameElement && nameElement.textContent === fileName) {
            item.remove();
        }
    });

    // Hide preview container if empty
    if (uploadedFiles.length === 0) {
        attachmentPreview.classList.remove('active');
    }
};

// Cancel button
document.querySelector('.btn-cancel').addEventListener('click', function() {
    if (confirm('Êtes-vous sûr de vouloir annuler? Toutes les modifications seront perdues.')) {
        window.location.href = '#communiques';
    }
});

document.getElementById('communiqueForm').addEventListener('submit', function() {
    document.getElementById('communiqueContentHidden').value = document.getElementById('communiqueContent').innerHTML;
});

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