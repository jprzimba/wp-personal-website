<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme=<?php echo esc_attr(get_theme_mod('selected_theme')); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.2.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?php echo wp_get_document_title(); ?></title>

    <?php wp_head(); // Função necessária para incluir scripts e estilos do WordPress ?>
</head>
<body class="bg-base-100 text-base-content">
<header>
    <div class="container mx-auto flex md:flex-row items-center justify-between p-4">
        <h1 class="text-xl font-bold">
            <a href="<?php echo esc_url(get_theme_mod('jprzimba_logo_link', home_url('/'))); ?>">
                <?php echo esc_html(get_theme_mod('jprzimba_logo_text', get_bloginfo('name'))); ?>
            </a>
        </h1>

        <nav class="text-lg md:flex hidden">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container' => false,
                'menu_class' => 'flex space-x-4',
                'link_before' => '<span class="hover:bg-base-200 px-4 py-2 rounded-md">',
                'link_after' => '</span>',
            ));
            ?>
        </nav>

        <div class="md:hidden flex justify-end">
            <button id="menu-toggle" class="focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    <nav id="mobile-menu" class="md:hidden bg-base-100 w-screen h-screen fixed top-0 left-0 flex justify-center items-center">
        <button id="menu-close" class="absolute top-4 right-6 text-gray-600 hover:text-gray-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'container' => false,
            'menu_class' => 'flex flex-col space-y-4',
            'link_before' => '<span class="hover:bg-base-200 px-4 py-2 rounded-md">',
            'link_after' => '</span>',
        ));
        ?>
    </nav>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        document.getElementById('menu-close').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    </script>

</header>
