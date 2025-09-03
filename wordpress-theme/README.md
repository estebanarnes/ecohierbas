# Tema WordPress Ecohierbas

Tema WordPress completo para Ecohierbas - especialistas en huerta urbana, maceteros y vermicompostaje.

## 🌱 Características

- **Diseño Responsivo**: Optimizado para dispositivos móviles, tablets y desktop
- **Integración WooCommerce**: Soporte completo para tienda online
- **Integración WP Forms**: Formularios de contacto profesionales
- **SEO Optimizado**: Meta tags, Open Graph, y estructura semántica
- **Personalizable**: Opciones de customizer para modificar contenido fácilmente
- **Performance**: Código optimizado y carga rápida

## 📦 Instalación

1. **Descargar el tema**:
   - Comprimir toda la carpeta `wordpress-theme` en un archivo .zip
   - Renombrar el archivo a `ecohierbas-theme.zip`

2. **Subir a WordPress**:
   ```
   WordPress Admin → Apariencia → Temas → Añadir nuevo → Subir tema
   ```

3. **Activar el tema**:
   - Hacer clic en "Activar" después de la instalación

## 🔧 Configuración Inicial

### Plugins Requeridos

Instalar y activar estos plugins para funcionalidad completa:

```bash
- WooCommerce (para e-commerce)
- WP Forms (para formularios de contacto)  
- Yoast SEO (opcional, para SEO avanzado)
- Contact Form 7 (alternativa a WP Forms)
```

### Configuración del Customizer

Ve a **Apariencia → Personalizar**:

1. **Sección Hero**:
   - Título Principal
   - Subtítulo  
   - Texto del Botón
   - URL del Botón

2. **Sección de Contacto**:
   - ID del Formulario WP Forms

### Configuración de Menús

1. **Crear Menús**:
   ```
   Apariencia → Menús → Crear un nuevo menú
   ```

2. **Asignar Ubicaciones**:
   - **Menú Principal**: Para la navegación header
   - **Menú Footer**: Para enlaces en el footer

### Configuración de Widgets

Ve a **Apariencia → Widgets** y configura:

- **Footer 1**: Información de la empresa
- **Footer 2**: Enlaces rápidos
- **Footer 3**: Categorías de productos

## 🛍️ Configuración WooCommerce

### 1. Configuración Básica
```
WooCommerce → Configuración → General
- Dirección de la tienda
- Moneda (ARS para Argentina)
- Ubicación de venta
```

### 2. Productos Destacados
```
Productos → Todos los productos → Editar producto
- Marcar checkbox "Producto destacado"
```

### 3. Categorías de Productos
```
Productos → Categorías
- Crear categorías: Maceteros, Semillas, Vermicompostaje, etc.
- Agregar imágenes a las categorías
```

## 📝 Configuración WP Forms

### 1. Crear Formulario de Contacto
```
WP Forms → Añadir nuevo
- Usar plantilla "Simple Contact Form"
- Personalizar campos según necesidades
```

### 2. Configurar Campos Recomendados
```
- Nombre (requerido)
- Email (requerido)  
- Teléfono (opcional)
- Mensaje (requerido)
```

### 3. Obtener ID del Formulario
```
WP Forms → Todos los formularios
- Copiar el ID del formulario
- Pegar en Customizer → Sección de Contacto
```

## 🎨 Personalización

### Colores del Tema

Los colores principales están definidos en `style.css`:

```css
/* Colores principales */
--primary-color: #2d5a27;    /* Verde principal */
--secondary-color: #4a7c59;  /* Verde secundario */
--accent-color: #ffffff;     /* Blanco/Acentos */
--text-color: #333333;       /* Texto principal */
```

### Fuentes

El tema usa fuentes del sistema para mejor rendimiento:
```css
font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
```

### Imágenes Recomendadas

- **Logo**: 200x60px (PNG transparente)
- **Hero Image**: 1200x600px
- **Productos**: 300x300px (cuadradas)
- **Categorías**: 400x250px

## 📱 Responsive Design

El tema incluye breakpoints para:
- **Desktop**: 1200px+
- **Tablet**: 768px - 1199px  
- **Mobile**: 320px - 767px

## ⚡ Performance

### Optimizaciones Incluidas

- CSS minificado en producción
- Lazy loading para imágenes
- Carga diferida de JavaScript no crítico
- Optimización de consultas a la base de datos

### Recomendaciones Adicionales

1. **Plugin de Cache**: WP Rocket, W3 Total Cache
2. **CDN**: Cloudflare, MaxCDN
3. **Optimización de Imágenes**: Smush, ShortPixel

## 🔍 SEO Features

### Incluidas en el Tema
```html
- Meta tags optimizados
- Open Graph para redes sociales  
- Twitter Cards
- Schema.org structured data
- URLs limpias y semánticas
- Breadcrumbs (si el plugin está activo)
```

### Configuración Recomendada
```
- Yoast SEO plugin
- Google Analytics
- Google Search Console
- Sitemap XML automático
```

## 🛠️ Desarrollo

### Estructura de Archivos
```
wordpress-theme/
├── style.css              # Estilos principales + header del tema
├── index.php              # Template principal  
├── functions.php          # Funciones del tema
├── header.php             # Header común
├── footer.php             # Footer común
├── front-page.php         # Página de inicio
├── page.php               # Template para páginas
├── single.php             # Template para posts
├── archive.php            # Template para archivos
├── search.php             # Resultados de búsqueda
├── searchform.php         # Formulario de búsqueda
├── 404.php                # Página de error 404
├── js/theme.js            # JavaScript del tema
└── README.md              # Esta documentación
```

### Hooks Personalizados

El tema incluye estos action hooks:
```php
- ecohierbas_before_header
- ecohierbas_after_header  
- ecohierbas_before_footer
- ecohierbas_after_footer
```

### Filtros Personalizados
```php
- ecohierbas_excerpt_length
- ecohierbas_hero_title
- ecohierbas_contact_form_id
```

## 🐛 Solución de Problemas

### Problema: No aparecen productos destacados
**Solución**: 
1. Ir a Productos → Todos los productos
2. Editar productos y marcar "Producto destacado"
3. Limpiar cache si está activo

### Problema: Formulario de contacto no aparece
**Solución**:
1. Verificar que WP Forms esté instalado y activo
2. Crear un formulario en WP Forms
3. Configurar el ID en Customizer → Sección de Contacto

### Problema: Menú no aparece
**Solución**:
1. Ir a Apariencia → Menús
2. Crear un nuevo menú
3. Asignar a "Menú Principal" en ubicaciones

### Problema: Estilos no se aplican
**Solución**:
1. Limpiar cache del navegador (Ctrl+F5)
2. Limpiar cache del plugin de cache
3. Verificar que no hay conflictos con otros plugins

## 📞 Soporte

Para problemas específicos del tema:

1. **Verificar documentación**: Revisar este README
2. **Comprobar plugins**: Desactivar todos los plugins temporalmente
3. **Revisar consola**: Buscar errores JavaScript en la consola del navegador
4. **Logs de WordPress**: Revisar wp-content/debug.log

## 📄 Licencia

Este tema está licenciado bajo GPL v2 o posterior.

## 🔄 Actualizaciones

Para mantener el tema actualizado:

1. **Respaldar**: Siempre hacer backup antes de actualizar
2. **Probar**: Usar un entorno de staging si es posible
3. **Personalizar**: Usar un tema hijo para personalizaciones

---

**¡Listo para cultivar tu presencia digital!** 🌱