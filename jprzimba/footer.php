<footer
      id="footer"
      class="max-w-screen-2xl mx-auto p-2 sm:p-4 md:p-6 dark:bg-custom-1100 mt-16 md:mt-10 border-t-2 border-primary"
    >
      <div class="flex flex-col lg:flex-row p-4 items-center justify-between w-full">
        <div class="flex gap-2 items-center p-2">
          <a
            class="cursor-pointer transition-all duration-500 text-xs md:text-md"
          >
            Política de Privacidade
          </a>
           | 
          <a
            class="cursor-pointer transition-all duration-500 text-xs md:text-md"
          >
            Termos de Uso
          </a>
        </div>

        <div class="p-2 text-xs md:text-md flex flex-col justify-center items-center">
          <p class="text-base-content p-1 md:p-0 text-xs md:text-md md:text-center">
          &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os direitos
            reservados.
          </p>
        </div>
      </div>
    </footer>
<?php wp_footer(); // Função necessária para incluir scripts e estilos do WordPress ?>
</body>
</html>
