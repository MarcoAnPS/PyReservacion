<?php

require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlPrincipal
*/
class CtrlPrincipal extends Controlador {
    
    public function index(){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );
        $datos = array(
            'titulo'=>"Sistema de Reservaciones",
            'contenido'=>Vista::mostrar('principal.php','',true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>array(
                'titulo'=>'',
                'cuerpo'=>''
            ),
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        
        $this->mostrarVista('template.php',$datos);

    }
    public function error404(){
        $datos= array(
            'controlador'=>isset($_GET['ctrl'])?$_GET['ctrl']:'CtrlPrincipal',
            'accion'=>isset($_GET['accion'])?$_GET['accion']:'index'
        );
        $this->mostrarVista('404.php',$datos);
    }
    public function gracias(){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );
        //$datosGraf= $this->getGraficoModelosXMarcas();
        unset($_SESSION['carrito']);
        $datos = array(
            'titulo'=>"Ventas",
            'contenido'=>Vista::mostrar('gracias.php','',true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>array(
                    'titulo'=>'',
                    'cuerpo'=>''
            ),
            'data'=>null,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
            //'grafico'=>$datosGraf
        );
        
        $this->mostrarVista('template.php',$datos);

    }
}