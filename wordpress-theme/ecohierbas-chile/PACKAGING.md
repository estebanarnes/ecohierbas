# 📦 PACKAGING Y DISTRIBUCIÓN

## 🚀 Crear ZIP del Tema

```bash
# Desde la raíz del proyecto
cd wordpress-theme/

# Crear ZIP completo (excluyendo archivos innecesarios)
zip -r ecohierbas-chile-v1.0.0.zip ecohierbas-chile/ \
  --exclude="ecohierbas-chile/node_modules/*" \
  --exclude="ecohierbas-chile/.git/*" \
  --exclude="ecohierbas-chile/.DS_Store" \
  --exclude="ecohierbas-chile/src/*" \
  --exclude="ecohierbas-chile/*.log"

# Verificar contenido del ZIP
unzip -l ecohierbas-chile-v1.0.0.zip
```

## 📁 Estructura Final del ZIP

```
ecohierbas-chile/
├── style.css                     # CSS principal con header tema
├── functions.php                  # Configuración y hooks
├── index.php                      # Plantilla base
├── front-page.php                # Página inicio
├── header.php                     # Header global
├── footer.php                     # Footer global
├── archive-product.php            # Listado productos
├── single-product.php             # Producto individual
├── page-nosotros.php             # Página nosotros
├── page-contacto.php             # Página contacto
├── page-checkout.php             # Checkout personalizado
├── search.php                     # Resultados búsqueda
├── 404.php                        # Página error
├── inc/
│   ├── setup.php                 # Configuración tema
│   ├── assets.php                # Enqueue CSS/JS
│   └── products.php              # Adaptador WooCommerce
├── template-parts/
│   ├── hero.php                  # Sección hero
│   ├── featured-products.php     # Productos destacados
│   ├── product-card.php          # Tarjeta producto
│   ├── modal-product.php         # Modal vista rápida
│   └── cart-sidebar.php          # Drawer carrito
├── assets/
│   ├── css/
│   │   └── app.css               # CSS compilado
│   └── js/
│       ├── utils.js              # Utilidades base
│       ├── cart.js               # Funcionalidad carrito
│       ├── modals.js             # Manejo modales
│       └── filters.js            # Filtros productos
├── README.md                      # Documentación completa
├── CHECKLIST-QA.md              # Lista verificación
└── screenshot.png                # Captura para admin WP
```

## 🔧 Comandos de Build

### Desarrollo Local
```bash
# Instalar dependencias (si usas build tools)
npm install

# Compilar CSS (si usas Tailwind/PostCSS)
npm run build:css

# Compilar/minificar JS
npm run build:js

# Build completo
npm run build
```

### Producción
```bash
# Build optimizado para producción
npm run build:prod

# Generar ZIP de distribución
npm run package

# Verificar tema (usando WP-CLI)
wp theme install ecohierbas-chile-v1.0.0.zip --activate
```

## 📋 Pre-entrega Checklist

Antes de crear el ZIP final:

- [ ] **Versión actualizada** en style.css
- [ ] **Assets compilados** y minificados
- [ ] **README.md completo** con instrucciones
- [ ] **Screenshot.png** del tema (1200x900px)
- [ ] **Sin archivos de desarrollo** (node_modules, .git, logs)
- [ ] **Probado en WordPress limpio**
- [ ] **WooCommerce configurado y funcional**
- [ ] **Todos los AJAX endpoints funcionan**
- [ ] **Responsive design verificado**
- [ ] **Accesibilidad básica probada**

## 🎯 Entregables Finales

1. **ecohierbas-chile-v1.0.0.zip** - Tema listo para instalar
2. **README.md** - Instrucciones completas
3. **CHECKLIST-QA.md** - Lista de verificación
4. **Documentación de APIs** - Endpoints AJAX y hooks

## ⚡ Instalación Rápida del Cliente

```bash
# 1. Subir ZIP a WordPress
# WordPress Admin > Apariencia > Temas > Añadir nuevo > Subir tema

# 2. Activar tema
# WordPress Admin > Apariencia > Temas > Activar "EcoHierbas Chile"

# 3. Instalar WooCommerce
# WordPress Admin > Plugins > Añadir nuevo > Buscar "WooCommerce"

# 4. Configurar productos básicos
# WooCommerce > Productos > Añadir nuevo

# 5. Configurar páginas
# Crear páginas: Nosotros, Contacto, Checkout

# ✅ LISTO - Sitio funcional en ~15 minutos
```

**🎉 TEMA WORDPRESS COMPLETO Y LISTO PARA PRODUCCIÓN**