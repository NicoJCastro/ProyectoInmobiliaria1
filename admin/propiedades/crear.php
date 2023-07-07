<?php

// REQUIRE para traer funciones VS INCLUDE que traemos templates

require '../../includes/funciones.php';
$auth = estadoAutenticado();

if (!$auth) {
    header('Location: /');
}



// Conectar a la base de datos llamando la funcion de database.php

require '../../includes/config/database.php';
$db = conectarDB();

//Consultamos para obtener los vendedores

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//   ARREGLO POR MENSAJE ERRORES

$errores = [];

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamientos = '';
$Vendedores_id = '';


// Ejecutar el codigo despues que el usuario envie el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $titulo = mysqli_real_escape_string($db,  $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamientos = mysqli_real_escape_string($db, $_POST['estacionamientos']);
    $Vendedores_id = mysqli_real_escape_string($db, $_POST['Vendedores_id']);
    $creado = date('Y/m/d');

    //Asignar files hacia una variable

    $imagen = $_FILES['imagen'];



    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "Debes añadir un precio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "Debes añadir una descripcion y debe tener 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "Debes completar el campo habitaciones";
    }

    if (!$wc) {
        $errores[] = "Debes completar el campo baños";
    }

    if (!$estacionamientos) {
        $errores[] = "Debes completar el campo estacionamientos";
    }

    if (!$Vendedores_id) {
        $errores[] = "Debes completar el campo vendedor";
    }

    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = "No has seleccionado ninguna imagen para la propiedad. O la imagen es muy pesada";
    }

    //VALIDAR POR TAMAÑO DE LAS IMGAGENES

    $medida = 1000 * 1000; //Convertir de bytes a kbytes

    if ($imagen['size'] > $medida) {
        $errores[] = 'La imágen es muy pesada';
    }


    //Revisar que el arreglo de errores este vacio

    // isset() revisa que una variable este creada devuelve un true o false, si no es Null devuelve un true, 
    // empty() se utiliza para verificar si una variable está vacía o si su valor es considerado como "vacío".
    // retorna true si la variable está vacía o tiene un valor considerado como "vacío", y false en caso contrario.

    if (empty($errores)) {

        // Subida de archivos  ejemplo como imagenes

        //CREAR CARPETA

        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        //Generar un nombre único

        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Subir la imagen en la carpeta

        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        // Insertar en base de datos, se debe ejecutar de forma condicional, que el arreglo de errores este vacio. 

        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamientos, creado, Vendedores_id)
                   VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamientos', '$creado', '$Vendedores_id' ) ";

        // echo $query;
        $resultado = mysqli_query($db, $query);

        if ($resultado) {

            //Redireccionamos al usuario porque se agrego correctamente los dato que puso en el formulario, entonces no se duplican los datos

            header("Location: /admin?resultado=1");
            //se puede usar aca header() funciona porque no hay nada de html previo. 
        }
    }
}


// REQUIRE para traer funciones VS INCLUDE que traemos templates

// require '../../includes/funciones.php'; SE ELIMINA PORQUE NO PUEDE HABER 2 REQUIRE. ARRIBA TRAEMOS ESTA FUNCION Y LA DE SESSION

incluirTemplate('header'); //LLAMAMAOS A LA FUNCION CON EL NOMBRE DEL ARCHIVO DE LA CARPETA TEMPLATE

?>


<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>

        <div class="alerta error">

            <?php echo $error; ?>

        </div>


    <?php endforeach; ?>

    <!-- FORMULARIO PARA AGREGAR UNA PROPIEDAD -->

    <!-- Metodo GET y POST -->
    <!-- GET: agrega valores a la url, no es recomendable para mandar datos a un servidor -->
    <!-- POST: maneja internamente los valores en el archivo, no aparece en url. Mejor para formularios -->
    <!-- accedemos a esos datos con $_GET, $_POST y $_SERVER -->

    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">

        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo: </label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio: </label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripcion de la propiedad: </label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>

        </fieldset>

        <fieldset>

            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc ?>">

            <label for="estacionamientos">Estacionamientos</label>
            <input type="number" id="estacionamientos" name="estacionamientos" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamientos ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="Vendedores_id" id="Vendedores_id" value="<?php echo $Vendedores_id ?>">
                <option disabled selected hidden>Selecciona un vendedor:</option>
                <?php while ($row = mysqli_fetch_assoc($resultado)) :  ?>
                    <option <?php echo $Vendedores_id === $row['id'] ? 'selected' : '';  ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . " " . $row['apellido']; ?></option>
                <?php endwhile; ?>

            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">


    </form>

</main>

<?php

incluirTemplate('footer');

?>