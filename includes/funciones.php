<!-- FUNCIONES PARA REUTILIZAR -->

<?php

// FUNCION PARA USAR LOS TEMPLATE

require 'app.php';

function incluirTemplate(string $nombre, bool $inicio = false)
{

    include TEMPLATES_URL . "/$nombre.php";
}

// FUNCION PARA CONTROLAR SESSION

function estadoAutenticado(): bool {
    session_start();
   
    $auth = $_SESSION['login'];

    if ($auth) {
        return true;
    }

     return false;
}
