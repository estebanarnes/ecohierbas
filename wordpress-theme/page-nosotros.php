<?php
/**
 * Template Name: Nosotros
 * 
 * Página sobre EcoHierbas Chile
 */
get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/nosotros-hero.jpg'); height: 60vh;">
        <div class="hero-overlay"></div>
        <div class="hero-content u-container">
            <h1 class="hero-title" style="font-size: 3rem;">Sobre EcoHierbas Chile</h1>
            <p class="hero-subtitle">
                Somos una empresa familiar dedicada a la agricultura orgánica y a la producción 
                de hierbas medicinales desde 2015.
            </p>
        </div>
    </section>

    <!-- Nuestra Historia -->
    <section class="section">
        <div class="u-container">
            <div class="u-grid u-grid-cols-2" style="align-items: center; gap: 4rem;">
                <div>
                    <span class="section-badge">Nuestra Historia</span>
                    <h2 class="section-title">Un sueño que comenzó en 2015</h2>
                    <p style="font-size: 1.125rem; line-height: 1.7; margin-bottom: 1.5rem;">
                        Comenzamos en 2015 con un pequeño huerto familiar en Pudahuel, 
                        Región Metropolitana, con la visión de llevar productos orgánicos 
                        y naturales a las familias chilenas.
                    </p>
                    <p style="line-height: 1.7; margin-bottom: 1.5rem;">
                        Lo que empezó como un proyecto personal se ha convertido en una empresa 
                        que hoy abastece a más de cien empresas y miles de familias a lo largo 
                        de todo Chile, manteniendo siempre nuestro compromiso con la calidad 
                        y la sustentabilidad.
                    </p>
                    <p style="line-height: 1.7;">
                        Cada producto que ofrecemos refleja nuestra pasión por la agricultura 
                        responsable y nuestro compromiso con el bienestar de nuestros clientes 
                        y el medio ambiente.
                    </p>
                </div>
                <div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/historia-familia.jpg" 
                         alt="Historia de EcoHierbas Chile" 
                         style="width: 100%; border-radius: 1rem; box-shadow: var(--eco-shadow-lg);">
                </div>
            </div>
        </div>
    </section>

    <!-- Nuestros Valores -->
    <section class="section" style="background-color: var(--eco-bg-secondary);">
        <div class="u-container">
            <div class="section-header">
                <span class="section-badge">Nuestros Valores</span>
                <h2 class="section-title">Los principios que nos guían</h2>
                <p class="section-description">
                    Cada decisión que tomamos está fundamentada en valores sólidos que definen 
                    quiénes somos y hacia dónde vamos.
                </p>
            </div>
            
            <div class="u-grid u-grid-cols-3">
                <div class="u-card">
                    <div style="width: 60px; height: 60px; background: rgba(74, 222, 128, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-primary);">
                            <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.375rem; margin-bottom: 1rem; color: var(--eco-text);">Sustentabilidad</h3>
                    <p style="color: var(--eco-text-light); line-height: 1.6;">
                        Implementamos prácticas agrícolas que respetan el medio ambiente, 
                        promoviendo la biodiversidad y el uso responsable de los recursos naturales.
                    </p>
                </div>
                
                <div class="u-card">
                    <div style="width: 60px; height: 60px; background: rgba(74, 222, 128, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-primary);">
                            <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.375rem; margin-bottom: 1rem; color: var(--eco-text);">Calidad</h3>
                    <p style="color: var(--eco-text-light); line-height: 1.6;">
                        Todos nuestros productos son certificados y seleccionados a mano, 
                        garantizando los más altos estándares de calidad en cada entrega.
                    </p>
                </div>
                
                <div class="u-card">
                    <div style="width: 60px; height: 60px; background: rgba(74, 222, 128, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                        <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-primary);">
                            <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.375rem; margin-bottom: 1rem; color: var(--eco-text);">Comunidad</h3>
                    <p style="color: var(--eco-text-light); line-height: 1.6;">
                        Apoyamos a productores locales y promovemos la educación ambiental, 
                        fortaleciendo las comunidades donde operamos.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nuestro Equipo -->
    <section class="section">
        <div class="u-container">
            <div class="section-header">
                <span class="section-badge">Nuestro Equipo</span>
                <h2 class="section-title">Las personas detrás de EcoHierbas</h2>
                <p class="section-description">
                    Un equipo apasionado y comprometido con la misión de llevar productos 
                    naturales y sustentables a cada hogar chileno.
                </p>
            </div>
            
            <div class="u-grid u-grid-cols-3">
                <div class="u-card" style="text-align: center;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-1.jpg" 
                         alt="Fundador" 
                         style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin: 0 auto 1.5rem;">
                    <h3 style="margin-bottom: 0.5rem;">Carlos Mendoza</h3>
                    <p style="color: var(--eco-primary); font-weight: 500; margin-bottom: 1rem;">Fundador y CEO</p>
                    <p style="color: var(--eco-text-light); line-height: 1.6;">
                        Ingeniero Agrónomo con más de 15 años de experiencia en agricultura orgánica. 
                        Visionario y líder del proyecto EcoHierbas.
                    </p>
                </div>
                
                <div class="u-card" style="text-align: center;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-2.jpg" 
                         alt="Directora de Operaciones" 
                         style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin: 0 auto 1.5rem;">
                    <h3 style="margin-bottom: 0.5rem;">María González</h3>
                    <p style="color: var(--eco-primary); font-weight: 500; margin-bottom: 1rem;">Directora de Operaciones</p>
                    <p style="color: var(--eco-text-light); line-height: 1.6;">
                        Especialista en gestión de cadenas de suministro sustentables. 
                        Asegura la calidad en cada etapa del proceso productivo.
                    </p>
                </div>
                
                <div class="u-card" style="text-align: center;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team-3.jpg" 
                         alt="Jefe de Investigación" 
                         style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin: 0 auto 1.5rem;">
                    <h3 style="margin-bottom: 0.5rem;">Dr. Ana Rodríguez</h3>
                    <p style="color: var(--eco-primary); font-weight: 500; margin-bottom: 1rem;">Jefa de Investigación</p>
                    <p style="color: var(--eco-text-light); line-height: 1.6;">
                        Doctora en Ciencias Naturales. Lidera el desarrollo de nuevos productos 
                        y la investigación de propiedades medicinales.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería -->
    <section class="section" style="background-color: var(--eco-bg-secondary);">
        <div class="u-container">
            <div class="section-header">
                <span class="section-badge">Galería</span>
                <h2 class="section-title">Un vistazo a nuestras instalaciones</h2>
                <p class="section-description">
                    Conoce nuestros cultivos, procesos de producción y las instalaciones 
                    donde trabajamos día a día.
                </p>
            </div>
            
            <div class="u-grid u-grid-cols-3" style="gap: 1.5rem;">
                <div style="position: relative; overflow: hidden; border-radius: 1rem; box-shadow: var(--eco-shadow); transition: transform 0.3s ease;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cultivo-1.jpg" 
                         alt="Cultivos de hierbas medicinales" 
                         style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 1.5rem;">
                        <h4 style="margin-bottom: 0.5rem;">Cultivos Orgánicos</h4>
                        <p style="font-size: 0.875rem; opacity: 0.9;">Hierbas medicinales cultivadas con amor y dedicación</p>
                    </div>
                </div>
                
                <div style="position: relative; overflow: hidden; border-radius: 1rem; box-shadow: var(--eco-shadow); transition: transform 0.3s ease;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/productos-2.jpg" 
                         alt="Productos terminados" 
                         style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 1.5rem;">
                        <h4 style="margin-bottom: 0.5rem;">Productos Terminados</h4>
                        <p style="font-size: 0.875rem; opacity: 0.9;">Selección cuidadosa y empaque sustentable</p>
                    </div>
                </div>
                
                <div style="position: relative; overflow: hidden; border-radius: 1rem; box-shadow: var(--eco-shadow); transition: transform 0.3s ease;">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/taller-3.jpg" 
                         alt="Talleres educativos" 
                         style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,0.7)); color: white; padding: 1.5rem;">
                        <h4 style="margin-bottom: 0.5rem;">Talleres Educativos</h4>
                        <p style="font-size: 0.875rem; opacity: 0.9;">Compartiendo conocimiento sobre sustentabilidad</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Certificaciones -->
    <section class="section">
        <div class="u-container">
            <div class="section-header">
                <span class="section-badge">Certificaciones</span>
                <h2 class="section-title">Reconocimientos que nos avalan</h2>
                <p class="section-description">
                    Nuestro compromiso con la calidad y la sustentabilidad está respaldado 
                    por importantes certificaciones nacionales e internacionales.
                </p>
            </div>
            
            <div style="display: flex; justify-content: center; align-items: center; gap: 4rem; flex-wrap: wrap;">
                <div style="text-align: center;">
                    <div style="width: 100px; height: 100px; background: rgba(74, 222, 128, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; border: 2px solid rgba(74, 222, 128, 0.2);">
                        <svg width="50" height="50" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-primary);">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h4 style="margin-bottom: 0.5rem;">Certificación Orgánica</h4>
                    <p style="color: var(--eco-text-light); font-size: 0.875rem;">SAG Chile</p>
                </div>
                
                <div style="text-align: center;">
                    <div style="width: 100px; height: 100px; background: rgba(74, 222, 128, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; border: 2px solid rgba(74, 222, 128, 0.2);">
                        <svg width="50" height="50" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-primary);">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h4 style="margin-bottom: 0.5rem;">ISO 9001</h4>
                    <p style="color: var(--eco-text-light); font-size: 0.875rem;">Gestión de Calidad</p>
                </div>
                
                <div style="text-align: center;">
                    <div style="width: 100px; height: 100px; background: rgba(74, 222, 128, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; border: 2px solid rgba(74, 222, 128, 0.2);">
                        <svg width="50" height="50" fill="currentColor" viewBox="0 0 24 24" style="color: var(--eco-primary);">
                            <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 style="margin-bottom: 0.5rem;">Empresa B</h4>
                    <p style="color: var(--eco-text-light); font-size: 0.875rem;">Impacto Social</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="section" style="background: linear-gradient(135deg, var(--eco-primary) 0%, var(--eco-accent) 100%); color: white;">
        <div class="u-container u-text-center">
            <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: white;">
                ¿Quieres conocer más sobre nosotros?
            </h2>
            <p style="font-size: 1.25rem; margin-bottom: 2rem; opacity: 0.9;">
                Visita nuestras instalaciones o contáctanos para una propuesta personalizada.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/contacto')); ?>" 
                   class="u-btn" 
                   style="background: white; color: var(--eco-primary); border: none;">
                    Contactar
                </a>
                <a href="<?php echo esc_url(home_url('/productos')); ?>" 
                   class="u-btn" 
                   style="background: transparent; color: white; border: 2px solid white;">
                    Ver Productos
                </a>
            </div>
        </div>
    </section>
</main>

<style>
/* Hover effects para la galería */
.u-grid > div:hover img {
    transform: scale(1.05);
}

.u-grid > div:hover {
    transform: translateY(-5px);
}

/* Animaciones para las certificaciones */
@keyframes certFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.u-container > div:last-child > div:hover > div:first-child {
    animation: certFloat 2s ease-in-out infinite;
}
</style>

<?php get_footer(); ?>