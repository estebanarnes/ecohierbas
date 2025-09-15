# EcoHierbas Chile - Tema WordPress

Tema WordPress personalizado para EcoHierbas Chile, optimizado para productos orgánicos y e-commerce con WooCommerce.

## 🚀 Instalación

1. **Subir el tema:**
   - Comprimir la carpeta `ecohierbas-theme` en un archivo ZIP
   - WordPress Admin → Apariencia → Temas → Añadir nuevo → Subir tema
   - Seleccionar el archivo ZIP y hacer clic en "Instalar ahora"

2. **Activar el tema:**
   - Hacer clic en "Activar" después de la instalación

## 📋 Requisitos

### Plugins Necesarios:
- **WooCommerce** - Para funcionalidad de e-commerce
- **WPForms** - Para formularios de contacto
- **WordPress SEO** (opcional) - Para SEO avanzado

### Configuración Recomendada:
- WordPress 5.8 o superior
- PHP 7.4 o superior
- MySQL 5.6 o superior

## ⚙️ Configuración Inicial

### 1. Menús
- Ir a Apariencia → Menús
- Crear menú "Principal" y asignarlo a "Menú Principal"
- Agregar páginas: Inicio, Nosotros, Productos, Contacto

### 2. WooCommerce
- Configurar WooCommerce siguiendo el asistente
- Crear categorías de productos
- Subir productos y marcar algunos como "Destacados"

### 3. WPForms
- Crear formulario de contacto (ID: 1)
- Crear formulario de cotización B2B (ID: 2)

### 4. Páginas Requeridas
- Crear página "Nosotros" (slug: nosotros)
- Crear página "Contacto" (slug: contacto)

## 🎨 Personalización

### Colores y Diseño
Los colores del tema se pueden personalizar editando las variables CSS en `style.css`:

```css
:root {
  --eco-color-primary: 142 69% 40%;    /* Verde principal */
  --eco-color-accent: 33 82% 55%;      /* Color de acento */
  /* ... más variables */
}
```

### Funciones Disponibles
- `ecohierbas_get_featured_products($limit)` - Obtener productos destacados
- `ecohierbas_get_product_categories()` - Obtener categorías de productos
- `[ecohierbas_contact_form]` - Shortcode para formulario de contacto

## 📱 Características

✅ **Responsive Design** - Optimizado para móviles y tablets  
✅ **WooCommerce Compatible** - Integración completa con tienda online  
✅ **SEO Optimizado** - Meta tags, Schema.org, Open Graph  
✅ **Carrito AJAX** - Funcionalidad de carrito sin recargar página  
✅ **Formularios Integrados** - Conexión con WPForms  
✅ **Animaciones CSS** - Transiciones suaves y animaciones  
✅ **Performance Optimizado** - Carga rápida y código limpio  

## 🛠️ Soporte

Para soporte técnico o consultas sobre el tema:
- Email: soporte@ecohierbaschile.cl
- Documentación: Incluida en comentarios del código

## 📄 Licencia

Este tema está desarrollado específicamente para EcoHierbas Chile.
Todos los derechos reservados © 2024 EcoHierbas Chile.