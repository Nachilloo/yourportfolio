<?php
/**
 * The template for displaying the footer
 *
 * @package YourPortfolio
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="footer-container">

        <?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')): ?>
            <div class="footer-widgets">

                <?php if (is_active_sidebar('footer-1')): ?>
                    <div class="footer-widget footer-widget-1">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-2')): ?>
                    <div class="footer-widget footer-widget-2">
                        <?php dynamic_sidebar('footer-2'); ?>
                    </div>
                <?php endif; ?>

                <?php if (is_active_sidebar('footer-3')): ?>
                    <div class="footer-widget footer-widget-3">
                        <?php dynamic_sidebar('footer-3'); ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <?php if (function_exists('yourportfolio_social_links')): ?>
            <?php yourportfolio_social_links('footer'); ?>
        <?php endif; ?>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
            <p>Diseñado por <a href="<?php echo esc_url(home_url('/')); ?>">Ignacio Galante Milicua</a></p>
        </div>

    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>