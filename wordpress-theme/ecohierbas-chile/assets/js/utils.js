/**
 * EcoHierbas Chile - Utilities
 * Funciones auxiliares compartidas
 */

// Global utilities object
window.EcoHierbas = window.EcoHierbas || {};

/**
 * Formatear precio en CLP
 */
EcoHierbas.formatPrice = function(price) {
    return '$' + new Intl.NumberFormat('es-CL').format(price);
};

/**
 * Mostrar notificación toast
 */
EcoHierbas.showNotification = function(message, type = 'success') {
    // Remover notificaciones existentes
    const existing = document.querySelectorAll('.notification');
    existing.forEach(el => el.remove());

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
        EcoHierbas.hideNotification(notification);
    }, 5000);

    // Cerrar manualmente
    const closeButton = notification.querySelector('.notification-close');
    closeButton.addEventListener('click', () => {
        EcoHierbas.hideNotification(notification);
    });
};

/**
 * Ocultar notificación
 */
EcoHierbas.hideNotification = function(notification) {
    notification.classList.remove('show');
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 300);
};

/**
 * Hacer petición AJAX
 */
EcoHierbas.ajax = function(action, data = {}) {
    return new Promise((resolve, reject) => {
        const formData = new FormData();
        formData.append('action', action);
        formData.append('nonce', ecohierbas_ajax.nonce);
        
        for (const key in data) {
            formData.append(key, data[key]);
        }

        fetch(ecohierbas_ajax.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                resolve(result.data);
            } else {
                reject(new Error(result.data || 'Error en la petición'));
            }
        })
        .catch(error => {
            reject(error);
        });
    });
};

/**
 * Validar email
 */
EcoHierbas.validateEmail = function(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
};

/**
 * Debounce function
 */
EcoHierbas.debounce = function(func, wait, immediate) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            timeout = null;
            if (!immediate) func(...args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func(...args);
    };
};

/**
 * Scroll suave a elemento
 */
EcoHierbas.scrollToElement = function(element, offset = 0) {
    if (typeof element === 'string') {
        element = document.querySelector(element);
    }
    
    if (element) {
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
};

/**
 * Lazy loading images
 */
EcoHierbas.initLazyLoading = function() {
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
};

/**
 * LocalStorage helpers
 */
EcoHierbas.storage = {
    get: function(key) {
        try {
            const item = localStorage.getItem(key);
            return item ? JSON.parse(item) : null;
        } catch (error) {
            console.error('Error reading from localStorage:', error);
            return null;
        }
    },
    
    set: function(key, value) {
        try {
            localStorage.setItem(key, JSON.stringify(value));
            return true;
        } catch (error) {
            console.error('Error writing to localStorage:', error);
            return false;
        }
    },
    
    remove: function(key) {
        try {
            localStorage.removeItem(key);
            return true;
        } catch (error) {
            console.error('Error removing from localStorage:', error);
            return false;
        }
    }
};

// Exportar para compatibilidad
if (typeof module !== 'undefined' && module.exports) {
    module.exports = EcoHierbas;
}