<?php

require_once '../data/Conexion.class.php';

class Tipo extends Conexion
{

    private $idtipo;
    private $descripciontipo;

    public function getIdtipo()
    {
        return $this->idtipo;
    }

    public function setIdtipo($idtipo)
    {
        $this->idtipo = $idtipo;
    }

    public function getDescripciontipo()
    {
        return $this->descripciontipo;
    }

    public function setDescripciontipo($descripciontipo)
    {
        $this->descripciontipo = $descripciontipo;
    }
    public function listar()
    {
        try {
            $sql = "
                    select
                        codigo_tipo,
                        descripcion_tipo
                    from
                        al_tipo
                    order by
                        descripcion_tipo
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
