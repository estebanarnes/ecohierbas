# EcoHierbas Chile - Tema WordPress

Migración pixel-perfect desde React + Vite a tema WordPress con WooCommerce.

## 🚀 INSTALACIÓN RÁPIDA

1. **Subir e instalar tema:**
   ```bash
   # Comprimir tema
   zip -r ecohierbas-chile.zip wordpress-theme/ecohierbas-chile/
   # Subir en: WordPress Admin > Apariencia > Temas > Añadir nuevo
   ```

2. **Activar y configurar:**
   - Activar tema "EcoHierbas Chile"
   - Instalar/activar WooCommerce
   - Configurar productos y categorías

3. **Crear páginas obligatorias:**
   - Nosotros (slug: `nosotros`)
   - Contacto (slug: `contacto`) 
   - Checkout personalizado (slug: `checkout`)

## ⚙️ CONFIGURACIÓN WOOCOMMERCE

1. **Productos:**
   - Crear atributo "Finalidad" (pa_finalidad)
   - Configurar categorías de productos
   - Subir imágenes para productos

2. **Ajustes:**
   - Moneda: Peso Chileno (CLP)
   - Formato precio: sin decimales
   - Activar carrito y checkout

## 🎯 FUNCIONALIDADES

- ✅ Carrito lateral con persistencia
- ✅ Modales de vista rápida 
- ✅ Filtros de productos (categoría, precio, orden)
- ✅ Formularios de contacto y B2B
- ✅ Diseño responsive idéntico al React
- ✅ Accesibilidad (focus trap, aria-live)

## 📁 ESTRUCTURA FINAL

```
ecohierbas-chile/
├── style.css                    # CSS principal + tokens
├── functions.php                # Configuración tema
├── inc/
│   ├── setup.php               # Setup y hooks
│   ├── assets.php              # Enqueue CSS/JS
│   └── products.php            # Adaptador WooCommerce
├── assets/
│   ├── css/app.css             # CSS compilado
│   └── js/                     # JavaScript UI
├── template-parts/             # Componentes reutilizables
└── pages/                      # Plantillas específicas
```

## 🧪 CHECKLIST QA

### Páginas principales:
- [ ] **Home** - Hero, productos destacados, beneficios
- [ ] **Productos** - Grid, filtros, paginación funcionan
- [ ] **Producto individual** - Galería, stock, añadir carrito
- [ ] **Nosotros** - Información empresa
- [ ] **Contacto** - Formulario y datos
- [ ] **Checkout** - Proceso compra WooCommerce

### Funcionalidades:
- [ ] **Carrito** - Añadir/quitar/actualizar cantidades
- [ ] **Modales** - Vista rápida productos, focus trap
- [ ] **Filtros** - Categoría, precio, búsqueda
- [ ] **Responsive** - Mobile, tablet, desktop
- [ ] **Accesibilidad** - Navegación teclado, aria-live

### Performance:
- [ ] **Loading** - Imágenes lazy, CSS/JS minificado
- [ ] **SEO** - Meta tags, structured data
- [ ] **Sin errores** - Console limpio, PHP sin notices

## 🔧 TROUBLESHOOTING

**Error: "No se encuentran productos"**
- Verificar que WooCommerce está activo
- Crear productos con categorías

**Carrito no funciona:**
- Verificar AJAX habilitado
- Check nonces en ecohierbas_ajax

**Filtros no responden:**
- Verificar taxonomías WooCommerce
- Check endpoints AJAX

## 📦 PACKAGING

```bash
# Generar ZIP instalable
cd wordpress-theme/
zip -r ecohierbas-chile-v1.0.0.zip ecohierbas-chile/ \
  --exclude="ecohierbas-chile/node_modules/*" \
  --exclude="ecohierbas-chile/.git/*"
```

**Compatibilidad:** WordPress 6.0+, PHP 8.0+, WooCommerce 7.0+