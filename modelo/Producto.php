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
    private $_Pu;
    private $_Estado;
    private $_categoria;
    private $_tabla="producto";
    private $_vista="v_productos";
    private $_vista1="v_categorias01";
    private $_bd;

    public function __construct($idProducto=null, $Nombre=null,$Descripcion=null,$Cantidad=null,$Costo=null,$Pu=null,$Estado=null,$Categoria=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idProducto = $idProducto;
        $this->_Nombre= $Nombre;
        $this->_Descripcion= $Descripcion;
        $this->_Cantidad= $Cantidad;
        $this->_Costo= $Costo;
        $this->_Pu= $Pu;
        $this->_Estado= $Estado;
        $this->_categoria= new Categoria($Categoria);
    }
    public function getDetalles(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idProducto=".$this->_idProducto;
        
        $datos= $this->_bd->ejecutar($sql);  

        $sql= "SELECT * FROM imagenes_producto" 
           . " WHERE idProducto=".$this->_idProducto;
        $datos['imagenes']= $this->_bd->ejecutar($sql);
    
        return $datos; 
    }
    public function setCategoria (Categoria $ca){
        $this->_categoria= $ca;
    }
    public function getCategoria(){
        return $this->_categoria;
    
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
            $this->_Pu = $datos['data'][0]["Pu"];
            $this->_Estado = $datos['data'][0]["Estado"];
            $this->_categoria = new Categoria ($datos['data'][0]["idCategoria"]);
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
            . ",Pu='". $this->_Pu."'"
            . ",Estado='". $this->_Estado."'"
            . ",idCategoria=".$this->_categoria->getidCategoria()
            ." WHERE idProducto=".$this->_idProducto.";";
        //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idProducto, Nombre, Descripcion, Cantidad, Costo, Pu, Estado, idCategoria) VALUES (".
                $this->_idProducto .",'". $this->_Nombre ."','". $this->_Descripcion ."','". $this->_Cantidad ."','". $this->_Costo ."','". $this->_Pu ."','". $this->_Estado ."',"
                . $this->_categoria->getidCategoria()
            .");";
        //var_dump($sql); exit();
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
    public function getPu(){
        return $this->_Pu;
    }
    public function getEstado(){
        return $this->_Estado;
    }
    public function getProductosCarrito()    {
        $prod = null;
        $productos = $_SESSION['carrito']->getProductos();  
        // var_dump($productos);exit();
        if (!empty($productos)){
            foreach ($productos as $key => $value) 
            $prod[] =$key;
         
            $misProductos=implode(",", $prod);

            $sql= "SELECT * FROM ". $this->_vista 
                . " WHERE idProducto in(".$misProductos.")";
            // var_dump($sql); exit();
            return $this->_bd->ejecutar($sql); 
        }else{
            return null;
        }
        
    }
}
