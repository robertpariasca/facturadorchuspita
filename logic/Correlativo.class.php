<?php

require_once '../data/Conexion.class.php';

class Correlativo extends Conexion
{

    private $coddoc;
    private $nombredoc;
    private $seriedoc;
    private $corredoc;

    public function getCoddoc()
    {
        return $this->coddoc;
    }

    public function setCoddoc($coddoc)
    {
        $this->coddoc = $coddoc;
    }

    public function getNombredoc()
    {
        return $this->nombredoc;
    }

    public function setNombredoc($nombredoc)
    {
        $this->nombredoc = $nombredoc;
    }

    public function getSeriedoc()
    {
        return $this->seriedoc;
    }

    public function setSeriedoc($seriedoc)
    {
        $this->seriedoc = $seriedoc;
    }

    public function getCorredoc()
    {
        return $this->corredoc;
    }

    public function setCorredoc($corredoc)
    {
        $this->corredoc = $corredoc;
    }

    public function listar()
    {
        try {
            $sql = "
                    select
                        serie_doc,
                        LPAD(corre_doc+1,8,'0') as corre_doc
                    from
                        correlativos_documentos
                    where
                        coddoc=:p_coddoc;
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_coddoc", $this->getCoddoc());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function actualizar()
    {
        $this->dblink->beginTransaction();

        try{
            $sql = "update correlativos_documentos set corre_doc=:p_corredoc where coddoc=:p_coddoc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam("p_corredoc", $this->getCorredoc());
            $sentencia->bindParam("p_coddoc", $this->getCoddoc());
            $sentencia->execute();

            $this->dblink->commit();
            return "EXITO";
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
