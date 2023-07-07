<?php

// REQUIRE para traer funciones VS INCLUDE que traemos templates

require 'includes/funciones.php';

incluirTemplate('header'); //LLAMAMAOS A LA FUNCION CON EL NOMBRE DEL ARCHIVO DE LA CARPETA TEMPLATE


?>


    <main class="contenedor seccion">
        <h1>Titulo Página</h1>
    </main>

    <?php

incluirTemplate('footer');

?>

<!-- CREAMOS ESTE BASE.HTML POR LAS DUDAS QUE QUIERA AGRAGAR MAS PAGINAS -->