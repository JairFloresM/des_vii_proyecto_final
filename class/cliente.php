<?php

require_once('conexion.php');

class Cliente extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function validar_correo($correo)
    {
        $query = "CALL SP_VALIDAR_CORREO(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('s', $correo);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function crear_cliente($nombre, $apellido, $correo, $contrasenia, $pais, $direccion)
    {
        $query = "CALL SP_CREAR_CLIENTE(?, ?, ?, ?, ?, ?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('ssssss', $nombre, $apellido, $correo, $contrasenia, $pais, $direccion);
        $stmt->execute();
    }

    public function usuario_actual($id)
    {
        $query = "CALL SP_CLIENTE_ACTUAL(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    }
}
