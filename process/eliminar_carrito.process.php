<?php

include_once('../class/juego.php');

$id = $_REQUEST['id'];

if (
    !empty($id)
) {
    $obj_juego = new Juego();
    $obj_juego->eliminar_carrito($id);
}

header("Location: ../views/Cliente/carrito.php");
