# Integración WordPress Headless + React

Este proyecto ha sido convertido en un tema de WordPress headless que se conecta con WordPress/WooCommerce para gestión de contenido y productos.

## 🏗️ Arquitectura

```
Frontend (React)  ←→  WordPress Backend  ←→  WooCommerce
      ↓                      ↓                   ↓
  - Templating         - Contenido CMS      - Productos
  - UI Components      - Posts/Pages       - Categorías  
  - User Experience    - Medios            - Pedidos
                       - WP Forms          - Inventario
```

## 📋 Configuración Requerida

### 1. WordPress Backend Setup

#### Plugins Necesarios:
```bash
- WooCommerce (para e-commerce)
- WP Forms (para formularios de contacto)
- JWT Authentication for WP REST API (opcional, para auth)
- Advanced Custom Fields (opcional, para campos personalizados)
```

#### APIs a Habilitar:
```bash
- WordPress REST API (wp-json/wp/v2/)
- WooCommerce REST API (wp-json/wc/v3/)
- WP Forms API (wp-json/wpforms/v1/)
```

### 2. Variables de Entorno

Copiar `src/env.example` a `.env.local` y configurar:

```env
# WordPress/WooCommerce Configuration
REACT_APP_WORDPRESS_URL=https://tu-sitio-wordpress.com
REACT_APP_WC_CONSUMER_KEY=ck_tu_consumer_key_aqui
REACT_APP_WC_CONSUMER_SECRET=cs_tu_consumer_secret_aqui

# WP Forms Configuration  
REACT_APP_WPFORMS_API_KEY=tu_wp_forms_api_key_aqui
```

### 3. WooCommerce API Setup

1. **Generar API Keys:**
   - WordPress Admin → WooCommerce → Settings → Advanced → REST API
   - Crear nueva key con permisos "Read/Write"
   - Copiar Consumer Key y Consumer Secret

2. **Configurar CORS:**
   Agregar a `wp-config.php`:
   ```php
   header("Access-Control-Allow-Origin: http://localhost:5173");
   header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
   header("Access-Control-Allow-Headers: Content-Type, Authorization");
   ```

### 4. WP Forms Setup

1. **Crear Formulario de Contacto:**
   - WordPress Admin → WP Forms → Add New
   - Usar template "Simple Contact Form"
   - Configurar campos según `WPContactForm.tsx`
   - Copiar Form ID para la configuración

2. **Habilitar API:**
   - WP Forms → Settings → Integrations → REST API
   - Generar API Key

## 🎨 Sistema de Plantillas

### Plantillas Disponibles:

- **`home`** - Página de inicio
- **`about`** - Página "Nosotros"
- **`products`** - Catálogo de productos
- **`contact`** - Página de contacto
- **`blog`** - Blog/Noticias
- **`shop`** - Tienda WooCommerce
- **`default`** - Plantilla por defecto

### Uso de Plantillas:

```tsx
import { useWordPressTemplate } from '@/hooks/useWordPress';
import PageTemplate from '@/components/templates/PageTemplate';

const MiPagina = () => {
  const { data: page, template } = useWordPressTemplate('mi-slug');
  
  return (
    <PageTemplate page={page} template={template}>
      {/* Contenido específico */}
    </PageTemplate>
  );
};
```

## 🛍️ Integración WooCommerce

### Productos Destacados:
```tsx
import { useWooCommerce } from '@/hooks/useWooCommerce';

const { useFeaturedProducts } = useWooCommerce();
const { data: products, isLoading } = useFeaturedProducts();
```

### Catálogo de Productos:
```tsx
const { useProducts, useCategories } = useWooCommerce();
const { data: products } = useProducts({ 
  per_page: 50,
  status: 'publish'
});
```

### Carrito de Compras:
```tsx
import { useWCProductAdapter } from '@/hooks/useWooCommerce';

const { convertWCProductToCartItem } = useWCProductAdapter();
const cartItem = convertWCProductToCartItem(wcProduct);
addItem(cartItem);
```

## 📝 Formularios WP Forms

### Formulario de Contacto:
```tsx
import WPContactForm from '@/components/forms/WPContactForm';

<WPContactForm 
  formId={1} 
  title="Contáctanos"
  subtitle="Consultas y soporte"
/>
```

### Envío de Datos:
```tsx
import { useWPForms } from '@/hooks/useWordPress';

const { useSubmitForm } = useWPForms();
const submitForm = useSubmitForm();

await submitForm.mutateAsync({ 
  formId: 1, 
  formData: {
    '1': nombre,
    '2': email,
    '3': mensaje
  }
});
```

## 🔧 Servicios Disponibles

### WordPress API (`src/services/wordpress.ts`):
- `wpApi.getPosts()` - Obtener posts
- `wpApi.getPages()` - Obtener páginas
- `wpApi.getMedia()` - Obtener medios
- `wpFormsApi.submitForm()` - Enviar formulario

### WooCommerce API (`src/services/woocommerce.ts`):
- `wooApi.getProducts()` - Obtener productos
- `wooApi.getCategories()` - Obtener categorías
- `wooApi.createOrder()` - Crear pedido
- `wooApi.getCustomer()` - Obtener cliente

## 🎯 SEO Optimizado

Cada página incluye automáticamente:

- **Meta tags** optimizados
- **Open Graph** para redes sociales
- **Twitter Cards**
- **Schema.org** structured data
- **Canonical URLs**
- **Mobile optimization**

```tsx
<PageTemplate 
  customSEO={{
    title: 'Mi Página - Ecohierbas',
    description: 'Descripción optimizada para SEO',
    keywords: 'palabra1, palabra2, palabra3'
  }}
>
```

## 🚀 Despliegue

### Desarrollo:
```bash
npm run dev
```

### Producción:
```bash
npm run build
```

### Variables de Entorno en Producción:
Configurar en tu hosting las mismas variables del archivo `.env.local`

## 📦 Estructura de Archivos

```
src/
├── services/
│   ├── wordpress.ts      # API WordPress
│   └── woocommerce.ts    # API WooCommerce
├── hooks/
│   ├── useWordPress.ts   # Hooks WordPress
│   └── useWooCommerce.ts # Hooks WooCommerce
├── components/
│   ├── templates/
│   │   └── PageTemplate.tsx  # Template principal
│   └── forms/
│       └── WPContactForm.tsx # Formulario WP
└── pages/
    ├── Index.tsx         # Página inicio
    ├── Productos.tsx     # Catálogo productos
    └── Contacto.tsx      # Página contacto
```

## 🔄 Flujo de Datos

1. **Contenido**: WordPress CMS → React Frontend
2. **Productos**: WooCommerce → React Catalog
3. **Formularios**: React → WP Forms → WordPress
4. **Pedidos**: React Cart → WooCommerce Orders
5. **SEO**: WordPress Meta → React Head

## 🛠️ Próximos Pasos

1. **Configurar WordPress backend**
2. **Instalar plugins requeridos**
3. **Generar API keys**
4. **Configurar variables de entorno**
5. **Crear formularios en WP Forms**
6. **Subir productos a WooCommerce**
7. **Personalizar templates según necesidades**

## 🆘 Soporte

Para problemas o dudas sobre la integración:
- Revisar logs de WordPress
- Verificar API keys y permisos
- Comprobar CORS configuration
- Validar estructura de formularios WP Forms