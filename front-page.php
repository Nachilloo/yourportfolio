<?php
/**
 * The template for displaying the home page
 *
 * @package YourPortfolio
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Hola, soy <span class="highlight">Ignacio Galante Milicua</span></h1>
                <p class="hero-subtitle">Diseñador y Desarrollador WordPress</p>
                <p class="hero-description">Creo experiencias digitales únicas y funcionales para ayudar a marcas y personas a destacar en el mundo online.</p>
                <div class="hero-buttons">
                    <a href="#portfolio" class="button primary">Ver mi trabajo</a>
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="button secondary">Contactar</a>
                </div>
            </div>
        </div>
    </section>

    <!-- PORTFOLIO DESTACADO SECTION -->
    <section id="portfolio" class="featured-portfolio">
        <div class="container">
            <h2 class="section-title">Proyectos destacados</h2>
            <p class="section-subtitle">Algunos de mis trabajos recientes</p>
            
            <?php
            // Query para obtener proyectos destacados (puedes personalizar)
            $args = array(
                'post_type'      => 'project',
                'posts_per_page' => 6,
                'orderby'        => 'date',
                'order'          => 'DESC',
            );
            
            $proyectos_query = new WP_Query($args);
            
            if ($proyectos_query->have_posts()) : ?>
                <div class="proyectos-grid">
                    <?php while ($proyectos_query->have_posts()) : $proyectos_query->the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('proyecto-item'); ?>>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="proyecto-thumbnail">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="proyecto-info">
                                <h3 class="proyecto-titulo">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <?php if (get_field('cliente')) : ?>
                                    <div class="proyecto-cliente">
                                        <?php the_field('cliente'); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php
                                $categorias = get_the_terms(get_the_ID(), 'categoria_proyecto');
                                if ($categorias && !is_wp_error($categorias)) : ?>
                                    <div class="proyecto-categorias">
                                        <?php foreach ($categorias as $categoria) : ?>
                                            <span class="categoria"><?php echo $categoria->name; ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                        </article>
                        
                    <?php endwhile; ?>
                </div>
                
                <div class="portfolio-link">
                    <a href="<?php echo esc_url(home_url('/portfolio')); ?>" class="button secondary">Ver todos los proyectos →</a>
                </div>
                
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="no-projects">No hay proyectos publicados todavía.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- SOBRE MÍ SECTION -->
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-content">
                    <h2 class="section-title">Sobre mí</h2>
                    <p>Soy un apasionado del diseño y desarrollo web con experiencia en la creación de sitios web únicos y funcionales. Me especializo en WordPress y en crear experiencias digitales que conectan con las personas.</p>
                    <p>Mi enfoque combina la estética con la funcionalidad, asegurando que cada proyecto no solo se vea bien, sino que también cumpla con los objetivos de mis clientes.</p>
                    
                    <div class="skills">
                        <h3>Habilidades</h3>
                        <div class="skills-list">
                            <span class="skill-tag">WordPress</span>
                            <span class="skill-tag">PHP</span>
                            <span class="skill-tag">HTML5/CSS3</span>
                            <span class="skill-tag">JavaScript</span>
                            <span class="skill-tag">Diseño UI/UX</span>
                            <span class="skill-tag">Git</span>
                        </div>
                    </div>
                    
                    <a href="<?php echo esc_url(home_url('/cv')); ?>" class="button secondary">Ver mi CV completo</a>
                </div>
                <div class="about-image">
                    <?php if (has_custom_logo()) : ?>
                        <div class="custom-logo-wrapper">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <div class="placeholder-image">
                            <span>Tu foto aquí</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACTO RÁPIDO SECTION -->
    <section class="contact-cta">
        <div class="container">
            <h2 class="section-title">¿Tienes un proyecto en mente?</h2>
            <p>Hablemos sobre cómo puedo ayudarte a hacerlo realidad.</p>
            <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="button primary">Contactar ahora</a>
        </div>
    </section>

</main>

<?php
get_footer();