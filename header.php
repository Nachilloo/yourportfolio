<?php
/**
 * The header for our theme
 *
 * @package YourPortfolio
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<canvas id="cursor-canvas"></canvas> <!-- Nuestro canvas para el efecto 3D -->

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="header-container">
            <!-- Logo / Site Title -->
            <div class="logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Menú de navegación -->
            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',  // CAMBIADO A menu-1
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>
        </div>
    </header>

    <div id="content" class="site-content">