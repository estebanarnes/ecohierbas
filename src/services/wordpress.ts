export interface WordPressProduct {
  id: number;
  title: { rendered: string };
  excerpt: { rendered: string };
  content: { rendered: string };
  featured_media: number;
  meta: {
    price?: string;
    original_price?: string;
    stock_status?: string;
    rating?: string;
    review_count?: string;
    category?: string;
    finalidad?: string;
  };
  categories: number[];
  slug: string;
  _embedded?: {
    'wp:featuredmedia'?: Array<{
      source_url: string;
      alt_text: string;
    }>;
    'wp:term'?: Array<Array<{
      id: number;
      name: string;
      slug: string;
    }>>;
  };
}

export interface Product {
  id: number;
  name: string;
  slug: string;
  category: string;
  finalidad: string | null;
  price: number;
  originalPrice: number | null;
  image: string;
  rating: number;
  reviews: number;
  inStock: boolean;
  description: string;
}

const WORDPRESS_API_URL = import.meta.env.VITE_WORDPRESS_API_URL || 'https://your-wordpress-site.com/wp-json/wp/v2';

class WordPressService {
  private async fetchWithTimeout(url: string, timeout = 5000): Promise<Response> {
    const controller = new AbortController();
    const id = setTimeout(() => controller.abort(), timeout);
    
    try {
      const response = await fetch(url, {
        signal: controller.signal,
        headers: {
          'Content-Type': 'application/json',
        },
      });
      clearTimeout(id);
      return response;
    } catch (error) {
      clearTimeout(id);
      throw error;
    }
  }

  async getProducts(): Promise<Product[]> {
    try {
      const response = await this.fetchWithTimeout(
        `${WORDPRESS_API_URL}/productos?_embed&per_page=100`
      );
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      const wpProducts: WordPressProduct[] = await response.json();
      return this.transformProducts(wpProducts);
    } catch (error) {
      console.error('Error fetching products from WordPress:', error);
      return this.getFallbackProducts();
    }
  }

  async getFeaturedProducts(limit = 3): Promise<Product[]> {
    try {
      const response = await this.fetchWithTimeout(
        `${WORDPRESS_API_URL}/productos?_embed&meta_key=featured&meta_value=true&per_page=${limit}`
      );
      
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      
      const wpProducts: WordPressProduct[] = await response.json();
      const products = this.transformProducts(wpProducts);
      
      // If no featured products found, return first few products
      if (products.length === 0) {
        const allProducts = await this.getProducts();
        return allProducts.slice(0, limit);
      }
      
      return products;
    } catch (error) {
      console.error('Error fetching featured products:', error);
      return this.getFallbackProducts().slice(0, limit);
    }
  }

  private transformProducts(wpProducts: WordPressProduct[]): Product[] {
    return wpProducts.map(wp => ({
      id: wp.id,
      name: wp.title.rendered,
      slug: wp.slug,
      category: this.extractCategory(wp),
      finalidad: wp.meta.finalidad || null,
      price: parseInt(wp.meta.price || '0'),
      originalPrice: wp.meta.original_price ? parseInt(wp.meta.original_price) : null,
      image: this.extractImage(wp),
      rating: parseFloat(wp.meta.rating || '4.5'),
      reviews: parseInt(wp.meta.review_count || '0'),
      inStock: wp.meta.stock_status !== 'outofstock',
      description: this.stripHtml(wp.excerpt.rendered)
    }));
  }

  private extractCategory(wp: WordPressProduct): string {
    // Try to get category from _embedded terms first
    if (wp._embedded?.['wp:term']?.[0]?.[0]) {
      return wp._embedded['wp:term'][0][0].name;
    }
    
    // Fallback to meta category
    return wp.meta.category || 'Sin categoría';
  }

  private extractImage(wp: WordPressProduct): string {
    // Try to get image from _embedded featured media
    if (wp._embedded?.['wp:featuredmedia']?.[0]?.source_url) {
      return wp._embedded['wp:featuredmedia'][0].source_url;
    }
    
    // Fallback to default image
    return '/assets/producto-default.jpg';
  }

  private stripHtml(html: string): string {
    const tmp = document.createElement('div');
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || '';
  }

  private getFallbackProducts(): Product[] {
    return [
      {
        id: 1,
        name: "Box Especial Mujer - Refresca tu Piel",
        slug: "box-especial-mujer-refresca-tu-piel",
        category: "Infusiones",
        finalidad: "Piel",
        price: 24990,
        originalPrice: 29990,
        image: "/assets/productos-hierbas.jpg",
        rating: 4.8,
        reviews: 156,
        inStock: true,
        description: "Mezcla especial de hierbas para el cuidado y regeneración de la piel femenina"
      },
      {
        id: 2,
        name: "Vermicompostera 5 Niveles",
        slug: "vermicompostera-5-niveles",
        category: "Vermicompostaje",
        finalidad: null,
        price: 89990,
        originalPrice: null,
        image: "/assets/vermicompostaje.jpg",
        rating: 4.9,
        reviews: 89,
        inStock: true,
        description: "Sistema completo de vermicompostaje para empresas y hogares"
      },
      {
        id: 3,
        name: "Eco Macetero Alerce + Kit Cultivo",
        slug: "eco-macetero-alerce-kit-cultivo",
        category: "Maceteros",
        finalidad: null,
        price: 15990,
        originalPrice: 19990,
        image: "/assets/maceteros-kits.jpg",
        rating: 4.7,
        reviews: 203,
        inStock: true,
        description: "Macetero ecológico de madera alerce con kit completo para cultivar hierbas"
      }
    ];
  }
}

export const wordpressService = new WordPressService();