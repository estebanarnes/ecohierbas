import { useQuery, useMutation } from '@tanstack/react-query';
import { wpApi, wpFormsApi, WPPost, WPPage } from '@/services/wordpress';

// Custom hooks para WordPress
export const useWordPress = () => {
  // Posts hooks
  const usePosts = (params?: Record<string, any>) => {
    return useQuery({
      queryKey: ['wp-posts', params],
      queryFn: () => wpApi.getPosts(params),
      staleTime: 5 * 60 * 1000, // 5 minutes
    });
  };

  const usePost = (id: number) => {
    return useQuery({
      queryKey: ['wp-post', id],
      queryFn: () => wpApi.getPost(id),
      enabled: !!id,
      staleTime: 5 * 60 * 1000,
    });
  };

  const usePostBySlug = (slug: string) => {
    return useQuery({
      queryKey: ['wp-post-slug', slug],
      queryFn: () => wpApi.getPostBySlug(slug),
      enabled: !!slug,
      staleTime: 5 * 60 * 1000,
    });
  };

  // Pages hooks
  const usePages = (params?: Record<string, any>) => {
    return useQuery({
      queryKey: ['wp-pages', params],
      queryFn: () => wpApi.getPages(params),
      staleTime: 10 * 60 * 1000, // 10 minutes
    });
  };

  const usePage = (id: number) => {
    return useQuery({
      queryKey: ['wp-page', id],
      queryFn: () => wpApi.getPage(id),
      enabled: !!id,
      staleTime: 10 * 60 * 1000,
    });
  };

  const usePageBySlug = (slug: string) => {
    return useQuery({
      queryKey: ['wp-page-slug', slug],
      queryFn: () => wpApi.getPageBySlug(slug),
      enabled: !!slug,
      staleTime: 10 * 60 * 1000,
    });
  };

  // Media hooks
  const useMedia = (id: number) => {
    return useQuery({
      queryKey: ['wp-media', id],
      queryFn: () => wpApi.getMedia(id),
      enabled: !!id,
      staleTime: 30 * 60 * 1000, // 30 minutes
    });
  };

  // Categories hooks
  const useCategories = () => {
    return useQuery({
      queryKey: ['wp-categories'],
      queryFn: () => wpApi.getCategories(),
      staleTime: 30 * 60 * 1000,
    });
  };

  // Tags hooks
  const useTags = () => {
    return useQuery({
      queryKey: ['wp-tags'],
      queryFn: () => wpApi.getTags(),
      staleTime: 30 * 60 * 1000,
    });
  };

  return {
    // Posts
    usePosts,
    usePost,
    usePostBySlug,
    
    // Pages
    usePages,
    usePage,
    usePageBySlug,
    
    // Media
    useMedia,
    
    // Categories & Tags
    useCategories,
    useTags,
  };
};

// Hook específico para WP Forms
export const useWPForms = () => {
  const useSubmitForm = () => {
    return useMutation({
      mutationFn: ({ formId, formData }: { formId: number; formData: Record<string, any> }) =>
        wpFormsApi.submitForm(formId, formData),
    });
  };

  const useForm = (formId: number) => {
    return useQuery({
      queryKey: ['wp-form', formId],
      queryFn: () => wpFormsApi.getForm(formId),
      enabled: !!formId,
      staleTime: 60 * 60 * 1000, // 1 hour
    });
  };

  return {
    useSubmitForm,
    useForm,
  };
};

// Hook para páginas de WordPress con plantillas específicas
export const useWordPressTemplate = (slug: string) => {
  const { usePageBySlug } = useWordPress();
  const pageQuery = usePageBySlug(slug);

  // Determinar el template a usar basado en la página
  const getTemplate = (page: WPPage | null) => {
    if (!page) return 'default';
    
    // Mapeo de slugs a templates
    const templateMap: Record<string, string> = {
      'nosotros': 'about',
      'productos': 'products',
      'contacto': 'contact',
      'inicio': 'home',
      'blog': 'blog',
      'tienda': 'shop',
    };

    return templateMap[page.slug] || page.template || 'default';
  };

  return {
    ...pageQuery,
    template: getTemplate(pageQuery.data),
  };
};