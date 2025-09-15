<?php
/**
 * Template: Página Nosotros
 * 
 * @package EcoHierbas_Chile
 */

get_header(); ?>

<main class="main-content">
    
    <!-- Breadcrumbs -->
    <div class="u-container" style="padding: 1rem 0;">
        <?php ecohierbas_breadcrumbs(); ?>
    </div>

    <!-- Hero Section -->
    <section style="padding: 4rem 0; background: linear-gradient(135deg, hsl(var(--primary) / 0.05), hsl(var(--accent) / 0.05));">
        <div class="u-container">
            <div class="u-grid u-grid--cols-2" style="align-items: center; gap: 4rem;">
                <div>
                    <h1 style="font-size: 3rem; font-weight: 700; margin-bottom: 1.5rem; color: hsl(var(--foreground));">
                        Nuestra Historia
                    </h1>
                    <p style="font-size: 1.25rem; color: hsl(var(--muted-foreground)); margin-bottom: 2rem; line-height: 1.6;">
                        EcoHierbas Chile nació de la pasión por la vida sustentable y el bienestar natural. 
                        Desde nuestros inicios, nos hemos dedicado a cultivar y ofrecer productos orgánicos 
                        de la más alta calidad.
                    </p>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <div style="padding: 1rem 1.5rem; background: hsl(var(--primary) / 0.1); border-radius: var(--eco-radius-m); border-left: 4px solid hsl(var(--primary));">
                            <div style="font-size: 1.5rem; font-weight: 700; color: hsl(var(--primary));">2021</div>
                            <div style="font-size: 0.875rem; color: hsl(var(--muted-foreground));">Año de fundación</div>
                        </div>
                        <div style="padding: 1rem 1.5rem; background: hsl(var(--accent) / 0.1); border-radius: var(--eco-radius-m); border-left: 4px solid hsl(var(--accent));">
                            <div style="font-size: 1.5rem; font-weight: 700; color: hsl(var(--accent));">500+</div>
                            <div style="font-size: 0.875rem; color: hsl(var(--muted-foreground));">Clientes satisfechos</div>
                        </div>
                    </div>
                </div>
                
                <div style="position: relative;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nosotros-hero.jpg" 
                         alt="EcoHierbas Chile - Nuestra Historia" 
                         style="width: 100%; height: 400px; object-fit: cover; border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);"
                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAwIiBoZWlnaHQ9IjQwMCIgdmlld0JveD0iMCAwIDYwMCA0MDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI2MDAiIGhlaWdodD0iNDAwIiBmaWxsPSIjZjNmNGY2Ii8+CjxwYXRoIGQ9Ik0yNTAgMTUwSDM1MFYyNTBIMjUwVjE1MFoiIGZpbGw9IiNkMWQ1ZGIiLz4KPHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTggNUMzIDUgMyA5IDMgMTJTMyAxOSA4IDE5SDEyQzE3IDE5IDE5IDE5IDE5IDEyUzE3IDUgMTIgNUg4WiIgZmlsbD0iIzE2YTM0YSIvPgo8L3N2Zz4KPC9zdmc+'">
                    
                    <!-- Decoración flotante -->
                    <div style="position: absolute; top: -2rem; right: -2rem; width: 100px; height: 100px; background: hsl(var(--primary) / 0.1); border-radius: 50%; z-index: -1;"></div>
                    <div style="position: absolute; bottom: -1rem; left: -1rem; width: 60px; height: 60px; background: hsl(var(--accent) / 0.1); border-radius: 50%; z-index: -1;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Misión, Visión, Valores -->
    <section style="padding: 4rem 0;">
        <div class="u-container">
            <div class="u-text-center" style="margin-bottom: 3rem;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Nuestros Pilares
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem; max-width: 600px; margin: 0 auto;">
                    Los valores y principios que guían cada decisión y acción en EcoHierbas Chile
                </p>
            </div>
            
            <div class="u-grid u-grid--cols-3">
                <!-- Misión -->
                <div style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 4rem; height: 4rem; background: linear-gradient(135deg, hsl(var(--primary)), hsl(var(--primary) / 0.8)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5"/>
                            <path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; color: hsl(var(--primary));">Misión</h3>
                    <p style="color: hsl(var(--muted-foreground)); line-height: 1.6;">
                        Promover un estilo de vida sustentable a través de productos orgánicos de calidad, 
                        educación ambiental y soluciones innovadoras para el cuidado del planeta.
                    </p>
                </div>
                
                <!-- Visión -->
                <div style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 4rem; height: 4rem; background: linear-gradient(135deg, hsl(var(--accent)), hsl(var(--accent) / 0.8)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; color: hsl(var(--accent));">Visión</h3>
                    <p style="color: hsl(var(--muted-foreground)); line-height: 1.6;">
                        Ser la empresa líder en Chile en productos orgánicos y sustentables, 
                        inspirando a las comunidades hacia un futuro más verde y consciente.
                    </p>
                </div>
                
                <!-- Valores -->
                <div style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 4rem; height: 4rem; background: linear-gradient(135deg, hsl(var(--primary)), hsl(var(--accent))); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem; color: hsl(var(--primary));">Valores</h3>
                    <ul style="color: hsl(var(--muted-foreground)); line-height: 1.6; text-align: left; list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">• Sustentabilidad</li>
                        <li style="margin-bottom: 0.5rem;">• Calidad orgánica</li>
                        <li style="margin-bottom: 0.5rem;">• Transparencia</li>
                        <li style="margin-bottom: 0.5rem;">• Compromiso social</li>
                        <li>• Innovación verde</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Nuestro Proceso -->
    <section style="padding: 4rem 0; background: hsl(var(--muted) / 0.3);">
        <div class="u-container">
            <div class="u-text-center" style="margin-bottom: 3rem;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Nuestro Proceso
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem;">
                    Desde la semilla hasta tu hogar, cada paso está cuidadosamente diseñado para garantizar la máxima calidad
                </p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <!-- Paso 1 -->
                <div style="position: relative; text-align: center; padding: 2rem 1rem;">
                    <div style="width: 3rem; height: 3rem; background: hsl(var(--primary)); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-weight: 700; font-size: 1.25rem;">1</div>
                    <h4 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.75rem;">Cultivo Orgánico</h4>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem; line-height: 1.5;">
                        Utilizamos técnicas de agricultura orgánica, sin pesticidas ni fertilizantes químicos.
                    </p>
                    
                    <!-- Conector -->
                    <div style="position: absolute; top: 1.5rem; right: -1rem; width: 2rem; height: 2px; background: hsl(var(--border)); display: none; lg:block;"></div>
                </div>
                
                <!-- Paso 2 -->
                <div style="position: relative; text-align: center; padding: 2rem 1rem;">
                    <div style="width: 3rem; height: 3rem; background: hsl(var(--accent)); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-weight: 700; font-size: 1.25rem;">2</div>
                    <h4 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.75rem;">Cosecha Cuidadosa</h4>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem; line-height: 1.5;">
                        Recolectamos en el momento óptimo para preservar las propiedades nutricionales.
                    </p>
                    
                    <div style="position: absolute; top: 1.5rem; right: -1rem; width: 2rem; height: 2px; background: hsl(var(--border)); display: none; lg:block;"></div>
                </div>
                
                <!-- Paso 3 -->
                <div style="position: relative; text-align: center; padding: 2rem 1rem;">
                    <div style="width: 3rem; height: 3rem; background: hsl(var(--primary)); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-weight: 700; font-size: 1.25rem;">3</div>
                    <h4 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.75rem;">Procesamiento Natural</h4>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem; line-height: 1.5;">
                        Secado y procesamiento con métodos naturales que conservan todos los nutrientes.
                    </p>
                    
                    <div style="position: absolute; top: 1.5rem; right: -1rem; width: 2rem; height: 2px; background: hsl(var(--border)); display: none; lg:block;"></div>
                </div>
                
                <!-- Paso 4 -->
                <div style="text-align: center; padding: 2rem 1rem;">
                    <div style="width: 3rem; height: 3rem; background: hsl(var(--accent)); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-weight: 700; font-size: 1.25rem;">4</div>
                    <h4 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 0.75rem;">Entrega Sustentable</h4>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem; line-height: 1.5;">
                        Empaque ecológico y envío con el menor impacto ambiental posible.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Equipo -->
    <section style="padding: 4rem 0;">
        <div class="u-container">
            <div class="u-text-center" style="margin-bottom: 3rem;">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Nuestro Equipo
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem;">
                    Profesionales apasionados por la sustentabilidad y el bienestar natural
                </p>
            </div>
            
            <div class="u-grid u-grid--cols-3">
                <!-- Miembro del equipo 1 -->
                <div style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 120px; height: 120px; background: linear-gradient(135deg, hsl(var(--primary) / 0.2), hsl(var(--accent) / 0.2)); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg width="48" height="48" fill="none" stroke="hsl(var(--primary))" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">María González</h3>
                    <p style="color: hsl(var(--accent)); font-weight: 500; margin-bottom: 1rem;">Fundadora & CEO</p>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem; line-height: 1.5;">
                        Ingeniera Agrónoma con más de 10 años de experiencia en agricultura orgánica y sustentabilidad.
                    </p>
                </div>
                
                <!-- Miembro del equipo 2 -->
                <div style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 120px; height: 120px; background: linear-gradient(135deg, hsl(var(--accent) / 0.2), hsl(var(--primary) / 0.2)); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg width="48" height="48" fill="none" stroke="hsl(var(--accent))" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">Carlos Rodríguez</h3>
                    <p style="color: hsl(var(--primary)); font-weight: 500; margin-bottom: 1rem;">Director de Producción</p>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem; line-height: 1.5;">
                        Especialista en procesos orgánicos y control de calidad, garantizando la excelencia en cada producto.
                    </p>
                </div>
                
                <!-- Miembro del equipo 3 -->
                <div style="text-align: center; padding: 2rem; background: hsl(var(--card)); border-radius: var(--eco-radius-l); box-shadow: var(--eco-shadow-card);">
                    <div style="width: 120px; height: 120px; background: linear-gradient(135deg, hsl(var(--primary) / 0.2), hsl(var(--accent) / 0.2)); border-radius: 50%; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg width="48" height="48" fill="none" stroke="hsl(var(--primary))" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem;">Ana Martínez</h3>
                    <p style="color: hsl(var(--accent)); font-weight: 500; margin-bottom: 1rem;">Nutricionista</p>
                    <p style="color: hsl(var(--muted-foreground)); font-size: 0.875rem; line-height: 1.5;">
                        Experta en fitoterapia y nutrición natural, asegurando el valor nutricional de nuestros productos.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section style="padding: 4rem 0; background: linear-gradient(135deg, hsl(var(--primary) / 0.1), hsl(var(--accent) / 0.1));">
        <div class="u-container">
            <div class="u-text-center">
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: hsl(var(--foreground));">
                    Únete a Nuestra Comunidad Sustentable
                </h2>
                <p style="color: hsl(var(--muted-foreground)); font-size: 1.125rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Descubre cómo puedes formar parte del cambio hacia un estilo de vida más natural y consciente con el medio ambiente.
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn btn-primary">
                        Ver Nuestros Productos
                    </a>
                    <a href="<?php echo get_permalink(get_page_by_path('contacto')); ?>" class="btn btn-secondary">
                        Contáctanos
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>