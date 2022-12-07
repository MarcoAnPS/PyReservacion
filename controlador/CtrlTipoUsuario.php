<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'TipoUsuario.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Carrito.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlPais
*/
class CtrlTipoUsuario extends Controlador {
    
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Listado'
            
        );

        $obj = new TipoUsuario();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Tipos Usuarios",
            'contenido'=>Vista::mostrar('tipousuario/mostrar.php',$resultado,true),
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
            'cuerpo'=>'Ingrese información para nuevo Tipo de Usuario');
        $migas = array(
            '?'=>'Inicio',
            '?ctrl=CtrlTipoUsuario'=>'Listado',
            '#'=>'Nuevo'
        );
        $datos1=array(
            'encabezado'=>'Nuevo Tipo de Usuario'
            );

        $datos = array(
                'titulo'=>'Nueva Tipo Usuario',
                'contenido'=>Vista::mostrar('tipousuario/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg,
                'cssGbl'=>Libreria::cssGlobales(),
                'jsGbl'=>Libreria::jsGlobales()
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new TipoUsuario (
                $_POST["idtipoUsuario"],
                $_POST["Nombre"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['idtipoUsuario'])) {
            $obj = new TipoUsuario($_REQUEST['idtipoUsuario']);
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
            '?ctrl=CtrTipoUsuario'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idtipoUsuario'])) {

            $obj = new TipoUsuario($_REQUEST['idtipoUsuario']);
            $miObj = $obj->leerUno();
            // var_dump($obj->leerUno());exit();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idtipoUsuario']. ' No Existe')
                );
            }else{
                $datos1 = array(
                    'tipousuario'=>$obj
                );
                $msg= array(
                    'titulo'=>'Editando...',
                    'cuerpo'=>'Iniciando edición de: '.$_REQUEST['idtipoUsuario']);
            $datos = array(
                'titulo'=>'Editando Categoria: '. $_REQUEST['idtipoUsuario'],
                'contenido'=>Vista::mostrar('tipousuario/frmEditar.php',$datos1,true),
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
                'titulo'=>'Editando Turno... DESCONOCIDO',
                'contenido'=>'...El Id a Editar es requerido',
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg);
        }
        
        $this->mostrarVista('template.php',$datos);

        
    }
    public function guardarEditar(){
        $obj = new TipoUsuario (
                $_POST["idtipoUsuario"],    #El id que enviamos
                $_POST["Nombre"],
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}