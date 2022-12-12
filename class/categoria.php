<?php

require_once('conexion.php');

class Categoria extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar_categorias()
    {
        $categorias = [];

        $query = "CALL SP_LISTAR_CATEGORIAS()";
        $stmt = $this->_db->prepare($query);
        $stmt->execute();

        $resp = $stmt->get_result();

        while ($cat = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($categorias, $cat);
        }

        return $categorias;
    }
}
