/**
 * Utilidades globales - EcoHierbas Chile
 * Pub/Sub, helpers DOM, formateo moneda
 */

// Sistema de eventos pub/sub simple
const EventBus = {
  events: {},

  on(event, callback) {
    if (!this.events[event]) {
      this.events[event] = [];
    }
    this.events[event].push(callback);
  },

  off(event, callback) {
    if (!this.events[event]) return;
    this.events[event] = this.events[event].filter(cb => cb !== callback);
  },

  emit(event, data) {
    if (!this.events[event]) return;
    this.events[event].forEach(callback => callback(data));
  }
};

// Helpers DOM
const DOM = {
  /**
   * Selector helper con validación
   */
  $(selector, context = document) {
    return context.querySelector(selector);
  },

  $$(selector, context = document) {
    return Array.from(context.querySelectorAll(selector));
  },

  /**
   * Toggle clase con callback opcional
   */
  toggleClass(element, className, force) {
    if (!element) return;
    element.classList.toggle(className, force);
  },

  /**
   * Añadir/quitar clase con transición
   */
  addClass(element, className) {
    if (!element) return;
    element.classList.add(className);
  },

  removeClass(element, className) {
    if (!element) return;
    element.classList.remove(className);
  },

  /**
   * Crear elemento con atributos y contenido
   */
  createElement(tag, attributes = {}, content = '') {
    const element = document.createElement(tag);
    
    Object.entries(attributes).forEach(([key, value]) => {
      if (key === 'className') {
        element.className = value;
      } else if (key === 'dataset') {
        Object.entries(value).forEach(([dataKey, dataValue]) => {
          element.dataset[dataKey] = dataValue;
        });
      } else {
        element.setAttribute(key, value);
      }
    });

    if (content) {
      element.innerHTML = content;
    }

    return element;
  },

  /**
   * Obtener datos del elemento
   */
  getData(element, key) {
    if (!element) return null;
    return element.dataset[key] || element.getAttribute(`data-${key}`);
  },

  /**
   * Scroll suave a elemento
   */
  scrollTo(element, options = {}) {
    if (!element) return;
    
    const defaultOptions = {
      behavior: 'smooth',
      block: 'start',
      inline: 'nearest'
    };

    element.scrollIntoView({ ...defaultOptions, ...options });
  }
};

// Utilidades de moneda
const Currency = {
  /**
   * Formatear precio en CLP
   */
  format(amount, options = {}) {
    const defaultOptions = {
      style: 'currency',
      currency: 'CLP',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    };

    try {
      return new Intl.NumberFormat('es-CL', { ...defaultOptions, ...options }).format(amount);
    } catch (error) {
      // Fallback si Intl no está disponible
      return `$${Math.round(amount).toLocaleString('es-CL')}`;
    }
  },

  /**
   * Parsear string de precio a número
   */
  parse(priceString) {
    if (typeof priceString === 'number') return priceString;
    return parseFloat(priceString.replace(/[^\d.-]/g, '')) || 0;
  },

  /**
   * Calcular descuento
   */
  calculateDiscount(originalPrice, salePrice) {
    if (!originalPrice || !salePrice || salePrice >= originalPrice) return 0;
    return Math.round(((originalPrice - salePrice) / originalPrice) * 100);
  }
};

// Utilidades de validación
const Validation = {
  /**
   * Validar email
   */
  isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  },

  /**
   * Validar teléfono chileno
   */
  isValidPhone(phone) {
    const phoneRegex = /^(\+56|56)?[2-9]\d{8}$/;
    return phoneRegex.test(phone.replace(/\s/g, ''));
  },

  /**
   * Sanitizar HTML básico
   */
  sanitizeHtml(html) {
    const temp = document.createElement('div');
    temp.textContent = html;
    return temp.innerHTML;
  }
};

// Utilidades de performance
const Performance = {
  /**
   * Debounce function
   */
  debounce(func, wait, immediate) {
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
  },

  /**
   * Throttle function
   */
  throttle(func, limit) {
    let inThrottle;
    return function executedFunction(...args) {
      if (!inThrottle) {
        func.apply(this, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    };
  },

  /**
   * Lazy loading de imágenes
   */
  lazyLoadImages() {
    if ('IntersectionObserver' in window) {
      const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            const src = img.dataset.src;
            if (src) {
              img.src = src;
              img.removeAttribute('data-src');
              imageObserver.unobserve(img);
            }
          }
        });
      });

      DOM.$$('img[data-src]').forEach(img => imageObserver.observe(img));
    }
  }
};

// Utilidades de accesibilidad
const A11y = {
  /**
   * Focus trap para modales
   */
  createFocusTrap(container) {
    const focusableElements = container.querySelectorAll(
      'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    
    const firstFocusable = focusableElements[0];
    const lastFocusable = focusableElements[focusableElements.length - 1];

    const handleTabKey = (e) => {
      if (e.key === 'Tab') {
        if (e.shiftKey) {
          if (document.activeElement === firstFocusable) {
            lastFocusable.focus();
            e.preventDefault();
          }
        } else {
          if (document.activeElement === lastFocusable) {
            firstFocusable.focus();
            e.preventDefault();
          }
        }
      }
    };

    container.addEventListener('keydown', handleTabKey);

    return {
      activate() {
        firstFocusable?.focus();
      },
      deactivate() {
        container.removeEventListener('keydown', handleTabKey);
      }
    };
  },

  /**
   * Anunciar cambios a lectores de pantalla
   */
  announce(message, priority = 'polite') {
    const announcer = DOM.$(`[aria-live="${priority}"]`) || this.createAnnouncer(priority);
    announcer.textContent = message;
    
    // Limpiar después de un tiempo
    setTimeout(() => {
      announcer.textContent = '';
    }, 1000);
  },

  createAnnouncer(priority = 'polite') {
    const announcer = DOM.createElement('div', {
      'aria-live': priority,
      'aria-atomic': 'true',
      className: 'sr-only'
    });
    
    document.body.appendChild(announcer);
    return announcer;
  }
};

// Storage wrapper
const Storage = {
  /**
   * LocalStorage con fallback
   */
  set(key, value) {
    try {
      localStorage.setItem(key, JSON.stringify(value));
      return true;
    } catch (error) {
      console.warn('Storage not available:', error);
      return false;
    }
  },

  get(key, defaultValue = null) {
    try {
      const item = localStorage.getItem(key);
      return item ? JSON.parse(item) : defaultValue;
    } catch (error) {
      console.warn('Storage not available:', error);
      return defaultValue;
    }
  },

  remove(key) {
    try {
      localStorage.removeItem(key);
      return true;
    } catch (error) {
      console.warn('Storage not available:', error);
      return false;
    }
  },

  clear() {
    try {
      localStorage.clear();
      return true;
    } catch (error) {
      console.warn('Storage not available:', error);
      return false;
    }
  }
};

// Exportar utilidades globalmente
window.EcoHierbas = {
  EventBus,
  DOM,
  Currency,
  Validation,
  Performance,
  A11y,
  Storage
};

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
  // Lazy loading de imágenes
  Performance.lazyLoadImages();
  
  // Crear anunciador para a11y
  A11y.createAnnouncer();
  
  console.log('EcoHierbas Utils initialized');
});