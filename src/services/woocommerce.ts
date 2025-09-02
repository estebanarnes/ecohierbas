// WooCommerce REST API Service
const WORDPRESS_BASE_URL = process.env.REACT_APP_WORDPRESS_URL || 'https://tu-sitio-wordpress.com';
const WC_API_BASE = `${WORDPRESS_BASE_URL}/wp-json/wc/v3`;

// WooCommerce API credentials
const WC_CONSUMER_KEY = process.env.REACT_APP_WC_CONSUMER_KEY || '';
const WC_CONSUMER_SECRET = process.env.REACT_APP_WC_CONSUMER_SECRET || '';

// Helper para autenticación WooCommerce
const getWCAuthParams = () => {
  return `consumer_key=${WC_CONSUMER_KEY}&consumer_secret=${WC_CONSUMER_SECRET}`;
};

// WooCommerce Types
export interface WCProduct {
  id: number;
  name: string;
  slug: string;
  permalink: string;
  type: 'simple' | 'grouped' | 'external' | 'variable';
  status: 'draft' | 'pending' | 'private' | 'publish';
  featured: boolean;
  catalog_visibility: 'visible' | 'catalog' | 'search' | 'hidden';
  description: string;
  short_description: string;
  sku: string;
  price: string;
  regular_price: string;
  sale_price: string;
  date_on_sale_from: string | null;
  date_on_sale_to: string | null;
  price_html: string;
  on_sale: boolean;
  purchasable: boolean;
  total_sales: number;
  virtual: boolean;
  downloadable: boolean;
  downloads: any[];
  download_limit: number;
  download_expiry: number;
  external_url: string;
  button_text: string;
  tax_status: 'taxable' | 'shipping' | 'none';
  tax_class: string;
  manage_stock: boolean;
  stock_quantity: number | null;
  stock_status: 'instock' | 'outofstock' | 'onbackorder';
  backorders: 'no' | 'notify' | 'yes';
  backorders_allowed: boolean;
  backordered: boolean;
  sold_individually: boolean;
  weight: string;
  dimensions: {
    length: string;
    width: string;
    height: string;
  };
  shipping_required: boolean;
  shipping_taxable: boolean;
  shipping_class: string;
  shipping_class_id: number;
  reviews_allowed: boolean;
  average_rating: string;
  rating_count: number;
  related_ids: number[];
  upsell_ids: number[];
  cross_sell_ids: number[];
  parent_id: number;
  purchase_note: string;
  categories: Array<{
    id: number;
    name: string;
    slug: string;
  }>;
  tags: Array<{
    id: number;
    name: string;
    slug: string;
  }>;
  images: Array<{
    id: number;
    date_created: string;
    date_created_gmt: string;
    date_modified: string;
    date_modified_gmt: string;
    src: string;
    name: string;
    alt: string;
  }>;
  attributes: Array<{
    id: number;
    name: string;
    position: number;
    visible: boolean;
    variation: boolean;
    options: string[];
  }>;
  default_attributes: Array<{
    id: number;
    name: string;
    option: string;
  }>;
  variations: number[];
  grouped_products: number[];
  menu_order: number;
  meta_data: Array<{
    id: number;
    key: string;
    value: any;
  }>;
}

export interface WCCategory {
  id: number;
  name: string;
  slug: string;
  parent: number;
  description: string;
  display: 'default' | 'products' | 'subcategories' | 'both';
  image: {
    id: number;
    src: string;
    name: string;
    alt: string;
  } | null;
  menu_order: number;
  count: number;
}

export interface WCTag {
  id: number;
  name: string;
  slug: string;
  description: string;
  count: number;
}

export interface WCCustomer {
  id: number;
  email: string;
  first_name: string;
  last_name: string;
  username: string;
  date_created: string;
  date_modified: string;
  last_order_id: number;
  last_order_date: string;
  orders_count: number;
  total_spent: string;
  avatar_url: string;
  billing: WCAddress;
  shipping: WCAddress;
}

export interface WCAddress {
  first_name: string;
  last_name: string;
  company: string;
  address_1: string;
  address_2: string;
  city: string;
  state: string;
  postcode: string;
  country: string;
  email?: string;
  phone?: string;
}

export interface WCOrder {
  id: number;
  parent_id: number;
  number: string;
  order_key: string;
  created_via: string;
  version: string;
  status: 'pending' | 'processing' | 'on-hold' | 'completed' | 'cancelled' | 'refunded' | 'failed' | 'trash';
  currency: string;
  date_created: string;
  date_modified: string;
  discount_total: string;
  discount_tax: string;
  shipping_total: string;
  shipping_tax: string;
  cart_tax: string;
  total: string;
  total_tax: string;
  prices_include_tax: boolean;
  customer_id: number;
  customer_ip_address: string;
  customer_user_agent: string;
  customer_note: string;
  billing: WCAddress;
  shipping: WCAddress;
  payment_method: string;
  payment_method_title: string;
  transaction_id: string;
  date_paid: string | null;
  date_completed: string | null;
  cart_hash: string;
  line_items: WCLineItem[];
  tax_lines: any[];
  shipping_lines: any[];
  fee_lines: any[];
  coupon_lines: any[];
  refunds: any[];
}

export interface WCLineItem {
  id: number;
  name: string;
  product_id: number;
  variation_id: number;
  quantity: number;
  tax_class: string;
  subtotal: string;
  subtotal_tax: string;
  total: string;
  total_tax: string;
  taxes: any[];
  meta_data: any[];
  sku: string;
  price: number;
}

// WooCommerce API functions
export const wooApi = {
  // Products
  async getProducts(params: Record<string, any> = {}) {
    const searchParams = new URLSearchParams({
      ...params,
      ...Object.fromEntries(new URLSearchParams(getWCAuthParams())),
    });
    const response = await fetch(`${WC_API_BASE}/products?${searchParams}`);
    if (!response.ok) throw new Error('Failed to fetch products');
    return response.json() as Promise<WCProduct[]>;
  },

  async getProduct(id: number) {
    const response = await fetch(`${WC_API_BASE}/products/${id}?${getWCAuthParams()}`);
    if (!response.ok) throw new Error('Failed to fetch product');
    return response.json() as Promise<WCProduct>;
  },

  async getProductBySlug(slug: string) {
    const response = await fetch(`${WC_API_BASE}/products?slug=${slug}&${getWCAuthParams()}`);
    if (!response.ok) throw new Error('Failed to fetch product');
    const products = await response.json() as WCProduct[];
    return products[0] || null;
  },

  async getFeaturedProducts() {
    return this.getProducts({ featured: true });
  },

  async getProductsByCategory(categoryId: number) {
    return this.getProducts({ category: categoryId });
  },

  async searchProducts(query: string) {
    return this.getProducts({ search: query });
  },

  // Categories
  async getCategories() {
    const response = await fetch(`${WC_API_BASE}/products/categories?${getWCAuthParams()}`);
    if (!response.ok) throw new Error('Failed to fetch categories');
    return response.json() as Promise<WCCategory[]>;
  },

  async getCategory(id: number) {
    const response = await fetch(`${WC_API_BASE}/products/categories/${id}?${getWCAuthParams()}`);
    if (!response.ok) throw new Error('Failed to fetch category');
    return response.json() as Promise<WCCategory>;
  },

  // Tags
  async getTags() {
    const response = await fetch(`${WC_API_BASE}/products/tags?${getWCAuthParams()}`);
    if (!response.ok) throw new Error('Failed to fetch tags');
    return response.json() as Promise<WCTag[]>;
  },

  // Orders
  async createOrder(orderData: Partial<WCOrder>) {
    const response = await fetch(`${WC_API_BASE}/orders?${getWCAuthParams()}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(orderData),
    });
    if (!response.ok) throw new Error('Failed to create order');
    return response.json() as Promise<WCOrder>;
  },

  async getOrder(id: number) {
    const response = await fetch(`${WC_API_BASE}/orders/${id}?${getWCAuthParams()}`);
    if (!response.ok) throw new Error('Failed to fetch order');
    return response.json() as Promise<WCOrder>;
  },

  // Customers
  async getCustomer(id: number) {
    const response = await fetch(`${WC_API_BASE}/customers/${id}?${getWCAuthParams()}`);
    if (!response.ok) throw new Error('Failed to fetch customer');
    return response.json() as Promise<WCCustomer>;
  },

  async createCustomer(customerData: Partial<WCCustomer>) {
    const response = await fetch(`${WC_API_BASE}/customers?${getWCAuthParams()}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(customerData),
    });
    if (!response.ok) throw new Error('Failed to create customer');
    return response.json() as Promise<WCCustomer>;
  },
};