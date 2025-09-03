// WordPress REST API Service
const WORDPRESS_BASE_URL = import.meta.env.VITE_WORDPRESS_URL || 'https://tu-sitio-wordpress.com';
const WP_API_BASE = `${WORDPRESS_BASE_URL}/wp-json/wp/v2`;
const WC_API_BASE = `${WORDPRESS_BASE_URL}/wp-json/wc/v3`;

// WordPress API credentials (usar variables de entorno en producción)
const WC_CONSUMER_KEY = import.meta.env.VITE_WC_CONSUMER_KEY || '';
const WC_CONSUMER_SECRET = import.meta.env.VITE_WC_CONSUMER_SECRET || '';

// Helper para autenticación WooCommerce
const getWCAuthParams = () => {
  return `consumer_key=${WC_CONSUMER_KEY}&consumer_secret=${WC_CONSUMER_SECRET}`;
};

// WordPress Types
export interface WPPost {
  id: number;
  title: { rendered: string };
  content: { rendered: string };
  excerpt: { rendered: string };
  featured_media: number;
  slug: string;
  date: string;
  link: string;
  categories: number[];
  tags: number[];
  meta: Record<string, any>;
}

export interface WPPage {
  id: number;
  title: { rendered: string };
  content: { rendered: string };
  slug: string;
  template: string;
  meta: Record<string, any>;
  featured_media: number;
}

export interface WPMedia {
  id: number;
  source_url: string;
  alt_text: string;
  title: { rendered: string };
  media_details: {
    sizes: Record<string, {
      source_url: string;
      width: number;
      height: number;
    }>;
  };
}

// WordPress REST API functions
export const wpApi = {
  // Posts
  async getPosts(params: Record<string, any> = {}) {
    const searchParams = new URLSearchParams(params);
    const response = await fetch(`${WP_API_BASE}/posts?${searchParams}`);
    if (!response.ok) throw new Error('Failed to fetch posts');
    return response.json() as Promise<WPPost[]>;
  },

  async getPost(id: number) {
    const response = await fetch(`${WP_API_BASE}/posts/${id}`);
    if (!response.ok) throw new Error('Failed to fetch post');
    return response.json() as Promise<WPPost>;
  },

  async getPostBySlug(slug: string) {
    const response = await fetch(`${WP_API_BASE}/posts?slug=${slug}`);
    if (!response.ok) throw new Error('Failed to fetch post');
    const posts = await response.json() as WPPost[];
    return posts[0] || null;
  },

  // Pages
  async getPages(params: Record<string, any> = {}) {
    const searchParams = new URLSearchParams(params);
    const response = await fetch(`${WP_API_BASE}/pages?${searchParams}`);
    if (!response.ok) throw new Error('Failed to fetch pages');
    return response.json() as Promise<WPPage[]>;
  },

  async getPage(id: number) {
    const response = await fetch(`${WP_API_BASE}/pages/${id}`);
    if (!response.ok) throw new Error('Failed to fetch page');
    return response.json() as Promise<WPPage>;
  },

  async getPageBySlug(slug: string) {
    const response = await fetch(`${WP_API_BASE}/pages?slug=${slug}`);
    if (!response.ok) throw new Error('Failed to fetch page');
    const pages = await response.json() as WPPage[];
    return pages[0] || null;
  },

  // Media
  async getMedia(id: number) {
    const response = await fetch(`${WP_API_BASE}/media/${id}`);
    if (!response.ok) throw new Error('Failed to fetch media');
    return response.json() as Promise<WPMedia>;
  },

  // Categories
  async getCategories() {
    const response = await fetch(`${WP_API_BASE}/categories`);
    if (!response.ok) throw new Error('Failed to fetch categories');
    return response.json();
  },

  // Tags
  async getTags() {
    const response = await fetch(`${WP_API_BASE}/tags`);
    if (!response.ok) throw new Error('Failed to fetch tags');
    return response.json();
  },
};

// WP Forms API integration
export const wpFormsApi = {
  async submitForm(formId: number, formData: Record<string, any>) {
    const response = await fetch(`${WORDPRESS_BASE_URL}/wp-json/wpforms/v1/forms/${formId}/entries`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        fields: formData,
      }),
    });
    
    if (!response.ok) throw new Error('Failed to submit form');
    return response.json();
  },

  async getForm(formId: number) {
    const response = await fetch(`${WORDPRESS_BASE_URL}/wp-json/wpforms/v1/forms/${formId}`);
    if (!response.ok) throw new Error('Failed to fetch form');
    return response.json();
  },
};