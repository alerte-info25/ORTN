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

// Reading Progress Bar
// Reading Progress Bar
window.addEventListener('scroll', () => {
    const article = document.querySelector('.article-body');
    const progressBar = document.getElementById('readingProgress');

    if (!article || !progressBar) return;

    const articleTop = article.offsetTop;
    const articleHeight = article.offsetHeight;
    const scrolled = window.scrollY - articleTop;

    const progress = Math.min(Math.max((scrolled / articleHeight) * 100, 0), 100);
    progressBar.style.width = progress + '%';
});


// Share buttons functionality
const shareButtons = document.querySelectorAll('.share-btn');
shareButtons.forEach(btn => {
    btn.addEventListener('click', function() {
        const platform = this.classList[1];
        const articleTitle = document.querySelector('.article-hero-title').textContent;
        const articleUrl = window.location.href;
        
        let shareUrl = '';
        switch(platform) {
            case 'facebook':
                shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(articleUrl)}`;
                break;
            case 'twitter':
                shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(articleTitle)}&url=${encodeURIComponent(articleUrl)}`;
                break;
            case 'whatsapp':
                shareUrl = `https://wa.me/?text=${encodeURIComponent(articleTitle + ' ' + articleUrl)}`;
                break;
            case 'linkedin':
                shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(articleUrl)}`;
                break;
        }
        
        if (shareUrl) {
            window.open(shareUrl, '_blank', 'width=600,height=400');
        }
    });
});

// Print functionality
const printBtn = document.querySelectorAll('.action-btn')[1];
if (printBtn) {
    printBtn.addEventListener('click', function() {
        window.print();
    });
}

// Smooth scroll for links
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

// Animate elements on scroll
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

// Observe related cards
document.querySelectorAll('.related-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(card);
});

// Observe comments
document.querySelectorAll('.comment').forEach((comment, index) => {
    comment.style.opacity = '0';
    comment.style.transform = 'translateY(20px)';
    comment.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
    observer.observe(comment);
});

// Add animation styles
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Parallax effect on hero image
window.addEventListener('scroll', function() {
    const hero = document.querySelector('.article-hero');
    if (hero && window.scrollY < 800) {
        const scrolled = window.pageYOffset;
        const heroImage = document.querySelector('.article-hero-image');
        if (heroImage) {
            heroImage.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    }
});

// Track reading time
let readingStartTime = Date.now();
window.addEventListener('beforeunload', function() {
    const readingTime = Math.floor((Date.now() - readingStartTime) / 1000);
    console.log(`Temps de lecture: ${readingTime} secondes`);
});

// Copy link functionality
const copyLinkBtn = document.createElement('button');
copyLinkBtn.className = 'action-btn';
copyLinkBtn.innerHTML = '<i class="fas fa-link"></i> Copier le lien';
copyLinkBtn.style.marginLeft = 'auto';

copyLinkBtn.addEventListener('click', function() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-check"></i> Copié !';
        this.style.color = 'var(--green)';
        this.style.borderColor = 'var(--green)';
        
        setTimeout(() => {
            this.innerHTML = originalText;
            this.style.color = '';
            this.style.borderColor = '';
        }, 2000);
    });
});

const articleActions = document.querySelector('.article-actions');
if (articleActions) {
    articleActions.appendChild(copyLinkBtn);
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Escape key closes mobile menu
    if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
        toggleMobileMenu();
    }
    
    // Ctrl/Cmd + P for print
    if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
        e.preventDefault();
        window.print();
    }
    
    // Ctrl/Cmd + S for bookmark
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        if (bookmarkBtn) {
            bookmarkBtn.click();
        }
    }
});

// Add article view count animation
const viewCount = document.querySelector('.meta-item .fa-eye').parentElement;
if (viewCount) {
    let count = 12500;
    setInterval(() => {
        count += Math.floor(Math.random() * 3);
        const countText = count >= 1000 ? (count / 1000).toFixed(1) + 'K' : count;
        viewCount.querySelector('span').textContent = countText + ' lectures';
    }, 30000); // Update every 30 seconds
}

// Lazy load related card images
const imageObserver = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const img = entry.target;
            img.style.opacity = '0';
            setTimeout(() => {
                img.style.transition = 'opacity 0.5s ease';
                img.style.opacity = '1';
            }, 100);
            imageObserver.unobserve(img);
        }
    });
});

document.querySelectorAll('.related-card-image').forEach(img => {
    imageObserver.observe(img);
});

// Add tooltip for action buttons
document.querySelectorAll('.action-btn, .share-btn').forEach(btn => {
    btn.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
    });
    
    btn.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
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

// Add reading time estimate
const articleBody = document.querySelector('.article-body');
if (articleBody) {
    const wordCount = articleBody.textContent.trim().split(/\s+/).length;
    const readingTime = Math.ceil(wordCount / 200); // Average reading speed: 200 words/min
    
    const readingTimeEl = document.querySelector('.fa-clock').parentElement.parentElement;
    if (readingTimeEl) {
        // Update already exists in HTML
    }
}

// Add active state to nav
document.querySelectorAll('.nav-item, .mobile-nav-item').forEach(item => {
    if (item.textContent.trim() === 'Actualités') {
        item.classList.add('active');
    }
});

console.log('Article page loaded successfully');