<?php

// validamos el id

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /');
}

//Importar la Bd

require 'includes/config/database.php';
$db = conectarDB();

//Consultar

$query = "SELECT * FROM propiedades WHERE id = $id";

//Obtener los resultados 
$resultado = mysqli_query($db, $query);

if(!$resultado->num_rows === 0) {
    header('Location: /');
}

$propiedad = mysqli_fetch_assoc($resultado);

// REQUIRE para traer funciones VS INCLUDE que traemos templates

require 'includes/funciones.php';

incluirTemplate('header'); //LLAMAMAOS A LA FUNCION CON EL NOMBRE DEL ARCHIVO DE LA CARPETA TEMPLATE


?>


<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>
    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="destacada">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad['precio']; ?> </p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono_estacionamiento">
                <p><?php echo $propiedad['estacionamientos']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>
        <?php echo $propiedad['descripcion']; ?>
    </div>
</main>


<?php

mysqli_close($db);

incluirTemplate('footer');

?>

<!-- CREAMOS ESTE BASE.HTML POR LAS DUDAS QUE QUIERA AGRAGAR MAS PAGINAS -->