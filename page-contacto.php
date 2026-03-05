<?php
/**
 * Template Name: Contacto
 * Description: Plantilla para la página de contacto
 *
 * @package YourPortfolio
 */

get_header();

// Obtener campos de ACF
$contact_title = get_field('contact_title', 'option');
$contact_subtitle = get_field('contact_subtitle', 'option');

$contact_address = get_field('contact_address', 'option');
$contact_email = get_field('contact_email', 'option');
$contact_email_secondary = get_field('contact_email_secondary', 'option');
$contact_phone = get_field('contact_phone', 'option');
$contact_phone_secondary = get_field('contact_phone_secondary', 'option');
$contact_hours = get_field('contact_hours', 'option');
$contact_weekend_hours = get_field('contact_weekend_hours', 'option');

$contact_map_location = get_field('contact_map_location', 'option');
$contact_map_coords = get_field('contact_map_coords', 'option');
$contact_map_api_key = get_field('contact_map_api_key', 'option');

$contact_faq = get_field('contact_faq', 'option');
$contact_show_social = get_field('contact_show_social', 'option');

$contact_form_shortcode = get_field('contact_form_shortcode', 'option');
$contact_success_message = get_field('contact_success_message', 'option');
$contact_error_message = get_field('contact_error_message', 'option');

// Redes sociales (compartidas con todo el sitio)
$social_links = get_field('social_links', 'option');
?>

<main id="primary" class="site-main">
    
    <div class="container">
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('contact-container'); ?>>
            
            <!-- HEADER DE CONTACTO -->
            <header class="contact-header">
                <h1 class="contact-title"><?php echo $contact_title ?: '¿Tienes un proyecto en mente?'; ?></h1>
                <?php if ($contact_subtitle) : ?>
                    <p class="contact-subtitle"><?php echo $contact_subtitle; ?></p>
                <?php endif; ?>
            </header>

            <!-- GRID 2 COLUMNAS -->
            <div class="contact-grid">
                
                <!-- COLUMNA IZQUIERDA - FORMULARIO -->
                <div class="contact-form-column">
                    
                    <?php if ($contact_form_shortcode) : ?>
                        <!-- Formulario con shortcode (Contact Form 7, etc.) -->
                        <?php echo do_shortcode($contact_form_shortcode); ?>
                    <?php else : ?>
                        <!-- Formulario HTML por defecto -->
                        <form class="contact-form" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                            
                            <input type="hidden" name="action" value="send_contact_form">
                            <?php wp_nonce_field('send_contact_form_nonce', 'contact_nonce'); ?>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name">Nombre completo *</label>
                                    <input type="text" id="name" name="name" placeholder="Ej: Juan Pérez" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <input type="tel" id="phone" name="phone" placeholder="+34 123 456 789">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="subject">Asunto *</label>
                                    <input type="text" id="subject" name="subject" placeholder="¿Sobre qué quieres hablar?" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="message">Mensaje *</label>
                                    <textarea id="message" name="message" rows="6" placeholder="Cuéntame tu proyecto..." required></textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <button type="submit" class="contact-submit-button">
                                    Enviar mensaje
                                    <span class="button-arrow">→</span>
                                </button>
                            </div>

                            <p class="form-note">* Campos obligatorios</p>
                        </form>
                    <?php endif; ?>
                    
                </div>

                <!-- COLUMNA DERECHA - INFORMACIÓN -->
                <div class="contact-info-column">
                    
                    <!-- TARJETA DE INFORMACIÓN -->
                    <div class="contact-info-card">
                        <h3 class="info-card-title">Información de contacto</h3>
                        
                        <div class="info-items">
                            
                            <?php if ($contact_address) : ?>
                                <div class="info-item">
                                    <div class="info-icon">📍</div>
                                    <div class="info-content">
                                        <h4>Ubicación</h4>
                                        <p><?php echo nl2br($contact_address); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($contact_email || $contact_email_secondary) : ?>
                                <div class="info-item">
                                    <div class="info-icon">✉️</div>
                                    <div class="info-content">
                                        <h4>Email</h4>
                                        <p>
                                            <?php if ($contact_email) : ?>
                                                <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a><br>
                                            <?php endif; ?>
                                            <?php if ($contact_email_secondary) : ?>
                                                <a href="mailto:<?php echo $contact_email_secondary; ?>"><?php echo $contact_email_secondary; ?></a>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($contact_phone || $contact_phone_secondary) : ?>
                                <div class="info-item">
                                    <div class="info-icon">📱</div>
                                    <div class="info-content">
                                        <h4>Teléfono</h4>
                                        <p>
                                            <?php if ($contact_phone) : ?>
                                                <a href="tel:<?php echo $contact_phone; ?>"><?php echo $contact_phone; ?></a><br>
                                            <?php endif; ?>
                                            <?php if ($contact_phone_secondary) : ?>
                                                <a href="tel:<?php echo $contact_phone_secondary; ?>"><?php echo $contact_phone_secondary; ?></a>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($contact_hours || $contact_weekend_hours) : ?>
                                <div class="info-item">
                                    <div class="info-icon">🕒</div>
                                    <div class="info-content">
                                        <h4>Horario</h4>
                                        <p>
                                            <?php if ($contact_hours) : ?>
                                                <?php echo $contact_hours; ?><br>
                                            <?php endif; ?>
                                            <?php if ($contact_weekend_hours) : ?>
                                                <?php echo $contact_weekend_hours; ?>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- REDES SOCIALES -->
                    <?php if ($contact_show_social && $social_links) : ?>
                        <div class="contact-social-card">
                            <h3 class="info-card-title">Sígueme en redes</h3>
                            <div class="contact-social-links">
                                <?php foreach ($social_links as $social) : ?>
                                    <a href="<?php echo esc_url($social['social_url']); ?>" class="contact-social-link" target="_blank">
                                        <?php echo $social['social_network']; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- MAPA -->
                    <?php if ($contact_map_location) : ?>
                        <div class="contact-map-card">
                            <h3 class="info-card-title">¿Dónde estamos?</h3>
                            <div class="map-placeholder">
                                <?php if ($contact_map_api_key && $contact_map_coords) : ?>
                                    <!-- Mapa interactivo con Google Maps -->
                                    <iframe
                                        width="100%"
                                        height="200"
                                        frameborder="0"
                                        style="border:0; border-radius: 10px;"
                                        src="https://www.google.com/maps/embed/v1/place?key=<?php echo $contact_map_api_key; ?>&q=<?php echo urlencode($contact_map_location); ?>"
                                        allowfullscreen>
                                    </iframe>
                                <?php else : ?>
                                    <!-- Placeholder del mapa -->
                                    <div class="map-overlay">
                                        <p>📍 <?php echo $contact_map_location; ?></p>
                                        <span class="map-note">Mapa interactivo (requiere API key)</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- FAQ SECTION -->
            <?php if ($contact_faq) : ?>
                <section class="contact-faq">
                    <h2 class="faq-title">Preguntas frecuentes</h2>
                    
                    <div class="faq-grid">
                        <?php foreach ($contact_faq as $faq) : ?>
                            <div class="faq-item">
                                <h4><?php echo $faq['faq_question']; ?></h4>
                                <p><?php echo $faq['faq_answer']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

        </article>
    </div>
</main>

<?php
get_footer();