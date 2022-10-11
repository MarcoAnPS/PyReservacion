<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Mesa.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlPais
*/
class CtrlMesa extends Controlador {
    
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Listado'
        );

        $obj = new Mesa();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Mesas",
            'contenido'=>Vista::mostrar('mesa/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg
        );
        
        $this->mostrarVista('template.php',$datos);
    }
    public function nuevo(){
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Nuevo...',
            'cuerpo'=>'Ingrese información para nuevo Pais');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlMesa'=>'Listado',
            '#'=>'Nuevo'
        );
        $datos1=array(
            'encabezado'=>'Nueva Categoria'
            );

        $datos = array(
                'titulo'=>'Nueva Mesa',
                'contenido'=>Vista::mostrar('mesa/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Mesa (
                $_POST["idMesa"],
                $_POST["Numero"],
                $_POST["Estado"],
                $_POST["Capacidad"],
                $_POST["NroPersonas"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['idMesa'])) {
            $obj = new Mesa($_REQUEST['idMesa']);
            $resultado=$obj->eliminar();
            $this->index($resultado['msg']);
        } else {
            echo "...El Id a ELIMINAR es requerido";
        }
    }
    public function editar(){
        #Mostramos el Formulario de Editar
        $datos=null;
        $menu = Libreria::getMenu();
        
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrMesa'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idMesa'])) {

            $obj = new Mesa($_REQUEST['idMesa']);
            $miObj = $obj->leerUno();
            // var_dump($obj->leerUno());exit();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idMesa']. ' No Existe')
                );
            }else{
                $datos1 = array(
                    'mesa'=>$obj
                );
                $msg= array(
                    'titulo'=>'Editando...',
                    'cuerpo'=>'Iniciando edición de: '.$_REQUEST['idMesa']);
            $datos = array(
                'titulo'=>'Editando Categoria: '. $_REQUEST['idMesa'],
                'contenido'=>Vista::mostrar('mesa/frmEditar.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
            }
            
        }else {
            $msg= array(
            'titulo'=>'Error',
            'cuerpo'=>'No se encontró al ID requerido');

            $datos = array(
                'titulo'=>'Editando Turno... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Mesa (
                $_POST["idMesa"],    #El id que enviamos
                $_POST["Numero"],
                $_POST["Estado"],
                $_POST["Capacidad"],
                $_POST["NroPersonas"],
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}