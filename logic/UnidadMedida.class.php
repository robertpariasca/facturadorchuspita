<?php

require_once '../data/Conexion.class.php';

class UnidadMedida extends Conexion
{

    private $idunidadmedida;
    private $descripcionunimedida;

    public function getIdunidadmedida()
    {
        return $this->idunidadmedida;
    }

    public function setIdunidadmedida($idunidadmedida)
    {
        $this->idunidadmedida = $idunidadmedida;
    }

    public function getDescripcionunimedida()
    {
        return $this->descripcionunimedida;
    }

    public function setDescripcionunimedida($descripcionunimedida)
    {
        $this->descripcionunimedida = $descripcionunimedida;
    }
    public function listar()
    {
        try {
            $sql = "
                    select
                        codigo,
                        descripcion
                    from
                        unidad_medida
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