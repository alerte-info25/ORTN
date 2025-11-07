// DOM Elements
const steps = document.querySelectorAll('.form-step');
const stepNumbers = document.querySelectorAll('.step-number');
const stepLabels = document.querySelectorAll('.step-label');
const stepConnectors = document.querySelectorAll('.step-connector');
const passwordToggle = document.getElementById('passwordToggle');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirmPassword');
const strengthFill = document.getElementById('strengthFill');
const strengthText = document.getElementById('strengthText');
const termsCheckbox = document.getElementById('termsCheckbox');
const termsAgreement = document.getElementById('termsAgreement');
const loaderOverlay = document.getElementById('loaderOverlay');
const errorAlert = document.getElementById('errorAlert');
const registerForm = document.getElementById('registerForm');

let currentStep = 1;

// Navigation between steps
document.getElementById('nextToStep2').addEventListener('click', () => {
    if (validateStep1()) {
        navigateToStep(2);
    }
});

document.getElementById('nextToStep3').addEventListener('click', () => {
    if (validateStep2()) {
        navigateToStep(3);
    }
});

document.getElementById('prevToStep1').addEventListener('click', () => navigateToStep(1));
document.getElementById('prevToStep2').addEventListener('click', () => navigateToStep(2));

function navigateToStep(step) {
    // Hide current step
    document.getElementById(`step${currentStep}`).classList.remove('active');
    
    // Show new step
    document.getElementById(`step${step}`).classList.add('active');
    
    // Update progress bar
    updateProgressBar(step);
    
    currentStep = step;
}

function updateProgressBar(step) {
    // Reset all steps
    stepNumbers.forEach((num, index) => {
        num.classList.remove('active', 'completed');
        stepLabels[index].classList.remove('active');
        if (index < stepConnectors.length) {
            stepConnectors[index].classList.remove('active');
        }
    });

    // Activate current and previous steps
    for (let i = 0; i < step; i++) {
        stepNumbers[i].classList.add('completed');
        stepLabels[i].classList.add('active');
        if (i < stepConnectors.length && i < step - 1) {
            stepConnectors[i].classList.add('active');
        }
    }

    // Activate current step
    stepNumbers[step - 1].classList.add('active');
    stepLabels[step - 1].classList.add('active');
}

// Password toggle functionality
passwordToggle.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
});

// Password strength checker
passwordInput.addEventListener('input', function() {
    const password = this.value;
    const strength = calculatePasswordStrength(password);
    
    strengthFill.className = 'strength-fill';
    strengthFill.classList.add(`strength-${strength.level}`);
    strengthFill.style.width = `${strength.width}%`;
    strengthText.textContent = strength.text;
    strengthText.className = 'strength-text';
    strengthText.classList.add(`strength-${strength.level}`);
});

function calculatePasswordStrength(password) {
    let score = 0;
    
    if (password.length >= 8) score += 1;
    if (password.match(/[a-z]/)) score += 1;
    if (password.match(/[A-Z]/)) score += 1;
    if (password.match(/[0-9]/)) score += 1;
    if (password.match(/[^a-zA-Z0-9]/)) score += 1;
    
    if (score === 0) return { level: 'weak', width: 0, text: 'Très faible' };
    if (score === 1) return { level: 'weak', width: 25, text: 'Faible' };
    if (score === 2) return { level: 'weak', width: 25, text: 'Faible' };
    if (score === 3) return { level: 'medium', width: 50, text: 'Moyen' };
    if (score === 4) return { level: 'good', width: 75, text: 'Bon' };
    if (score === 5) return { level: 'strong', width: 100, text: 'Très fort' };
    
    return { level: 'weak', width: 0, text: 'Très faible' };
}

// Terms agreement checkbox
termsCheckbox.addEventListener('click', function() {
    termsAgreement.checked = !termsAgreement.checked;
    if (termsAgreement.checked) {
        this.classList.add('checked');
        this.querySelector('i').style.display = 'block';
    } else {
        this.classList.remove('checked');
        this.querySelector('i').style.display = 'none';
    }
});

// Form validation functions
function validateStep1() {
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    
    if (!firstName || !lastName || !email || !phone) {
        showError('Veuillez remplir tous les champs obligatoires.');
        return false;
    }
    
    if (!isValidEmail(email)) {
        showError('Veuillez entrer une adresse email valide.');
        return false;
    }
    
    if (!isValidPhone(phone)) {
        showError('Veuillez entrer un numéro de téléphone valide.');
        return false;
    }
    
    hideError();
    return true;
}

function validateStep2() {
    const role = document.getElementById('role').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const localite = document.getElementById("localite").value
    
    if (!role || !password || !confirmPassword || !localite) {
        showError('Veuillez remplir tous les champs obligatoires.');
        return false;
    }
    
    if (password.length < 8) {
        showError('Le mot de passe doit contenir au moins 8 caractères.');
        return false;
    }
    
    if (password !== confirmPassword) {
        showError('Les mots de passe ne correspondent pas.');
        return false;
    }
    
    hideError();
    return true;
}

function validateStep3() {
    if (!termsAgreement.checked) {
        showError('Veuillez accepter les conditions d\'utilisation.');
        return false;
    }
    
    hideError();
    return true;
}

// Utility functions
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^[\+]?[227]?[0-9]{8,}$/;
    return phoneRegex.test(phone.replace(/\s/g, ''));
}

function showError(message) {
    document.getElementById('errorMessage').textContent = message;
    errorAlert.style.display = 'flex';
    errorAlert.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function hideError() {
    errorAlert.style.display = 'none';
}

function showLoader() {
    loaderOverlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function hideLoader() {
    loaderOverlay.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Real-time validation for step 1 fields
document.getElementById('email').addEventListener('blur', function() {
    if (this.value && !isValidEmail(this.value)) {
        this.style.borderColor = '#e74c3c';
    } else {
        this.style.borderColor = '';
    }
});

document.getElementById('phone').addEventListener('blur', function() {
    if (this.value && !isValidPhone(this.value)) {
        this.style.borderColor = '#e74c3c';
    } else {
        this.style.borderColor = '';
    }
});

// Real-time password confirmation check
confirmPasswordInput.addEventListener('input', function() {
    const password = passwordInput.value;
    const confirmPassword = this.value;
    
    if (confirmPassword && password !== confirmPassword) {
        this.style.borderColor = '#e74c3c';
    } else {
        this.style.borderColor = '';
    }
});

// Add some interactive effects
document.querySelectorAll('.form-input, .form-select').forEach(input => {
    input.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    input.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    // Enter to go to next step (except on last step)
    if (e.key === 'Enter' && currentStep < 3) {
        e.preventDefault();
        document.getElementById(`nextToStep${currentStep + 1}`).click();
    }
});