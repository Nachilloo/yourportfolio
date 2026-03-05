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

                <!-- CABECERA DEL PROYECTO -->
                <header class="proyecto-header">
                    <h1 class="proyecto-titulo"><?php the_title(); ?></h1>

                    <div class="proyecto-metadata">
                        <?php if (get_field('cliente')): ?>
                            <span class="cliente">
                                <strong><?php _e('Cliente:', 'yourportfolio'); ?></strong> <?php the_field('cliente'); ?>
                            </span>
                        <?php endif; ?>

                        <?php if (get_field('fecha')): ?>
                            <span class="fecha">
                                <strong><?php _e('Fecha:', 'yourportfolio'); ?></strong> <?php the_field('fecha'); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php
                        // Mostrar categorías
                        $categorias = get_the_terms(get_the_ID(), 'categoria_proyecto');
                        if ($categorias && !is_wp_error($categorias)) : 
                            $categoria_list = array();
                            foreach ($categorias as $categoria) {
                                $categoria_list[] = $categoria->name;
                            }
                        ?>
                            <span class="categorias">
                                <strong><?php _e('Categorías:', 'yourportfolio'); ?></strong> <?php echo implode(', ', $categoria_list); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- CONTENIDO PRINCIPAL + SIDEBAR -->
                <div class="proyecto-grid">
                    
                    <!-- COLUMNA PRINCIPAL -->
                    <div class="proyecto-main">
                        
                        <?php if (has_post_thumbnail()): ?>
                            <div class="proyecto-imagen-destacada">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="proyecto-contenido">
                            <?php the_content(); ?>
                        </div>

                        <?php
                        // GALERÍA DE IMÁGENES (si existe)
                        $galeria = get_field('galeria');
                        if ($galeria): ?>
                            <div class="proyecto-galeria">
                                <h3><?php _e('Galería del proyecto', 'yourportfolio'); ?></h3>
                                <div class="galeria-grid">
                                    <?php foreach ($galeria as $index => $imagen): ?>
                                        <div class="galeria-item">
                                            <a href="<?php echo esc_url($imagen['url']); ?>"
                                               class="galeria-enlace lightbox-trigger"
                                               data-src="<?php echo esc_url($imagen['url']); ?>"
                                               data-caption="<?php echo esc_attr($imagen['caption']); ?>"
                                               data-index="<?php echo $index; ?>">
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

                            <!-- LIGHTBOX MODAL -->
                            <div id="lightbox" class="lightbox" role="dialog" aria-modal="true" aria-label="Galería de imágenes">
                                <button class="lightbox-close" aria-label="Cerrar">&times;</button>
                                <button class="lightbox-prev" aria-label="Anterior">&#8249;</button>
                                <button class="lightbox-next" aria-label="Siguiente">&#8250;</button>
                                <div class="lightbox-content">
                                    <img src="" alt="" class="lightbox-img">
                                    <p class="lightbox-caption"></p>
                                </div>
                            </div>

                            <script>
                            (function () {
                                const triggers  = Array.from(document.querySelectorAll('.lightbox-trigger'));
                                const lightbox  = document.getElementById('lightbox');
                                const lbImg     = lightbox.querySelector('.lightbox-img');
                                const lbCaption = lightbox.querySelector('.lightbox-caption');
                                let current = 0;

                                function open(index) {
                                    current = index;
                                    const t = triggers[current];
                                    lbImg.src        = t.dataset.src;
                                    lbImg.alt        = t.querySelector('img').alt;
                                    lbCaption.textContent = t.dataset.caption || '';
                                    lightbox.classList.add('is-open');
                                    document.body.style.overflow = 'hidden';
                                    lightbox.querySelector('.lightbox-prev').style.display = triggers.length > 1 ? '' : 'none';
                                    lightbox.querySelector('.lightbox-next').style.display = triggers.length > 1 ? '' : 'none';
                                }

                                function close() {
                                    lightbox.classList.remove('is-open');
                                    document.body.style.overflow = '';
                                    lbImg.src = '';
                                }

                                function navigate(dir) {
                                    current = (current + dir + triggers.length) % triggers.length;
                                    const t = triggers[current];
                                    lbImg.classList.add('lightbox-img--loading');
                                    lbImg.src        = t.dataset.src;
                                    lbImg.alt        = t.querySelector('img').alt;
                                    lbCaption.textContent = t.dataset.caption || '';
                                }

                                triggers.forEach((el, i) => {
                                    el.addEventListener('click', e => { e.preventDefault(); open(i); });
                                });

                                lightbox.querySelector('.lightbox-close').addEventListener('click', close);
                                lightbox.querySelector('.lightbox-prev').addEventListener('click', () => navigate(-1));
                                lightbox.querySelector('.lightbox-next').addEventListener('click', () => navigate(1));

                                lightbox.addEventListener('click', () => close());

                                lbImg.addEventListener('load', () => lbImg.classList.remove('lightbox-img--loading'));

                                document.addEventListener('keydown', e => {
                                    if (!lightbox.classList.contains('is-open')) return;
                                    if (e.key === 'Escape')     close();
                                    if (e.key === 'ArrowLeft')  navigate(-1);
                                    if (e.key === 'ArrowRight') navigate(1);
                                });
                            })();
                            </script>
                        <?php endif; ?>
                        
                        <!-- TECNOLOGÍAS USADAS -->
                        <?php if (get_field('tecnologias_usadas')): ?>
                            <div class="proyecto-tecnologias">
                                <h3><?php _e('Tecnologías utilizadas', 'yourportfolio'); ?></h3>
                                <div class="tecnologias-list">
                                    <?php 
                                    $tecnologias = explode(',', get_field('tecnologias_usadas'));
                                    foreach ($tecnologias as $tecnologia): 
                                    ?>
                                        <span class="tecnologia-tag"><?php echo trim($tecnologia); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                    </div>

                    <!-- SIDEBAR DEL PROYECTO -->
                    <div class="proyecto-sidebar">
                        
                        <!-- BOTÓN PROYECTO ONLINE -->
                        <?php 
                        $url_proyecto = get_field('url');
                        if ($url_proyecto): 
                        ?>
                            <div class="sidebar-widget">
                                <h4><?php _e('Ver proyecto online', 'yourportfolio'); ?></h4>
                                <a href="<?php echo esc_url($url_proyecto); ?>" class="boton" target="_blank" rel="noopener noreferrer">
                                    <?php _e('Visitar sitio', 'yourportfolio'); ?> →
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <!-- DETALLES DEL PROYECTO -->
                        <div class="sidebar-widget">
                            <h4><?php _e('Detalles del proyecto', 'yourportfolio'); ?></h4>
                            <ul class="proyecto-detalles-list">
                                <?php if (get_field('cliente')): ?>
                                    <li><strong><?php _e('Cliente:', 'yourportfolio'); ?></strong> <?php the_field('cliente'); ?></li>
                                <?php endif; ?>
                                
                                <?php if (get_field('fecha')): ?>
                                    <li><strong><?php _e('Fecha:', 'yourportfolio'); ?></strong> <?php the_field('fecha'); ?></li>
                                <?php endif; ?>
                                
                                <?php
                                $categorias = get_the_terms(get_the_ID(), 'categoria_proyecto');
                                if ($categorias && !is_wp_error($categorias)) : 
                                ?>
                                    <li>
                                        <strong><?php _e('Categorías:', 'yourportfolio'); ?></strong>
                                        <?php foreach ($categorias as $index => $categoria): ?>
                                            <a href="<?php echo get_term_link($categoria); ?>"><?php echo $categoria->name; ?></a><?php echo ($index < count($categorias) - 1) ? ', ' : ''; ?>
                                        <?php endforeach; ?>
                                    </li>
                                <?php endif; ?>
                                
                                <?php if (get_field('rol')): ?>
                                    <li><strong><?php _e('Mi rol:', 'yourportfolio'); ?></strong> <?php the_field('rol'); ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        
                        <!-- COMPARTIR PROYECTO -->
                        <div class="sidebar-widget">
                            <h4><?php _e('Compartir', 'yourportfolio'); ?></h4>
                            <div class="share-links">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-link facebook">FB</a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-link twitter">TW</a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-link linkedin">IN</a>
                                <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" target="_blank" class="share-link pinterest">PT</a>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                <!-- PROYECTOS RELACIONADOS -->
                <?php
                $categorias = wp_get_post_terms(get_the_ID(), 'categoria_proyecto', array('fields' => 'ids'));
                if ($categorias) {
                    $related_args = array(
                        'post_type' => 'project',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categoria_proyecto',
                                'field' => 'term_id',
                                'terms' => $categorias,
                            ),
                        ),
                    );
                    
                    $related_query = new WP_Query($related_args);
                    
                    if ($related_query->have_posts()): ?>
                        <div class="proyectos-relacionados">
                            <h3><?php _e('Proyectos relacionados', 'yourportfolio'); ?></h3>
                            <div class="relacionados-grid">
                                <?php while ($related_query->have_posts()): $related_query->the_post(); ?>
                                    <div class="relacionado-item">
                                        <?php if (has_post_thumbnail()): ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium'); ?>
                                            </a>
                                        <?php endif; ?>
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <?php wp_reset_postdata();
                    endif;
                }
                ?>

                <!-- NAVEGACIÓN ENTRE PROYECTOS -->
                <footer class="proyecto-footer">
                    <?php
                    the_post_navigation(array(
                        'prev_text' => '← ' . __('Proyecto anterior', 'yourportfolio'),
                        'next_text' => __('Proyecto siguiente', 'yourportfolio') . ' →',
                    ));
                    ?>
                </footer>

            </article>

        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();