<?php

// REQUIRE para traer funciones VS INCLUDE que traemos templates

require 'includes/funciones.php';

incluirTemplate('header'); //LLAMAMAOS A LA FUNCION CON EL NOMBRE DEL ARCHIVO DE LA CARPETA TEMPLATE


?>


    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>
    </main>

    <main class="nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy"  src="build/img/nosotros.jpg" alt="sobre Nosotros">
            </picture>
        </div>
        <div class="informacion">
            <blockquote>25 años de Experiencia</blockquote>
            <p>Corredor inmobiliario con más de 25 años de experiencia en el mercado, dedicada a la compra / 
                venta de propiedades residenciales y lotes para emprendimientos. Desde muy joven,
                 Marcelo comenzó a trabajar en el rubro, haciendo “guardias” los fines de semana. 
                 Se desarrolló durante años en el mercado tradicional, a fuerza de voluntad, amor por 
                 la profesión, y miles de horas de estudio y dedicación.</p>

            <p>Desde 2019 integra la red deinmobiliarios como líder de un equipo de vendedores de elite.
                 A partir del 2021 forma la División Terrenos, liderada por arquitectos especializados
                 en Código Urbanístico y Mercado de Tierras de CABA. Desde sus comienzos recorrió varias 
                 etapas de formación que hacen de Marcelo un corredor inmobiliario con una visión
                 muy completa del negocio y del mercado. Hábil tasador de inmuebles, profesor de alma, 
                 cocinero amateur, padre, deportista, lector.</p>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Afortunadamente, la seguridad de los inmuebles está evolucionando a 
                    grandes pasos hacia el desarrollo de nuevas  </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Afortunadamente, la seguridad de los inmuebles está evolucionando a 
                    grandes pasos hacia el desarrollo de nuevas  </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>Afortunadamente, la seguridad de los inmuebles está evolucionando a 
                    grandes pasos hacia el desarrollo de nuevas. </p>
            </div>
        </div>
    </section>

    <?php

incluirTemplate('footer');

?>