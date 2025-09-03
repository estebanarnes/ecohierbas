# EcoHierbas Chile - Tema WordPress

Tema WordPress completo para EcoHierbas Chile, especializado en productos orgánicos, hierbas medicinales y soluciones de vermicompostaje.

## 🚀 Características

- **Diseño Responsivo**: Completamente adaptable a todos los dispositivos
- **Integración WooCommerce**: Tienda online completa y optimizada
- **Integración WP Forms**: Formularios de contacto y cotización B2B
- **SEO Optimizado**: Meta tags, Open Graph, structured data
- **Performance**: Optimizado para velocidad y rendimiento
- **Accesibilidad**: Cumple estándares WCAG 2.1
- **Multiidioma**: Preparado para traducciones

## 📦 Instalación

### Requisitos
- WordPress 5.0 o superior
- PHP 7.4 o superior
- MySQL 5.6 o superior
- WooCommerce 5.0 o superior (recomendado)
- WP Forms plugin (recomendado)

### Pasos de Instalación

1. **Subir el tema**:
   - Descomprimir el archivo `ecohierbas-theme.zip`
   - Subir la carpeta `ecohierbas-theme` a `/wp-content/themes/`
   - O instalar desde el panel de administración: `Apariencia > Temas > Añadir nuevo > Subir tema`

2. **Activar el tema**:
   - Ir a `Apariencia > Temas`
   - Hacer clic en "Activar" en el tema EcoHierbas Chile

3. **Configurar plugins requeridos**:
   ```
   - WooCommerce (para tienda online)
   - WP Forms (para formularios)
   - Yoast SEO (recomendado para SEO)
   ```

## ⚙️ Configuración

### 1. Configuración Básica

1. **Menús de Navegación**:
   - Ir a `Apariencia > Menús`
   - Crear menú "Principal" y asignarlo a "Primary Menu"
   - Crear menú "Footer" y asignarlo a "Footer Menu"

2. **Logo y Identidad**:
   - Ir a `Apariencia > Personalizar > Identidad del sitio`
   - Subir logo personalizado
   - Configurar título y descripción del sitio

3. **Configuración del Hero**:
   - Ir a `Apariencia > Personalizar > Hero Section`
   - Personalizar título y subtítulo principal
   - Subir imagen de fondo del hero

### 2. Configuración WooCommerce

1. **Configuración Inicial**:
   ```bash
   Plugins > WooCommerce > Configuración
   - Configurar país y moneda (Chile / CLP)
   - Configurar métodos de pago
   - Configurar envíos
   ```

2. **Páginas Requeridas**:
   ```
   - Página "Tienda" (automática)
   - Página "Carrito" (automática)
   - Página "Finalizar Compra" (automática)
   - Página "Mi Cuenta" (automática)
   ```

3. **Productos**:
   - Crear categorías de productos
   - Subir productos con imágenes
   - Configurar productos destacados

### 3. Configuración WP Forms

1. **Instalar WP Forms**:
   ```
   Plugins > Añadir nuevo > Buscar "WP Forms"
   ```

2. **Crear Formularios**:
   ```
   - ID 1: Formulario de Contacto (página contacto)
   - ID 2: Formulario B2B (modal cotización)
   - ID 3: Newsletter (footer)
   ```

3. **Configurar Notificaciones**:
   - Configurar emails de notificación
   - Configurar autorespuestas

### 4. Configuración de Contacto

1. **Información de Contacto**:
   ```
   Apariencia > Personalizar > Contact Information
   - Teléfono: +56 9 1234 5678
   - Email: contacto@ecohierbaschile.cl
   - Dirección: Camino El tambo, San Vicente Tagua Tagua, VI Región, Chile
   ```

## 📄 Páginas Principales

### Páginas que debes crear:

1. **Inicio** (front-page.php):
   - Tipo: Página estática
   - Slug: home

2. **Nosotros** (page-nosotros.php):
   - Tipo: Página
   - Slug: nosotros

3. **Contacto** (page-contacto.php):
   - Tipo: Página
   - Slug: contacto

4. **Productos** (WooCommerce):
   - Automática con WooCommerce
   - Slug: shop

### Configurar página de inicio:
```
Configuración > Lectura > Una página estática
- Página de inicio: Seleccionar "Inicio"
- Página de entradas: Seleccionar "Blog" (crear si es necesario)
```

## 🎨 Personalización

### Colores del Tema
El tema usa un sistema de design tokens personalizable:

```css
:root {
  --primary: 107, 70, 50;      /* Marrón tierra */
  --accent: 212, 130, 70;      /* Naranja terracotta */
  --sage: 139, 156, 120;       /* Verde salvia */
  --earth: 161, 134, 110;      /* Tierra clara */
}
```

### Tipografías
- **Encabezados**: Playfair Display (serif)
- **Texto**: Inter (sans-serif)

### Personalizar en `Apariencia > Personalizar`:
- Colores
- Tipografías
- Hero Section
- Contact Information

## 🛒 WooCommerce

### Configuración Recomendada

1. **Productos por Página**: 12
2. **Columnas**: 3
3. **Dimensiones de Imágenes**:
   ```
   - Catálogo: 400x400px
   - Única: 800x800px
   - Miniatura: 150x150px
   ```

4. **Páginas de Productos**:
   - Usar plantilla personalizada del tema
   - Carousel 4x2 en página principal

### Categorías Sugeridas:
- Hierbas Medicinales
- Infusiones Funcionales
- Vermicomposteras
- Maceteros Ecológicos
- Kits de Cultivo

## 📧 Formularios

### Formularios Incluidos:

1. **Contacto General** (ID: 1):
   ```
   - Nombre
   - Email
   - Teléfono
   - Tipo de consulta
   - Empresa
   - Asunto
   - Mensaje
   - Newsletter checkbox
   ```

2. **Cotización B2B** (ID: 2):
   ```
   - Empresa
   - Contacto
   - Email
   - Teléfono
   - Tipo de negocio
   - Productos de interés
   - Volumen estimado
   - Mensaje
   ```

3. **Newsletter** (ID: 3):
   ```
   - Email
   ```

## 🎯 SEO

### Features Incluidas:
- Meta description automática
- Open Graph tags
- Twitter Cards
- Structured data (Schema.org)
- Canonical URLs
- Breadcrumbs (con plugin)

### Plugins Recomendados:
- Yoast SEO
- Schema Pro
- WP Rocket (cache)

## 🚀 Performance

### Optimizaciones Incluidas:
- Lazy loading de imágenes
- CSS y JS minificados
- Sprites de iconos SVG
- Optimización de consultas DB

### Plugins Recomendados:
- WP Rocket
- Smush (optimización imágenes)
- Cloudflare

## 📱 Responsive Design

### Breakpoints:
- Mobile: < 768px
- Tablet: 768px - 1024px
- Desktop: > 1024px

### Features Móviles:
- Menú hamburguesa
- Touch-friendly buttons
- Optimized images
- Fast loading

## 🔒 Seguridad

### Features Incluidas:
- Sanitización de inputs
- Nonces en formularios
- Escape de outputs
- Limitación de intentos de login

### Plugins Recomendados:
- Wordfence Security
- Limit Login Attempts
- SSL Certificate

## 📊 Analytics

### Configuración Google Analytics:
1. Instalar plugin "GA Google Analytics"
2. Configurar tracking ID
3. Configurar events para WooCommerce

### Events Trackados:
- Add to cart
- Purchase
- Form submissions
- Newsletter signup

## 🎨 Customización Avanzada

### Child Theme (Recomendado):
```php
// functions.php del child theme
<?php
function ecohierbas_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'ecohierbas_child_enqueue_styles' );
```

### Hooks Disponibles:
- `ecohierbas_before_header`
- `ecohierbas_after_header`
- `ecohierbas_before_footer`
- `ecohierbas_after_footer`

## 🐛 Troubleshooting

### Problemas Comunes:

1. **Productos no aparecen**:
   - Verificar que WooCommerce esté activo
   - Revisar configuración de productos

2. **Formularios no funcionan**:
   - Verificar que WP Forms esté activo
   - Revisar IDs de formularios

3. **Estilos no cargan**:
   - Limpiar cache
   - Verificar permisos de archivos

4. **Imágenes no aparecen**:
   - Regenerar miniaturas
   - Verificar rutas de imágenes

## 📞 Soporte

### Documentación:
- Manual completo en `/documentation/`
- Video tutoriales disponibles
- FAQ en documentación

### Contacto:
- Email: soporte@ecohierbaschile.cl
- Teléfono: +56 9 1234 5678

## 📝 Changelog

### v1.0.0 (2024-01-15)
- Lanzamiento inicial
- Integración completa WooCommerce
- Integración WP Forms
- Sistema de design tokens
- Templates responsivos
- SEO optimizado

## 📄 Licencia

Este tema está licenciado bajo GPL v2.0 o posterior.

---

**EcoHierbas Chile Theme** - Desarrollado con ❤️ para un futuro más sustentable.