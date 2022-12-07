<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Reserva.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlCiudad
*/
class CtrlReserva extends Controlador {
    
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Reserva();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Reservas",
            'contenido'=>Vista::mostrar('reserva/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg,
            'cssGbl'=>Libreria::cssGlobales(),
            'jsGbl'=>Libreria::jsGlobales()
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    public function nuevo(){
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Nuevo...',
            'cuerpo'=>'Ingrese información para nueva Ciudad');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlReserva'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Reserva();
        $datos1=array(
            'encabezado'=>'Nueva Reserva',
            'reserva'=>$obj
            );

        $datos = array(
                'titulo'=>'Nueva Reserva',
                'contenido'=>Vista::mostrar('reserva/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg,
                'cssGbl'=>Libreria::cssGlobales(),
                'jsGbl'=>Libreria::jsGlobales()
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Reserva (
                $_POST["idReserva"],
                $_POST["Fecha"],
                $_POST["Estado"],
                $_POST["cliente"],
                $_POST["mesa"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['idReserva'])) {
            $obj = new Reserva($_REQUEST['idReserva']);
            $resultado=$obj->eliminar();
            $this->index($resultado['msg']);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Editando...',
            'cuerpo'=>'Iniciando edición para: '.$_REQUEST['idReserva']);
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlReserva'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idReserva'])) {
            $obj = new Reserva($_REQUEST['idReserva']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idReserva']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'reserva'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Reserva: '. $_REQUEST['idReserva'],
                    'contenido'=>Vista::mostrar('reserva/frmEditar.php',$datos1,true),
                    'menu'=>$menu,
                    'migas'=>$migas,
                    'msg'=>$msg,
                    'cssGbl'=>Libreria::cssGlobales(),
                    'jsGbl'=>Libreria::jsGlobales()
                );
            }
        }else {
            $msg= array(
            'titulo'=>'Error',
            'cuerpo'=>'No se encontró al ID requerido');

            $datos = array(
                'titulo'=>'Editando Ciudad... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Reserva (
                $_POST["idReserva"],    #El id que enviamos
                $_POST["Fecha"],
                $_POST["Estado"],
                $_POST["cliente"],
                $_POST["mesa"],
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}