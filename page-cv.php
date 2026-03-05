<?php
/**
 * Template Name: CV Page
 * Description: Plantilla para la página de Curriculum Vitae
 *
 * @package YourPortfolio
 */

get_header();

// Obtener todos los campos de ACF
$cv_name = get_field('cv_name', 'option');
$cv_title = get_field('cv_title', 'option');
$cv_email = get_field('cv_email', 'option');
$cv_phone = get_field('cv_phone', 'option');
$cv_location = get_field('cv_location', 'option');
$cv_website = get_field('cv_website', 'option');
$cv_profile = get_field('cv_profile', 'option');

$cv_experience = get_field('cv_experience', 'option');
$cv_education = get_field('cv_education', 'option');
$cv_skills = get_field('cv_skills', 'option');
$cv_languages = get_field('cv_languages', 'option');
$cv_certifications = get_field('cv_certifications', 'option');
$cv_social = get_field('cv_social', 'option');
?>

<main id="primary" class="site-main">
    
    <div class="container">
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('cv-container'); ?>>
            
            <!-- HEADER DEL CV -->
            <header class="cv-header">
                <div class="cv-header-content">
                    <h1 class="cv-name"><?php echo $cv_name ?: 'John Doe'; ?></h1>
                    <p class="cv-title"><?php echo $cv_title ?: 'Senior UX/UI Designer & Frontend Developer'; ?></p>
                    
                    <div class="cv-contact-info">
                        <?php if ($cv_email) : ?>
                            <span class="cv-contact-item">✉️ <?php echo $cv_email; ?></span>
                        <?php endif; ?>
                        
                        <?php if ($cv_phone) : ?>
                            <span class="cv-contact-item">📱 <?php echo $cv_phone; ?></span>
                        <?php endif; ?>
                        
                        <?php if ($cv_location) : ?>
                            <span class="cv-contact-item">📍 <?php echo $cv_location; ?></span>
                        <?php endif; ?>
                        
                        <?php if ($cv_website) : ?>
                            <span class="cv-contact-item">🌐 <a href="<?php echo esc_url($cv_website); ?>" target="_blank"><?php echo preg_replace('#^https?://#', '', $cv_website); ?></a></span>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($cv_social) : ?>
                        <div class="cv-social-links">
                            <?php foreach ($cv_social as $social) : ?>
                                <a href="<?php echo esc_url($social['social_url']); ?>" class="cv-social-link" target="_blank">
                                    <?php echo $social['social_network']; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </header>

            <!-- GRID 2 COLUMNAS -->
            <div class="cv-grid">
                
                <!-- COLUMNA IZQUIERDA - PRINCIPAL -->
                <div class="cv-main">
                    
                    <!-- PERFIL PROFESIONAL -->
                    <section class="cv-section">
                        <h2 class="cv-section-title">Perfil Profesional</h2>
                        <div class="cv-section-content">
                            <?php if ($cv_profile) : ?>
                                <?php echo wpautop($cv_profile); ?>
                            <?php else : ?>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                            <?php endif; ?>
                        </div>
                    </section>

                    <!-- EXPERIENCIA LABORAL -->
                    <?php if ($cv_experience) : ?>
                        <section class="cv-section">
                            <h2 class="cv-section-title">Experiencia Laboral</h2>
                            
                            <div class="cv-timeline">
                                <?php foreach ($cv_experience as $exp) : ?>
                                    <div class="cv-timeline-item">
                                        <div class="cv-timeline-period"><?php echo $exp['exp_period']; ?></div>
                                        <h3 class="cv-timeline-position"><?php echo $exp['exp_position']; ?></h3>
                                        <p class="cv-timeline-company"><?php echo $exp['exp_company']; ?></p>
                                        <?php if (!empty($exp['exp_description'])) : ?>
                                            <div class="cv-timeline-description">
                                                <?php echo wpautop($exp['exp_description']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- EDUCACIÓN -->
                    <?php if ($cv_education) : ?>
                        <section class="cv-section">
                            <h2 class="cv-section-title">Educación</h2>
                            
                            <div class="cv-timeline">
                                <?php foreach ($cv_education as $edu) : ?>
                                    <div class="cv-timeline-item">
                                        <div class="cv-timeline-period"><?php echo $edu['edu_period']; ?></div>
                                        <h3 class="cv-timeline-position"><?php echo $edu['edu_degree']; ?></h3>
                                        <p class="cv-timeline-company"><?php echo $edu['edu_institution']; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>

                <!-- COLUMNA DERECHA - SIDEBAR -->
                <div class="cv-sidebar">
                    
                    <!-- HABILIDADES -->
                    <?php if ($cv_skills) : ?>
                        <section class="cv-section">
                            <h2 class="cv-section-title">Habilidades</h2>
                            <div class="cv-skills">
                                <?php foreach ($cv_skills as $skill) : ?>
                                    <div class="cv-skill">
                                        <?php echo $skill['skill_name']; ?>
                                        <?php if (!empty($skill['skill_level'])) : ?>
                                            <span class="cv-skill-level"><?php echo $skill['skill_level']; ?>%</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- IDIOMAS -->
                    <?php if ($cv_languages) : ?>
                        <section class="cv-section">
                            <h2 class="cv-section-title">Idiomas</h2>
                            <div class="cv-languages">
                                <?php foreach ($cv_languages as $lang) : ?>
                                    <div class="cv-language">
                                        <span class="cv-language-name"><?php echo $lang['lang_name']; ?></span>
                                        <span class="cv-language-level"><?php echo $lang['lang_level']; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- CERTIFICACIONES -->
                    <?php if ($cv_certifications) : ?>
                        <section class="cv-section">
                            <h2 class="cv-section-title">Certificaciones</h2>
                            <ul class="cv-certifications">
                                <?php foreach ($cv_certifications as $cert) : ?>
                                    <li>
                                        <?php echo $cert['cert_name']; ?>
                                        <?php if (!empty($cert['cert_year'])) : ?>
                                            <span class="cert-year">(<?php echo $cert['cert_year']; ?>)</span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </section>
                    <?php endif; ?>
                </div>
            </div>

            <!-- FOOTER DEL CV -->
            <div class="cv-footer">
                <p>Referencias disponibles bajo petición</p>
            </div>

        </article>
    </div>
</main>

<?php
get_footer();