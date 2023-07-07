<!-- CONEXION A LA BASE DE DATOS -->

<?php
function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', 'nina1436', 'bienesraices_crud');

    if(!$db){
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
}