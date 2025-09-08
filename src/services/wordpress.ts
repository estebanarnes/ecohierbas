// Servicio centralizado de productos - Preparado para migración a WordPress/WooCommerce
import { 
  PRODUCTS_DATABASE, 
  getFeaturedProducts as getLocalFeaturedProducts,
  ProductData,
  CATEGORIES,
  FINALIDADES,
  getProductById,
  getProductBySlug,
  getProductsByCategory,
  searchProducts
} from '@/data/products';

// Interfaz compatible con WordPress (para futura migración)
export interface Product extends ProductData {}

class ProductService {
  // Simulación de delay de API para experiencia realista
  private async simulateApiDelay(): Promise<void> {
    await new Promise(resolve => setTimeout(resolve, 100 + Math.random() * 200));
  }

  async getProducts(): Promise<Product[]> {
    await this.simulateApiDelay();
    return [...PRODUCTS_DATABASE];
  }

  async getFeaturedProducts(limit = 3): Promise<Product[]> {
    await this.simulateApiDelay();
    return getLocalFeaturedProducts(limit);
  }

  async getProductById(id: number): Promise<Product | null> {
    await this.simulateApiDelay();
    return getProductById(id) || null;
  }

  async getProductBySlug(slug: string): Promise<Product | null> {
    await this.simulateApiDelay();
    return getProductBySlug(slug) || null;
  }

  async getProductsByCategory(category: string): Promise<Product[]> {
    await this.simulateApiDelay();
    return getProductsByCategory(category);
  }

  async searchProducts(query: string): Promise<Product[]> {
    await this.simulateApiDelay();
    return searchProducts(query);
  }

  // Métodos para obtener metadatos (útil para filtros)
  getCategories(): string[] {
    return [...CATEGORIES];
  }

  getFinalidades(): string[] {
    return [...FINALIDADES];
  }

  // Método que será útil para la migración a WordPress
  async syncWithWordPress(): Promise<void> {
    // Este método se implementará durante la migración
    console.log('Sincronización con WordPress pendiente de implementación');
  }
}

// Instancia del servicio centralizada
export const productService = new ProductService();

// Alias para compatibilidad con código existente
export const wordpressService = productService;