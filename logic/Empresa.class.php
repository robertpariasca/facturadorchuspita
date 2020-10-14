<?php

require_once '../data/Conexion.class.php';

class Empresa extends Conexion
{

    private $ruc;
    private $razonsocial;
    private $direccion;

    public function getRuc()
    {
        return $this->ruc;
    }

    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
    }

    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

    }

    public function listar()
    {
        try {
            $sql = "
                    select
                        ruc,
                        nombre as razon_social,
                        direccion,
                        telefono
                    from
                        ficha_empresa
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
