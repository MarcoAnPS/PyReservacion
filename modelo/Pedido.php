<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Cliente.php';
require_once 'Mesa.php';
require_once 'Usuario.php';

class Pedido extends Modelo {
    private $_idPedido;
    private $_Numero;
    private $_Fecha;
    private $_Pago;
    private $_Estado;
    private $_cliente;
    private $_mesa;
    private $_usuario;
    private $_tabla="pedido";
    private $_vista="v_pedidos";
    private $_bd;

    public function __construct($idPedido=null, $Numero=null,$Fecha=null,$Pago=null,$Estado=null,$Cliente=null,$Mesa=null,$Usuario=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idPedido = $idPedido;
        $this->_Numero= $Numero;
        $this->_Fecha= $Fecha;
        $this->_Pago= $Pago;
        $this->_Estado= $Estado;
        $this->_cliente= new Cliente($Cliente);
        $this->_mesa= new Mesa($Mesa);
        $this->_usuario= new Usuario($Usuario);
    }
    public function setCliente (Cliente $cl){
        $this->_cliente= $cl;
    }
    public function getCliente(){
        return $this->_cliente;
    
    }
    public function setMesa (Mesa $m){
        $this->_mesa= $m;
    }
    public function getMesa(){
        return $this->_mesa;
    
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
            . " WHERE idPedido=".$this->_idPedido;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idPedido = $datos['data'][0]["idPedido"];
            $this->_Numero = $datos['data'][0]["Numero"];
            $this->_Fecha = $datos['data'][0]["Fecha"];
            $this->_Pago = $datos['data'][0]["Pago"];
            $this->_Estado = $datos['data'][0]["Estado"];
            $this->_cliente = new Cliente ($datos['data'][0]["idCliente"]);
            $this->_mesa = new Mesa ($datos['data'][0]["idMesa"]);
            $this->_usuario = new Usuario ($datos['data'][0]["idUsuario"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idPedido=".$this->_idPedido;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET Numero='".$this->_Numero."'"
            . ",Fecha='". $this->_Fecha."'"
            . ",Pago='". $this->_Pago."'"
            . ",Estado='". $this->_Estado."'"
            . ",idCliente=".$this->_cliente->getidCliente()
            . ",idMesa=".$this->_mesa->getidMesa()
            . ",idUsuario=".$this->_usuario->getidUsuario()
            ." WHERE idPedido=".$this->_idPedido.";";
        //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idPedido, Numero, Fecha, Pago, Estado, idCliente, idMesa, idUsuario) VALUES (".
                $this->_idPedido .",'". $this->_Numero ."','". $this->_Fecha ."','". $this->_Pago ."','". $this->_Estado ."',"
                . $this->_cliente->getidCliente().","
                . $this->_mesa->getidMesa().","
                . $this->_usuario->getidUsuario()
            .");";
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getidPedido(){
        return $this->_idPedido;
    }
    public function getNumero(){
        return $this->_Numero;
    }
    public function getFecha(){
        return $this->_Fecha;
    }
    public function getPago(){
        return $this->_Pago;
    }
    public function getEstado(){
        return $this->_Estado;
    }
}
