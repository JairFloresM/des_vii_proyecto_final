<?php

include_once('../class/juego.php');

$ids = $_REQUEST['ids'];


if (
    !empty($ids)
) {
    $obj_juego = new Juego();

    foreach ($ids as $id) {
        $canje = rand(1000000000, 1999999999);
        $obj_juego->actualizar_carrito($id, $canje);
        $obj_juego->actualizar_cantidad($id);
    }
}


header("Location: ../views/Cliente/inicio.php");
