<?php
/**
 * yourportfolio functions and definitions
 *
 * @package yourportfolio
 */

if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

/**
 * 1. VERIFICACIÓN DE DEPENDENCIAS
 * Comprueba que ACF Pro está instalado y activado
 */
function yourportfolio_check_dependencies() {
    // Si ACF Pro no está activo, mostrar aviso
    if (!class_exists('ACF')) {
        add_action('admin_notices', function() {
            ?>
            <div class="notice notice-warning is-dismissible">
                <p><strong>⚠️ Tu tema yourportfolio necesita Advanced Custom Fields Pro para funcionar correctamente.</strong></p>
                <p>Por favor, instala y activa <a href="https://www.advancedcustomfields.com/pro/" target="_blank">ACF Pro</a> (versión 6.0 o superior).</p>
            </div>
            <?php
        });
    }
    
    // Verificar que es ACF Pro, no la versión gratuita
    if (class_exists('ACF') && !defined('ACF_PRO')) {
        add_action('admin_notices', function() {
            ?>
            <div class="notice notice-error">
                <p><strong>❌ Versión incorrecta de ACF detectada.</strong></p>
                <p>Tu tema requiere <strong>ACF Pro</strong>. La versión gratuita no es compatible.</p>
            </div>
            <?php
        });
    }
}
add_action('after_setup_theme', 'yourportfolio_check_dependencies');

/**
 * 2. CONFIGURACIÓN INICIAL DEL TEMA
 */
function yourportfolio_setup() {
    load_theme_textdomain('yourportfolio', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    // Registrar menús
    register_nav_menus(array(
        'menu-principal' => esc_html__('Menú Principal', 'yourportfolio'),
        'menu-footer'    => esc_html__('Menú Footer', 'yourportfolio'),
    ));
    
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ));
    
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'yourportfolio_setup');

/**
 * 3. ANCHO DE CONTENIDO
 */
function yourportfolio_content_width() {
    $GLOBALS['content_width'] = apply_filters('yourportfolio_content_width', 640);
}
add_action('after_setup_theme', 'yourportfolio_content_width', 0);

/**
 * 4. WIDGETS
 */
function yourportfolio_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'yourportfolio'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'yourportfolio'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    // Footers
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar(array(
            'name'          => sprintf(esc_html__('Footer %d', 'yourportfolio'), $i),
            'id'            => 'footer-' . $i,
            'description'   => sprintf(esc_html__('Añade widgets para la columna %d del footer', 'yourportfolio'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ));
    }
}
add_action('widgets_init', 'yourportfolio_widgets_init');

/**
 * 5. SCRIPTS Y ESTILOS
 */
function yourportfolio_scripts() {
    wp_enqueue_style('yourportfolio-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_script('yourportfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'yourportfolio_scripts');

/**
 * 6. CARGA DE ARCHIVOS ADICIONALES
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';

if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * 7. EFECTO CURSOR 3D
 */
function yourportfolio_cursor_scripts() {
    wp_enqueue_script(
        'yourportfolio-cursor-init',
        get_template_directory_uri() . '/assets/js/cursor-init.js',
        array(),
        '1.0.0',
        true
    );

    add_filter('script_loader_tag', function($tag, $handle, $src) {
        if ('yourportfolio-cursor-init' === $handle) {
            $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        }
        return $tag;
    }, 10, 3);
}
add_action('wp_enqueue_scripts', 'yourportfolio_cursor_scripts');

/**
 * 8. PÁGINAS DE OPCIONES DE ACF
 */
if (function_exists('acf_add_options_page')) {
    // Home
    acf_add_options_page(array(
        'page_title'     => 'Configuración de Home',
        'menu_title'     => 'Home',
        'menu_slug'      => 'theme-home-settings',
        'capability'     => 'edit_posts',
        'position'       => 3,
        'icon_url'       => 'dashicons-admin-home',
        'redirect'       => false,
    ));
    
    // CV
    acf_add_options_page(array(
        'page_title'     => 'Configuración de CV',
        'menu_title'     => 'CV',
        'menu_slug'      => 'theme-cv-settings',
        'capability'     => 'edit_posts',
        'position'       => 4,
        'icon_url'       => 'dashicons-id',
        'redirect'       => false,
    ));
    
    // Contacto
    acf_add_options_page(array(
        'page_title'     => 'Configuración de Contacto',
        'menu_title'     => 'Contacto',
        'menu_slug'      => 'theme-contact-settings',
        'capability'     => 'edit_posts',
        'position'       => 5,
        'icon_url'       => 'dashicons-email',
        'redirect'       => false,
    ));
    
    // Redes Sociales
    acf_add_options_page(array(
        'page_title'     => 'Configuración de Redes Sociales',
        'menu_title'     => 'Redes Sociales',
        'menu_slug'      => 'theme-social-settings',
        'capability'     => 'edit_posts',
        'position'       => 6,
        'icon_url'       => 'dashicons-share',
        'redirect'       => false,
    ));
}

/**
 * 9. CREACIÓN AUTOMÁTICA DE PÁGINAS Y MENÚ AL ACTIVAR EL TEMA
 * Esta función se ejecuta UNA SOLA VEZ cuando se activa el tema
 */
function yourportfolio_create_default_pages() {
    
    // Evitar ejecución múltiple
    if (get_option('yourportfolio_initial_setup_done')) {
        return;
    }
    
    // Array con las páginas a crear
    $default_pages = array(
        array(
            'title'    => 'Home',
            'slug'     => 'home',
            'content'  => 'Bienvenido a mi portfolio. Esta página usa la plantilla front-page.php',
            'template' => 'front-page.php',
            'order'    => 1
        ),
        array(
            'title'    => 'Portfolio',
            'slug'     => 'portfolio',
            'content'  => 'Aquí puedes ver todos mis proyectos.',
            'template' => 'page-portfolio.php',
            'order'    => 2
        ),
        array(
            'title'    => 'CV',
            'slug'     => 'cv',
            'content'  => 'Currículum vitae profesional.',
            'template' => 'page-cv.php',
            'order'    => 3
        ),
        array(
            'title'    => 'Contacto',
            'slug'     => 'contacto',
            'content'  => 'Ponte en contacto conmigo.',
            'template' => 'page-contacto.php',
            'order'    => 4
        ),
    );

    $created_pages = array();

    // Crear cada página
    foreach ($default_pages as $page) {
        $existing_page = get_page_by_path($page['slug']);
        
        if (!$existing_page) {
            $page_id = wp_insert_post(array(
                'post_title'    => $page['title'],
                'post_name'     => $page['slug'],
                'post_content'  => $page['content'],
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_author'   => 1,
                'menu_order'    => $page['order'],
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ));
            
            if ($page_id && !is_wp_error($page_id)) {
                // Asignar plantilla
                if (!empty($page['template'])) {
                    update_post_meta($page_id, '_wp_page_template', $page['template']);
                }
                $created_pages[$page['slug']] = $page_id;
            }
        } else {
            $created_pages[$page['slug']] = $existing_page->ID;
        }
    }

    // Configurar Home como página de inicio
    if (isset($created_pages['home'])) {
        update_option('page_on_front', $created_pages['home']);
        update_option('show_on_front', 'page');
    }

    // Configurar Portfolio como página de entradas (si aplica)
    if (isset($created_pages['portfolio'])) {
        update_option('page_for_posts', $created_pages['portfolio']);
    }

    /**
     * CREAR MENÚ PRINCIPAL AUTOMÁTICAMENTE
     */
    
    // 1. Verificar si ya existe un menú llamado "Menú Principal" [citation:8]
    $menu_exists = wp_get_nav_menu_object('Menú Principal');
    
    if (!$menu_exists) {
        // 2. Crear el menú
        $menu_id = wp_create_nav_menu('Menú Principal');
        
        if (!is_wp_error($menu_id)) {
            // 3. Añadir items al menú en el orden correcto
            $menu_items = array(
                'home'      => 'Inicio',
                'portfolio' => 'Portfolio',
                'cv'        => 'CV',
                'contacto'  => 'Contacto',
            );
            
            foreach ($menu_items as $slug => $title) {
                if (isset($created_pages[$slug])) {
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title'     => $title,
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $created_pages[$slug],
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                    ));
                }
            }
            
            // 4. Asignar el menú a la ubicación 'menu-principal' [citation:8]
            $locations = get_theme_mod('nav_menu_locations');
            $locations['menu-principal'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }

    // Marcar como completado
    add_option('yourportfolio_initial_setup_done', true);
}
add_action('after_switch_theme', 'yourportfolio_create_default_pages');

/**
 * 10. PROCESAR FORMULARIO DE CONTACTO
 */
function handle_contact_form() {
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'send_contact_form_nonce')) {
        wp_die('Error de seguridad');
    }
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);
    
    $to = get_field('contact_form_email', 'option') ?: get_option('admin_email');
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email
    );
    
    $email_subject = 'Contacto web: ' . $subject;
    $email_body = "
        <h2>Mensaje de contacto</h2>
        <p><strong>Nombre:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Teléfono:</strong> $phone</p>
        <p><strong>Asunto:</strong> $subject</p>
        <p><strong>Mensaje:</strong></p>
        <p>$message</p>
    ";
    
    $sent = wp_mail($to, $email_subject, $email_body, $headers);
    
    if ($sent) {
        wp_redirect(add_query_arg('status', 'success', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('status', 'error', wp_get_referer()));
    }
    exit;
}
add_action('admin_post_nopriv_send_contact_form', 'handle_contact_form');
add_action('admin_post_send_contact_form', 'handle_contact_form');

/**
 * 11. FUNCIONES DE REDES SOCIALES
 */
require get_template_directory() . '/inc/social-functions.php';

/**
 * 12. CARGAR FONT AWESOME
 */
function yourportfolio_load_fontawesome() {
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
}
add_action('wp_enqueue_scripts', 'yourportfolio_load_fontawesome');

/**
 * 13. LIMPIAR OPCIONES AL DESACTIVAR (opcional)
 * Útil para desarrollo, pero quizás no quieras esto en producción
 */
function yourportfolio_theme_deactivation() {
    // No borramos las páginas, solo la marca de setup
    delete_option('yourportfolio_initial_setup_done');
}
add_action('switch_theme', 'yourportfolio_theme_deactivation');