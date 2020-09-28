<?php

require_once '../data/Conexion.class.php';

class Envase extends Conexion
{

    private $idenvase;
    private $descripcionenvase;

    public function getIdenvase()
    {
        return $this->idenvase;
    }

    public function setIdenvase($idenvase)
    {
        $this->idenvase = $idenvase;
    }

    public function getDescripcionenvase()
    {
        return $this->descripcionenvase;
    }

    public function setDescripcionenvase($descripcionenvase)
    {
        $this->descripcionenvase = $descripcionenvase;
    }
    public function listar()
    {
        try {
            $sql = "
                    select
                        codigo_envase,
                        descripcion_envase
                    from
                        al_envase
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