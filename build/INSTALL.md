# Instrucciones de Instalación - EcoHierbas Chile Theme

## 📦 Instalación del Tema WordPress

### Método 1: Panel de Administración (Recomendado)

1. **Accede a tu panel de WordPress**
   - Ve a tu sitio: `tudominio.com/wp-admin`
   - Ingresa tus credenciales de administrador

2. **Sube el tema**
   - Ve a `Apariencia → Temas`
   - Haz clic en "Añadir nuevo"
   - Selecciona "Subir tema"
   - Selecciona el archivo `ecohierbas-theme.zip`
   - Haz clic en "Instalar ahora"

3. **Activa el tema**
   - Una vez instalado, haz clic en "Activar"

### Método 2: FTP/CPanel

1. **Extrae el archivo**
   - Descomprime `ecohierbas-theme.zip`
   - Tendrás una carpeta llamada `ecohierbas-theme`

2. **Sube por FTP**
   - Conecta a tu servidor por FTP
   - Ve a `/public_html/wp-content/themes/`
   - Sube la carpeta `ecohierbas-theme`

3. **Activa desde WordPress**
   - Ve a `Apariencia → Temas`
   - Busca "EcoHierbas Chile"
   - Haz clic en "Activar"

## 🔧 Configuración Obligatoria

### 1. Plugins Requeridos

Instala estos plugins antes de configurar:

```
WooCommerce (para la tienda)
WP Forms Lite (para formularios)
```

**Instalación de plugins:**
- Ve a `Plugins → Añadir nuevo`
- Busca cada plugin por nombre
- Instala y activa

### 2. Configurar Menús

1. **Crear el menú principal**
   - Ve a `Apariencia → Menús`
   - Crea un nuevo menú llamado "Primary"
   - Añade estas páginas en orden:
     - Inicio (enlace personalizado: `/`)
     - Nosotros
     - Productos
     - Contacto
   - Asigna a "Primary Menu"

### 3. Crear Páginas Obligatorias

Crea estas páginas con estos slugs exactos:

**Página "Nosotros"**
- Título: "Nosotros"
- Slug: `nosotros`
- Plantilla: Automática

**Página "Contacto"**
- Título: "Contacto"
- Slug: `contacto`
- Plantilla: Automática

**Página "Productos"** (si usas WooCommerce)
- WooCommerce crea esto automáticamente

### 4. Configurar WooCommerce

1. **Ejecutar el asistente**
   - Ve a `WooCommerce → Configuración`
   - Sigue el asistente de configuración
   - Configura moneda (CLP - Peso Chileno)
   - Configura métodos de pago

2. **Páginas de WooCommerce**
   - Tienda: `/productos`
   - Carrito: `/carrito`
   - Finalizar compra: `/checkout`
   - Mi cuenta: `/mi-cuenta`

### 5. Configurar WP Forms

1. **Crear formulario de contacto**
   - Ve a `WP Forms → Añadir nuevo`
   - Selecciona plantilla "Formulario de contacto simple"
   - Personaliza campos según necesites
   - Guarda (anota el ID del formulario)

2. **Crear formulario B2B**
   - Crea otro formulario para cotizaciones B2B
   - Incluye campos como: empresa, RUT, volumen requerido
   - Guarda (anota el ID)

3. **Actualizar IDs en el tema**
   - Si los IDs no son 1 y 2, edita:
   - `functions.php` líneas donde aparece `wpforms_display(1)` y `wpforms_display(2)`

## 🎨 Personalización del Tema

### 1. Customizer

Ve a `Apariencia → Personalizar`:

**Sección Hero:**
- Título principal
- Subtítulo
- Texto del botón

**Información de Contacto:**
- Teléfono
- Email
- Dirección

**Logo:**
- Sube tu logo (recomendado: 200x60px PNG transparente)

### 2. Colores y Estilos

Para cambiar colores, edita `style.css`:
```css
/* Color principal */
:root {
  --primary-color: #52c152;
  --primary-dark: #2d5a2d;
}
```

### 3. Contenido de Ejemplo

**Testimonios:**
- Ve a `Testimonios → Añadir nuevo`
- Completa todos los campos personalizados
- Aparecerán automáticamente en la página principal

**Talleres:**
- Ve a `Talleres → Añadir nuevo`
- Configura fecha, precio, capacidad
- Se mostrarán en orden cronológico

## 🛡️ Configuración de Seguridad

### 1. Permisos de Archivos (CPanel)

Configura estos permisos:
```
Carpetas: 755
Archivos: 644
wp-config.php: 600
```

### 2. Backup

Antes de hacer cambios importantes:
- Respalda la base de datos
- Respalda la carpeta `/wp-content/`

## 🚀 Optimización

### 1. Plugins Recomendados

```
Yoast SEO (para SEO)
W3 Total Cache (para velocidad)
Wordfence Security (para seguridad)
UpdraftPlus (para backups)
```

### 2. Configuración de Caché

Si instalas W3 Total Cache:
- Activa "Page Cache"
- Activa "Minify" para CSS y JS
- Configura CDN si tienes uno

## ❗ Solución de Problemas

### Tema no aparece
- Verifica que la carpeta esté en `/wp-content/themes/`
- Verifica permisos de archivos
- Revisa que `style.css` tenga la información del tema

### Formularios no funcionan
- Verifica que WP Forms esté instalado y activo
- Revisa los IDs de formularios en el código
- Verifica configuración de email en WordPress

### Productos no aparecen
- Verifica que WooCommerce esté activo
- Crea algunos productos de prueba
- Ve a `WooCommerce → Configuración → Productos`

### Estilos no cargan
- Ve a `Apariencia → Editor de temas`
- Verifica que los archivos CSS estén presentes
- Limpia caché del navegador

## 📞 Soporte

Si tienes problemas:

1. **Revisa los logs de error**
   - CPanel → Archivos de error
   - WordPress → Herramientas → Salud del sitio

2. **Verifica requisitos**
   - PHP 7.4+ requerido
   - WordPress 5.0+ requerido
   - Plugins obligatorios instalados

3. **Backup antes de cambios**
   - Siempre respalda antes de modificar código
   - Usa un entorno de pruebas si es posible

---

## ✅ Lista de Verificación Post-Instalación

- [ ] Tema activado correctamente
- [ ] WooCommerce instalado y configurado
- [ ] WP Forms instalado
- [ ] Menú principal creado y asignado
- [ ] Páginas obligatorias creadas
- [ ] Logo subido en Customizer
- [ ] Información de contacto configurada
- [ ] Formularios de contacto funcionando
- [ ] Productos de prueba creados
- [ ] Testimonios de ejemplo añadidos
- [ ] Responsividad verificada en móvil
- [ ] Velocidad de carga optimizada
- [ ] SEO básico configurado

**¡Tu tema EcoHierbas Chile está listo para usar! 🌱**