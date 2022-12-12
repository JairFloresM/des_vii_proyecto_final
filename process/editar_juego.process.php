<?php
include_once('../class/juego.php');

$nombre = $_REQUEST['nombre'];
$id = $_REQUEST['id'];
$id_juego = $_REQUEST['id_juego'];
$descripcion = $_REQUEST['descripcion'];
$cantidad = $_REQUEST['cantidad'];
$precio = $_REQUEST['precio'];
$plataforma = $_REQUEST['plataforma'];
$categorias = $_REQUEST['categoria'];



if (
    !empty($nombre) &&
    !empty($id) &&
    !empty($id_juego) &&
    !empty($descripcion) &&
    !empty($cantidad) &&
    !empty($precio) &&
    !empty($categorias)
) {
    $obj_juego = new Juego();
    $nombreDelArchivo = '';


    $obj_juego->actualizar_juego($id_juego, $nombre, $descripcion, $id, $plataforma, $precio, $cantidad, $nombreDelArchivo);

    $obj_juego->actualizar_categorias_juego($id_juego);

    foreach ($categorias as $cat) {
        $obj_juego->agregar_categorias_juego($id_juego, $cat);
    }

    header("Location: ../views/Vendedor/inicio.php");
} else {
    header("Location: ../views/Vendedor/agregar.php");
}


//if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
//    $directorio = "archivos/";
//    $nombreDelArchivo = $_FILES['archivo']['name'];
//    $nombreCompleto = $directorio . $nombreDelArchivo;
//
//    if (is_file($nombreCompleto)) {
//        $idUnico = time();
//        $nombreDelArchivo = $idUnico . $nombreDelArchivo;
//        echo "archivo repetido, se cambiara el nombre a $nombreDelArchivo <br><br>";
//    }
//    echo "<br>";
//    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $directorio . $nombreDelArchivo)) {
//        echo "El archivo se ha subido correctamente al directorio $nombreCompleto";
//    } else {
//        echo "No se ha podido subir el archivo asdasds";
//    }
//} else {
//    echo "No se ha podido subir el archivo";
//}
//