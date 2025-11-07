// === MENU TOGGLE ===
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.getElementById('sidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

if (menuToggle) {
    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        sidebarOverlay.classList.toggle('active');
    });

    sidebarOverlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
    });
}

// === FORMAT (présentiel / en ligne / hybride) ===
const formatRadios = document.querySelectorAll('input[name="format"]');
const physicalLocation = document.getElementById('physicalLocation');
const onlineLocation = document.getElementById('onlineLocation');

formatRadios.forEach(radio => {
    radio.addEventListener('change', function () {
        if (this.value === 'online') {
            physicalLocation.style.display = 'none';
            onlineLocation.style.display = 'block';
        } else if (this.value === 'hybride') {
            physicalLocation.style.display = 'block';
            onlineLocation.style.display = 'block';
        } else {
            // Présentiel (ou défaut)
            physicalLocation.style.display = 'block';
            onlineLocation.style.display = 'none';
        }
    });
});

// === TYPE D'ACCÈS (gratuit / payant) ===
const accessRadios = document.querySelectorAll('input[name="access_type"]');
const pricingSection = document.getElementById('pricingSection');

accessRadios.forEach(radio => {
    radio.addEventListener('change', function () {
        if (this.value === 'paid') {
            pricingSection.style.display = 'block';
        } else {
            pricingSection.style.display = 'none';
        }
    });
});

// === INSCRIPTION REQUISE ===
const requiresRegistration = document.getElementById('requiresRegistration');
const registrationSection = document.getElementById('registrationSection');

if (requiresRegistration) {
    requiresRegistration.addEventListener('change', function () {
        registrationSection.style.display = this.checked ? 'block' : 'none';
    });
}

// === UPLOAD IMAGE ===
const eventImageUpload = document.getElementById('eventImageUpload');
const eventImage = document.getElementById('eventImage');

// on crée l’aperçu dynamiquement si besoin
let previewImg = document.createElement('img');
previewImg.id = 'imagePreview';
previewImg.style.display = 'none';
previewImg.style.maxWidth = '100%';
previewImg.style.marginTop = '10px';
eventImageUpload.appendChild(previewImg);

eventImageUpload.addEventListener('click', () => eventImage.click());

eventImage.addEventListener('change', e => {
    const file = e.target.files[0];
    if (!file) return;
    if (!file.type.match('image.*')) {
        alert('Veuillez sélectionner une image valide (JPG, PNG)');
        return;
    }

    const reader = new FileReader();
    reader.onload = ev => {
        previewImg.src = ev.target.result;
        previewImg.style.display = 'block';
    };
    reader.readAsDataURL(file);
});

// === VALIDATION DES DATES ===
const startDateInput = document.getElementById('eventStartDate');
const endDateInput = document.getElementById('eventEndDate');

if (startDateInput && endDateInput) {
    endDateInput.addEventListener('change', function () {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(this.value);

        if (endDate < startDate) {
            alert('⚠️ La date de fin doit être postérieure à la date de début');
            this.value = '';
        }
    });
}

// === BOUTON ANNULER ===
const cancelBtn = document.querySelector('.btn-cancel');
if (cancelBtn) {
    cancelBtn.addEventListener('click', function () {
        if (confirm('Voulez-vous vraiment annuler ? Les modifications non enregistrées seront perdues.')) {
            window.location.href = '{{ route("dashboard.events.index") }}';
        }
    });
}

// === AUTO-SAVE SIMULÉ ===
let autoSaveTimer;
const formInputs = document.querySelectorAll('.form-input, .form-textarea, .form-select');

formInputs.forEach(input => {
    input.addEventListener('input', () => {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            console.log('📝 Auto-sauvegarde simulée...');
        }, 1500);
    });
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