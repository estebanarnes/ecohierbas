/**
 * EcoHierbas Chile - JavaScript Principal
 * Migración desde React para mantener funcionalidad idéntica
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('EcoHierbas Chile theme loaded');
    
    // Inicializar componentes principales
    initMobileMenu();
    initScrollEffects();
    initOffersPopup();
    initSmoothScrolling();
    initLazyLoading();
    
    // Inicializar cart si existe WooCommerce
    if (typeof wc_add_to_cart_params !== 'undefined') {
        initCartFunctionality();
    }
});

/**
 * Menú móvil
 */
function initMobileMenu() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuClose = document.querySelector('[data-mobile-menu-close]');
    
    if (!mobileMenuToggle || !mobileMenu) return;
    
    // Abrir menú móvil
    mobileMenuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        mobileMenu.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
    
    // Cerrar menú móvil
    function closeMobileMenu() {
        mobileMenu.classList.add('hidden');
        document.body.style.overflow = '';
    }
    
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMobileMenu);
    }
    
    // Cerrar al hacer clic fuera
    mobileMenu.addEventListener('click', function(e) {
        if (e.target === mobileMenu) {
            closeMobileMenu();
        }
    });
    
    // Cerrar con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
            closeMobileMenu();
        }
    });
}

/**
 * Efectos de scroll (parallax en hero)
 */
function initScrollEffects() {
    const heroBackground = document.querySelector('[data-parallax]');
    
    if (!heroBackground) return;
    
    let ticking = false;
    
    function updateParallax() {
        const scrolled = window.pageYOffset;
        const rate = scrolled * -0.5;
        
        heroBackground.style.transform = `translateY(${rate}px)`;
        ticking = false;
    }
    
    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }
    
    window.addEventListener('scroll', requestTick);
}

/**
 * Popup de ofertas (migración del React OffersPopup)
 */
function initOffersPopup() {
    // Verificar si ya se mostró el popup
    const hasSeenPopup = localStorage.getItem('ecohierbas-popup-seen');
    
    if (hasSeenPopup) return;
    
    const popup = document.querySelector('[data-popup="ofertas"]');
    if (!popup) return;
    
    // Mostrar popup después de 2 segundos
    setTimeout(() => {
        popup.style.display = 'flex';
        popup.classList.add('u-animate-fade-in');
        document.body.style.overflow = 'hidden';
    }, 2000);
    
    // Función para cerrar popup
    function closePopup() {
        popup.style.display = 'none';
        document.body.style.overflow = '';
        localStorage.setItem('ecohierbas-popup-seen', 'true');
    }
    
    // Cerrar con botón X
    const closeButton = popup.querySelector('[data-popup-close]');
    if (closeButton) {
        closeButton.addEventListener('click', closePopup);
    }
    
    // Cerrar con "No mostrar de nuevo"
    const noShowButton = popup.querySelector('[data-popup-no-show]');
    if (noShowButton) {
        noShowButton.addEventListener('click', closePopup);
    }
    
    // Cerrar al hacer clic fuera
    popup.addEventListener('click', function(e) {
        if (e.target === popup) {
            closePopup();
        }
    });
}

/**
 * Smooth scrolling para enlaces ancla
 */
function initSmoothScrolling() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Lazy loading para imágenes
 */
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback para navegadores sin soporte
        images.forEach(img => {
            img.src = img.dataset.src;
            img.classList.remove('lazy');
        });
    }
}

/**
 * Funcionalidad del carrito (WooCommerce)
 */
function initCartFunctionality() {
    // Cart sidebar toggle
    const cartTrigger = document.querySelector('[data-cart-trigger]');
    const cartSidebar = document.getElementById('cart-sidebar');
    const cartClose = document.getElementById('close-cart');
    
    if (cartTrigger && cartSidebar) {
        cartTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            cartSidebar.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (cartClose && cartSidebar) {
        cartClose.addEventListener('click', function() {
            cartSidebar.classList.remove('open');
            document.body.style.overflow = '';
        });
    }
    
    // Agregar evento para botones "Add to Cart"
    const addToCartButtons = document.querySelectorAll('.ajax_add_to_cart');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Mostrar loading state
            this.classList.add('loading');
            this.disabled = true;
            
            // WooCommerce manejará la funcionalidad AJAX
            // Después del éxito, mostrar notificación
            setTimeout(() => {
                this.classList.remove('loading');
                this.disabled = false;
                showNotification('Producto agregado al carrito');
            }, 1000);
        });
    });
}

/**
 * Sistema de notificaciones simple
 */
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification notification--${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Mostrar con animación
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Auto-cerrar después de 5 segundos
    setTimeout(() => {
        hideNotification(notification);
    }, 5000);
    
    // Cerrar manualmente
    const closeButton = notification.querySelector('.notification-close');
    closeButton.addEventListener('click', () => {
        hideNotification(notification);
    });
}

function hideNotification(notification) {
    notification.classList.remove('show');
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 300);
}

/**
 * Utilidades globales
 */
window.EcoHierbas = {
    showNotification,
    hideNotification
};