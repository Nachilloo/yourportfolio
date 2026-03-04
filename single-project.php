<?php
/**
 * The template for displaying single project posts
 *
 * @package YourPortfolio
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php while (have_posts()):
            the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('proyecto-detalle'); ?>>

                <header class="proyecto-header">
                    <h1 class="proyecto-titulo"><?php the_title(); ?></h1>

                    <?php if (get_field('cliente') || get_field('fecha')): ?>
                        <div class="proyecto-metadata">
                            <?php if (get_field('cliente')): ?>
                                <span class="cliente">
                                    <strong>Cliente:</strong> <?php the_field('cliente'); ?>
                                </span>
                            <?php endif; ?>

                            <?php if (get_field('fecha')): ?>
                                <span class="fecha">
                                    <strong>Fecha:</strong> <?php the_field('fecha'); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (has_post_thumbnail()): ?>
                    <div class="proyecto-imagen-destacada">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="proyecto-contenido">
                    <?php the_content(); ?>
                </div>

                <?php
                // OBTENER LAS IMÁGENES DE LA GALERÍA
                $galeria = get_field('galeria'); // Asegúrate que 'galeria' es el nombre exacto de tu campo
            
                if ($galeria): ?>
                    <div class="proyecto-galeria">
                        <h3>Galería del proyecto</h3>
                        <div class="galeria-grid">
                            <?php foreach ($galeria as $imagen): ?>
                                <div class="galeria-item">
                                    <a href="<?php echo esc_url($imagen['url']); ?>" class="galeria-enlace" target="_blank">
                                        <img src="<?php echo esc_url($imagen['sizes']['medium']); ?>"
                                            alt="<?php echo esc_attr($imagen['alt']); ?>" class="galeria-imagen">
                                    </a>
                                    <?php if ($imagen['caption']): ?>
                                        <p class="galeria-caption"><?php echo esc_html($imagen['caption']); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php
// DEBUG COMPLETO: Ver todos los campos disponibles
$todos_los_campos = get_fields();
echo '<!-- DEBUG: TODOS LOS CAMPOS DISPONIBLES: ' . print_r($todos_los_campos, true) . ' -->';
?>
                
                <?php if (get_field('url')): ?>
                    <div class="proyecto-enlace">
                        <a href="<?php the_field('url'); ?>" class="boton" target="_blank">
                            Ver proyecto online →
                        </a>
                    </div>
                <?php endif; ?>

                <footer class="proyecto-footer">
                    <?php
                    // Navegación entre proyectos (anterior/siguiente)
                    the_post_navigation(array(
                        'prev_text' => '← Proyecto anterior',
                        'next_text' => 'Proyecto siguiente →',
                    ));
                    ?>
                </footer>

            </article>

        <?php endwhile; // End of the loop. ?>
    </div>
</main>

<?php
get_footer();