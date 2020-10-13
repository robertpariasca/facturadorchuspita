<?php

require_once '../data/Conexion.class.php';

class Producto extends Conexion
{

    private $idproducto;
    private $idcategoria;
    private $idtipo;
    private $idmarca;
    private $idenvase;
    private $idunidadmedida;
    private $codproducto;
    private $codproductosunat;
    private $codbarraproducto;
    private $descripcion;
    private $precio;
    private $inafecto;

    public function getIdproducto()
    {
        return $this->idproducto;
    }

    public function setIdproducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }

    public function getIdtipo()
    {
        return $this->idtipo;
    }

    public function setIdtipo($idtipo)
    {
        $this->idtipo = $idtipo;
    }

    public function getIdmarca()
    {
        return $this->idmarca;
    }

    public function setIdmarca($idmarca)
    {
        $this->idmarca = $idmarca;
    }

    public function getIdenvase()
    {
        return $this->idenvase;
    }

    public function setIdenvase($idenvase)
    {
        $this->idenvase = $idenvase;
    }

    public function getIdunidadmedida()
    {
        return $this->idunidadmedida;
    }

    public function setIdunidadmedida($idunidadmedida)
    {
        $this->idunidadmedida = $idunidadmedida;
    }

    public function getCodproducto()
    {
        return $this->codproducto;
    }

    public function setCodproducto($codproducto)
    {
        $this->codproducto = $codproducto;
    }

    public function getCodproductosunat()
    {
        return $this->codproductosunat;
    }

    public function setCodproductosunat($codproductosunat)
    {
        $this->codproductosunat = $codproductosunat;
    }

    public function getCodbarraproducto()
    {
        return $this->codbarraproducto;
    }

    public function setCodbarraproducto($codbarraproducto)
    {
        $this->codbarraproducto = $codbarraproducto;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getInafecto()
    {
        return $this->inafecto;
    }

    public function setInafecto($inafecto)
    {
        $this->inafecto = $inafecto;
    }


    public function grabar()
    {
        $this->dblink->beginTransaction();

        try {

                    $sql = "select fn_registrarProducto(                    
                                    :p_codbarra,
                                    :p_descripcion,
                                    :p_categoria, 
                                    :p_tipo,
                                    :p_marca,
                                    :p_envase,
                                    :p_medida,
                                    :p_precio,
                                    :p_inafecto
                                 );";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_codbarra", $this->getCodbarraproducto());
                    $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
                    $sentencia->bindParam(":p_categoria", $this->getIdcategoria());
                    $sentencia->bindParam(":p_tipo", $this->getIdtipo());
                    $sentencia->bindParam(":p_marca", $this->getIdmarca());
                    $sentencia->bindParam(":p_envase", $this->getIdenvase());
                    $sentencia->bindParam(":p_medida", $this->getIdunidadmedida());
                    $sentencia->bindParam(":p_precio", $this->getPrecio());
                    $sentencia->bindParam(":p_inafecto", $this->getInafecto());
                    $sentencia->execute();

                    $this->dblink->commit();
                    return "EXITO";
  
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function listar()
    {
        try {
            $sql = "
                    select
                        descripcion,
                        cod_producto,
                        precio,
                        tipo_impuesto as inafecto,
                        (if(cod_producto='000000000001',(SELECT icbper FROM `ficha_empresa`),'0')) as ICBPER
                    from
                        al_producto
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function listarBarcode()
    {
        try {
            $sql = "
                    select
                        descripcion,
                        cod_producto,
                        precio,
                        tipo_impuesto as inafecto,
                        (if(cod_producto='000000000001',(SELECT icbper FROM `ficha_empresa`),'0')) as ICBPER
                    from
                        al_producto
                    where
                        cod_barra_producto = :p_barcode
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_barcode", $this->getCodbarraproducto());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function listarEdicion()
    {
        try {
            $sql = "
                    select
                        cod_producto,
                        cod_barra_producto,
                        id_categoria,
                        id_tipo,
                        id_marca,
                        id_envase,
                        id_unidad_medida,
                        descripcion,
                        precio
                    from
                        al_producto
                    where
                        cod_producto=:p_codproducto
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codproducto", $this->getCodproducto());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function eliminar()
    {
        $this->dblink->beginTransaction();

        try {

                $sql = "delete from al_producto where cod_producto=:p_codproducto;";
                    $sentencia = $this->dblink->prepare($sql);
                    // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                    $sentencia->bindParam(":p_codproducto", $this->getCodproducto());
                    $sentencia->execute();

                    $this->dblink->commit();
                    return "EXITO";
  
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }
    public function actualizar()
    {
        $this->dblink->beginTransaction();

        try {

                $sql = "update al_producto set descripcion=:p_descripcion, precio=:p_precio, cod_barra_producto=:p_codbarra where cod_producto=:p_codproducto;";
                $sentencia = $this->dblink->prepare($sql);
                
                $sentencia->bindParam(":p_codbarra", $this->getCodbarraproducto());
                $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
                $sentencia->bindParam(":p_precio", $this->getPrecio());
                $sentencia->bindParam(":p_codproducto", $this->getCodproducto());
                
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
