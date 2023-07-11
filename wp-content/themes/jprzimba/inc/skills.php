<?php

// Add the following function in your theme's functions.php file or in a custom plugin
function my_theme_save_skills_data() {
    if (isset($_POST['my_theme_skills_nonce']) && wp_verify_nonce($_POST['my_theme_skills_nonce'], 'my_theme_skills_settings')) {
        $skill_title = sanitize_text_field($_POST['my_theme_skill_title']);
        $skill_description = sanitize_textarea_field($_POST['my_theme_skill_description']);

        $uploads_dir = wp_upload_dir();
        $api_dir = trailingslashit($uploads_dir['basedir']) . 'api';

        if (!file_exists($api_dir)) {
            wp_mkdir_p($api_dir);
        }

        $json_file_path = trailingslashit($api_dir) . 'skills.json';

        $skills_data = array();

        if (file_exists($json_file_path)) {
            $skills_data = json_decode(file_get_contents($json_file_path), true);
        }

        $skill_id = uniqid();
        $skill_icon_url = '';

        if (!empty($_FILES['my_theme_skill_icon']['name'])) {
            $file_info = pathinfo($_FILES['my_theme_skill_icon']['name']);
            $file_extension = strtolower($file_info['extension']);

            $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'svg');

            if (in_array($file_extension, $allowed_extensions)) {
                $new_file_name = $skill_id . '.' . $file_extension;
                $upload_file = trailingslashit($api_dir) . $new_file_name;

                move_uploaded_file($_FILES['my_theme_skill_icon']['tmp_name'], $upload_file);

                $skill_icon_url = trailingslashit($uploads_dir['baseurl']) . 'api/' . $new_file_name;
            }
        }

        $data = array(
            'id' => $skill_id,
            'title' => $skill_title,
            'description' => $skill_description,
            'icon' => $skill_icon_url,
        );

        $skills_data[] = $data;

        file_put_contents($json_file_path, json_encode($skills_data));
    }
}


function my_theme_settings_page() {
    if (isset($_POST['submit'])) {
        my_theme_save_skills_data();
        echo '<div class="notice notice-success"><p>Data saved successfully.</p></div>';
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" enctype="multipart/form-data" action="">
            <?php wp_nonce_field('my_theme_skills_settings', 'my_theme_skills_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="my_theme_skill_title">Skill Title</label></th>
                    <td><input type="text" name="my_theme_skill_title" id="my_theme_skill_title" value="<?php echo esc_attr(get_option('my_theme_skill_title')); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="my_theme_skill_description">Skill Description</label></th>
                    <td><textarea name="my_theme_skill_description" id="my_theme_skill_description" rows="5"><?php echo esc_textarea(get_option('my_theme_skill_description')); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="my_theme_skill_icon">Skill Icon</label></th>
                    <td><input type="file" name="my_theme_skill_icon" id="my_theme_skill_icon"></td>
                </tr>
            </table>
            <?php submit_button('Save Settings', 'primary', 'submit', false); ?>
        </form>
    </div>
    <?php
}

function my_theme_add_settings_page() {
    add_submenu_page(
        'themes.php',
        'Skills Settings',
        'Skills Settings',
        'manage_options',
        'my-theme-skills-settings',
        'my_theme_settings_page',
        'dashicons-admin-generic',
    );
}

function my_theme_skills_settings() {
    register_setting(
        'my_theme_skills_settings',
        'my_theme_skill_title'
    );

    register_setting(
        'my_theme_skills_settings',
        'my_theme_skill_description'
    );

    register_setting(
        'my_theme_skills_settings',
        'my_theme_skill_icon',
        'my_theme_sanitize_image_upload'
    );
}

function my_theme_sanitize_image_upload($file) {
    $upload_dir = wp_upload_dir();
    $image_data = wp_handle_upload($file, array('test_form' => false));

    if ($image_data && !isset($image_data['error'])) {
        $image_url = $image_data['url'];
        return $image_url;
    }

    return '';
}

add_action('admin_init', 'my_theme_skills_settings');
add_action('admin_menu', 'my_theme_add_settings_page');
