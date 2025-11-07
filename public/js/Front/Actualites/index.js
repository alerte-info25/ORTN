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
document.querySelectorAll('.article-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(card);
});

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-input-group input');
    const categorySelect = document.querySelectorAll('.filter-select')[0];
    const sortSelect = document.querySelectorAll('.filter-select')[1];
    const filterBtn = document.querySelector('.filter-btn');

    if (!searchInput || !filterBtn) return;

    filterBtn.addEventListener('click', function() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categorySelect.value;
        const sortBy = sortSelect.value;
        
        console.log('Recherche:', searchTerm);
        console.log('Catégorie:', selectedCategory);
        console.log('Tri:', sortBy);
        
        this.innerHTML = '<i class="fas fa-check"></i> Filtré !';
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-filter"></i> Filtrer';
        }, 2000);
    });

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const articles = document.querySelectorAll('.article-card');
        
        articles.forEach(article => {
            const title = article.querySelector('.article-title').textContent.toLowerCase();
            const excerpt = article.querySelector('.article-excerpt').textContent.toLowerCase();
            
            article.style.display =
                title.includes(searchTerm) || excerpt.includes(searchTerm) ? 'block' : 'none';
        });
    });

    categorySelect.addEventListener('change', function() {
        const selectedCategory = this.value;
        const articles = document.querySelectorAll('.article-card');
        
        articles.forEach(article => {
            const articleCategory = article.querySelector('.article-category').textContent;
            article.style.display =
                selectedCategory === 'Toutes catégories' || articleCategory === selectedCategory
                    ? 'block'
                    : 'none';
        });
    });
});


// Animate featured article on scroll
const featuredArticle = document.querySelector('.featured-article');
if (featuredArticle) {
    featuredArticle.style.opacity = '0';
    featuredArticle.style.transform = 'translateY(40px)';
    featuredArticle.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
    
    const featuredObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.2 });
    
    featuredObserver.observe(featuredArticle);
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

// Add hover effect to read more links
document.querySelectorAll('.read-more').forEach(link => {
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

// Add click effect to article cards
document.querySelectorAll('.article-card').forEach(card => {
    card.style.cursor = 'pointer';
    
    card.addEventListener('click', function(e) {
        if (!e.target.closest('.read-more')) {
            const readMoreLink = this.querySelector('.read-more');
            if (readMoreLink) {
                readMoreLink.click();
            }
        }
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

// Add parallax effect to page header background elements
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const pageHeader = document.querySelector('.page-header');
    
    if (pageHeader && scrolled < 500) {
        pageHeader.style.transform = `translateY(${scrolled * 0.3}px)`;
    }
});

// Track article views (simulation)
const articleCards = document.querySelectorAll('.article-card');
const viewObserver = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const viewCount = entry.target.querySelector('.article-meta span:last-child');
            if (viewCount && !entry.target.dataset.viewed) {
                entry.target.dataset.viewed = 'true';
                // Simulate view increment
                console.log('Article viewed:', entry.target.querySelector('.article-title').textContent);
            }
        }
    });
}, { threshold: 0.5 });

articleCards.forEach(card => {
    viewObserver.observe(card);
});

// Social share simulation
function shareArticle(platform, articleTitle) {
    console.log(`Partage sur ${platform}: ${articleTitle}`);
    alert(`Partage sur ${platform} - Fonctionnalité en développement`);
}

// Add dynamic date/time update for "live" feel
setInterval(() => {
    const timeElements = document.querySelectorAll('.meta-item .fa-clock');
    timeElements.forEach(element => {
        // This would update relative times in a real implementation
    });
}, 60000); // Update every minute

// Lazy loading images simulation
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

document.querySelectorAll('.article-image, .featured-image').forEach(img => {
    imageObserver.observe(img);
});

// Add reading progress indicator
const progressBar = document.createElement('div');
progressBar.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold), var(--green));
    width: 0%;
    z-index: 10001;
    transition: width 0.1s ease;
`;
document.body.appendChild(progressBar);

window.addEventListener('scroll', function() {
    const windowHeight = window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight - windowHeight;
    const scrolled = window.scrollY;
    const progress = (scrolled / documentHeight) * 100;
    progressBar.style.width = progress + '%';
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    // Escape key closes mobile menu
    if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
        toggleMobileMenu();
    }
    
    // Ctrl/Cmd + K for search focus
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        searchInput.focus();
    }
});

// Add active state to nav item
document.querySelectorAll('.nav-item, .mobile-nav-item').forEach(item => {
    if (item.textContent.trim() === 'Actualités') {
        item.classList.add('active');
    }
});