<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'Cliente.php';
require_once 'Mesa.php';
class Reserva extends Modelo {
    private $_idReserva;
    private $_Fecha;
    private $_Estado;
    private $_cliente;
    private $_mesa;
    private $_tabla="reserva";
    private $_vista="v_reservas";
    private $_bd;

    public function __construct($idReserva=null, $Fecha=null, $Estado=null, $cliente=null, $mesa=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idReserva = $idReserva;
        $this->_Fecha= $Fecha;
        $this->_Estado= $Estado;
        $this->_cliente= new Cliente($cliente);
        $this->_mesa= new Mesa($mesa);
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
    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idReserva=".$this->_idReserva;
        
        $datos= $this->_bd->ejecutar($sql);  
        // var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idReserva = $datos['data'][0]["idReserva"];
            $this->_Fecha = $datos['data'][0]["Fecha"];
            $this->_Estado = $datos['data'][0]["Estado"];
            $this->_cliente = new Cliente ($datos['data'][0]["idCliente"]);
            $this->_mesa = new Mesa ($datos['data'][0]["idMesa"]);
        }
    
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idReserva=".$this->_idReserva;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET Fecha='".$this->_Fecha."'"
            . ",Estado='".$this->_Estado."'"   
            . ",idCliente=".$this->_cliente->getidCliente()
            . ",idMesa=".$this->_mesa->getidMesa()
            ." WHERE idReserva=".$this->_idReserva.";";
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idReserva, Fecha, Estado, idCliente, idMesa) VALUES (".
                $this->_idReserva .",'". $this->_Fecha."','". $this->_Estado ."',". $this->_cliente->getidCliente().",". $this->_mesa->getidMesa().");";
        // var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getidReserva(){
        return $this->_idReserva;
    }
    public function getFecha(){
        return $this->_Fecha;
    }
    public function getEstado(){
        return $this->_Estado;
    }
}
