# EcoHierbas Chile - Instalación Completa

## 🚀 INSTALACIÓN INMEDIATA

### Paso 1: Subir Tema
```bash
# Comprimir la carpeta del tema
zip -r ecohierbas-chile.zip wordpress-theme/ecohierbas-chile/

# En WordPress Admin:
# 1. Ir a Apariencia > Temas
# 2. Clic en "Añadir nuevo"
# 3. Clic en "Subir tema"
# 4. Seleccionar ecohierbas-chile.zip
# 5. Clic en "Instalar ahora"
# 6. Clic en "Activar"
```

### Paso 2: Instalar Plugins Requeridos
```
Plugins OBLIGATORIOS:
✅ WooCommerce (para tienda)
✅ Contact Form 7 (para formularios)

Plugins RECOMENDADOS:
- Yoast SEO (SEO optimizado)
- WP Super Cache (velocidad)
- Wordfence Security (seguridad)
```

### Paso 3: Configurar Contenido

#### Crear Páginas Principales:
1. **Inicio**: Página estática (usar front-page.php)
2. **Nosotros**: Página con contenido personalizado
3. **Productos**: Página de tienda WooCommerce  
4. **Contacto**: Página con formulario
5. **Checkout**: Página de checkout WooCommerce

#### Configurar Menús:
```
WordPress Admin > Apariencia > Menús

Menú Principal (Ubicación: primary):
- Inicio
- Nosotros  
- Productos
- Contacto

Menú Footer (Ubicación: footer):
- Términos y Condiciones
- Política de Privacidad
- FAQ
```

#### Configurar WooCommerce:
```
WooCommerce > Configuración:

GENERAL:
- Moneda: Peso chileno (CLP)
- País: Chile
- Unidad de peso: kg

ENVÍO:
- Zona de envío: Chile
- Métodos configurados automáticamente

PAGOS:
- Transferencia bancaria ✅
- Tarjetas de crédito (si tienes gateway)
```

### Paso 4: Personalizar Tema

#### Opciones del Tema:
```
Apariencia > Opciones EcoHierbas

Configurar:
- Teléfono de contacto
- Email de contacto  
- Dirección física
- URLs redes sociales
- Número WhatsApp
```

#### Logo y Colores:
```
Apariencia > Personalizar

- Subir logo personalizado
- Los colores están predefinidos en el design system
- Configurar título y tagline del sitio
```

### Paso 5: Agregar Productos

#### Crear Categorías:
```
Productos > Categorías:

- Infusiones
  - Subcategoría: Relajación
  - Subcategoría: Digestivo  
  - Subcategoría: Piel
  - Subcategoría: Masculina

- Vermicompostaje
- Maceteros
```

#### Agregar Productos de Ejemplo:
```
Productos > Añadir nuevo

Ejemplo - Producto Infusión:
- Nombre: "Box Especial Mujer - Refresca tu Piel"
- Precio regular: $29.990
- Precio de oferta: $24.990
- Categoría: Infusiones > Piel
- Imágenes: Subir desde assets/
- Descripción corta: Para formulario
- Descripción: Detalles completos
- SKU: ECO-001
```

## ⚡ VERIFICACIÓN POST-INSTALACIÓN

### Lista de Verificación:
```
□ Tema activado correctamente
□ Logo visible en header
□ Menús funcionando
□ WooCommerce configurado
□ Productos creados y visibles
□ Formulario de contacto funcionando
□ Carrito de compras operativo
□ Responsive design en móvil
□ Velocidad de carga < 3 segundos
□ SEO básico configurado
```

### URLs Importantes a Verificar:
```
- / (página inicio)
- /nosotros (página nosotros)
- /shop (productos WooCommerce)  
- /contacto (formulario contacto)
- /cart (carrito)
- /checkout (finalizar compra)
```

## 🔧 SOLUCIÓN DE PROBLEMAS

### Problema: "Tema no carga correctamente"
```
SOLUCIÓN:
1. Verificar todos los archivos se subieron
2. Verificar permisos de carpetas (755)
3. Revisar error_log de WordPress
4. Desactivar otros plugins temporalmente
```

### Problema: "Estilos no cargan"
```
SOLUCIÓN:
1. Limpiar caché del navegador
2. Ir a Apariencia > Personalizar y guardar
3. Verificar que app.css existe en assets/css/
4. Verificar file permissions
```

### Problema: "WooCommerce no funciona"
```
SOLUCIÓN:
1. Reinstalar WooCommerce
2. Ir a WooCommerce > Estado > Herramientas
3. Limpiar caché de productos
4. Verificar que las páginas de WooCommerce existen
```

### Problema: "Carrito no funciona"
```
SOLUCIÓN:
1. Verificar que cart.js se carga
2. Abrir consola de desarrollador
3. Buscar errores JavaScript
4. Verificar que localStorage funciona
```

## 📞 SOPORTE

Si tienes problemas durante la instalación:

1. **Revisar logs**: `/wp-content/debug.log`
2. **Verificar requisitos**: PHP 8.0+, WordPress 6.0+
3. **Deshabilitar plugins**: Para identificar conflictos
4. **Usar tema por defecto**: Para comparar comportamiento

## 🎯 PRÓXIMOS PASOS

Una vez instalado:

1. **Contenido**: Agregar productos reales
2. **SEO**: Optimizar metadatos y descripciones  
3. **Analytics**: Instalar Google Analytics
4. **Velocidad**: Configurar caché y CDN
5. **Seguridad**: SSL y medidas adicionales
6. **Backup**: Configurar copias de seguridad

---

**✅ INSTALACIÓN COMPLETADA**

Tu sitio EcoHierbas Chile ya está listo para usar con todas las funcionalidades del diseño original React migradas a WordPress.