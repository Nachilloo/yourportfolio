<?php
/**
 * Template Name: Contacto
 * Description: Plantilla para la página de contacto con formulario
 *
 * @package YourPortfolio
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('contact-container'); ?>>
                
                <!-- HEADER DE CONTACTO -->
                <header class="contact-header">
                    <h1 class="contact-title">¿Tienes un proyecto en mente?</h1>
                    <p class="contact-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
                </header>

                <!-- GRID 2 COLUMNAS: FORMULARIO + INFORMACIÓN -->
                <div class="contact-grid">
                    
                    <!-- COLUMNA IZQUIERDA - FORMULARIO -->
                    <div class="contact-form-column">
                        <form class="contact-form">
                            
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

                            <p class="form-note">* Campos obligatorios. Lorem ipsum dolor sit amet.</p>
                        </form>
                    </div>

                    <!-- COLUMNA DERECHA - INFORMACIÓN -->
                    <div class="contact-info-column">
                        
                        <!-- TARJETA DE INFORMACIÓN -->
                        <div class="contact-info-card">
                            <h3 class="info-card-title">Información de contacto</h3>
                            
                            <div class="info-items">
                                <div class="info-item">
                                    <div class="info-icon">📍</div>
                                    <div class="info-content">
                                        <h4>Ubicación</h4>
                                        <p>Calle Principal 123<br>28001 Madrid, España</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">✉️</div>
                                    <div class="info-content">
                                        <h4>Email</h4>
                                        <p>info@yourportfolio.com<br>hola@yourportfolio.com</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">📱</div>
                                    <div class="info-content">
                                        <h4>Teléfono</h4>
                                        <p>+34 123 456 789<br>+34 987 654 321</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">🕒</div>
                                    <div class="info-content">
                                        <h4>Horario</h4>
                                        <p>Lunes a Viernes: 9:00 - 18:00<br>Findes: Respondemos email</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- REDES SOCIALES -->
                        <div class="contact-social-card">
                            <h3 class="info-card-title">Sígueme en redes</h3>
                            <div class="contact-social-links">
                                <a href="#" class="contact-social-link" target="_blank">LinkedIn</a>
                                <a href="#" class="contact-social-link" target="_blank">GitHub</a>
                                <a href="#" class="contact-social-link" target="_blank">Twitter</a>
                                <a href="#" class="contact-social-link" target="_blank">Instagram</a>
                            </div>
                        </div>

                        <!-- MAPA (OPCIONAL) -->
                        <div class="contact-map-card">
                            <h3 class="info-card-title">¿Dónde estamos?</h3>
                            <div class="map-placeholder">
                                <div class="map-overlay">
                                    <p>📍 Madrid, España</p>
                                    <span class="map-note">Mapa interactivo (Google Maps)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ SECTION (OPCIONAL) -->
                <section class="contact-faq">
                    <h2 class="faq-title">Preguntas frecuentes</h2>
                    
                    <div class="faq-grid">
                        <div class="faq-item">
                            <h4>¿En cuánto tiempo responden?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h4>¿Trabajan con proyectos internacionales?</h4>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h4>¿Qué métodos de pago aceptan?</h4>
                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia.</p>
                        </div>
                        
                        <div class="faq-item">
                            <h4>¿Hacen presupuestos sin compromiso?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut enim ad minim veniam.</p>
                        </div>
                    </div>
                </section>

            </article>

        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();