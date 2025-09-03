/**
 * Manejo de modales - EcoHierbas Chile
 * Focus trap, aria-hidden, scroll-lock, transiciones
 */

class EcoHierbasModals {
  constructor() {
    this.activeModal = null;
    this.focusTrap = null;
    this.previousActiveElement = null;
    
    this.init();
  }

  init() {
    this.bindEvents();
    this.createProductModal();
  }

  bindEvents() {
    // Botones para abrir vista rápida de producto
    document.addEventListener('click', (e) => {
      if (e.target.matches('.view-product-btn') || e.target.closest('.view-product-btn')) {
        e.preventDefault();
        const btn = e.target.closest('.view-product-btn');
        const productData = btn.dataset.product;
        
        if (productData) {
          try {
            const product = JSON.parse(productData);
            this.openProductModal(product);
          } catch (error) {
            console.error('Error parsing product data:', error);
          }
        }
      }
    });

    // Cerrar modal con ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.activeModal) {
        this.closeModal();
      }
    });

    // Cerrar modal clickeando fuera
    document.addEventListener('click', (e) => {
      if (e.target.matches('.u-modal-overlay')) {
        this.closeModal();
      }
    });

    // Cotización B2B desde hero
    const heroB2BBtn = EcoHierbas.DOM.$('#hero-b2b-quote');
    if (heroB2BBtn) {
      heroB2BBtn.addEventListener('click', () => {
        this.openB2BModal();
      });
    }
  }

  createProductModal() {
    // Modal ya existe en template-parts/modal-product.php
    this.productModal = EcoHierbas.DOM.$('#product-modal');
    
    if (this.productModal) {
      // Cerrar con botón X
      const closeBtn = EcoHierbas.DOM.$('.modal-close', this.productModal);
      if (closeBtn) {
        closeBtn.addEventListener('click', () => this.closeModal());
      }

      // Botones de cantidad del modal
      const minusBtn = EcoHierbas.DOM.$('.quantity-minus', this.productModal);
      const plusBtn = EcoHierbas.DOM.$('.quantity-plus', this.productModal);
      const quantityInput = EcoHierbas.DOM.$('#modal-quantity', this.productModal);

      if (minusBtn && quantityInput) {
        minusBtn.addEventListener('click', () => {
          const currentQty = parseInt(quantityInput.value) || 1;
          if (currentQty > 1) {
            quantityInput.value = currentQty - 1;
          }
        });
      }

      if (plusBtn && quantityInput) {
        plusBtn.addEventListener('click', () => {
          const currentQty = parseInt(quantityInput.value) || 1;
          const maxQty = parseInt(quantityInput.max) || 999;
          if (currentQty < maxQty) {
            quantityInput.value = currentQty + 1;
          }
        });
      }

      // Añadir al carrito desde modal
      const addToCartBtn = EcoHierbas.DOM.$('#modal-add-to-cart', this.productModal);
      if (addToCartBtn) {
        addToCartBtn.addEventListener('click', () => {
          const productId = addToCartBtn.dataset.productId;
          const quantity = parseInt(quantityInput?.value) || 1;
          const productName = EcoHierbas.DOM.$('.modal-title', this.productModal)?.textContent;

          if (productId && window.EcoHierbasCartInstance) {
            window.EcoHierbasCartInstance.addItem(productId, quantity, { name: productName });
            this.closeModal();
          }
        });
      }
    }
  }

  openProductModal(product) {
    if (!this.productModal) return;

    // Almacenar elemento activo para restaurar foco
    this.previousActiveElement = document.activeElement;

    // Poblar datos del producto
    this.populateProductModal(product);

    // Mostrar modal
    this.showModal(this.productModal);

    // Emitir evento
    EcoHierbas.EventBus.emit('modal:open', { type: 'product', product });
  }

  populateProductModal(product) {
    if (!this.productModal) return;

    // Imagen principal
    const mainImage = EcoHierbas.DOM.$('.modal-image img', this.productModal);
    if (mainImage && product.image) {
      mainImage.src = product.image;
      mainImage.alt = product.name;
    }

    // Galería de imágenes (si existe)
    const gallery = EcoHierbas.DOM.$('.modal-gallery', this.productModal);
    if (gallery && product.images && product.images.length > 1) {
      gallery.innerHTML = '';
      product.images.forEach((image, index) => {
        const thumb = EcoHierbas.DOM.createElement('button', {
          className: `gallery-thumb ${index === 0 ? 'active' : ''}`,
          'aria-label': `Ver imagen ${index + 1}`
        }, `<img src="${image.src}" alt="${image.alt || product.name}" class="w-full h-full object-cover">`);
        
        thumb.addEventListener('click', () => {
          if (mainImage) {
            mainImage.src = image.src;
            mainImage.alt = image.alt || product.name;
          }
          
          // Actualizar thumbs activos
          EcoHierbas.DOM.$$('.gallery-thumb', gallery).forEach(t => t.classList.remove('active'));
          thumb.classList.add('active');
        });
        
        gallery.appendChild(thumb);
      });
    }

    // Categoría
    const category = EcoHierbas.DOM.$('.modal-category', this.productModal);
    if (category) {
      category.textContent = product.category || '';
      category.style.display = product.category ? 'inline-block' : 'none';
    }

    // Finalidad
    const finalidad = EcoHierbas.DOM.$('.modal-finalidad', this.productModal);
    if (finalidad) {
      finalidad.textContent = product.finalidad || '';
      finalidad.style.display = product.finalidad ? 'inline-block' : 'none';
    }

    // Título
    const title = EcoHierbas.DOM.$('.modal-title', this.productModal);
    if (title) title.textContent = product.name;

    // Descripción
    const description = EcoHierbas.DOM.$('.modal-description', this.productModal);
    if (description) {
      description.textContent = product.description || product.excerpt || '';
    }

    // Rating
    const rating = EcoHierbas.DOM.$('.modal-rating', this.productModal);
    if (rating && product.rating > 0) {
      rating.innerHTML = this.generateStarRating(product.rating, product.reviews);
      rating.style.display = 'flex';
    } else if (rating) {
      rating.style.display = 'none';
    }

    // Precio
    const price = EcoHierbas.DOM.$('.modal-price', this.productModal);
    if (price) {
      let priceHtml = `<span class="text-2xl font-bold">${EcoHierbas.Currency.format(product.price)}</span>`;
      
      if (product.originalPrice && product.originalPrice > product.price) {
        priceHtml += ` <span class="text-lg text-muted-foreground line-through ml-2">${EcoHierbas.Currency.format(product.originalPrice)}</span>`;
        
        const discount = EcoHierbas.Currency.calculateDiscount(product.originalPrice, product.price);
        if (discount > 0) {
          priceHtml += ` <span class="u-badge bg-destructive text-destructive-foreground ml-2">${discount}% OFF</span>`;
        }
      }
      
      price.innerHTML = priceHtml;
    }

    // Stock
    const stock = EcoHierbas.DOM.$('.modal-stock', this.productModal);
    const addToCartBtn = EcoHierbas.DOM.$('#modal-add-to-cart', this.productModal);
    const quantityInput = EcoHierbas.DOM.$('#modal-quantity', this.productModal);

    if (product.inStock) {
      if (stock) {
        stock.innerHTML = '<span class="u-badge u-badge--default">En stock</span>';
      }
      if (addToCartBtn) {
        addToCartBtn.disabled = false;
        addToCartBtn.dataset.productId = product.id;
        addToCartBtn.classList.remove('bg-muted', 'text-muted-foreground', 'cursor-not-allowed');
        addToCartBtn.classList.add('u-btn--primary');
      }
      if (quantityInput) {
        quantityInput.disabled = false;
        quantityInput.max = product.stock || 999;
      }
    } else {
      if (stock) {
        stock.innerHTML = '<span class="u-badge bg-destructive text-destructive-foreground">Agotado</span>';
      }
      if (addToCartBtn) {
        addToCartBtn.disabled = true;
        addToCartBtn.classList.add('bg-muted', 'text-muted-foreground', 'cursor-not-allowed');
        addToCartBtn.classList.remove('u-btn--primary');
      }
      if (quantityInput) {
        quantityInput.disabled = true;
      }
    }

    // Atributos/características
    const attributes = EcoHierbas.DOM.$('.modal-attributes', this.productModal);
    if (attributes && product.attributes && product.attributes.length > 0) {
      attributes.innerHTML = product.attributes.map(attr => 
        `<div class="flex justify-between py-2 border-b border-border last:border-b-0">
          <span class="font-medium">${attr.name}:</span>
          <span>${Array.isArray(attr.options) ? attr.options.join(', ') : attr.options}</span>
        </div>`
      ).join('');
      attributes.style.display = 'block';
    } else if (attributes) {
      attributes.style.display = 'none';
    }
  }

  generateStarRating(rating, reviewCount = 0) {
    const stars = [];
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 !== 0;

    // Estrellas llenas
    for (let i = 0; i < fullStars; i++) {
      stars.push('<svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>');
    }

    // Media estrella
    if (hasHalfStar) {
      stars.push('<svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20"><defs><linearGradient id="half"><stop offset="50%" stop-color="currentColor"/><stop offset="50%" stop-color="transparent"/></linearGradient></defs><path fill="url(#half)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>');
    }

    // Estrellas vacías
    const emptyStars = 5 - Math.ceil(rating);
    for (let i = 0; i < emptyStars; i++) {
      stars.push('<svg class="w-4 h-4 text-gray-300" viewBox="0 0 20 20"><path fill="currentColor" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>');
    }

    const reviewText = reviewCount > 0 ? `<span class="text-sm text-muted-foreground ml-2">(${reviewCount} ${reviewCount === 1 ? 'reseña' : 'reseñas'})</span>` : '';

    return `<div class="flex items-center gap-1">${stars.join('')}</div>${reviewText}`;
  }

  openB2BModal() {
    // Crear modal B2B dinámicamente o usar uno existente
    let b2bModal = EcoHierbas.DOM.$('#b2b-modal');
    
    if (!b2bModal) {
      b2bModal = this.createB2BModal();
      document.body.appendChild(b2bModal);
    }

    this.showModal(b2bModal);
    EcoHierbas.EventBus.emit('modal:open', { type: 'b2b' });
  }

  createB2BModal() {
    return EcoHierbas.DOM.createElement('div', {
      id: 'b2b-modal',
      className: 'u-modal-overlay fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4',
      'aria-hidden': 'true'
    }, `
      <div class="u-modal-content bg-background rounded-lg max-w-md w-full max-h-[90vh] overflow-y-auto" role="dialog" aria-modal="true" aria-labelledby="b2b-modal-title">
        <div class="p-6">
          <div class="flex items-center justify-between mb-4">
            <h2 id="b2b-modal-title" class="text-xl font-semibold">Cotización B2B</h2>
            <button class="modal-close w-8 h-8 flex items-center justify-center rounded-full hover:bg-muted transition-colors" aria-label="Cerrar modal">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          
          <p class="text-muted-foreground mb-6">
            Solicita una cotización personalizada para compras al por mayor. Te contactaremos dentro de 24 horas.
          </p>
          
          <form class="space-y-4">
            <div>
              <label for="b2b-company" class="block text-sm font-medium mb-1">Empresa</label>
              <input type="text" id="b2b-company" class="u-input w-full" required>
            </div>
            
            <div>
              <label for="b2b-name" class="block text-sm font-medium mb-1">Nombre contacto</label>
              <input type="text" id="b2b-name" class="u-input w-full" required>
            </div>
            
            <div>
              <label for="b2b-email" class="block text-sm font-medium mb-1">Email</label>
              <input type="email" id="b2b-email" class="u-input w-full" required>
            </div>
            
            <div>
              <label for="b2b-phone" class="block text-sm font-medium mb-1">Teléfono</label>
              <input type="tel" id="b2b-phone" class="u-input w-full">
            </div>
            
            <div>
              <label for="b2b-message" class="block text-sm font-medium mb-1">Productos de interés</label>
              <textarea id="b2b-message" rows="3" class="u-input w-full" placeholder="Describe los productos que te interesan y las cantidades aproximadas"></textarea>
            </div>
            
            <div class="flex gap-3 pt-4">
              <button type="button" class="modal-close u-btn u-btn--outline flex-1">Cancelar</button>
              <button type="submit" class="u-btn u-btn--primary flex-1">Enviar cotización</button>
            </div>
          </form>
        </div>
      </div>
    `);
  }

  showModal(modal) {
    if (!modal) return;

    this.activeModal = modal;

    // Bloquear scroll del body
    document.body.style.overflow = 'hidden';

    // Ocultar contenido de fondo para lectores de pantalla
    const mainContent = EcoHierbas.DOM.$('main') || EcoHierbas.DOM.$('#main') || document.body;
    if (mainContent && mainContent !== modal) {
      mainContent.setAttribute('aria-hidden', 'true');
    }

    // Mostrar modal
    modal.classList.remove('hidden');
    modal.setAttribute('aria-hidden', 'false');
    
    // Configurar focus trap
    this.focusTrap = EcoHierbas.A11y.createFocusTrap(modal);
    this.focusTrap.activate();

    // Añadir listener para cerrar
    const closeBtn = EcoHierbas.DOM.$('.modal-close', modal);
    if (closeBtn) {
      closeBtn.addEventListener('click', () => this.closeModal());
    }
  }

  closeModal() {
    if (!this.activeModal) return;

    const modal = this.activeModal;

    // Restaurar scroll del body
    document.body.style.overflow = '';

    // Restaurar contenido de fondo
    const mainContent = EcoHierbas.DOM.$('main') || EcoHierbas.DOM.$('#main') || document.body;
    if (mainContent && mainContent !== modal) {
      mainContent.removeAttribute('aria-hidden');
    }

    // Ocultar modal
    modal.setAttribute('aria-hidden', 'true');
    modal.classList.add('hidden');

    // Limpiar focus trap
    if (this.focusTrap) {
      this.focusTrap.deactivate();
      this.focusTrap = null;
    }

    // Restaurar foco
    if (this.previousActiveElement) {
      this.previousActiveElement.focus();
      this.previousActiveElement = null;
    }

    this.activeModal = null;

    // Emitir evento
    EcoHierbas.EventBus.emit('modal:close');
  }
}

// Inicializar modales cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  window.EcoHierbasModalsInstance = new EcoHierbasModals();
});