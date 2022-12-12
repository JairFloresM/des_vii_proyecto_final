<?php

include_once('../class/cliente.php');

$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$correo = $_REQUEST['correo'];
$contrasenia = $_REQUEST['contrasenia'];
$req_contrasenia = $_REQUEST['rep_contrasenia'];
$pais = $_REQUEST['pais'];
$direccion = $_REQUEST['direccion'];



if (
    !empty($nombre) &&
    !empty($apellido) &&
    !empty($correo) &&
    !empty($contrasenia) &&
    !empty($req_contrasenia) &&
    !empty($pais) &&
    !empty($direccion)
) {

    $obj_clientes = new Cliente();

    $resp = $obj_clientes->validar_correo($correo);

    if ($resp->num_rows == 0) {
        if ($contrasenia == $req_contrasenia) {

            $salt = substr($correo, 0, 2);
            $clave_crypt = crypt($contrasenia, $salt);

            $obj_clientes->crear_cliente($nombre, $apellido, $correo, $clave_crypt, $pais, $direccion);

            header("Location: ../views/login.php");
        } else {

            header("Location: ../views/registrar.php");
        }
    } else {

        header("Location: ../views/registrar.php");
    }
} else {

    header("Location: ../views/registrar.php");
}
