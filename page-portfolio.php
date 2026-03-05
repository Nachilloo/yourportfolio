<?php
/**
 * Template Name: Página Portfolio
 * Description: Muestra todos los proyectos en un grid
 *
 * @package YourPortfolio
 */

get_header();

// Configuración de la paginación
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

// Query personalizado para obtener TODOS los proyectos
$proyectos = new WP_Query(array(
    'post_type' => 'project',
    'posts_per_page' => 9, // Número de proyectos por página
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC'
));
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <!-- Cabecera de la página -->
        <header class="portfolio-page-header">
            <h1 class="portfolio-page-title"><?php the_title(); ?></h1>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="portfolio-page-description">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; endif; ?>
        </header>

        <?php if ($proyectos->have_posts()) : ?>
            
            <!-- Contador de proyectos -->
            <div class="portfolio-stats">
                <p><?php echo $proyectos->found_posts; ?> proyectos encontrados</p>
            </div>

            <!-- Grid de proyectos -->
            <div class="proyectos-grid">
                <?php while ($proyectos->have_posts()) : $proyectos->the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('proyecto-item'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="proyecto-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                                <div class="proyecto-overlay">
                                    <span class="proyecto-overlay-titulo"><?php the_title(); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>
                        
                        <div class="proyecto-info">
                            <h2 class="proyecto-titulo">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <?php if (get_field('cliente')) : ?>
                                <div class="proyecto-cliente">
                                    <?php the_field('cliente'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="proyecto-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </div>
                            
                            <?php
                            // Mostrar categorías
                            $categorias = get_the_terms(get_the_ID(), 'categoria_proyecto');
                            if ($categorias && !is_wp_error($categorias)) : ?>
                                <div class="proyecto-categorias">
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <a href="<?php echo get_term_link($categoria); ?>" class="categoria">
                                            <?php echo $categoria->name; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="proyecto-read-more">
                                Ver proyecto <span class="arrow">→</span>
                            </a>
                        </div>
                        
                    </article>

                <?php endwhile; ?>
            </div>

            <!-- Paginación -->
            <div class="portfolio-pagination">
                <?php
                echo paginate_links(array(
                    'total' => $proyectos->max_num_pages,
                    'current' => max(1, $paged),
                    'prev_text' => '← Anteriores',
                    'next_text' => 'Siguientes →',
                    'type' => 'list',
                    'mid_size' => 2
                ));
                ?>
            </div>

            <?php wp_reset_postdata(); ?>

        <?php else : ?>
            
            <div class="no-proyectos">
                <p>Todavía no hay proyectos publicados.</p>
                <?php if (current_user_can('edit_posts')) : ?>
                    <a href="<?php echo admin_url('post-new.php?post_type=project'); ?>" class="button">
                        Añade tu primer proyecto
                    </a>
                <?php endif; ?>
            </div>

        <?php endif; ?>
    </div>
</main>

<?php
get_footer();