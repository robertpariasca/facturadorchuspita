<?php

require_once '../data/Conexion.class.php';

class Ubigeo extends Conexion{

    private $coddepartamento;
    private $departamento;
    private $codprovincia;
    private $provincia;
    private $coddistrito;
    private $distrito;

    public function getCoddepartamento()
    {
        return $this->coddepartamento;
    }

    public function setCoddepartamento($coddepartamento)
    {
        $this->coddepartamento = $coddepartamento;
    }

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    public function getCodprovincia()
    {
        return $this->codprovincia;
    }

    public function setCodprovincia($codprovincia)
    {
        $this->codprovincia = $codprovincia;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    public function getCoddistrito()
    {
        return $this->coddistrito;
    }

    public function setCoddistrito($coddistrito)
    {
        $this->coddistrito = $coddistrito;
    }

    public function getDistrito()
    {
        return $this->distrito;
    }

    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
    }

    public function listarDepartamentos()
    {
        try {
            $sql = "
                    select
                       departamento,
                       coddepartamento
                    from
                        ubigeo
                    group by 
                        departamento, coddepartamento
                   ;
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function listarProvincias()
    {
        try {
            $sql = "
                    select
                       provincia,
                       codprovincia
                    from
                        ubigeo
                    where
                        coddepartamento = :p_coddepartamento
                    group by 
                        provincia, codprovincia
                    order by
                        codprovincia
                   ;
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_coddepartamento", $this->getCoddepartamento());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function listarDistritos()
    {
        try {
            $sql = "
                    select
                       distrito,
                       coddistrito
                    from
                        ubigeo
                    where
                        coddepartamento = :p_coddepartamento
                    and
                        codprovincia = :p_codprovincia
                    group by 
                        distrito, coddistrito
                    order by
                        coddistrito
                   ;
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_coddepartamento", $this->getCoddepartamento());
            $sentencia->bindParam(":p_codprovincia", $this->getCodprovincia());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}