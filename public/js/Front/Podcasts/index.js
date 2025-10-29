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

// Filter buttons
const filterBtns = document.querySelectorAll('.filter-btn');
filterBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        filterBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
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
document.querySelectorAll('.podcast-card, .series-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(card);
});

// Featured podcast animation
const featuredPodcast = document.querySelector('.featured-podcast');
if (featuredPodcast) {
    featuredPodcast.style.opacity = '0';
    featuredPodcast.style.transform = 'translateY(40px)';
    featuredPodcast.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
    observer.observe(featuredPodcast);
}

// Search functionality
const searchInput = document.querySelector('.search-box input');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const podcastCards = document.querySelectorAll('.podcast-card');
        
        podcastCards.forEach(card => {
            const title = card.querySelector('.podcast-title').textContent.toLowerCase();
            const description = card.querySelector('.podcast-description').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
}

// Play button interactions
document.querySelectorAll('.play-btn-small, .featured-play, .btn-play').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        // Animation de click
        this.style.transform = 'scale(0.9)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
        
        // Ici vous pouvez ajouter la logique pour lancer la lecture du podcast
        console.log('Playing podcast...');
    });
});

// Like button interaction
document.querySelectorAll('.podcast-stats .fa-heart').forEach(heart => {
    heart.parentElement.style.cursor = 'pointer';
    heart.parentElement.addEventListener('click', function(e) {
        e.stopPropagation();
        heart.classList.toggle('fas');
        heart.classList.toggle('far');
        if (heart.classList.contains('fas')) {
            heart.style.color = '#e74c3c';
        } else {
            heart.style.color = '';
        }
    });
});

// Subscribe button interaction
document.querySelectorAll('.btn-subscribe').forEach(btn => {
    btn.addEventListener('click', function() {
        const isSubscribed = this.textContent.includes('Abonné');
        if (isSubscribed) {
            this.innerHTML = '<i class="fas fa-rss"></i> S\'abonner';
            this.style.background = 'transparent';
            this.style.color = 'var(--navy-blue)';
        } else {
            this.innerHTML = '<i class="fas fa-check"></i> Abonné';
            this.style.background = 'var(--green)';
            this.style.color = 'white';
            this.style.borderColor = 'var(--green)';
        }
    });
});

// Podcast card click to expand
document.querySelectorAll('.podcast-card').forEach(card => {
    card.addEventListener('click', function(e) {
        if (!e.target.closest('.play-btn-small') && !e.target.closest('.fa-heart')) {
            // Animation pour indiquer qu'on peut cliquer
            this.style.transform = 'translateY(-5px)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
            
            // Ici vous pouvez ouvrir une modal ou rediriger vers la page du podcast
            console.log('Opening podcast details...');
        }
    });
});

// Series card button interaction
document.querySelectorAll('.btn-view-series').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        // Animation
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
        
        console.log('Viewing series episodes...');
    });
});

// Add hover effect to filter section when scrolling
let lastScrollTop = 0;
const filterSection = document.querySelector('.filter-section');

window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    if (scrollTop > lastScrollTop && scrollTop > 200) {
        // Scrolling down
        filterSection.style.transform = 'translateY(-5px)';
        filterSection.style.boxShadow = '0 8px 30px rgba(0,51,102,0.12)';
    } else {
        // Scrolling up
        filterSection.style.transform = 'translateY(0)';
        filterSection.style.boxShadow = '0 4px 20px rgba(0,51,102,0.05)';
    }
    
    lastScrollTop = scrollTop;
});

// Prevent body scroll when mobile menu is open
let lastScrollY = 0;
mobileMenuBtn.addEventListener('click', function() {
    if (!mobileNav.classList.contains('active')) {
        lastScrollY = window.scrollY;
    } else {
        window.scrollTo(0, lastScrollY);
    }
});

// Add loading skeleton effect (optional enhancement)
function addSkeletonEffect() {
    const cards = document.querySelectorAll('.podcast-card, .series-card');
    cards.forEach(card => {
        card.style.animation = 'none';
        setTimeout(() => {
            card.style.animation = '';
        }, 10);
    });
}

// Lazy loading for images
const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const img = entry.target;
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.5s ease';
            
            // Simulate loading
            setTimeout(() => {
                img.style.opacity = '1';
            }, 100);
            
            observer.unobserve(img);
        }
    });
});

document.querySelectorAll('.podcast-image, .series-cover img, .featured-image img').forEach(img => {
    imageObserver.observe(img);
});

// Add pulse animation to live indicator
const liveIndicator = document.querySelector('.live-indicator');
if (liveIndicator) {
    liveIndicator.addEventListener('click', function() {
        // Redirect to live stream
        console.log('Opening live stream...');
    });
}

// Keyboard navigation for accessibility
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
        toggleMobileMenu();
    }
});

// Add ripple effect to buttons
function createRipple(event) {
    const button = event.currentTarget;
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');
    
    const rippleElement = button.querySelector('.ripple');
    if (rippleElement) {
        rippleElement.remove();
    }
    
    button.appendChild(ripple);
}

// Apply ripple to all buttons
document.querySelectorAll('button, .btn-play, .btn-subscribe, .btn-view-series').forEach(button => {
    button.style.position = 'relative';
    button.style.overflow = 'hidden';
    button.addEventListener('click', createRipple);
});

// Add CSS for ripple effect
const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);