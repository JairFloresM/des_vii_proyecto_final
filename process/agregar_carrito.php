<?php

include_once('../class/cliente.php');
include_once('../class/juego.php');

$user_id = $_REQUEST['id_cliente'];
$juego_id = $_REQUEST['id_juego'];


if (
    !empty($user_id) &&
    !empty($juego_id)
) {

    $obj_juego = new Juego();
    $obj_juego->agregar_carrito($juego_id, $user_id);

    header("Location: ../views/Cliente/inicio.php");
} else {
    header("Location: ../views/Cliente/inicio.php");
}
