<?php

require_once('conexion.php');

class Juego extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }


    public function crear_juego($nombre, $descripcion, $id_ven, $id_plat, $precio, $cantidad, $dir)
    {
        $query = "CALL SP_CREAR_JUEGO(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('ssiidis', $nombre, $descripcion, $id_ven, $id_plat, $precio, $cantidad, $dir);
        if ($stmt->execute()) {
            $query = "SELECT MAX(id) as id FROM `JUEGOS`";
            $stmt = $this->_db->prepare($query);
            $stmt->execute();
            $resp = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $resp[0]['id'];
        }
        return 0;
    }

    public function agregar_categorias_juego($id_j, $id_c)
    {
        $query = "CALL SP_CREAR_CATEGORIA_JUEGOS(?, ?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('ii', $id_j, $id_c);
        $stmt->execute();
    }

    public function listar_juegos_vendedor($id)
    {
        $juegos = [];
        $query = "CALL SP_LISTAR_JUEGOS_VENDEDOR(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resp = $stmt->get_result();

        while ($jug = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($juegos, $jug);
        }

        return $juegos;
    }

    public function eliminar_juego($id)
    {
        $query = "CALL SP_ELIMINAR_JUEGO(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }


    public function buscar_juego($id)
    {
        $query = "CALL SP_BUSCAR_JUEGO(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    }


    public function buscar_juego_categoria($id)
    {
        $categorias = [];
        $query = "CALL SP_BUSCAR_JUEGO_CATEGORIA(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resp = $stmt->get_result();

        while ($jug = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($categorias, $jug);
        }

        return $categorias;
    }

    public function actualizar_juego($id_juego, $nombre, $descripcion, $id_plat, $precio, $cantidad, $dir)
    {
        $query = "CALL SP_ACTUALIZAR_JUEGO(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('issidis', $id_juego, $nombre, $descripcion, $id_plat, $precio, $cantidad, $dir);
        $stmt->execute();
    }

    public function actualizar_categorias_juego($id_juego)
    {
        $query = "CALL SP_ACTUALIZAR_CATEGORIA_JUEGO(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id_juego);
        $stmt->execute();
    }



    //-----------------------------------------

    public function listar_juegos()
    {
        $juegos = [];
        $query = "CALL SP_LISTAR_JUEGOS()";
        $stmt = $this->_db->prepare($query);
        $stmt->execute();
        $resp = $stmt->get_result();

        while ($jug = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($juegos, $jug);
        }

        return $juegos;
    }

    public function un_juego($id)
    {
        $query = "CALL SP_LISTAR_UN_JUEGO(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    }




    public function agregar_carrito($id_jug, $id_cli)
    {
        $query = "CALL SP_AGREGAR_AL_CARRITO(?, ?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('ii', $id_jug, $id_cli);
        $stmt->execute();
    }


    public function listar_carrito($id)
    {
        $juegos = [];
        $query = "CALL SP_LISTAR_CARRITO(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resp = $stmt->get_result();

        while ($jug = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($juegos, $jug);
        }

        return $juegos;
    }


    public function eliminar_carrito($id)
    {
        $query = "CALL SP_ELIMINAR_CARRITO(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function actualizar_carrito($id, $canje)
    {
        $query = "CALL SP_ACTUALIZAR_COMPRA(?, ?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('ii', $id, $canje);
        $stmt->execute();
    }

    public function actualizar_cantidad($id)
    {
        $query = "CALL SP_ACTUALIZAR_CANTIDAD_JUEGOS(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    public function listar_juegos_comprados($id)
    {
        $juegos = [];
        $query = "CALL SP_LISTAR_COMPRAS_USER(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resp = $stmt->get_result();

        while ($jug = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($juegos, $jug);
        }

        return $juegos;
    }

    public function buscar_juegos_nombre($param)
    {
        $juegos = [];
        $query = "CALL SP_FILTRAR_JUEGO_NOMBRE(?)";
        $stmt = $this->_db->prepare($query);
        $stmt->bind_param('s', $param);
        $stmt->execute();
        $resp = $stmt->get_result();

        while ($jug = $resp->fetch_array(MYSQLI_ASSOC)) {
            array_push($juegos, $jug);
        }

        return $juegos;
    }
}
