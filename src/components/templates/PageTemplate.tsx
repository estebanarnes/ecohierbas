import { ReactNode } from 'react';
import { Helmet } from 'react-helmet-async';
import Header from '@/components/Header';
import Footer from '@/components/Footer';

interface PageTemplateProps {
  template?: string;
  children: ReactNode;
  customSEO?: {
    title?: string;
    description?: string;
    keywords?: string;
    image?: string;
    canonicalUrl?: string;
  };
}

const PageTemplate = ({ template = 'default', children, customSEO }: PageTemplateProps) => {
  // SEO data
  const pageTitle = customSEO?.title || 'Ecohierbas Chile';
  const pageDescription = customSEO?.description || 'Productos orgánicos y sustentables para tu bienestar';
  const pageKeywords = customSEO?.keywords || 'ecohierbas, orgánico, sustentable, hierbas, vermicompostaje';
  const pageImage = customSEO?.image || '/og-image.jpg';
  const canonicalUrl = customSEO?.canonicalUrl || `${window.location.origin}${window.location.pathname}`;

  // Schema.org structured data
  const structuredData = {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": pageTitle,
    "description": pageDescription,
    "url": canonicalUrl,
    "publisher": {
      "@type": "Organization",
      "name": "Ecohierbas Chile",
      "logo": {
        "@type": "ImageObject",
        "url": `${window.location.origin}/logo.png`
      }
    },
    "mainEntity": {
      "@type": "Organization",
      "@id": `${window.location.origin}/#organization`,
      "name": "Ecohierbas Chile",
      "description": "Empresa chilena especializada en productos orgánicos, hierbas medicinales y sistemas de vermicompostaje sustentables.",
      "url": window.location.origin,
      "sameAs": [
        "https://www.instagram.com/ecohierbas",
        "https://www.facebook.com/ecohierbas",
      ]
    }
  };

  // Template-specific classes
  const getTemplateClasses = () => {
    const baseClasses = 'min-h-screen bg-background';
    const templateClasses: Record<string, string> = {
      'home': `${baseClasses} homepage`,
      'about': `${baseClasses} about-page`,
      'products': `${baseClasses} products-page`,
      'contact': `${baseClasses} contact-page`,
      'blog': `${baseClasses} blog-page`,
      'shop': `${baseClasses} shop-page`,
      'default': baseClasses,
    };
    
    return templateClasses[template] || baseClasses;
  };

  return (
    <>
      <Helmet>
        {/* Basic SEO */}
        <title>{pageTitle}</title>
        <meta name="description" content={pageDescription} />
        <meta name="keywords" content={pageKeywords} />
        <link rel="canonical" href={canonicalUrl} />
        
        {/* Open Graph */}
        <meta property="og:type" content="website" />
        <meta property="og:title" content={pageTitle} />
        <meta property="og:description" content={pageDescription} />
        <meta property="og:image" content={pageImage} />
        <meta property="og:url" content={canonicalUrl} />
        <meta property="og:site_name" content="Ecohierbas Chile" />
        <meta property="og:locale" content="es_CL" />
        
        {/* Twitter Card */}
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content={pageTitle} />
        <meta name="twitter:description" content={pageDescription} />
        <meta name="twitter:image" content={pageImage} />
        
        {/* Additional SEO */}
        <meta name="robots" content="index, follow" />
        <meta name="author" content="Ecohierbas Chile" />
        <meta name="language" content="es" />
        <meta name="geo.region" content="CL" />
        <meta name="geo.country" content="Chile" />
        
        {/* Mobile optimization */}
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="format-detection" content="telephone=no" />
        
        {/* Structured Data */}
        <script type="application/ld+json">
          {JSON.stringify(structuredData)}
        </script>
        
        {/* Preconnect for performance */}
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="anonymous" />
        
        {/* Page template meta */}
        {template && <meta name="page-template" content={template} />}
      </Helmet>
      
      <div className={getTemplateClasses()}>
        <Header />
        <main role="main" className={`template-${template}`}>
          {children}
        </main>
        <Footer />
      </div>
    </>
  );
};

export default PageTemplate;