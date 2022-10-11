<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Cliente.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlCiudad
*/
class CtrlCliente extends Controlador {
    
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Cliente();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Clientes",
            'contenido'=>Vista::mostrar('cliente/mostrar.php',$resultado,true),
            'menu'=>$menu,
            'migas'=>$migas,
            'msg'=>$msg
        );
        //var_dump($obj->leerUno());exit();
        $this->mostrarVista('template.php',$datos);
    }
    public function nuevo(){
        $menu = Libreria::getMenu();
        $msg= array(
            'titulo'=>'Nuevo...',
            'cuerpo'=>'Ingrese información para nueva Ciudad');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlCliente'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Cliente();
        $datos1=array(
            'encabezado'=>'Nueva Cliente',
            'cliente'=>$obj
            );

        $datos = array(
                'titulo'=>'Nuevo Cliente',
                'contenido'=>Vista::mostrar('cliente/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        //var_dump ($sql);exit();
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Cliente (
                $_POST["idCliente"],
                $_POST["Nombre"],
                $_POST["Apellido"],
                $_POST["DNI"],
                $_POST["Telefono"],
                $_POST["Direccion"],
                $_POST["Email"],
                $_POST["usuario"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['idCliente'])) {
            $obj = new Cliente($_REQUEST['idCliente']);
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
            'cuerpo'=>'Iniciando edición para: '.$_REQUEST['idCliente']);
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlCliente'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idCliente'])) {
            $obj = new Cliente($_REQUEST['idCliente']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idCliente']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'cliente'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Ciudad: '. $_REQUEST['idCliente'],
                    'contenido'=>Vista::mostrar('cliente/frmEditar.php',$datos1,true),
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
                'titulo'=>'Editando Ciudad... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new Cliente (
                $_POST["idCliente"],
                $_POST["Nombre"],
                $_POST["Apellido"],
                $_POST["DNI"],
                $_POST["Telefono"],
                $_POST["Direccion"],
                $_POST["Email"],
                $_POST["usuario"],
                );

        //var_dump($obj->leerUno());exit();
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}