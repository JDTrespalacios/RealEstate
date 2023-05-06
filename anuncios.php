<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h2>Houses & Apartments For Sale</h2>

        <?php 

            $limite = 15;
            include 'includes/templates/anuncios.php';
        ?>

    </main>

<?php
    incluirTemplate('footer');
?>