<?php

require_once '../data/Conexion.class.php';

class Marca extends Conexion
{

    private $idmarca;
    private $descripcionmarca;

    public function getIdmarca()
    {
        return $this->idmarca;
    }

    public function setIdmarca($idmarca)
    {
        $this->idmarca = $idmarca;
    }

    public function getDescripcionmarca()
    {
        return $this->descripcionmarca;
    }

    public function setDescripcionmarca($descripcionmarca)
    {
        $this->descripcionmarca = $descripcionmarca;
    }
    public function listar()
    {
        try {
            $sql = "
                    select
                        codigo_marca,
                        descripcion_marca
                    from
                        al_marca
                    order by
                        descripcion_marca
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}