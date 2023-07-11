<?php
/*
 * Template Name: About Page
 */

get_header(); // Include the header template
?>

<div id="about" class="max-w-screen-2xl mx-auto px-4 sm:px-6 md:px-10 mt-14 flex flex-wrap justify-between items-center">
    <div class="w-full md:pr-8">
        <h1 class="text-4xl md:text-7xl font-bold mt-14 text-center text-base-content">
            A paixão alimenta o propósito!
        </h1>

        <div class="w-[90%] rounded-full overflow-hidden mt-10 lg:hidden">
            <?php
            $image_url = get_template_directory_uri() . '/images/me.png';
            echo '<img src="' . $image_url . '" alt="Profile photo" class="w-full h-full object-cover">';
            ?>
        </div>

        <h2 class="text-2xl font-bold my-10 text-base-content uppercase">
            Biografia
        </h2>

        <div class="flex flex-wrap lg:flex-nowrap">
            <p class="text-lg w-full lg:w-2/3">
                <?php
                $years_of_work = get_option('years_of_work');
                $clients_number = get_option('clients_number');
                $project_number = get_option('project_number');

                $clients_plural = $clients_number > 1 ? 's' : '';
                $projects_plural = $project_number > 1 ? 's' : '';
                $years_plural = $years_of_work > 1 ? 's' : '';

                echo 'Olá! sou João Paulo um profissional apaixonado por desenvolvimento web. Com mais de ' . $years_of_work . ' ' . ($years_of_work > 1 ? 'anos' : 'ano') . ' de experiência, tenho tido a oportunidade de trabalhar em diversos projetos desafiadores. Acredito que a tecnologia pode impactar positivamente a vida das pessoas e estou sempre em busca de aprender novas habilidades e aprimorar meu conhecimento técnico. Estou animado para compartilhar minhas habilidades e trabalhar com você para alcançar resultados incríveis.';
                ?>
            </p>

            <div class="hidden lg:flex w-[50%] rounded-full overflow-hidden">
                <?php
                $image_url = get_template_directory_uri() . '/images/me.png';
                echo '<img src="' . $image_url . '" alt="Minha foto" class="w-full h-full object-cover">';
                ?>
            </div>

            <ul class="mt-6 text-center flex lg:flex-col justify-center p-2 gap-5 sm:gap-10 lg:gap-2">
                <li class="text-md lg:text-lg flex flex-col items-center mb-8">
                    <span class="font-bold text-5xl lg:text-7xl text-base-content">
                        <?php echo $clients_number . ($clients_number > 1 ? '+' : ''); ?>
                    </span>
                    <?php echo $clients_number > 1 ? 'Clientes satisfeitos' : 'Cliente satisfeito'; ?>
                </li>

                <li class="text-md lg:text-lg flex flex-col items-center mb-8">
                    <span class="font-bold text-5xl lg:text-7xl text-base-content">
                        <?php echo $project_number . ($project_number > 1 ? '+' : ''); ?>
                    </span>
                    <?php echo $project_number > 1 ? 'Projetos concluídos' : 'Projeto concluído'; ?>
                </li>

                <li class="text-md lg:text-lg flex flex-col items-center">
                    <span class="font-bold text-5xl lg:text-7xl text-base-content">
                        <?php echo $years_of_work . ($years_of_work > 1 ? '+' : ''); ?>
                    </span>
                    <?php echo $years_of_work >= 2 ? 'anos' : 'ano'; ?> de experiência
                </li>
            </ul>
        </div>

        <?php
    // Import the skills template
    get_template_part('templates/template-skills');
    ?>
    </div>
</div>

<?php get_footer(); // Include the footer template ?>
