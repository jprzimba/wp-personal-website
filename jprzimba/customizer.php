<?php
function custom_theme_options_customizer_settings($wp_customize) {
    $wp_customize->add_section('custom_theme_options', array(
        'title' => 'Theme Options',
        'priority' => 30,
    ));

    $wp_customize->add_setting('selected_theme', array(
        'default' => 'light',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('selected_theme', array(
        'label' => 'Select Theme',
        'section' => 'custom_theme_options',
        'type' => 'select',
        'choices' => array(
            'light' => 'Light',
            'dark' => 'Dark',
            'forest' => 'Forest',
            'aqua' => 'Aqua',
        ),
    ));
}
add_action('customize_register', 'custom_theme_options_customizer_settings');
