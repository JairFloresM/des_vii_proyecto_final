<?php

include_once('../class/juego.php');

$id = $_REQUEST['id'];

if ($id) {
    $obj_juego = new Juego();
    $obj_juego->eliminar_juego($id);
}

header("Location: ../views/Vendedor/inicio.php");
