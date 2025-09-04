import { createContext, useContext, useReducer, ReactNode } from 'react';
import { CartItem, CartState, CartAction } from '@/lib/cartTypes';
import { storage } from '@/lib/storage';
import { CART_STORAGE_KEY } from '@/lib/cartTypes';

// Cargar estado inicial desde localStorage
const getInitialState = (): CartState => {
  const savedCart = storage.get<CartItem[]>('cart', []);
  const items = savedCart || [];
  
  return {
    items,
    totalItems: items.reduce((sum, item) => sum + item.quantity, 0),
    totalPrice: items.reduce((sum, item) => sum + (item.price * item.quantity), 0),
    isOpen: false,
  };
};

const initialState: CartState = getInitialState();

function cartReducer(state: CartState, action: CartAction): CartState {
  let newState: CartState;
  
  switch (action.type) {
    case 'ADD_ITEM': {
      const existingItem = state.items.find(item => item.id === action.payload.id);
      
      let newItems: CartItem[];
      if (existingItem) {
        newItems = state.items.map(item =>
          item.id === action.payload.id
            ? { ...item, quantity: item.quantity + 1 }
            : item
        );
      } else {
        newItems = [...state.items, { ...action.payload, quantity: 1 }];
      }

      const totalItems = newItems.reduce((sum, item) => sum + item.quantity, 0);
      const totalPrice = newItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

      newState = {
        ...state,
        items: newItems,
        totalItems,
        totalPrice,
      };
      break;
    }

    case 'REMOVE_ITEM': {
      const newItems = state.items.filter(item => item.id !== action.payload);
      const totalItems = newItems.reduce((sum, item) => sum + item.quantity, 0);
      const totalPrice = newItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

      newState = {
        ...state,
        items: newItems,
        totalItems,
        totalPrice,
      };
      break;
    }

    case 'UPDATE_QUANTITY': {
      const newItems = state.items.map(item =>
        item.id === action.payload.id
          ? { ...item, quantity: Math.max(0, action.payload.quantity) }
          : item
      ).filter(item => item.quantity > 0);

      const totalItems = newItems.reduce((sum, item) => sum + item.quantity, 0);
      const totalPrice = newItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);

      newState = {
        ...state,
        items: newItems,
        totalItems,
        totalPrice,
      };
      break;
    }

    case 'CLEAR_CART':
      newState = {
        ...state,
        items: [],
        totalItems: 0,
        totalPrice: 0,
      };
      break;

    case 'TOGGLE_CART':
      newState = {
        ...state,
        isOpen: !state.isOpen,
      };
      break;

    case 'OPEN_CART':
      newState = {
        ...state,
        isOpen: true,
      };
      break;

    case 'CLOSE_CART':
      newState = {
        ...state,
        isOpen: false,
      };
      break;

    default:
      return state;
  }
  
  // Guardar en localStorage automáticamente después de cada cambio
  storage.set('cart', newState.items);
  return newState;
}

const CartContext = createContext<{
  state: CartState;
  addItem: (item: Omit<CartItem, 'quantity'>) => void;
  removeItem: (id: number) => void;
  updateQuantity: (id: number, quantity: number) => void;
  clearCart: () => void;
  toggleCart: () => void;
  openCart: () => void;
  closeCart: () => void;
} | null>(null);

export function CartProvider({ children }: { children: ReactNode }) {
  const [state, dispatch] = useReducer(cartReducer, initialState);

  const addItem = (item: Omit<CartItem, 'quantity'>) => {
    dispatch({ type: 'ADD_ITEM', payload: item });
  };

  const removeItem = (id: number) => {
    dispatch({ type: 'REMOVE_ITEM', payload: id });
  };

  const updateQuantity = (id: number, quantity: number) => {
    dispatch({ type: 'UPDATE_QUANTITY', payload: { id, quantity } });
  };

  const clearCart = () => {
    dispatch({ type: 'CLEAR_CART' });
  };

  const toggleCart = () => {
    dispatch({ type: 'TOGGLE_CART' });
  };

  const openCart = () => {
    dispatch({ type: 'OPEN_CART' });
  };

  const closeCart = () => {
    dispatch({ type: 'CLOSE_CART' });
  };

  return (
    <CartContext.Provider
      value={{
        state,
        addItem,
        removeItem,
        updateQuantity,
        clearCart,
        toggleCart,
        openCart,
        closeCart,
      }}
    >
      {children}
    </CartContext.Provider>
  );
}

export function useCart() {
  const context = useContext(CartContext);
  if (!context) {
    throw new Error('useCart must be used within a CartProvider');
  }
  return context;
}