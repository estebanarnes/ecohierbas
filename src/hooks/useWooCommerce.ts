import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { wooApi, WCProduct, WCCategory, WCOrder } from '@/services/woocommerce';

// Custom hooks para WooCommerce
export const useWooCommerce = () => {
  const queryClient = useQueryClient();

  // Products hooks
  const useProducts = (params?: Record<string, any>) => {
    return useQuery({
      queryKey: ['wc-products', params],
      queryFn: () => wooApi.getProducts(params),
      staleTime: 5 * 60 * 1000, // 5 minutes
    });
  };

  const useProduct = (id: number) => {
    return useQuery({
      queryKey: ['wc-product', id],
      queryFn: () => wooApi.getProduct(id),
      enabled: !!id,
      staleTime: 5 * 60 * 1000,
    });
  };

  const useProductBySlug = (slug: string) => {
    return useQuery({
      queryKey: ['wc-product-slug', slug],
      queryFn: () => wooApi.getProductBySlug(slug),
      enabled: !!slug,
      staleTime: 5 * 60 * 1000,
    });
  };

  const useFeaturedProducts = () => {
    return useQuery({
      queryKey: ['wc-featured-products'],
      queryFn: () => wooApi.getFeaturedProducts(),
      staleTime: 10 * 60 * 1000, // 10 minutes
    });
  };

  const useProductsByCategory = (categoryId: number) => {
    return useQuery({
      queryKey: ['wc-products-category', categoryId],
      queryFn: () => wooApi.getProductsByCategory(categoryId),
      enabled: !!categoryId,
      staleTime: 5 * 60 * 1000,
    });
  };

  const useSearchProducts = (query: string) => {
    return useQuery({
      queryKey: ['wc-search-products', query],
      queryFn: () => wooApi.searchProducts(query),
      enabled: !!query && query.length > 2,
      staleTime: 2 * 60 * 1000, // 2 minutes for search results
    });
  };

  // Categories hooks
  const useCategories = () => {
    return useQuery({
      queryKey: ['wc-categories'],
      queryFn: () => wooApi.getCategories(),
      staleTime: 30 * 60 * 1000, // 30 minutes
    });
  };

  const useCategory = (id: number) => {
    return useQuery({
      queryKey: ['wc-category', id],
      queryFn: () => wooApi.getCategory(id),
      enabled: !!id,
      staleTime: 30 * 60 * 1000,
    });
  };

  // Tags hooks
  const useTags = () => {
    return useQuery({
      queryKey: ['wc-tags'],
      queryFn: () => wooApi.getTags(),
      staleTime: 30 * 60 * 1000,
    });
  };

  // Orders mutations
  const useCreateOrder = () => {
    return useMutation({
      mutationFn: (orderData: Partial<WCOrder>) => wooApi.createOrder(orderData),
      onSuccess: () => {
        queryClient.invalidateQueries({ queryKey: ['wc-orders'] });
      },
    });
  };

  const useOrder = (id: number) => {
    return useQuery({
      queryKey: ['wc-order', id],
      queryFn: () => wooApi.getOrder(id),
      enabled: !!id,
    });
  };

  // Customer hooks
  const useCustomer = (id: number) => {
    return useQuery({
      queryKey: ['wc-customer', id],
      queryFn: () => wooApi.getCustomer(id),
      enabled: !!id,
    });
  };

  const useCreateCustomer = () => {
    return useMutation({
      mutationFn: wooApi.createCustomer,
      onSuccess: () => {
        queryClient.invalidateQueries({ queryKey: ['wc-customers'] });
      },
    });
  };

  return {
    // Products
    useProducts,
    useProduct,
    useProductBySlug,
    useFeaturedProducts,
    useProductsByCategory,
    useSearchProducts,
    
    // Categories
    useCategories,
    useCategory,
    
    // Tags
    useTags,
    
    // Orders
    useCreateOrder,
    useOrder,
    
    // Customers
    useCustomer,
    useCreateCustomer,
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