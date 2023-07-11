<?php
require_once get_template_directory() . '/inc/skills.php';


function jprzimba_customize_register($wp_customize) {
    // Adds option to upload photo
    $wp_customize->add_setting('jprzimba_profile_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'jprzimba_profile_image', array(
        'label' => 'Profile Photo',
        'section' => 'jprzimba_header_options',
        'settings' => 'jprzimba_profile_image',
    )));

    //Adds a section for header options
    $wp_customize->add_section('jprzimba_header_options', array(
        'title' => 'Header Settings',
        'priority' => 30,
    ));

    // Adds option to customize logo text
    $wp_customize->add_setting('jprzimba_logo_text', array(
        'default' => 'Website Name',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jprzimba_logo_text', array(
        'label' => 'Logo Text',
        'section' => 'jprzimba_header_options',
        'type' => 'text',
    ));

    // Adds option to customize logo link
    $wp_customize->add_setting('jprzimba_logo_link', array(
        'default' => home_url('/'),
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('jprzimba_logo_link', array(
        'label' => 'Logo Link',
        'section' => 'jprzimba_header_options',
        'type' => 'text',
    ));
}

function jprzimba_add_page_template_to_dropdown($templates) {
    $templates['templates/template-about.php'] = 'About';
    $templates['templates/template-home.php'] = 'Home';
    $templates['templates/template-skills.php'] = 'Skills';
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

// Function to register custom settings
function custom_theme_settings_register($wp_customize) {
    // Section for theme settings
    $wp_customize->add_section('theme_settings', array(
        'title' => 'Theme Settings',
        'priority' => 30,
    ));

    // Field to select theme
    $wp_customize->add_setting('selected_theme', array(
        'default' => 'light',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('selected_theme', array(
        'label' => 'Select Theme',
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

// Add a new custom font
function custom_theme_fonts() {
    // Loads the Teko font
    // Teko
    wp_enqueue_style('font-teko', get_theme_file_uri('/fonts/teko/Regular.ttf'), array(), '1.0', 'all');
    wp_enqueue_style('font-teko-light', get_theme_file_uri('/fonts/teko/Light.ttf'), array(), '1.0', 'all');
    wp_enqueue_style('font-teko-medium', get_theme_file_uri('/fonts/teko/Medium.ttf'), array(), '1.0', 'all');
    wp_enqueue_style('font-teko-semibold', get_theme_file_uri('/fonts/teko/SemiBold.ttf'), array(), '1.0', 'all');
    wp_enqueue_style('font-teko-bold', get_theme_file_uri('/fonts/teko/Bold.ttf'), array(), '1.0', 'all');

    // Poppins
    wp_enqueue_style('font-poppins', get_theme_file_uri('/fonts/poppins/Regular.ttf'), array(), '1.0', 'all');
    wp_enqueue_style('font-poppins-light', get_theme_file_uri('/fonts/poppins/Light.ttf'), array(), '1.0', 'all');
    wp_enqueue_style('font-poppins-medium', get_theme_file_uri('/fonts/poppins/Medium.ttf'), array(), '1.0', 'all');
    wp_enqueue_style('font-poppins-semibold', get_theme_file_uri('/fonts/poppins/SemiBold.ttf'), array(), '1.0', 'all');
    wp_enqueue_style('font-poppins-bold', get_theme_file_uri('/fonts/poppins/Bold.ttf'), array(), '1.0', 'all');
}


function import_custom_css() {
    //CSS Files
    wp_enqueue_style('main-css', get_template_directory_uri() . '/style.css');
}

function jprzimba_register_menus() {
    register_nav_menus(
        array(
            'primary-menu' => 'Default Menu', // Name and description
        )
    );
}

function jprzimba_theme_setup() {
    add_theme_support('custom-about-page', array(
        'years_of_work'   => 1,
        'clients_number'  => 1,
        'project_number'  => 4,
    ));
}


// Função para exibir a página de opções do tema
function theme_options_page() {
    ?>
    <div class="wrap">
        <h1>Configurações do Tema</h1>
        <form method="post" action="options.php">
            <?php
            // Adicione os campos de configuração aqui
            settings_fields('theme_options');
            do_settings_sections('theme_options');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Função de inicialização das configurações do tema
function theme_options_init() {
    register_setting('theme_options', 'years_of_work');
    register_setting('theme_options', 'clients_number');
    register_setting('theme_options', 'project_number');

    add_settings_section('theme_options_section', 'Theme Options', function() {
        echo '<p>Configure theme options:</p>';
    }, 'theme_options');

    add_settings_field('years_of_work', 'Years of Work', function() {
        $years_of_work = get_option('years_of_work');
        echo '<input type="number" name="years_of_work" value="' . esc_attr($years_of_work) . '" />';
    }, 'theme_options', 'theme_options_section');

    add_settings_field('clients_number', 'Clients Number', function() {
        $clients_number = get_option('clients_number');
        echo '<input type="number" name="clients_number" value="' . esc_attr($clients_number) . '" />';
    }, 'theme_options', 'theme_options_section');

    add_settings_field('project_number', 'Project Number', function() {
        $project_number = get_option('project_number');
        echo '<input type="number" name="project_number" value="' . esc_attr($project_number) . '" />';
    }, 'theme_options', 'theme_options_section');
}

// Adicione o submenu da página de opções
function add_theme_options_submenu() {
    add_submenu_page(
        'themes.php',
        'Theme Settings',
        'Theme Options',
        'manage_options',
        'theme-options',
        'theme_options_page'
    );
}

// Registre as funções de inicialização e criação do submenu
add_action('admin_init', 'theme_options_init');
add_action('admin_menu', 'add_theme_options_submenu');


add_action('after_setup_theme', 'jprzimba_theme_setup');
add_action('after_setup_theme', 'jprzimba_register_menus');
add_action('wp_enqueue_scripts', 'import_custom_css');
add_action('wp_enqueue_scripts', 'custom_theme_fonts');
add_action('customize_register', 'jprzimba_customize_register');
add_filter('theme_page_templates', 'jprzimba_add_page_template_to_dropdown');
add_action('customize_register', 'custom_theme_settings_register');
add_filter('wp_title', 'jprzimba_custom_title_tag', 10, 2);
add_theme_support('title-tag');
