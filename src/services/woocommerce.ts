// WooCommerce REST API Service
const WORDPRESS_BASE_URL = import.meta.env.VITE_WORDPRESS_URL || 'https://tu-sitio-wordpress.com';
const WC_API_BASE = `${WORDPRESS_BASE_URL}/wp-json/wc/v3`;

// WooCommerce API credentials
const WC_CONSUMER_KEY = import.meta.env.VITE_WC_CONSUMER_KEY || '';
const WC_CONSUMER_SECRET = import.meta.env.VITE_WC_CONSUMER_SECRET || '';

// Helper para autenticación WooCommerce
const getWCAuthParams = () => {
  return `consumer_key=${WC_CONSUMER_KEY}&consumer_secret=${WC_CONSUMER_SECRET}`;
};

// WooCommerce Types (optimizado - solo campos utilizados)
export interface WCProduct {
  id: number;
  name: string;
  slug: string;
  description: string;
  short_description: string;
  price: string;
  regular_price: string;
  sale_price: string;
  on_sale: boolean;
  stock_status: 'instock' | 'outofstock' | 'onbackorder';
  average_rating: string;
  rating_count: number;
  categories: Array<{
    id: number;
    name: string;
    slug: string;
  }>;
  images: Array<{
    id: number;
    src: string;
    name: string;
    alt: string;
  }>;
  attributes: Array<{
    id: number;
    name: string;
    options: string[];
  }>;
}

// WooCommerce API functions (optimizado - solo funciones utilizadas)
export const wooApi = {
  // Products - solo las que se usan
  async getProducts(params: Record<string, any> = {}) {
    const searchParams = new URLSearchParams({
      ...params,
      ...Object.fromEntries(new URLSearchParams(getWCAuthParams())),
    });
    const response = await fetch(`${WC_API_BASE}/products?${searchParams}`);
    if (!response.ok) throw new Error('Failed to fetch products');
    return response.json() as Promise<WCProduct[]>;
  },

  async getFeaturedProducts() {
    return this.getProducts({ featured: true });
  },
};