<?php
/**
 * Template Name: CV Page
 * Description: Plantilla para la página de Curriculum Vitae
 *
 * @package YourPortfolio
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <div class="container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class('cv-container'); ?>>
                
                <!-- HEADER DEL CV CON GLASSMORPHISM -->
                <header class="cv-header">
                    <div class="cv-header-content">
                        <h1 class="cv-name">John Doe</h1>
                        <p class="cv-title">Diseñador UX/UI & Desarrollador Frontend</p>
                        
                        <div class="cv-contact-info">
                            <span class="cv-contact-item">✉️ john.doe@example.com</span>
                            <span class="cv-contact-item">📱 +34 123 456 789</span>
                            <span class="cv-contact-item">📍 Madrid, España</span>
                            <span class="cv-contact-item">🌐 johndoe.dev</span>
                        </div>
                        
                        <div class="cv-social-links">
                            <a href="#" class="cv-social-link">LinkedIn</a>
                            <a href="#" class="cv-social-link">GitHub</a>
                            <a href="#" class="cv-social-link">Twitter</a>
                        </div>
                    </div>
                </header>

                <!-- GRID 2 COLUMNAS -->
                <div class="cv-grid">
                    
                    <!-- COLUMNA IZQUIERDA - PRINCIPAL -->
                    <div class="cv-main">
                        
                        <!-- PERFIL -->
                        <section class="cv-section">
                            <h2 class="cv-section-title">Perfil Profesional</h2>
                            <div class="cv-section-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                            </div>
                        </section>

                        <!-- EXPERIENCIA -->
                        <section class="cv-section">
                            <h2 class="cv-section-title">Experiencia Laboral</h2>
                            
                            <div class="cv-timeline">
                                <!-- Experiencia 1 -->
                                <div class="cv-timeline-item">
                                    <div class="cv-timeline-period">2022 - Presente</div>
                                    <h3 class="cv-timeline-position">Senior UX/UI Designer</h3>
                                    <p class="cv-timeline-company">Agencia Creativa · Madrid</p>
                                    <ul class="cv-timeline-description">
                                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                        <li>Sed do eiusmod tempor incididunt ut labore et dolore.</li>
                                        <li>Ut enim ad minim veniam, quis nostrud exercitation.</li>
                                    </ul>
                                </div>

                                <!-- Experiencia 2 -->
                                <div class="cv-timeline-item">
                                    <div class="cv-timeline-period">2019 - 2022</div>
                                    <h3 class="cv-timeline-position">Frontend Developer</h3>
                                    <p class="cv-timeline-company">Digital Solutions · Remoto</p>
                                    <ul class="cv-timeline-description">
                                        <li>Duis aute irure dolor in reprehenderit in voluptate.</li>
                                        <li>Excepteur sint occaecat cupidatat non proident.</li>
                                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing.</li>
                                    </ul>
                                </div>
                            </div>
                        </section>

                        <!-- EDUCACIÓN -->
                        <section class="cv-section">
                            <h2 class="cv-section-title">Educación</h2>
                            
                            <div class="cv-timeline">
                                <div class="cv-timeline-item">
                                    <div class="cv-timeline-period">2015 - 2017</div>
                                    <h3 class="cv-timeline-position">Máster en UX/UI</h3>
                                    <p class="cv-timeline-company">Universidad de Diseño · Barcelona</p>
                                </div>
                                
                                <div class="cv-timeline-item">
                                    <div class="cv-timeline-period">2012 - 2015</div>
                                    <h3 class="cv-timeline-position">Grado en Diseño Gráfico</h3>
                                    <p class="cv-timeline-company">Universidad Complutense · Madrid</p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- COLUMNA DERECHA - SIDEBAR -->
                    <div class="cv-sidebar">
                        
                        <!-- HABILIDADES -->
                        <section class="cv-section">
                            <h2 class="cv-section-title">Habilidades</h2>
                            <div class="cv-skills">
                                <span class="cv-skill">UX Research</span>
                                <span class="cv-skill">UI Design</span>
                                <span class="cv-skill">Figma</span>
                                <span class="cv-skill">Adobe XD</span>
                                <span class="cv-skill">HTML5/CSS3</span>
                                <span class="cv-skill">JavaScript</span>
                                <span class="cv-skill">React</span>
                                <span class="cv-skill">WordPress</span>
                                <span class="cv-skill">Git</span>
                                <span class="cv-skill">Inglés (C1)</span>
                            </div>
                        </section>

                        <!-- IDIOMAS -->
                        <section class="cv-section">
                            <h2 class="cv-section-title">Idiomas</h2>
                            <div class="cv-languages">
                                <div class="cv-language">
                                    <span>Español</span>
                                    <span class="cv-language-level">Nativo</span>
                                </div>
                                <div class="cv-language">
                                    <span>Inglés</span>
                                    <span class="cv-language-level">Avanzado (C1)</span>
                                </div>
                                <div class="cv-language">
                                    <span>Catalán</span>
                                    <span class="cv-language-level">Intermedio</span>
                                </div>
                            </div>
                        </section>

                        <!-- CERTIFICACIONES -->
                        <section class="cv-section">
                            <h2 class="cv-section-title">Certificaciones</h2>
                            <ul class="cv-certifications">
                                <li>Google UX Design Certificate (2023)</li>
                                <li>Meta Frontend Developer (2022)</li>
                                <li>Scrum Master Certified (2021)</li>
                                <li>Adobe Certified Expert (2020)</li>
                            </ul>
                        </section>

                        <!-- INTERESES -->
                        <section class="cv-section">
                            <h2 class="cv-section-title">Intereses</h2>
                            <div class="cv-interests">
                                <span class="cv-interest">📸 Fotografía</span>
                                <span class="cv-interest">✈️ Viajar</span>
                                <span class="cv-interest">🎧 Música</span>
                                <span class="cv-interest">📚 Lectura</span>
                                <span class="cv-interest">🎮 Gaming</span>
                            </div>
                        </section>
                    </div>
                </div>

                <!-- FOOTER DEL CV (OPCIONAL) -->
                <div class="cv-footer">
                    <p>Referencias disponibles bajo petición · <a href="#" class="cv-download-link">Descargar PDF</a></p>
                </div>

            </article>

        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();