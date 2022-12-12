<?php

require_once('conexion.php');

class Plataforma extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar_plataformas()
    {
        $plataformas = [];

        $query = "CALL SP_LISTAR_PLATAFORMAS()";
        $stmt = $this->_db->prepare($query);
        $stmt->execute();

        $resp = $stmt->get_result();

        while ($plat = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($plataformas, $plat);
        }

        return $plataformas;
    }

    public function listar_plataformas_destacadas()
    {
        $plataformas = [];

        $query = "CALL SP_LISTAR_PLATAFORMAS()";
        $stmt = $this->_db->prepare($query);
        $stmt->execute();

        $resp = $stmt->get_result();

        while ($plat = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($plataformas, $plat);
        }

        return $plataformas;
    }
}
