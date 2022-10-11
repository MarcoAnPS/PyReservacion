<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Categoria extends Modelo {
    private $_idCategoria;
    private $_Nombre;
    private $_Descripcion;
    private $_tabla="categoria";
    private $_bd;

    public function __construct($idCategoria=null, $Nombre=null, $Descripcion=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idCategoria = $idCategoria;
        $this->_Nombre= $Nombre;
        $this->_Descripcion= $Descripcion;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_tabla .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_tabla 
            . " WHERE idCategoria=".$this->_idCategoria;
        
        $datos= $this->_bd->ejecutar($sql);  
        //var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idCategoria = $datos['data'][0]["idCategoria"];
            $this->_Nombre = $datos['data'][0]["Nombre"];
            $this->_Descripcion = $datos['data'][0]["Descripcion"];
        }
        
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idCategoria=".$this->_idCategoria;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET nombre='".$this->_Nombre."'"
            . ",Descripcion='".$this->_Descripcion."'"
            ." WHERE idCategoria=".$this->_idCategoria;
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idCategoria, Nombre, Descripcion) VALUES (".
                $this->_idCategoria .",'". $this->_Nombre ."'".",'". $this->_Descripcion ."'"
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function getidCategoria(){
        return $this->_idCategoria;
    }
    public function getNombre(){
        return $this->_Nombre;
    }
    public function getDescripcion(){
        return $this->_Descripcion;
    }
}
