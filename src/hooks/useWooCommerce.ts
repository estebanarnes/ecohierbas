import { useQuery } from '@tanstack/react-query';
import { wooApi, WCProduct } from '@/services/woocommerce';

// Custom hooks para WooCommerce (optimizado - solo funciones utilizadas)
export const useWooCommerce = () => {
  // Products hooks - solo las que se usan
  const useProducts = (params?: Record<string, any>) => {
    return useQuery({
      queryKey: ['wc-products', params],
      queryFn: () => wooApi.getProducts(params),
      staleTime: 5 * 60 * 1000, // 5 minutes
    });
  };

  const useFeaturedProducts = () => {
    return useQuery({
      queryKey: ['wc-featured-products'],
      queryFn: () => wooApi.getFeaturedProducts(),
      staleTime: 10 * 60 * 1000, // 10 minutes
    });
  };

  return {
    useProducts,
    useFeaturedProducts,
  };
};

// Helper hook para convertir productos WC a formato de carrito
export const useWCProductAdapter = () => {
  const convertWCProductToCartItem = (wcProduct: WCProduct) => {
    return {
      id: wcProduct.id,
      name: wcProduct.name,
      slug: wcProduct.slug,
      price: parseFloat(wcProduct.price) || 0,
      originalPrice: wcProduct.sale_price ? parseFloat(wcProduct.regular_price) : undefined,
      image: wcProduct.images[0]?.src || '',
      category: wcProduct.categories[0]?.name || '',
      inStock: wcProduct.stock_status === 'instock',
      wcProduct, // Mantener referencia al producto WC original
    };
  };

  return { convertWCProductToCartItem };
};