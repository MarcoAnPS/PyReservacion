<?php
require_once SYS . DIRECTORY_SEPARATOR . 'Controlador.php';
require_once MOD .DIRECTORY_SEPARATOR . 'Categoria.php';
require_once REC . DIRECTORY_SEPARATOR . 'Libreria.php';
/*
* Clase CtrlPais
*/
class CtrlCategoria extends Controlador {
    
    public function index($msg=''){
        $menu= Libreria::getMenu();
        $migas = array(
            '?'=>'Inicio',
            '#'=>'Listado'
        );

        $obj = new Categoria();
        $resultado = $obj->leer();

        $datos = array(
            'titulo'=>"Categorias",
            'contenido'=>Vista::mostrar('categoria/mostrar.php',$resultado,true),
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
            '?ctrl=CtrlCategoria'=>'Listado',
            '#'=>'Nuevo'
        );
        $datos1=array(
            'encabezado'=>'Nueva Categoria'
            );

        $datos = array(
                'titulo'=>'Nueva Categoria',
                'contenido'=>Vista::mostrar('categoria/frmNuevo.php',$datos1,true),
                'menu'=>$menu,
                'migas'=>$migas,
                'msg'=>$msg
            );
        $this->mostrarVista('template.php',$datos);
    }

    public function guardarNuevo(){
        $obj = new Categoria (
                $_POST["idCategoria"],
                $_POST["Nombre"],
                $_POST["Descripcion"],
                );
        $respuesta=$obj->nuevo();

        $this->index($respuesta['msg']);
    }
    public function eliminar(){
        if (isset($_REQUEST['idCategoria'])) {
            $obj = new Categoria($_REQUEST['idCategoria']);
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
        if (isset($_REQUEST['idCategoria'])) {

            $obj = new Categoria($_REQUEST['idCategoria']);
            $miObj = $obj->leerUno();
            // var_dump($obj->leerUno());exit();
            if (is_null($miObj['data'])) {
                $this->index(array(
                    'titulo'=>'Error',
                    'cuerpo'=>'ID Requerido: '.$_REQUEST['idCategoria']. ' No Existe')
                );
            }else{
                $datos1 = array(
                    'categoria'=>$obj
                );
                $msg= array(
                    'titulo'=>'Editando...',
                    'cuerpo'=>'Iniciando edición de: '.$_REQUEST['idCategoria']);
            $datos = array(
                'titulo'=>'Editando Categoria: '. $_REQUEST['idCategoria'],
                'contenido'=>Vista::mostrar('categoria/frmEditar.php',$datos1,true),
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
        $obj = new Categoria (
                $_POST["idCategoria"],    #El id que enviamos
                $_POST["Nombre"],
                $_POST["Descripcion"],
                );
        $respuesta=$obj->editar();
        
        $this->index($respuesta['msg']);
    }
}