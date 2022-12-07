<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";
require_once 'TipoUsuario.php';

class Usuario extends Modelo {
    private $_idUsuario;
    private $_Nickname;
    private $_Contraseña;
    private $_nombre;
    private $_email;
    private $_Estado;
    private $_tipoUsuario;
    private $_tabla="usuario";
    private $_vista="v_usuarios";
    private $_bd;

    public function __construct($idUsuario=null, $Nickname=null, $Contraseña=null, $nombre=null, $email=null, $Estado=null, $tipoUsuario=null){
        $this->_bd = new BaseDeDatos(new MySQL());
        $this->_idUsuario = $idUsuario;
        $this->_Nickname= $Nickname;
        $this->_Contraseña= $Contraseña;
        $this->_nombre= $nombre;
        $this->_email= $email;
        $this->_Estado= $Estado;
        $this->_tipoUsuario= new TipoUsuario($tipoUsuario);
        
    }
    public function setTipoUsuario (TipoUsuario $tu){
        $this->_tipoUsuario= $tu;
    }
    public function getTipoUsuario (){
        return $this->_tipoUsuario;
    }
    public function validarUsuario(){
        $sql= "SELECT * FROM ". $this->_tabla 
            . " WHERE Nickname='".$this->_login ."' and Contraseña='".$this->_clave ."'and Estado=1";
        return $this->_bd->ejecutar($sql);
    }

    public function leer(){
        $sql ="SELECT * FROM ". $this->_vista .";";
        return $this->_bd->ejecutar($sql);
    }
    public function leerUno(){
        $sql= "SELECT * FROM ". $this->_vista
            . " WHERE idUsuario=".$this->_idUsuario;
        
        $datos= $this->_bd->ejecutar($sql);  
        //var_dump($datos);exit();
        if (is_array($datos['data'])){
            $this->_idUsuario = $datos['data'][0]["idUsuario"];
            $this->_Nickname = $datos['data'][0]["Nickname"];
            $this->_Contraseña = $datos['data'][0]["Contraseña"];
            $this->_nombre = $datos['data'][0]["nombre"];
            $this->_email = $datos['data'][0]["email"];
            $this->_Estado = $datos['data'][0]["Estado"];
            $this->_tipoUsuario = new TipoUsuario ($datos['data'][0]["idtipoUsuario"]);
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
            . ",nombre='".$this->_nombre."'"
            . ",email='".$this->_email."'"
            . ",idtipoUsuario=".$this->_tipoUsuario->getidtipousuario()
            ." WHERE idUsuario=".$this->_idUsuario.";";
        return $this->_bd->ejecutar($sql);
    }

    public function nuevo(){
        $sql = "INSERT INTO ". $this->_tabla 
            ." (idUsuario, Nickname, Contraseña, nombre, email, Estado, idtipoUsuario) VALUES ('".''."','".
                $this->_Nickname ."','". $this->_Contraseña ."','". $this->_nombre ."','". $this->_email ."','". $this->_Estado ."',"
                . $this->_tipoUsuario->getidtipousuario()
            .");";
            //var_dump($sql); exit();
        return $this->_bd->ejecutar($sql);
    }
    public function getidUsuario(){
        return $this->_idUsuario;
    }
    public function setLogin($login){
        $this->_login=$login;
    }
    public function setClave($clave){
        $this->_clave=$clave;
    }
    public function setEstado($Estado){
        $this->_Estado=$Estados;
    }
    public function getNickname(){
        return $this->_Nickname;
    }
    public function getContraseña(){
        return $this->_Contraseña;
    }
    public function getNombre(){
        return $this->_nombre;
    }
    public function getEmail(){
        return $this->_email;
    }
    public function getEstado(){
        return $this->_Estado;
    }
    public function ConfirmarCorreo(){
        $sql="update usuario set Estado=1";
        return $this->_bd->ejecutar($sql);
        header("Location: ?");
        exit();
    }
}
