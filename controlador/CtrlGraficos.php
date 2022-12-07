<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
require_once MOD . DIRECTORY_SEPARATOR . 'Producto.php';
require_once MOD . DIRECTORY_SEPARATOR . 'Graficos.php';
/*
* Clase CtrlCiudad
*/
class CtrlGraficos extends Controlador {
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );
        $datosGraf= $this->getGraficoModelosXMarcas();
        $datosGraf2= $this->getGraficoCantidad();
        $datos = array(
            'titulo'=>"",
            'contenido'=>Vista::mostrar ('graficos/mostrar.php',$datosGraf,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>array(
                'titulo'=>'',
                'cuerpo'=>''
            ),
            'data'=>null,
            'grafico'=>$datosGraf,
            'grafico1'=>$datosGraf2,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        //var_dump();exit();
        $this->mostrarVista('template.php',$datos);
        
    }
    private function getGraficoModelosXMarcas(){
        $g = new Graficos();
        $datos = $g->getModeloXMarca();
        //var_dump($datos);exit();
        return $datos;
        
    }
    private function getGraficoCantidad(){
        $g = new Graficos();
        $datos = $g->getGraf();
        //var_dump($datos);exit();
        return $datos;
        
    }

}
