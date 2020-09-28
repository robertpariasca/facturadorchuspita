<?php

require_once '../data/Conexion.class.php';

class Facturacion extends Conexion
{

    private $seriedoc;
    private $nrodoc;
    private $nroruc;
    private $razonsocial;
    private $direccion;
    private $subtotal;
    private $igv;
    private $total;
    private $fechaemision;
    private $horaemision;


    public function getSeriedoc()
    {
        return $this->seriedoc;
    }

    public function setSeriedoc($seriedoc)
    {
        $this->seriedoc = $seriedoc;
    }

    public function getNrodoc()
    {
        return $this->nrodoc;
    }

    public function setNrodoc($nrodoc)
    {
        $this->nrodoc = $nrodoc;
    }

    public function getNroruc()
    {
        return $this->nroruc;
    }

    public function setNroruc($nroruc)
    {
        $this->nroruc = $nroruc;
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

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    public function getIgv()
    {
        return $this->igv;
    }

    public function setIgv($igv)
    {
        $this->igv = $igv;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getFechaemision()
    {
        return $this->fechaemision;
    }

    public function setFechaemision($fechaemision)
    {
        $this->fechaemision = $fechaemision;
    }

    public function getHoraemision()
    {
        return $this->horaemision;
    }

    public function setHoraemision($horaemision)
    {
        $this->horaemision = $horaemision;
    }


    public function grabar()
    {
        $this->dblink->beginTransaction();

        try {

                    $sql = "select fn_generarDocumento(                    
                                    :p_seriedoc,
                                    :p_nrodoc, 
                                    :p_nroruc,
                                    :p_razonsocial,
                                    :p_direccion,
                                    :p_subtotal,
                                    :p_igv,
                                    :p_total,
                                    :p_fechaemision,
                                    :p_horaemision
                                 );";
                    $sentencia = $this->dblink->prepare($sql);
                    // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                    $sentencia->bindParam(":p_seriedoc", $this->getSeriedoc());
                    $sentencia->bindParam(":p_nrodoc", $this->getNrodoc());
                    $sentencia->bindParam(":p_nroruc", $this->getNroruc());
                    $sentencia->bindParam(":p_razonsocial", $this->getRazonsocial());
                    $sentencia->bindParam(":p_direccion", $this->getDireccion());
                    $sentencia->bindParam(":p_subtotal", $this->getSubtotal());
                    $sentencia->bindParam(":p_igv", $this->getIgv());
                    $sentencia->bindParam(":p_total", $this->getTotal());
                    $sentencia->bindParam(":p_fechaemision", $this->getFechaemision());
                    $sentencia->bindParam(":p_horaemision", $this->getHoraemision());
                    $sentencia->execute();

                    $this->dblink->commit();
                    return "EXITO";
  
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }
    
}
