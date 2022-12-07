<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Mesa extends Modelo {
    private $_idMesa;
    private $_Numero;
    private $_Estado;
    private $_Capacidad;
    private $_NroPersonas;
    private $_tabla="mesa";
    private $_vista="v_mesas";
    private $_bd;

    public function __construct($idMesa=null, $Numero=null, $Estado=null, $Capacidad=null, $NroPersonas=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idMesa = $idMesa;
        $this->_Numero= $Numero;
        $this->_Estado= $Estado;
        $this->_Capacidad= $Capacidad;
        $this->_NroPesonas= $NroPersonas;
    }
    public function getDetalles(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idMesa=".$this->_idMesa;
        
        $datos= $this->_bd->ejecutar($sql);  

        $sql= "SELECT * FROM imagenes_mesa" 
           . " WHERE idMesa=".$this->_idProducto;
        $datos['imagenes']= $this->_bd->ejecutar($sql);
    
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_tabla .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista 
            . " WHERE idMesa=".$this->_idMesa;
        
        $datos= $this->_bd->ejecutar($sql);
        //var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idMesa = $datos['data'][0]["idMesa"];
            $this->_Numero = $datos['data'][0]["Numero"];
            $this->_Estado = $datos['data'][0]["Estado"];
            $this->_Capacidad = $datos['data'][0]["Capacidad"];
            $this->_NroPersonas = $datos['data'][0]["NroPersonas"];
        }
        
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idMesa=".$this->_idMesa;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET Numero='".$this->_Numero."'"
            . ",Estado='".$this->_Estado."'"
            . ",Capacidad='".$this->_Capacidad."'"
            . ",NroPersonas='".$this->_NroPesonas."'"
            ." WHERE idMesa=".$this->_idMesa;
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idMesa, Numero, Estado, Capacidad, NroPersonas) VALUES (".
                $this->_idMesa .",'". $this->_Numero ."'".",'". $this->_Estado ."'".",'". $this->_Capacidad ."'".",'". $this->_NroPersonas ."'"
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function getidMesa(){
        return $this->_idMesa;
    }
    public function getNumero(){
        return $this->_Numero;
    }
    public function getEstado(){
        return $this->_Estado;
    } 
    public function getCapacidad(){
        return $this->_Capacidad;
    } 
    public function getNroPersonas(){
        return $this->_NroPesonas;
    }
    public function getMesasCarrito()    {
        $mes = null;
        $mesas = $_SESSION['carrito']->getMesas();
        // var_dump($mesas);exit();
        if (!empty($mesas)){
            foreach ($mesas as $key => $value) 
            $mes[] =$key;
         
            $misMesas=implode(",", $mes);

            $sql= "SELECT * FROM ". $this->_vista 
                . " WHERE idMesa in(".$misMesas.")";
            // var_dump($sql); exit();
            return $this->_bd->ejecutar($sql); 
        }else{
            return null;
        }
    }
}

