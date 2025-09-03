# EcoHierbas Chile - WordPress Theme

## Descripción
Tema personalizado para EcoHierbas Chile, especializado en productos ecológicos y sustentables. Compatible con WooCommerce y optimizado para ventas online.

## Características
- ✅ Diseño responsive y moderno
- ✅ Integración completa con WooCommerce
- ✅ Compatibilidad con WP Forms
- ✅ Optimizado para SEO
- ✅ Animaciones y efectos visuales
- ✅ Sección de testimonios personalizada
- ✅ Sistema de talleres y workshops
- ✅ Formularios B2B integrados
- ✅ Carrito de compras AJAX

## Requisitos del Sistema
- WordPress 5.0 o superior
- PHP 7.4 o superior
- WooCommerce (recomendado)
- WP Forms (para formularios de contacto)

## Instalación

### Opción 1: Panel de Administración de WordPress
1. Ve a `Apariencia > Temas` en tu panel de WordPress
2. Haz clic en "Añadir nuevo"
3. Selecciona "Subir tema"
4. Sube el archivo `ecohierbas-theme.zip`
5. Activa el tema

### Opción 2: FTP/CPanel
1. Extrae el contenido del archivo ZIP
2. Sube la carpeta `ecohierbas-theme` a `/wp-content/themes/`
3. Ve a `Apariencia > Temas` y activa "EcoHierbas Chile"

## Configuración Inicial

### 1. Menús de Navegación
- Ve a `Apariencia > Menús`
- Crea un menú llamado "Primary"
- Añade las páginas: Inicio, Nosotros, Productos, Contacto
- Asigna el menú a la ubicación "Primary Menu"

### 2. Páginas Requeridas
Crea las siguientes páginas con estos slugs exactos:
- `nosotros` - Página "Acerca de nosotros"
- `contacto` - Página de contacto
- `productos` - Página de productos (WooCommerce)

### 3. WooCommerce
- Instala y configura WooCommerce
- El tema incluye plantillas personalizadas para productos
- Los productos destacados aparecerán en la página principal

### 4. Formularios (WP Forms)
- Instala WP Forms
- Crea un formulario de contacto con ID #1
- Crea un formulario B2B con ID #2

### 5. Customizer
Ve a `Apariencia > Personalizar` para configurar:
- **Sección Hero**: Título y subtítulo de la página principal
- **Información de Contacto**: Teléfono, email y dirección

## Funcionalidades Especiales

### Custom Post Types
El tema incluye dos tipos de contenido personalizado:

#### Testimonios
- Nombre del cliente
- Empresa
- Rol/Cargo
- Calificación (1-5 estrellas)
- Producto relacionado

#### Talleres/Workshops
- Fecha y hora
- Duración
- Precio
- Capacidad máxima

### Shortcodes Disponibles
- `[ecohierbas_testimonials]` - Muestra testimonios
- `[ecohierbas_workshops]` - Muestra próximos talleres
- `[ecohierbas_featured_products]` - Productos destacados

### AJAX Features
- Carrito de compras sin recargar página
- Carga de productos por categorías
- Filtros de productos en tiempo real

## Personalización

### Colores del Tema
Los colores principales están definidos en variables CSS:
- Verde principal: `#52c152`
- Verde oscuro: `#2d5a2d`
- Gris texto: `#666666`

### Tipografía
- Fuente principal: Inter (Google Fonts)
- Fallback: System fonts

### Imágenes Recomendadas
- Logo: 200x60px (transparente)
- Productos: 400x400px
- Hero image: 1200x600px
- Testimonios: 80x80px (circular)

## Estructura de Archivos
```
ecohierbas-theme/
├── style.css (Información del tema)
├── functions.php (Funciones principales)
├── index.php (Plantilla por defecto)
├── front-page.php (Página principal)
├── header.php (Cabecera)
├── footer.php (Pie de página)
├── page.php (Páginas genéricas)
├── page-nosotros.php (Página "Nosotros")
├── page-contacto.php (Página "Contacto")
├── single.php (Entradas individuales)
├── 404.php (Página de error)
├── assets/
│   ├── css/
│   │   ├── responsive.css
│   │   └── wordpress.css
│   └── js/
│       ├── main.js
│       └── woocommerce.js
└── woocommerce/
    ├── archive-product.php
    ├── single-product.php
    └── content-product.php
```

## Soporte y Actualizaciones
- Versión actual: 1.0.0
- Compatible con WordPress 6.4+
- Testado con WooCommerce 8.0+

## Licencia
GPL v2 or later

## Créditos
Desarrollado para EcoHierbas Chile
Tema personalizado basado en las mejores prácticas de WordPress