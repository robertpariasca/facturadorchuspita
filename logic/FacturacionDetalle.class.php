<?php

require_once '../data/Conexion.class.php';

class FacturacionDetalle extends Conexion
{

    private $seriedoc;
    private $nrodoc;
    private $codprod;
    private $nomprod;
    private $preciosinigv;
    private $igvproducto;
    private $precioventa;
    private $cantidadproducto;

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

    public function getCodprod()
    {
        return $this->codprod;
    }

    public function setCodprod($codprod)
    {
        $this->codprod = $codprod;
    }

    public function getNomprod()
    {
        return $this->nomprod;
    }

    public function setNomprod($nomprod)
    {
        $this->nomprod = $nomprod;
    }

    public function getPreciosinigv()
    {
        return $this->preciosinigv;
    }

    public function setPreciosinigv($preciosinigv)
    {
        $this->preciosinigv = $preciosinigv;
    }

    public function getIgvproducto()
    {
        return $this->igvproducto;
    }

    public function setIgvproducto($igvproducto)
    {
        $this->igvproducto = $igvproducto;
    }

    public function getPrecioventa()
    {
        return $this->precioventa;
    }

    public function setPrecioventa($precioventa)
    {
        $this->precioventa = $precioventa;
    }

    public function getCantidadproducto()
    {
        return $this->cantidadproducto;
    }

    public function setCantidadproducto($cantidadproducto)
    {
        $this->cantidadproducto = $cantidadproducto;
    }


    public function grabar()
    {
        $this->dblink->beginTransaction();

        try {

                    $sql = "select fn_generarDetalleDocumento(                    
                                    :p_seriedoc,
                                    :p_nrodoc, 
                                    :p_codproducto,
                                    :p_nomproducto,
                                    :p_preciosinigv,
                                    :p_productoigv,
                                    :p_precioventa,
                                    :p_cantidad
                                 );";
                    $sentencia = $this->dblink->prepare($sql);
                    // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                    $sentencia->bindParam(":p_seriedoc", $this->getSeriedoc());
                    $sentencia->bindParam(":p_nrodoc", $this->getNrodoc());
                    $sentencia->bindParam(":p_codproducto", $this->getCodprod());
                    $sentencia->bindParam(":p_nomproducto", $this->getNomprod());
                    $sentencia->bindParam(":p_preciosinigv", $this->getPreciosinigv());
                    $sentencia->bindParam(":p_productoigv", $this->getIgvproducto());
                    $sentencia->bindParam(":p_precioventa", $this->getPrecioventa());
                    $sentencia->bindParam(":p_cantidad", $this->getCantidadproducto());
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
