<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Usuario.php';

class Cliente extends Modelo {
    private $_idCliente;
    private $_Nombre;
    private $_Apellido;
    private $_DNI;
    private $_Telefono;
    private $_Direccion;
    private $_Email;
    private $_usuario;
    private $_tabla="cliente";
    private $_vista="v_clientes";
    private $_bd;

    public function __construct($idCliente=null, $Nombre=null,$Apellido=null,$DNI=null,$Telefono=null,$Direccion=null,$Email=null,$Usuario=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idCliente = $idCliente;
        $this->_Nombre= $Nombre;
        $this->_Apellido= $Apellido;
        $this->_DNI= $DNI;
        $this->_Telefono= $Telefono;
        $this->_Direccion= $Direccion;
        $this->_Email= $Email;
        $this->_usuario= new Usuario($Usuario);
    }
    public function setUsuario (Usuario $u){
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
            . " WHERE idCliente=".$this->_idCliente;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idCliente = $datos['data'][0]["idCliente"];
            $this->_Nombre = $datos['data'][0]["Nombre"];
            $this->_Apellido = $datos['data'][0]["Apellido"];
            $this->_DNI = $datos['data'][0]["DNI"];
            $this->_Telefono = $datos['data'][0]["Telefono"];
            $this->_Direccion = $datos['data'][0]["Direccion"];
            $this->_Email = $datos['data'][0]["Email"];
            $this->_usuario = new Usuario ($datos['data'][0]["idUsuario"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idCliente=".$this->_idCliente;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET Nombre='".$this->_Nombre."'"
            . ",Apellido='". $this->_Apellido."'"
            . ",DNI='". $this->_DNI."'"
            . ",Telefono='". $this->_Telefono."'"
            . ",Direccion='". $this->_Direccion."'"
            . ",Email='". $this->_Email."'"
            . ",idUsuario=".$this->_usuario->getidUsuario()
            ." WHERE idCliente=".$this->_idCliente.";";
        //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idCliente, Nombre, Apellido, DNI, Telefono, Direccion, Email, idUsuario) VALUES (".
                $this->_idCliente .",'". $this->_Nombre ."','". $this->_Apellido ."','". $this->_DNI ."','". $this->_Telefono ."','". $this->_Direccion ."','". $this->_Email ."',"
                . $this->_usuario->getidUsuario()
            .");";
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getidCliente(){
        return $this->_idCliente;
    }
    public function getNombre(){
        return $this->_Nombre;
    }
    public function getApellido(){
        return $this->_Apellido;
    }
    public function getDNI(){
        return $this->_DNI;
    }
    public function getTelefono(){
        return $this->_Telefono;
    }
    public function getDireccion(){
        return $this->_Direccion;
    }
    public function getEmail(){
        return $this->_Email;
    }
}
