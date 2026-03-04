<?php
/**
 * The template for displaying project archive
 *
 * @package YourPortfolio
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        
        <header class="archive-header">
            <h1 class="archive-title">Mis Proyectos</h1>
            <?php
            // Muestra la descripción de la categoría si estamos en una categoría específica
            $categoria_descripcion = term_description();
            if ($categoria_descripcion) :
                echo '<div class="taxonomy-description">' . $categoria_descripcion . '</div>';
            endif;
            ?>
        </header>

        <?php if (have_posts()) : ?>
            
            <div class="proyectos-grid">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('proyecto-item'); ?>>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="proyecto-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
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
                            
                            <?php
                            // Muestra las categorías del proyecto
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

            <?php
            // Paginación
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => '← Anteriores',
                'next_text' => 'Siguientes →',
            ));
            ?>

        <?php else : ?>
            
            <p class="no-proyectos">No hay proyectos publicados todavía.</p>

        <?php endif; ?>
    </div>
</main>

<?php
get_footer();