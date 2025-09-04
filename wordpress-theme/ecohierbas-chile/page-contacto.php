<?php
/**
 * Página de Contacto
 */
get_header(); ?>

<main class="site-main">
    <section class="py-16 md:py-24 bg-gradient-to-br from-primary/10 to-secondary/10">
        <div class="u-container text-center">
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-foreground mb-6">Contáctanos</h1>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">Estamos aquí para ayudarte con cualquier consulta.</p>
        </div>
    </section>

    <section class="py-16 md:py-24">
        <div class="u-container">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div class="space-y-8">
                    <div>
                        <h2 class="text-2xl font-serif font-bold text-foreground mb-4">Envíanos un mensaje</h2>
                    </div>
                    <form id="contact-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="first-name" class="block text-sm font-medium text-foreground mb-2">Nombre *</label>
                                <input type="text" id="first-name" name="first_name" required class="w-full px-3 py-2 border border-border rounded focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-medium text-foreground mb-2">Apellido *</label>
                                <input type="text" id="last-name" name="last_name" required class="w-full px-3 py-2 border border-border rounded focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-foreground mb-2">Email *</label>
                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-border rounded focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-foreground mb-2">Mensaje *</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-3 py-2 border border-border rounded focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>
                        <button type="submit" class="u-btn u-btn--primary w-full">Enviar Mensaje</button>
                    </form>
                </div>

                <div class="space-y-8">
                    <h2 class="text-2xl font-serif font-bold text-foreground mb-6">Información de contacto</h2>
                    <div class="space-y-6">
                         <div class="flex items-start gap-4">
                             <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                 <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                 </svg>
                             </div>
                             <div>
                                 <h3 class="font-semibold text-foreground">Teléfono</h3>
                                 <p class="text-muted-foreground">
                                     <a href="tel:+56223456789" class="hover:text-primary transition-colors">
                                         +56 2 2345 6789
                                     </a>
                                 </p>
                             </div>
                         </div>
                         <div class="flex items-start gap-4">
                             <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                 <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                 </svg>
                             </div>
                             <div>
                                 <h3 class="font-semibold text-foreground">Email</h3>
                                 <p class="text-muted-foreground">
                                     <a href="mailto:contacto@ecohierbas.cl" class="hover:text-primary transition-colors">
                                         contacto@ecohierbas.cl
                                     </a>
                                 </p>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>