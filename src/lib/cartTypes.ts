// Tipos estándar del carrito - compartidos entre React y WordPress
export interface CartItem {
  id: number;
  name: string;
  slug: string;
  price: number;
  originalPrice?: number;
  image: string;
  category: string;
  quantity: number;
  inStock: boolean;
  wcProduct?: any; // Para compatibilidad WooCommerce
}

export interface CartState {
  items: CartItem[];
  totalItems: number;
  totalPrice: number;
  isOpen: boolean;
}

export type CartAction =
  | { type: 'ADD_ITEM'; payload: Omit<CartItem, 'quantity'> }
  | { type: 'REMOVE_ITEM'; payload: number }
  | { type: 'UPDATE_QUANTITY'; payload: { id: number; quantity: number } }
  | { type: 'CLEAR_CART' }
  | { type: 'TOGGLE_CART' }
  | { type: 'OPEN_CART' }
  | { type: 'CLOSE_CART' };

// Constantes del carrito
export const CART_STORAGE_KEY = 'ecohierbas-cart';
export const POPUP_STORAGE_KEY = 'ecohierbas-popup-seen';

// Las constantes CURRENCY y LOCALE se movieron a utils.ts para evitar import circular