<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Categoria.php';
require_once 'Usuario.php';

class Producto extends Modelo {
    private $_idProducto;
    private $_Nombre;
    private $_Descripcion;
    private $_Cantidad;
    private $_Costo;
    private $_Precio;
    private $_Estado;
    private $_categoria;
    private $_usuario;
    private $_tabla="producto";
    private $_vista="v_productos";
    private $_bd;

    public function __construct($idProducto=null, $Nombre=null,$Descripcion=null,$Cantidad=null,$Costo=null,$Precio=null,$Estado=null,$Categoria=null,$Usuario=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idProducto = $idProducto;
        $this->_Nombre= $Nombre;
        $this->_Descripcion= $Descripcion;
        $this->_Cantidad= $Cantidad;
        $this->_Costo= $Costo;
        $this->_Precio= $Precio;
        $this->_Estado= $Estado;
        $this->_categoria= new Categoria($Categoria);
        $this->_usuario= new Usuario($Usuario);
    }
    public function setCategoria (Categoria $ca){
        $this->_categoria= $ca;
    }
    public function getCategoria(){
        return $this->_categoria;
    
    }public function setUsuario (Usuario $u){
        $this->_usuario= $u;
    }
    public function getUsuario(){
        return $this->_usuario;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idProducto=".$this->_idProducto;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idProducto = $datos['data'][0]["idProducto"];
            $this->_Nombre = $datos['data'][0]["Nombre"];
            $this->_Descripcion = $datos['data'][0]["Descripcion"];
            $this->_Cantidad = $datos['data'][0]["Cantidad"];
            $this->_Costo = $datos['data'][0]["Costo"];
            $this->_Precio = $datos['data'][0]["Precio"];
            $this->_Estado = $datos['data'][0]["Estado"];
            $this->_categoria = new Categoria ($datos['data'][0]["idCategoria"]);
            $this->_usuario = new Usuario ($datos['data'][0]["idUsuario"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idProducto=".$this->_idProducto;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET Nombre='".$this->_Nombre."'"
            . ",Descripcion='". $this->_Descripcion."'"
            . ",Cantidad='". $this->_Cantidad."'"
            . ",Costo='". $this->_Costo."'"
            . ",Precio='". $this->_Precio."'"
            . ",Estado='". $this->_Estado."'"
            . ",idCategoria=".$this->_categoria->getidCategoria()
            . ",idUsuario=".$this->_usuario->getidUsuario()
            ." WHERE idProducto=".$this->_idProducto.";";
        //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idProducto, Nombre, Descripcion, Cantidad, Costo, Precio, Estado, idCategoria, idUsuario) VALUES (".
                $this->_idProducto .",'". $this->_Nombre ."','". $this->_Descripcion ."','". $this->_Cantidad ."','". $this->_Costo ."','". $this->_Precio ."','". $this->_Estado ."',"
                . $this->_categoria->getidCategoria().","
                . $this->_usuario->getidUsuario()
            .");";
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getidProducto(){
        return $this->_idProducto;
    }
    public function getNombre(){
        return $this->_Nombre;
    }
    public function getDescipcion(){
        return $this->_Descripcion;
    }
    public function getCantidad(){
        return $this->_Cantidad;
    }
    public function getCosto(){
        return $this->_Costo;
    }
    public function getPrecio(){
        return $this->_Precio;
    }
    public function getEstado(){
        return $this->_Estado;
    }
}
