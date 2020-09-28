<?php

require_once 'configuracion.php';
//require_once '../util/functions/Helper.class.php';

class Conexion{
    protected $dblink;
    
    public function __construct() {
        $this->abrirConexion();
        //echo "conexión abierta";
    }
    
    public function __destruct() {
        $this->dblink = NULL;
        //echo "Conexión cerrada";
    }
    
    protected function abrirConexion(){
        $servidor = "mysql:dbname=".BD_NOMBRE_BD.";host=".BD_SERVIDOR;
        $usuario = BD_USUARIO;
        $clave = BD_CLAVE;
        
        try {
            $this->dblink = new PDO($servidor, $usuario, $clave);
            $this->dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            Helper::mensaje($exc->getMessage(), "e");
            
        }
        
        return $this->dblink;
    }
}