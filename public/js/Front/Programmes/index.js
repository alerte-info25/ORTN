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

document.querySelectorAll('.mobile-nav-item').forEach(item => {
    item.addEventListener('click', toggleMobileMenu);
});

// Header scroll effect
const mainHeader = document.querySelector('.main-header');
const scheduleTabsSection = document.getElementById('scheduleTabsSection');

window.addEventListener('scroll', function() {
    if (window.scrollY > 50) {
        mainHeader.classList.add('scrolled');
    } else {
        mainHeader.classList.remove('scrolled');
    }

    if (window.scrollY > 400) {
        scheduleTabsSection.classList.add('scrolled');
    } else {
        scheduleTabsSection.classList.remove('scrolled');
    }
});

// Schedule Tabs
const scheduleTabs = document.querySelectorAll('.schedule-tab');
const programsGrid = document.getElementById('programsGrid');
const weeklySchedule = document.getElementById('weeklySchedule');
const programCards = document.querySelectorAll('.program-card');

scheduleTabs.forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        scheduleTabs.forEach(t => t.classList.remove('active'));
        // Add active class to clicked tab
        this.classList.add('active');
        
        const type = this.getAttribute('data-type');
        
        if (type === 'timeline') {
            programsGrid.style.display = 'none';
            weeklySchedule.style.display = 'block';
        } else {
            programsGrid.style.display = 'block';
            weeklySchedule.style.display = 'none';
            
            // Filter program cards
            programCards.forEach(card => {
                if (type === 'all') {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    const cardType = card.getAttribute('data-type');
                    if (cardType === type) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(30px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                }
            });
        }
    });
});

// Day Selector
const dayBtns = document.querySelectorAll('.day-btn');

dayBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        dayBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const day = this.getAttribute('data-day');
        console.log('Jour sélectionné:', day);
        // Ici vous pouvez charger les programmes du jour sélectionné
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
programCards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(card);
});

// Timeline programs animation
const timelinePrograms = document.querySelectorAll('.timeline-program');

timelinePrograms.forEach((program, index) => {
    program.style.opacity = '0';
    program.style.transform = 'translateX(-30px)';
    program.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    program.style.transitionDelay = (index * 0.1) + 's';
    observer.observe(program);
});

// Program card click
programCards.forEach(card => {
    card.addEventListener('click', function() {
        const title = this.querySelector('.program-card-title').textContent;
        console.log('Programme sélectionné:', title);
        // Ici vous pouvez naviguer vers la page détails du programme
    });
});

// Timeline program click
timelinePrograms.forEach(program => {
    program.addEventListener('click', function() {
        const title = this.querySelector('.program-title').textContent;
        console.log('Programme timeline sélectionné:', title);
    });
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

// Add animation delay to cards
programCards.forEach((card, index) => {
    card.style.transitionDelay = (index * 0.1) + 's';
});

// Auto-scroll day selector to active day
const daySelector = document.querySelector('.day-selector');
const activeDay = document.querySelector('.day-btn.active');

if (daySelector && activeDay) {
    const scrollLeft = activeDay.offsetLeft - (daySelector.offsetWidth / 2) + (activeDay.offsetWidth / 2);
    daySelector.scrollTo({
        left: scrollLeft,
        behavior: 'smooth'
    });
}

// Simulate live time update for current program
function updateLiveIndicator() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const currentTime = hours * 60 + minutes;

    timelinePrograms.forEach(program => {
        const timeStart = program.querySelector('.program-time-start').textContent;
        const timeEnd = program.querySelector('.program-time-end').textContent;
        
        const [startHour, startMin] = timeStart.split(':').map(Number);
        const [endHour, endMin] = timeEnd.split(':').map(Number);
        
        const startTime = startHour * 60 + startMin;
        const endTime = endHour * 60 + endMin;
        
        if (currentTime >= startTime && currentTime < endTime) {
            program.style.borderLeftColor = '#e74c3c';
            program.style.borderLeftWidth = '6px';
            
            // Add live badge if not already present
            if (!program.querySelector('.live-badge')) {
                const liveBadge = document.createElement('span');
                liveBadge.className = 'live-badge';
                liveBadge.innerHTML = '<i class="fas fa-circle"></i> EN DIRECT';
                liveBadge.style.cssText = 'background: linear-gradient(135deg, #e74c3c, #c0392b); color: white; padding: 0.4rem 1rem; border-radius: 15px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; gap: 0.4rem; animation: pulse-live 2s ease-in-out infinite;';
                
                const categorySpan = program.querySelector('.program-category');
                if (categorySpan) {
                    categorySpan.parentNode.insertBefore(liveBadge, categorySpan);
                    categorySpan.style.marginLeft = '0.5rem';
                }
            }
        }
    });
}

// Update live indicator every minute
updateLiveIndicator();
setInterval(updateLiveIndicator, 60000);

// Hover effect for program icons
const programIcons = document.querySelectorAll('.program-card-icon');

programIcons.forEach(icon => {
    icon.parentElement.addEventListener('mouseenter', function() {
        icon.style.transform = 'scale(1.2) rotate(10deg)';
        icon.style.transition = 'transform 0.4s ease';
    });
    
    icon.parentElement.addEventListener('mouseleave', function() {
        icon.style.transform = 'scale(1) rotate(0deg)';
    });
});

// Add ripple effect on button click
document.querySelectorAll('.schedule-tab, .day-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            background: rgba(255,255,255,0.4);
            border-radius: 50%;
            left: ${x}px;
            top: ${y}px;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    });
});

// Add ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Scroll to top functionality
let scrollTopBtn = document.createElement('button');
scrollTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
scrollTopBtn.style.cssText = `
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--green), var(--dark-green));
    color: white;
    border: none;
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 6px 25px rgba(45,134,89,0.3);
    z-index: 999;
    font-size: 1.2rem;
`;

document.body.appendChild(scrollTopBtn);

window.addEventListener('scroll', function() {
    if (window.scrollY > 500) {
        scrollTopBtn.style.opacity = '1';
        scrollTopBtn.style.visibility = 'visible';
    } else {
        scrollTopBtn.style.opacity = '0';
        scrollTopBtn.style.visibility = 'hidden';
    }
});

scrollTopBtn.addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

scrollTopBtn.addEventListener('mouseenter', function() {
    this.style.transform = 'translateY(-5px) scale(1.1)';
    this.style.boxShadow = '0 10px 35px rgba(45,134,89,0.4)';
});

scrollTopBtn.addEventListener('mouseleave', function() {
    this.style.transform = 'translateY(0) scale(1)';
    this.style.boxShadow = '0 6px 25px rgba(45,134,89,0.3)';
});

// Add tooltip on hover for program times
document.querySelectorAll('.program-card-time').forEach(timeElement => {
    timeElement.title = 'Horaire de diffusion';
});

// Initialize page with default view
document.addEventListener('DOMContentLoaded', function() {
    programsGrid.style.display = 'block';
    weeklySchedule.style.display = 'none';
});