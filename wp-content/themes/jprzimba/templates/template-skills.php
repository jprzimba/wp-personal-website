<?php
/*
 * Template Name: Skills Page
 */

get_header(); // Include the header template
?>

<div id="skills" class="max-w-screen-2xl mx-auto px-4 sm:px-6 md:px-10 mt-24">
  <div class="flex justify-between mb-10">
    <div class="text-base-content w-2/3 font-medium flex items-center gap-2">
      <div>
        <span class="text-primary">#</span>
        habilidades
      </div>
      <div class="line w-1/3 sm:w-2/4 h-px bg-primary"></div>
    </div>
  </div>

  <!-- Large Screens -->
  <div class="flex flex-col items-center justify-center">
    <div class="flex flex-wrap gap-4 justify-center">
      <?php
      $skills_json_url = home_url('/wp-content/uploads/api/skills.json');
      $skills_json = file_get_contents($skills_json_url);
      $skills = json_decode($skills_json, true);

      if (!empty($skills)) {
        foreach ($skills as $item) {
          $isIconInvertible = $item['id'] === 3 || $item['id'] === 4;
          $iconClass = 'w-16 h-16 md:w-28 md:h-28 mb-4 text-base-content';
          if ($isIconInvertible) {
            $iconClass .= ' invert';
          }
          ?>
          <div class="mb-4 w-[250px] border border-primary rounded-lg flex flex-col items-center justify-center text-center h-72 shadow-md shadow-primary bg-base-200">
            <img src="<?php echo esc_url($item['icon']); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="<?php echo esc_attr($iconClass); ?>" />
            <div>
              <h2 class="text-xl font-bold mb-2"><?php echo esc_html($item['title']); ?></h2>
              <p class="text-sm p-2"><?php echo esc_html($item['description']); ?></p>
            </div>
          </div>
          <?php
        }
      }
      ?>
    </div>
  </div>
</div>

<?php get_footer(); // Include the footer template ?>
