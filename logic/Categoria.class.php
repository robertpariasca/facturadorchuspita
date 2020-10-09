<?php

require_once '../data/Conexion.class.php';

class Categoria extends Conexion
{

    private $idcategoria;
    private $descripcioncategoria;

    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }

    public function getDescripcioncategoria()
    {
        return $this->descripcioncategoria;
    }

    public function setDescripcioncategoria($descripcioncategoria)
    {
        $this->descripcioncategoria = $descripcioncategoria;
    }

    public function listar()
    {
        try {
            $sql = "
                    select
                        codigo_categoria,
                        descripcion_categoria
                    from
                        al_categoria
                    order by
                        descripcion_categoria
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
