<?php

include_once('../class/cliente.php');
include_once('../class/vendedor.php');

$correo = $_REQUEST['correo'];
$contrasenia = $_REQUEST['contrasenia'];


if (
    !empty($correo) &&
    !empty($contrasenia)
) {
    $obj_clientes = new Cliente();

    $cliente = $obj_clientes->validar_correo($correo)->fetch_array(MYSQLI_ASSOC);
    if (!empty($cliente)) {
        $conta_sql = $cliente['CONTRASENIA'];

        $salt = substr($correo, 0, 2);
        $clave_ = crypt($contrasenia, $salt);

        if (hash_equals($conta_sql, $clave_)) {

            session_start();
            $_SESSION['user_id'] = $cliente['ID'];
            $_SESSION['rol'] = 2;

            header("Location: ../views/Cliente/inicio.php");
        }

        echo "erro contra cliente---" . $conta_sql . "--------" . $clave_;
    } else {
        $obj_vendedor = new Vendedor();
        $vendedor = $obj_vendedor->validar_correo($correo)->fetch_array(MYSQLI_ASSOC);

        if (!empty($vendedor)) {
            $conta_sql = $vendedor['CONTRASENIA'];

            if ($conta_sql == $contrasenia) {
                session_start();
                $_SESSION['user_id'] = $vendedor['ID'];
                $_SESSION['rol'] = 1;

                header("Location: ../views/Vendedor/inicio.php");
            } else {
                header("Location: ../views/login.php");
            }
        } else {
            header("Location: ../views/login.php");
        }
    }
} else {
    header("Location: ../views/login.php");
}
