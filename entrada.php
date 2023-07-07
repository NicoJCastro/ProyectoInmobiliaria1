<?php

// REQUIRE para traer funciones VS INCLUDE que traemos templates

require 'includes/funciones.php';

incluirTemplate('header'); //LLAMAMAOS A LA FUNCION CON EL NOMBRE DEL ARCHIVO DE LA CARPETA TEMPLATE


?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy"  src="build/img/destacada2.jpg" alt="destacada">
        </picture>

        <p class="informacion-meta">Escrito el: <span>2/2/23</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
                       
            <p>Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el 
               contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem 
               Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de
               usar textos como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo
               un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web 
               usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum"
               va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado
              de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por 
              accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).</p>
        </div>
    </main>

    <?php

incluirTemplate('footer');

?>

<!-- CREAMOS ESTE BASE.HTML POR LAS DUDAS QUE QUIERA AGRAGAR MAS PAGINAS -->