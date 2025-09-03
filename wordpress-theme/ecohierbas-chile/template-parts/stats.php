<?php
/**
 * Template Part: Stats Section
 * Replica exactamente el componente StatsSection.tsx
 */
?>

<section class="py-16 md:py-24 bg-primary/5 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23059669\" fill-opacity=\"0.3\"><circle cx=\"7\" cy=\"7\" r=\"7\"/></g></g></svg>'); background-size: 60px 60px;"></div>
    </div>

    <div class="u-container relative z-10">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-foreground mb-6">
                <?php esc_html_e('EcoHierbas en Números', 'ecohierbas'); ?>
            </h2>
            <p class="text-xl text-muted-foreground max-w-3xl mx-auto">
                <?php esc_html_e('Más de una década construyendo confianza y transformando vidas a través de productos naturales.', 'ecohierbas'); ?>
            </p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Stat 1: Años de Experiencia -->
            <div class="text-center group">
                <div class="bg-background rounded-2xl p-8 shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-primary mb-2" data-count="10">10+</div>
                    <div class="text-lg font-semibold text-foreground mb-2"><?php esc_html_e('Años', 'ecohierbas'); ?></div>
                    <div class="text-sm text-muted-foreground"><?php esc_html_e('de experiencia en el mercado', 'ecohierbas'); ?></div>
                </div>
            </div>

            <!-- Stat 2: Clientes Satisfechos -->
            <div class="text-center group">
                <div class="bg-background rounded-2xl p-8 shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                    <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-accent mb-2" data-count="5000">5K+</div>
                    <div class="text-lg font-semibold text-foreground mb-2"><?php esc_html_e('Clientes', 'ecohierbas'); ?></div>
                    <div class="text-sm text-muted-foreground"><?php esc_html_e('satisfechos en todo Chile', 'ecohierbas'); ?></div>
                </div>
            </div>

            <!-- Stat 3: Productos -->
            <div class="text-center group">
                <div class="bg-background rounded-2xl p-8 shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                    <div class="w-16 h-16 bg-secondary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-secondary mb-2" data-count="200">200+</div>
                    <div class="text-lg font-semibold text-foreground mb-2"><?php esc_html_e('Productos', 'ecohierbas'); ?></div>
                    <div class="text-sm text-muted-foreground"><?php esc_html_e('naturales y orgánicos', 'ecohierbas'); ?></div>
                </div>
            </div>

            <!-- Stat 4: Satisfacción -->
            <div class="text-center group">
                <div class="bg-background rounded-2xl p-8 shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:-translate-y-2">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-4xl font-bold text-primary mb-2" data-count="98">98%</div>
                    <div class="text-lg font-semibold text-foreground mb-2"><?php esc_html_e('Satisfacción', 'ecohierbas'); ?></div>
                    <div class="text-sm text-muted-foreground"><?php esc_html_e('de nuestros clientes', 'ecohierbas'); ?></div>
                </div>
            </div>
        </div>

        <!-- Testimonial -->
        <div class="mt-16 text-center">
            <div class="bg-background rounded-2xl p-8 max-w-4xl mx-auto shadow-lg">
                <div class="flex justify-center mb-6">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    <?php endfor; ?>
                </div>
                <blockquote class="text-xl italic text-muted-foreground mb-6">
                    "<?php esc_html_e('EcoHierbas ha transformado mi relación con la alimentación natural. Sus productos son de calidad excepcional y el servicio al cliente es incomparable.', 'ecohierbas'); ?>"
                </blockquote>
                <cite class="text-lg font-semibold text-foreground">
                    <?php esc_html_e('María González', 'ecohierbas'); ?>
                    <span class="text-sm text-muted-foreground block"><?php esc_html_e('Cliente desde 2019', 'ecohierbas'); ?></span>
                </cite>
            </div>
        </div>
    </div>
</section>

<script>
// Animación de contadores
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('[data-count]');
                counters.forEach(counter => {
                    const target = parseInt(counter.dataset.count);
                    const increment = target / 100;
                    let current = 0;
                    
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            counter.textContent = target + (counter.textContent.includes('+') ? '+' : counter.textContent.includes('%') ? '%' : '');
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(current) + (counter.textContent.includes('+') ? '+' : counter.textContent.includes('%') ? '%' : '');
                        }
                    }, 20);
                });
                
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const statsSection = document.querySelector('[data-count]')?.closest('section');
    if (statsSection) {
        observer.observe(statsSection);
    }
});
</script>