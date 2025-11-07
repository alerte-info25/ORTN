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

document.querySelectorAll('.mobile-nav-item').forEach(item => {
    item.addEventListener('click', toggleMobileMenu);
});

window.addEventListener('scroll', function() {
    const header = document.querySelector('.main-header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

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

document.querySelectorAll('.highlight-item, .program-item, .event-card').forEach(item => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(30px)';
    item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(item);
});

document.querySelectorAll('.gallery-item').forEach(item => {
    item.addEventListener('click', function() {
        const imgSrc = this.querySelector('img').src;
        const modal = document.createElement('div');
        modal.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            cursor: pointer;
        `;
        
        const img = document.createElement('img');
        img.src = imgSrc;
        img.style.cssText = `
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0 10px 50px rgba(0,0,0,0.5);
        `;
        
        modal.appendChild(img);
        document.body.appendChild(modal);
        
        modal.addEventListener('click', function() {
            modal.remove();
        });
    });
});

document.querySelectorAll('.share-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const platform = this.classList.contains('facebook') ? 'Facebook' : 
                        this.classList.contains('twitter') ? 'Twitter' : 
                        this.classList.contains('whatsapp') ? 'WhatsApp' : 'LinkedIn';
        alert(`Partage sur ${platform} - Fonctionnalité à implémenter avec les vraies URLs`);
    });
});

const addToCalendarBtn = document.querySelector('.btn-secondary-cta');
if (addToCalendarBtn) {
    addToCalendarBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        const eventDetails = {
            title: 'Festival des Arts et Culture de Ngazidja 2024',
            description: 'Grande célébration culturelle organisée par l\'ORTN',
            location: 'Place de l\'Indépendance, Moroni',
            start: '2024-12-15T18:00:00',
            end: '2024-12-15T23:00:00'
        };
        
        const startDate = new Date(eventDetails.start).toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';
        const endDate = new Date(eventDetails.end).toISOString().replace(/[-:]/g, '').split('.')[0] + 'Z';
        
        const googleCalendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(eventDetails.title)}&dates=${startDate}/${endDate}&details=${encodeURIComponent(eventDetails.description)}&location=${encodeURIComponent(eventDetails.location)}`;
        
        window.open(googleCalendarUrl, '_blank');
    });
}

let lastScrollY = 0;
mobileMenuBtn.addEventListener('click', function() {
    if (!mobileNav.classList.contains('active')) {
        lastScrollY = window.scrollY;
    } else {
        window.scrollTo(0, lastScrollY);
    }
});

document.querySelectorAll('.info-item').forEach((item, index) => {
    item.style.opacity = '0';
    item.style.transform = 'translateX(-20px)';
    item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    item.style.transitionDelay = `${index * 0.1}s`;
    
    setTimeout(() => {
        item.style.opacity = '1';
        item.style.transform = 'translateX(0)';
    }, 100);
});

const scrollToTopBtn = document.createElement('button');
scrollToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
scrollToTopBtn.style.cssText = `
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 55px;
    height: 55px;
    background: linear-gradient(135deg, var(--gold), var(--dark-gold));
    color: var(--navy-blue);
    border: none;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 999;
    box-shadow: 0 4px 15px rgba(255,215,0,0.3);
`;

document.body.appendChild(scrollToTopBtn);

window.addEventListener('scroll', function() {
    if (window.scrollY > 500) {
        scrollToTopBtn.style.opacity = '1';
        scrollToTopBtn.style.visibility = 'visible';
    } else {
        scrollToTopBtn.style.opacity = '0';
        scrollToTopBtn.style.visibility = 'hidden';
    }
});

scrollToTopBtn.addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

scrollToTopBtn.addEventListener('mouseenter', function() {
    this.style.transform = 'translateY(-5px) scale(1.1)';
    this.style.boxShadow = '0 8px 25px rgba(255,215,0,0.4)';
});

scrollToTopBtn.addEventListener('mouseleave', function() {
    this.style.transform = 'translateY(0) scale(1)';
    this.style.boxShadow = '0 4px 15px rgba(255,215,0,0.3)';
});

const handleIntersection = (entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
        }
    });
};

const sectionObserver = new IntersectionObserver(handleIntersection, {
    threshold: 0.1
});

document.querySelectorAll('.content-section').forEach(section => {
    sectionObserver.observe(section);
});

document.querySelectorAll('.event-card-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});