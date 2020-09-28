<?php

require_once '../data/Conexion.class.php';

class Usuario extends Conexion
{

    private $codcliente;
    private $tipodoccliente;
    private $doccliente;
    private $nomcliente;
    private $fechainscripcion;
    private $rol;
    private $estado;
    private $alias;
    private $clave;

    public function getCodcliente()
    {
        return $this->codcliente;
    }

    public function getTipodoccliente()
    {
        return $this->tipodoccliente;
    }

    public function getDoccliente()
    {
        return $this->doccliente;
    }

    public function getNomcliente()
    {
        return $this->nomcliente;
    }

    public function getFechainscripcion()
    {
        return $this->fechainscripcion;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getClave()
    {
        return $this->clave;
    }



    public function setCodcliente($codcliente)
    {
        $this->codcliente = $codcliente;
    }

    public function setTipodoccliente($tipodoccliente)
    {
        $this->tipodoccliente = $tipodoccliente;
    }

    public function setDoccliente($doccliente)
    {
        $this->doccliente = $doccliente;
    }

    public function setNomcliente($nomcliente)
    {
        $this->nomcliente = $nomcliente;
    }

    public function setFechainscripcion($fechainscripcion)
    {
        $this->fechainscripcion = $fechainscripcion;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    public function setClave($clave)
    {
        $this->clave = $clave;
    }

    public function agregar()
    {
        $this->dblink->beginTransaction();

        try {


            $sqlcon = "
            select 
                    cod_cliente
            from
                    usuario c
            inner join
                    acceso a
            on
                    c.cod_cliente=a.cod_acceso
            where
                    doc_cliente=:p_doccliente            
        ";
            //fin dondiciones
            $sentenciacon = $this->dblink->prepare($sqlcon);
            $sentenciacon->bindParam(":p_doccliente", $this->getDoccliente());
            //            $sentencia->bindParam(":p_tipo", $this->getTipo());
            $sentenciacon->execute();


            $sqlcon2 = "
    select 
            cod_cliente
    from
            usuario c
    inner join
            acceso a
    on
            c.cod_cliente=a.cod_acceso
    where
            alias=:p_alias;
    
";
            //fin dondiciones
            $sentenciacon2 = $this->dblink->prepare($sqlcon2);
            $sentenciacon2->bindParam(":p_alias", $this->getAlias());
            //            $sentencia->bindParam(":p_tipo", $this->getTipo());
            $sentenciacon2->execute();

            if ($sentenciacon->rowCount()) {

                $this->dblink->commit();
                return "DUDoc";
            } else if ($sentenciacon2->rowCount()) {
                return "DUAli";
            } else {

                if ($this->getRol() == "1") {
                    $sql = "select f_generar_correlativo('cliente') as nc";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->execute();
                } else if ($this->getRol() == "2") {
                    $sql = "select f_generar_correlativo('proveedor') as nc";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->execute();
                }

                if ($sentencia->rowCount()) {
                    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                    $nuevoCodigo = $resultado["nc"];
                    $this->setCodcliente($nuevoCodigo);

                    $sql = "select fn_registrarCliente(                    
                                    :p_tipodoc,
                                    :p_dni, 
                                    :p_nombreCompleto,
                                    :p_rol,
                                    :p_usuario,
                                    :p_password,
                                    :p_codcliente
                                 );";
                    $sentencia = $this->dblink->prepare($sql);
                    // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                    $sentencia->bindParam(":p_codcliente", $this->getCodcliente());
                    $sentencia->bindParam(":p_tipodoc", $this->getTipodoccliente());
                    $sentencia->bindParam(":p_dni", $this->getDoccliente());
                    $sentencia->bindParam(":p_nombreCompleto", $this->getNomcliente());
                    $sentencia->bindParam(":p_rol", $this->getRol());
                    $sentencia->bindParam(":p_usuario", $this->getAlias());
                    $sentencia->bindParam(":p_password", $this->getClave());
                    //$sentencia->bindParam(":p_tipo", $this->getTipo());
                    //$sentencia->bindParam(":p_estado", $this->getEstado());
                    $sentencia->execute();

                    if ($this->getRol() == "1") {
                        $sql = "update correlativo set numero = numero + 1 
                    where tabla='cliente'";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->execute();
                    } else if ($this->getRol() == "2") {
                        $sql = "update correlativo set numero = numero + 1 
                    where tabla='proveedor'";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->execute();
                    }

                    $this->dblink->commit();
                    return "EXITO";
                } else {
                    throw new Exception("No se ha configurado el correlativo para la tabla Cliente");
                }
            }
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
                        tipo_doc_cliente,
                        doc_cliente,
                        nom_cliente
                    from
                        usuario
                    where
                        cod_cliente=:p_codcliente;
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codcliente", $this->getCodcliente());
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

        try {


            $sqlcon = "
            select 
                    cod_cliente
            from
                    usuario c
            inner join
                    acceso a
            on
                    c.cod_cliente=a.cod_acceso
            where
                    doc_cliente=:p_doccliente           
            and 
                    cod_acceso <> :p_codacceso
        ";
            //fin dondiciones
            $sentenciacon = $this->dblink->prepare($sqlcon);
            $sentenciacon->bindParam(":p_doccliente", $this->getDoccliente());
            $sentenciacon->bindParam(":p_codacceso", $this->getCodcliente());
            //            $sentencia->bindParam(":p_tipo", $this->getTipo());
            $sentenciacon->execute();


            if ($sentenciacon->rowCount()) {

                $this->dblink->commit();
                return "DUDoc";
            } else {

                $sql = "select fn_actualizarCliente(                    
                                    :p_tipodoc,
                                    :p_dni, 
                                    :p_nombreCompleto,
                                    :p_codcliente
                                 );";
                $sentencia = $this->dblink->prepare($sql);
                // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                $sentencia->bindParam(":p_codcliente", $this->getCodcliente());
                $sentencia->bindParam(":p_tipodoc", $this->getTipodoccliente());
                $sentencia->bindParam(":p_dni", $this->getDoccliente());
                $sentencia->bindParam(":p_nombreCompleto", $this->getNomcliente());
                //$sentencia->bindParam(":p_tipo", $this->getTipo());
                //$sentencia->bindParam(":p_estado", $this->getEstado());
                $sentencia->execute();

                $this->dblink->commit();
                return "EXITO";
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }
}
