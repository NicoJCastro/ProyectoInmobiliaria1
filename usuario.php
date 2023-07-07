<?php

// Importar la conexcion

require "includes/config/database.php";
$db = conectarDB();

//Crear un emial y pasword

$email = "correo@correo.com";
$password= "123456";


// HASHSEAR PASSWORD
$passwordHash = password_hash($password, PASSWORD_DEFAULT);


//Query para crear el usuario

$query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash'); ";

// echo $query;



// Insertamos el $query a la base de datos

mysqli_query($db, $query);




?>