<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Usuario.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlPais
*/
class CtrlUsuario extends Controlador {
    
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Listado'
        );

        $obj = new Usuario();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Categorias",
            'contenido'=>Vista::mostrar('usuario/mostrar.php',$resultado,true),
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
            '?ctrl=CtrlUsuario'=>'Listado',
            '#'=>'Nuevo'
        );
        $datos1=array(
            'encabezado'=>'Nueva Categoria'
            );

        $datos = array(
                'titulo'=>'Nueva Categoria',
                'contenido'=>Vista::mostrar('usuario/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Usuario (
                $_POST["idUsuario"],
                $_POST["Nickname"],
                $_POST["Contraseña"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['idUsuario'])) {
            $obj = new Usuario($_REQUEST['idUsuario']);
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
            '?ctrl=CtrCategoria'=>'Listado',
            '#'=>'Editar',
        );
        if (isset($_REQUEST['idUsuario'])) {

            $obj = new Usuario($_REQUEST['idUsuario']);
            $miObj = $obj->leerUno();
            // var_dump($obj->leerUno());exit();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idUsuario']. ' No Existe')
                );
            }else{
                $datos1 = array(
                    'usuario'=>$obj
                );
                $msg= array(
                    'titulo'=>'Editando...',
                    'cuerpo'=>'Iniciando edición de: '.$_REQUEST['idUsuario']);
            $datos = array(
                'titulo'=>'Editando Categoria: '. $_REQUEST['idUsuario'],
                'contenido'=>Vista::mostrar('usuario/frmEditar.php',$datos1,true),
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
        $obj = new Usuario (
                $_POST["idUsuario"],    #El id que enviamos
                $_POST["Nickname"],
                $_POST["Contraseña"],
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}