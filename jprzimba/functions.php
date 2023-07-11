<?php
function jprzimba_customize_register($wp_customize) {
    // Adiciona a opção para fazer upload da foto
    $wp_customize->add_setting('jprzimba_profile_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'jprzimba_profile_image', array(
        'label' => 'Foto',
        'section' => 'jprzimba_header_options',
        'settings' => 'jprzimba_profile_image',
    )));

    // Adiciona uma seção para as opções do cabeçalho
    $wp_customize->add_section('jprzimba_header_options', array(
        'title' => 'Opções do Cabeçalho',
        'priority' => 30,
    ));

    // Adiciona a opção para personalizar o texto do logo
    $wp_customize->add_setting('jprzimba_logo_text', array(
        'default' => 'Nome do Site',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jprzimba_logo_text', array(
        'label' => 'Texto do Logo',
        'section' => 'jprzimba_header_options',
        'type' => 'text',
    ));

    // Adiciona a opção para personalizar o link do logo
    $wp_customize->add_setting('jprzimba_logo_link', array(
        'default' => home_url('/'),
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('jprzimba_logo_link', array(
        'label' => 'Link do Logo',
        'section' => 'jprzimba_header_options',
        'type' => 'text',
    ));
}

function jprzimba_add_page_template_to_dropdown($templates) {
    $templates['page-home.php'] = 'Página Inicial';
    return $templates;
}

function jprzimba_custom_title_tag($title, $sep) {
    global $wp_customize;

    if (isset($wp_customize)) {
        $site_title_display = get_theme_mod('jprzimba_site_title_display', 'text');

        if ($site_title_display === 'logo') {
            $logo_link = esc_url(get_theme_mod('jprzimba_logo_link', home_url('/')));
            $logo_text = esc_html(get_theme_mod('jprzimba_logo_text', get_bloginfo('name')));
            $logo = '<a href="' . $logo_link . '">' . $logo_text . '</a>';
            $title = $logo;
        }
    }

    return $title;
}

// Função para registrar as configurações personalizadas
function custom_theme_settings_register($wp_customize) {
    // Seção para as configurações de tema
    $wp_customize->add_section('theme_settings', array(
        'title' => 'Configurações do Tema',
        'priority' => 30,
    ));

    // Campo para selecionar o tema
    $wp_customize->add_setting('selected_theme', array(
        'default' => 'light',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('selected_theme', array(
        'label' => 'Selecionar tema',
        'section' => 'theme_settings',
        'type' => 'select',
        'choices' => array(
            'light' => 'Light',
            'dark' => 'Dark',
            'cupcake' => 'Cupcake',
            'bumblebee' => 'Bumblebee',
            'emerald' => 'Emerald',
            'corporate' => 'Corporate',
            'synthwave' => 'Synthwave',
            'retro' => 'Retro',
            'cyberpunk' => 'Cyberpunk',
            'valentine' => 'Valentine',
            'halloween' => 'Halloween',
            'garden' => 'Garden',
            'forest' => 'Forest',
            'aqua' => 'Aqua',
            'lofi' => 'Lofi',
            'pastel' => 'Pastel',
            'fantasy' => 'Fantasy',
            'wireframe' => 'Wireframe',
            'black' => 'Black',
            'luxury' => 'Luxury',
            'dracula' => 'Dracula',
            'cmyk' => 'CMYK',
            'autumn' => 'Autumn',
            'business' => 'Business',
            'acid' => 'Acid',
            'lemonade' => 'Lemonade',
            'night' => 'Night',
            'coffee' => 'Coffee',
            'winter' => 'Winter',
        ),
    ));
}

add_action('customize_register', 'jprzimba_customize_register');
add_filter('theme_page_templates', 'jprzimba_add_page_template_to_dropdown');
add_action('customize_register', 'custom_theme_settings_register');
add_filter('wp_title', 'jprzimba_custom_title_tag', 10, 2);
add_theme_support('title-tag');
