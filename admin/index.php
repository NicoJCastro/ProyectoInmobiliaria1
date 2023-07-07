<?php

// REQUIRE para traer funciones VS INCLUDE que traemos templates

require '../includes/funciones.php';

$auth = estadoAutenticado();

if(!$auth) {
    header('Location: /');
}

//Importamos la conexión

require '../includes/config/database.php';
$db = conectarDB();

//Escribimos el Query

$query = "SELECT * FROM propiedades";

//Consultar la BD

$resultadoConsulta = mysqli_query($db, $query);

// ESTAS TRES COSAS 1)IMPORTAR LA CONEXION 2) ESCRIBIR EL QUERY 3) CONSULTAR LA DB LO HACEMOS CASI SIEMPRE APRENDER!!!


// Muestra un mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id){
        //ELIMINAR EL ARCHIVO

        $query = "SELECT imagen FROM propiedades WHERE id = $id";

        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink('../imagenes/' . $propiedad["imagen"]);

        //ELIMINA LA PROPIEDAD
        $query = "DELETE FROM propiedades WHERE id = $id";
        $resultado = mysqli_query($db, $query);
        if($resultado){
            header("Location: /admin?resultado=3"); 
        }
    }
}

// REQUIRE para traer funciones VS INCLUDE que traemos templates
// Incluye un template

incluirTemplate('header'); //LLAMAMAOS A LA FUNCION CON EL NOMBRE DEL ARCHIVO DE LA CARPETA TEMPLATE

?>


<main class="contenedor seccion">
    <h1>ADMINISTRADOR DE BIENES RAICES</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif(intval($resultado) === 2) : ?>  
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif(intval($resultado) === 3) : ?>  
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>

    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--Mostrar los Resultados-->
            <?php while ($propiedad =  mysqli_fetch_assoc($resultadoConsulta)) :  ?>
                <tr>
                    <td> <?php echo $propiedad['id']; ?> </td>
                    <td> <?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla" alt=""></td>
                    <td>$<?php echo $propiedad['precio']; ?></td>
                    <td>

                        <form method="POST" class="w-100">

                            <!-- Input hidden -->
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">

                        </form>

                        
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>

            </tbody>
        </table>

</main>

<?php

// Cerrar la conexión OPCIONAL

mysqli_close($db);

incluirTemplate('footer');

?>