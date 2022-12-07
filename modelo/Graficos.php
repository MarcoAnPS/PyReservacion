<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Modelo.php';
require_once PER . DIRECTORY_SEPARATOR . "BaseDeDatos.php";

class Graficos extends Modelo {
    private $_bd;
    public function __construct() {
        $this->_bd = new BaseDeDatos(new MySQL());
    }
    public function getModeloXMarca(){
        $sql ="SELECT * FROM v_graf_modelos_x_marca;";    
        $datos = $this->_bd->ejecutar($sql);
        return $this->getArray($datos['data']);
        //var_dump($datos);exit();
    }
    private function getArray($datos){
        $labels=null;
        $data=null;
        foreach ($datos as $d) {
            $labels[]=$d['Categorias'];
            $data[]=$d['Cantidad'];
        }
        return array('labels'=>$labels,'data'=>$data);
        
    }
    public function getGraf(){
        $sql ="SELECT * FROM v_graf;";    
        $datos = $this->_bd->ejecutar($sql);
        return $this->getGrafArray($datos['data']);
        //var_dump($datos);exit();
    }
    private function getGrafArray($datos){
        $labels=null;
        $data=null;
        foreach ($datos as $d) {
            $labels[]=$d['Nombre'];
            $data[]=$d['Cantidad'];
        }
        return array('labels'=>$labels,'data'=>$data);
        
    }

}