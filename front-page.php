<?php
/**
 * The template for displaying the home page
 *
 * @package YourPortfolio
 */

get_header();

// OBTENER TODOS LOS CAMPOS DE ACF (option)
$hero_title = get_field('hero_title', 'option');
$hero_subtitle = get_field('hero_subtitle', 'option');
$hero_description = get_field('hero_description', 'option');
$btn_primary_text = get_field('hero_btn_primary_text', 'option');
$btn_primary_url = get_field('hero_btn_primary_url', 'option');
$btn_secondary_text = get_field('hero_btn_secondary_text', 'option');
$btn_secondary_url = get_field('hero_btn_secondary_url', 'option');

// Sobre mí
$about_title = get_field('about_title', 'option');
$about_content = get_field('about_content', 'option');
$about_image = get_field('about_image', 'option');

// Skills
$skills = get_field('skills', 'option');

// Proyectos destacados
$featured_title = get_field('featured_title', 'option');
$featured_subtitle = get_field('featured_subtitle', 'option');
$featured_count = get_field('featured_count', 'option') ?: 6;
?>

<main id="primary" class="site-main">
    
    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    <?php echo $hero_title ?: 'Hola, soy <span class="highlight">Ignacio Galante Milicua</span>'; ?>
                </h1>
                
                <?php if ($hero_subtitle) : ?>
                    <p class="hero-subtitle"><?php echo $hero_subtitle; ?></p>
                <?php endif; ?>
                
                <?php if ($hero_description) : ?>
                    <p class="hero-description"><?php echo $hero_description; ?></p>
                <?php endif; ?>
                
                <div class="hero-buttons">
                    <?php if ($btn_primary_text) : ?>
                        <a href="<?php echo esc_url($btn_primary_url ?: '#portfolio'); ?>" class="button primary">
                            <?php echo $btn_primary_text; ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($btn_secondary_text) : ?>
                        <a href="<?php echo esc_url($btn_secondary_url ?: home_url('/contacto')); ?>" class="button secondary">
                            <?php echo $btn_secondary_text; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- PORTFOLIO DESTACADO SECTION -->
    <section id="portfolio" class="featured-portfolio">
        <div class="container">
            <h2 class="section-title"><?php echo $featured_title ?: 'Proyectos destacados'; ?></h2>
            
            <?php if ($featured_subtitle) : ?>
                <p class="section-subtitle"><?php echo $featured_subtitle; ?></p>
            <?php endif; ?>
            
            <?php
            // Query para obtener proyectos destacados
            $args = array(
                'post_type'      => 'project',
                'posts_per_page' => $featured_count,
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
                                    <div class="proyecto-overlay">
                                        <span class="proyecto-overlay-titulo"><?php the_title(); ?></span>
                                    </div>
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
                    <h2 class="section-title"><?php echo $about_title ?: 'Sobre mí'; ?></h2>
                    
                    <?php if ($about_content) : ?>
                        <?php echo wpautop($about_content); ?>
                    <?php else : ?>
                        <p>Soy un apasionado del diseño y desarrollo web con experiencia en la creación de sitios web únicos y funcionales. Me especializo en WordPress y en crear experiencias digitales que conectan con las personas.</p>
                        <p>Mi enfoque combina la estética con la funcionalidad, asegurando que cada proyecto no solo se vea bien, sino que también cumpla con los objetivos de mis clientes.</p>
                    <?php endif; ?>
                    
                    <?php if ($skills) : ?>
                        <div class="skills">
                            <h3>Habilidades</h3>
                            <div class="skills-list">
                                <?php foreach ($skills as $skill) : ?>
                                    <span class="skill-tag">
                                        <?php echo $skill['skill_name']; ?>
                                        <?php if (!empty($skill['skill_level'])) : ?>
                                            <span class="skill-level">(<?php echo $skill['skill_level']; ?>%)</span>
                                        <?php endif; ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php else : ?>
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
                    <?php endif; ?>
                    
                    <a href="<?php echo esc_url(home_url('/cv')); ?>" class="button secondary">Ver mi CV completo</a>
                </div>
                <div class="about-image">
                    <?php if ($about_image) : ?>
                        <img src="<?php echo esc_url($about_image['url']); ?>" 
                             alt="<?php echo esc_attr($about_image['alt']); ?>"
                             class="about-profile-image">
                    <?php elseif (has_custom_logo()) : ?>
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
            <h2 class="section-title"><?php echo get_field('contact_cta_title', 'option') ?: '¿Tienes un proyecto en mente?'; ?></h2>
            <p><?php echo get_field('contact_cta_text', 'option') ?: 'Hablemos sobre cómo puedo ayudarte a hacerlo realidad.'; ?></p>
            <a href="<?php echo esc_url(get_field('contact_cta_url', 'option') ?: home_url('/contacto')); ?>" class="button primary">
                <?php echo get_field('contact_cta_button', 'option') ?: 'Contactar ahora'; ?>
            </a>
        </div>
    </section>

</main>

<?php
get_footer();