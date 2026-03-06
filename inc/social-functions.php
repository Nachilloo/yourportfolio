<?php
/**
 * Funciones helper para redes sociales con iconos Font Awesome
 *
 * @package YourPortfolio
 */

if (!defined('ABSPATH')) exit;

/**
 * Mapa de iconos por defecto para cada plataforma
 */
function yourportfolio_get_default_icons() {
    return array(
        'linkedin' => 'fa-brands fa-linkedin',
        'github' => 'fa-brands fa-github',
        'github-alt' => 'fa-brands fa-github-alt',
        'twitter' => 'fa-brands fa-x-twitter',
        'instagram' => 'fa-brands fa-instagram',
        'facebook' => 'fa-brands fa-facebook',
        'facebook-f' => 'fa-brands fa-facebook-f',
        'youtube' => 'fa-brands fa-youtube',
        'tiktok' => 'fa-brands fa-tiktok',
        'pinterest' => 'fa-brands fa-pinterest',
        'behance' => 'fa-brands fa-behance',
        'dribbble' => 'fa-brands fa-dribbble',
        'medium' => 'fa-brands fa-medium',
        'dev' => 'fa-brands fa-dev',
        'codepen' => 'fa-brands fa-codepen',
        'stack-overflow' => 'fa-brands fa-stack-overflow',
        'stackoverflow' => 'fa-brands fa-stack-overflow',
        'twitch' => 'fa-brands fa-twitch',
        'discord' => 'fa-brands fa-discord',
        'telegram' => 'fa-brands fa-telegram',
        'whatsapp' => 'fa-brands fa-whatsapp',
        'tumblr' => 'fa-brands fa-tumblr',
        'flickr' => 'fa-brands fa-flickr',
        'vimeo' => 'fa-brands fa-vimeo',
        'spotify' => 'fa-brands fa-spotify',
        'lastfm' => 'fa-brands fa-lastfm',
        'soundcloud' => 'fa-brands fa-soundcloud',
        'bandcamp' => 'fa-brands fa-bandcamp',
        'etsy' => 'fa-brands fa-etsy',
        'goodreads' => 'fa-brands fa-goodreads',
        'strava' => 'fa-brands fa-strava',
        'envelope' => 'fa-solid fa-envelope',
        'link' => 'fa-solid fa-link',
        'globe' => 'fa-solid fa-globe',
        'rss' => 'fa-solid fa-rss',
        'other' => 'fa-solid fa-link'
    );
}

/**
 * Obtiene el icono para una plataforma
 */
function yourportfolio_get_social_icon($platform, $custom_icon = '') {
    $default_icons = yourportfolio_get_default_icons();
    
    // Si hay icono personalizado, usarlo
    if (!empty($custom_icon)) {
        return $custom_icon;
    }
    
    // Si existe icono por defecto para la plataforma, usarlo
    if (isset($default_icons[$platform])) {
        return $default_icons[$platform];
    }
    
    // Buscar coincidencias parciales (por si acaso)
    foreach ($default_icons as $key => $icon) {
        if (strpos($platform, $key) !== false) {
            return $icon;
        }
    }
    
    // Icono genérico por defecto
    return 'fa-solid fa-link';
}

/**
 * Muestra las redes sociales
 * 
 * @param string $location Ubicación (header, footer, cv, contact)
 * @param array $args Argumentos adicionales
 */
function yourportfolio_social_links($location = 'footer', $args = array()) {
    


    // Verificar si debemos mostrar
    $show = get_field('social_global_show', 'option');
    if (!$show) return '';
    
    // Verificar visibilidad por ubicación
    $show_location = get_field('social_show_' . $location, 'option');
    if ($show_location === false || $show_location === 0) return '';
    
    // Obtener redes - con validación
    $social_links = get_field('social_links', 'option');
    
    // Si no hay redes o no es un array, salir
    if (empty($social_links) || !is_array($social_links)) {
        return '';
    }
    
    // Configuración de estilos
    $icon_style = get_field('social_icon_style', 'option') ?: 'circles';
    $icon_size = get_field('social_icon_size', 'option') ?: 'medium';
    $target = get_field('social_target_blank', 'option') ? '_blank' : '_self';
    $use_default_icons = get_field('social_default_icons', 'option');
    
    // Si use_default_icons es null, poner true por defecto
    if ($use_default_icons === null) {
        $use_default_icons = true;
    }
    
    // Colores (valores por defecto)
    $icon_color = '#ffffff';
    $bg_color = 'rgba(255,255,255,0.1)';
    $hover_color = '#ffffff';
    $hover_bg = 'rgba(255,255,255,0.2)';
    
    // Generar ID único para estilos
    $style_id = 'social-' . uniqid();
    
    // Array para nombres de plataformas
    $platform_names = array(
        'linkedin' => 'LinkedIn',
        'github' => 'GitHub',
        'github-alt' => 'GitHub',
        'twitter' => 'X',
        'instagram' => 'Instagram',
        'facebook' => 'Facebook',
        'facebook-f' => 'Facebook',
        'youtube' => 'YouTube',
        'tiktok' => 'TikTok',
        'pinterest' => 'Pinterest',
        'behance' => 'Behance',
        'dribbble' => 'Dribbble',
        'medium' => 'Medium',
        'dev' => 'Dev.to',
        'codepen' => 'CodePen',
        'stack-overflow' => 'Stack Overflow',
        'stackoverflow' => 'Stack Overflow',
        'twitch' => 'Twitch',
        'discord' => 'Discord',
        'telegram' => 'Telegram',
        'whatsapp' => 'WhatsApp',
        'tumblr' => 'Tumblr',
        'flickr' => 'Flickr',
        'vimeo' => 'Vimeo',
        'spotify' => 'Spotify',
        'lastfm' => 'Last.fm',
        'soundcloud' => 'SoundCloud',
        'bandcamp' => 'Bandcamp',
        'etsy' => 'Etsy',
        'goodreads' => 'Goodreads',
        'letterboxd' => 'Letterboxd',
        'strava' => 'Strava',
        'envelope' => 'Email',
        'link' => 'Enlace',
        'globe' => 'Web',
        'rss' => 'RSS',
        'other' => 'Otro'
    );
    
    ?>
    <div class="social-links-wrapper style-<?php echo esc_attr($icon_style); ?> size-<?php echo esc_attr($icon_size); ?>" id="<?php echo esc_attr($style_id); ?>">
        
        <?php 
        // Iterar sobre cada red social
        foreach ($social_links as $link) : 
            
            // Verificar que $link es un array y tiene los campos necesarios
            if (!is_array($link)) continue;
            
            $platform = isset($link['social_platform']) ? $link['social_platform'] : 'other';
            $url = isset($link['social_url']) ? $link['social_url'] : '#';
            $custom_name = isset($link['social_custom_name']) ? $link['social_custom_name'] : '';
            $custom_icon = isset($link['social_fa_icon']) ? $link['social_fa_icon'] : '';
            
            // Determinar nombre a mostrar
            if ($platform === 'other' && !empty($custom_name)) {
                $name = $custom_name;
            } else {
                $name = isset($platform_names[$platform]) ? $platform_names[$platform] : ucfirst($platform);
            }
            
            // Obtener icono
            $icon_class = yourportfolio_get_social_icon($platform, $custom_icon);
            
            // Saltar si no hay URL válida
            if (empty($url) || $url === '#') continue;
        ?>
        
        <a href="<?php echo esc_url($url); ?>" 
           class="social-link social-<?php echo esc_attr($platform); ?>"
           target="<?php echo esc_attr($target); ?>"
           rel="noopener noreferrer"
           title="<?php echo esc_attr($name); ?>">
            
            <?php if ($use_default_icons) : ?>
                <i class="<?php echo esc_attr($icon_class); ?>" aria-hidden="true"></i>
                <?php if ($icon_style === 'text_with_bg') : ?>
                    <span class="social-text"><?php echo esc_html($name); ?></span>
                <?php endif; ?>
            <?php else : ?>
                <span class="social-initials">
                    <?php echo esc_html(substr($name, 0, 2)); ?>
                </span>
            <?php endif; ?>
            
        </a>
        
        <?php endforeach; ?>
    </div>
    
    <style>
        #<?php echo $style_id; ?> .social-link {
            color: <?php echo $icon_color; ?>;
            background-color: <?php echo $bg_color; ?>;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 0;
            padding: 0;
            border: none;
            cursor: pointer;
        }
        
        #<?php echo $style_id; ?> .social-link:hover {
            color: <?php echo $hover_color; ?>;
            background-color: <?php echo $hover_bg; ?>;
            transform: translateY(-3px);
        }
        
        #<?php echo $style_id; ?> .social-link i {
            font-size: inherit;
            line-height: 1;
            width: auto;
            height: auto;
        }
        
        <?php if ($icon_style === 'text') : ?>
        #<?php echo $style_id; ?> .social-link {
            background: none !important;
        }
        #<?php echo $style_id; ?> .social-link:hover {
            background: none !important;
            transform: translateY(-2px);
        }
        <?php endif; ?>
        
        /* Tamaños */
        <?php if ($icon_size === 'small') : ?>
        #<?php echo $style_id; ?> .social-link {
            width: 32px;
            height: 32px;
            font-size: 16px;
        }
        <?php elseif ($icon_size === 'medium') : ?>
        #<?php echo $style_id; ?> .social-link {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }
        <?php elseif ($icon_size === 'large') : ?>
        #<?php echo $style_id; ?> .social-link {
            width: 48px;
            height: 48px;
            font-size: 24px;
        }
        <?php endif; ?>
        
        /* Estilos */
        <?php if ($icon_style === 'circles') : ?>
        #<?php echo $style_id; ?> .social-link {
            border-radius: 50%;
        }
        <?php elseif ($icon_style === 'squares') : ?>
        #<?php echo $style_id; ?> .social-link {
            border-radius: 4px;
        }
        <?php elseif ($icon_style === 'rounded') : ?>
        #<?php echo $style_id; ?> .social-link {
            border-radius: 8px;
        }
        <?php elseif ($icon_style === 'text_with_bg') : ?>
        #<?php echo $style_id; ?> .social-link {
            width: auto !important;
            height: auto !important;
            padding: 8px 16px;
            border-radius: 20px;
            gap: 8px;
        }
        #<?php echo $style_id; ?> .social-link i {
            font-size: 1.2em;
        }
        #<?php echo $style_id; ?> .social-text {
            font-size: 0.9em;
        }
        <?php endif; ?>
        
        /* Efecto hover para iconos */
        #<?php echo $style_id; ?> .social-link:hover i {
            animation: social-pulse-<?php echo $style_id; ?> 0.3s ease;
        }
        
        @keyframes social-pulse-<?php echo $style_id; ?> {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            #<?php echo $style_id; ?> {
                justify-content: center;
            }
        }
    </style>
    <?php
}

/**
 * Ejemplo de datos por defecto para importar (solo como referencia)
 */
function yourportfolio_get_default_social_data() {
    return array(
        array(
            'social_platform' => 'linkedin',
            'social_url' => 'https://linkedin.com/in/tuusuario',
            'social_fa_icon' => 'fa-brands fa-linkedin'
        ),
        array(
            'social_platform' => 'github',
            'social_url' => 'https://github.com/tuusuario',
            'social_fa_icon' => 'fa-brands fa-github'
        ),
        array(
            'social_platform' => 'twitter',
            'social_url' => 'https://twitter.com/tuusuario',
            'social_fa_icon' => 'fa-brands fa-x-twitter'
        ),
        array(
            'social_platform' => 'instagram',
            'social_url' => 'https://instagram.com/tuusuario',
            'social_fa_icon' => 'fa-brands fa-instagram'
        ),
    );
}