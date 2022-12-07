<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class TipoUsuario extends Modelo {
    private $_idtipoUsuario;
    private $_Nombre;
    private $_tabla="tipousuario";
    private $_bd;

    public function __construct($idtipoUsuario=null, $Nombre=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idtipoUsuario = $idtipoUsuario;
        $this->_Nombre= $Nombre;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_tabla .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_tabla 
            . " WHERE idtipoUsuario=".$this->_idtipoUsuario;
        
        $datos= $this->_bd->ejecutar($sql);  
        //var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idtipoUsuario = $datos['data'][0]["idtipoUsuario"];
            $this->_Nombre = $datos['data'][0]["Nombre"];
        }
        
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idtipoUsuario=".$this->_idtipoUsuario;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET Nombre='".$this->_Nombre."'"
            ." WHERE idtipoUsuario=".$this->_idtipoUsuario;
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idtipoUsuario, Nombre) VALUES (".
                $this->_idtipoUsuario .",'". $this->_Nombre ."'"
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function getidtipousuario(){
        return $this->_idtipoUsuario;
    }
    public function getNombre(){
        return $this->_Nombre;
    }
}
