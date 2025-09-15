// WordPress REST API Service (optimizado)
const WORDPRESS_BASE_URL = import.meta.env.VITE_WORDPRESS_URL || 'https://tu-sitio-wordpress.com';
const WP_API_BASE = `${WORDPRESS_BASE_URL}/wp-json/wp/v2`;

// WordPress Types (solo los que se usan)
export interface WPPage {
  id: number;
  title: { rendered: string };
  content: { rendered: string };
  slug: string;
  template: string;
  meta: Record<string, any>;
  featured_media: number;
}

// WordPress REST API functions (optimizado - solo funciones utilizadas)
export const wpApi = {
  // Pages - solo getPageBySlug que se usa
  async getPageBySlug(slug: string) {
    const response = await fetch(`${WP_API_BASE}/pages?slug=${slug}`);
    if (!response.ok) throw new Error('Failed to fetch page');
    const pages = await response.json() as WPPage[];
    return pages[0] || null;
  },
};

// WP Forms API integration (optimizado - solo submitForm que se usa)
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
};