import { useQuery, useMutation } from '@tanstack/react-query';
import { wpApi, wpFormsApi, WPPage } from '@/services/wordpress';

// Hook específico para WP Forms (solo lo que se usa)
export const useWPForms = () => {
  const useSubmitForm = () => {
    return useMutation({
      mutationFn: ({ formId, formData }: { formId: number; formData: Record<string, any> }) =>
        wpFormsApi.submitForm(formId, formData),
    });
  };

  return {
    useSubmitForm,
  };
};

// Hook para páginas de WordPress con plantillas específicas (optimizado)
export const useWordPressTemplate = (slug: string) => {
  const pageQuery = useQuery({
    queryKey: ['wp-page-slug', slug],
    queryFn: () => wpApi.getPageBySlug(slug),
    enabled: !!slug,
    staleTime: 10 * 60 * 1000,
  });

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