<?php

// REQUIRE para traer funciones VS INCLUDE que traemos templates

require 'includes/funciones.php';

incluirTemplate('header'); //LLAMAMAOS A LA FUNCION CON EL NOMBRE DEL ARCHIVO DE LA CARPETA TEMPLATE


?>


<main class="contenedor seccion">

    <h2>Casas y Departamentos en Venta</h2>

    <?php

    $limite = 10;

    include 'includes/templates/anuncios.php';

    ?>



</main>

<?php

incluirTemplate('footer');

?>