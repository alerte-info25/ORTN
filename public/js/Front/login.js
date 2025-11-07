// Loader
window.addEventListener('load', function() {
    const progressBar = document.getElementById('loadingProgress');
    const loader = document.getElementById('loader');

    // si les éléments existent pas, on skip le code
    if (!progressBar || !loader) return;

    let progress = 0;
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


// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Password toggle functionality
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

togglePassword.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    // Toggle eye icon
    if (type === 'password') {
        this.innerHTML = '<i class="fas fa-eye"></i>';
    } else {
        this.innerHTML = '<i class="fas fa-eye-slash"></i>';
    }
});