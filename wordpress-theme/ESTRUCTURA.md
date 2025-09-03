wordpress-theme/
└── ecohierbas-chile/
    ├── style.css                    ✅ (tokens CSS + header tema)
    ├── functions.php                ✅ (configuración principal)
    ├── index.php                    ✅ (plantilla base)
    ├── front-page.php              ✅ (página inicio)
    ├── header.php                   ✅ (header global)
    ├── footer.php                   ✅ (footer global)
    ├── archive-product.php          ⬜️ (página productos - WooCommerce)
    ├── single-product.php           ⬜️ (producto individual)
    ├── page-nosotros.php            ⬜️ (página nosotros)
    ├── page-contacto.php            ⬜️ (página contacto)
    ├── page-checkout.php            ⬜️ (checkout personalizado)
    ├── search.php                   ⬜️ (resultados búsqueda)
    ├── 404.php                      ⬜️ (página no encontrada)
    ├── inc/
    │   ├── setup.php                ✅ (configuración tema)
    │   ├── assets.php               ✅ (gestión CSS/JS)
    │   ├── products.php             ✅ (adaptador WooCommerce)
    │   ├── rest.php                 ⬜️ (endpoints REST custom)
    │   └── shortcodes.php           ⬜️ (shortcodes específicos)
    ├── template-parts/
    │   ├── hero.php                 ⬜️ (sección hero)
    │   ├── featured-products.php    ⬜️ (productos destacados)
    │   ├── benefits.php             ⬜️ (sección beneficios)
    │   ├── stats.php                ⬜️ (sección estadísticas)
    │   ├── reviews.php              ⬜️ (sección reseñas)
    │   ├── workshops.php            ⬜️ (sección talleres)
    │   ├── product-card.php         ⬜️ (tarjeta producto)
    │   ├── modal-product.php        ⬜️ (modal producto)
    │   ├── cart-sidebar.php         ⬜️ (sidebar carrito)
    │   ├── offers-popup.php         ⬜️ (popup ofertas)
    │   └── b2b-quote-modal.php      ⬜️ (modal cotización B2B)
    ├── assets/
    │   ├── css/
    │   │   ├── app.css              ⬜️ (CSS compilado final)
    │   │   ├── woocommerce.css      ⬜️ (estilos WooCommerce)
    │   │   └── admin.css            ⬜️ (estilos admin)
    │   ├── js/
    │   │   ├── main.js              ⬜️ (JavaScript principal)
    │   │   ├── cart.js              ⬜️ (funcionalidad carrito)
    │   │   ├── modals.js            ⬜️ (gestión modales)
    │   │   ├── filters.js           ⬜️ (filtros productos)
    │   │   ├── utils.js             ⬜️ (utilidades JS)
    │   │   └── admin.js             ⬜️ (admin JavaScript)
    │   └── img/
    │       ├── ecohierbas-logo.png  ⬜️ (logo principal)
    │       ├── hero-ecohierbas.jpg  ⬜️ (imagen hero)
    │       ├── productos-hierbas.jpg ⬜️ (imagen productos)
    │       ├── vermicompostaje.jpg  ⬜️ (imagen vermicompostaje)
    │       └── maceteros-kits.jpg   ⬜️ (imagen maceteros)
    ├── languages/
    │   ├── ecohierbas.pot           ⬜️ (archivo traducciones)
    │   └── es_ES.po                 ⬜️ (traducciones español)
    ├── screenshot.png               ⬜️ (captura tema)
    └── README.md                    ⬜️ (documentación)

## Mapeo React → WordPress confirmado

| Ruta React | Plantilla WordPress | Template Parts | Funcionalidad |
|------------|-------------------|----------------|---------------|
| `/` | `front-page.php` | hero, featured-products, benefits, stats, reviews, workshops | Página inicio completa |
| `/nosotros` | `page-nosotros.php` | hero personalizado | Página sobre nosotros |
| `/productos` | `archive-product.php` | product-card, modal-product | Catálogo productos WooCommerce |
| `/productos/[slug]` | `single-product.php` | modal-product | Producto individual |
| `/contacto` | `page-contacto.php` | formularios contacto | Página contacto |
| `/checkout` | `page-checkout.php` | cart-sidebar | Checkout personalizado |
| `*` | `404.php` | - | Página no encontrada |

## Estados y componentes críticos

**Carrito (CartContext equivalente):**
- Persistencia: sessionStorage/localStorage
- Sincronía: WooCommerce REST API
- Estados: items[], totalItems, totalPrice, isOpen

**Modales (modal management):**
- Focus trap con aria-hidden
- Scroll lock en body
- Animaciones CSS idénticas al React

**Filtros productos:**
- Categorías WooCommerce
- Precio (rangos)
- Atributo "finalidad"
- Búsqueda por nombre

**Assets críticos pendientes:**
- Copiar imágenes desde src/assets/
- Compilar CSS final con tokens
- Implementar JavaScript modular