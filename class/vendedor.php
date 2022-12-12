<?php

require_once('conexion.php');

class Vendedor extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function validar_correo($correo)
    {
        $query = "CALL SP_VALIDAR_CORREO_VEN(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('s', $correo);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function usuario_actual($id)
    {
        $query = "CALL SP_VENDEDOR_ACTUAL(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    }
}
