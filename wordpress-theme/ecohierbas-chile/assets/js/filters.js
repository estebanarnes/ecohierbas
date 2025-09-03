/**
 * Filtros de productos - EcoHierbas Chile
 * Categorías, precio, orden, paginación sincronizada con WooCommerce
 */

class EcoHierbasFilters {
  constructor() {
    this.filters = {
      search: '',
      category: 'all',
      finalidad: 'all',
      price_range: 'all',
      orderby: 'menu_order'
    };
    
    this.isFiltering = false;
    this.currentPage = 1;
    this.totalPages = 1;
    
    this.init();
  }

  init() {
    // Solo inicializar en páginas de productos
    if (!this.isProductPage()) return;

    this.parseURLParams();
    this.bindEvents();
    this.updateFilterUI();
  }

  isProductPage() {
    return document.body.classList.contains('woocommerce-page') || 
           document.body.classList.contains('post-type-archive-product') ||
           EcoHierbas.DOM.$('.product-filters');
  }

  parseURLParams() {
    const urlParams = new URLSearchParams(window.location.search);
    
    this.filters.search = urlParams.get('s') || '';
    this.filters.category = urlParams.get('product_cat') || 'all';
    this.filters.finalidad = urlParams.get('pa_finalidad') || 'all';
    this.filters.price_range = urlParams.get('price_range') || 'all';
    this.filters.orderby = urlParams.get('orderby') || 'menu_order';
    this.currentPage = parseInt(urlParams.get('paged')) || 1;
  }

  bindEvents() {
    // Filtro de búsqueda
    const searchInput = EcoHierbas.DOM.$('#product-search');
    if (searchInput) {
      const debouncedSearch = EcoHierbas.Performance.debounce((e) => {
        this.filters.search = e.target.value;
        this.applyFilters();
      }, 500);
      
      searchInput.addEventListener('input', debouncedSearch);
      searchInput.value = this.filters.search;
    }

    // Filtros de select
    const categorySelect = EcoHierbas.DOM.$('#category-filter');
    const finalidadSelect = EcoHierbas.DOM.$('#finalidad-filter');
    const priceSelect = EcoHierbas.DOM.$('#price-filter');
    const orderSelect = EcoHierbas.DOM.$('#sort-filter');

    if (categorySelect) {
      categorySelect.addEventListener('change', (e) => {
        this.filters.category = e.target.value;
        this.applyFilters();
      });
      categorySelect.value = this.filters.category;
    }

    if (finalidadSelect) {
      finalidadSelect.addEventListener('change', (e) => {
        this.filters.finalidad = e.target.value;
        this.applyFilters();
      });
      finalidadSelect.value = this.filters.finalidad;
    }

    if (priceSelect) {
      priceSelect.addEventListener('change', (e) => {
        this.filters.price_range = e.target.value;
        this.applyFilters();
      });
      priceSelect.value = this.filters.price_range;
    }

    if (orderSelect) {
      orderSelect.addEventListener('change', (e) => {
        this.filters.orderby = e.target.value;
        this.applyFilters();
      });
      orderSelect.value = this.filters.orderby;
    }

    // Limpiar filtros
    const clearFiltersBtn = EcoHierbas.DOM.$('#clear-filters');
    if (clearFiltersBtn) {
      clearFiltersBtn.addEventListener('click', () => {
        this.clearFilters();
      });
    }

    // Paginación
    document.addEventListener('click', (e) => {
      if (e.target.matches('.page-link') || e.target.closest('.page-link')) {
        e.preventDefault();
        const link = e.target.closest('.page-link');
        const page = parseInt(link.dataset.page);
        
        if (page && page !== this.currentPage) {
          this.currentPage = page;
          this.applyFilters();
        }
      }
    });

    // Toggle de filtros en móvil
    const filtersToggle = EcoHierbas.DOM.$('#filters-toggle');
    const filtersPanel = EcoHierbas.DOM.$('.filters-panel');
    
    if (filtersToggle && filtersPanel) {
      filtersToggle.addEventListener('click', () => {
        filtersPanel.classList.toggle('hidden');
        
        const isOpen = !filtersPanel.classList.contains('hidden');
        filtersToggle.setAttribute('aria-expanded', isOpen);
        
        if (isOpen) {
          // Focus en el primer filtro
          const firstFilter = EcoHierbas.DOM.$('input, select', filtersPanel);
          firstFilter?.focus();
        }
      });
    }

    // Cerrar filtros en móvil al aplicar
    EcoHierbas.EventBus.on('filters:applied', () => {
      if (window.innerWidth < 768 && filtersPanel) {
        filtersPanel.classList.add('hidden');
        if (filtersToggle) {
          filtersToggle.setAttribute('aria-expanded', 'false');
        }
      }
    });
  }

  async applyFilters() {
    if (this.isFiltering) return;

    this.isFiltering = true;
    this.showLoadingState();

    try {
      // Construir parámetros de la consulta
      const params = new URLSearchParams();
      
      if (this.filters.search) params.set('s', this.filters.search);
      if (this.filters.category !== 'all') params.set('product_cat', this.filters.category);
      if (this.filters.finalidad !== 'all') params.set('pa_finalidad', this.filters.finalidad);
      if (this.filters.price_range !== 'all') params.set('price_range', this.filters.price_range);
      if (this.filters.orderby !== 'menu_order') params.set('orderby', this.filters.orderby);
      if (this.currentPage > 1) params.set('paged', this.currentPage);

      // Hacer la petición AJAX
      const response = await fetch(ecohierbas_ajax.ajax_url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          action: 'ecohierbas_filter_products',
          filters: JSON.stringify(this.filters),
          page: this.currentPage,
          nonce: ecohierbas_ajax.nonce
        })
      });

      const result = await response.json();

      if (result.success) {
        // Actualizar el contenido de productos
        this.updateProductGrid(result.data.html);
        
        // Actualizar paginación
        this.updatePagination(result.data.pagination);
        
        // Actualizar contador de resultados
        this.updateResultsCount(result.data.total);
        
        // Actualizar URL sin recargar la página
        this.updateURL(params);
        
        // Scroll al inicio de los productos
        const productsGrid = EcoHierbas.DOM.$('.products-grid');
        if (productsGrid) {
          EcoHierbas.DOM.scrollTo(productsGrid, { block: 'start' });
        }
        
        EcoHierbas.EventBus.emit('filters:applied', this.filters);
        
      } else {
        console.error('Error filtering products:', result.data);
        this.showErrorState();
      }

    } catch (error) {
      console.error('Error applying filters:', error);
      this.showErrorState();
    } finally {
      this.isFiltering = false;
      this.hideLoadingState();
    }
  }

  updateProductGrid(html) {
    const grid = EcoHierbas.DOM.$('.products-grid');
    if (grid) {
      grid.innerHTML = html;
      
      // Re-inicializar lazy loading para nuevas imágenes
      EcoHierbas.Performance.lazyLoadImages();
      
      // Anunciar cambio a lectores de pantalla
      EcoHierbas.A11y.announce('Productos actualizados');
    }
  }

  updatePagination(paginationData) {
    const pagination = EcoHierbas.DOM.$('.products-pagination');
    if (pagination && paginationData) {
      pagination.innerHTML = paginationData.html;
      this.totalPages = paginationData.total_pages;
    }
  }

  updateResultsCount(total) {
    const counter = EcoHierbas.DOM.$('.results-count');
    if (counter) {
      counter.textContent = `Mostrando ${total} ${total === 1 ? 'producto' : 'productos'}`;
    }
  }

  updateURL(params) {
    const newURL = params.toString() ? 
      `${window.location.pathname}?${params.toString()}` : 
      window.location.pathname;
      
    window.history.replaceState(null, '', newURL);
  }

  clearFilters() {
    // Resetear filtros
    this.filters = {
      search: '',
      category: 'all',
      finalidad: 'all',
      price_range: 'all',
      orderby: 'menu_order'
    };
    this.currentPage = 1;

    // Actualizar UI
    this.updateFilterUI();
    
    // Aplicar filtros limpios
    this.applyFilters();
    
    EcoHierbas.A11y.announce('Filtros eliminados');
  }

  updateFilterUI() {
    // Actualizar inputs
    const searchInput = EcoHierbas.DOM.$('#product-search');
    if (searchInput) searchInput.value = this.filters.search;

    const categorySelect = EcoHierbas.DOM.$('#category-filter');
    if (categorySelect) categorySelect.value = this.filters.category;

    const finalidadSelect = EcoHierbas.DOM.$('#finalidad-filter');
    if (finalidadSelect) finalidadSelect.value = this.filters.finalidad;

    const priceSelect = EcoHierbas.DOM.$('#price-filter');
    if (priceSelect) priceSelect.value = this.filters.price_range;

    const orderSelect = EcoHierbas.DOM.$('#sort-filter');
    if (orderSelect) orderSelect.value = this.filters.orderby;

    // Mostrar/ocultar indicador de filtros activos
    this.updateActiveFiltersIndicator();
  }

  updateActiveFiltersIndicator() {
    const hasActiveFilters = this.filters.search || 
      this.filters.category !== 'all' || 
      this.filters.finalidad !== 'all' || 
      this.filters.price_range !== 'all' || 
      this.filters.orderby !== 'menu_order';

    const indicator = EcoHierbas.DOM.$('.active-filters-indicator');
    const clearBtn = EcoHierbas.DOM.$('#clear-filters');

    if (indicator) {
      indicator.style.display = hasActiveFilters ? 'block' : 'none';
    }

    if (clearBtn) {
      clearBtn.style.display = hasActiveFilters ? 'inline-flex' : 'none';
    }

    // Actualizar texto de estado
    const statusText = EcoHierbas.DOM.$('.filters-status');
    if (statusText) {
      if (hasActiveFilters) {
        const activeCount = [
          this.filters.search,
          this.filters.category !== 'all' ? this.filters.category : null,
          this.filters.finalidad !== 'all' ? this.filters.finalidad : null,
          this.filters.price_range !== 'all' ? this.filters.price_range : null
        ].filter(Boolean).length;
        
        statusText.textContent = `${activeCount} filtro${activeCount !== 1 ? 's' : ''} activo${activeCount !== 1 ? 's' : ''}`;
      } else {
        statusText.textContent = 'Mostrando todos los productos';
      }
    }
  }

  showLoadingState() {
    const grid = EcoHierbas.DOM.$('.products-grid');
    if (grid) {
      grid.classList.add('opacity-50', 'pointer-events-none');
    }

    // Mostrar spinner en botones de filtro
    EcoHierbas.DOM.$$('.filter-control').forEach(control => {
      control.disabled = true;
    });

    EcoHierbas.A11y.announce('Filtrando productos...');
  }

  hideLoadingState() {
    const grid = EcoHierbas.DOM.$('.products-grid');
    if (grid) {
      grid.classList.remove('opacity-50', 'pointer-events-none');
    }

    // Rehabilitar botones de filtro
    EcoHierbas.DOM.$$('.filter-control').forEach(control => {
      control.disabled = false;
    });
  }

  showErrorState() {
    const grid = EcoHierbas.DOM.$('.products-grid');
    if (grid) {
      grid.innerHTML = `
        <div class="col-span-full text-center py-12">
          <svg class="w-16 h-16 text-muted-foreground mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <h3 class="text-lg font-semibold mb-2">Error al filtrar productos</h3>
          <p class="text-muted-foreground mb-4">Ocurrió un error al aplicar los filtros. Por favor, intenta de nuevo.</p>
          <button onclick="location.reload()" class="u-btn u-btn--primary">Recargar página</button>
        </div>
      `;
    }

    EcoHierbas.A11y.announce('Error al filtrar productos');
  }

  // Método público para filtrar desde otros componentes
  setFilter(key, value) {
    if (this.filters.hasOwnProperty(key)) {
      this.filters[key] = value;
      this.currentPage = 1; // Reset page
      this.updateFilterUI();
      this.applyFilters();
    }
  }

  // Obtener estado actual de filtros
  getFilters() {
    return { ...this.filters };
  }
}

// Inicializar filtros cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  window.EcoHierbasFiltersInstance = new EcoHierbasFilters();
});