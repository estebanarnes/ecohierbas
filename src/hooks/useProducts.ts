import { useState, useEffect } from 'react';
import { wordpressService, Product } from '@/services/wordpress';

export const useProducts = () => {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        setLoading(true);
        setError(null);
        const fetchedProducts = await wordpressService.getProducts();
        setProducts(fetchedProducts);
      } catch (err) {
        setError('Error al cargar productos');
        console.error('Error fetching products:', err);
      } finally {
        setLoading(false);
      }
    };

    fetchProducts();
  }, []);

  const refetch = async () => {
    const fetchProducts = async () => {
      try {
        setLoading(true);
        setError(null);
        const fetchedProducts = await wordpressService.getProducts();
        setProducts(fetchedProducts);
      } catch (err) {
        setError('Error al cargar productos');
        console.error('Error fetching products:', err);
      } finally {
        setLoading(false);
      }
    };
    await fetchProducts();
  };

  return { products, loading, error, refetch };
};

export const useFeaturedProducts = (limit = 3) => {
  const [products, setProducts] = useState<Product[]>([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchFeaturedProducts = async () => {
      try {
        setLoading(true);
        setError(null);
        const fetchedProducts = await wordpressService.getFeaturedProducts(limit);
        setProducts(fetchedProducts);
      } catch (err) {
        setError('Error al cargar productos destacados');
        console.error('Error fetching featured products:', err);
      } finally {
        setLoading(false);
      }
    };

    fetchFeaturedProducts();
  }, [limit]);

  return { products, loading, error };
};