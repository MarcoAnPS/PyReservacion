<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Usuario extends Modelo {
    private $_idUsuario;
    private $_Nickname;
    private $_Contraseña;
    private $_tabla="usuario";
    private $_bd;

    public function __construct($idUsuario=null, $Nickname=null, $Contraseña=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idUsuario = $idUsuario;
        $this->_Nickname= $Nickname;
        $this->_Contraseña= $Contraseña;
    }
    public function leer(){
        $sql ="SELECT * FROM ". $this->_tabla .";";
        return $this->_bd->ejecutar($sql);
    }
     public function leerUno(){
        $sql= "SELECT * FROM ". $this->_tabla 
            . " WHERE idUsuario=".$this->_idUsuario;
        
        $datos= $this->_bd->ejecutar($sql);  
        //var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idUsuario = $datos['data'][0]["idUsuario"];
            $this->_Nickname = $datos['data'][0]["Nickname"];
            $this->_Contraseña = $datos['data'][0]["Contraseña"];
        }
        
        return $datos; 
    }
    public function eliminar(){
        $sql= "Delete FROM ". $this->_tabla 
            . " WHERE idUsuario=".$this->_idUsuario;
        return $this->_bd->ejecutar($sql);    
    }
    public function editar(){
        $sql ="UPDATE ". $this->_tabla 
            . " SET Nickname='".$this->_Nickname."'"
            . ",Contraseña='".$this->_Contraseña."'"
            ." WHERE idUsuario=".$this->_idUsuario;
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idUsuario, Nickname, Contraseña) VALUES (".
                $this->_idUsuario .",'". $this->_Nickname ."'".",'". $this->_Contraseña ."'"
            .");";
        return $this->_bd->ejecutar($sql);
    }
    public function getidUsuario(){
        return $this->_idUsuario;
    }
    public function getNickname(){
        return $this->_Nickname;
    }
    public function getContraseña(){
        return $this->_Contraseña;
    }
}
