// Loader
window.addEventListener('load', function() {
    let progress = 0;
    const progressBar = document.getElementById('loaderProgress');
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
                }, 600);
            }, 200);
        }
    }, 25);
});

// Mobile Menu Toggle
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileNav = document.getElementById('mobileNav');
const mobileNavOverlay = document.getElementById('mobileNavOverlay');
const body = document.body;

function toggleMobileMenu() {
    mobileNav.classList.toggle('active');
    mobileNavOverlay.classList.toggle('active');
    body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
    
    const icon = mobileMenuBtn.querySelector('i');
    if (mobileNav.classList.contains('active')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
    } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
    }
}

mobileMenuBtn.addEventListener('click', toggleMobileMenu);
mobileNavOverlay.addEventListener('click', toggleMobileMenu);

// Close mobile menu when clicking on a link
document.querySelectorAll('.mobile-nav-item').forEach(item => {
    item.addEventListener('click', toggleMobileMenu);
});

// Header scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.main-header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe cards for animation
document.querySelectorAll('.communique-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(card);
});

// Animate official communique on scroll
const officialCommunique = document.querySelector('.official-communique');
if (officialCommunique) {
    officialCommunique.style.opacity = '0';
    officialCommunique.style.transform = 'translateY(40px)';
    officialCommunique.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
    
    const featuredObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.2 });
    
    featuredObserver.observe(officialCommunique);
}

// Animate page header elements
const pageHeaderElements = document.querySelectorAll('.page-breadcrumb, .page-title, .page-subtitle');
pageHeaderElements.forEach((element, index) => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(30px)';
    element.style.transition = `opacity 0.6s ease ${index * 0.15}s, transform 0.6s ease ${index * 0.15}s`;
    
    setTimeout(() => {
        element.style.opacity = '1';
        element.style.transform = 'translateY(0)';
    }, 100);
});

// Animate filters section
const filtersSection = document.querySelector('.filters-section');
if (filtersSection) {
    filtersSection.style.opacity = '0';
    filtersSection.style.transform = 'translateY(30px)';
    filtersSection.style.transition = 'opacity 0.6s ease 0.3s, transform 0.6s ease 0.3s';
    
    setTimeout(() => {
        filtersSection.style.opacity = '1';
        filtersSection.style.transform = 'translateY(0)';
    }, 100);
}

// Add hover effect to communique links
document.querySelectorAll('.communique-link').forEach(link => {
    link.addEventListener('mouseenter', function() {
        const arrow = this.querySelector('i');
        arrow.style.transform = 'translateX(5px)';
        arrow.style.transition = 'transform 0.3s ease';
    });
    
    link.addEventListener('mouseleave', function() {
        const arrow = this.querySelector('i');
        arrow.style.transform = 'translateX(0)';
    });
});

// Add click effect to communique cards
document.querySelectorAll('.communique-card').forEach(card => {
    card.style.cursor = 'pointer';
    
    card.addEventListener('click', function(e) {
        if (!e.target.closest('.communique-link')) {
            const communiqueLink = this.querySelector('.communique-link');
            if (communiqueLink) {
                communiqueLink.click();
            }
        }
    });
});

// Add active state to nav item
document.querySelectorAll('.nav-item, .mobile-nav-item').forEach(item => {
    if (item.textContent.trim() === 'Communiqués') {
        item.classList.add('active');
    }
});