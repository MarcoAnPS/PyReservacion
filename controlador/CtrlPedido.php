<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Pedido.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlCiudad
*/
class CtrlPedido extends Controlador {
    
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
        );

        $obj = new Pedido();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Pedidos",
            'contenido'=>Vista::mostrar('pedido/mostrar.php',$resultado,true),
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
            '?ctrl=CtrlPedido'=>'Listado',
            '#'=>'Nuevo',
        );
        $obj = new Pedido();
        $datos1=array(
            'encabezado'=>'Nueva Pedido',
            'pedido'=>$obj
            );

        $datos = array(
                'titulo'=>'Nuevo Pedido',
                'contenido'=>Vista::mostrar('pedido/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        //var_dump ($sql);exit();
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Pedido (
                $_POST["idPedido"],
                $_POST["Numero"],
                $_POST["Fecha"],
                $_POST["Pago"],
                $_POST["Estado"],
                $_POST["cliente"],
                $_POST["mesa"],
                $_POST["usuario"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['idPedido'])) {
            $obj = new Pedido($_REQUEST['idPedido']);
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
            'cuerpo'=>'Iniciando edición para: '.$_REQUEST['idPedido']);
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlProducto'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idPedido'])) {
            $obj = new Pedido($_REQUEST['idPedido']);
            $miObj = $obj->leerUno();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idPedido']. ' No Existe')
                );
            }else{

                $datos1 = array(
                        'pedido'=>$obj
                    );

                $datos = array(
                    'titulo'=>'Editando Ciudad: '. $_REQUEST['idPedido'],
                    'contenido'=>Vista::mostrar('pedido/frmEditar.php',$datos1,true),
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
        $obj = new Pedido (
                $_POST["idPedido"],    #El id que enviamos
                $_POST["Numero"],
                $_POST["Fecha"],
                $_POST["Pago"],
                $_POST["Estado"],
                $_POST["cliente"],
                $_POST["mesa"],
                $_POST["usuario"],
                );

        //var_dump($obj->leerUno());exit();
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}