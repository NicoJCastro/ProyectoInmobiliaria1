<?php

require 'includes/config/database.php';
$db = conectarDB();



// AUTENTICAR EL USUARIO

$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) );
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email){
        $errores[] = "El email es obligatorio o no es válido";
    }

    if(!$password){
        $errores[] = "El password es obligatorio o no es válido";
    }

    if(empty($errores)) {

        //REvisamos si el usuario Existe

        $query = "SELECT * FROM usuarios WHERE email = '$email' ";
        $resultado = mysqli_query($db, $query);


        if($resultado->num_rows){
            //Revisar si el Password es Correcto

            $usuario = mysqli_fetch_assoc($resultado);

            $auth = password_verify($password, $usuario['password']);

            if($auth){
                //El usuario esta autenticado

                session_start();

                //Llenar el arrego de la sesión

                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

               // Una Vez que INICIAMOS SESSION REDIRECCIONAMOS A :
                
               header('Location: /admin');

                

            } else{
                $errores[] = "El Password es INCORRECTO";
            }

            // var_dump($auth);


        }else{
            $errores[] = 'El Usuario NO Existe';
        }



    }

    

}

// REQUIRE para traer funciones VS INCLUDE que traemos templates, en este caso para traer el header

require 'includes/funciones.php';

incluirTemplate('header'); //LLAMAMAOS A LA FUNCION CON EL NOMBRE DEL ARCHIVO DE LA CARPETA TEMPLATE


?>


    <main class="contenedor seccion contenido-centrado">
        <h1>INICIAR SESION</h1>

        <?php foreach($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST">

        <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu E-mail" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password"  placeholder="Tu Password" id="password" required> 

                                
            </fieldset> <!--informacion personal-->

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

        </form>
    </main>

    <?php

incluirTemplate('footer');

?>

